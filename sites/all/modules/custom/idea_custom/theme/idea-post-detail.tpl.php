<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 3/2/17
 * Time: 10:11 PM
 */
$node = menu_get_object('node');
$account = user_load($node->uid);
?>
<div class="post-information">
    <div class="account-info-header">

        <div class="account-name">
          <span class="title-name">
              <strong><?php print $node->title; ?></strong>
          </span>
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="post-desc">
        <p class="short-desc-detail"><?php print $node->field_short_desc[LANGUAGE_NONE][0]['value'] ?></p>
        <?php print $node->body[LANGUAGE_NONE][0]['value'] ?>
    </div>
    <div class="clearfix"></div>
    <div class="action-post">
                <span class="like-post like-post-<?php print $node->nid ?>">
                    <?php if ($user->uid <= 0): ?>
                        <a class="cboxElement ajax-like" data="<?php print $node->nid ?>" href="<?php print url('idea/login') ?>">
                        <?php else: ?>
                            <a data="<?php print $node->nid ?>" href="javascript:;">
                            <?php endif; ?>
                            <i class="fa <?php if (!idea_custom_check_liked($node->nid)): ?>fa-heart <?php else: ?>fa-heart-o<?php endif; ?>"></i>
                        </a>
                        <i class="count"><?php print $node->field_like[LANGUAGE_NONE][0]['value'] ?></i></span>
                <span class="view-post">
                    <a data="<?php print $node->nid ?>" href="#"><i class="fa fa-eye"></i></a><i
                        class="count"><?php print $node->field_views[LANGUAGE_NONE][0]['value'] ?></i></span>
                <span class="<?php if ($user->uid > 0): ?> comment-post  <?php endif; ?>">
                    <?php if ($user->uid <= 0): ?>
                        <a class="cboxElement ajax-comment" data="<?php print $node->nid ?>" href="<?php print url('idea/login') ?>">
                        <?php else: ?>
                            <a data="<?php print $node->nid ?>" href="javascript:;">
                            <?php endif; ?>
                            <i class="fa fa-comments"></i></a><i class="count"><?php print _get_comment_count($node->nid) ?></i></span>
                <span class="share-post">
                    <a class="cboxElement ajax-share" data="<?php print $node->nid ?>" href="<?php print url('idea/share/post/' . $node->nid) ?>"><i class="fa fa-share"></i></a><i
                        class="count"><?php print $node->field_share[LANGUAGE_NONE][0]['value'] ?></i></span>
                <span class="save-post save-post-<?php print $node->nid ?>">
                    <?php if ($user->uid <= 0): ?>
                        <a class="cboxElement ajax-save" data="<?php print $node->nid ?>" href="<?php print url('idea/login') ?>">
                        <?php else: ?>
                    <a data="<?php print $node->nid ?>" href="javascript:;">
                        <?php endif; ?>
                        <i class="fa fa-save"></i></a><i
                        class="count"><?php print $node->field_save[LANGUAGE_NONE][0]['value'] ?></i></span>
            </div>
    <div class="clearfix"></div>
</div>
<?php print idea_comment_form($node->nid) ?>

<div class="relate-post">
    <?php print  idea_custom_post_relate(3); ?>
</div>
