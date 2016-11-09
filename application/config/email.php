<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include dirname(__FILE__).'/../../config.php';

$config['mailtype']           = $email['mailtype'];
$config['charset']            = $email['charset'];
$config['protocol']           = $email['protocol'];
$config['smtp_host']          = $email['smtp_host'];
$config['smtp_port']          = $email['smtp_port'];
$config['smtp_user']          = $email['smtp_user'];
$config['smtp_pass']          = $email['smtp_pass'];
$config['smtp_timeout']       = $email['smtp_timeout'];
$config['crlf']               = $email['crlf'];
$config['newline']            = $email['newline'];
$config['default_email']      = $email['default_email'];
$config['default_email_name'] = $email['default_email_name'];
echo '<pre>';
print_r($email['smtp_user']);exit;
