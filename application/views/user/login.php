<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<title>悦牙网 | 登录</title>
<link href="<?php echo static_style_url('new_pc/css/user_login.css?v=version');?>" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrap-login">
    <div class="login-box">
        <div class="login-main">
            <div class="logo"><a href="/"><img src="<?php echo static_style_url('new_pc/images/login_logo.png?v=version');?>" width="200" alt="悦牙网" /></a></div>
            <div class="form-wrapper clearfix"> 
                <form method="post" action="#" name="loginForm">
                    <p class="error"></p>
                    <div class="loginUser Logincom">
                        <label for="username" class="userLogo loginplic"></label>
		  				<input class="loginInput" name="username"  placeholder="请输入手机号码" >
                    </div>
                    <p class="error"></p>
                    <div class="loginUser Logincom">
                        <label for="username" class="passWord loginplic"></label>
		  				<input class="loginInput" name="password" id="password"  placeholder="请输入密码" type="password" >
                    </div>                   
                    <div class="Logincom checkgroup">
                        <input type="checkbox" id="checkbox-1-1" class="regular-checkbox" /><label for="checkbox-1-1"></label><span>下次自动登录</span>
                        <div class="forget-mm"><a href="/user/forgot">忘记密码？</a></div>
                    </div>                    
                    <div class="Logincom clearfix">
                        <button class="btn btn-default disabled" type="submit">登录</button>
                        <p class="fr">还没账号?<a href="/user/signin">注册</a></p>
                    </div>
                </form>
                <div class="horizontal"><span>可以使用以下方式登录</span></div>
                <div class="other">
                    <a href="/user/qq_login" class="qq"></a>                  
                    <a href="/user/weixin_login" class="weixin"></a>		  
                    <a href="/user/alipay_login" class="alipay"></a>                 
                    <a href="/user/xinlang_login" class="sina"></a>
                </div>  
            </div>
        </div>     
    </div>
</div>
<script type="text/javascript" src="<?php echo static_style_url('new_pc/js/jquery-3.0.0.min.js?v=version')?>"></script>
<script type="text/javascript" src="<?php echo static_style_url('new_pc/js/user_login.js?v=version')?>"></script>
</body>
</html>
