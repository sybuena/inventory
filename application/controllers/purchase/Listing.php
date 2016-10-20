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
        $data['js']       = $this->config->item('purchase_js');
        $data['css']      = $this->config->item('purchase_css');
        $data['purchase']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user']     = loginData();

        $this->load->view('purchase/list', $data);
    }

    public function calculateHeader() {
        
    }
    
    /**
     * Get purchase draft detail
     * 
     * @param string
     * @return json
     */
    public function draftDetail($id) {
        
        $row = $this->purchase->detail($id);
        
        if(!empty($row['line'])) {
            foreach($row['line'] as $k => $v) {
                $name = $this->inventory->detail($v['id'], array('code', 'name'));

                $row['line'][$k]['name'] = '('.$name['code'].') '.$name['name'];
            }
        }

        if(!empty($row['service'])) {
            foreach($row['service'] as $k => $v) {
                $name = $this->inventory->detail($v['id'], array('code', 'name'));

                $row['service'][$k]['name'] = '('.$name['code'].') '.$name['name'];
            }
        }

        return $this->_returnData($row); 
    }

    /**
     * Get suppliers
     * 
     * @return json
     */
    public function searchItem($type = 'all') {
        $query = isset($_GET['query']) ? $_GET['query'] : $_GET['q'];
        $data = $this->inventory->search($query, $type);

        return $this->_returnData($data); 
    }

    /**
     * Get suppliers
     * 
     * @return json
     */
    public function getItems() {
        $row =  $this->inventory->getAllInventory();   
        
        return $this->_returnData($row); 
    }

    /**
     * Get suppliers
     * 
     * @return json
     */
    public function getSupplier() {

        $row = $this->customer->getAllContacts();

        return $this->_returnData($row);
    }

    public function add() {

        parent::post();

        $_POST['line'] = (isset($_POST['line'])) ? $_POST['line'] : array();
        $_POST['service'] = (isset($_POST['service'])) ? $_POST['service'] : array();
        $_POST['other'] = (isset($_POST['other'])) ? $_POST['other'] : array();

        $this->purchase->create($_POST);

        return $this->_returnSuccess();
    }

    /**
     * Edit purchase
     * 
     * @param string
     * @return json
     */
    public function edit($id) {

        parent::post();
        
        $_POST['line'] = (isset($_POST['line'])) ? $_POST['line'] : array();
        $_POST['service'] = (isset($_POST['service'])) ? $_POST['service'] : array();
        $_POST['other'] = (isset($_POST['other'])) ? $_POST['other'] : array();
        
        $this->purchase->edit($id, $_POST);

        return $this->_returnSuccess();
    }

    /**
     * Get suppliers
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
        $row = $this->purchase->getList($sort, $search, $offset, $limit);

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
