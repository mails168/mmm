<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>悦牙网购物车</title>
<link href="<?php echo static_style_url('new_pc/css/common.css?v=version')?>" rel="stylesheet" type="text/css">
<link href="<?php echo static_style_url('new_pc/css/style.css?v=version')?>" rel="stylesheet" type="text/css">
</style>
</head>
<body>
<header class="common-header">
     <nav class="top">
          <div class="head-inner clearfix">
               <div class="top-left fl">您好，欢迎来悦牙网, 请<a href="#" class="top-login">登录</a><a href="#">免费注册</a></div>
               <div class="top-right fr">
                   <a href="#"><i class="ico-mob"></i>手机悦牙</a>
                   <div class="top-code" style="display: none;"><img src="<?php echo static_style_url('new_pc/images/code.jpg')?>" alt="" /></div>
             </div>
       </div>
   </nav>
   <div class="cart_header">
        <div class="head-inner cart_notop clearfix">
             <div class="logo clearfix">
                  <a href="/" class="logonbg">悦牙网</a>
                 <span class="ad"><img src="<?php echo static_style_url('new_pc/images/'.((isset($page_type) && $page_type == 'course')? 'yykt' : 'cart').'.gif')?>" width="97" height="56" alt=""/></span>
           </div>
       </div>
   </div>
</header>