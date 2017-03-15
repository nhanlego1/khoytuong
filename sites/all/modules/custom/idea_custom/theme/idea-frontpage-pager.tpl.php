<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 3/3/17
 * Time: 11:32 PM
 */
?>
<?php if ($nodes): ?>

    <?php foreach ($nodes as $node): ?>
        <?php $account = user_load($node->uid); ?>
        <div class="views-row views-row-1 views-row-odd views-row-first article-ideas">

            <div class="popular-item">
                <div
                    class="img-popular <?php if (isset($node->field_video[LANGUAGE_NONE])): ?>video-item<?php endif; ?>">
                        <?php if (isset($node->field_video[LANGUAGE_NONE])): ?>
                        <a href="<?php print url('node/' . $node->nid) ?>">
                            <?php print theme('image_style', array('path' => $node->field_img_thumb[LANGUAGE_NONE][0]['uri'], 'style_name' => 'article_hot')) ?>
                            <span class="video-popular">
                                <img src="<?php print base_path() . drupal_get_path('theme', 'idea') ?>/images/playvideo-64-64-0.png">
                            </span>
                        </a>
                    <?php else: ?>
                    <a href="<?php print url('node/' . $node->nid) ?>">
                        <?php print theme('image_style', array('path' => $node->field_img_thumb[LANGUAGE_NONE][0]['uri'], 'style_name' => 'article_hot')) ?>
                    </a>
                        <?php endif; ?>
                </div>
                <div class="title-popular">
                    <a href="<?php print url('node/' . $node->nid) ?>"><?php print $node->title; ?></a>
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
                                <i class="count"><?php print $node->field_like[LANGUAGE_NONE][0]['value'] ?></i>
                        </span>
                        <span class="view-post">
                            <a data="<?php print $node->nid ?>" href="javascript:;"><i class="fa fa-eye"></i></a><i
                                class="count"><?php print $node->field_views[LANGUAGE_NONE][0]['value'] ?></i>
                        </span>
                        <span class="<?php if ($user->uid > 0): ?> comment-post  <?php endif; ?>">
                            <?php if ($user->uid <= 0): ?>
                                <a class="cboxElement ajax-comment" data="<?php print $node->nid ?>" href="<?php print url('idea/login') ?>">
                                <?php else: ?>
                                    <a data="<?php print $node->nid ?>" href="javascript:;">
                                    <?php endif; ?>
                                    <i class="fa fa-comments"></i></a><i class="count"><?php print _get_comment_count($node->nid) ?></i>
                        </span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php print idea_comment_form($node->nid) ?>
        </div>
    <?php endforeach; ?>

<?php endif; ?>
