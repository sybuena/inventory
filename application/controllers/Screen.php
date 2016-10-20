<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Screen extends MY_Controller {
    
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

        $data['js']  = $this->config->item('screen_js');
        $data['css'] = $this->config->item('screen_css');
        

        $this->load->view('screen', $data);  
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/
}
