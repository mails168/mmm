<?php

/**
 * Description of Category
 *
 * @author Carol
 * @date    2013-3-5
 */
class Category extends CI_Controller {

    function __construct() {
	parent::__construct();
	$this->user_id = $this->session->userdata('user_id');
	$this->time = date('Y-m-d H:i:s');
        $this->load->model('rush_model');
    }

    /**
     * 分类列表
     * @param type $args 
     * category.htm?cat=1,2&brand=1,2&price=0-500&page=1&sort=1
     */
    public function index() {
    //$this->output->cache(CACHE_HTML_LIST);
	$this->load->model('product_model');
	$this->load->helper('common');
        $this->load->helper('product');
	
	$data = array();
        $args = array();
        $args['cat'] = trim($this->input->get('cat'));
        $args['brand'] = trim($this->input->get('brand'));
        $args['page'] = intval($this->input->get('page'));
        $args['price'] = trim($this->input->get('price'));
        $args['sort'] = trim($this->input->get('sort'));
        $args['type_id'] = trim($this->input->get('tid'));
        $price_range = array('1-99', '100-499', '500-999', '1000-1999', '2000以上');
               
        $p_num_arr = array();
        //获取分类
        if (empty($args['type_id'])) {
            if (empty($args['cat']) && empty($args['brand']) && empty($args['flag'])) {
                $args['cat_type'] = 'all';
            }else{
                if (!empty($args['brand'])) {
                    $brand_arr = explode(",", $args['brand']);
                    sort($brand_arr);
                    $p_num_arr['b'] = count($brand_arr);
                    $args['brand'] = implode(",", $brand_arr);
                }
                if (!empty($args['cat'])) {
                    $cat_arr = explode(",", $args['cat']);
                    sort($cat_arr);
                    $p_num_arr['c'] = count($cat_arr);

                    $args['cat'] = implode(",", $cat_arr);
                }            

                arsort($p_num_arr);
                //end($p_num_arr);
                $args['cat_type'] = key($p_num_arr);
            }
        

            $type = $this->rush_model->get_select_multi_type($args);//???

            if(!empty($type)) { 
                $data['category'] = $type;
            }
        } else {//获取当前位置
            $type_arr = $this->rush_model->get_product_types($args['type_id']);
            
            $tids = '';
            $type_pos = '';
            foreach ($type_arr as $t) {
                $tids .= ($tids == '') ? $t->type_id : ','.$t->type_id;
                $type_pos .= '-<a href="/category?tid='.$tids.'">'.$t->type_name.'</a>';
            }
            $type_position = '<span class="current-position">当前位置：<a href="/">首页</a>-<a href="/category" class="current-color">悦牙商城</a>'.$type_pos.'</span>';
            $data['type_position'] = $type_position;
            
        }
        // 获取广告
        //$data['ad'] = $this->rush_model->get_list_ad();
        // 获取供应商品牌
        /*if ($args['nav_type'] == 3) {
            $data['provider_brand'] = $this->rush_model->get_provider_brand($args['provider_id']);
        }
        // 获取商品的一级分类
        $data['front_types'] = $this->rush_model->get_front_types();
        $data['front_types'] = $this->get_rand_types($data['front_types']);*/

        //取列表
        $cache_key = 'category-' . implode('-', $args );
        $this->cache->delete($cache_key);
        if (($cache_data  = $this->cache->get($cache_key) )=== FALSE) {
            $cache_data  = $this->rush_model->product_list2($args );
            $this->cache->save($cache_key, $cache_data , CACHE_TIME_CATLIST);
        }
        
        $recomd_html = get_recommend_data();//推荐商品&浏览商品
        //$data['from'] = "1_".$args['type_id'];
        $data['recomd_html'] = $recomd_html;
        $data['filter'] = $cache_data['filter'];
        $data['product_list'] = $cache_data['list'];
        //$data['comment'] = $cache_data['comment'];
        $data['page'] =  $data['filter']['page'];
        $data['pages'] =  $data['filter']['page_count'];
        $data['args'] = $args;
        $data['price_range'] = $price_range;
		//创建分页
	$data['arr_pagelist_num'] = create_pagination(array('pages' => $data['pages'] , 'page' => $data['page'], 'list_num' => 2, 'is_return' => 1));
	//print_r($data);

	$this->load->view('category/category3', $data);
    }
    /**
     * 分类列表
     * @param type $args 
     */
    public function index_old($args ) {
    //$this->output->cache(CACHE_HTML_LIST);
	$this->load->model('product_model');
	$this->load->helper('common');
	
	$data = array();
	/*if (empty($args)){
	    redirect('index');
	}*/

	$args = array_slice(array_pad(array_map('intval', explode('-', $args)), 7, 0), 0, 7);
	$args_keys = array('type_id', 'sex_id', 'brand_id', 'size_id', 'sort', 'page', 'link_type');
	$args = array_combine($args_keys, $args);
        $args['nav_type'] = 1;
        
        // 修正参数开始
        if ($args['link_type'] == 1) {
            $args['brand_id'] = 0;
            $args['sex_id'] = 0;
        } elseif ($args['link_type'] == 2) {
            $args['sex_id'] = 0;
        }
        // 修正参数结束
        
        $this->redirect($args);
    }
    
