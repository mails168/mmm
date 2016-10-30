<?php include APPPATH . 'views/common/header.php'?>
<div class="contain">
    <div class="pro_detail_inner">
        <span class="current-position">当前位置：<a href="/">首页</a>-<a href="/article" class="current-color">悦牙百科</a>-<a href="/article">牙科文章</a>-<a href="#"><?=$category2?></a></span>
        <div class="wikipedia clearfix">
            <div class="wikipedia-left">
                <h1 class="wikipedia-bt"><?php echo $article->post_title?></h1>
                <div class="wikipedia-xx clearfix">
                    <p class="wikipedia-sj"><span><?php echo $article->display_name;?></span>上传于<?php echo $article->post_date?></p>
                    <div class="wikipedia-right clearfix">
                        <div class="wikipedia-ico"><i class="yybk-com-ico yypl-pl"></i><span class="c_comm_cnt"><?php echo $article->comment_count;?>条评论</span></div>
                        <div class="wikipedia-ico">
                            <?php if( (!empty($praise_data) && deep_in_array($article->post_id, $praise_data)) || !empty($_COOKIE['praise_anonymous_'.$article->post_id])) { ?>
                            <i class="yybk-com-ico dianzan-dl dianzan-dl"></i>
                            <?php }else{ ?>
                            <i class="yybk-com-ico dianzan-hs dianzan-dl" onclick="add_to_praise_article(<?php echo $article->post_id?>,this);"></i>
                            <?php } ?>
                             <span class="praise"><?php echo $article->zan_count;?></span>
                        </div>
                        <div class="wikipedia-ico bdsharebuttonbox">
                        	<a href="javascript:void(0);" class="bds_more yypl-fx" data-cmd="more">分享</a>
                        </div>       
                    </div>
                </div>
                       <div class="wikipedia-inner"><?php echo $article->post_content?></div>
                       <div class="comments">
                            <div class="comments-inner">
                                 <span>所有评论（<em class="c_comm_cnt"><?php echo $article->comment_count;?></em>条）</span>
                                 <div class="comments-bk">
                                    <div class="wenben">
                                        <textarea id="liuyan-content" placeholder="填写你的评论"></textarea>
                                        <input type="hidden" id="post_id" value ="<?php echo $article->post_id?>"/> 
                                    </div>
                                      <div class="comments-bot clearfix">
                                            <div class="fl comments-use"><a href="/user/login">登录</a>|<a href="/user/signin">注册</a></div>
                                            <a href="javascript:void(0);" class="fr fbpl submit">发表评论</a>
                                      </div>
                                  </div>
                                  <div class="comments-list">
                                       <ul class="comments-lb clearfix">
                                          <?php foreach ($article->comments as $comment):?>
                                          <li>
                                             <div class="comments-pic">
                                                <?php if(isset($comment['user_advar'])):?>
                                                <img src="<?php echo static_url('mobile/touxiang/'.$comment['user_advar'])?>"/>
                                                <?php else:?>
                                                <img src="<?php echo static_style_url('mobile/img/avatar.jpg?v=version');?>"/>
                                                <?php endif;?>
                                             </div>
                                             <div class="comments-pl">
                                                  <p class="comments-mc"><?php echo ($comment['comment_author']=="") ? '匿名' : $comment['comment_author'];?></p>
                                                  <p class="comments-nr"><?php echo $comment['comment_content']?></p>
                                                  <p class="comments-time"><?php echo $comment['comment_date'];?></p>
                                             </div>
                                          </li>
                                          <?php endforeach?>                                    
                                      </ul>   
                                 </div>
                                 <?php if($page_size > 1): ?>
                                 <div class="more-highlights">
                                     <a href="javascript:void(0);" class="more-zk more-sq" onclick="get_comments(<?=$article->post_id?>);">查看更多精彩评论</a>
                                 </div>
                                 <?php endif; ?>
                            </div>
                       
                       
                       </div>
                       
                  </div>
                  <div class="hottest-articles">
                       <div class="hottest-tit">最热文章</div>
                       <div class="hottest-lb">
                           <?php foreach($relative_articles as $rt): ?>
                            <dl class="clearfix">
                                <dt><a href="/article/detail/<?=$rt->post_id?>"><img src="<?php echo $rt->cover?>" width="140" height="78" alt=""/></a></dt>
                            <dd>
                                <span class="hott-bt"><a href="/article/detail/<?=$rt->post_id?>"><?=$rt->post_title?></a></span>
                               <div class="hottest-ico">
                                    <span><i class="yybk-com-ico eye"></i><em><?php echo get_page_view('article',$rt->post_id);?>次</em></span>
                                    <span><i class="yybk-com-ico pinglun"></i><em><?=$rt->comment_count?></em></span>
                               </div>
                            </dd>
                            </dl>
                           <?php endforeach; ?>             
                       </div>
                  </div>
           </div>   
       </div>
</div>
<?php include APPPATH . 'views/common/footer.php'?>
<script>
//百度分享
	window._bd_share_config = {
		"common": {
			"bdSnsKey": {},
			"bdText": "",
			"bdMini": "1",
			"bdMiniList": ["tsina", "qzone", "weixin", "renren", "tqq", "douban", "sqq"],
			"bdPic": "",
			"bdStyle": "0",
			"bdSize": "32",
		},
		"share": {}
	};
	with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=86835285.js?cdnversion=' + ~(-new Date() / 36e5)];


/**
 *  点 赞
 *  @article_id     赞的 文章id
 *  @article_type   赞 的 文章类型  0=文章
 *  @s              当前要收藏的 元素 （this）
 */
function add_to_praise_article (article_id,s) {
    $.ajax({
            url:'/article/add_to_praise',
            data:{article_id:article_id,rnd:new Date().getTime()},
            dataType:'json',
            type:'POST',
            success:function(result){
                if (result.msg) {
                    alert(result.msg)
                };
                if (result.err) {return false};
                $(s).removeClass('dianzan-hs').addClass('dianzan-dl');
                $(s).removeAttr("onclick");
                $('.praise').html(result.praise_num);
                //$$('.v-zan-num').html('已有'+result.praise_num+'赞');
            }
    });
}
var v_page=1;
$('.submit').on('click', function(){
    var post_id = $('#post_id').val();
    var content = $('#liuyan-content').val();
    if (/^\s*$/.test(content)){
        alert('评论不能为空!');          
        return false;
    } else{
        $.ajax({
            url:'/article/comment',
                data:{is_ajax:true,post_id:post_id,content:content},
                dataType:'json',
                type:'POST',
                success:function(result){
                    if(result.err == 1){
		        alert('评论失败!');
		    } else {

                        var v_comm_cnt = parseInt($(".c_comm_cnt").html());
                        $(".c_comm_cnt").html(v_comm_cnt+1);
                        $(".comments-list ul").prepend(result.content);
                        $('#liuyan-content').val('');
                    }
                }
        });
    }//endif
});

function get_comments(p_id){
    v_page++;
    $.ajax({
            url:'/article/get_comments/'+p_id+'/'+v_page,
            data:{},
            dataType:'json',
            type:'POST',
            success:function(result){
                if (result.err){
                    $(".more-highlights").html('没有更多了');
                } else {
                    if (v_page == 1) {
                        $(".comments-list ul").html(result.content);
                    } else {
                        $(".comments-list ul").append(result.content);
                    }
                }
            }
    });
}
</script>