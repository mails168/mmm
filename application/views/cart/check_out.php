<?php include APPPATH . 'views/common/header3.php'?>
<div class="contain">
    <div class="Mall_list">
        <div class="common_cart_pic cart_header_ico2"></div>
        <div class="shipping_address">
            <div class="address_title">收货地址</div>
            <ul class="choose-shipping address_list clearfix">
                <?php include(APPPATH . 'views/cart/address_list_new.php'); ?>
            </ul>
        </div>          
        <div class="shipping_address method shipping_pay">
            <div class="address_title">支付方式</div>
            <div class="payment_lb">
                <div class="pay_box pay_box_selected">
                    <div class="radio_inner clearfix">
                        <div class="radio-wrapper">
                            <span class="ui-radio"><label class="radio_ico radio_mr radio_xz"></label></span>
                            <label class="ui-label">在线支付</label>
                            <input type="hidden" value="0" class="v_pay_order">
                        </div>
                        <p class="payment-desc">支持支付宝、微信在线支付方式。</p>
                    </div>
                </div>
                <div class="pay_box">
                    <div class="radio_inner clearfix">
                        <div class="radio-wrapper">
                            <span class="ui-radio"><label class="radio_ico radio_mr"></label></span>
                            <label class="ui-label">货到付款</label>
                            <input type="hidden" value="1" class="v_pay_order">
                        </div>
                        <p class="payment-desc">快递到付。</p>
                    </div>
                </div>
            </div>
        </div>         
        <div class="shipping_address shipping_company">
            <div class="address_title">选择快递</div>
            <ul class="choose_express clearfix">
            <?php foreach($shipping_list as $val_ship): ?>
                <li>
                    <div class="express_box <?php if($shipping['shipping_id'] == $val_ship->shipping_id): ?> express_box_sct<?php endif; ?>">
                        <div class="radio-wrapper">
                            <span class="ui-radio">
                                <label class="radio_ico radio_mr <?php if($shipping['shipping_id'] == $val_ship->shipping_id): ?> radio_xz <?php endif; ?>" data-id="<?php echo $val_ship->shipping_id;?>"></label>
                            </span>
                            <label class="ui-label"><?php echo $val_ship->shipping_name;?></label>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>        
        <!-- <div class="shipping_address">
            <div class="address_title">优惠方式</div>
            <div class="preferential clearfix">
                <?php //if(empty($voucher_list)): ?> 
                    <p class="use_coupons">无可用优惠券</p>
                <?php //endif; ?>

                <p class="receive_coupons">领取优惠券</p>
                <div class="enter_coupons" style="display:none;">
                    <input type="text" placeholder="输入优惠券号" class="sryhq" ><a href="#" class="coupons_sy">使用</a>
                </div>
            </div>
        </div>  -->
        <div class="shipping_address">
            <div class="address_title">订单备注</div>
            <div class="preferential clearfix">
                <div class="orderbox">
                    <input id="remark" type="text" placeholder="选填，限50个字，请将购买需求在备注中做说明。" class="orderinput">
                </div>
            </div>
        </div>      
        <div class="shipping_address">
            <div class="mingxi clearfix">
                <div class="spmx fl">商品明细</div>
                <div class="back_cart fr"><a href="/cart/index.html">返回购物车修改商品</a></div>
            </div>
            <div class="cartlist">
                <ul class="cartlb clearfix">
                    <li class="mx-spxx">商品名称</li>
                    <li class="mx-dj">单价</li>
                    <li class="mx-sl">数量</li>
                    <li class="mx-xj">小计</li>
                </ul>
                <ul class="cart-main clearfix">
                <?php foreach ($cart_summary['product_list'] as $provider_id => $provider): ?>
                    <?php foreach ($provider['product_list'] as $product): ?>
                    <li>
                        <div class="item-table mx1">
                            <a href="/pdetail-<?=$product->product_id?>.html" target="_blank" class="goods-info">
                                <div class="goods-img"><img src="<?php print img_url($product->img_url); ?>.85x85.jpg" alt=""/></div>
                                <div class="goods-desc item-table">
                                    <p class="goods-name"><?php print $product->product_name; ?></p>
                                    <p class="goods-attr"><span><?php print $product->size_name; ?></span></p>
                                </div>
                            </a>
                        </div>
                        <div class="goods-price item-table goods-price2"><span>￥<em class="bprice"><?php print fix_price($product->product_price); ?></em></span></div>
                        <div class="counter item-table"><div class="counter-wrapper"><?php print $product->product_num; ?></div></div>
                        <div class="goods-money item-table">￥<span><em class="total"><?php print fix_price($product->product_price * $product->product_num); ?></em></span></div>
                    </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>    
                </ul>
            </div>
        </div>          
        <div class="submit-bottom">
            <div class="submit-box clearfix">
                <div class="invoice">
                    <div class="invoice-inner clearfix">
                        <!-- <input name="v-check-invoice" type="checkbox" class="fp-check"> -->
                        <label class="kjfp">开具发票</label>
                    </div>
                    <p class="kpfs" id="invoice_msg">
                        <a href="javascript:void(0);" class="invoice_msg_check">
                        <?php if(count($invoice_cookie)): 
                            if (count($invoice_cookie) == 3):
                                echo '<span>开票方式：增值发票</span><span>发票抬头：'.$invoice_cookie[0].'</span><span>联系方式：'.$invoice_cookie[1].'</span><span>开票留言：'.$invoice_cookie[2].'</span>';
                            else:
                                echo '<span>开票方式：普通发票</span><span>发票抬头：'.$invoice_cookie[0].'</span><span>发票内容：'.$invoice_cookie[1].'</span>';
                            endif;
                        else: ?>
                            <span>不需要发票</span>
                        <?php endif; ?>  
                        </a>
                        <span><a href="javascript:void(0);" class="cd-popup-trigger3">修改</a></span>
                    </p>
                    <p class="kpfs">*如需增值税发票请联系客服：400-9905-920，或点此<a href="javascript:void(0);">联系客服。</a></p>
                </div>
                <div class="amount-good">
                    <ul class="amount-good-lb clearfix">
                        <li class="review-price-item">
                            <span class="m-price"><span class="u-yen">¥</span><span class="u-price" id="totalmoney"><?php print fix_price($cart_summary['product_price']); ?></span></span>
                            <h4 class="review-price-item-title">商品金额：</h4>
                        </li>
                        <li class="review-price-item">
                            <span class="m-price"> <span class="u-yen">¥</span><span class="u-price" id="shipping_fee"><?php echo $shipping_fee;?></span></span>
                            <h4 class="review-price-item-title">运费：</h4>
                        </li>
                        <!-- <li class="review-price-item">
                            <span class="m-price"> <span class="u-yen">¥</span><span class="u-price" id="freight"><?php //echo $cart_summary['voucher'];?></span></span>
                            <h4 class="review-price-item-title">优惠券：</h4>
                        </li> -->
                        <li class="review-price-item">
                            <span class="m-price"><span class="u-yen2">¥</span><span class="u-price2" id="paymoney"><?php print fix_price($cart_summary['product_price'] + $shipping_fee - $cart_summary['voucher']); ?></span></span>
                            <h4 class="review-price-item-title">待支付：</h4>
                        </li>
                    </ul>
                </div> 
            </div>          
            <div class="review-footer">
                <div class="reviewxx">
                    <div class="consignee fl send">
                        <div class="shouhuo ">收货人：<?=$default_address->consignee?>  <?php echo (!empty($default_address->mobile))? $default_address->mobile : $default_address->tel;?></div>
                        <p class="con-dizhi"><?=$default_address->province_name?>  <?=$default_address->city_name?>  <?=$default_address->district_name?><?=$default_address->address?></p>
                    </div>
                    <a class="ui-btn-large fr" href="javascript:void(0);">
                        <span class="ui-btn-loading-before" onclick="submit_cart();">提交订单</span>
                    </a> 
                </div>  
            </div>
        </div>       
    </div>
