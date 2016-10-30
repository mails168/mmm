<?php include APPPATH . 'views/common/header.php'?>
<link rel="stylesheet" type="text/css" href="<?php echo static_style_url('pc/css/tank.css?v=version')?>">
<link rel="stylesheet" type="text/css" href="<?php echo static_style_url('pc/css/signin.css?v=version')?>">
<script src="<?php echo static_style_url('pc/js/jquery-1.11.3.js?v=version')?>" type="text/javascript"></script>
<link href="<?php echo static_style_url('pc/css/bootstrap.css?v=version')?>" rel="stylesheet" type="text/css" media="all">
<script src="<?php echo static_style_url('pc/js/bootstrap.min.js?v=version')?>" type="text/javascript"></script>
<div class="about-us">
    <div class="about-con">
        <p class="course-tit">首页>意见反馈</p>
        <ul class="about-list clearfix">
            <li><a href="/about_us/about_us">关于悦牙网</a></li>
            <li><a href="/about_us/service">服务条款</a></li>
            <li><a href="/about_us/feedback" class="about-currt">意见反馈</a></li>
            <li><a href="/about_us/sales_policy">售后政策</a></li>
            <li><a href="/about_us/team_work">合作咨询</a></li>
            <li><a href="http://jobs.51job.com/all/co2393685.html" target="_blank">加入我们</a></li>
        </ul>
        <div class="about-lb feedback">  
            <p class="about-tit">意见反馈<span>Feedback</span></p>
            <form method="post" action="#" name="feedback_Form">
                <div class="feedback-zb">
                    <p>尊敬的用户：</p>
                    <p class="feedback-wt">您好！为了给您提供更好的服务，欢迎您将使用过程中遇到的问题或宝贵建议，对您的支持和配合表示衷心的感谢！</p>
                    <p class="feedback-bk"><textarea name="comment_content" cols="" rows="" class="textfeedback"></textarea></p>
                </div>
                <p class="manyidu"><i>*</i>您对悦牙网的整体满意度如何？</p>
                <div class="feedback-my">
                    <p><input name="grade" type="radio" value="4" checked>  非常满意</p>
                    <p><input name="grade" type="radio" value="3">  满意</p>
                    <p><input name="grade" type="radio" value="2">  一般</p>
                    <p><input name="grade" type="radio" value="1">  不满意</p>
                    <p><input name="grade" type="radio" value="0">  非常不满意</p>
                </div>
                <p class="manyidu">请留下您的联系方式，以便我们及时回复您</p>
                <ul class="feedback-lx">
                    <li><label>姓名:</label><input name="comment_name" type="text"></li>
                    <li><label>手机号:</label><input name="comment_tel" type="text"><span></span></li>
                </ul>
                <div class="feedback-anniu"><button class="submit-button" type="submit">提交</button></div>
            </form>
        </div>
    </div>
</div>

<!-- 登陆弹层开始 -->
<!-- <div id="login-box" class="modal fade pop-box" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">登录</h4>
            </div>
            <div class="modal-body">
                <div class="form-container">
                    <form name="loginForm" class="form-signin" method="post">
                        <p class="error"></p>
                        <input type="tel" name="username" class="form-control" placeholder="请输入手机号码">
                        <p class="error"></p>
                        <input type="password" id="password" name="password" class="form-control" placeholder="请输入密码" required>
                        <div class="checkbox">
                            <label for="auto_login" class="grey-text"><input class="input-checkbox" type="checkbox" value="1" name="checkout" id="auto_login">下次自动登录</label> <a class="pull-right" href="/user/forgot">忘记密码</a>
                        </div>
                        <div class="btn-block clearfix">
                            <button class="btn btn-lg btn-blue btn-block disabled" type="submit"><i class="fa fa-lock left"></i>登录</button>
                            <p class="pull-right grey-text">还没账号?<a href="/user/register">注册</a></p>
                        </div>
                        <div class="horizontal"><span>可以使用以下方式登录</span></div>
                        <div class="other">
						  <a href="/user/qq_login" class="qq"></a>                  
						  <a href="/user/weixin_login" class="weixin"></a>		  
						  <a href="/user/alipay_login" class="alipay"></a>                 
						  <a href="/user/xinlang_login" class="sina"></a>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- 登陆弹层结束 -->

<script>
$.ajax({
        url:'/index/course',
            data:{page:1, expire:false, cid:<?php echo $pid?>},
            dataType:'json',
            success:function(data){
                if (data.course_list){
                    $('.course-show').append(data.course_list);
                }
            }
})
var range = 50;
var page = 1;
$(document).on("scroll", function(){  
    var srollPos = $(window).scrollTop();
    var totalheight = parseFloat($(window).height()) + parseFloat(srollPos);
    if(($(document).height()-range) <= totalheight) {
        ++page;
        //var expire = false;
        $.ajax({
        url:'/index/course',
            data:{page:page, expire:false, cid:<?php echo $pid?>},
            dataType:'json',
            success:function(data){
                if (data.course_list){
                    $('.tab-pane.active').append(data.course_list);
                } else {
                    console.log('no more');
                }
            }
        })
    }
});
$('#password').on('input propertychange', function(){
    var username = $('input[name="username"]'), psw = $('#password');
    if (0 < username.length && 0 < psw.length){
        $('button.disabled').removeClass('disabled').removeAttr('disabled');        
    }
})
var username = $('input[name="username"]');
username.blur(function(){
    if ('' == username.val()){
        username.prev().text('请输入账号');
        $('button.disabled').attr('disabled', 'disabled');
    } else {
        username.prev().text('');
    }
})
$('form[name="loginForm"]').on('submit', function(e){
    e.preventDefault();
    var psw = $('#password');    
        
    if ('' == psw.val()){
        psw.prev().text('请输入密码');
        $('button.disabled').attr('disabled', 'disabled');
    } else if ('' != $('input[name="username"]').val()) {
        $('button.disabled').removeClass('disabled').removeAttr('disabled');
        $.ajax({url:'/user/proc_login', data:$(this).serialize(), method:'POST', dataType:'json', success:function(data){
            if (1 == data.error){
                $('input[name='+data.name+']').prev().text(data.message);
            } else {
                location.reload();
            }
        }
        })
    }
    return false;
})
</script>
<?php include APPPATH . 'views/common/footer.php'?>
<script type="text/javascript" >
    var comment_tel = $('input[name="comment_tel"]');
    var tel = /^(1[0-9]{10})|(0\d{2,3}-?\d{7,8})$/;

    comment_tel.blur(function(){
        if (!tel.test(comment_tel.val())) {
            comment_tel.parent().find("span").text('请输入正确的联系方式');
        } else {
            comment_tel.parent().find("span").text('');
        }
    })

    $('form[name="feedback_Form"]').on('submit', function(e){
        e.preventDefault();
        $.ajax({url:'/about_us/feedback_add', data:$(this).serialize(), method:'POST', dataType:'json', success:function(data){
            if (data.error == 0 ){    
                $('input[name="'+data.comment_err+'"]').parent().find("span").text(data.comment_msg);        
            }else if(data.error == 2 ){
                $("#login-box").modal('show');
            }else if(data.error == 1 ){
                location.href = "/about_us/feedback_two";
            }
        }
        });
    })
</script>