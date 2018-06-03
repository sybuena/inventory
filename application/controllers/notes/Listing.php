<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include(APPPATH.'controllers/Main.php');

class Listing extends MY_Controller {
	
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

    public function detail($id) {
        $where = array('_id' => new MongoId($id));
        $data = $this->cimongo
            ->get_where(MY_Model::NOTES, $where)
            ->row_array();

        return $this->_returnData($data);
    }

    public function delete() {
        
        parent::post();
        
        foreach($_POST['items'] as $v) {

            $data = array(
                'status'        => 0,
                'date_deleted'  => strtotime('now'),
                'deleted_by'    => loginId()
            );

            $this->cimongo
                ->where(array('_id' => new MongoId($v)))
                ->update(MY_Model::NOTES, $data);
        }

        return $this->_returnSuccess();
    }

    public function edit($id) {
        parent::post();

        $_POST['date_updated'] = strtotime('now');

        $this->cimongo
            ->where(array('_id' => new MongoId($id)))
            ->update(MY_Model::NOTES, $_POST);

        return $this->_returnSuccess();
    }

    /**
     * Add Notes
     *
     * @return this;
     */
    public function add() {
        parent::post();
        $_POST['date_created'] = strtotime('now');
        $_POST['status'] = 1;
        $_POST['created_by'] = loginId();
        $_POST['org_id'] = loginOrg();
        
        $this->cimongo->insert(MY_Model::NOTES, $_POST);

        return $this->_returnSuccess();
    }

    /**
     * Get notes
     * 
     * @return json
     */
    public function getList($type = 'all') {

        $sort   = (isset($_POST['sort'])) ? $_POST['sort'] : array();
        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? 
            $_POST['searchPhrase'] : '';

        //get member list
        $row = $this->notes->getList($type, $sort, $search, $offset, $limit);

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
