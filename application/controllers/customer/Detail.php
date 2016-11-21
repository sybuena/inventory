<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include(APPPATH.'controllers/Main.php');

class Detail extends MY_Controller {
    
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
    /**
     * Customer detail view page
     * 
     * @param string
     * @return html|string
     */
    public function index() {
        $id = $_GET['id'];
        //prepare variables we need
        $data['js']       = $this->config->item('crmDetail_js');
        $data['css']      = $this->config->item('crmDetail_css');
        $data['crm']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user']     = loginData();
        $data['customer'] = $this->customer->detail($id);
        $data['id']       = $id;
        
        $this->load->view('customer/detail', $data);
    }

    /**
     * Get inventory sales transaction for all inventory status
     * 
     * @param string
     * @return json
     */
    public function quotation($id) {

        $sort   = (isset($_POST['sort'])) ? $_POST['sort'] : array();
        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';

        //get member list
        $row = $this->sales->getCustomerQuotation($id, $sort, $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);
    }

    /**
     * Get customer sales transaction for all inventory status
     * 
     * @param string
     * @return json
     */
    public function sales($id) {

        $sort   = (isset($_POST['sort'])) ? $_POST['sort'] : array();
        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';

        //get member list
        $row = $this->sales->getCustomerSales($id, $sort, $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);
    }

    /**
     * Get inventory sales transaction for all inventory status
     * 
     * @param string
     * @return json
     */
    public function purchase($id) {

        $sort   = (isset($_POST['sort'])) ? $_POST['sort'] : array();
        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';

        //get member list
        $row = $this->purchase->getCustomerPurchase($id, $sort, $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);
    }


    /**
     * Edit all customer fields, just pass array
     * 
     * @param string
     * @return json
     */
    public function editCustomer($id) {

        parent::post();
        //if there is name
        if(isset($_POST['first_name']) && isset($_POST['last_name'])) {
            //build name
            $_POST['name'] = $_POST['first_name'].' '.$_POST['last_name'];
        }

        //add date modified
        $_POST['last_update'] = strtotime('now');
        $_POST['updated_by'] = loginId();

        $this->customer->updateCustomer($id, $_POST);
        
        return $this->_returnSuccess();
    }

    /**
     * Get call log listng of customer with call balance
     * 
     * @param string
     * @return json
     */
    public function getCallLog($id) {

        $sort   = (isset($_POST['sort'])) ? $_POST['sort'] : array();
        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';
        $orgId  = $this->_organization['_id']->{'$id'};
        
        //get member list
        $row = $this->call->getList($group, $orgId, $sort, $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);
    }

    /**
     * Save call log and minus the call log balance of customer
     * 
     * @param string
     * @return json
     */
    public function updateCallBalance($id) {

        parent::post();
        
        $orgId  = $this->_organization['_id']->{'$id'};
        
        $callLogId = $this->call->updateCallBalance($orgId, $id, $_POST);
        //if add balance
        if($_POST['sign'] == 'plus') {
            $title  = number_format( ((int)$_POST['seconds'] / 60), 2).' minute(s) Call Balance';
            $action = 'add';
        //else it is record call
        } else {
            $title  = number_format( ((int)$_POST['seconds'] / 60), 2).' minute(s) Call Balance';
            $action = 'use';
        }

        $this->activity
            ->setTitle($title)
            ->setAction($action)
            ->setFor($id)
            ->save(MY_Model::CALL_LOG, $callLogId);

        return $this->_returnSuccess();
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
