<?php include APPPATH . 'views/common/header.php'?>

<div class="contain">
     <div class="tooth-lecture clearfix">
          <ul class="tooth-list lecture-lb clearfix">
          	<?php foreach($courses as $product_id => &$course):
$product_desc_additional = (!empty($course['product_desc_additional'])) ? json_decode($course['product_desc_additional'], true) : false;

$course['detail1'] = strip_tags($course['detail1']);
$course['detail5'] = strip_tags($course['detail5']);
?>
              <li>
                  <div class="tooth-top">
                       <a href="/product-<?php echo $product_id;?>.html">
                          <div class="tooth-img"><img class="lazy"  data-original="<?php echo img_url($course['img_url'])?>" width="275" height="275" alt="<?php echo $course['product_name']?>"/></div>
                          <div class="tooth-con">
                               <h2><?php echo $course['product_name'];?></h2>
                               <span class="tooth-con-time"><i></i><?php echo date("Y-m-d", strtotime($course['package_name']));?></span>
                               <span class="tooth-con-dz"><i></i><?php echo $product_desc_additional['desc_material'];?></span>
                               <p class="tooth-xx"><?php echo (mb_strlen($course['detail1']) > 100)? mb_substr($course['detail1'],0,100)."..." : $course['detail1'];?></p>
                          </div>
                      </a>
                      <div class="yh-box">限时优惠￥<?php echo $course['shop_price']?></div>
                  </div>
                  <div class="tooth-teacher clearfix"><i><?php echo (mb_strlen($course['subhead']) > 10)? mb_substr($course['subhead'],0,10)."..." : $course['subhead'];?></i><span><?php echo (mb_strlen($course['detail5']) > 50)? mb_substr($course['detail5'],0,50)."..." : $course['detail5'];?></span></div>
              </li>
              <?php endforeach;?>
         </ul>
        <!-- 
         <div class="ui-page clearfix">
                    <div class="ui-page-wrap">
                        <b class="ui-page-num">
                            <b class="ui-page-prev">&lt;&lt;上一页</b>
                            <b class="ui-page-cur">1</b>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <b class="ui-page-break">...</b>
                            <a class="ui-page-next" href="#">下一页&gt;&gt;</a>
                        </b>
                        <b class="ui-page-skip">
                            <form name="filterPageForm" method="get">
                                <input type="hidden" value="s"><input type="hidden"><input type="hidden">共99页，到第<input type="text" class="ui-page-skipTo" size="3" value="1">页
                         <button type="submit" class="ui-btn-s">确定</button>
                            </form>
                        </b>
                    </div>
                </div>
        --> 
        <!-- 分页开始 -->
        <?php if ($page_count > 1){ ?>
            <div class="ui-page clearfix">
                <div class="ui-page-wrap">                        
                    <b class="ui-page-num">                            
                        <?php if ($page <= 1) { ?>
                        <b class="ui-page-prev">&lt;&lt;上一页</b>
                        <?php } else { ?>
                        <a class="ui-page-prev" href="?page=<?=$page-1?>">&lt;&lt;上一页</a>
                        <?php } ?>                         

                        <?php foreach ($arr_pagelist_num as $arr_list_num): ?>
                            <?php if ($arr_list_num == "...") { ?>
                                <b class="ui-page-break">...</b>
                            <?php } ?>
                            <?php if ($arr_list_num == $page) { ?>
                                <b class="ui-page-cur"><?= $arr_list_num ?></b>
                            <?php } elseif ($arr_list_num != "...") { ?>
                                <a href="?page=<?=$arr_list_num?>"><?=$arr_list_num ?></a>
                            <?php } ?>
                        <?php endforeach; ?>

                        <?php if ($page >= $page_count) { ?>
                        <b class="ui-page-next">下一页&gt;&gt;</b>
                        <?php } else { ?>
                        <a class="ui-page-next" href="?page=<?=$filter['page']+1?>">下一页&gt;&gt;</a>
                        <?php } ?>
                    </b>                        
                    <b class="ui-page-skip">
                        <form name="filterPageForm" method="get">
                            共<?=$page_count?>页，到第
                            <input type="text" class="ui-page-skipTo" size="3" name="page" value="<?=$page?>"/>页
                            <button type="submit" class="ui-btn-s">确定</button>
                        </form>
                    </b>

                </div>
            </div>
        <?php } ?>   
        <!-- 分页结束 --> 
         
         
         
    </div>
 
    
      
       
</div>

<?php include APPPATH . 'views/common/footer.php'?>