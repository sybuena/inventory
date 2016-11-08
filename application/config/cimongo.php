<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['host'] = 'localhost';
$config['port'] = 27017;

//if DEV SERVER/ DATABASE
if($_SERVER['SERVER_NAME'] == 'dev.apgars-inventory.com') {
	$config['db'] = 'apgars-dev';
//for LIVE SERVER/DATABASE
} else if($_SERVER['SERVER_NAME'] == 'apgars-inventory.com') {
	$config['db'] = 'apgars-live';
//else DEFAULT LOCAL
} else {
	$config['db'] = 'apgars';
}

/*  
 * Defaults to FALSE. If FALSE, the program continues executing without waiting for a database response. 
 * If TRUE, the program will wait for the database response and throw a MongoCursorException if the update did not succeed.
*/
$config['query_safety'] = TRUE;
//If running in auth mode and the user does not have global read/write then set this to true
$config['db_flag'] = TRUE;
//consider these config only if you want to store the session into mongoDB
//They will be used in MY_Session.php
$config['sess_use_mongo'] = TRUE;
$config['sess_collection_name']	= 'ci_sessions';
 