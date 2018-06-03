<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends MY_Controller {
    
    /* Constants
    -------------------------------*/

    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/
    protected $_google = array();

    /* Private Properties
    -------------------------------*/

    /* Constructor
    -------------------------------*/    
    public function __construct() {

        parent::__construct();
        
        
    }

    /* Public Function
    -------------------------------*/
    public function index() {
       
    }

    public function test() {
       
    }

    public function webhook() {
        $challenge = $_REQUEST['hub_challenge'];
        $verify_token = $_REQUEST['hub_verify_token'];

        if ($verify_token === 'test_webbook_verify_token') {
          echo $challenge;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        error_log(print_r($input, true));

       

        //$input = json_decode(file_get_contents('php://input'), true);   
        //$this->cimongo->insert('test_webbook_fb', $input);
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/
}
