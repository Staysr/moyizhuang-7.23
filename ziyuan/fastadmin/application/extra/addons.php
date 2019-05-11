<?php

return array (
  'autoload' => false,
  'hooks' => 
  array (
    'app_init' => 
    array (
      0 => 'epay',
    ),
    'ems_send' => 
    array (
      0 => 'faems',
    ),
    'ems_notice' => 
    array (
      0 => 'faems',
    ),
    'action_begin' => 
    array (
      0 => 'geetest',
    ),
    'config_init' => 
    array (
      0 => 'geetest',
      1 => 'qcloudsms',
    ),
    'admin_login_init' => 
    array (
      0 => 'loginbg',
    ),
    'response_send' => 
    array (
      0 => 'loginbgindex',
      1 => 'loginvideo',
    ),
    'index_login_init' => 
    array (
      0 => 'loginbgindex',
    ),
    'testhook' => 
    array (
      0 => 'markdown',
    ),
    'prismhook' => 
    array (
      0 => 'prism',
    ),
    'sms_send' => 
    array (
      0 => 'qcloudsms',
      1 => 'smsbao',
    ),
    'sms_notice' => 
    array (
      0 => 'qcloudsms',
      1 => 'smsbao',
    ),
    'sms_check' => 
    array (
      0 => 'qcloudsms',
      1 => 'smsbao',
    ),
    'user_sidenav_after' => 
    array (
      0 => 'recharge',
      1 => 'signin',
    ),
  ),
  'route' => 
  array (
    '/example$' => 'example/index/index',
    '/example/d/[:name]' => 'example/demo/index',
    '/example/d1/[:name]' => 'example/demo/demo1',
    '/example/d2/[:name]' => 'example/demo/demo2',
    '/qrcode$' => 'qrcode/index/index',
    '/qrcode/build$' => 'qrcode/index/build',
    '/third$' => 'third/index/index',
    '/third/connect/[:platform]' => 'third/index/connect',
    '/third/callback/[:platform]' => 'third/index/callback',
  ),
);