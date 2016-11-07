<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include(APPPATH.'controllers/Main.php');

class Notes extends MY_Controller {
	
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
        $data['js']       = $this->config->item('notes_js');
        $data['css']      = $this->config->item('notes_css');
        $data['notes']    = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user'] = loginData();
        
		$this->load->view('notes/list', $data);
	}

    /**
     * Get notes
     * 
     * @return json
     */
    public function getList() {

        $sort   = (isset($_POST['sort'])) ? $_POST['sort'] : array();
        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? 
            $_POST['searchPhrase'] : '';

        //get member list
        $row = $this->notes->getList($sort, $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);     
    }


	/* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
