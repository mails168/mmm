<?php include APPPATH . 'views/common/header.php'?>

<div class="item-hide"><H1>行业领先牙科材料，齿科材料，口腔材料牙科电商平台!</H1></div>

<?php if(!empty($pc_top_carousel)){?>
<div class="banner banner-small">
   <div class="shuffling">
        <div class="banner-inner">
            <div class="ck-slide">
                 <ul class="ck-slide-wrapper">
                     
                     <?php foreach($pc_top_carousel as $k => $v):?>
                         <li style="<?php echo $k == 0 ? '' : 'display:none'?>"><a href="<?php echo $v['href'];?>" target="_blank"><img class="unlazy" src="<?php echo img_url($v['img_src']);?>" width="1170" height="460" alt=""/></a></li>
                     <?php endforeach;?>
                 </ul>
                  <div class="ck-slidebox">
                    <div class="slideWrap">
                         <ul class="dot-wrap">
                             
                             <?php foreach($pc_top_carousel as $k => $v):?>
                                 <li class="<?php echo ($k == 0 ? "current" : '')?>"><em><?php echo $k + 1?></em></li>
                             <?php endforeach;?>
                         </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="contain">
    <?php if(!empty($pc_hot_product)){ ?>
    <div id="remaishangpin" class="optimal-product clearfix">
        <div class="optimal-product-tit">
            <div class="optimal-product-tit-inner clearfix">
                <span class="line"></span>

                <div class="item-hide"><H2>优秀牙科材料，齿科材料，口腔材料精品展示区</H2></div>

                <span class="hotbt">精心为您挑选最优商品</span>
                <span class="hot-pro">最新热卖商品</span>
            </div>
        </div>
        <div  id="focus-img" class="optimal-product-list focus-img" >
            <div class="focus-img-con" id="focus-img-con">
                <?php foreach($pc_hot_product as $v){ ?>
                <ul class="optimal-product-lb clearfix">
                    <?php foreach($v->products_info as $pro){ ?>
                    <li>
                        <a target="_blank" href="/pdetail-<?php echo $pro->product_id;?>.html" class="proInfo-box">
                            <div class="optimal-img"><img class="lazy" data-original="<?php echo img_url($pro->img_url);?>"  alt="<?php echo $pro->product_name;?>"/></div>
                            <div class="txt-body">
                                <div class="optimal-mc"><span><?php echo $pro->brand_name;?></span><?php echo $pro->product_name;?></div>
                                <div class="optimal-sprice"><i>¥</i><?php echo $pro->product_price;?><span><i>¥</i><em><?php echo $pro->market_price;?></em></span></div>
                            </div>
                        </a>
                        <!-- <a href="#" class="go-cart"><i class="add_cart"></i>加入购物车</a> -->
                        <a href="/pdetail-<?php echo $pro->product_id;?>.html" class="go-cart">查看详情</a>
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
        </div>       
    </div>
    <?php } ?>
    
    <!-- <div id="huodongjingxuan" class="more-splendid">
        <div class="optimal-product-tit">
            <div class="optimal-product-tit-inner clearfix">
                <span class="line"></span>
                <h1>更多精彩活动</h1>
                <span class="hot-pro">大品牌也特卖</span>
            </div>
        </div>
        <div class="more-splendid-list">
            <ul class="more-splendid-pic clearfix">
                <li>
                    <a href="#" class="hotsale-img-box"><img class="lazy" data-original="image/1.jpg" width="585" height="350" alt=""/></a>
                    <div class="hotsale-hover trans300 transparency">
                        <div class="hotsale-pro-list clearfix">
                            <a class="hotsale-pro-item" target="_blank" href="#">
                                <img alt="" src="image/pro_small_1.jpg" class="hotsale-pro-img">
                                <p class="hotsale-pro-price"><span class="hotsale-pro-mc">牙周抑菌软膏</span><span class="hotsale-pro-jg">¥2864</span></p>
                            </a>
                            <a class="hotsale-pro-item" target="_blank" href="#">
                                <img alt="" src="image/pro_small_2.jpg" class="hotsale-pro-img">
                                <p class="hotsale-pro-price"><span class="hotsale-pro-mc">牙周抑菌软膏</span><span class="hotsale-pro-jg">¥2864</span></p>
                            </a>
                            <a class="hotsale-pro-item" target="_blank" href="#">
                                <img alt="" src="image/pro_small_3.jpg" class="hotsale-pro-img">
                                <p class="hotsale-pro-price"><span class="hotsale-pro-mc">牙周抑菌软膏</span><span class="hotsale-pro-jg">¥2864</span></p>
                            </a>
                        </div>
                        <a class="enter-btn" target="_blank" href="#">查看活动详情</a>
                    </div>
                </li>
                <li><a href="#"><img class="lazy" data-original="image/2.jpg" width="585" height="350" alt=""/></a></li>
                <li><a href="#"><img class="lazy" data-original="image/3.jpg" width="585" height="350" alt=""/></a></li>
                <li><a href="#"><img class="lazy" data-original="image/4.jpg" width="585" height="350" alt=""/></a></li>
                <li><a href="#"><img class="lazy" data-original="image/5.jpg" width="585" height="350" alt=""/></a></li>
                <li><a href="#"><img class="lazy" data-original="image/1.jpg" width="585" height="350" alt=""/></a></li>
            </ul>
        </div>
    </div> -->
    
    <?php if(!empty($pc_mouth_product)){ ?>
    <div id="kouqiangqicai" class="dental-equipments">

    <div class="item-hide"><H2>优质牙科材料，齿科材料，口腔材料器材特卖区</H2></div>


        <div class="dental-equipments-title clearfix">
            <div class="dental-equipments-mc fl">口腔器材<span>PROFESSIONAL PRODUCT</span></div>
            <div class="dental-equipments-more fr"><a href="/category?cat=622&brand=&price=&page=0&sort=">查看更多</a><span></span></div>
        </div>
        <ul class="more-splendid-pic dental-equipments-lb clearfix">
            <?php foreach($pc_mouth_product as $v): ?>
            <li>
                <a href="javascript:(void);" class="hotsale-img-box"><img class="lazy" data-original="<?php echo img_url($v->pic_url);?>" width="585" height="275" alt="<?php echo $v->ad_name;?>"/>
                    <div class="dental-equipments-bottom">

                        <div class="item-hide"><H3><?php echo $v->seo;?></H3></div>

                        <div class="dental-mc fl"><i><?php echo $v->ad_name;?></i><span><?php echo $v->desc;?></span></div> 
                    </div>
                </a>
                <div class="hotsale-hover hotsale-hover2 trans300 transparency">
                    <div class="hotsale-pro-list clearfix">
                        <?php foreach ($v->products_info as $pro) { ?>
                        <a class="hotsale-pro-item hotsale-pro-item2" target="_blank" href="/pdetail-<?php echo $pro->product_id;?>.html">
                            <img alt="<?php echo $pro->product_name;?>" src="<?php echo img_url($pro->img_url);?>" class="hotsale-pro-img">
                            <p class="hotsale-pro-price"><span class="hotsale-pro-mc"><?php echo $pro->product_name;?></span></p>
                        </a>
                        <?php } ?>
                    </div>
                    <div class="hotsale-hover3">
                        <span class="brand-pic">
                        <?php foreach ($v->brands_info as $brn) { ?>
                            <a href="/brand/index/<?php echo $brn->brand_id;?>"><img alt="<?php echo $brn->brand_name;?>" src="<?php echo img_url($brn->brand_logo);?>"></a>                    
                        <?php } ?>
                        </span>
                        <a class="enter-btn enter-btn2" target="_blank" href="<?php echo $v->ad_link;?>">查看全部<?php echo $v->ad_name;?></a>
                    </div>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php } ?>
    
    <?php if(!empty($pc_nurse_product)){ ?>
    <div id="hulibaojian" class="nursing-care clearfix">

        <div class="item-hide"><H2>优质口腔材料（日常用品）特卖区</H2></div>

        <div class="dental-equipments-title red-line clearfix">
            <div class="dental-equipments-mc fl red-line-bold">护理保健<span>CONSUMMER PRODUCT</span></div>
            <div class="dental-equipments-more fr"><a href="/category?cat=2&brand=&price=&page=0&sort=">查看更多</a><span></span></div>
        </div>
        <ul class="more-splendid-pic dental-equipments-lb clearfix">
            <?php foreach($pc_nurse_product as $v): ?>
            <li>
                <a href="javascript:(void);" class="hotsale-img-box"><img class="lazy" data-original="<?php echo img_url($v->pic_url);?>" width="585" height="275" alt="<?php echo $v->ad_name;?>"/>
                    <div class="dental-equipments-bottom">

                        <div class="item-hide"><H3><?php echo $v->seo;?></H3></div>

                        <div class="dental-mc fl"><i><?php echo $v->ad_name;?></i><span><?php echo $v->desc;?></span></div> 
                    </div>
                </a>
                <div class="hotsale-hover hotsale-hover2 trans300 transparency">
                    <div class="hotsale-pro-list clearfix">
                        <?php foreach ($v->products_info as $pro) { ?>
                        <a class="hotsale-pro-item hotsale-pro-item2" target="_blank" href="/pdetail-<?php echo $pro->product_id;?>.html">
                            <img alt="<?php echo $pro->product_name;?>" src="<?php echo img_url($pro->img_url);?>" class="hotsale-pro-img">
                            <p class="hotsale-pro-price"><span class="hotsale-pro-mc"><?php echo $pro->product_name;?></span></p>
                        </a>
                        <?php } ?>
                    </div>
                    <div class="hotsale-hover3">
                        <span class="brand-pic">
                        <?php foreach ($v->brands_info as $brn) { ?>
                            <a href="/brand/index/<?php echo $brn->brand_id;?>"><img alt="<?php echo $brn->brand_name;?>" src="<?php echo img_url($brn->brand_logo);?>"></a>                    
                        <?php } ?>
                        </span>
                        <a class="enter-btn enter-btn2" target="_blank" href="<?php echo $v->ad_link;?>">查看全部<?php echo $v->ad_name;?></a>
                    </div>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php } ?>
    
    <?php if(!empty($pc_room_course)){ ?>
    <div id="yueyajiangtang" class="tooth-lecture clearfix">

        <div class="item-hide"><H2>牙科材料，齿科材料，口腔材料在线教育专区</H2></div>

        <div class="dental-equipments-title green-line clearfix">
            <div class="dental-equipments-mc fl green-line-bold">悦牙讲堂<span>TRAINING & WORKSHOP</span></div>
            <div class="dental-equipments-more fr"><a href="/index/course">查看更多</a><span></span></div>
        </div>
        <ul class="tooth-list clearfix">
            <?php foreach($pc_room_course as $v): ?>
            <li>
                <div class="tooth-top">
                <?php foreach ($v->products_info as $pro) { ?>
                    <a href="/product-<?php echo $pro->product_id;?>.html">
                        <div class="tooth-img"><img class="lazy" data-original="<?php echo img_url($pro->img_url);?>" width="275" height="275" alt="<?php echo $pro->product_name;?>"/></div>
                        <div class="tooth-con">
                            <h2><?php echo $pro->product_name;?></h2>
                            <?php $product_desc_additional = (!empty($pro->product_desc_additional)) ? json_decode($pro->product_desc_additional, true) : array(); ?>  
                            <span class="tooth-con-time"><i></i><?php echo date("m月d日", strtotime($pro->package_name));?>-<?=date("m月d日", strtotime($product_desc_additional['desc_waterproof']));?></span>
                            <span class="tooth-con-dz"><i></i><?php echo $product_desc_additional['desc_material'];?></span>
                            <p class="tooth-xx"><?php echo cutstr_html($pro->product_desc,0);?></p>
                        </div>
                    </a>
                    <div class="yh-box">限时优惠￥<?php echo $pro->product_price;?></div>
                <?php } ?>
                </div>
                <div class="tooth-teacher clearfix"><i><?php echo $v->ad_name;?></i><span><?php echo $v->desc;?></span></div>
            </li>
            <?php endforeach;?>           
        </ul>
    </div>
    <?php } ?>
    
    <?php if(!empty($pc_video_article)){ ?>
    <div id="baikeshipin" class="encyclopedia">

        <div class="item-hide"><H2>牙科材料，齿科材料，口腔材料相关文章</H2></div>   
        
        <div class="dental-equipments-title blue-line clearfix">
            <div class="dental-equipments-mc fl blue-line-bold">悦牙百科视频<span>VEDIO</span></div>
            <div class="dental-equipments-more fr"><a href="/article/video">查看更多</a><span></span></div>
        </div>
        <?php foreach($pc_video_article as $v){ if($v->type == 'video'){ ?>
        <ul class="encyclopedia-video clearfix">
            <?php foreach ($v->products_info as $pro) { ?>
            <li>
                <a href="/article/video_detail/<?php echo $pro->ID;?>"><img class="lazy" data-original="<?php echo $pro->cover;?>" width="585" height="275" alt="<?php echo $pro->post_title;?>"/>
                    <span class="video-ico"></span>
                </a>
                
                <p><?php echo $pro->post_title;?></p>
            </li>
            <?php } ?>
        </ul>
        <?php } } ?>    
    </div>

    <div id="baikewenzhang" class="encyclopedia">
        <div class="dental-equipments-title blue-line clearfix">
            <div class="dental-equipments-mc fl blue-line-bold">悦牙百科文章<span>ARTICLE</span></div>
            <div class="dental-equipments-more fr"><a href="/article">查看更多</a><span></span></div>
        </div>
        <?php foreach($pc_video_article as $v){ if($v->type == 'article'){ ?>    
        <ul class="video_list clearfix">
            <?php foreach ($v->products_info as $pro) { ?>
            <li>
                <div class="video_list_top clearfix">
                    <div class="video_list_pic"><a href="/article/detail/<?php echo $pro->ID;?>"><img class="lazy" data-original="<?php echo $pro->cover;?>" width="275" height="275" alt="<?php echo $pro->post_title;?>"/></a></div>
                    <div class="video_list_js">
                        <a href="/article/detail/<?php echo $pro->ID;?>"><?php echo $pro->intro;?></a>
                    </div>
                </div>
                <p class="video_list_bt"><?php echo $pro->post_title;?></p>
            </li>
            <?php } ?>
        </ul>
        <?php } } ?>       
    </div>
    <?php } ?>
    
    <?php if(!empty($pc_brand_teamwork)){ ?>  
    <div id="hezuopinpai" class="cooperation_brand clearfix">
        <div class="dental-equipments-title blue-line clearfix">
            <div class="dental-equipments-mc fl blue-line-bold">合作品牌<span>VEDIO & ARTICLE</span></div>
            <div class="apply_ico fr"><a href="/about_us/team_work">申请合作<span></span></a></div>
        </div>
        <ul class="cooperation_lb clearfix">
            <?php foreach ($pc_brand_teamwork as $bra) { ?>
            <li><a href="<?php echo $bra->link_url; ?>"><img class="lazy" data-original="<?php echo img_url($bra->brand_logo); ?>" alt="<?php echo $bra->brand_name; ?>"/></a></li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
</div>

<div id="left-side" class="left-side">
    <div class="left-side-dw mui-lift">
        <?php if(!empty($pc_hot_product)){ ?> 
        <a data-anchor="remaishangpin" href="#remaishangpin" class="currt mui-lift-nav color-orange">
            <span class="left-side_ico left-side_ico1"></span>
            <span class="left-side-wz">热卖商品</span>
        </a>
        <?php } ?>
        <!-- <a data-anchor="huodongjingxuan" href="#huodongjingxuan" class="mui-lift-nav color-orange">
            <span class="left-side_ico left-side_ico2"></span>
            <span class="left-side-wz">活动精选</span>
        </a> -->
        <?php if(!empty($pc_mouth_product)){ ?> 
        <a data-anchor="kouqiangqicai" href="#kouqiangqicai" class="mui-lift-nav color-orange">
            <span class="left-side_ico left-side_ico3"></span>
            <span class="left-side-wz">口腔器材</span>
        </a>
        <?php } ?>
        <?php if(!empty($pc_nurse_product)){ ?> 
        <a data-anchor="hulibaojian" href="#hulibaojian" class="mui-lift-nav color-orange">
            <span class="left-side_ico left-side_ico4"></span>
            <span class="left-side-wz">护理保健</span>
        </a>
        <?php } ?>
        <?php if(!empty($pc_room_course)){ ?> 
        <a data-anchor="yueyajiangtang" href="#yueyajiangtang" class="mui-lift-nav color-orange">
            <span class="left-side_ico left-side_ico5"></span>
            <span class="left-side-wz">悦牙讲堂</span>
        </a>
        <?php } ?>
        <?php if(!empty($pc_video_article)){ ?> 
        <a data-anchor="baikeshipin" href="#baikeshipin" class="mui-lift-nav color-orange">
            <span class="left-side_ico left-side_ico6"></span>
            <span class="left-side-wz">悦牙百科</span>
        </a>
        <?php } ?>
        <?php if(!empty($pc_brand_teamwork)){ ?>  
        <a data-anchor="hezuopinpai" href="#hezuopinpai" class="left-side-rr mui-lift-nav color-orange">
            <span class="left-side_ico left-side_ico8"></span>
            <span class="left-side-wz">合作品牌</span>
        </a>
        <?php } ?>
    </div>
</div>

<?php if(!empty($pc_link_list)){ ?>
<div class="friendship-link">
    <div class="footer-inner">
        <div class="link-inner clearfix">
            <div class="link-bt fl">友情链接：</div>
            <div class="link-lb fl">
                <div class="link-yichu">
                <?php foreach ($pc_link_list as $val_url) { ?>
                    <a href="<?php echo $val_url->link_url;?>" target="_blank"><?php echo $val_url->link_name;?></a>|
                <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php include APPPATH . 'views/common/footer.php'?>


<script type="text/javascript" src="<?php echo static_style_url('new_pc/js/slide.js?v=version');?>"></script>
<script type="text/javascript" src="<?php echo static_style_url('new_pc/js/index.js?v=version');?>"></script>
