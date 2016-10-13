<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<title>悦牙网 | 注册</title>
<link href="<?php echo static_style_url('new_pc/css/user_login.css?v=version');?>" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrap-login">
     <div class="login-box">
           <div class="login-main">
              <div class="logo"><a href="/"><img src="<?php echo static_style_url('new_pc/images/login_logo.png?v=version');?>" width="200" alt="悦牙网" /></a></div>
                 <div class="form-wrapper clearfix">
                      <form method="post" action="#" name="registerForm">
                      <ul class="register-now">
                        <p class="error"></p>
                      <li><label>手机号码</label><input type="tel" required name="mobile" class="register-Input" placeholder="请输入手机号码"></li>
                    <p class="error"></p>
                      <li><label>验证码</label><input type="text" required name="authcode" class="register-Input register-yzm" placeholder="请输入验证码" />
                      <a href="#" class="yanzhengma captcha" title="刷新"><img src="/user/show_verify"></a><a class="btn fsyzm">发送验证码</a></li>
                    <p class="error"></p>
                      <li><label>输入密码</label><input type="password" required name="password" class="register-Input" placeholder="请输入密码"></li>
                    <p class="error"></p>
                      <li><label>确认密码</label><input type="password" required name="password1" class="register-Input" placeholder="请输入密码"></li>
                      </ul>
                       
                     <div class="yuedu"><input type="checkbox" id="checkbox" class="regular-checkbox" /><label for="checkbox"></label><span>我已阅读并接受<a href="/about_us/service">悦牙网服务条款。</a></span></div>

                     <div class="zhuchen">
                         <button class="btn btn-default disabled" disabled="disabled" type="submit">立即注册</button>
                         <p class="fr">已有账号?<a href="/user/login">登录</a></p>
                     </div>
                    <p class="error"></p>
                      </form>
                    
                 </div>
           </div>
     </div>
</div>
<script type="text/javascript" src="<?php echo static_style_url('new_pc/js/jquery-3.0.0.min.js?v=version')?>"></script>
<script type="text/javascript" src="<?php echo static_style_url('new_pc/js/user_login.js?v=version')?>"></script>
</body>
</html>
