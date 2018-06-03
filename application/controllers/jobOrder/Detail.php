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
        
    	$data['js']       = $this->config->item('jobOrderDetail_js');
        $data['css']      = $this->config->item('jobOrderDetail_css');
        $data['jobOrder']     = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['org'] 	  = $this->_organization;
        $data['user']     = loginData();

  		$id = $_GET['id'];
  		//get purchase detail
  		$row = $this->jobOrder->detail($id);

        $row['service'] = isset($row['service']) ? $row['service'] : array();
        $row['other']   = isset($row['other']) ? $row['other'] : array();

        if(!empty($row['service'])) {
            foreach($row['service'] as $k => $v) {
                $name = $this->inventory->detail($v['id'], array('code', 'name'));

                $row['service'][$k]['name'] = '('.$name['code'].') '.$name['name'];
            }
        }

        //get supplier detail
        $row['customer'] = $this->customer->detail($row['customer']);
        
    	$data['jobOrder'] = $row;
        $data['id'] = $id;

        if($row['status'] == 1) {
            $data['status_text'] = 'Sent Job Order';
            $data['status_class'] = 'bgm-orange';
        } else if($row['status'] == 2) {
            $data['status_text'] = 'Draft Job Order';
            $data['status_class'] = 'bgm-cyan';
        } else if($row['status'] == 3) {
            $data['status_text'] = 'Accepted Job Order';
            $data['status_class'] = 'bgm-blue';
        } else if($row['status'] == 4) {
            $data['status_text'] = 'Invoiced Job Order';
            $data['status_class'] = 'bgm-lightgreen';
        }

    	$this->load->view('jobOrder/detail', $data);
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

        $this->jobOrder->edit($id, $update);
        
        return $this->_returnSuccess();
    }
 	
    /**
     * Sent, Accepted
     * 
     * @param string
     * @param string
     * @return json
     */
    public function action($action, $id) {
        //prevent duplicate action
        $row = $this->jobOrder->detail($id);
        
        $update['status'] = ($action == 'sent') ? 1 : 3;
        $update['mark_by'] = loginId();
        $update['mark_date'] = strtotime('now');
        
        //update
        $this->jobOrder->edit($id, $update);

        return $this->_returnSuccess();
    }

    public function convert($id) {
        //prevent duplicate action
        $row = $this->jobOrder->detail($id);
        //get next invoice number
        $invoiceNumber = $this->settings->nextNumber('invoice');

        $invoice = array(
            'status'            => 2, //mark as draft invoice
            'customer'          => $row['customer'],
            'invoice_number'    => $invoiceNumber,
            'reference_number'  => $row['job_order_number'],
            'date'              => $row['date'],
            'due_date'          => '',
            'total_amount'      => $row['total_amount'],
            'line'              => array(),
            'service'           => $row['service'],
            'other'             => $row['other'],
            'parent_quoatation' => $row['_id']->{'$id'},
            'from_job_order'    => true
        );

        //create and return last insert id
        $insertId = $this->sales->create($invoice);
        //update the quoatation as invoiced
        $update['status']   = 4;
        $update['mark_by']  = loginId();
        $update['mark_date'] = strtotime('now');
        
        //update
        $this->jobOrder->edit($id, $update);

        //now return what we need to js
        return $this->_returnData(array(
            'number' => $invoiceNumber,
            'id'     => $insertId
        ));
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
