<?php include APPPATH . 'views/common/header.php'?>

<div class="contain">
     <div class="pro_detail_inner">
          <!-- <span class="current-position">当前位置：<a href="#">首页</a>-<a href="#" class="current-color">悦牙讲堂</a>-<a href="#">种植及牙周美容手术设计与应对策略</a></span> -->
          <div class="pro_detail_list clearfix">
               <div class="course-pic"><img src="<?php echo img_url(current($g_list)['default']->img_url)?>" width="418" height="418" alt="<?php echo isset($ititle) ? $ititle : ''?>"/></div> 
               <div class="pro-detail-yb course-yb">
                    <h2><?php echo isset($ititle) ? $ititle : ''?></h2>
                    <p class="course-xx">时间：<?php echo date("Y.m.d", strtotime($p -> package_name)); ?>
									<?php if (isset($product_desc_additional['desc_waterproof'])) echo '-' . date("Y.m.d", strtotime($product_desc_additional['desc_waterproof']))?></p>
                    <p class="course-xx">地点：<?if (isset($product_desc_additional['desc_crowd'])) echo $product_desc_additional['desc_crowd']?></p>
                    <p class="course-xx">讲师：<?=$p -> subhead ?></p>
                    <p class="course-xx">报名：<?=$p -> ps_num ?>人<?php if($sub_list[$color_id]['sub_list'][0]->consign_num == -2):?>
								/人数不限制							
							<?php else:?>
								<?php echo '/' . $sub_list[$color_id]['sub_list'][0]->consign_num . '人'?>
							<?php endif; ?></p>
                    <p class="course-xx">关注：<?php echo get_page_view('course', $p -> product_id); ?></p>
                    <div class="detail_add_cart course-bm">
                        <div class="add_cart_jl clearfix">
                             <div class="course-det-price">￥<?php echo $p->product_price?></div>
                             
                             <?php if(!$is_outofdate && !$is_exceed_num):?>							
                                    <div class="course-det-bm bdr-r3 product-btn-baoming">我要报名</div>
                            <?php else:?>
                                    <div class="course-det-bm bdr-r3 product-dis-baoming">该课程已结束</div>
                            <?php endif;?>
                             <div class="cart_common_bg bdr-r3"><?php if($is_collected): ?>已关注<?php else: ?><i class="collection_ico"></i>关注<?php endif; ?></div>
                        </div>
                    </div>
             </div>
        </div>
        
        <div class="prodetail_tab">
                <div class="prodetail_click">
                    <ul class="prodetail_tab_lb">
                        <li onclick="click_scroll(this,'shangpinxiangqin');" class="tab_current">课程详情</li>
                        <li onclick="click_scroll(this,'ceshishipin');">讲师简介</li>
                        <li onclick="click_scroll(this,'shangpinpingjia');">案列展示</li>
                        <li onclick="click_scroll(this,'lianxifangshi');">联系方式</li>
                        <a href="#" class="prodetail_tab_add">我要报名</a>
                    </ul>
                </div>
                <div id="shangpinxiangqin" class="shangpinxiangqin">
                    

                </div>

                <div id="ceshishipin" class="test_video">
                    <span class="test_video_bt">讲师简介</span>
                    <?php echo $p -> product_desc; ?>
					<?php echo $p -> detail1; ?>
                </div>

                <div id="shangpinpingjia" class="cumulative">
                    <span class="test_video_bt">案例展示</span>
                    <?php echo $p -> detail2; ?>
                </div>
                
                <div id="lianxifangshi" class="cumulative">
                    <span class="test_video_bt">联系方式</span>
                    <?php echo $p->detail4?>
                </div>
                
        </div>
   </div>
</div>
	
<?php include APPPATH . 'views/user/login_box.php'?>
<?php include APPPATH . 'views/common/footer.php'?>

<script src="<?php echo static_style_url('new_pc/js/pdetail.js?v=version');?>"  type="text/javascript"></script>
<script type="text/javascript">
var cur_sub_id = '<?=$sub_list[$color_id]['sub_list'][0]->sub_id?>';

$('.product-btn-baoming').click(function() {
	if (!checkLogin(false)) {
            $('.cd-popup6').addClass('is-visible6');
            return;            				
	};
	var sub_id = cur_sub_id;
	window.location.href = '/cart/checkout_course/' + sub_id;
});    
</script>