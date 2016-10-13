<ul class="encyclopedia-video">
    <?php foreach($list as $v): ?>
    <li>
        <a href="/article/video_detail/<?=$v->ID?>"><img src="<?=$v->cover?>" width="585" height="275" alt=""/></a>
        <span class="video-ico"></span>
        <p><?=$v->post_title?></p>
    </li>
    <?php endforeach; ?>
</ul>

<!-- 分页开始 -->
<?php if ($filter['page_count'] > 1){ ?>
    <div class="ui-page clearfix">
        <div class="ui-page-wrap">                        
            <b class="ui-page-num">                            
                <?php if ($filter['page'] <= 1) { ?>
                <b class="ui-page-prev">&lt;&lt;上一页</b>
                <?php } else { ?>
                <a class="ui-page-prev" href="javascript:filter_product('<?=$kw?>', <?=$filter['page']-1?>, '<?=$target?>', 4, <?=$tmid?>);">&lt;&lt;上一页</a>
                <?php } ?>                         

                <?php foreach ($arr_pagelist_num as $arr_list_num): ?>
                    <?php if ($arr_list_num == "...") { ?>
                        <b class="ui-page-break">...</b>
                    <?php } ?>
                    <?php if ($arr_list_num == $filter['page']) { ?>
                        <b class="ui-page-cur"><?= $arr_list_num ?></b>
                    <?php } elseif ($arr_list_num != "...") { ?>
                        <a href="javascript:filter_product('<?=$kw?>', <?=$arr_list_num?>, '<?=$target?>', 4, <?=$tmid?>);"><?=$arr_list_num ?></a>
                    <?php } ?>
                <?php endforeach; ?>

                <?php if ($filter['page'] >= $filter['page_count']) { ?>
                <b class="ui-page-next">下一页&gt;&gt;</b>
                <?php } else { ?>
                <a class="ui-page-next" href="javascript:filter_product('<?=$kw?>', <?=$filter['page']+1?>, '<?=$target?>', 4, <?=$tmid?>);">下一页&gt;&gt;</a>
                <?php } ?>
            </b>                        
            <b class="ui-page-skip">
                    共<?=$filter['page_count']?>页，到第
                    <input type="text" class="ui-page-skipTo" size="3" name="page" value="<?=$filter['page']?>" onkeydown="javascript:if(event.keyCode==13){page_jump('<?=$kw?>', this, '<?=$target?>', 4, <?=$tmid?>);return false;}"/>页
                    <button type="button" class="ui-btn-s" onclick="page_jump('<?=$kw?>', this, '<?=$target?>', 4, <?=$tmid?>)">确定</button>
            </b>                       

        </div>
    </div>
<?php } ?>   
<!-- 分页结束 -->