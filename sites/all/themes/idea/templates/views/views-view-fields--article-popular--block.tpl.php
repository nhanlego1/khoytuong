<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
$nid = $fields['nid']->raw;
$node = node_load($nid);
global $user;
?>
<div class="popular-item">
    <div class="img-popular <?php if (isset($fields['field_video'])): ?>video-item<?php endif; ?>">
        <?php if (isset($fields['field_video'])): ?>
            <a href="<?php print url('node/' . $nid) ?>">
                <?php if ($fields['field_img_thumb']): ?>
                    <?php print $fields['field_img_thumb']->content ?>
                <?php else: ?>
                    <?php print theme('image_style', array('path' => $node->field_video[LANGUAGE_NONE][0]['thumbnail_path'], 'style_name' => 'article_hot')) ?>
                <?php endif; ?>

                <span class="video-popular">
                <img src="<?php print base_path() . path_to_theme('idea') ?>/images/playvideo-64-64-0.png">
            </span>
            </a>
        <?php else: ?>
            <?php if ($fields['field_img_thumb']): ?>
                <?php print $fields['field_img_thumb']->content ?>
            <?php else: ?>
                <?php print theme('image_style', array('path' => $node->field_images[LANGUAGE_NONE][0]['uri'], 'style_name' => 'article_hot')); ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="title-popular">
        <?php print $fields['title']->content; ?>
        <div class="clearfix"></div>
        <div class="action-post">
                            <span class="like-post like-post-<?php print $nid ?>">
                                <?php if ($user->uid <= 0): ?>
                                <a class="cboxElement ajax-like" data="<?php print $nid ?>"
                                   href="<?php print url('idea/login') ?>">
                                    <?php else: ?>
                                    <a data="<?php print $nid ?>" href="javascript:;">
                                        <?php endif; ?>
                                        <i class="fa <?php if (!idea_custom_check_liked($node->nid)): ?>fa-heart <?php else: ?>fa-heart-o<?php endif; ?>"></i>
                                    </a>
                                    <i class="count"><?php print $node->field_like[LANGUAGE_NONE][0]['value'] ?></i>
                            </span>
            <span class="view-post">
                                <a data="<?php print $nid ?>" href="javascript:;"><i class="fa fa-eye"></i></a><i
                    class="count"><?php print $node->field_views[LANGUAGE_NONE][0]['value'] ?></i>
                            </span>
            <span class="<?php if ($user->uid > 0): ?> comment-post  <?php endif; ?>">
                                <?php if ($user->uid <= 0): ?>
                <a class="ajax-comment" data="<?php print $node->nid ?>"
                   href="<?php print url('idea/login') ?>">
                                    <?php else: ?>
                    <a data="<?php print $node->nid ?>" href="<?php print url('node/'.$node->nid) ?>">
                                        <?php endif; ?>
                        <i class="fa fa-comments"></i></a><i
                        class="count"><?php print _get_comment_count($node->nid) ?></i>
                            </span>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="clearfix"></div>