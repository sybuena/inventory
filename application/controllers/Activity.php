<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include(APPPATH.'controllers/Main.php');

class Activity extends MY_Controller {
	
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
        
	}

    public function getAllActivity() {
        parent::post();

        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';

        //get member list
        $row = $this->activity->allActivity(loginOrg(), $_POST['sort'], $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);
    }

    public function addNote($id) {

        $this->activity
            ->setTitle('a note')
            ->setAction('create')
            ->setFor($id)
            ->setType('note')
            ->setNote($_POST['note'])
            ->save(MY_Model::CALL_LOG, $id);

        return $this->_returnSuccess();
    }

    /**
     * CRM activity, this will used the customer ID
     * as base where statement
     * 
     * @param string
     * @return json
     */
    public function crmActivity($reportId) {

        $row = $this->activity->crmActivity($reportId);

        return $this->_returnData($row);
    }


	/* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
