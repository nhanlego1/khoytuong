<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 2/21/17
 * Time: 11:41 PM
 */
?>
<div class="user-link">
    <?php if ($account->uid <= 0): ?>
        <div class="user-non-login">
            <a href="<?php print url('user/login') ?>"><?php print t('Đăng nhập') ?></a> |
            <a href="<?php print url('user/register') ?>"><?php print t('Đăng ký') ?></a>
        </div>
    <?php else: ?>
        <div class="user-has-login">
            <div class="user-link-avatar">
                <?php if ($account->picture): ?>
                    <?php print theme('image_style', array('path' => $account->picture->uri, 'style_name' => 'avatar')); ?>
                <?php else: ?>
                    <img src="/sites/all/themes/idea/images/default-avatar.png"/>
                <?php endif; ?>
                <?php if(privatemsg_unread_count() && privatemsg_unread_count() > 0): ?><span class="notification-small"><?php print privatemsg_unread_count() ?></span><?php endif; ?>
                <span class="user-link-title-name">
           <?php isset($account->field_full_name[LANGUAGE_NONE]) ? print $account->field_full_name[LANGUAGE_NONE][0]['value'] : $account->name; ?>
          </span>
            </div>
            |<a href="<?php print url('user/logout') ?>"><?php print t('Đăng xuất') ?></a>
        </div>
    <?php endif; ?>
</div>
