<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include(APPPATH.'controllers/Main.php');

class UserDetail extends MY_Controller {
	
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
        $data['js']  = $this->_digongJs;
        $data['css'] = $this->_digongCss;

		$this->load->view('settings/userDetail', $data);
	}

	/* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
