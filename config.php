<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$email['mailtype']            = 'html';
$email['charset']             = 'utf-8';
$email['protocol']            = 'smtp';
$email['smtp_host']           = 'ssl://smtp.sendgrid.net';
$email['smtp_port']           = 465;
$email['smtp_user']           = 'sybuena-tenelleven';//'sybuena-fusion';//'sybuena';//your sendgrid username
$email['smtp_pass']           = 'W@lkingd3@d12345';//your sendgrid password'
$email['smtp_timeout']        = '4';
$email['crlf']                = '\n';
$email['newline']             = '\r\n';
$email['default_email']       = 'no-reply@test.com';
$email['default_email_name']  = 'The Team';

return array(
    'email' => $email,
);