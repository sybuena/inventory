<?php //-->

if($_SERVER['SERVER_NAME'] == 'dev.apgars-inventory.com') {
	$config['recaptcha_site_key'] = '6Lfi-A0UAAAAAPkSXDtXQbAXgMEpI0wlrGEVgFbH';
	$config['recaptcha_secret_key'] = '6Lfi-A0UAAAAAAT6IsEMh_YlHR4xT7R-qerueYga';
//for LIVE SERVER/DATABASE
} else if($_SERVER['SERVER_NAME'] == 'apgars-inventory.com') {
	$config['recaptcha_site_key'] = '6Lfi-A0UAAAAAPkSXDtXQbAXgMEpI0wlrGEVgFbH';
	$config['recaptcha_secret_key'] = '6Lfi-A0UAAAAAAT6IsEMh_YlHR4xT7R-qerueYga';
//else DEFAULT LOCAL
} else {
	$config['recaptcha_site_key'] = '6LeT-A0UAAAAABEiyyPM1s1oMN1nnqZPEP8qlFsz';
	$config['recaptcha_secret_key'] = '6LeT-A0UAAAAAFrLOoFlCGwGpVjtAa5GKJGkujzl';
}