<div class="cd-popup-container cd-popup-container2">
    <div class="detel-tit2">收货信息</div>
    <div class="cart-bg">
        <ul class="receiving-lb form">
            <li>
                <label class="text-label"><i>*</i><span class="addr-title"><em class="space-name">收货</em>人：</span></label>
                <input type="text" name="consignee" class="text-filed" value="<?php print isset($shipping['consignee']) ? $shipping['consignee'] : ''; ?>">
                <p id="consignee_err" class="err_tip">不能为空</p>
            </li>
            <li>
                <label class="text-label"><i>*</i><span class="addr-title">手机号码：</span></label>
                <input type="text" name="mobile" class="text-filed" value="<?php print isset($shipping['mobile']) ? $shipping['mobile'] : ''; ?>">
                <p id="mobile_err" class="err_tip">不能为空或手机号不正确</p>
            </li>
            <li>
                <label class="text-label"><span class="addr-title ad-email">邮 编：</span></label>
                <input type="text" name="zipcode" class="text-filed" value="<?php print isset($shipping['zipcode']) ? $shipping['zipcode'] : ''; ?>">
            </li>
            <li class="clearfix">
                <label class="text-label"><i>*</i><span class="addr-title">收货地区：</span></label>
                <div class="receiving-group fl">
                    <?php print form_dropdown(
                        'province',
                        array(''=>'请选择省')+get_pair($province_list,'region_id','region_name'),
                        empty($shipping['province'])?'':$shipping['province'],
                        'onchange="load_city()" style="width:90px;"'
                        );
                    ?>
                    <?php print form_dropdown(
                        'city',
                        array(''=>'请选择市')+get_pair($city_list,'region_id','region_name'),
                        empty($shipping['city'])?'':$shipping['city'],
                        'onchange="load_district()" style="width:90px;"'
                        );
                    ?>
                    <?php print form_dropdown(
                        'district',
                        array(''=>'请选择区')+get_pair($district_list,'region_id','region_name'),
                        empty($shipping['district'])?'':$shipping['district'],
                        'style="width:90px;"'
                        );
                    ?>
                    <p id="region_err" class="err_tip">请选择收货地区</p>
                </div>
            </li>
            <li>
                <label class="text-label"><i>*</i><span class="addr-title">详细地址：</span></label>
                <textarea name="address" class="addrDetail" cols="30" rows="10"><?php print isset($shipping['address']) ? $shipping['address'] : ''; ?></textarea>
                <p id="address_err" class="err_tip">不能为空</p>
            </li>
            <li class="addr-default">
                <input type="checkbox" <?php print (isset($shipping['is_used']) && $shipping['is_used']) ? ' checked':''; ?> id="iscurrent">
                <label for="setDefault" class="swmr" >设为默认地址</label>
            </li>                    
            <div class="operate">
                <a href="javascript:void(0);" class="checek-save" onclick="submit_address_form();">保存</a>
                <a href="javascript:void(0);" class="check-cancel" onclick="submit_address_close();">取消</a>
            </div>
        </ul>
    </div>
    <a href="javascript:void(0);" class="cd-popup-close cd-popup-close2"></a>
</div>