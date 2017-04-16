<?php

/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 3/3/17
 * Time: 11:28 PM
 */
function idea_custom_frontpage($cate = null) {
    $nodes = idea_get_article($start = 0, $end = 5);
    return theme('idea_frontpage', array('nodes' => $nodes));
}

/**
 * implement query node
 */
function idea_get_article($start = 0, $end = 5) {
    global $user;

    $data = array();
    $query = db_select('node', 'n');
    $query->fields('n');

    if ($user->uid > 0) {
        if (in_array('admin', $user->roles) || in_array('administrator', $user->roles)) {
            $query->condition(db_or()
                            ->condition('status', 1)
                            ->condition('status', 0)
            );
        } else {
            $query->condition(db_or()
                            ->condition('uid', $user->uid)
                            ->condition('status', 1)
            );
        }
    } else {
        $query->condition('status', NODE_PUBLISHED);
    }
    $query->condition('type', 'idea');
    $query->orderBy('created', 'DESC');
    if ($start == 0) {
        $start = 1;
    } else {
        $start = $start + 1;
    }
    $query->range($start, $end);
    $result = $query->execute()->fetchAll();

    if ($result) {
        foreach ($result as $n) {
            $node = node_load($n->nid);
            $data[] = $node;
        }
    }
    return $data;
}

/**
 * Implement get more article
 */
function idea_custom_article_more($pagesize = 5) {
    $pager = 0;
    if (isset($_POST['pager'])) {
        $pager = $_POST['pager'] * $pagesize;
    }
    $nodes = idea_get_article($pager, $pagesize);
    if ($nodes) {
        print (render(theme('idea_frontpage_pager', array('nodes' => $nodes))));
        drupal_exit();
    } else {
        print 'ko';
        drupal_exit();
    }
}

/**
 * comment post ajax
 */
function idea_custom_comment() {
    global $user;
    $data = $_POST;
    $node = node_load($data['nid']);
    if ($user->status == 0) {
        print 'Access denied';
        drupal_exit();
    }
    if ($data['comment'] == '') {
        print 'Access denied';
        drupal_exit();
    }

    $comment = new stdClass();
    $comment->nid = $data['nid']; // nid of a node you want to attach a comment to
    $comment->pid = $data['cid']; // parent comment id, 0 if none
    $comment->uid = $user->uid; // user's id, who left the comment
    //  $comment->mail = 'email@example.com'; // user's email
    $comment->name = $user->mail; // If user is authenticated you can omit this field, it will be auto-populated, if the user is anonymous and you want to name him somehow, input his name here
    $comment->thread = '01/'; // OPTIONAL. If you need comments to be threaded you can fill this value. Otherwise omit it.
    $comment->hostname = ip_address();
    $comment->created = REQUEST_TIME; // OPTIONAL. You can set any time you want here. Useful for backdated comments creation.
    //   $comment->is_anonymous = 0; // leave it as is
    $comment->status = COMMENT_PUBLISHED; // We auto-publish this comment
    $comment->language = LANGUAGE_NONE; // The same as for a node
    $comment->subject = $user->name;
    $comment->comment_body[$comment->language][0]['value'] = filter_bad_word(strip_tags($data['comment'])); // Everything here is pretty much like with a node
    $comment->comment_body[$comment->language][0]['format'] = 'plain_text';
    try {
        comment_submit($comment); // saving a comment
        comment_save($comment);
        idea_custom_logs($data['nid'], 'comment');
    } catch (Exception $ex) {
        print $ex->getMessage();
        drupal_exit();
    }

    print render(theme('idea_comment_ajax', array('comment' => $comment)));
    drupal_exit();
}

/**
 * Function get all comment
 */
function idea_custom_comment_get() {
    $nid = $_POST['nid'];
    $node = node_load($nid);
    $query = db_select('comment', 'c');
    $query->fields('c');
    $query->condition('nid', $nid);
    $query->condition('status', 1);
    $query->orderBy('created', 'ASC');
    $result = $query->execute()->fetchAllAssoc('cid');
    $data = array();
    if ($result) {
        foreach ($result as $key => $c) {
            $data[$key] = comment_load($key);
        }
        print render(theme('idea_comment', array('comments' => $data)));
    } else {
        print 'ko';
    }
    drupal_exit();
}

/**
 * Like action
 */
function idea_custom_like_post_action() {
    global $user;
    $nid = $_POST['nid'];
    idea_custom_like_post($nid);
}

/**
 * Save post action
 */
function idea_custom_save_post_action() {
    $nid = $_POST['nid'];
    idea_custom_save_post($nid);
}

/**
 * share popup function
 */
function idea_custom_share_post_action($node) {
    print render(theme('idea_share_post', array('node' => $node)));
    drupal_exit();
}

/**
 * function login block
 */
function idea_custom_login() {
    $form = drupal_get_form('user_login_block');
    print render($form);
    drupal_exit();
}

/**
 * form post idea
 */
function idea_custom_post_idea() {
    module_load_include('inc', 'node', 'node.pages');
    $node_form = new stdClass;
    $node_form->type = 'idea';
    $node_form->language = LANGUAGE_NONE;
    $form = drupal_get_form('idea_node_form', $node_form);
    print drupal_render($form);
    drupal_exit();
}

/**
 * Search google
 */
