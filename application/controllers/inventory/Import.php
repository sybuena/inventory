<?php

class Import extends MY_Controller {
    
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
        $data['js']       = $this->config->item('inventoryImport_js');
        $data['css']      = $this->config->item('inventory_css');
        $data['inventory']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user']     = loginData();

        $this->load->view('inventory/import', $data);
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
