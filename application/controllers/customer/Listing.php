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

    }

    /* Public Function
    -------------------------------*/
    public function index() {
       //prepare variables we need
        $data['js']       = $this->config->item('crm_js');
        $data['css']      = $this->config->item('crm_css');
        $data['crm']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user']     = loginData();

        $this->load->view('customer/list', $data);
    }

    /**
     * Delete batch customer
     * 
     * @return json
     */
    public function delete() {
        
        parent::post();
        
        foreach($_POST['items'] as $v) {

            $data = array(
                'status'        => 0,
                'date_deleted'  => strtotime('now'),
                'deleted_by'    => loginId()
            );

            $this->customer->updateCustomer($v, $data);
        }

        return $this->_returnSuccess();
    }


    /**
     * Get Group Listing
     * 
     * @param string
     * @return json
     */
    public function getGroupList() {
        
        $row = $this->customer->getGroupList();

        return $this->_returnData($row); 
    }

    /**
     * Get Customer Listing
     * 
     * @param string
     * @return json
     */
    public function getList($group = 'all') {

        $sort   = (isset($_POST['sort'])) ? $_POST['sort'] : array();
        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';
        $orgId  = $this->_organization['_id']->{'$id'};

        //get member list
        $row = $this->customer->getList($group, $orgId, $sort, $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row); 
    }

    public function searchDashboard() {
        
        //remove url encode
        $query  = urldecode($_GET['query']);
        $orgId  = $this->_organization['_id']->{'$id'};
        $row = $this->customer->search($query, $orgId);

        echo json_encode(array('suggestions'=> $row));
        exit;
    }
    /**
     * Add Customer 
     * 
     * @return json
     */
    public function addGroup() { 
        
        parent::post();

        $message = $this->customer->createGroup($_POST);
        //if foudn duplicate name, will return error
        return (empty($message)) ? $this->_returnSuccess() : $this->_returnError($message['message'], $message['long_message']);
    }

    /**
     * Add customer
     *
     * @return json
     */
    public function addCustomer() {
        
        parent::post();

        $message = $this->customer->createCustomer($_POST);
        
        return (empty($message)) ? $this->_returnSuccess() : $this->_returnError($message['message'], $message['long_message']);
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
