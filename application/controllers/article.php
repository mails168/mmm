<?php

#doc
#	classname:	Article
#	scope:		PUBLIC
#
#/doc

class Article extends CI_Controller
{

	function __construct ()
	{
		parent::__construct();
		$this->time = date('Y-m-d H:i:s');
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('article_model');
                $this->load->model('wordpress_model');
                $this->load->library('lib_ad');
	}
        
	public function index()
	{
            $data = array();
            $post = array();

            //分词搜索
            //$kw=trim($this->input->get('kw',true));
            /*if (!$kw) {
                $kw = $this->uri->segment(3);
            }
            $post['kw'] = $kw;*/
            $post['page'] = $this->input->get('page');

            //$post['page_size'] = 10;
            //$data['kw'] = $kw;  //搜索的关键字

            $data['kw'] = '';
            $data['tmid'] = 0;
            $post['page_size'] = 10;
            $result = $this->wordpress_model->article_list($post);  //搜索的文章
            $data['arr_pagelist_num'] = create_pagination(array('pages' => $result['filter']['page_count'] , 'page' => $result['filter']['page'], 'list_num' => 2, 'is_return' => 1));
            $data['list'] = $result['list'];
            $data['filter'] = $result['filter'];
            
            $ad = $this->lib_ad->get_ad_by_position_tag('pc_baike_article_list','pc_baike_article_list', 1);
            
            $data['ad'] = $ad;
            $this->load->view('article/index2',$data);
	}

	public function info($article_id)
	{
		$this->load->library('memcache');
		$article_id = intval($article_id);
		if(($article=$this->memcache->get('artilce_'.$article_id))==FALSE){
			$article = $this->article_model->filter(array('article_id'=>$article_id));
			if(!$article) sys_msg('文章不存在',1);
			$article->cat=$this->article_model->filter_cat(array('cat_id'=>$article->cat_id));
			//路径替换
			$article->content = adjust_path($article->content);
			$this->memcache->save('artilce_'.$article_id,$article,CACHE_TIME_ARTICLE);
		}
		if($article->url) {
			redirect($article->url);
			return;
		}
                if ( ($all_cat = $this->memcache->get('all_article_cat'))==FALSE )
		{
			$all_cat = $this->article_model->all_cat(array('parent_id'=>ARTICLE_CAT_SPEC,'is_use'=>1));
			$this->memcache->save('all_article_cat',$all_cat,CACHE_TIME_ARTICLE);
		}		
		$cat_ids = array();
		foreach( $all_cat as &$cat )
		{
			$cat_ids[] = $cat->cat_id;
			$cat->article_list = array();
		}
		$all_cat = index_array($all_cat,'cat_id');		
		if(!in_array($article->cat_id,$cat_ids)) sys_msg('文章不存在',1);
		
		if ( ($all_article = $this->memcache->get('all_article'))==FALSE )
		{
			$all_article = $this->article_model->all_article(array('cat_id'=>$cat_ids,'is_use'=>1));
			$this->memcache->save('all_article',$all_article,CACHE_TIME_ARTICLE);
		}
		
		foreach($all_article as $a)
		{
			if(!isset($all_cat[$a->cat_id])) continue;
			$all_cat[$a->cat_id]->article_list[] = $a;
		}
		$this->load->vars(array(
			'article' => $article,
			'all_cat' => $all_cat,
			'title' => $article->title,
			'keywords' => $article->keywords,
			'description' => "{$article->title} {$article->keywords}"
		));
                $this->load->view('article/index');       
//		if($article->cat->parent_id==ARTICLE_CAT_SPEC){
//			$this->load->view('article/info_spec');
//		}elseif($article->cat->parent_id==ARTICLE_CAT_HELP){
//			redirect("help-{$article_id}");
//		}else{
//			$this->load->view('article/info');
//		}
		
	}
    public function comment(){
        $is_ajax = $this->input->post('is_ajax');
        if (!$is_ajax)
            return false;
        $data['comment_post_ID'] = $this->input->post('post_id');
        $data['comment_content'] = $this->input->post('content');
        $data['comment_parent'] = $this->input->post('comment_parent');
        $data['yyw_user_id'] = $this->user_id;
        $res = $this->wordpress_model->comment_article($data);
        
        if ($res){
            $data['comments'] = $this->wordpress_model->get_comment($res);
            $content = $this->load->view('article/comments', $data, true);
            echo json_encode(array('err' => 0, 'content' => $content));
        } else {
            echo json_encode(array('err' => 1, 'content' => '没有了'));
        }
    }

