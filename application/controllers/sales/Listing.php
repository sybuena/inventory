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
        $data['js']       = $this->config->item('sales_js');
        $data['css']      = $this->config->item('sales_css');
        $data['sales']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user']     = loginData();

        $this->load->view('sales/list', $data);
    }

    /**
     * Get 
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
        $row = $this->sales->getList($sort, $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);     
    }
    
    /**
     * Get invoice draft detail
     * 
     * @param string
     * @return json
     */
    public function draftDetail($id) {
        //detail of invoice 
        $row = $this->sales->detail($id);
        //then get item name
        if(!empty($row['line'])) {
            foreach($row['line'] as $k => $v) {
                $name = $this->inventory->detail($v['id'], array('code', 'name'));
                //well format
                $row['line'][$k]['name'] = '('.$name['code'].') '.$name['name'];
            }
        }

        return $this->_returnData($row); 
    }

    /**
     * Add invoice
     * 
     * @param string
     * @return json
     */
    public function add() {

        parent::post(); 
        
        $_POST['line'] = (isset($_POST['line'])) ? $_POST['line'] : array();
        $_POST['service'] = (isset($_POST['service'])) ? $_POST['service'] : array();
        $_POST['other'] = (isset($_POST['other'])) ? $_POST['other'] : array();

        $this->sales->create($_POST);

        return $this->_returnSuccess();
    }

    /**
     * Edit sales
     * 
     * @param string
     * @return json
     */
    public function edit($id) {

        parent::post();

        $_POST['line'] = (isset($_POST['line'])) ? $_POST['line'] : array();
        $_POST['service'] = (isset($_POST['service'])) ? $_POST['service'] : array();
        $_POST['other'] = (isset($_POST['other'])) ? $_POST['other'] : array();

        $this->sales->edit($id, $_POST);

        return $this->_returnSuccess();
    }

    /**
     * 
     * 
     * @return json
     */
    public function searchItem($type = 'all') {
        $query = isset($_GET['query']) ? $_GET['query'] : $_GET['q'];
        
        $data = $this->inventory->search($query, $type, (($type == 'service') ? 0 : 1));

        return $this->_returnData($data); 
    }

    /**
     * Get custoner
     * 
     * @return json
     */
    public function getCustomer() {

        $row = $this->customer->getAllContacts();

        return $this->_returnData($row);
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
