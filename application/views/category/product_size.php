<div class="mall-cart_hover">
    <div class="mall_cart_top clearfix">
         <div class="mall_cart_pic fl"><a href="/pdetail-<?php print $product->product_id;?>.html"><img src="<?php print img_url($product->img_url.".85x85.jpg"); ?>" alt=""/></a></div>
         <div class="mall_cart_title fl">
               <div class="mall_pro-mc"><a href="/pdetail-<?php print $product->product_id;?>.html"><span><?php print $product->brand_name;?></span><?php print $product->product_name;?></a></div>
               <div class="mall_pro-sprice"><i>¥</i><?php print $product->product_price; ?><span><i>¥</i><em><?php print $product->market_price; ?></em></span></div>
         </div>                      
    </div>
    <div class="mall_cart_xx clearfix">   
         <?php foreach($sub_list as $sub): ?>
        <a href="javascript:void(0);"<?php if($sub->sale_num): ?> id="rec_id<?=$sub->sub_id?>" onclick="sel_size_yes(<?=$sub->sub_id?>)" data-subid="<?=$sub->sub_id?>"<?php else:?> class="sel_size_no"<?php endif; ?> title="<?=$sub->size_name?>"><?=$sub->size_name?></a>
        <?php endforeach; ?>
    </div> 
    <div class="mall_cart_fix clearfix">
         <div class="Mall_add_acrt fl"><i class="add_cart"><a href="javascript:void(0);"></i>加入购物车</a></div>         
            <?php if($is_collected): ?>
            <div class="Mall_focus_white focus_common bdr-r fr"><a href="javascript:void(0);">已关注</a></div>
            <?php else: ?>
            <div class="Mall_focus focus_common bdr-r fr">
            <a href="/pdetail-<?php print $product->product_id;?>.html" ><i class=""></i>查看详情</a>
            </div>
            <?php endif; ?>
	 
   </div>
</div>