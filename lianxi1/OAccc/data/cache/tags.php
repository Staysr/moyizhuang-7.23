<?php 	
 return array (
  'config_read' => 
  array (
    0 => 'core\\dzz\\config',
  ),
  'check_login' => 
  array (
    0 => 'user\\classes\\checklogin',
  ),
  'register_common' => 
  array (
    0 => 'user\\register\\classes\\regcommon',
  ),
  'check_val' => 
  array (
    0 => 'user\\register\\classes\\checkvalue|user',
  ),
  'register_before' => 
  array (
    0 => 'user\\register\\classes\\register|user',
  ),
  'email_chk' => 
  array (
    0 => 'user\\profile\\classes\\emailchk|user',
  ),
  'token_chk' => 
  array (
    0 => 'user\\sso\\classes\\oauth|user/sso',
  ),
  'login_valchk' => 
  array (
    0 => 'user\\login\\classes\\loginvalchk|user/login',
  ),
  'login_check' => 
  array (
    0 => 'user\\login\\classes\\logincheck|user',
  ),
  'mod_start' => 
  array (
    0 => 'core\\dzz\\modroute',
  ),
  'adminlogin' => 
  array (
    0 => 'admin\\login\\classes\\adminlogin',
  ),
  'mod_run' => 
  array (
    0 => 'core\\dzz\\modrun',
  ),
  'app_run' => 
  array (
    0 => 'core\\dzz\\apprun',
  ),
  'dzz_initafter' => 
  array (
    0 => 'user\\classes\\route|user',
  ),
  'dzz_initbefore' => 
  array (
    0 => 'misc\\classes\\init|misc',
    1 => 'user\\classes\\init|user',
  ),
  'dzz_route' => 
  array (
    0 => 'core\\dzz\\route',
  ),
  'safe_chk' => 
  array (
    0 => 'user\\classes\\safechk',
  ),
  'systemlog' => 
  array (
    0 => 'admin\\systemlog\\classes\\systemlog',
  ),
);