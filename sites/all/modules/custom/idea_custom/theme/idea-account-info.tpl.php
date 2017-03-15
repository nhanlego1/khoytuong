<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 2/20/17
 * Time: 11:42 PM
 */
?>

<div class="account-information">
    <div class="account-info-header">
        <div class="avatar">
            <?php if ($account->picture): ?>
                <?php print theme('image_style', array('path' => $account->picture->uri, 'style_name' => 'avatar')); ?>
            <?php else: ?>
                <img src="/sites/all/themes/idea/images/default-avatar.png"/>
            <?php endif; ?>
        </div>
        <div class="account-name">
          <span class="title-name">
           <?php isset($account->field_full_name[LANGUAGE_NONE]) ? print $account->field_full_name[LANGUAGE_NONE][0]['value'] : $account->name; ?>
          </span>
            <span class="point-name">
              1200
          </span>
        </div>
        <a href="<?php print url('user/'.$account->uid.'/edit',array('query'=>array('destination'=>'frontpage')));?>">
        <span><i class="fa fa-pencil-custom" aria-hidden="true"></i></span>
        </a>
    </div>
    <div class="clearfix"></div>
    <ul class="account-detail">
        <li class="email"><a href="mailto:<?php print $account->mail ?>"><?php print $account->mail ?></a></li>
        <?php if (isset($account->field_phone[LANGUAGE_NONE])): ?>
            <li class="phone"><a href="#"><?php print $account->field_phone[LANGUAGE_NONE][0]['value'] ?></a></li>
        <?php endif; ?>
        <li class="mypost"><a href="#">Bài viết của tôi <span><?php  print _idea_get_post_count();?></span></a></li>
        <li class="favor"><a href="#">Bài viết quan tâm <span><?php print _idea_get_favor_count() ?></span></a></li>
        <li class="withdraw"><a href="#">Đổi điểm</a></li>
        <li class="invite"><a href="#">Mời bạn bè</a></li>
    </ul>
</div>
