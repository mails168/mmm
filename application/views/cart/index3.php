<?php include APPPATH."views/common/header3.php"; ?>
<div class="contain">
    <div class="Mall_list">
        <div class="common_cart_pic cart_header_ico"></div>
            <div class="shopping_cart">
                <span class="quanbu">全部商品<span id="cart_num"><?php print $cart_summary['product_num']; ?></span></span>
                <div class="yy_cart">
                    <div class="cart_head clearfix">
                       <div class="cart_column t_checkbox">
                           <div class="cart_checkbox">
                               <input type="checkbox" name="selectall1" class="yycheckbox selectall"  <?php if(!empty($cart_summary['product_list'])): ?> checked<?php endif; ?>/>
                           </div>
                           全选
                       </div>
                        <div class="cart_column cart_goods">商品</div>
                        <div class="cart_column cart_dj">单价(元)</div>
                        <div class="cart_column cart_quantity">数量</div>
                        <div class="cart_column cart_sum">小计(元)</div>
                        <div class="cart_column cart_action">操作</div>
                    </div>
                    <div class="cart_list clearfix">
                        <div class="cart_top clearfix">
                            <?php if(!empty($cart_summary['product_list'])): ?>
                             <?php 
                             $i = 0;
                             foreach ($cart_summary['product_list'] as $provider): ?>
                             <?php foreach ($provider['product_list'] as $product): ?>
                            <div class="shopping_common<?php if($i%2 == 0): ?> shopping_orange<?php endif; ?> c_rec<?=$product->rec_id?>">
                                <div class="cart_cell p_checkbox">
                                    <div class="cart_checkbox">
                                        <input type="checkbox" class="yycheckbox chooseone" data-pid="<?php print $product->product_id; ?>-<?php print $product->rec_id; ?>" value="<?php print $product->rec_id; ?>" name="rec_id[]" checked>
                                   </div>
                                </div>
                                <div class="cart_cell cart_goods clearfix">
                                    <div class="cart_img"><a class="J_zyyhq_1032856" target="_blank" href="/pdetail-<?php print $product->product_id; ?>.html"><img src="<?php print img_url($product->img_url); ?>.85x85.jpg" alt="<?php print $product->brand_name . ' ' .$product->product_name; ?>"/></a></div>
                                    <div class="cart_lb_pic">
                                       <div class="cart_name"><a target="_blank" href="/pdetail-<?php print $product->product_id; ?>.html"><?php print $product->product_name; ?></a></div>
                                       <div class="cart_xh">型号：<?php print $product->size_name; ?></div>  
                                    </div>
                                </div>
                                <div class="cart_cell p_price"><?php print fix_price($product->product_price); ?></div>
                                <div class="cart_cell cart_quantity">
                                      <div class="quantity_form clearfix">
                                          <a class="decrement disabled down" href="javascript:void(0);" data-recid="<?php print $product->rec_id; ?>">-</a>
                                          <input type="text" value="<?php print $product->product_num; ?>" onblur="j_change_num(this)" id="qty_<?php print $product->rec_id; ?>" class="cart_input" autocomplete="off">
                                          <a class="increment up" href="javascript:void(0);" data-recid="<?php print $product->rec_id; ?>">+</a>
                                     </div>
                                </div>
                                <div class="cart_cell subtotal"><strong id="product_total_<?php print $product->rec_id; ?>"><?php print fix_price($product->product_price * $product->product_num); ?></strong></div>
                                <div class="cart_cell operation">
                                    <a href="javascript:void(0);" class="cart_remove cart_dell" data-recid="<?php print $product->rec_id; ?>">删除</a>
                                    <a href="javascript:void(0);" class="cart_follow collect" data-pid="<?php print $product->product_id; ?>-<?php print $product->rec_id; ?>">移到我的关注</a>
                                </div>
                            </div>
                            <?php 
                            $i++;
                            endforeach; ?>
                             <?php endforeach; ?>
                             <!--购物车有内容的时候结束-->
                             <?php else: ?>                            
                            <!--购物车没有内容的时候开始-->
                            <div class="empty-cart empty-line">您的购物车还是空的，赶紧去<a href="/"><span>购物</span></a>吧！</div>
                            <!--购物车没有内容的时候结束-->
                            <?php endif; ?>
                        </div>
                          <?php if(!empty($cart_summary['product_list'])): ?>
                          <div class="cart_qx clearfix">
                               <div class="select_all">
                                    <div class="cart_checkbox">
                                        <input type="checkbox" name="selectall2" class="yycheckbox selectall"  <?php if(!empty($cart_summary['product_list'])): ?> checked<?php endif; ?>/>
                                    </div>
                                   全选
				</div>
                              <div class="cart_del"><a href="javascript:void(0);" class="cart_dell">删除选中商品</a><a href="javascript:void(0);" class="collect">移到我的关注</a></div>
                              <div class="cart_lb_right clearfix">
                                   <div class="cart_chooe">已选择<span id="product_sel_num"><?=$cart_summary['product_num']?></span>件商品</div>
                                   <div class="zongjia">总价：<span id="total_price">￥<?=$cart_summary['product_price']?></span></div>
                                   <div class="settlement"><a href="javascript:void(0);" class="submit_btn" id="cart_checkout">立即结算</a></div>
                             </div>
                        </div>
                        <?php endif; ?>
                  </div>
              </div>
         </div>         
         
        <?=$recomd_html?>      
    </div>