</div>
<!-- 地址添加弹层开始 -->
<div id="address_block_new" class="cd-popup2">
    
</div>
<!-- 地址添加弹层结束 -->

<!--发票弹出框-->
<div class="cd-popup3">
    <div class="cd-popup-container cd-popup-container2">
        <div class="detel-tit2">发票信息</div>
        <?php 
            $invoice_type = 0;
            if(count($invoice_cookie) > 2){
                $invoice_type = 1;
            }
        ?>
        <div class="cart-bg">
            <div class="invoice-thickbox">
                <div class="invoice-rr">
                    <ul class="tab-nav-item clearfix">
                        <li data-value="0" <?php if($invoice_type): ?> class="invoice-currt"<?php endif;?> >普通发票</li>
                        <li data-value="1" <?php if(!$invoice_type): ?> class="invoice-currt"<?php endif;?> >增值税发票</li>
                    </ul>
                </div>
                <div class="invoice-lb clearfix">
                    <div class="invoice-item invoice-item-selected clearfix">
                        <span class="invoice-taitou">发票抬头：</span>
                        <div id="invoice_list" class="invoice-fl" style="max-height:132px;overflow-y:auto;position:relative">

                            <span class="fore2 <?php if(!$invoice_type && isset($invoice_cookie[0]) && $invoice_cookie[0] == '个人'): ?> fore2-selet<?php endif; ?>">
                                <input value="个人" class="itxt" readonly type="text">
                            </span>
                            <?php foreach ($invoice_list as $invoice): ?>  
                            <span class="fore2 <?php if(!$invoice_type && isset($invoice_cookie[0]) && $invoice_cookie[0] == $invoice->title): ?> fore2-selet<?php endif; ?>"><input type="text" value="<?=$invoice->title?>" class="itxt" data-r="<?=$invoice->id?>" readonly="readonly">
                                <div class="btns">
                                    <a class="ftx-05 invoice_del" href="javascript:void(0);" data-r="<?=$invoice->id?>">删除</a>
                                </div>
                            </span>
                            <?php endforeach ?>
                            <span id="invoice_save" class="fore2" style="display: none;">
                                <input class="itxt" placeholder="新增单位发票抬头" type="text">
                                <div style="display: none;" class="btns"><a class="ftx-05 save-tit" href="javascript:void(0);">保存</a></div>
                            </span>
                        </div>
                        <span class="invoice-bc invoice_add">新增</span>
                    </div>
                    <div class="invoice-content clearfix">
                        <span class="fpnr-tit">发票内容:</span>
                        <ul class="fpnr-lb">
                            <li <?php if(!$invoice_type && isset($invoice_cookie[1]) && $invoice_cookie[1] == '明细'): ?> class="fpnr-lb-selt" <?php endif; ?> >明细</li>
                            <li <?php if(!$invoice_type && isset($invoice_cookie[1]) && $invoice_cookie[1] == '牙科耗材一批'): ?> class="fpnr-lb-selt" <?php endif; ?> >牙科耗材一批</li>
                        </ul>
                    </div>
                    <div class="operate check-btn">
                        <a href="javascript:void(0);" class="checek-save save_invoice">确定</a>
                        <a href="javascript:void(0);" class="check-cancel" onclick="submit_address_close();">取消</a>
                        <p class="wxts">温馨提示：发票金额不含悦牙网积分，优惠券，现金券部分</p>
                    </div>
                </div>
                <div class="invoice-lb invoice-lb2" style="display: none;">
                    <p class="fp-lx">如需增值税发票请联系客服：400-9905-920<a href="#">联系在线客服</a></p>
                    <ul class="vat-invoice">
                        <li><label><i>*</i>发票抬头：</label><input id="inc_name" type="text" <?php if($invoice_type && isset($invoice_cookie[0])): ?> value="<?=$invoice_cookie[0]?>"<?php endif; ?>><span class="err_empty" id="inc_name_error">不能为空</span></li>
                        <li><label><i>*</i>联系方式：</label><input id="inc_mobile" type="text"<?php if($invoice_type && isset($invoice_cookie[1])): ?> value="<?=$invoice_cookie[1]?>"<?php endif; ?>><span class="err_empty" id="inc_mobile_error">不能为空</span></li>
                        <li><label><i>*</i>开票留言：</label><textarea id="inc_content" cols="" rows="" placeholder="请将您的需求留言（限30字）"><?php if($invoice_type && isset($invoice_cookie[2])): ?><?=$invoice_cookie[2]?><?php endif; ?></textarea>
                        <span class="err_empty" id="inc_content_error">不能为空</span></li>
                    </ul>
                    <div class="operate operate2">
                        <a href="javascript:void(0);" class="checek-save save_invoice">保存</a>
                        <a href="javascript:void(0);" class="check-cancel" onclick="submit_address_close();">取消</a>
                        <p class="wxts">温馨提示：发票金额不含悦牙网积分，优惠券，现金券部分</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:void(0);" class="cd-popup-close cd-popup-close2"></a>
    </div>
