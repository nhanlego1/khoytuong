<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 3/10/17
 * Time: 1:13 AM
 */
global $user;
$current_user = user_load($user->uid);
?>

<div class="comment-post-s">

    <div data="<?php print $nid ?>" class="comment-items comment-items-<?php print $nid ?>">
        <?php print idea_custom_get_comment_more($nid, $page) ?>
    </div>
    <?php if (count(idea_custom_get_comment_check($nid)) > 5): ?>
        <div class="load-more-comment">
            <a data="<?php print $nid ?>" href="#">Cũ hơn + </a>
        </div>
    <?php endif; ?>
    <div class="clearfix"></div>
    <div class="comment-post-form comment-post-form-<?php print $nid ?>">
        <form data="<?php print $nid; ?>" action="" method="post" id="comment-form-<?php print $nid ?>">
            <div class="user-comment">
                <?php if ($current_user->picture): ?>
                    <?php print theme('image_style', array('path' => $current_user->picture->uri, 'style_name' => 'avatar')); ?>
                <?php else: ?>
                    <img src="/sites/all/themes/idea/images/default-avatar.png"/>
                <?php endif; ?>

            </div>
            <div class="comment-input">
                <input type="hidden" value="" name="reply_comment" class="reply-comment-<?php print $nid ?>"/>
                <span class="user-comment-name"></span>
                <textarea placeholder="Thêm nhận xét" type="text" value="" name="comment_text"
                          class="comment-text-<?php print $nid ?>"></textarea>
            </div>
            <div class="comment-cancel">
                <a class="close-comment" data="<?php print $nid ?>" href="#">Đóng</a>
            </div>
            <div class="comment-submit">
                <input type="submit" class="comment-submit-button" value="Đăng"/>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
</div>
