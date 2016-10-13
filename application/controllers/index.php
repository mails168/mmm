<?php 
/**
* Index Controller
*/
class Index extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->time = date('Y-m-d H:i:s');
        $this->load->vars('page_title','');//这里设置空title即可
	}
    public function error404(){
        $this->load->view('index/404');
    }
	/**
	 * 公开访问引导页面。
	 */
	public function start_page(){
		$startPage=@file_get_contents(static_style_url('index/mobile_first_page.html'));
	   if( strlen($startPage) > 200 ){
		   $time=substr($startPage,0,10);
		   //echo 
		   if (date('Y-m-d')<=$time){
			   echo substr($startPage,10);
			   exit();
		   }else{
				redirect('/index');
			}
	   }else{
		   redirect('/index');
	   }
	}
    public function course(){

        $this->load->model('product_model');
        $page = $this->input->get('page');
        /*if ($this->input->is_ajax_request()) {
            $page = $this->input->get('page');
            $expire = $this->input->get('expire');
            if (!$cid = $this->input->get('cid'))
                $cid = 0;
            $courses = $this->product_model->get_course_list($page, $expire, $cid);
            if (false == $courses){
                echo json_encode(array('course_list' => false));
            } else {
                $course_list = $this->load->view('index/course_item', array('courses' => $courses, 'expire' => $expire), true);
                echo json_encode(array('course_list' => $course_list));
            }
        } else {*/
            $courses = $this->product_model->get_course_list($page);
            //$expire_courses = $this->product_model->get_course_list(1, true);
            
            $data = array('courses' => $courses['course_list'],
                'page_count' => $courses['pages'],
                'page' => $courses['page'],
                //'expire_courses' => $expire_courses, 
                'index' => 3);
            
            $data['arr_pagelist_num'] = create_pagination(array('pages' => $courses['pages'] , 'page' => $courses['page'], 'list_num' => 2, 'is_return' => 1));
            
            // 这里获取动态的seo
            $this->load->library('lib_seo');
            $seo = $this->lib_seo->get_seo_by_pagetag('pc_courses_index', array());
            $data = array_merge($data, $seo);            
            
            $this->load->view('index/course_list', $data);
        //}
    }

    public function medical($cid = 113){
        $sql = 'SELECT cat_id,cat_name FROM ty_article_cat WHERE parent_id=112';
        $category = $this->db->query($sql)->result();
        //print_r($category);
        $category_list = array();
        foreach($category as $c){
            $id = $c->cat_id;
            $category_list[$id] = $c->cat_name;
        }
        $filter = array('page' => 1, 'page_size' => 5, 'cat_id' => $cid);
        $this->load->model('article_model');
        $article_list = $this->article_model->article_list($filter);
        $this->load->model('product_model');
        $name = $category_list[$cid];
        $sql = 'SELECT category_id FROM ty_product_category WHERE category_name=\''.$name.'\'';
        $cat_id = $this->db->query($sql)->first_row();
        $cat_id = $cat_id->category_id;
        $courses = $this->product_model->get_course_list(1, false, $cat_id);
        $is_login = $this->session->userdata('user_id');
        $data = array('cid' => $cid, 'category' => $category_list, 'article_list' => $article_list, 'courses' => $courses['course_list'], 'is_login' => $is_login, 'pid' => $cat_id, 'index' => 3);
        $this->load->view('index/medical', $data);
    }


    /**
     * @param:导航id
     */
    public function index()
    {       
        $cache_key = 'pc_index_page_cache';
        $is_preview = intval(trim($this->input->get('is_preview')));
        $this->load->library('memcache');
        $cache = $this->memcache->get($cache_key);    

        if (!$is_preview && $cache != FALSE) {
            $this->load->view('index/index', $cache);
            return;       
        }
        $data = array();
        $this->load->library('lib_ad');
        $this->config->load('global', true);
        $this->load->model('product_model');
        $this->load->model('wordpress_model');
        $this->load->model('about_us_model');
        $this->load->helper('product');

        $data = array();
        //pc首页轮播图  
        $data['pc_top_carousel'] = $this->lib_ad->get_focus_image_pc('pc_index_top_carousel', 4);   

        //PC热卖商品
        $pc_hot_product = $this->_get_ad('pc_hot_product','pc_hot_product'); 
        foreach ($pc_hot_product as $key => $value) {
            $product = array();
            $str = cutstr_html($value->ad_code, 0);
            parse_str($str);
            $pc_hot_product[$key]->products_info = $this->_get_cache_products($product);
        }

        $data['pc_hot_product'] = $pc_hot_product;
        
        //PC口腔器材
        $pc_mouth_product = $this->_get_ad('pc_mouth_product','pc_mouth_product');
        foreach ($pc_mouth_product as $key => $value) {
            $product = array();
            $brand = array();
            $desc = '';
            $str = cutstr_html($value->ad_code, 0);
            parse_str($str);
            $pc_mouth_product[$key]->products_info = $this->_get_cache_products($product);
            $pc_mouth_product[$key]->brands_info = $this->_get_cache_brands($brand);
            $pc_mouth_product[$key]->desc = $desc;
        }
        
        $data['pc_mouth_product'] = $pc_mouth_product;

        //PC护理保健
        $pc_nurse_product = $this->_get_ad('pc_nurse_product','pc_nurse_product');
        foreach ($pc_nurse_product as $key => $value) {
            $product = array();
            $brand = array();
            $desc = '';
            $str = cutstr_html($value->ad_code, 0);
            parse_str($str);
            $pc_nurse_product[$key]->products_info = $this->_get_cache_products($product);
            $pc_nurse_product[$key]->brands_info = $this->_get_cache_brands($brand);
            $pc_nurse_product[$key]->desc = $desc;
        }
        
        $data['pc_nurse_product'] = $pc_nurse_product;

        //PC悦牙讲堂
        $pc_room_course = $this->_get_ad('pc_room_course','pc_room_course');
        foreach ($pc_room_course as $key => $value) {
            $product = array();
            $brand = array();
            $desc = '';
            $str = cutstr_html($value->ad_code, 0);
            parse_str($str);
            $pc_room_course[$key]->products_info = $this->_get_cache_products($product);
            $pc_room_course[$key]->desc = $desc;
        }
        
        $data['pc_room_course'] = $pc_room_course;

        //PC悦牙百科
        $pc_video_article = $this->_get_ad('pc_video_article','pc_video_article');
        foreach ($pc_video_article as $key => $value) {
            $product = array();
            $brand = array();
            $type = '';
            $str = cutstr_html($value->ad_code, 0);
            parse_str($str);
            $pc_video_article[$key]->products_info = $this->_get_cache_video_article($product);
            $pc_video_article[$key]->type = $type;
        }

        $data['pc_video_article'] = $pc_video_article;  
		
        //PC合作品牌
        $pc_brand_teamwork = $this->_get_ad('pc_brand_teamwork','pc_brand_teamwork');
        foreach ($pc_brand_teamwork as $key => $value) {
            $brand = array();
            $link_url = array();
            $link_url_brand = array();
            $str = cutstr_html($value->ad_code, 0);
            parse_str($str);
            foreach ($link_url as $link_key => $val_url) {
               $link_url_brand[$brand[$link_key]] = $val_url;
            }
            $brand_info = $this->_get_cache_brands($brand);
            foreach ($brand_info as $key_bra => $val_bra) {
                $brand_info[$key_bra]->link_url = $link_url_brand[$val_bra->brand_id];
            }
        }

        $data['pc_brand_teamwork'] = $brand_info;
        
        //PC 友情链接
        $data['pc_link_list'] = $this->about_us_model->index_link_url();

        // 获取动态seo关键字
        $this->load->library('lib_seo');
        $seo = $this->lib_seo->get_seo_by_pagetag('pc_index');
        $data = array_merge($data, $seo);
        
        $data['index'] = 0;
        $this->memcache->delete($cache_key);
        $this->memcache->save($cache_key, $data, CACHE_TIME_INDEX_FOCUS_IMAGE);
        $this->load->view('index/index',$data);
    }

    function personal_center(){
        $data = array(
            'name' => 'ddd',
            'title' => 'xxxx'
        );
        
        $this->load->view('index/personal_center',$data);
    }
    public function get_article(){
        $page = $this->input->get('page');
        $cat = $this->input->get('cat');
        $index = 'article_cat_'.$cat.'_'.$page;
        $articles = $this->cache->get($index);
        if ($articles == false){
            $this->load->model('wordpress_model');
            $articles = $this->wordpress_model->fetch_articles($cat, $page);
        //$this->memcache->delete('articles'); // delete key first
            $this->cache->save($index, $articles, 7200);
        }
        if( empty($articles) ) {
            $result['success'] = 0;
        }else {
            $result['data'] = $this->load->view('mobile/index/article',array('articles'=>$articles), true);
        }
        echo json_encode($result);
        //手动更新 memcache key 的函数方法
        //memcache_key_record('article_list','文章视频首页数据',__CLASS__,__FUNCTION__,str_replace(FCPATH,'',__FILE__));
    }

    function ajax_goods_list($page_name){
        $page = $this->input->get('page');
        // init 
        $result = array('success'=>1,'data'=>array(),'msg'=>'','img_domain'=>get_img_host());

        // exception
        if ($page > M_INDEX_PAGE_MAX){
            $result['success'] = 0;
            $result['message'] = 'all empty';
            die(json_encode($result));
        }


        // result's data
        if ($page_name == 'course'){
            $list = $this->_get_product_all(PRODUCT_COURSE_TYPE, $page);
            if( empty($list) ) {
                $result['success'] = 0;
            }else {
                $result['data'] = $this->load->view('mobile/index/course',array('courses'=>$list), true);
            }

        }else{
            $this->load->library('memcache');
            $goods_list = $this->memcache->get('index_goods_list');
            if ($goods_list && array_key_exists($page-1, $goods_list)){
                $result['data'] = $goods_list[$page];
            }else{
                $result['success'] = 0;
            }
        }

        die(json_encode($result));
    }

    //按大类获取所有的商品
    function _get_product_all($genre_id, $page=1){
        $product = $this->cache->get('product_all_'.$genre_id.'_'.$page);
        if ($product == false){
            $this->load->model('product_model');
            $product = $this->product_model->get_product_onsale($genre_id, $page);
            if(!empty($product))
            {
                $this->cache->save('product_all_'.$genre_id.'_'.$page, $product,CACHE_TIME_INDEX_PRODUCT);
            }
        }
        return $product;
    }
    /**
     * 获取预售rush
     */
    function _get_pre_rush()
    {
        $pre_rush=$this->cache->get('pre_rush');
        if($pre_rush==false)
        {
            $this->load->model('rush_model');
            $pre_rush=$this->rush_model->pre_rush();
            if(!empty($pre_rush))
            {
                $this->cache->save('pre_rush',$pre_rush,CACHE_TIME_PRE_RUSH);
            }
        }
        if(empty($pre_rush)) 
            return array('pre_rush'=>array(),'pre_title'=>array());
        $pre_rush_arr=array();
        //按日期分组
        foreach($pre_rush as $key=>$val)
        {
            $now=date('Y-m-d H:i:s');
            //如果rush已开始 则continue
            if($val->start_date<$now){
                continue;
            }
            //rush图片处理
            $temp_img_arr=explode('.',$val->image_before_url);
            $val->image_before_url1=$temp_img_arr[0].'_1.'.$temp_img_arr[1];
            $val->image_before_url2=$temp_img_arr[0].'_2.'.$temp_img_arr[1];
            $val->image_before_url3=$temp_img_arr[0].'_3.'.$temp_img_arr[1];
            $pre_rush_arr[$val->date][]=$val;
        }
        //处理title 即明天 后天等
        $today=strtotime(date('Y-m-d'));
        $pre_rush_title=array();
        $week=array('1'=>'一','2'=>'二','3'=>'三','4'=>'四','5'=>'五','6'=>'六','0'=>'日',);
        foreach($pre_rush_arr as $key=>$val)
        {
            //计算rush date与今天时间差
            $rush_date=strtotime($key);
            $date_diff=round(($rush_date-$today)/3600/24);
            $temp=array();
            $time=strtotime($key);
            if($date_diff==0)
                $temp['title']="今天";
            elseif($date_diff==1)
                $temp['title']="明天";
            else if($date_diff==2)
                $temp['title']="后天";
            else
                $temp['title']='周'.$week[date('w',$time)];
            
            $temp['date']=date('m',$time).'/'.date('d',$time);
            $pre_rush_title[]=$temp;
        }
        $pre_rush_result=array('pre_rush'=>$pre_rush_arr,'pre_title'=>$pre_rush_title);
        return $pre_rush_result;
    }

    /**
     * 获取正在进行的限抢
     */
    function _get_sale_rush($nav_id=0)
    {
        $rushes=$this->cache->get('sale_rush_'.$nav_id);
        if($rushes==false)
        {
            $this->load->model('rush_model');
            $rushes=$this->rush_model->get_sale_rush(array('nav_id'=>$nav_id));
            if(empty($rushes)) return array();
            $this->cache->save('sale_rush_'.$nav_id,$rushes,CACHE_TIME_SALE_RUSH);
        }
        foreach($rushes as $key=>$rush)
        {
            //计算还剩几天
            $time_diff=strtotime($rush->end_date)-time();
            if($time_diff<86400)
            {
                $rush->end_day=1;
            }
            else
            {
                $rush->end_day=ceil($time_diff/86400);
            }
            if(!empty($rush->image_before_url))
            {
                $img_arr=explode('.',$rush->image_before_url);
                $rush->image_before_url_1=$img_arr[0].'_1.'.$img_arr[1];
                $rush->image_before_url_2=$img_arr[0].'_2.'.$img_arr[1];
                $rush->image_before_url_3=$img_arr[0].'_3.'.$img_arr[1];
            }
        }
        return $rushes;
    }
    
    /**
     * 获取今日结束的rush
     */
    function _get_today_over_rush()
    {
        $today_over_rush=$this->cache->get('today_over_rush');
        if($today_over_rush===false)
        {
            $this->load->model('rush_model');
            $today_over_rush=$this->rush_model->get_sale_rush(array('today'=>true));
            $this->cache->save('today_over_rush',$today_over_rush,CACHE_TIME_TODAY_OVER_RUSH);
        }
        //计算距离结束时间 以最晚的rush end_date为准
        $last_end_date='1970-01-01';
        foreach($today_over_rush as $key=>$rush)
        {
            //如果结束时间不等于今天 则unset掉
            if(date('Y-m-d')!=date('Y-m-d',strtotime($rush->end_date)))
            {
                unset($today_over_rush[$key]);
                continue;
            }
            if($rush->end_date>$last_end_date)
                $last_end_date=$rush->end_date;
            if(!empty($rush->image_before_url))
            {
                $img_arr=explode('.',$rush->image_before_url);
                $rush->image_before_url_1=$img_arr[0].'_1.'.$img_arr[1];
                $rush->image_before_url_2=$img_arr[0].'_2.'.$img_arr[1];
                $rush->image_before_url_3=$img_arr[0].'_3.'.$img_arr[1];
            }
        }
        $time_diff=strtotime($last_end_date)-time();
        $time_diff=$time_diff<0?0:$time_diff;
        $this->load->vars(array(
                    'today_over_hour'=>floor($time_diff/3600),
                    'today_over_min'=>ceil(($time_diff%3600)/60)));
        return $today_over_rush;
    }

    /**
     * 检查rush时间是否有效
     */
    function _check_rush($rushes)
    {
        if(empty($rushes))
            return $rushes;
        $new_rush=array();
        foreach($rushes as $key=>$val)
        {
            if($val->end_date<date('Y-m-d H:i:s')||$val->start_date>date('Y-m-d H:i:s'))
            {
                //排除不符合时间的rush
                continue;
            }
            array_push($new_rush,$val);
        }
        return $new_rush;
    }


    /**
     * 根据key或position_id获取广告
     */
    function _get_ad($cache_key,$position_tag, $size=0)
    {
        $this->load->library('lib_ad');
        $data = $this->lib_ad->get_ad_by_position_tag($cache_key,$position_tag, $size);
        //var_export($data);exit;
        return $data;
    }  

    function _get_cache_product_info($product_id) {
        $cache_key = 'pc_index_product_info_' . $product_id;
        $is_preview = intval(trim($this->input->get('is_preview')));

        if ($is_preview == 1) {
            $product_info = false;            
        } else {
            $product_info = $this->cache->get($cache_key);    
        }    

        if (!$product_info) {
            $product_info = $this->product_model->get_pc_index_product_info($product_id);    
            $this->cache->save($cache_key, $product_info, CACHE_TIME_PC_INDEX_PRODUCT_INFO);            
        }
        return $product_info;
    }

    /**
     *  2016.9.6 新版PC首页产品广告  
     *  
    */
    function _get_cache_products($product_ids) {
        $str_pro_ids = implode($product_ids, '_');
        $cache_key = 'pc_index_ad_products_' . $str_pro_ids;
        $is_preview = intval(trim($this->input->get('is_preview')));

        if ($is_preview == 1) {
            $product_info = false;            
        } else {
            $product_info = $this->cache->get($cache_key);    
        }    

        if (!$product_info) {
            $product_info = $this->product_model->get_pc_index_product_info(implode($product_ids, ','));    
            $this->cache->save($cache_key, $product_info, CACHE_TIME_PC_INDEX_PRODUCT_INFO);            
        }
        return $product_info;
    }

    function _get_cache_brands($brand_ids) {
        $str_bra_ids = implode($brand_ids, '_');
        $cache_key = 'pc_index_ad_brands_' . $str_bra_ids;
        $is_preview = intval(trim($this->input->get('is_preview')));

        if ($is_preview == 1) {
            $brand_info = false;            
        } else {
            $brand_info = $this->cache->get($cache_key);    
        }    

        if (!$brand_info) {
            $brand_info = $this->product_model->get_pc_index_brand_info(implode($brand_ids, ','));    
            $this->cache->save($cache_key, $brand_info, CACHE_TIME_PC_INDEX_PRODUCT_INFO);            
        }
        return $brand_info;
    }

    function _get_cache_video_article($vas_ids) {
        $str_vas_ids = implode($vas_ids, '_');
        $cache_key = 'pc_index_ad_vas_' . $str_vas_ids;
        $is_preview = intval(trim($this->input->get('is_preview')));;

        if ($is_preview == 1) {
            $video_article = false;            
        } else {
            $video_article = $this->cache->get($cache_key);    
        }    

        if (!$video_article) {
            $video_article = $this->wordpress_model->get_videos_articles(implode($vas_ids, ','));    
            $this->cache->save($cache_key, $video_article, CACHE_TIME_PC_INDEX_PRODUCT_INFO);            
        }
        return $video_article;
    }
      
}
