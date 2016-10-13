<?php

// 商品辅助函数
function format_product(&$p)
{
	static $now;
	if(!$now) {
		$CI = &get_instance();
		$now = time();//$CI->time
	}
//	$p->is_promote = $p->is_promote && strtotime($p->promote_start_date)<=$now && strtotime($p->promote_end_date)>=$now ;
	$p->is_promote = $p->is_promote && strtotime($p->promote_start_date)<=$now && strtotime($p->promote_end_date)>=$now ;
	$p->product_price = $p->is_promote ? $p->promote_price : $p->shop_price;
	$p->save_price = $p->market_price - $p->product_price;
	$p->discount_percent = round($p->product_price/max($p->market_price,0.01)*10,1);
//	$p->sale_finish = ($p->consign_num == -2) || ($p->consign_num == -1 && $p->gl_num > 0 ) || 
//		($p->consign_num >= 0 && ($p->gl_num + $p->consign_num - $p->wait_num) >0 )  ? "":"img_yishouwan";
	$p->tag='';
	//.img_zengpin
//	if (!empty($p->is_promote)) {//去点促销log显示
//		$p->tag='img_cuxiao';
//	}else
	
	if (!empty($p->is_hot)) {
		$p->tag='img_rexiao';//rx.png //tagHotSale
	}elseif (!empty($p->is_best)) {
		$p->tag='img_qingcang';
	}elseif (!empty($p->is_new)) {
		$p->tag='img_xinpin';//xp.png //img_xinpin
	}elseif (!empty($p->is_offcode)) {//2013/3/30:is_offcode[old:img_duanma],[new:img_cuxiao]显示为促销
		$p->tag='img_cuxiao';
	}elseif (!empty($p->is_gifts)) {
	    $p->tag='img_zengpin';
	}
}

function format_sub(&$sub)
{
	$sub->sale_num = $sub->consign_num==-2?-2:(MAX($sub->consign_num,0)+MAX($sub->gl_num-$sub->wait_num,0));
}

function unpack_package_config($config)
{
	if(empty($config)) return array();
	$result = array();
	$config = explode('&&&', $config);
	foreach ($config as $item) {
		$item = explode('|||', $item);
		if (count($item)!=4) continue;
		$result[] = $item;
	}
	return $result;
}

//分类商品列表页link
function cat_link($param,$change)
{
	$param = array_merge($param,$change);
	return 'category-'.implode('-',$param).'.html';
}
//rush列表页link
function rush_link($param,$change)
{
	$param = array_merge($param,$change);
	return 'rush-'.implode('-',$param).'.html';
}

//品牌商品列表页link
function brand_link($param,$change)
{
	$param = array_merge($param,$change);
	return 'brand-'.implode('-',$param).'.html';
}
//导航商品列表页link
function nav_link($param,$change)
{
	$param = array_merge($param,$change);
	return 'nav-'.implode('-',$param).'.html';
}
function search_link($param,$change){
	$param = array_merge($param,$change);
	return 'search.html?kw='.urlencode($param['kw']).'&sex='.$param['sex'].'&age='.$param['age'].'&sort='.$param['sort'].'&page='.$param['page'];
}

/**
 * 获取预计发货时间 
 */
function get_expected_shipping_date($product_desc_additional = ''){
    $expected_shipping_date = EXPECTED_SHIPPING_DATE;
    if(!empty($product_desc_additional) ){
	$tmp = json_decode($product_desc_additional, true);
	if (!empty($tmp['desc_expected_shipping_date'] )){
	    $expected_shipping_date = $tmp['desc_expected_shipping_date'];
	}
    }
    return $expected_shipping_date;
}
/**
 * decode商品附加详细信息
 * @param type $product_desc_additional
 * @return type 
 */
