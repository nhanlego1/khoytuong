<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 2/20/17
 * Time: 11:42 PM
 */
$token = base64_encode(time().'|'.$account->uid);
?>

<div class="account-information">
    <div class="account-info-header">
        <div class="avatar">
            <?php if ($account->picture): ?>
                <?php print theme('image_style', array('path' => $account->picture->uri, 'style_name' => 'avatar')); ?>
            <?php else: ?>
                <img src="/sites/all/themes/idea/images/default-avatar.png"/>
            <?php endif; ?>
            <?php if(privatemsg_unread_count() > 0): ?><span class="notification"><?php print privatemsg_unread_count() ?></span><?php endif; ?>
        </div>
        <div class="account-name">
          <span class="title-name">
           <?php isset($account->field_full_name[LANGUAGE_NONE]) ? print $account->field_full_name[LANGUAGE_NONE][0]['value'] : $account->name; ?>
          </span>
            <span class="point-name">
              <!--diem so-->
          </span>
        </div>
        <a href="<?php print url('user/'.$account->uid.'/edit',array('query'=>array('destination'=>'frontpage')));?>">
        <span><i class="fa fa-pencil-custom" aria-hidden="true"></i></span>
        </a>
    </div>
    <div class="clearfix"></div>
    <ul class="account-detail">
        <li><i class="fa fa-envelope-o"></i><a href="mailto:<?php print $account->mail ?>"><?php print $account->mail ?></a></li>
        <?php if (isset($account->field_phone[LANGUAGE_NONE])): ?>
            <li><i class="fa fa-phone"></i><a href="javascript:;"><?php print $account->field_phone[LANGUAGE_NONE][0]['value'] ?></a></li>
        <?php endif; ?>
        <li><i class="fa fa-edit"></i><a class="my-post" href="javascript:;">Bài viết của tôi <span><?php  print _idea_get_post_count();?></span></a></li>
        <li><i class="fa fa-save"></i><a class="my-save-post" href="javascript:;">Bài viết quan tâm <span  class="save-count"><?php print _idea_get_favor_count() ?></span></a></li>
        <li><i class="fa fa-refresh"></i>
            <a class="exchange cboxElement" href="<?php print url('idea/user/exchange'); ?>">Đổi điểm <span><?php  print $account->field_score[LANGUAGE_NONE][0]['value'];?></span></a>
        </li>
        <li class="sendtofriend"><i class="fa fa-group"></i><a class="sendtofriend" href="javascript:;">Mời bạn bè</a>
            <input type="text" class="sendfriend hidden" style="width: 90%" value="<?php print url('user/register',array('absolute'=>true,'query'=>array('token'=>$token))) ?>"/>
        </li>
        <li><i class="fa fa-bell"></i><a href="/messages">Thông báo <span style="color:red;"><?php print privatemsg_unread_count() ?></span></a></li>
        <li><i class="fa fa-power-off"></i><a href="/user/logout">Đăng xuất</a></li>
    </ul>
</div>
