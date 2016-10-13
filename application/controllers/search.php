<?php
/**
*
*/
class Search extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->time = date('Y-m-d H:i:s');
        $this->load->model('search_model');
        $this->load->model('product_model');
        $this->load->model('wordpress_model');
    }

    public function index(){
        $this->load->helper("product");
        $data = array();
        $post = array();

        //分词搜索
        $kw=trim($this->input->get('kw',true));
        if (!$kw) {
            $kw = $this->uri->segment(3);
        }
        $post['kw'] = $kw;
        $post['page'] = $this->input->get('page');

        /*$this->load->library('sphinxclient');
        $this->sphinxclient->SetServer(SPHINX_SERVER_IP,9312);
        //$this->sphinxclient->SetMatchMode(SPH_MATCH_ANY);
        $this->sphinxclient->SetSortMode(SPH_SORT_EXTENDED,'@relevance desc,@weight desc');

        $base = $this->sphinxclient->Query($kw, 'base');  		//产品
        if ($base['total_found'] != 0){
            $base_ids = implode(',', array_keys($base['matches']));      
        }else{ $base_ids = 0 ;}

        $show = $this->sphinxclient->Query($kw, 'show');  		//展品
        if ($show['total_found'] != 0){
            $show_ids = implode(',', array_keys($show['matches']));      
        }else{ $show_ids = 0 ;}

        $course = $this->sphinxclient->Query($kw, 'course');	//课程
        if ($course['total_found'] != 0){
            $course_ids = implode(',', array_keys($course['matches']));      
        }else{ $course_ids = 0 ;}

        $video = $this->sphinxclient->Query($kw, 'video'); 		//视频
        if ($video['total_found'] != 0){
            $video_ids = implode(',', array_keys($video['matches']));      
        }else{ $video_ids = 0 ;}*/
        
        //$post['ids'] = $base_ids; 
        $post['genre_id'] = PRODUCT_TOOTH_TYPE;
        $post['page_size'] = 10;
        $data['kw'] = $kw;  //搜索的关键字
        $data['product'] = $this->product_model->search_product($post);  //搜索的产品
        $data['product_pagelist_num'] = create_pagination(array('pages' => $data['product']['filter']['page_count'] , 'page' => $data['product']['filter']['page'], 'list_num' => 2, 'is_return' => 1));
        
        //$post['ids'] = $course_ids;
        $post['page_size'] = 4;
        $post['genre_id'] = PRODUCT_COURSE_TYPE;
        $data['course'] = $this->product_model->search_product($post);  //搜索的课程
        $data['course_pagelist_num'] = create_pagination(array('pages' => $data['course']['filter']['page_count'] , 'page' => $data['course']['filter']['page'], 'list_num' => 2, 'is_return' => 1));
        unset($post['genre_id']);
        //$post['ids'] = $show_ids;
        //$post['is_best'] = 1;
        //$data['exhibit'] = $this->product_model->get_search_product($post);  //搜索的展品
        
        $post['page_size'] = 4;
        $data['article'] = $this->wordpress_model->article_list($post);  //搜索的文章
        $data['article_pagelist_num'] = create_pagination(array('pages' => $data['article']['filter']['page_count'] , 'page' => $data['article']['filter']['page'], 'list_num' => 2, 'is_return' => 1));
        
        //$post['ids'] = $video_ids;
        //$data['video'] = $this->wordpress_model->get_search_video($post);  //搜索的视频
        $post['page_size'] = 4;
        $data['video'] = $this->wordpress_model->videos_list($post);  //搜索的视频
        $data['video_pagelist_num'] = create_pagination(array('pages' => $data['video']['filter']['page_count'] , 'page' => $data['video']['filter']['page'], 'list_num' => 2, 'is_return' => 1));


		// 搜索页热搜的5个产品
        //$data['search_hot'] = $this->search_model->all_hot();
   
        $this->load->view('search/index2',$data);
    }
    
    public function product(){
        $genre_id = $this->input->post('tid');
        $page = $this->input->post('page');
        $kw = $this->input->post('kw');
        
        $post['kw'] = $kw;
        $post['genre_id'] = $genre_id;
        $post['page_size'] = 10;
        $post['page'] = $page;
        $data['kw'] = $kw;  //搜索的关键字
        $result = $this->product_model->search_product($post);  //搜索的产品
        $data['arr_pagelist_num'] = create_pagination(array('pages' => $result['filter']['page_count'] , 'page' => $result['filter']['page'], 'list_num' => 2, 'is_return' => 1));
        $data['list'] = $result['list'];
        $data['filter'] = $result['filter'];
        
        if ($genre_id == PRODUCT_COURSE_TYPE){
            $content = $this->load->view('search/course', $data, true);
        } else {
            $content = $this->load->view('search/product', $data, true);
        }
        echo json_encode(array('err' => 0, 'content' => $content));
    }
    
    public function article(){
        $tmid = $this->input->post('tmid');
        $tid = $this->input->post('tid');
        $page = $this->input->post('page');
        $kw = $this->input->post('kw');
        $target = $this->input->post('target');
        
        $post['kw'] = $kw;
        $post['tmid'] = $tmid;
        $post['page_size'] = 10;
        $post['page'] = $page;
        $data['kw'] = $kw;  //搜索的关键字
        $data['tmid'] = (int)$tmid;
        $data['target'] = $target;
        if ($tid == 3) {
            $result = $this->wordpress_model->article_list($post);  //搜索的产品
        } else {
            $result = $this->wordpress_model->videos_list($post);  //搜索的产品
        }
        
        $data['arr_pagelist_num'] = create_pagination(array('pages' => $result['filter']['page_count'] , 'page' => $result['filter']['page'], 'list_num' => 2, 'is_return' => 1));
        $data['list'] = $result['list'];
        $data['filter'] = $result['filter'];
        
        if ($tid == 3){
            $content = $this->load->view('search/article', $data, true);
        } else {
            $content = $this->load->view('search/videos', $data, true);
        }
        echo json_encode(array('err' => 0, 'content' => $content));
    }
    
    public function index_old(){
        $data = array();
        $post = array();

        //分词搜索
        $kw=trim($this->input->get('kw',true));
        if (!$kw) {
                $kw = $this->uri->segment(3);
        }
        $post['kw'] = $kw;

        $this->load->library('sphinxclient');
        $this->sphinxclient->SetServer(SPHINX_SERVER_IP,9312);
        //$this->sphinxclient->SetMatchMode(SPH_MATCH_ANY);
        $this->sphinxclient->SetSortMode(SPH_SORT_EXTENDED,'@relevance desc,@weight desc');

        $base = $this->sphinxclient->Query($kw, 'base');  		//产品
        if ($base['total_found'] != 0){
            $base_ids = implode(',', array_keys($base['matches']));      
        }else{ $base_ids = 0 ;}

        $show = $this->sphinxclient->Query($kw, 'show');  		//展品
        if ($show['total_found'] != 0){
            $show_ids = implode(',', array_keys($show['matches']));      
        }else{ $show_ids = 0 ;}

        $course = $this->sphinxclient->Query($kw, 'course');	//课程
        if ($course['total_found'] != 0){
            $course_ids = implode(',', array_keys($course['matches']));      
        }else{ $course_ids = 0 ;}

        $video = $this->sphinxclient->Query($kw, 'video'); 		//视频
        if ($video['total_found'] != 0){
            $video_ids = implode(',', array_keys($video['matches']));      
        }else{ $video_ids = 0 ;}
        
        $post['ids'] = $base_ids; 
        $post['genre_id'] = PRODUCT_TOOTH_TYPE;
        $data['kw'] = $kw;  //搜索的关键字
        $data['product'] = $this->product_model->get_search_product($post);  //搜索的产品
        
        $post['ids'] = $course_ids;
        $post['genre_id'] = PRODUCT_COURSE_TYPE;
        $data['course'] = $this->product_model->get_search_product($post);  //搜索的课程
        
        unset($post['genre_id']);
        $post['ids'] = $show_ids;
        $post['is_best'] = 1;
        $data['exhibit'] = $this->product_model->get_search_product($post);  //搜索的展品
        
        $post['ids'] = $video_ids;
        $data['video'] = $this->wordpress_model->get_search_video($post);  //搜索的视频


		// 搜索页热搜的5个产品
        $data['search_hot'] = $this->search_model->all_hot();
   
            $this->load->view('search/index',$data);
    }
}

