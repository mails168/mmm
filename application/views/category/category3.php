<?php include APPPATH."views/common/header.php"; ?>

    <div class="contain">
        <?php if(!isset($type_position)): ?>
        <div class="Mall_list">
            <!-- 过虑条件开始 -->
            <?php if(!empty($category['cat'])): ?>
            <div id="h_filter_cat" class="Mall_common clearfix">
                <div class="j_Brand attr clearfix">
                    <div class="Mall_fenlei"><i class="Mall_commom_ico"></i>分类</div>
                    <div class="Mall_right" style="height: 90px;">
                        <ul class="Mall_xx clearfix">
                            <?php foreach($category['cat'] as $id => $row): ?>
                            <li data-id="<?=$id?>"><a title="<?=$row['name']?>" href="?cat=<?=$id?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$args['page']?>&sort=<?=$args['sort']?>"><b><?=$row['name']?></b></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div id="mall_xx_btn" class="Mall_anniu" style="display: none;">
                            <input id="mall_xx_btn_submit" disabled="disabled" class="Mall_gay Mall_bton_common" type="button" value="确定" />
                            <input id="mall_xx_btn_cancel" class="Mall_bton Mall_bton_common" type="button" value="取消" />
                        </div>
                        <div class="multi-select">
                            <a href="javascript:void(0);" class="Mall_dx">多选<i></i></a>
                            <a href="javascript:void(0);" class="pack_up">更多<i class="up-arrow"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(!empty($category['brand'])): ?>
            <div id="h_filter_brand" class="Mall_common j_nav_brand clearfix">
                <div class="j_Brand attr">
                    <div class="Mall_fenlei"><i class="Mall_commom_ico"></i>品牌</div>
                    <div class="Mall_right showLogo" style="height:133px;">
                        <ul class="Mall_lb_pic clearfix ">
                            <?php foreach($category['brand'] as $id => $row): ?>
                            <li data-id="<?=$id?>"><a title="<?=$row['name']?>" href="?cat=<?=$args['cat']?>&brand=<?=$id?>&price=<?=$args['price']?>&page=<?=$args['page']?>&sort=<?=$args['sort']?>"><img class="lazy" alt="<?=$row['name']?>" data-original="<?=img_url($row['url'])?>"><?=$row['name']?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div id="Mall_lb_btn" class="Mall_anniu" style="display: none;">
                            <input id="Mall_lb_btn_submit" class="Mall_gay Mall_bton Mall_bton_common" disabled="disabled" type="button" value="确定" />
                            <input id="Mall_lb_btn_cancel" class="Mall_bton Mall_bton_common" type="button" value="取消" />
                        </div>
                        <div class="multi-select">
                            <a href="javascript:void(0);" class="Mall_dx">多选<i></i></a>
                            <a href="javascript:void(0);" class="pack_up">更多<i class="up-arrow"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(empty($args['price'])): ?>
            <div class="Mall_common clearfix">
                <div class="j_Brand attr">
                    <div class="Mall_fenlei"><i class="Mall_commom_ico"></i>价格</div>
                    <div class="Mall_right">
                        <ul class="av-price clearfix">
                            <?php foreach($price_range as $price): ?>
                            <li><a href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$price?>&page=<?=$args['page']?>&sort=<?=$args['sort']?>"><?=$price?></a></li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- 过虑条件结束 -->
        </div>
        <?php endif; ?>
            <div class="Mall_list no-bottom">
                <?php if(isset($type_position)){echo $type_position;} ?>
                <!-- 排序开始 -->
                <div class="filter clearfix">
                    <a href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$args['page']?>&sort=0" class="mall_category">综合<i class="<?=($args['sort']== 0)? 'mall_category_light' : 'mall_category_default'; ?> mall_category_light"></i></a>
                    <a href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$args['page']?>&sort=<?=($args['sort']==9 ? 8 : 9)?>" class="mall_category">人气<i class="<?=($args['sort']== 8 || $args['sort'] == 9)? 'mall_category_light' : 'mall_category_default'; ?> mall_category_light"></i></a>  
                    <a href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$args['page']?>&sort=<?=($args['sort']==10 ? 0 : 10)?>" class="mall_category">新品<i class="<?=($args['sort']== 10)? 'mall_category_light' : 'mall_category_default'; ?> mall_category_light"></i></a>
                    <a href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$args['page']?>&sort=<?=($args['sort']==7 ? 6 : 7);?>" class="mall_category">销量<i class="<?=($args['sort']== 6 || $args['sort'] == 7)? 'mall_category_light' : 'mall_category_default'; ?> mall_category_light"></i></a>
                    <a href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$args['page']?>&sort=<?=($args['sort']==5 ? 0 : ($args['sort']==4? 5 : 4));?>" class="mall_category fSort-cur">价格
                  <i class="f-ico-triangle-mt <?=($args['sort']==4)? ' mall-price-down' : ' mall-price-mr ' ?>"></i>
                        <i class="f-ico-triangle-mb <?php if($args['sort']==5): ?> mall-price-top <?php endif; ?>"></i>
                    </a>
                    <div id="Mallfeilei"<?php if(empty($category['filter_type'])): ?> style="display: none;"<?php endif; ?> class="screening-lb">
                        <?php if(!empty($category['filter_type'])): ?><a href="?cat=0&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$args['page']?>&sort=<?=$args['sort']?>" title="<?=implode(",", $category['filter_type']['title'])?>">
                        <?php endif; ?>    
                        <span class="screening">
                            <em>分类：</em>
                            <span><?php if(!empty($category['filter_type'])): ?><?=implode(",", $category['filter_type']['display'])?><?php endif; ?></span>
                        </span>
                        <i class="screening_close"></i></a>
                        <?php if(!empty($category['filter_type'])): ?>
                         </a>
                        <?php endif; ?>
                    </div>
                    <div id="MallPinpai"<?php if(empty($category['filter_brand'])): ?> style="display: none;"<?php endif; ?> class="screening-lb">
                        <?php if(!empty($category['filter_brand'])): ?><a href="?cat=<?=$args['cat']?>&brand=0&price=<?=$args['price']?>&page=<?=$args['page']?>&sort=<?=$args['sort']?>" title="<?=implode(",", $category['filter_brand']['title'])?>">
                        <?php endif; ?>
                        <span class="screening">
                            <em>品牌：</em>
                            <span><?php if(!empty($category['filter_brand'])): ?><?=implode(",", $category['filter_brand']['display'])?><?php endif; ?></span>
                        </span>
                        <i class="screening_close"></i>
                        <?php if(!empty($category['filter_brand'])): ?>
                         </a>
                        <?php endif; ?>
                   </div>
                    <div<?php if(empty($args['price'])): ?> style="display: none;"<?php endif; ?> class="screening-lb">
                        <?php if(!empty($args['price'])): ?><a href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=0&page=<?=$args['page']?>&sort=<?=$args['sort']?>" title="<?=$args['price']?>">
                        <?php endif; ?>
                        <span class="screening">
                            <em>价格：</em>
                            <span><?php if(!empty($args['price'])): ?><?=$args['price']?><?php endif; ?></span>
                        </span>
                        <i class="screening_close"></i>
                        <?php if(!empty($args['price'])): ?>
                         </a>
                        <?php endif; ?>
                   </div>
                    <?php if(!empty($category['filter_type']) || !empty($category['filter_brand']) || !empty($args['price'])): ?>
                    <a href="/category"><span class="qingkong">清空全部筛选</span></a>
                    <?php endif; ?>
                    <p class="ui-page-s">
                        <b class="ui-page-s-len"><?=$page?>/<?=$pages?></b>
                        <?php if($page <= 1){ ?>
                        <b title="上一页" class="ui-page-s-prev">&lt;</b>
                        <?php }else{ ?>
                        <a href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$filter['page']-1?>&sort=<?=$args['sort']?>" class="ui-page-s-prev">&lt;</a>
                        <?php } ?>    
                        <?php if($page>=$pages){ ?>
                        <b title="下一页" class="ui-page-s-next" href="javascript:void(0);">&gt;</b>
                            <?php }else{ ?>
                            <a title="下一页" class="ui-page-s-next" href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$filter['page']+1?>&sort=<?=$args['sort']?>">&gt;</a>
                        <?php } ?>
                    </p>                    
                </div>
                <!-- 排序结束 -->
                <!-- 商品列表开始 -->
                <ul class="mall_pro_list clearfix">
                    <?php foreach($product_list as $product): ?>
                    <li id="goods-<?=$product->product_id?>">
                    <a href="/pdetail-<?php print $product->product_id;?>.html">
                         <div class="mall_pro-img"><img class="lazy" data-original="<?php print img_url($product->img_url.".220x220.jpg?v=2"); ?>" alt="" /></div>
                         <div class="mall_pro-mc"><span><?php print $product->brand_name;?></span><?php print $product->product_name;?></div>
                         <div class="mall_pro-sprice"><?php if($product->price_show): ?><i>询价</i><?php else: ?><i>¥</i><?php print $product->shop_price; ?><span><i>¥</i><em><?php print $product->market_price; ?></em></span><?php endif; ?></div>
                    </a>
                    
                   </li>
                   <?php endforeach; ?>                 
                </ul>
                <!-- 商品列表结束 -->
            <!-- 分页开始 -->
            <?php if ($pages > 1) { ?>
                <div class="ui-page clearfix">
                    <div class="ui-page-wrap">                        
                        <b class="ui-page-num">                            
                            <?php if ($page <= 1) { ?>
                            <b class="ui-page-prev">&lt;&lt;上一页</b>
                            <?php } else { ?>
                            <a class="ui-page-prev" href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$filter['page']-1?>&sort=<?=$args['sort']?>">&lt;&lt;上一页</a>
                            <?php } ?>                         
                            
                            <?php foreach ($arr_pagelist_num as $arr_list_num): ?>
                                <?php if ($arr_list_num == "...") { ?>
                                    <b class="ui-page-break">...</b>
                                <?php } ?>
                                <?php if ($arr_list_num == $page) { ?>
                                    <b class="ui-page-cur"><?= $arr_list_num ?></b>
                                <?php } elseif ($arr_list_num != "...") { ?>
                                    <a href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$arr_list_num?>&sort=<?=$args['sort']?>"><?= $arr_list_num ?></a>
                                <?php } ?>
                            <?php endforeach; ?>
                            
                            <?php if ($page >= $pages) { ?>
                            <b class="ui-page-next">下一页&gt;&gt;</b>
                            <?php } else { ?>
                            <a class="ui-page-next" href="?cat=<?=$args['cat']?>&brand=<?=$args['brand']?>&price=<?=$args['price']?>&page=<?=$filter['page']+1?>&sort=<?=$args['sort']?>">下一页&gt;&gt;</a>
                            <?php } ?>
                        </b>                        
                        <b class="ui-page-skip">
                            <form name="filterPageForm" method="get">
                                <input type="hidden" name="cat" value="<?=$args['cat']?>">
                                <input type="hidden" name="brand" value="<?=$args['brand']?>">
                                <input type="hidden" name="price" value="<?=$args['price']?>">
                                <input type="hidden" name="sort" value="<?=$args['sort']?>">
                                共<?=$pages?>页，到第
                                <input type="text" class="ui-page-skipTo" size="3" name="page" value="<?=$page?>"/>页
                                <button type="submit" class="ui-btn-s">确定</button>
                            </form>
                        </b>                       
                        
                    </div>
                </div>
            <?php } ?>   
            <!-- 分页结束 -->    

            </div>
        <?=$recomd_html?>
        
    </div>
 
