<?php
defined('BASEPATH') OR exit('No direct script access allowed');


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
    public function index() {
       //prepare variables we need
        $data['js']        = $this->config->item('inventoryDetail_js');
        $data['css']       = $this->config->item('inventory_css');
        $data['inventory'] = 'active';
        $data['org_name']  = $this->_organization['name'];
        $data['user']      = loginData();
        $id = $_GET['id'];
        //get inventory detail
        $inventory = $this->inventory->detail($id);
        
        $inventory['sales'] = (isset($inventory['sales']) && !empty($inventory['sales'])) 
            ? $inventory['sales'] : 0;
        $inventory['cost'] = (isset($inventory['cost']) && !empty($inventory['cost'])) 
            ? $inventory['cost'] : 0;
        $inventory['stock'] = (isset($inventory['stock']) && !empty($inventory['stock'])) 
            ? $inventory['stock'] : 0;
        
        $data['inventory'] = $inventory;
        //get category list
        $data['category'] = $this->inventory->getCategoryList(array('name'));
        $data['type']  = array(
            'item', 'service' 
        );
        //pre($data);exit;
        $this->load->view('inventory/detail', $data);
    }

    /**
     * Update inventory
     * 
     * @param string
     * @return json
     */
    public function update($id) {
        parent::post();

        $_POST['updated_by'] = loginId();
        $_POST['updated_date'] = strtotime('now');

        $this->inventory->updateItem($id, $_POST);
        
        return $this->_returnSuccess();
    }

    /**
     * Get inventory sales transaction for all inventory status
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
        $row = $this->sales->getInventorySales($id, $sort, $search, $offset, $limit);

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
        $row = $this->purchase->getInventoryPurchase($id, $sort, $search, $offset, $limit);

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
