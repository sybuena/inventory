<?php
defined('BASEPATH') OR exit('No direct script access allowed');


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
        $data['js']       = $this->config->item('inventory_js');
        $data['css']      = $this->config->item('inventory_css');
        $data['inventory']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user']     = loginData();

        $this->load->view('inventory/list', $data);
    }

    /**
     * Delete batch item
     * 
     * @return json
     */
    public function delete() {
        
        parent::post();
        
        foreach($_POST['list'] as $v) {

            $data = array(
                'status'        => 0,
                'date_deleted'  => strtotime('now'),
                'deleted_by'    => loginId()
            );

            $this->inventory->updateItem($v, $data);
        }

        return $this->_returnSuccess();
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
        $row = $this->inventory->getList($group, $orgId, $sort, $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row); 
    }
    
    /**
     * Add Customer 
     * 
     * @return json
     */
    public function createCategory() { 
        
        parent::post();

        $message = $this->inventory->createCategory($_POST);
        //if foudn duplicate name, will return error
        return (empty($message)) ? $this->_returnSuccess() : $this->_returnError($message['message'], $message['long_message']);
    }

    /**
     * Add Item to inventory
     * 
     * @return json
     */
    public function addItem() {
        parent::post();

        $message = $this->inventory->add($_POST);
        
        return (empty($message)) ? $this->_returnSuccess() : $this->_returnError($message['message'], $message['long_message']);
    }

    /**
     * Get Group Listing
     * 
     * @param string
     * @return json
     */
    public function getCategoryList() {
        
        $row = $this->inventory->getCategoryList();

        return $this->_returnData($row); 
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
