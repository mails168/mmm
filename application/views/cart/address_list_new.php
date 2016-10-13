<?php foreach ($address_list as $val_add) { ?>
<li  id="address<?=$val_add->address_id?>" <?php if($val_add->address_id == $default_address->address_id):?> class="default"<?php endif; ?>>
    <div class="inner">
        <div class="choose-shipping-name"><span class="name"><?php echo $val_add->consignee;?></span><span class="tell"><?php echo (!empty($val_add->mobile)) ? $val_add->mobile : $val_add->tel;?></span></div>
        <div class="choose-shipping-address">
            <span class="prov"><?php $val_add->province_name;?></span>
            <span class="city"><?=$val_add->city_name;?></span>
            <span><p class="addr-bd"><?=$val_add->district_name.$val_add->address;?></p></span>
        </div>
        <div class="addr-toolbar">
            <span onclick="load_address_form(<?php print $val_add->address_id ?>)" class="modify">修改</span>
            <span data-recid="<?php print $val_add->address_id; ?>" class="delete address_del">删除</span>
            <span data-recid="<?php print $val_add->address_id; ?>" class="delete address_default" <?php if($val_add->address_id == $default_address->address_id): ?> style="display: none;"<?php endif; ?>>设为默认</span>
        </div>
    </div>
    <?php if($val_add->address_id == $default_address->address_id): ?>
        <ins class="deftip">默认</ins>
    <?php endif; ?>
</li>
<?php } ?>
<li>
    <a <?php if(count($address_list) < 20) { echo 'onclick="load_address_form(0)" class="cd-popup-trigger2"';} ?> href="javascript:void(0);">
        <div class="inner xinzeng"><i>+</i>新增收货地址</div>
    </a>
</li> 