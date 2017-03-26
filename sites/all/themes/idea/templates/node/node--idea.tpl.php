<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
$user = user_load($node->uid);
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>


    <div class="user-post">
        <div class="avatar-post">
            <?php if (isset($user->picture)): ?>
                <?php print theme('image_style', array('path' => $user->picture->uri, 'style_name' => 'avatar')) ?>
            <?php else: ?>
                <img src="/sites/all/themes/idea/images/default-avatar.png"/>
            <?php endif; ?>
        </div>
        <div class="name-link-post">
            <?php if (isset($user->field_full_name)): ?>
                <?php print $user->field_full_name[LANGUAGE_NONE][0]['value'] ?>
            <?php else: ?>
                <?php print $user->name ?>
            <?php endif; ?>
            <span class="link-post"><i class="fa fa-link-custom" aria-hidden="true"></i>
            <input class="share-link" type="text"
                   value="<?php print url('node/' . $node->nid, array('absolute' => true)) ?>"/>
        </span>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="article-item">
        <div class="art-img">
            <?php if (isset($content['field_video'])): ?>
                <?php print render($content['field_video']); ?>
            <?php else: ?>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php $count = 1; ?>
                        <?php foreach ($node->field_images[LANGUAGE_NONE] as $key => $image): ?>
                            <li data-target="#myCarousel" data-slide-to="<?php print $key ?>"
                                class="<?php if ($count == 1) {
                                    print 'active';
                                } ?>"></li>
                            <?php $count++; endforeach; ?>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php $count = 1; ?>
                        <?php foreach ($node->field_images[LANGUAGE_NONE] as $image): ?>
                            <div class="item <?php if ($count == 1) {
                                print 'active';
                            } ?>">
                                <?php print theme('image_style', array('path' => $image['uri'], 'style_name' => 'article_full')) ?>
                            </div>
                            <?php $count++; endforeach; ?>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

<!--                <ul class="example-orbit" data-orbit>-->
<!--                    --><?php //foreach ($node->field_images[LANGUAGE_NONE] as $image): ?>
<!--                        <li>-->
<!--                            --><?php //print theme('image_style', array('path' => $image['uri'], 'style_name' => 'article_full')) ?>
<!--                        </li>-->
<!--                        --><?php //endforeach; ?>
<!--                </ul>-->
            <?php endif; ?>

        </div>
    </div>

</article>


