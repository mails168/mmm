<?php include APPPATH . 'views/common/header.php'?>
<div class="contain">
     <div class="activity-banner">
        <?php foreach($ad as $aad): if (!empty($aad->pic_url)):?>
         <a href="<?=$aad->ad_link?>">
        <img class="lazy " data-src="<?php print img_url($aad->pic_url); ?>"/>
         </a>
        <?php endif; endforeach; ?>
     </div> 
     <div class="encyclopedia">
          <ul class="dental-common">
              <li class="dental_current" onclick="filter_product('', 1, 'h_all_data', 3, 0);">全部</li>
              <li onclick="filter_product('', 1, 'h_yuanchuang_data', 3, 1218);">原创</li>
              <li onclick="filter_product('', 1, 'h_kepu_data', 3, 1);">科普</li>
              <li onclick="filter_product('', 1, 'h_jishu_data', 3, 3);">技术</li>
          </ul>
         
          <div id="h_all_data" class="search-result-list">
               <ul class="encyclopedia-video clearfix">                 
                 <?php foreach($list as $v): ?>
                <li>
                    <div class="video_list_top clearfix">
                        <div class="video_list_pic"><a href="/article/detail/<?=$v->ID?>"><img src="<?=$v->cover?>" width="275" height="275" alt=""/></a></div>
                        <div class="video_list_js">
                            <!-- <a href="/article/detail/<?=$v->ID?>"><?=$v->intro?></a> -->
                        </div>
                    </div>
                    <p class="video_list_bt"><?=$v->post_title?></p>
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
                            <a class="ui-page-prev" href="javascript:filter_product('<?=$kw?>', <?=$filter['page']-1?>, 'h_all_data', 3, <?=$tmid?>);">&lt;&lt;上一页</a>
                            <?php } ?>                         

                            <?php foreach ($arr_pagelist_num as $arr_list_num): ?>
                                <?php if ($arr_list_num == "...") { ?>
                                    <b class="ui-page-break">...</b>
                                <?php } ?>
                                <?php if ($arr_list_num == $filter['page']) { ?>
                                    <b class="ui-page-cur"><?= $arr_list_num ?></b>
                                <?php } elseif ($arr_list_num != "...") { ?>
                                    <a href="javascript:filter_product('<?=$kw?>', <?=$arr_list_num?>, 'h_all_data', 3, <?=$tmid?>);"><?=$arr_list_num ?></a>
                                <?php } ?>
                            <?php endforeach; ?>

                            <?php if ($filter['page'] >= $filter['page_count']) { ?>
                            <b class="ui-page-next">下一页&gt;&gt;</b>
                            <?php } else { ?>
                            <a class="ui-page-next" href="javascript:filter_product('<?=$kw?>', <?=$filter['page']+1?>, 'h_all_data', 3, <?=$tmid?>);">下一页&gt;&gt;</a>
                            <?php } ?>
                        </b>                        
                        <b class="ui-page-skip">
                                共<?=$filter['page_count']?>页，到第
                                <input type="text" class="ui-page-skipTo" size="3" name="page" value="<?=$filter['page']?>" onkeydown="javascript:if(event.keyCode==13){page_jump('<?=$kw?>', this, 'h_all_data', 3, <?=$tmid?>);return false;}"/>页
                                <button type="button" class="ui-btn-s" onclick="page_jump('<?=$kw?>', this, 'h_all_data', 3, <?=$tmid?>)">确定</button>
                        </b>                       

                    </div>
                </div>
            <?php } ?>   
            <!-- 分页结束 -->
       </div>
       
       <div id="h_yuanchuang_data" class="search-result-list" style="display:none;">
       </div>
       
       <div id="h_kepu_data" class="search-result-list" style="display:none;">             
       </div>
       
       <div id="h_jishu_data" class="search-result-list" style="display:none;">
       </div>

    </div>
</div>
<?php include APPPATH . 'views/common/footer.php'?>
<script>
$('.dental-common li').click(function () {
        $('.dental-common li').removeClass("dental_current");
        $(this).addClass("dental_current");
        $('.encyclopedia .search-result-list').hide();
        $('.encyclopedia .search-result-list').eq($(this).index()).show();
});
function page_jump(p_key, p_obj, p_target, p_tid, p_tmid){
    var v_page = $(p_obj).parent('b').children("input[type=text][name=page]").val();
    filter_product(p_key, v_page, p_target, p_tid, p_tmid);
}

function filter_product(p_key, p_page, p_target, p_tid, p_tmid){
    var v_url = '';
    var v_post = {kw:p_key, page:p_page, tid:p_tid, target:p_target, tmid:p_tmid};

    if (p_target == 'h_product_list' || p_target == 'h_course_list') {
        v_url = '/search/product';
    } else {        
        v_url = '/search/article';
    }

    $.ajax({
            url:v_url,
            data:v_post,
            dataType:'json',
            type:'POST',
            success:function(result){
                $("#"+p_target).html(result.content);
                /*if(result.err == 2){
                    checkLogin(false);
                    return;
                }*/
                
                //console.log(result.msg);
            },
            error:function(err) {
                console.log(err);
            }
    });
}
</script>