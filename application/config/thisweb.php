<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('America/Los_Angeles');

// For Controller: $this->config->load('thisweb');
// $config['xXx'] = 'xXx';
// $this->config->item('xXx')

$config['copyRight'] = 'Copyright &copy; '.date('Y').' SpaceCorp Innovative Technologies, All Rights Reserved.';

$config['siteName'] = 'Secure Voting System';
$config['companyName'] = 'United Federation of Earth';

$config['version'] = date('y.m.d',filemtime('application/config/thisweb.php'));
$config['slogan'] = 'Because Together, We Can Do Anything.';

$config['configDir'] = '.config/';
$config['usersDir'] = '.users/';
$config['dataDir'] = '.data/';

$config['userFields'] = explode('|', trim(file_get_contents($config['configDir'].'users.ary')) );
$config['pwCost'] = [ 'cost' => 10 ];

$level3 = array('ADMIN');
$level2 = array('ADMIN','TRUSTEE');
$level1 = array('ADMIN','TRUSTEE','USER');

// EoF !