function get_product_desc_additional($product ){//->product_desc_additional
    $pro_additional = array();
    $tmp_pro = isset($product->product_desc_additional) ? json_decode($product->product_desc_additional, true):"";
    if( !empty($tmp_pro) ){
	$pro_additional[0] = array("name"=>'商品名称',"desc"=>$product->brand_name." / ".$product->product_name );
	$i = 1;
	foreach ($tmp_pro as $key => $val ) {
	    $name = '';
	    if ($key == 'desc_composition'){//desc_composition(成分)、
		$name = '成分';
	    }else if($key == 'desc_dimensions'){//desc_dimensions(尺寸规格)、
		$name = '尺寸规格';
	    }else if($key == 'desc_material'){//desc_material(材质)
		$name = '材质';
	    }else if($key == 'desc_waterproof'){//desc_waterproof(防水性)
		$name = '防水性';
	    }else if($key == 'desc_crowd'){//desc_crowd(适合人群)
		$name = '适合人群';
	    }else if($key == 'desc_notes'){//desc_notes(温馨提示)
		$name = '温馨提示';
        }else if($key=='desc_use_explain'){
        $name='使用说明';
        }else if($key=='desc_function_explain'){
        $name='功能说明';
        }
        else {
		continue;
	    }
	    $pro_additional[$i++] = array("name"=>$name ,"desc"=>$val );
	}
    }else {
	$default_desc = "暂无";
	$pro_additional = array(
	    array("name"=>'商品名称',"desc"=>$product->brand_name." / ".$product->product_name ),
	    array("name"=>"成分" ,"desc"=>$default_desc ), 
	    array("name"=>"尺寸规格" ,"desc"=>$default_desc ), 
	    array("name"=>"材质" ,"desc"=>$default_desc ), 
	    array("name"=>"防水性" ,"desc"=>$default_desc ), 
	    array("name"=>"适合人群" ,"desc"=>$default_desc ), 
	    array("name"=>"温馨提示" ,"desc"=>$default_desc ) );
    }
    return $pro_additional;
}
//推荐商品&浏览过的商品
function get_recommend_data($filter = array()){
    $CI = & get_instance();
    $CI->load->model('region_model');
    if (isset($filter['category_ids'])){
        $recommend_goods = $CI->product_model->get_relation_product($filter['category_ids']);//取购物车中商品分类相关商品
    } else {
        $recommend_goods = $CI->product_model->get_hot_product(1);//取is_hot为1的商品
    }
    shuffle($recommend_goods);
    $recommend_goods=array_slice($recommend_goods,0,5);
    $reco_html = '<ul class="mall_pro_list clearfix">';
    foreach ($recommend_goods as $product){
        format_product($product);
        $reco_html .= '<li>
                        <a href="/pdetail-'.$product->product_id.'.html">
                           <div class="mall_pro-img"><img src="'.img_url($product->img_url.".220x220.jpg").'" alt="" /></div>
                           <div class="mall_pro-mc"><span>'.$product->brand_name.'</span>'.$product->product_name.'</div>
                           <div class="mall_pro-sprice"><i>¥</i>'.$product->product_price.'<span><i>¥</i><em>'.$product->market_price.'</em></span></div>
                        </a>
                    </li>';
    }
    $reco_html .= '</ul>';
    $reco_html .= '<ul class="mall_pro_list clearfix" style="display:none;">';
    // 浏览过的商品
    $cookie_product = $CI->input->cookie('recentBrowseProd');
    if (!empty($cookie_product)){
        $view_product = $CI->product_model->get_search_product(array('ids' => $cookie_product));
        foreach ($view_product as $product){
        	format_product($product);
            $reco_html .= '<li>
                            <a href="/pdetail-'.$product->product_id.'.html">
                               <div class="mall_pro-img"><img src="'.img_url($product->img_url.".220x220.jpg?v=2").'" alt="" /></div>
                               <div class="mall_pro-mc"><span>'.$product->brand_name.'</span>'.$product->product_name.'</div>
                               <div class="mall_pro-sprice"><i>¥</i>'.$product->product_price.'<span><i>¥</i><em>'.$product->market_price.'</em></span></div>
                            </a>
                           </li>';            
        }
    }
    $reco_html .= '</ul>';
    $html = <<<EOD
            <div class="recommend">
                <ul class="recommend-top">
                    <li class="sp_current">推荐商品</li>
                    <li>历史记录</li>
                </ul>
                <div>
                {$reco_html}
                </div>
            </div>    
EOD;
    return $html;
}

//推荐商品&浏览过的商品
function get_history(){
    $CI = & get_instance();
    // 浏览过的商品
    $cookie_product = $CI->input->cookie('recentBrowseProd');
    
    if (!empty($cookie_product)){
        $view_product = $CI->product_model->get_search_product(array('ids' => $cookie_product));
        foreach ($view_product as $product){
        	format_product($product);
        	$history_html .= '<div class="imp_item"><a href="/pdetail-' . $product->product_id . '" class="pic"><img src="' . img_url($product->img_url.".220x220.jpg"). '" width="100" height="100"></a><p class="tit"><a href="#">' . $product->product_name . '</a></p><p class="price"><em>￥</em>' . $product->product_price . '</p><a href="#" class="imp-addCart">加入购物车</a></div>';
        }
    }
    
    
    return $history_html;
}