<?php

/**
 * Implements template_preprocess_html().
 */
function idea_preprocess_html(&$variables) {
    
}

/**
 * Implements template_preprocess_page.
 */
function idea_preprocess_page(&$variables) {
    
}

/**
 * Implements template_preprocess_node.
 */
function idea_preprocess_node(&$variables) {
    
}

/**
 * Get user avatar
 */
function _get_user_avatar_mobile() {
    global $user;
    $image = '<span class="fa fa-user"></span>';
    if ($user->uid > 0) {
        $account = user_load($user->uid);
        if ($account->picture) {
            $image = theme('image_style', array('path' => $account->picture->uri, 'style_name' => 'avatar'));
        } else {
            $image = '<img src="/sites/all/themes/idea/images/default-avatar.png"/>';
        }
        if (privatemsg_unread_count() > 0) {
            $image .= '<span class="notification-small">' . privatemsg_unread_count() . '</span>';
        }
    }
    return $image;
}
