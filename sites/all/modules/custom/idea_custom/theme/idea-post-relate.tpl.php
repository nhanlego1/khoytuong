<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 3/4/17
 * Time: 12:57 AM
 */
?>
<?php if ($nodes): ?>
    <div id="<?php if($ids==1): ?> amazingcarousel-container-2 <?php else: ?>amazingcarousel-container-<?php print $ids ?><?php endif; ?>">
        <div id="<?php if($ids==1): ?>amazingcarousel-2<?php else: ?>amazingcarousel-<?php print $ids ?><?php endif; ?>">
            <div class="amazingcarousel-list-container">
                <div class="amazingcarousel-list-wrapper">
                    <ul class="amazingcarousel-list">
                        <?php foreach ($nodes as $node): ?>
                            <li class="amazingcarousel-item">
                                <div class="amazingcarousel-item-container">
                                    <div class="amazingcarousel-image">
                                        <a href="<?php print url('node/' . $node->nid) ?>"
                                           data-group="amazingcarousel-2">
                                            <?php if (isset($node->field_video[LANGUAGE_NONE])): ?>

                                                <?php if (isset($node->field_img_thumb[LANGUAGE_NONE])): ?>
                                                    <?php print theme('image_style', array('path' => $node->field_img_thumb[LANGUAGE_NONE][0]['uri'], 'style_name' => 'article_hot')) ?>
                                                <?php else: ?>
                                                    <?php print theme('image_style', array('path' => $node->field_video[LANGUAGE_NONE][0]['thumbnail_path'], 'style_name' => 'article_hot')) ?>
                                                <?php endif; ?>
                                                <span class="video-popular">
                <img src="<?php print base_path() . drupal_get_path('theme', 'idea') ?>/images/playvideo-64-64-0.png">
            </span>

                                            <?php else: ?>
                                                <?php if (isset($node->field_img_thumb[LANGUAGE_NONE])): ?>
                                                    <?php print theme('image_style', array('path' => $node->field_img_thumb[LANGUAGE_NONE][0]['uri'], 'style_name' => 'article_hot')); ?>
                                                    <?php else: ?>
                                                    <?php print theme('image_style', array('path' => $node->field_images[LANGUAGE_NONE][0]['uri'], 'style_name' => 'article_hot')); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="amazingcarousel-title"><a
                                            href="<?php print url('node/' . $node->nid) ?>"><?php print $node->title ?></a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
                <div class="amazingcarousel-prev"
                     style="overflow: hidden; position: absolute; cursor: pointer; width: 32px; height: 32px; background: url(&quot;https://amazingcarousel.com/wp-content/uploads/amazingcarousel/2/carouselengine/skins/arrows-32-32-2.png&quot;) left top no-repeat; display: block;"></div>
                <div class="amazingcarousel-next"
                     style="overflow: hidden; position: absolute; cursor: pointer; width: 32px; height: 32px; background: url(&quot;https://amazingcarousel.com/wp-content/uploads/amazingcarousel/2/carouselengine/skins/arrows-32-32-2.png&quot;) right top no-repeat; display: block;"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