    public function search(){
        //$vars = get_class_vars(get_class($this->wordpress_model));
        $kw = $this->input->get('kw');
        if(!empty($kw)){
            $kw = urldecode($kw);
            $article_list = $this->wordpress_model->search_article($kw);
            if(!empty($article_list))
                $this->load->view('mobile/article/search_ajax', array('list' => $article_list));
            else
                echo 'empty';
            //echo $html;
        } else{
            $this->load->view('mobile/article/search');
        }
        
    }
    public function detail($id){
        $this->load->library('lib_seo');
        $article_detail = $this->wordpress_model->get_article_detail($id);
        if (false === $article_detail)
        die('文章不存在!');

    	//获取文章的点赞数量
	//$article_praise_num = $this->wordpress_model->article_praise_num($id);

        //print_r($article_detail);
        $tags = $article_detail->tags;
        $tagArr = explode('&', $tags);
        $arr = array();
        foreach($tagArr as $tag){
            $tag = explode('=', $tag);
            list($name, $value, $cid) = $tag;
            //echo $name, $cid, ' ';
            /*if (!isset($$name)){
                $$name = array($cid => $value);
            } else*/
                $arr[$name][$cid] = $value;
        }
        foreach($arr as $name => $value){
            $$name = $value;
        }
        if (empty($post_tag)){
            $post_tag = '';
        } else{
            $post_tag = implode('&nbsp;', $post_tag);
        }
        $views = $this->wordpress_model->get_article_views($id);
        $prev = $this->wordpress_model->get_sibing_id($id, '<');
        $next = $this->wordpress_model->get_sibing_id($id, '>');
        
        if (isset($category)){
            $cids = array_keys($category);
            $relative_articles = $this->wordpress_model->get_relative_articles($cids, $id);
        } else{
            $relative_articles = false;
        }

        $category2 = array_values($category);
        $category = implode('&nbsp;', $category);
        
        //$sql = "SELECT term_id FROM wp_terms WHERE name = '$category'";

        //$tags = parse_str($tags, $tagArr);
        //print_r($post_tag);

        //产品广告
        /*$map_ad = $this->_get_ad('m_a_p_ad','m_a_p_ad');
        $map_ad_info = array();
        if(!empty($map_ad)){
	        foreach ($map_ad as $key_ad => $val_ad) {
	         	$ad_name = explode('_',$val_ad->ad_name);
	         	$map_ad_info[$ad_name[1]] = $val_ad;
	        }
	    }
		if(array_key_exists($id, $map_ad_info)){
			$map_ad_info = $map_ad_info[$id];
		}else{
			$map_ad_info = $map_ad_info['default'];
		}
        */
        $seo = $this->lib_seo->get_seo_by_pagetag('article_detail', array(
								'post_title' => $article_detail->post_title							
								));
        
        
        $this->load->vars(array(
        	'article' => $article_detail, 
        	'tag' => $post_tag, 
        	'category' => $category,
                'category2' => $category2[0],
        	'views' => $views, 
        	'prev' => $prev, 
        	'next' => $next, 
        	'relative_articles' => $relative_articles,
        	'page_title' => $seo['title'],
        	'description' => preg_replace('/[\n\r\t]/', '', strip_tags($article_detail->post_content)),
        	'keywords' => $post_tag,
        	//'collect_data'=>get_collect_data(),
        	'praise_data'=>get_praise_data(),
                'page_size' => ceil($article_detail->comment_count/M_LIST_PAGE_SIZE)
        	//'article_praise_num'=>$article_praise_num->praise_num,
        	//'map_ad_info' => $map_ad_info
        	));
        $this->load->view('article/detail');

    }
	
