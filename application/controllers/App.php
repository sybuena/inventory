<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include(APPPATH.'controllers/Main.php');

class App extends MY_Controller {
	
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
        
        if($this->login->status() != 'app') {
            
            redirect($this->login->status());
        }    

    }

    /* Public Function
    -------------------------------*/
	public function index() {
        $data['js']  = $this->_digongJs;
        $data['css'] = $this->_digongCss;
        $data['dashboard']    = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user'] = loginData();
        
		$this->load->view('dashboard', $data);
	}

    public function search() {
        
        //remove url encode
        $query  = urldecode($_GET['query']);
        $orgId  = $this->_organization['_id']->{'$id'};
        $row1 = $this->customer->search($query, $orgId);
        $row2 = $this->inventory->searchGlobal($query, $orgId);
        $row = array_merge($row1, $row2);
        echo json_encode(array('suggestions'=> $row));
        exit;
    }


	/* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
