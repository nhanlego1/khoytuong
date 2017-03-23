<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 3/3/17
 * Time: 11:32 PM
 */
global $use;
$current_user = user_load($user->uid);
?>
<?php if ($node): ?>
    <div class="view-news-article-top">

        <?php $account = user_load($node->uid); ?>

        <div class="views-row views-row-1 views-row-odd views-row-first article-ideas">
            <div class="user-post">
                <div class="avatar-post">
                    <div class="field-content">

                        <a href="<?php print url('user/' . $account->uid) ?>">
                            <?php if ($account->picture): ?>
                                <?php print theme('image_style', array('path' => $account->picture->uri, 'style_name' => 'avatar')); ?>
                            <?php else: ?>
                                <img src="/sites/all/themes/idea/images/default-avatar.png"/>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
                <div class="name-link-post">
                    <div class="field-content">
                        <?php if (isset($account->field_full_name)): ?>
                            <?php print $account->field_full_name[LANGUAGE_NONE][0]['value']; ?>
                        <?php else: ?>
                            <?php print $account->name; ?>
                        <?php endif; ?>
                    </div>
                    <span class="link-post"><i class="fa fa-link-custom" aria-hidden="true"></i>
                        <input class="share-link" type="text"
                               value="<?php print url('node/' . $node->nid, array('absolute' => true)) ?>">
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="article-item">
                <div class="art-img">
                    <?php if (isset($node->field_video[LANGUAGE_NONE])): ?>
                        <a href="<?php print url('node/' . $node->nid) ?>">
                            <?php if (isset($node->field_img_thumb[LANGUAGE_NONE])): ?>
                                <?php print theme('image_style', array('path' => $node->field_img_thumb[LANGUAGE_NONE][0]['uri'], 'style_name' => 'article_thumb')) ?>
                            <?php else: ?>
                                <?php print theme('image_style', array('path' => $node->field_video[LANGUAGE_NONE][0]['thumbnail_path'], 'style_name' => 'article_thumb')) ?>
                            <?php endif; ?>
                            <span class="video-popular">
                                <img
                                    src="<?php print base_path() . drupal_get_path('theme', 'idea') ?>/images/playvideo-64-64-0.png">
                            </span>
                        </a>
                    <?php else: ?>
                        <a href="<?php print url('node/' . $node->nid) ?>">
                            <?php print theme('image_style', array('path' => $node->field_img_thumb[LANGUAGE_NONE][0]['uri'], 'style_name' => 'article_thumb')) ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="content-post">
                    <h5>
                        <?php print l($node->title, 'node/' . $node->nid) ?>
                    </h5>
                    <div class="field-content">
                        <?php print $node->field_short_desc[LANGUAGE_NONE][0]['value'] ?>
                    </div>
                </div>
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
                    <a data="<?php print $node->nid ?>" href="javascript:;"><i class="fa fa-eye"></i></a><i
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
            <?php print idea_comment_form($node->nid, 'top') ?>
        </div>


    </div>


<?php endif; ?>
<div class="ads-front-center">
    <img src="/sites/all/themes/idea/images/banner-node-right.png">
</div>
<div class="clearfix"></div>