function idea_custom_search() {
    if (!empty($_POST['keyword'])) {
        drupal_goto('search/gss/' . $_POST['keyword']);
    } else {
        drupal_goto('<front>');
    }
}

/**
 * function get user post
 */
function idea_custom_user_post() {
    global $user;
    $query = db_select('node', 'n');
    $query->fields('n');
    $query->condition('type', 'idea');
    $query->condition('uid', $user->uid);
    $query->orderBy('created', 'desc');
    $result = $query->execute()->fetchAll();
    $data = array();
    if ($result) {
        foreach ($result as $r) {
            $data[$r->nid] = node_load($r->nid);
        }
        print (render(theme('idea_frontpage_pager', array('nodes' => $data))));
    } else {
        print 'ko';
    }
    drupal_exit();
}

/**
 * user save
 */
function idea_custom_user_save() {
    global $user;
    $query = db_select('node', 'n');
    $query->join('idea_save', 'ids', 'ids.nid=n.nid');
    $query->fields('n');
    $query->condition('n.type', 'idea');
    $query->condition('ids.uid', $user->uid);
    $query->orderBy('n.created', 'desc');
    $result = $query->execute()->fetchAll();
    $data = array();
    if ($result) {
        foreach ($result as $r) {
            $data[$r->nid] = node_load($r->nid);
        }
        print (render(theme('idea_frontpage_pager', array('nodes' => $data))));
    } else {
        print 'ko';
    }
    drupal_exit();
}

/**
 * doi diem
 */
function idea_custom_user_exchange() {
    global $user;
    if ($user->uid <= 0) {
        drupal_access_denied();
    }
    $author = user_load($user->uid);
    if ($author->field_score[LANGUAGE_NONE][0]['value'] < variable_get('card_20', 1000)) {
        print '<div class="message-no-exchange">' . variable_get('message_node_enought_point') . '</div>';
        drupal_exit();
    }
    $form = drupal_get_form('exchancge_giff');

    print render($form);
    drupal_exit();
}

/**
 * form exchange qua
 */
function exchancge_giff($form, &$form_state) {
    $form['giff'] = array(
        '#type' => 'select',
        '#title' => 'Chọn thẻ cào.',
        '#options' => array(
            'card_20' => 'Thẻ cào 20k - ' . variable_get('card_20', 2000),
            'card_50' => 'Thẻ cào 50k - ' . variable_get('card_50', 5000),
            'card_100' => 'Thẻ cào 100k - ' . variable_get('card_100', 10000),
            'card_200' => 'Thẻ cào 200k - ' . variable_get('card_200', 20000),
            'card_500' => 'Thẻ cào 500k - ' . variable_get('card_500', 50000)
        )
    );

    $form['mobile'] = array(
        '#type' => 'select',
        '#title' => 'Chọn nhà mạng',
        '#options' => array(
            'mobifone' => 'Mobifone',
            'vinaphone' => 'VinaPhone',
            'viettel' => 'Viettel',
            'vnmobile' => 'Vietnam Mobile'
        ),
    );

    $form['qty'] = array(
        '#type' => 'select',
        '#title' => 'Chọn số lượng',
        '#options' => array(
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ),
        '#default_value' => 1,
    );

    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Đổi thẻ cào'
    );
    return $form;
}

/**
 * form validate
 * @global type $user
 * @param type $form
 * @param type $form_state
 */
function exchancge_giff_validate($form, &$form_state) {
    global $user;
    $author = user_load($user->uid);
    $score = $author->field_score[LANGUAGE_NONE][0]['value'];
    if ((variable_get($form_state['values']['giff']) * $form_state['values']['qty']) > $score) {
        form_set_error('giff', t('Số điểm của bạn không đủ. Vui lòng thử lại.'));
        drupal_goto('<front>');
    }
}
/**
 * 
 * @global type $user
 * @param type $form
 * @param type $form_state
 */
function exchancge_giff_submit($form, &$form_state) {
    global $user;
    $author = user_load($user->uid);
    $score = $author->field_score[LANGUAGE_NONE][0]['value'];
    $exist_score = $score - (variable_get($form_state['values']['giff']) * $form_state['values']['qty']);
    $node = new stdClass();
    $node->type = 'order';
    $node->uid = $user->uid;
    $node->created = REQUEST_TIME;
    $node->status = 1;
    $node->title = 'CA-' . REQUEST_TIME;
    $node->field_user[LANGUAGE_NONE][0]['target_id'] = $user->uid;
    $node->field_card[LANGUAGE_NONE][0]['value'] = $form_state['values']['giff'];
    $node->field_qty[LANGUAGE_NONE][0]['value'] = $form_state['values']['qty'];
    $node->field_provider[LANGUAGE_NONE][0]['value'] = $form_state['values']['mobile'];
    $node->field_status[LANGUAGE_NONE][0]['value'] = 0;
    node_save($node);
    //update score
    $author->field_score[LANGUAGE_NONE][0]['value'] = $exist_score;
    user_save($author);

    drupal_set_message('Bạn đã đổi thẻ cào thành công. Số điểm còn lại là:' . $exist_score);
    drupal_goto('<front>');
}
/**
 * 
 * @return type
 */
function idea_admin_dashboard(){
    return theme('idea_admin_dashboard');
}

