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
    	$data['js']       = $this->config->item('purchaseDetail_js');
        $data['css']      = $this->config->item('purchaseDetail_css');
        $data['purchaseDetail']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['org'] 		= $this->_organization;
        $data['user']     = loginData();

  		$id = $_GET['id'];
  		//get purchase detail
  		$row = $this->purchase->detail($id);

        $row['line']    = isset($row['line']) ? $row['line'] : array();
        $row['service'] = isset($row['service']) ? $row['service'] : array();
        $row['other']   = isset($row['other']) ? $row['other'] : array();
        
  		//get line item detail
  		if(!empty($row['line'])) {
            foreach($row['line'] as $k => $v) {
                $name = $this->inventory->detail($v['id'], array('code', 'name'));

                $row['line'][$k]['name'] = '('.$name['code'].') '.$name['name'];
            }
        }

        //get line service detail
        if(!empty($row['service'])) {
            foreach($row['service'] as $k => $v) {
                $name = $this->inventory->detail($v['id'], array('code', 'name'));

                $row['service'][$k]['name'] = '('.$name['code'].') '.$name['name'];
            }
        }

        //get supplier detail
        $row['supplier'] = $this->customer->detail($row['supplier']);
        
    	$data['purchase'] = $row;
        $data['id'] = $id;

        if($row['status'] == 1) {
            $data['status_text'] = 'Pending Purchase Order';
            $data['status_class'] = 'bgm-orange';
        } else if($row['status'] == 2) {
            $data['status_text'] = 'Draft Purchase Order';
            $data['status_class'] = 'bgm-cyan';
        } else if($row['status'] == 3) {
            $data['status_text'] = 'Approved Purchase Order';
            $data['status_class'] = 'bgm-lightgreen';
        } else if($row['status'] == 4) {
            $data['status_text'] = 'Declined Purchase Order';
            $data['status_class'] = 'bgm-red';
        }
        
    	$this->load->view('purchase/detail', $data);
    }

    /**
     * Approved or declined purchase
     * 
     * @param string
     * @param string
     * @return json
     */
    public function action($action, $id) {
        //prevent duplicate action
        $row = $this->purchase->detail($id);
        //only if pending status we allow approve, decline
        if($row['status'] != 1) {
            return $this->_returnError('wrong_status');
        }
        $update['status'] = ($action == 'approve') ? 3 : 4;
        $update['approved_by'] = loginId();
        $update['approve_date'] = strtotime('now');
        //update
        $this->purchase->edit($id, $update);

        //if approved, we need to add item stock
        if($action == 'approve' && isset($row['line'])) {
            
            foreach($row['line'] as $v) {
                //get item detail
                $item = $this->inventory->detail($v['id'], array('stock'));
                //default, if item has no stock
                $itemStock = $v['quantity'];
                //if already have stock
                if(isset($item['stock']) && !empty($item['stock'])) {
                    $itemStock = ($item['stock'] + $v['quantity']);
                }
                //now update to add stock
                $this->inventory->updateItem($v['id'], array(
                    'stock'         => $itemStock,
                    'stock_updated' => strtotime('now')
                ));
            }
        }

        return $this->_returnSuccess();
    }

    /**
     * Delete purchase
     * 
     * @param string
     * @return json
     */
    public function delete($id) {

        $update['status'] = 0;
        $update['deleted_by'] = loginId();
        $update['deleted_date'] = strtotime('now');

        $this->purchase->edit($id, $update);
        
        return $this->_returnSuccess();
    }
 	
    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
