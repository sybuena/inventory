<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Detail extends MY_Controller {
    
    /* Constants
    -------------------------------*/

    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/

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
       //prepare variables we need
        $data['js']        = $this->config->item('inventory_js');
        $data['css']       = $this->config->item('inventory_css');
        $data['inventory'] = 'active';
        $data['org_name']  = $this->_organization['name'];
        $data['user']      = loginData();
        $id = $_GET['id'];
        //get inventory detail
        $data['inventory'] = $this->inventory->detail($id);
        
        $this->load->view('inventory/detail', $data);
    }

    
    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
