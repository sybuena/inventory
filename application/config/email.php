<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['mailtype']            = 'html';
$config['charset']             = 'utf-8';
$config['protocol']            = 'smtp';
$config['smtp_host']           = 'ssl://smtp.sendgrid.net';
$config['smtp_port']           = 465;
$config['smtp_user']           = 'sybuena-fusion';//'sybuena';//your sendgrid username
$config['smtp_pass']           = 'w@lkingd3@d';//your sendgrid password'
$config['smtp_timeout']        = '4';
$config['crlf']                = '\n';
$config['newline']             = '\r\n';
$config['default_email']       = 'no-reply@tenelleven.com';
$config['default_email_name']  = 'The Tenelleven Team';
