<ul class="tooth-list clearfix">
<?php foreach($list as $v): format_product($v);?>
<li>
    <div class="tooth-top">
        <a href="/product-<?php echo $v->product_id;?>.html">
            <div class="tooth-img"><img class="lazy" data-original="<?php echo img_url($v->img_url.".418x418.jpg");?>" width="275" height="275" alt="<?php echo $v->product_name;?>"/></div>
            <div class="tooth-con">
                <h2><?php echo $v->product_name;?></h2>
                <?php $product_desc_additional = (!empty($v->product_desc_additional)) ? json_decode($v->product_desc_additional, true) : array(); ?>  
                <span class="tooth-con-time"><i></i><?php echo date("m月d日", strtotime($v->package_name));?>-<?=date("m月d日", strtotime($product_desc_additional['desc_waterproof']));?></span>
                <span class="tooth-con-dz"><i></i><?php echo $product_desc_additional['desc_material'];?></span>
                <p class="tooth-xx"><?php echo cutstr_html($v->product_desc,0);?></p>
            </div>
        </a>
        <div class="yh-box">限时优惠￥<?php echo $v->product_price;?></div>
    </div>
</li>
<?php endforeach;?>
</ul>         
<!-- 分页开始 -->
<?php if ($filter['page_count'] > 1){ ?>
    <div class="ui-page clearfix">
        <div class="ui-page-wrap">                        
            <b class="ui-page-num">                            
                <?php if ($filter['page'] <= 1) { ?>
                <b class="ui-page-prev">&lt;&lt;上一页</b>
                <?php } else { ?>
                <a class="ui-page-prev" href="javascript:filter_product('<?=$kw?>', <?=$filter['page']-1?>, 'h_course_list', 2);">&lt;&lt;上一页</a>
                <?php } ?>                         

                <?php foreach ($arr_pagelist_num as $arr_list_num): ?>
                    <?php if ($arr_list_num == "...") { ?>
                        <b class="ui-page-break">...</b>
                    <?php } ?>
                    <?php if ($arr_list_num == $filter['page']) { ?>
                        <b class="ui-page-cur"><?= $arr_list_num ?></b>
                    <?php } elseif ($arr_list_num != "...") { ?>
                        <a href="javascript:filter_product('<?=$kw?>', <?=$arr_list_num?>, 'h_course_list', 2);"><?=$arr_list_num ?></a>
                    <?php } ?>
                <?php endforeach; ?>

                <?php if ($filter['page'] >= $filter['page_count']) { ?>
                <b class="ui-page-next">下一页&gt;&gt;</b>
                <?php } else { ?>
                <a class="ui-page-next" href="javascript:filter_product('<?=$kw?>', <?=$filter['page']+1?>, 'h_course_list', 2);">下一页&gt;&gt;</a>
                <?php } ?>
            </b>
            <b class="ui-page-skip">
                    共<?=$filter['page_count']?>页，到第
                    <input type="text" class="ui-page-skipTo" size="3" name="page" value="<?=$filter['page']?>" onkeydown="javascript:if(event.keyCode==13){page_jump('<?=$kw?>', this, 'h_course_list', 2);return false;}"/>页
                    <button type="button" class="ui-btn-s" onclick="page_jump('<?=$kw?>', this, 'h_course_list', 2)">确定</button>
            </b>

        </div>
    </div>
<?php } ?>   
<!-- 分页结束 -->