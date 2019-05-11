<?php
error_reporting(0);

$CONF = $TMPL = array();

// The MySQL credentials
$CONF['host'] = 'localhost';
$CONF['user'] = 'root';
$CONF['pass'] = 'root';
$CONF['name'] = 'xryy';

// The Installation URL
$CONF['url'] = 'http://www.enboo.cn';

// The Notifications e-mail
$CONF['email'] = '10373458@qq.com';

// The themes directory
$CONF['theme_path'] = 'themes';

$action = array('admin'			=> 'admin',
				'explore'		=> 'explore',
				'stream'		=> 'stream',
				'settings'		=> 'settings',
				'messages'		=> 'messages',
				'track'			=> 'track',
				'playlist'		=> 'playlist',
				'upload'		=> 'upload',
				'recover'		=> 'recover',
				'profile'		=> 'profile',
				'stats'			=> 'stats',
				'pro'			=> 'pro',
				'notifications'	=> 'notifications',
				'search'		=> 'search',
				'page'			=> 'page',
				'welcome'		=> 'welcome'
				);
?>