<?php include APPPATH . 'views/user/login_box.php'?>
<div id="cart_success" class="cd-popup">
    <div class="cd-popup-container">
        <div class="detel-tit">提示</div>
        <div class="cart-bg">
            <div class="cart-bg-jl">
                <p class="cart-del-wz">商品已成功加入购物车！</p>
                <div class="cart-btn">
                    <a href="javascript:void(0);" class="determine" onclick="submit_address_close();">确定</a><a href="/cart/index.html" class="see-you">去购物车结算</a>
                </div>
            </div>
        </div>
        <a href="javascript:void(0);" class="cd-popup-close"></a>
    </div>
</div>
<?php include APPPATH.'views/common/footer.php'; ?>
<script type="text/javascript" src="<?php echo static_style_url('new_pc/js/mall.js?v=version');?>"></script>
<script type="text/javascript">
var last_submit_time = 0;
$(document).on('mouseover', '.Mall_list .mall_pro_list li', function (e) {
    if(new Date().getTime() - last_submit_time < 10000){
        return false;
    }
    var v_parent = $(this);
    var is_ajax = $('div', v_parent).hasClass('mall-cart_hover');
    if (is_ajax) return false;
    var gid = parseInt(v_parent.attr('id').replace(/goods-/, ''));
    last_submit_time = new Date().getTime();
    $.ajax({
        url:'cart/get_product_sizes/'+gid,
        data:{rnd:new Date().getTime()},
        dataType:'json',
        type:'POST',
        success:function(result){
            last_submit_time = 0;
            if (result.msg) {$('.car_pro_c').html(result.msg);}
            if (result.err) {return false;}
            if (result.html) {v_parent.append(result.html);}
        },
        error:function()
        {
            last_submit_time = 0;
        }
    });
});

