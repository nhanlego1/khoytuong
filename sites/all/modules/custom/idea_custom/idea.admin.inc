<?php
/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 4/10/17
 * Time: 12:08 AM
 */

function idea_admin(){
    $form['setting'] = array(
        '#type'         => 'fieldset',
        '#title'        => t('Quản lý cấu hình hệ thống'),
        '#collapsible'  => TRUE,
        '#collapsed'    => FALSE,
    );

    $form['setting']['filter_word'] = array(
        '#type'=>'textarea',
        '#title'=>'Lọc từ khoá tục tỉu',
        '#default_value'=> variable_get('filter_word')
    );

    //set default value

//    $form['setting']['xu_like'] = array(
//        '#type'=>'textfield',
//        '#title'=>'Số điểm khi like',
//        '#default_value'=> variable_get('xu_like',10)
//    );
    $form['setting']['xu_post'] = array(
        '#type'=>'textfield',
        '#title'=>'Số điểm khi đăng bài',
        '#default_value'=> variable_get('xu_post',20)
    );
//    $form['setting']['xu_share_social'] = array(
//        '#type'=>'textfield',
//        '#title'=>'Số điểm khi share bài',
//        '#default_value'=> variable_get('xu_share_social',20)
//    );
//    $form['setting']['xu_comment'] = array(
//        '#type'=>'textfield',
//        '#title'=>'Số điểm khi bình luận',
//        '#default_value'=> variable_get('xu_comment',20)
//    );
//    $form['setting']['xu_click'] = array(
//        '#type'=>'textfield',
//        '#title'=>'Số điểm khi xem bài viết của bạn',
//        '#default_value'=> variable_get('xu_click',10)
//    );
    $form['setting']['xu_register'] = array(
        '#type'=>'textfield',
        '#title'=>'Số điểm khi đăng ký tài khoản',
        '#default_value'=> variable_get('xu_register',20)
    );
    $form['setting']['xu_friend'] = array(
        '#type'=>'textfield',
        '#title'=>'Số điểm khi giới thiệu bạn bè đăng ký',
        '#default_value'=> variable_get('xu_friend',10)
    );
    $form['setting']['owner_post'] = array(
        '#type'=>'textfield',
        '#title'=>'Số điểm khi tác giả bài post nhận được',
        '#default_value'=> variable_get('owner_post',2)
    );
//    $form['setting']['rule_game'] = array(
//        '#type'=>'text_format',
//        '#title'=>'Thể lệ và nội quy',
//        '#default_value'=> variable_get('rule_game')
//    );
//    $form['setting']['popup_info'] = array(
//        '#type'=>'text_format',
//        '#title'=>'Quảng cáo game',
//        '#default_value'=> variable_get('popup_info')
//    );
//    $form['setting']['gift_after'] = array(
//        '#type'=>'text_format',
//        '#title'=>'Message sau khi đổi quà. ',
//        '#default_value'=> variable_get('gift_after')
//    );
    $form['setting']['email_processcing'] = array(
        '#type'=>'text_format',
        '#title'=>'Email template xác nhận thông tin nhận quà. ',
        '#default_value'=> variable_get('email_processcing')
    );
    $form['setting']['email_compeleted'] = array(
        '#type'=>'text_format',
        '#title'=>'Email template hoàn thành nhận quà.',
        '#default_value'=> variable_get('email_compeleted')
    );
    $form['setting']['email_cancel'] = array(
        '#type'=>'text_format',
        '#title'=>'Email template Cancel giao quà.',
        '#default_value'=> variable_get('email_cancel')
    );
    $form['setting']['email_invite'] = array(
        '#type'=>'text_format',
        '#title'=>'Email template Mời bạn bè tham gia.',
        '#default_value'=> variable_get('email_invite')
    );
    $form['submit'] = array(
        '#type'=>'submit',
        '#value'=>'Save'
    );
    return $form;
}

function idea_admin_submit($form, &$form_state){
    $data = $form_state['values'];

    variable_set('filter_word', $data['filter_word']);
//    variable_set('xu_like', $data['xu_like']);
    variable_set('xu_post', $data['xu_post']);
//    variable_set('xu_share_social', $data['xu_share_social']);
//    variable_set('xu_comment', $data['xu_comment']);
//    variable_set('xu_click', $data['xu_click']);
    variable_set('xu_register', $data['xu_register']);
    variable_set('xu_friend', $data['xu_friend']);
    variable_set('owner_post', $data['owner_post']);
//    variable_set('rule_game', $data['rule_game']['value']);
//    variable_set('popup_info', $data['popup_info']['value']);
    variable_set('email_processcing', $data['email_processcing']['value']);
    variable_set('email_compeleted', $data['email_compeleted']['value']);
    variable_set('email_cancel', $data['email_cancel']['value']);
    variable_set('email_invite', $data['email_invite']['value']);
//    variable_set('gift_after',$data['gift_after']['value']);
}