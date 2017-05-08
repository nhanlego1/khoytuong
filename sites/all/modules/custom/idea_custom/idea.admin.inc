<?php

/**
 * Created by PhpStorm.
 * User: nhan
 * Date: 4/10/17
 * Time: 12:08 AM
 */
function idea_admin() {
  $form['setting'] = array(
    '#type' => 'fieldset',
    '#title' => t('Quản lý cấu hình hệ thống'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['setting']['filter_word'] = array(
    '#type' => 'textarea',
    '#title' => 'Lọc từ khoá tục tỉu',
    '#default_value' => variable_get('filter_word')
  );

  $form['setting']['idea_post'] = array(
    '#type' => 'textfield',
    '#title' => 'Số điểm khi đăng bài',
    '#default_value' => variable_get('idea_post', 20)
  );

  $form['setting']['every_limit_like'] = array(
    '#type' => 'textfield',
    '#title' => 'Số like giới hạn cộng điểm.',
    '#default_value' => variable_get('every_limit_like', 100)
  );
  $form['setting']['idea_like'] = array(
    '#type' => 'textfield',
    '#title' => 'Số điểm khi like mỗi ' . variable_get('every_limit_like', 100) . ' bài viết của bạn',
    '#default_value' => variable_get('idea_view', 50)
  );
  $form['setting']['idea_register'] = array(
    '#type' => 'textfield',
    '#title' => 'Số điểm khi đăng ký tài khoản',
    '#default_value' => variable_get('idea_register', 200)
  );
  $form['setting']['idea_invite_friend'] = array(
    '#type' => 'textfield',
    '#title' => 'Số điểm khi giới thiệu bạn bè đăng ký',
    '#default_value' => variable_get('idea_invite_friend', 100)
  );
  $form['setting']['card_20'] = array(
    '#type' => 'textfield',
    '#title' => 'Card 20k.',
    '#default_value' => variable_get('card_20', 2000)
  );
  $form['setting']['card_50'] = array(
    '#type' => 'textfield',
    '#title' => 'Card 50k.',
    '#default_value' => variable_get('card_50', 5000)
  );
  $form['setting']['card_100'] = array(
    '#type' => 'textfield',
    '#title' => 'Card 100k.',
    '#default_value' => variable_get('card_100', 10000)
  );
  $form['setting']['card_200'] = array(
    '#type' => 'textfield',
    '#title' => 'Card 200k.',
    '#default_value' => variable_get('card_200', 20000)
  );
  $form['setting']['card_500'] = array(
    '#type' => 'textfield',
    '#title' => 'Card 500k.',
    '#default_value' => variable_get('card_500', 50000)
  );
  $form['setting']['bg_header'] = array(
    '#type' => 'textfield',
    '#title' => 'Backdround color header',
    '#default_value' => variable_get('bg_header', 'rgba(9, 9, 9, 0.7)'),
  );
  $form['setting']['bg_page'] = array(
    '#type' => 'textfield',
    '#title' => 'Backdround color page',
    '#default_value' => variable_get('bg_page', '#f0eeee'),
  );

  $form['setting']['email_processcing'] = array(
    '#type' => 'text_format',
    '#title' => 'Email template xác nhận thông tin nhận quà. ',
    '#default_value' => variable_get('email_processcing')
  );
  $form['setting']['email_compeleted'] = array(
    '#type' => 'text_format',
    '#title' => 'Email template hoàn thành nhận quà.',
    '#default_value' => variable_get('email_compeleted')
  );
  $form['setting']['email_cancel'] = array(
    '#type' => 'text_format',
    '#title' => 'Email template Cancel giao quà.',
    '#default_value' => variable_get('email_cancel')
  );
  $form['setting']['email_invite'] = array(
    '#type' => 'text_format',
    '#title' => 'Email template Mời bạn bè tham gia.',
    '#default_value' => variable_get('email_invite')
  );
  $form['setting']['message_node_enought_point'] = array(
    '#type' => 'text_format',
    '#title' => 'Thông báo khi chưa đủ điểm nhậm quà.',
    '#default_value' => variable_get('message_node_enought_point')
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Save'
  );
  return $form;
}

function idea_admin_submit($form, &$form_state) {
  $data = $form_state['values'];
  variable_set('filter_word', $data['filter_word']);
  variable_set('idea_post', $data['idea_post']);
  variable_set('idea_like', $data['idea_like']);
  variable_set('every_limit_like', $data['every_limit_like']);
  variable_set('idea_register', $data['idea_register']);
  variable_set('idea_invite_friend', $data['idea_invite_friend']);
  variable_set('card_20', $data['card_20']);
  variable_set('card_50', $data['card_50']);
  variable_set('card_100', $data['card_100']);
  variable_set('card_200', $data['card_200']);
  variable_set('card_500', $data['card_500']);
  variable_set('bg_header', $data['bg_header']);
   variable_set('bg_page', $data['bg_page']);
  variable_set('email_processcing', $data['email_processcing']['value']);
  variable_set('email_compeleted', $data['email_compeleted']['value']);
  variable_set('email_cancel', $data['email_cancel']['value']);
  variable_set('email_invite', $data['email_invite']['value']);
  variable_set('message_node_enought_point', $data['message_node_enought_point']['value']);
  drupal_set_message('Update success.');
}