	public function help ($article_id)
	{
		$this->load->library('memcache');
		$article_id = intval($article_id);
		if(($article=$this->memcache->get('artilce_'.$article_id))==FALSE){
			$article = $this->article_model->filter(array('article_id'=>$article_id));

			if(!$article||!$article->is_use) sys_msg('文章不存在',1);
			//路径替换
			$article->content = adjust_path($article->content);
			$this->memcache->save('artilce_'.$article_id,$article,CACHE_TIME_ARTICLE);
		}
		if ( ($all_cat = $this->memcache->get('all_help_cat'))==FALSE )
		{
			$all_cat = $this->article_model->all_cat(array('parent_id'=>ARTICLE_CAT_HELP,'is_use'=>1));
			$this->memcache->save('all_help_cat',$all_cat,CACHE_TIME_ARTICLE);
		}		
		$cat_ids = array();
		foreach( $all_cat as &$cat )
		{
			$cat_ids[] = $cat->cat_id;
			$cat->article_list = array();
		}
		$all_cat = index_array($all_cat,'cat_id');		
		if(!in_array($article->cat_id,$cat_ids)) sys_msg('文章不存在',1);

		if ( ($all_article = $this->memcache->get('all_help_article'))==FALSE )
		{
			$all_article = $this->article_model->all_article(array('cat_id'=>$cat_ids,'is_use'=>1));
			$this->memcache->save('all_help_article',$all_article,CACHE_TIME_ARTICLE);
		}
		
		foreach($all_article as $a)
		{
			if(!isset($all_cat[$a->cat_id])) continue;
			$all_cat[$a->cat_id]->article_list[] = $a;
		}
		$this->load->vars(array(
			'article' => $article,
			'all_cat' => $all_cat,
			'title' => $article->title,
			'keywords' => $article->keywords,
			'description' => "{$article->title} {$article->keywords}"
		));
		$this->load->view('article/help');
	}

	// 点赞
	public function add_to_praise()
	{
            $this->load->model('wordpress_model');

            //判断用户是否登录
            // if(!$this->user_id) {
            // 	print json_encode(array('err'=>0,'msg'=>0));
            // 	return;
            // }

            $article_id = intval($this->input->post('article_id'));

            //判断用户是否点赞
            if($this->user_id){
                    $col=$this->wordpress_model->filter_praise(array('post_id'=>$article_id,'user_id'=>$this->user_id));
                    if(!empty($col)){
                            sys_msg('已经点过赞咯！',1);
                    }
            }else{
                    $this->user_id = 0;
                    if(!empty($_COOKIE['praise_anonymous_'.$article_id])) {sys_msg('已经点过赞咯！',1);}
            }

            //判断 点赞的文章 是否存在
            $p=$this->wordpress_model->filter(array('ID'=>$article_id,'post_status'=>'publish'));
            if(empty($p)) sys_msg('此文章不存在',1);    // 文章

            $praise = array(
                    'post_id' => $article_id,
                    'user_id' => $this->user_id,
                    'ip_address' => $_SERVER["REMOTE_ADDR"],
                    'type_source' => 'yyw_moblie'
            );

            //将某个 文章的 点赞记录写入db
            $this->wordpress_model->insert_praise($praise);

            $praise_data = array();
            $praise_data[] =$praise;

            //将 用户ip 点赞 的文章 写入cookie
            setcookie("praise_anonymous_".$article_id,'praise_anonymous_'.$article_id); 

            //将 用户 点赞 的文章 写入session
            if(isset($_SESSION['praise_'.$this->user_id])){
                    array_push($praise_data[],$_SESSION['praise_'.$this->user_id]);
            }
            $this->session->set_userdata('praise_'.$this->user_id, $praise_data);

            //获取文章的点赞数量
            $article_praise_num = $this->wordpress_model->article_praise_num($article_id);

            print json_encode(array('err'=>0,'msg'=>'', 'praise_num'=>$article_praise_num->praise_num));
	}
        