</div>

<div id="h_delete" class="cd-popup">
    <div class="cd-popup-container">
        <div class="detel-tit">删除商品</div>
        <div class="cart-bg">
          <div class="cart-bg-jl">
               <p class="cart-del-wz">您是否确认删除该商品？<br/>删除后可在浏览历史中找到该商品！</p>
               <div class="cart-btn">
                    <a href="javascript:void(0);" class="determine cart_del_cfm">确定</a><a href="javascript:void(0);" class="see-you">我在看看</a>
               </div>
          
          </div>
     
     </div>
     <a href="javascript:void(0);" class="cd-popup-close"></a>
    </div>
</div>


<div id="h_collect" class="cd-popup">
    <div class="cd-popup-container">
        <div class="detel-tit">移到关注</div>
        <div class="cart-bg">
          <div class="cart-bg-jl">
               <p class="cart-del-wz">您是否确认将该商品移到我的关注？<br/>移到关注后可在我的关注中找到该商品！</p>
               <div class="cart-btn">
                    <a href="javascript:void(0);" class="determine collect_cfm">确定</a><a href="javascript:void(0);" class="see-you">我在看看</a>
               </div>
          </div>
      </div>
     <a href="javascript:void(0);" class="cd-popup-close"></a>
    </div>
</div>

<div id="h_tip" class="cd-popup">
    <div class="cd-popup-container">
        <div class="detel-tit">提示</div>
        <div class="cart-bg">
          <div class="cart-bg-jl">
               <p class="cart-del-wz">请至少选中一件商品！</p>
          </div>
      </div>
     <a href="javascript:void(0);" class="cd-popup-close"></a>
    </div>
</div>
<?php include APPPATH.'views/common/footer.php'; ?>
<script type="text/javascript" src="<?php echo static_style_url('pc/js/comm_tool.js?v=version');?>"></script>
<script type="text/javascript">
var v_cart_buy_num = '<?=$cart_goods_buy_num?>';
$('.cd-popup-close').on('click', function(event){
    $(this).parents('.cd-popup-container').parent().removeClass('is-visible');
});
$('.see-you').on('click', function(event){
    $(this).parents('.cd-popup-container').parent().removeClass('is-visible');
});        
//全选复选框
$(".selectall").click(function(){
    //已选中
    if ($(this).prop('checked')){
        //$(".chooseone").attr('checked', true);
        //$(".selectall").attr('checked', true);
        //$('input:checkbox').attr("checked",true);
        $('input:checkbox').each(function() {
            $(this).attr('checked', true);
        });
    } else {
        //$(".chooseone").attr('checked', false);
        //$(".selectall").attr('checked', false);
        //$('input:checkbox').removeAttr("checked");
        $('input:checkbox').each(function() {
            $(this).removeAttr('checked');
        });
    }
    j_goods_cnt();
});

//单选复选框
$(".chooseone").click(function(){
    if ($(this).prop('checked')){
        $(this).attr('checked', false);
    } else {
        $(this).attr('checked', true);
    }
    j_goods_cnt();
});

function j_goods_cnt(){
    var total_num = 0;
    var total_price = 0.00;
    $(".chooseone:checked").each(function(){
        var v_sid = $(this).val();
        total_num += parseInt($("#qty_"+v_sid).val());
        total_price += parseFloat($("#product_total_"+v_sid).html());        
    });
    $("#product_sel_num").html(total_num);
    $("#total_price").html('¥ '+total_price.toFixed(2));
    if (total_num > 0) {
        //$("#cart_checkout").addClass("settle-accounts");
    } else {
        //$("#cart_checkout").removeClass("settle-accounts");
    }
    //$("#cart_checkout").toggleClass("settle-accounts");
}

//去结算
$("#cart_checkout").click(function(){
    var v_sid_str = '';
    $("input[name='rec_id[]']").each(function(){
        v_sid_str += "-"+$(this).val();
    });
    if (v_sid_str.length <= 0) return;
    window.location.href = '/cart/checkout/0/'+v_sid_str.substr(1);
});