</div>
<!--发票弹出框-->

<?php include APPPATH . 'views/common/footer.php'?>
<script type="text/javascript">
    var v_cur_coupon = '<?php if(!empty($payment["voucher"])){$key = array_keys($payment["voucher"]); echo $payment["voucher"][$key[0]]->voucher_sn;}?>';
    var v_rec_ids = '<?=$rec_ids?>';
    var v_shipping_id = '<?=$shipping["shipping_id"]?>';
        //提交订单
    var last_cart_submit_time = 0;
</script>
<script type="text/javascript" src="<?php echo static_style_url('new_pc/js/check_out.js?v=version2');?>"></script>
<script type="text/javascript">
    function submit_cart() {
        // if($("input[type='checkbox']").is("checked")==true){
        //     console.log($("#invoice_msg").html());
        // }else{
        //     console.log('qweradsf');
        // }

        if(new Date().getTime() - last_cart_submit_time < 10000){
            alert('请不要重复提交');
            return false;
        }

        // 检查支付方式
        var pay_id = '';
        var check_pay_id = $('.shipping_pay .payment_lb .pay_box_selected input[type="hidden"]').val();
        if(check_pay_id == 0){ pay_id = '<?=$default_pay_id?>';}
        if(check_pay_id == 1){ pay_id = '<?=$to_pay_id?>';}

        var address_id = $(".address_list .default").attr('id');
        if (address_id == undefined){
            alert('请选择地址！');
        return false;
        }
        address_id = parseInt(address_id.replace(/address/, ''));    
        if(!address_id){
            alert('请选择收货地址');
            return false;
        }

        var shipping_id = $('.shipping_company .radio_xz').attr('data-id');
        if(!shipping_id){
            alert('请选择快递公司');
            return false;
        }

        // 收集数据，提交
        var data = {rnd:new Date().getTime(),address_id:address_id};
        data['pay_id'] = pay_id;
        data['shipping_id'] = shipping_id;
        data['invoice'] = $("#invoice_msg .invoice_msg_check").html();
        data['remark'] = $("#remark").val();
        last_cart_submit_time = new Date().getTime();
        $.ajax({
            url:'/cart/proc_checkout/0/'+v_rec_ids,
            data:data,
            dataType:'json',
            type:'POST',
            success:function(result){
                last_cart_submit_time = 0;
                if (result.msg) alert(result.msg);
                if (result.url) {location.href=result.url;};
                if (result.err) return false;
                if(result.order_id) location.href='/cart/success/'+result.order_id;
            },
            error:function()
            {
                last_cart_submit_time = 0;
            }
        });
    }

</script>
