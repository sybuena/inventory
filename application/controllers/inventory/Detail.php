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
        
        $data['data'] = $inventory;
        //get category list
        $data['category'] = $this->inventory->getCategoryList(array('name'));
        $data['type']  = array(
            'item', 'service' 
        );
        $data['inJobOrder'] = $this->inventory->itemJobOrder($id);
        $data['inQuatation'] = $this->inventory->itemQuantation($id);
        $data['salesPending'] = $this->inventory->itemPendingSales($id);
        $data['purchasePending']  = $this->inventory->itemPendingPurchase($id);
        
        $this->load->view('inventory/detail', $data);
    }

    /**
     * Manual minus inventory
     * 
     * @param string
     * @return json
     */
    public function manualMinus($id) {
        
        parent::post();

        $inventory = $this->inventory->detail($id, array('stock'));
        
        $inventory['stock'] = (isset($inventory['stock']) && !empty($inventory['stock'])) 
            ? $inventory['stock'] : 0;

        $stock = $inventory['stock'] - $_POST['quantity'];
        
        $update = array(
            'stock' => $stock,
            'stock_updated_by' => loginId(),
            'stock_updated_date' => strtotime('now'),
        );
        
        $this->inventory->minusQuantityLog($id, $_POST['quantity'], $_POST['description'], 'manual');

        $this->inventory->updateItem($id, $update);

        return $this->_returnData(array('stock' => decim($stock)));
    }

    /**
     * Manual add inventory
     * 
     * @param string
     * @return json
     */
    public function manualAdd($id) {
        
        parent::post();

        $inventory = $this->inventory->detail($id, array('stock'));
        
        $inventory['stock'] = (isset($inventory['stock']) && !empty($inventory['stock'])) 
            ? $inventory['stock'] : 0;

        $stock = $inventory['stock'] + $_POST['quantity'];
        
        $update = array(
            'stock' => $stock,
            'stock_updated_by' => loginId(),
            'stock_updated_date' => strtotime('now'),
        );
        
        $this->inventory->addQuantityLog($id, $_POST['quantity'], $_POST['description'], 'manual');

        $this->inventory->updateItem($id, $update);

        return $this->_returnData(array('stock' => decim($stock)));
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
        
        if(isset($_POST['category']) && !empty($_POST['category'])) {

        }
        if(!empty($_POST['category'])) {
            //now get group name
            $group = $this->inventory->getCategotyDetail($_POST['category'], array('name'));

            $_POST['category'] = array(
                'id'    => $_POST['category'],
                'name'  => $group['name']
            );
        }

        $this->inventory->updateItem($id, $_POST);
        
        return $this->_returnSuccess();
    }

    /**
     * Get inventory sales transaction for all inventory status
     * 
     * @param string
     * @return json
     */
    public function quantityLog($id) {

        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        
        //get member list
        $row = $this->inventory->getQuantityList($id, $sort, $search, $offset, $limit);

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
    public function jobOrder($id) {

        $sort   = (isset($_POST['sort'])) ? $_POST['sort'] : array();
        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';

        //get member list
        $row = $this->jobOrder->getInventoryJobOrder($id, $sort, $search, $offset, $limit);

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
    public function quotation($id) {

        $sort   = (isset($_POST['sort'])) ? $_POST['sort'] : array();
        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';

        //get member list
        $row = $this->sales->getInventoryQuotation($id, $sort, $search, $offset, $limit);

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