    public function brand($args) {
        $data = array();
		if (empty($args)){
			redirect('index');
		}

		$args = array_slice(array_pad(array_map('intval', explode('-', $args)), 7, 0), 0, 7);
		$args_keys = array('type_id', 'sex_id', 'brand_id', 'size_id', 'sort', 'page', 'link_type');
		$args = array_combine($args_keys, $args);
        $args['nav_type'] = 2;
        
        // 修正参数开始
        if (empty($args['brand_id'])) {
            $args['brand_id'] = $args['type_id'];
            $args['type_id'] = 0;
        }
        if ($args['link_type'] == 1) {
            $args['sex_id'] = 0;
        }
        // 修正参数结束
        
        $this->redirect($args);
    }
    
    public function provider($args) {
        $data = array();
		if (empty($args)){
			redirect('index');
		}

		$args = array_slice(array_pad(array_map('intval', explode('-', $args)), 8, 0), 0, 8);
		$args_keys = array('type_id', 'sex_id', 'brand_id', 'size_id', 'sort', 'page', 'provider_id', 'link_type');
		$args = array_combine($args_keys, $args);
        $args['nav_type'] = 3;
        
        // 修正参数开始
        if (empty($args['provider_id'])) {
            $args['provider_id'] = $args['type_id'];
            $args['type_id'] = 0;
        }
        if ($args['link_type'] == 1) {
            $args['brand_id'] = 0;
            $args['sex_id'] = 0;
        } elseif ($args['link_type'] == 2) {
            $args['sex_id'] = 0;
        }
        // 修正参数结束
        
        $this->redirect($args);
    }
    
    public function redirect($args) {
        //获取分类
        $type = $this->rush_model->get_select_type($args );//???
        /*if(empty($type)|| empty($type['cat_content'] ) ){
                        if ($args["nav_type"] == 1 && $args["type_id"] != 0
                                        || $args["nav_type"] == 2 && $args["brand_id"] != 0
                                        || $args["nav_type"] == 3 && $args["provider_id"] != 0)
                redirect ("index");
        }*/
        if(empty($type)){
                        if ($args["nav_type"] == 1 && $args["type_id"] != 0
                                        || $args["nav_type"] == 2 && $args["brand_id"] != 0
                                        || $args["nav_type"] == 3 && $args["provider_id"] != 0)
                redirect ("index");
        }
        if(!empty($type['cat_content'])) $data['category'] = json_decode($type['cat_content'] );
        // 品牌页或店铺页只有一个分类则默认选中
        if ($args['type_id'] == 0 && ($args["nav_type"] == 2 || $args["nav_type"] == 3)) {
            $count = 0;
            foreach ($data['category']->cat as $key => $value) {
                $count++;
                if ($count == 1) {
                    $defaultTypeId = $key;
                }
            }
            if ($count == 1) {
                $args['type_id'] = $defaultTypeId;
            }
        }
        // 获取广告
        $data['ad'] = $this->rush_model->get_list_ad();
        // 获取供应商品牌
        if ($args['nav_type'] == 3) {
            $data['provider_brand'] = $this->rush_model->get_provider_brand($args['provider_id']);
        }
// 获取商品的一级分类
            $data['front_types'] = $this->rush_model->get_front_types();
            $data['front_types'] = $this->get_rand_types($data['front_types']);

        //取列表
        $cache_key = 'category-' . implode('-', $args );
        $this->cache->delete($cache_key);
        if (($cache_data  = $this->cache->get($cache_key) )=== FALSE) {
                $cache_data  = $this->rush_model->product_list($args );
                //$this->cache->save($cache_key, $cache_data , CACHE_TIME_CATLIST);
        }
		$data['from'] = "1_".$args['type_id'];
		$data['filter'] = $cache_data['filter'];
		$data['product_list'] = $cache_data['list'];
		$data['comment'] = $cache_data['comment'];
		$data['page'] =  $data['filter']['page'];
		$data['pages'] =  $data['filter']['page_count'];
		$data['args'] = $args;
        if ($args['nav_type'] == 1) {
            $data['cat'] = $type;
            $data['nav_type'] = 'category';
        } elseif ($args['nav_type'] == 2) {
            $data['brand'] = $type;
            $data['nav_type'] = 'brand';
        } elseif ($args['nav_type'] == 3) {
            $data['nav_type'] = 'provider';
        }
		//创建分页
		$data['arr_pagelist_num'] = create_pagination(array('pages' => $data['pages'] , 'page' => $data['page'], 'list_num' => 2, 'is_return' => 1));
        if ($args['nav_type'] == 1) {
            if (!empty($type["type_name"])) $data['page_title'] = $type["type_name"] .'_';
        } elseif ($args['nav_type'] == 2) {
            $data['brand'] = $type;
            $data['page_title'] = $type["brand_name"] .'_';
        } elseif ($args['nav_type'] == 3) {
            $data['provider'] = $type;
            $data['page_title'] = $type["display_name"] .'_';
        }
	
        //$this->load->view('category/category', $data);
        if ($this->input->is_ajax_request()) {
            $content = $this->load->view('category/item', $data, true);
            echo json_encode(array('err' => 0, 'content' => $content));
        } else {
            $data['index'] = 1;
            // 这里获取动态的seo
            $this->load->library('lib_seo');
            $seo = $this->lib_seo->get_seo_by_pagetag('pc_category_index', array());
            $data = array_merge($data, $seo);
            
            $this->load->view('category/category2', $data);
        }
    }
    private function get_rand_types($types,$total=20){
            $new_types = array();
            foreach( $types as $i => $type ){
                    if( $i>= $total ) break;
                    $new_types[$i] = array( $type->type_id, $type->type_name ); 
            }
            for( $i++; $i<$total; $i++ )
                    $new_types[$i] = array( '-1', '' );
            shuffle($new_types);
            return $new_types;
    }
}

?>
