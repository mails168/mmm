<?php include APPPATH . 'views/common/header.php'?>
<div class="contain">
    <div class="pro_detail_inner">
        <span class="current-position">当前位置：<a href="/">首页</a>-<a href="/category" class="current-color">悦牙商城</a>-<a href="/category?cat=<?php echo $p->category_id1; ?>"><?php echo $p->category_name1; ?></a>-<a href="/category?cat=<?php echo $p->category_id2; ?>"><?php echo $p->category_name2; ?></a></span>
        <div class="pro_detail_list clearfix">
            <div class="prodetail-pic">
                <div id="showbox">
                <?php foreach ($g_list as $colorId => $v): ?>
                    <?php foreach ($v as $k => $item): ?>
                        <?php if ($k =='default') { ?>  
                            <li><img src="<?php echo img_url($item->img_url);?>" alt="<?php echo $p->brand_name.$p->product_name;?>" width="418" height="418"></li>
                        <?php }elseif($k =='part'){ foreach ($item as $val) { ?>
                            <li><img src="<?php echo img_url($val->img_url);?>" alt="<?php echo $p->brand_name.$p->product_name;?> " width="418" height="418"></li>
                        <?php } } ?>                                
                    <?php endforeach; ?>
                <?php endforeach; ?>
                </div>
                <div id="showsum"></div>
                    <p class="showpage">
                        <a href="javascript:void(0);" id="showlast"> < </a>
                        <a href="javascript:void(0);" id="shownext"> > </a>
                    </p>
                </div>
            
            <div class="pro-detail-yb">
                <h2><?php echo $p->brand_name  . ' ' . $p->product_name; ?></h2>
                <p class="zhenghao"><?php echo isset($product_register[0]['register_no']) ? '注册证号：' . $product_register[0]['register_no'] : '';?></p>
                <p class="zhenghao"><?php echo isset($p->product_sn) ? '商品编号：' . $p->product_sn : ''; ?></p>
                <div class="pro-detail_bg clearfix">
                    <div class="pro-detail_jl">
                        <div class="detail_prcie clearfix">
                        	<span class="detail_jg">价格</span>
                         	<?php if (1 == $p->price_show) { ?>
                            <span class="detail_sz">待定</span>
                            <?php }else{  ?>
                            <span class="detail_sz"><i>￥</i><?php echo $p->product_price; ?></span>
                            <i class="zhekou"><?php echo $p->discount_percent; ?>折</i>
							<?php } ?>
                        </div>

                        <div class="detail_prcie clearfix" style="padding-top: 15px;">
                            <span class="detail_cx">促销</span>
                            <?php if(1 == $p->price_show):?>
                            请与在线客服联系报价。谢谢！
                            <?php else:?>
                            <span class="detail_yj"><i class="zhekou2">折扣</i>原价<?php echo $p->market_price; ?>现价<?php echo $p->product_price; ?>，享<?php echo $p->discount_percent; ?>折</span>
                            <span class="cx fr">共1条促销信息</span>
                        	<?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="model clearfix">
                    <span>型号</span>
                    <div class="model_xinghao">
                    	
                    	<input type="hidden" id="cur_sub_id" value="<?=($default_sub_id > 0) ? $sub_list[$color_id]['sub_list'][$default_sub_id]->sub_id : 0;?>">
                        <input type="hidden" id="cur_sub_num" value="<?=($default_sub_id > 0) ? $sub_list[$color_id]['sub_list'][$default_sub_id]->sale_num : 0;?>">

                    	<?php if(isset($sub_list) && !empty($sub_list)): ?>
						<?php foreach($sub_list[$color_id]['sub_list'] as $k => $v): ?>
                            <a href="javascript:void(0);" class="<?php if($v->sale_num): ?> buy_size <?php echo $default_sub_id == $k ? ' model_current' : ''?><?php else:?> sel_size_no <?php endif; ?>" data-id="<?=$v->sub_id?>" data-val="<?=$v->sale_num?>"><?php echo $v->size_name; ?></a>
						<?php endforeach; ?>
						<?php endif; ?>
                    </div>
                </div>
                <div class="detail_number clearfix">
                    <span>数量</span>
                    <div class="number_lb clearfix">
                        <div class="number_reduction btn-minus"></div>
                        <input type="text" name="number" title="请输入购买量" maxlength="3" value="1" class="mui-amount-input buy_num">
                        <div class="number_add btn-plus"></div>
                    </div>
                </div>
                <div class="detail_add_cart  share-icon">
                	<?php if (1 == $p->price_show) { ?>
                	<div class="add_cart_jl">
                        <div class="xunjia">询价</div>
                    </div>
					<?php }else{  ?>
                    <div class="add_cart_jl">
                        <div class="detail_jiaru product-btn-cart"><i class="add_cart2"></i>加入购物车</div>    
                        <div class="detail_jiaru product-btn-hint" disabled style="display:none">暂无库存</div>           
						<?php if((!empty($collect_data) && deep_in_array($p->product_id, $collect_data))){ ?>
                        <div class="collection cart_common_bg"><i class="collection_ico"></i>已收藏</div>
						<?php }else{ ?>
                        <div class="collection cart_common_bg bdr-r2" onclick="add_to_collect (<?php echo $p->product_id; ?>,0,this);"><i class="collection_ico"></i>收藏</div>
                        <?php } ?>
                        <div class="detail_share cart_common_bg bdr-r2 bdsharebuttonbox">
                       		<a href="javascript:void(0);" class="bds_more share_ico" data-cmd="more">分享</a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="recommended_goods clearfix" style="display:none;">
            <div class="recommended_tit"><i class="recommended_ico"></i><?php echo $p->brand_name.$p->product_name; ?>已加入您的购物车！</div>
            <?php if(!empty($link_product_list)){ ?>
            <span class="yayi">其他牙医还购买了：</span>
            <ul class="recommended_lb clearfix">
				<?php foreach ($link_product_list as $val_link) { ?>
                <li>
                    <a href="/pdetail-<?php echo $val_link->product_id; ?>.html">
                        <div class="mall_pro-img">
                            <img src="<?php echo img_url($val_link->img_url); ?>" alt="<?php echo $val_link->product_name; ?>" />
                        </div>
                        <div class="mall_pro-mc"><span><?php echo $val_link->brand_name; ?></span><?php echo $val_link->product_name; ?></div>
                        <div class="mall_pro-sprice"><i>¥</i><?php echo $val_link->product_price; ?><span><?php echo $val_link->market_price; ?></span></div>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>

        <div class="prodetail_tab">
            <div class="prodetail_click">
                <ul class="prodetail_tab_lb">
                    <li onclick="click_scroll(this,'shangpinxiangqin');" class="tab_current">商品详情</li>
                    <li onclick="click_scroll(this,'ceshishipin');">测试视频</li>
                    <li onclick="click_scroll(this,'shangpinpingjia');">商品评价(<?php echo $liuyan_list['filter']['record_count'];?>)</li>
                    <a href="javascript:void(0);" class="prodetail_tab_add product-btn-cart">加入购物车</a>
                </ul>
            </div>
            <div id="shangpinxiangqin" class="shangpinxiangqin">
                <table width="1200" border="0">
                    <tbody>
                        <tr>
                            <td style="background-color: #fafafa; width: 100px;">品牌</td>
                            <td><?php echo $p->brand_name; ?></td>
                            <td style="background-color: #fafafa; width: 100px;">产品标准</td>
                            <td><?php echo $product_register[0]['standard']; ?></td>
                            <td style="background-color: #fafafa; width: 100px;">适用范围</td>
                            <td>
                                <?php if(mb_strlen($product_register[0]['scope']) > 40) {  echo mb_substr($product_register[0]['scope'],0,35).'...'; ?>
                                <a href="javascript:void(0);" class="xiangxi"><i class="xiangxi_ico"></i>详细</a>                               
                                <div class="xiangxi_inner" style="display:none;">
                                    <?php echo $product_register[0]['scope']; ?>
                                </div>   
                                <?php } else { ?>
                                     <?php echo $product_register[0]['scope']; ?>
                                <?php } ?> 
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #fafafa; width: 100px;">重量</td>
                            <td><?php echo $p->product_weight; ?>克</td>
                            <td style="background-color: #fafafa; width: 100px;">性能及组成</td>
                            <td>
                                <?php if(mb_strlen($product_register[0]['property']) > 40) {  echo mb_substr($product_register[0]['property'],0,35).'...'; ?>
                                <a href="javascript:void(0);" class="xiangxi"><i class="xiangxi_ico"></i>详细</a>                               
                                <div class="xiangxi_inner" style="display:none;">
                                    <?php echo $product_register[0]['property']; ?>
                                </div>   
                                <?php } else { ?>
                                    <?php echo $product_register[0]['property']; ?>
                                <?php } ?> 
                            </td>
                            <td style="background-color: #fafafa; width: 100px;">计量单位</td>
                            <td><?php echo $p->unit_name; ?></td>
                        </tr>
                    </tbody>
                </table>
                
                <?php echo $p->detail1;?>
            </div>
            <div id="ceshishipin" class="test_video">
                <span class="test_video_bt">测试视频</span>
                <?php echo $p->detail2;?>
            </div>
            <div id="shangpinpingjia" class="cumulative">
                <span class="test_video_bt">累计评价(<?php echo $liuyan_list['filter']['record_count'];?>)</span>
                <ul class="cumulative_list">
                    <?php foreach ($liuyan_list['list'] as $val_liuyan) { ?>
                    <li>
                        <div class="column1">
                            <div class="grade-star g-star<?php echo ($val_liuyan->grade == 0) ? '5' : $val_liuyan->grade ;?>"></div>
                            <div class="comment-time"><?php $val_liuyan->comment_date;?></div>
                        </div>
                        <div class="column2">
                            <?php echo $val_liuyan->comment_content;?>
                        </div>
                        <div class="column3">型号：默认</div>
                        <div class="column4"><?php echo ($val_liuyan->user_id == 0 || $val_liuyan->user_name == '') ? '悦***网（匿名）' : $val_liuyan->user_name ;?></div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- <div class="ui-page prddetail_page clearfix">
             <div class="ui-page-wrap">
                  <b class="ui-page-num">
                      <b class="ui-page-prev">&lt;&lt;上一页</b>
                      <b class="ui-page-cur">1</b>
                      <a href="#">2</a>
                      <a href="#">3</a>
                      <b class="ui-page-break">...</b>
                     <a class="ui-page-next" href="#">下一页&gt;&gt;</a>
                </b>
            </div>
        </div> -->
    </div> 
</div>
<?=$recommend_html?>
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
<div id="cart_buy_num" class="cd-popup">
    <div class="cd-popup-container">
        <div class="detel-tit">提示</div>
        <div class="cart-bg">
            <div class="cart-bg-jl">
                <p class="cart-del-wz">单次结算商品最多不超过200件，若需购买更多时请分单结算或者联系客服人员。谢谢！</p>
                <div class="cart-btn">
                    <a href="javascript:void(0);" class="determine" onclick="submit_address_close();">确定</a>
                </div>
            </div>
        </div>
        <a href="javascript:void(0);" class="cd-popup-close"></a>
    </div>
</div>
<?php include APPPATH . 'views/common/footer.php'?>
<script type="text/javascript">
var v_price_show = '<?php echo $p->price_show?>';
</script>
<script src="<?php echo static_style_url('new_pc/js/pdetail.js?v=version2');?>"  type="text/javascript"></script>

<script>
    $(document).ready(function(){
        var showproduct = {
            "boxid":"showbox",
            "sumid":"showsum",
            "boxw":440,//宽度,该版本中请把宽高填写成一样
            "boxh":440,//高度,该版本中请把宽高填写成一样
            "sumw":85,//列表每个宽度,该版本中请把宽高填写成一样
            "sumh":85,//列表每个高度,该版本中请把宽高填写成一样
            "sumi":4,//列表间隔
            "sums":4,//列表显示个数
            "sumsel":"sel",
            "sumborder":1,//列表边框，没有边框填写0，边框在css中修改
            "lastid":"showlast",
            "nextid":"shownext"   
        };//参数定义    
        $.ljsGlasses.pcGlasses(showproduct);//方法调用，务必在加载完后执行
    });
</script>