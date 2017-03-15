<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id="share-buttons">
    <!-- Facebook -->
    <a href="http://www.facebook.com/sharer.php?u=<?php print url('node/' . $node->nid, array('absolute' => true)) ?>" target="_blank">
        <img src="<?php print base_path().  drupal_get_path('theme', 'idea') ?>/images/facebook.png" alt="Facebook" />
    </a>
    <!-- Google+ -->
    <a href="https://plus.google.com/share?url=<?php print url('node/' . $node->nid, array('absolute' => true)) ?>" target="_blank">
        <img src="<?php print base_path().  drupal_get_path('theme', 'idea') ?>/images/google.png" alt="Google" />
    </a>
    <!-- Pinterest -->
    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
        <img src="<?php print base_path().  drupal_get_path('theme', 'idea') ?>/images/pinterest.png" alt="Pinterest" />
    </a>
    <!-- Twitter -->
    <a href="https://twitter.com/share?url=<?php print url('node/' . $node->nid, array('absolute' => true)) ?>&amp;text=<?php print $node->field_short_desc[LANGUAGE_NONE][0]['value'] ?>&amp;hashtags=khoytuong.vn" target="_blank">
        <img src="<?php print base_path().  drupal_get_path('theme', 'idea') ?>/images/twitter.png" alt="Twitter" />
    </a>
</div>

