<?php include APPPATH . 'views/common/header.php'?>
<div class="contain">
    <div class="recommend2 search-result">
        <ul class="recommend-top2">
            <li class="sp_current2">悦牙商城（<?=$product['filter']['record_count']?>）</li>
            <li>悦牙讲堂（<?=$course['filter']['record_count']?>）</li>
            <li>悦牙文章（<?=$article['filter']['record_count']?>）</li>
            <li>悦牙视频（<?=$video['filter']['record_count']?>）</li>
        </ul>
           
        <div id="h_product_list" class="search-result-list">
            <ul class="mall_pro_list clearfix">
                <?php foreach($product['list'] as $p): 
                    format_product($p);
                ?>
                <li>
                    <a href="/pdetail-<?php echo $p->product_id;?>">
                       <div class="mall_pro-img"><img src="<?php echo img_url($p->img_url.".220x220.jpg");?>" alt="" /></div>
                       <div class="mall_pro-mc"><span><?php echo $p->brand_name;?></span><?php echo $p->product_name;?></div>
                       <div class="mall_pro-sprice"><i>¥</i><?php echo $p->product_price;?><span><i>¥</i><?php echo $p->market_price;?></span></div>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            
            <!-- 分页开始 -->
            <?php if ($product['filter']['page_count'] > 1){ ?>
                <div class="ui-page clearfix">
                    <div class="ui-page-wrap">                        
                        <b class="ui-page-num">                            
                            <?php if ($product['filter']['page'] <= 1) { ?>
                            <b class="ui-page-prev">&lt;&lt;上一页</b>
                            <?php } else { ?>
                            <a class="ui-page-prev" href="javascript:filter_product('<?=$kw?>', <?=$product['filter']['page']-1?>, 'h_product_list', 1);">&lt;&lt;上一页</a>
                            <?php } ?>                         
                            
                            <?php foreach ($product_pagelist_num as $arr_list_num): ?>
                                <?php if ($arr_list_num == "...") { ?>
                                    <b class="ui-page-break">...</b>
                                <?php } ?>
                                <?php if ($arr_list_num == $product['filter']['page']) { ?>
                                    <b class="ui-page-cur"><?= $arr_list_num ?></b>
                                <?php } elseif ($arr_list_num != "...") { ?>
                                    <a href="javascript:filter_product('<?=$kw?>', <?=$arr_list_num?>, 'h_product_list', 1);"><?=$arr_list_num ?></a>
                                <?php } ?>
                            <?php endforeach; ?>
                            
                            <?php if ($product['filter']['page'] >= $product['filter']['page_count']) { ?>
                            <b class="ui-page-next">下一页&gt;&gt;</b>
                            <?php } else { ?>
                            <a class="ui-page-next" href="javascript:filter_product('<?=$kw?>', <?=$product['filter']['page']+1?>, 'h_product_list', 1);">下一页&gt;&gt;</a>
                            <?php } ?>
                        </b>                        
                        <b class="ui-page-skip">
                                共<?=$product['filter']['page_count']?>页，到第
                                <input type="text" class="ui-page-skipTo" size="3" name="page" value="<?=$product['filter']['page']?>" onkeydown="javascript:if(event.keyCode==13){page_jump('<?=$kw?>', this, 'h_product_list', 1);return false;}"/>页
                                <button type="button" class="ui-btn-s" onclick="page_jump('<?=$kw?>', this, 'h_product_list', 1)">确定</button>
                        </b>                       
                        
                    </div>
                </div>
            <?php } ?>   
            <!-- 分页结束 -->    
            
        </div>   
       
        <div id="h_course_list" class="search-result-list" style="display:none;">   
              <ul class="tooth-list clearfix">
              <?php foreach($course['list'] as $v): format_product($v);?>
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
            <?php if ($course['filter']['page_count'] > 1){ ?>
                <div class="ui-page clearfix">
                    <div class="ui-page-wrap">                        
                        <b class="ui-page-num">                            
                            <?php if ($course['filter']['page'] <= 1) { ?>
                            <b class="ui-page-prev">&lt;&lt;上一页</b>
                            <?php } else { ?>
                            <a class="ui-page-prev" href="javascript:filter_product('<?=$kw?>', <?=$course['filter']['page']-1?>, 'h_course_list', 2);">&lt;&lt;上一页</a>
                            <?php } ?>                         
                            
                            <?php foreach ($course_pagelist_num as $arr_list_num): ?>
                                <?php if ($arr_list_num == "...") { ?>
                                    <b class="ui-page-break">...</b>
                                <?php } ?>
                                <?php if ($arr_list_num == $course['filter']['page']) { ?>
                                    <b class="ui-page-cur"><?= $arr_list_num ?></b>
                                <?php } elseif ($arr_list_num != "...") { ?>
                                    <a href="javascript:filter_product('<?=$kw?>', <?=$arr_list_num?>, 'h_course_list', 2);"><?=$arr_list_num ?></a>
                                <?php } ?>
                            <?php endforeach; ?>
                            
                            <?php if ($course['filter']['page'] >= $course['filter']['page_count']) { ?>
                            <b class="ui-page-next">下一页&gt;&gt;</b>
                            <?php } else { ?>
                            <a class="ui-page-next" href="javascript:filter_product('<?=$kw?>', <?=$course['filter']['page']+1?>, 'h_course_list', 2);">下一页&gt;&gt;</a>
                            <?php } ?>
                        </b>
                        <b class="ui-page-skip">
                                共<?=$product['filter']['page_count']?>页，到第
                                <input type="text" class="ui-page-skipTo" size="3" name="page" value="<?=$course['filter']['page']?>" onkeydown="javascript:if(event.keyCode==13){page_jump('<?=$kw?>', this, 'h_course_list', 2);return false;}"/>页
                                <button type="button" class="ui-btn-s" onclick="page_jump('<?=$kw?>', this, 'h_course_list', 2)">确定</button>
                        </b>
                        
                    </div>
                </div>
            <?php } ?>   
            <!-- 分页结束 -->
       </div>
       
        <div id="h_article_list" class="search-result-list" style="display:none;">
            <ul class="encyclopedia-video">
                <?php foreach($article['list'] as $v): ?>
                <li>
                    <div class="video_list_top clearfix">
                        <div class="video_list_pic"><a href="/article/detail/<?=$v->ID?>"><img src="<?=$v->cover?>" width="275" height="275" alt=""/></a></div>
                        <div class="video_list_js">
                            <a href="/article/detail/<?=$v->ID?>"><?=$v->intro?></a>
                        </div>
                    </div>
                    <p class="video_list_bt"><?=$v->post_title?></p>
                </li>
                <?php endforeach; ?>       
            </ul>
         
            <!-- 分页开始 -->
            <?php if ($article['filter']['page_count'] > 1){ ?>
                <div class="ui-page clearfix">
                    <div class="ui-page-wrap">                        
                        <b class="ui-page-num">                            
                            <?php if ($article['filter']['page'] <= 1) { ?>
                            <b class="ui-page-prev">&lt;&lt;上一页</b>
                            <?php } else { ?>
                            <a class="ui-page-prev" href="javascript:filter_product('<?=$kw?>', <?=$article['filter']['page']-1?>, 'h_article_list', 3);">&lt;&lt;上一页</a>
                            <?php } ?>                         
                            
                            <?php foreach ($article_pagelist_num as $arr_list_num): ?>
                                <?php if ($arr_list_num == "...") { ?>
                                    <b class="ui-page-break">...</b>
                                <?php } ?>
                                <?php if ($arr_list_num == $article['filter']['page']) { ?>
                                    <b class="ui-page-cur"><?= $arr_list_num ?></b>
                                <?php } elseif ($arr_list_num != "...") { ?>
                                    <a href="javascript:filter_product('<?=$kw?>', <?=$arr_list_num?>, 'h_article_list', 3);"><?=$arr_list_num ?></a>
                                <?php } ?>
                            <?php endforeach; ?>
                            
                            <?php if ($article['filter']['page'] >= $article['filter']['page_count']) { ?>
                            <b class="ui-page-next">下一页&gt;&gt;</b>
                            <?php } else { ?>
                            <a class="ui-page-next" href="javascript:filter_product('<?=$kw?>', <?=$article['filter']['page']+1?>, 'h_article_list', 3);">下一页&gt;&gt;</a>
                            <?php } ?>
                        </b>
                        <b class="ui-page-skip">
                                共<?=$article['filter']['page_count']?>页，到第
                                <input type="text" class="ui-page-skipTo" size="3" name="page" value="<?=$article['filter']['page']?>" onkeydown="javascript:if(event.keyCode==13){page_jump('<?=$kw?>', this, 'h_article_list', 3);return false;}"/>页
                                <button type="button" class="ui-btn-s" onclick="page_jump('<?=$kw?>', this, 'h_article_list', 3)">确定</button>
                        </b>
                        
                    </div>
                </div>
            <?php } ?>   
            <!-- 分页结束 -->
        </div>
        
        <div id="h_video_list" class="search-result-list" style="display:none;">
            <ul class="encyclopedia-video">
                <?php foreach($video['list'] as $v): ?>
                <li>
                    <a href="/article/detail/<?=$v->ID?>"><img src="<?=$v->cover?>" width="585" height="275" alt=""/></a>
                    <span class="video-ico"></span>
                    <p><?=$v->post_title?></p>
                </li>
                <?php endforeach; ?>
            </ul>            
            <!-- 分页开始 -->
            <?php if ($video['filter']['page_count'] > 1){ ?>
                <div class="ui-page clearfix">
                    <div class="ui-page-wrap">                        
                        <b class="ui-page-num">                            
                            <?php if ($video['filter']['page'] <= 1) { ?>
                            <b class="ui-page-prev">&lt;&lt;上一页</b>
                            <?php } else { ?>
                            <a class="ui-page-prev" href="javascript:filter_product('<?=$kw?>', <?=$video['filter']['page']-1?>, 'h_video_list', 4);">&lt;&lt;上一页</a>
                            <?php } ?>                         
                            
                            <?php foreach ($video_pagelist_num as $arr_list_num): ?>
                                <?php if ($arr_list_num == "...") { ?>
                                    <b class="ui-page-break">...</b>
                                <?php } ?>
                                <?php if ($arr_list_num == $video['filter']['page']) { ?>
                                    <b class="ui-page-cur"><?= $arr_list_num ?></b>
                                <?php } elseif ($arr_list_num != "...") { ?>
                                    <a href="javascript:filter_product('<?=$kw?>', <?=$arr_list_num?>, 'h_video_list', 4);"><?=$arr_list_num ?></a>
                                <?php } ?>
                            <?php endforeach; ?>
                            
                            <?php if ($video['filter']['page'] >= $video['filter']['page_count']) { ?>
                            <b class="ui-page-next">下一页&gt;&gt;</b>
                            <?php } else { ?>
                            <a class="ui-page-next" href="javascript:filter_product('<?=$kw?>', <?=$video['filter']['page']+1?>, 'h_video_list', 4);">下一页&gt;&gt;</a>
                            <?php } ?>
                        </b>
                        <b class="ui-page-skip">
                                共<?=$video['filter']['page_count']?>页，到第
                                <input type="text" class="ui-page-skipTo" size="3" name="page" value="<?=$video['filter']['page']?>" onkeydown="javascript:if(event.keyCode==13){page_jump('<?=$kw?>', this, 'h_video_list', 4);return false;}"/>页
                                <button type="button" class="ui-btn-s" onclick="page_jump('<?=$kw?>', this, 'h_video_list', 4)">确定</button>
                        </b>
                        
                    </div>
                </div>
            <?php } ?>   
            <!-- 分页结束 -->
            
            
        </div>    
        
      </div> 
</div>
<?php include APPPATH . 'views/common/footer.php'?>
<script>
$('.recommend-top2 li').click(function () {
      $('.recommend-top2 li').removeClass("sp_current2");
      $(this).addClass("sp_current2");
      $('.recommend2 .search-result-list').hide();
      $('.recommend2 .search-result-list').eq($(this).index()).show();
});
function page_jump(p_key, p_obj, p_target, p_tid){
    var v_page = $(p_obj).parent('b').children("input[type=text][name=page]").val();
    filter_product(p_key, v_page, p_target, p_tid);
}

function filter_product(p_key, p_page, p_target, p_tid){
    var v_url = '';
    var v_post = {kw:p_key, page:p_page, tid:p_tid, target:p_target};
    if (p_target == 'h_video_list' || p_target == 'h_article_list') {
        v_url = '/search/article';
    } else {
        v_url = '/search/product';
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