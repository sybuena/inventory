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

    public function calculateHeader() {
        $where = array(
            'status' => array('$ne' => 0),
            'org_id' => loginOrg()
        );
        $row = $this->cimongo   
            ->select(array('total_amount', 'status', 'due_date'))
            ->get_where(MY_Model::INVOICE, $where)
            ->result_array();

        $data = array(
            'pending'   => 0, 
            'draft'     => 0,
            'approved'   => 0,
            'declined'   => 0
        );

        foreach($row as $v) {
            if($v['status'] ==  1) {
                $data['pending'] += $v['total_amount'];
            }
            if($v['status'] ==  2) {
                $data['draft'] += $v['total_amount'];
            }
            if($v['status'] ==  3) {
                $data['approved'] += $v['total_amount'];
            }
            if($v['status'] ==  4) {
                $data['declined'] += $v['total_amount'];
            }
        }
        $data['pending'] = money($data['pending']);
        $data['draft'] = money($data['draft']);
        $data['approved'] = money($data['approved']);
        $data['declined'] = money($data['declined']);
        
        return $this->_returnData($data);
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

        //then get item name
        if(!empty($row['service'])) {
            foreach($row['service'] as $k => $v) {
                $name = $this->inventory->detail($v['id'], array('code', 'name'));
                //well format
                $row['service'][$k]['name'] = '('.$name['code'].') '.$name['name'];
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
        $this->settings->updateNextNumber('invoice');
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