$(document).on('click', '.Mall_add_orange', function (e) {
    if(!checkLogin(false)){
        //打开登录窗口
        $('.cd-popup6').addClass('is-visible6');       
        return false;
    }
    var parent_obj = $(this).parent().siblings('.mall_cart_xx');
    var sid;
    var sub_ids = '';
    $(".sel_size_yes", parent_obj).each(function(i, obj){
        sid = $(obj).attr('data-subid');
        sub_ids += $(obj).attr('data-subid') + '=1' + '|';
    });
    
    if(sub_ids == ''){
        alert('您还没有选择规格！');
        return;
    }
    
    $.ajax({
            url:'/cart/add_mutlit_subs_to_cart',
            data:{sub_ids:sub_ids.substr(0, sub_ids.length -1 )},
            dataType:'json',
            type:'POST',
            success:function(result){
                if(result.err == 2){
                    $('.cd-popup6').addClass('is-visible6');          //登录弹层
                    return;
                }
                if(result.msg) console.log(result.msg);
                $('#cart_success').addClass('is-visible');   //购物车成功提示弹层
                update_cart_num();
            },
            error:function(err) {
                console.log(err);
            }
    });
});

//选择规格
var sel_size_yes = function(id,e){console.log(id)
    var el = $('#rec_id'+id);
    el.toggleClass("sel_size_yes");
}

//购物车按钮鼠标效果
$(document).on('mouseover mouseout', '.Mall_add_acrt', function (e) {
    $(this).toggleClass('Mall_add_orange');
});
//关注鼠标效果
$(document).on('mouseover mouseout', '.focus_common', function (e) {
    var has_star = $(this).has('i').length;
    if (!has_star) return;
    if(event.type == "mouseover"){
        $(this).removeClass('Mall_focus').addClass('Mall_focus_white');
        //$(this).find("i").removeClass('focus-orange').addClass('focus-white');
    }else if(event.type == "mouseout"){
        $(this).removeClass('Mall_focus_white').addClass('Mall_focus');
        //$(this).find("i").removeClass('focus-white').addClass('focus-orange');
    }
});
</script>