    public function video(){
        $data = array();
        $post = array();

        $post['page'] = $this->input->get('page');
        
        $ad = $this->lib_ad->get_ad_by_position_tag('pc_baike_video_list','pc_baike_video_list', 1);
        
        $data['kw'] = '';
        $data['tmid'] = 0;
        $post['page_size'] = 10;
        $result = $this->wordpress_model->videos_list($post);  //搜索的文章
        $data['arr_pagelist_num'] = create_pagination(array('pages' => $result['filter']['page_count'] , 'page' => $result['filter']['page'], 'list_num' => 2, 'is_return' => 1));
        $data['list'] = $result['list'];
        $data['filter'] = $result['filter'];

            
        $data['ad'] = $ad;
        $this->load->view('article/video',$data);
    }
    
    public function video_detail($id) {
        $this->load->library('lib_seo');
        $article_detail = $this->wordpress_model->get_article_detail($id);
        if (false === $article_detail)
        die('文章不存在!');

    	//获取文章的点赞数量
	//$article_praise_num = $this->wordpress_model->article_praise_num($id);

        $tags = $article_detail->tags;
        $tagArr = explode('&', $tags);
        $arr = array();
        foreach($tagArr as $tag){
            $tag = explode('=', $tag);
            list($name, $value, $cid) = $tag;
                $arr[$name][$cid] = $value;
        }
        foreach($arr as $name => $value){
            $$name = $value;
        }
        if (empty($post_tag)){
            $post_tag = '';
        } else{
            $post_tag = implode('&nbsp;', $post_tag);
        }
        $views = $this->wordpress_model->get_article_views($id);
        $prev = $this->wordpress_model->get_sibing_id($id, '<');
        $next = $this->wordpress_model->get_sibing_id($id, '>');

        if (isset($category)){
            $cids = array(POST_FORMAT_VIDEO);
            $relative_articles = $this->wordpress_model->get_relative_articles($cids, $id);
        } else{
            $relative_articles = false;
        }

	$category2 = array_values($category);
        $category = implode('&nbsp;', $category);

        

        $seo = $this->lib_seo->get_seo_by_pagetag(
        		'article_detail', array('post_title' => $article_detail->post_title)
        		);
        $this->load->vars(array(
				'article' => $article_detail, 
				'tag' => $post_tag, 
				'category' => $category, 
				'category2' => $category2[0],
				'views' => $views, 
				'prev' => $prev, 
				'next' => $next, 
				'relative_articles' => $relative_articles,
				'title' => $seo['title'],
				'description' => preg_replace('/[\n\r\t]/', '', strip_tags($article_detail->post_content)),
				'keywords' => $post_tag,
				'collect_data'=>get_collect_data(),
				'praise_data'=>get_praise_data(),
                                'page_size' => ceil($article_detail->comment_count/M_LIST_PAGE_SIZE)
				//'article_praise_num'=>$article_praise_num->praise_num
        	));

	$this->load->view('article/video_detail'); 
    }
    
    public function get_comments($id, $page=1){
        $page = (!empty($page)) ? (int)$page : 1;
        $data = array();
        $data['comments'] = $this->wordpress_model->comments_list($id, $page);
        if (empty($data['comments'])) {
            echo json_encode(array('err' => 1, 'content' => '没有了'));
            exit;
        }
        $content = $this->load->view('article/comments', $data, true);
        echo json_encode(array('err' => 0, 'content' => $content));
    }
}
