<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 3/10/17
 * Time: 1:14 AM
 */

?>
<?php if ($comments): ?>
    <?php foreach ($comments as $comment): ?>
        <?php $user = user_load($comment->uid); ?>
        <div class="comment-item" data="<?php print $comment->cid ?>">
            <div class="user-comment">
                <?php if ($user->picture): ?>
                    <?php print theme('image_style', array('path' => $user->picture->uri, 'style_name' => 'avatar')); ?>
                <?php else: ?>
                    <img src="/sites/all/themes/idea/images/default-avatar.png"/>
                <?php endif; ?>
            </div>
            <div class="user-comment-author">
                <b><?php isset($user->field_full_name[LANGUAGE_NONE]) ? print $user->field_full_name[LANGUAGE_NONE][0]['value'] : $user->name ?></b>
            </div>
            <div class="comment-content">
                <?php if($comment->pid > 0): ?>
                  <?php $reply = comment_load($comment->pid); ?>
                    <?php $user_replied = user_load($reply->uid); ?>
                    <b>+<?php isset($user_replied->field_full_name[LANGUAGE_NONE]) ? print $user_replied->field_full_name[LANGUAGE_NONE][0]['value'] : $user_replied->name ?>:</b>
                <?php endif; ?>
                <?php print $comment->comment_body[LANGUAGE_NONE][0]['value']; ?>
            </div>
             <span><?php print format_interval(REQUEST_TIME - $comment->created, 2) ?></span>
            <div class="action-comment-reply action-comment-reply-<?php print $comment->cid; ?>">
                <a data-user="<?php isset($user->field_full_name[LANGUAGE_NONE]) ? print $user->field_full_name[LANGUAGE_NONE][0]['value'] : $user->name ?>" data-nid="<?php print $comment->nid ?>" data="<?php print $comment->cid ?>" href="#">Trả lời</a>
            </div>
        </div>
        <div class="clearfix"></div>

    <?php endforeach; ?>

<?php endif; ?>
