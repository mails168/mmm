<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta http-equiv=Content-Type content="text/html;charset=utf-8">
        <title><?php echo isset($title) ? $title : '悦牙网'?></title>
        <meta name="Keywords" content="<?php echo isset($keywords) ? $keywords : '悦牙网';?>">
        <meta name="Description" content="<?php echo isset($description) ? $description : '悦牙网';?>">
        <link href="<?php echo static_style_url('new_pc/css/common.css?v=version');?>" rel="stylesheet" type="text/css">
        <link href="<?php echo static_style_url('new_pc/css/style.css?v=version');?>" rel="stylesheet" type="text/css">
    </head>
    <body>

        <header class="common-header">
            <nav class="top">
                <div class="head-inner clearfix">
                    <div class="top-left fl"></div>
                    <div class="top-right fr">
                        <a href="javascript:(void);"><i class="ico-mob"></i>手机悦牙</a>
                        <div class="top-code" style="display:none;"><img src="<?php echo static_style_url('new_pc/images/code.jpg?v=version');?>" width="137" height="137" alt="悦牙网"/></div>
                    </div>
                </div>
            </nav>
            <div class="yy-center">
                <div class="head-inner clearfix">
                    <div class="logo clearfix">
                        <a href="/" class="logonbg">悦牙网</a>
                        <span class="ad"><img src="<?php echo static_style_url('new_pc/images/ad.gif?v=version');?>" width="140" height="56" alt="悦牙网"/></span>
                    </div>
                    <div class="search-input clearfix">
                        <form action="/search/index">
                            <input type="text" class="text" name="kw" value="<?=isset($kw) ? $kw : '';?>">
                            <button class="search-button"><i></i>搜索</button>
                        </form>
                    </div>
                    <div class="yy-service"><img src="<?php echo static_style_url('new_pc/images/service.jpg?v=version');?>" width="195" height="92" alt="悦牙网"/></div>
                    <div class="hot-search">
                        <span href="#">热门搜索：</span>
                        <?php 
                        $word_list = hot_word();
                        foreach($word_list['list'] as $w):
                        ?>
                        <a href="/search/index?kw=<?=$w['hotword_name']?>"><?=$w['hotword_name']?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php   
                $index = 0;
                if (strpos($_SERVER['PHP_SELF'], '/category')){
                    $index = 1;
                }
                $menus = array(
                                array('name' => '首页', 'href' => '/'), 
                                array('name' => '悦牙商城', 'href' => '/category'), 
                                array('name' => '悦牙讲堂', 'href' => '/index/course'), 
                                array('name' => '悦牙百科', 'href' => 'javascript:void(0);', 'class' => 'c_baike'), 
                                array('name' => '悦牙快讯', 'href' => '/')
                        );
            ?>
            <nav class="menu">
                <div class="menu nav-banner">
                    <div class="head-inner clearfix">
                        <ul class="menu-list">
                            <div class="meun_list_left">
                                <?php foreach($menus as $key => $m):?> 
                                <li>    
                                <?php if ($index == $key):?>
                                <a class="active" href="<?php echo $m['href']?>"><?php echo $m['name']?></a>
                                <?php else:?>
                                <a href="<?php echo $m['href']?>" class="<?=isset($m['class']) ? $m['class'] : '';?>"><?php echo $m['name']?><? echo $key == 3 ? '<i class="baike-ico"></i>':'';?></a>
                                <?php endif;?>                                
                                <?php if ($key == 3):?>
                                <ul id="h_baike_menu" class="c_baike menu-drop" style="display: none;">
                                    <li><a href="/article">牙科文章</a></li>
                                    <li><a href="/article/video">牙科视频</a></li>
                                </ul>
                                <?php endif;?>
                                </li>
                                <?php endforeach;?>
                            </div>
                            <div class="menu_fenlei">
                                <li><a href="javascript:(void);"><span><img src="<?php echo static_style_url('new_pc/images/classification.png?v=version');?>" alt="悦牙网" /></span>分类</a></li>
                                <?php $category_list = category_nav(); if (!empty($category_list)): ?>
                                <div class="classification_lb v-class-name" style="display:none;">
                                    <div class="classification_left">
                                        <?php 
                                            $i = 0;
                                            foreach($category_list['cat'] as $id => $cat): 
                                            $i++;
                                        ?>
                                        <div class="fenlei_item fore<?=$i?>"><h3><a href="/type-<?=$id?>.html"><?=$cat['name']?></a></h3><i>&gt;</i></div>
                                        <?php endforeach;?>
                                    </div>
                                    <div class="classification_right dorpdown-layer">
                                        <?php foreach($category_list['all_type'] as $id1 => $t1_arr):  ?>
                                        <div class="item-sub">
                                            <?php foreach ($t1_arr['sub'] as $id2 => $t2_arr): ?>
                                            <dl class="fenlei1">
                                                <dt><a href="/type-<?=$id2?>.html"><?=$t2_arr['name']?><i>&gt;</i></a></dt>
                                                <?php if(isset($t2_arr['sub'])): ?>
                                                <dd>
                                                    <?php foreach($t2_arr['sub'] as $id3 => $t3_arr): ?>
                                                    <a href="/type-<?=$id3?>.html"><?=$t3_arr['name']?></a>
                                                    <?php endforeach; ?>
                                                </dd>
                                                <?php endif; ?>
                                            </dl>
                                            <?php endforeach;?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif;?>
                            </div>
                        </ul>
                    </div>
                </div> 
            </nav>
        </header>