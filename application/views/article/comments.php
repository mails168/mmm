<?php foreach ($comments as $comment):?>
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