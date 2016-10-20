<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include(APPPATH.'controllers/Main.php');

class AccountSettings extends MY_Controller {
	
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

        if($this->login->status() != 'portal') {

            redirect($this->login->status());
        }
    }

    /* Public Function
    -------------------------------*/
	public function index() {
        $data['js']  = $this->_accountSettingsJs;
        $data['css'] = $this->_accountSettingsCss;

		$this->load->view('accountSettings', $data);
	}


	/* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
