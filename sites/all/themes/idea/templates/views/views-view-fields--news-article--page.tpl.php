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
?>
<?php //dsm($fields); ?>
<div class="user-post">
    <div class="avatar-post">
        <?php print $fields['picture']->content ?>
    </div>
    <div class="name-link-post">
        <?php print $fields['field_full_name']->content ?>
        <span class="link-post"><i class="fa fa-link" aria-hidden="true"></i>
            <input class="share-link" type="text"
                   value="<?php print url('node/' . $nid, array('absolute' => true)) ?>"/>
        </span>
    </div>
</div>
<div class="clearfix"></div>
<div class="article-item">
    <div class="art-img">
        <?php if (isset($fields['field_video'])): ?>
            <?php print $fields['field_video']->content; ?>
        <?php else: ?>
            <?php print $fields['field_images']->content; ?>
        <?php endif; ?>
    </div>
    <div class="content-post">
        <h5><?php print $fields['title']->content ?></h5>
        <?php print $fields['field_short_desc']->content ?>
    </div>
</div>
<div class="action-post">

</div>