//商品数量+1
$(document).on('click', '.up', function (e) {
    var rec_id = $(this).attr('data-recid');
    var v_obj = $("#qty_"+rec_id);
    var v_obj_val = parseInt(v_obj.val());
    if (v_obj_val >= v_cart_buy_num){
        v_obj.val(v_cart_buy_num);
        j_qtyEdit(rec_id);
        return false;
    }
    v_obj.val(v_obj_val+1);
    j_qtyEdit(rec_id);
});
//商品数量-1
$(document).on('click', '.down', function (e) {
    var rec_id = $(this).attr('data-recid');
    var v_obj = $("#qty_"+rec_id);
    var v_obj_val = parseInt(v_obj.val());
    if (v_obj_val <= 1){
        v_obj.val(1);
        j_qtyEdit(rec_id);
        return false;
    }
    v_obj.val(v_obj_val-1);
    j_qtyEdit(rec_id);
});
//手动修改购买数量
function j_change_num(obj){
    var v_obj = $(obj);
    var v_rec_id = $(obj).attr("id").replace(/qty_/i, "");
    var v_obj_val = parseInt(v_obj.val());
    if (v_obj_val <= v_cart_buy_num && v_obj_val >= 1){
        j_qtyEdit(v_rec_id);
        return false;
    }
    
    v_obj_val = (v_obj_val > v_cart_buy_num) ? v_cart_buy_num : 1;  
    v_obj.val(v_obj_val);
    j_qtyEdit(v_rec_id);
    
};
//修改购物车数量
function j_qtyEdit(rec_id) {
    var num = parseInt($("#qty_" + rec_id).val())||1;
    $.ajax({
        url: '/cart/update_cart',
        data: {rec_id: rec_id, num: num, rnd: new Date().getTime()},
        dataType: 'json',
        type: 'POST',
        success: function(result) {
            if (result.msg)
                alert(result.msg);
            if (result.err)
                return false;
            $("#product_total_"+rec_id).html((result.cart.product_num*result.cart.product_price).toFixed(2));
            $("#product_sel_num").html(result.cart_summary.product_num);
            $("#total_price").html(result.cart_summary.product_price);
            update_cart_num();
        }
    });	
}
var recObj = [];
//删除购物车中商品
$(document).on('click', '.cart_dell', function (e) {
    var rec_id = $(this).attr('data-recid');
    recObj = [];
    if (rec_id == null){
        var ischk = false;
               
        $(".chooseone:checked").each(function(){
            ischk = true;
            recObj.push(parseInt($(this).val()));
        });
         
        if (ischk == false) {
            $('#h_tip').addClass('is-visible');
            return false;
        }     
    } else {
        recObj.push(rec_id);            
    }
    $('#h_delete').addClass('is-visible');
});

//点击删除弹框层2中“确认”按钮
$(".cart_del_cfm").click(function(){
    if (recObj.length < 1) return;    
    $.each(recObj, function(idx, value){
        delete_cart(value);
    });
    $(this).parents('.cd-popup-container').parent().removeClass('is-visible');
});

//删除购物车中商品
function delete_cart(rec_id)
{
    $.ajax({
        url: '/cart/remove_from_cart',
        data: {rec_id: rec_id, rnd: new Date().getTime()},
        dataType: 'json',
	async:true,
        type: 'POST',
        success: function(result) {
            if (result.msg)
                alert(result.msg);
            if (result.err)
                return false;
            var goods_cnt = $(".c_rec"+rec_id).parent().children(".shopping_common").length;
            
	    $(".c_rec"+rec_id).remove();
            $(".shopping_common:even").addClass('shopping_orange');
            $(".shopping_common:odd").removeClass('shopping_orange');
            if (goods_cnt <= 1) 
                location.href = '/cart';
            update_cart_num();
        }
    });
}

var v_collect_pid = '';
var clt_Obj = [];
//关注
$(document).on('click', '.collect', function (e) {   
    //v_collect_pid = $(this).attr('data-pid');
    //$("#collect-box").modal('show');
    
    var rec_id = $(this).attr('data-pid');
    clt_Obj = [];
    if (rec_id == null){
        var ischk = false;
               
        $(".chooseone:checked").each(function(){
            ischk = true;
            clt_Obj.push($(this).attr('data-pid'));
        });
         
        if (ischk == false) {
            $('#h_tip').addClass('is-visible');
            return false;
        }     
    } else {
        clt_Obj.push(rec_id);            
    }
    $('#h_collect').addClass('is-visible');
});
//关注确认
/*$(".collect_cfm").click(function(){
    if (v_collect_pid == '') return;
    var pid_arr = v_collect_pid.split("-");
    set_collect(pid_arr[0]);
    $("#collect-box").modal('hide');
    $("#collect_"+pid_arr[1]).popover('show');  
    setTimeout(function(){delete_cart(pid_arr[1])}, 1000);
});*/

$(".collect_cfm").click(function(){
    if (clt_Obj.length < 1) return;
    var pid_arr;
    $.each(clt_Obj, function(idx, value){
        pid_arr = value.split("-");
        set_collect(pid_arr[0]);
        setTimeout(function(){delete_cart(pid_arr[1])}, 1000);
    });
    $(this).parents('.cd-popup-container').parent().removeClass('is-visible');
});

function set_collect(pid){
    $.ajax({
        url: '/product_api/add_to_collect',
        data: {product_id: pid, product_type:0, rnd: new Date().getTime()},
        dataType: 'json',
	async:true,
        type: 'POST',
        success: function(result) {
            /*if (result.msg)
                alert(result.msg);*/
            if (result.err)
                return false;
        }
    });
}
</script>