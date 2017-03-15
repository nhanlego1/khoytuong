<?php

/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 3/3/17
 * Time: 11:28 PM
 */
function idea_custom_frontpage() {
    $nodes = idea_get_article($start = 0, $end = 5);
    return theme('idea_frontpage', array('nodes' => $nodes));
}

/**
 * implement query node
 */
function idea_get_article($start = 0, $end = 5) {
    $data = array();
    $query = db_select('node', 'n');
    $query->fields('n');
    $query->condition('type', 'idea');
    $query->condition('status', NODE_PUBLISHED);
    $query->orderBy('changed', 'DESC');
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
    if ($node->status == 0) {
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
function idea_custom_share_post_action($node){
    print render(theme('idea_share_post',array('node'=>$node)));
    drupal_exit();
}

/**
 * function login block
 */
function idea_custom_login(){
    $form = drupal_get_form('user_login_block');
    print render($form);
    drupal_exit();
}

/**
 * form post idea
 */
function idea_custom_post_idea(){
    module_load_include('inc', 'node', 'node.pages');
    $node_form = new stdClass;
    $node_form->type = 'idea';
    $node_form->language = LANGUAGE_NONE;
    $form = drupal_get_form('idea_node_form',$node_form);
    print drupal_render($form);
    drupal_exit();
}
