<?php include APPPATH."views/common/header3.php"; ?>
<?php $product_desc_additional = (!empty($product->product_desc_additional)) ? json_decode($product->product_desc_additional, true) : array();?>
<!--cart-wrapper start-->
<div class="contain">
      <div class="Mall_list">
           <div class="course-ico course-ico1"></div>
           <div class="course-list clearfix">
                <div class="course-head">
                     <div class="course-mc fl">课程名称</div>
                     <div class="course-tec fl">讲师</div>
                     <div class="course-time fl">时间</div>
                     <div class="course-dz fl">地点</div>
                     <div class="course-set fl">座位数</div>
                     <div class="course-price fr">单价</div>
                </div>
                <div class="course-bot">
                     <div class="course1 fl"><a target="_blank" href="/product-<?php print $product->product_id; ?>.html"><?=$product->brand_name . ' ' . $product->product_name?></a></div>
                     <div class="course2 fl"><p><?=$product->subhead?></p></div>
                     <div class="course3 fl"><?php echo date("y.m.d", strtotime($product->package_name));?></div>
                     <div class="courer4 fl"><?php if(isset($product_desc_additional['desc_material'])) echo $product_desc_additional['desc_material']?></div>
                     <div class="cart_quantity courer5 fl">
                          <div class="quantity_form clearfix">
                               <a class="decrement disabled down" href="javascript:void(0);" data-id="<?php print $product->sub_id; ?>">-</a>
                               <input type="text" onblur="j_change_num(this)" id="qty_<?php print $product->sub_id; ?>" min="1" max="<?=$product->sale_num?>" value="1" maxlength="5" class="cart_input" autocomplete="off">
                               <a class="increment up" href="javascript:void(0);" data-id="<?php print $product->sub_id; ?>">+</a>
                        </div>
                    </div>
                    <div class="course6 fr">￥<span id="h_goods_price"><?=$product->product_price?></span>/<?=$product->unit_name?></div>
              </div>
        </div>
        
        <div class="pingzheng">
             <div class="pingzheng-tit"><span>填写凭证信息</span></div>
             <ul class="pingzheng-lb">
                 <li><label>手机号码（接收上课凭证码）：</label><span><input type="text" class="pztxt" id="mobile"></span></li>
                 <li><label>电子邮箱（接收上课凭证码）：</label><span><input type="text" class="pztxt" id="email"></span></li>
                 <li><label>真实姓名（接收上课凭证码）：</label><span><input type="text" class="pztxt" id="consignee"></span></li>
             </ul>
        </div>
          
        <div class="payable-btn">
             <div class="payable-price fl">应付总金额<span id="h_total_price">￥<?=$product->product_price?></span></div>
             <a href="javascript:void(0);" class="payable-anniu fr" onclick="submit_cart();">提交订单</a>        
        </div>      
      </div>
</div>
<!--cart-wrapper end-->
<?php include APPPATH.'views/common/footer.php'; ?>
<script type="text/javascript">
function j_total_price(goods_price){
    var v_price = parseFloat($("#h_goods_price").html())*goods_price;
    $("#h_total_price").html('￥'+v_price.toFixed(2));
}
//手动修改购买数量
function j_change_num(obj){
    var v_obj = $(obj);
    var v_obj_val = parseInt(v_obj.val());
    var v_obj_val_max = parseInt(v_obj.attr('max'));
    var v_obj_val_min = parseInt(v_obj.attr('min'));
    v_edit_flag = true;
    if (v_obj_val <= v_obj_val_max && v_obj_val >= v_obj_val_min){
        return false;
    }
    
    v_obj_val = (v_obj_val > v_obj_val_max) ? v_obj_val_max : v_obj_val_min;  
    v_obj.val(v_obj_val);
    j_total_price(v_obj_val);
    //var v_price = parseFloat($("#h_goods_price").html())*v_obj_val;
    //$("#h_total_price").html('￥'+v_price.toFixed(2));
};
//商品数量+1
$(document).on('click', '.up', function (e) {
    var rec_id = $(this).attr('data-id');
    var v_obj = $("#qty_"+rec_id);
    var v_obj_val = parseInt(v_obj.val());
    var v_obj_val_max = parseInt(v_obj.attr('max'));
    if (v_obj_val >= v_obj_val_max){
        v_obj.val(v_obj_val_max);
        j_total_price(v_obj_val_max);
        return false;
    }
    v_edit_flag = true;
    v_obj.val(v_obj_val+1);
    j_total_price(v_obj_val+1);
});
//商品数量-1
$(document).on('click', '.down', function (e) {
    var rec_id = $(this).attr('data-id');
    var v_obj = $("#qty_"+rec_id);
    var v_obj_val = parseInt(v_obj.val());
    var v_obj_val_max = parseInt(v_obj.attr('max'));
    if (v_obj_val <= 1){
        v_obj.val(1);
        j_total_price(1);
        return false;
    }
    v_edit_flag = true;
    v_obj.val(v_obj_val-1);
    j_total_price(v_obj_val-1);
});

var last_cart_submit_time = 0;
var sub_id = '<?php print $product->sub_id; ?>';
var genre_id = '<?=$genre_id?>';
function submit_cart() {
    var load = null;
    load = new Loading();
    load.init({
        target: $('body')[0]
    });
    load.start();  
    
    if(new Date().getTime() - last_cart_submit_time < 10000){
        alert('请不要重复提交');
        return false;
    }

    var num = $("#qty_"+sub_id).val();
    var v_mobile = $("#mobile").val();
    var v_consignee = $("#consignee").val();
    var v_email = $("#email").val();
    //var v_address = $$("#address").val();
    //var v_company = $$("#company").val();
    //var v_remark = $$("#remark").val();
    if (v_mobile == ''){
        alert('请填写手机号');
        return false;
    }
    

    if (v_mobile.length != 11){
        alert('手机号不正确');
        return false;
    }
    
    var mobileReg = !!v_mobile.match(/^(13[0-9]|15[0-9]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
    if (mobileReg == false){
        alert('手机号不正确');
        return false;
    }
    
    if (v_consignee == ''){
        alert('请填写真实姓名');
        return false;
    }

    // 收集数据，提交
    var data = {rnd:new Date().getTime(),sub_id:sub_id};
    data['num'] = num;
    data['mobile'] = v_mobile;
    data['consignee'] = v_consignee;
    data['email'] = v_email;
    //data['address'] = v_address;
    //data['company'] = v_company;
    //data['remark'] = v_remark;
    last_cart_submit_time = new Date().getTime();
    $.ajax({
        url:'/cart/proc_checkout_course',
        data:data,
        dataType:'json',
        type:'POST',
        success:function(result){
            last_cart_submit_time = 0;
            if (result.msg) alert(result.msg);
            if (result.url) {location.href=result.url;};
            if (result.err) return false;
            if(result.order_id) location.href='/cart/success/'+result.order_id+'/'+genre_id; 
        },
        error:function()
        {
            last_cart_submit_time = 0;
	    load.stop();
        }
    });
}
</script>