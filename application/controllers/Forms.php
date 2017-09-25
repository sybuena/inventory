<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends MY_Controller {
    
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
       redirect('login');
    }

    /**
     * Purchase order pdf
     * 
     * @param  bool
     * @return this
     */
    public function purchase($purchaseId = 0) {

    	$row = $this->purchase->detail($purchaseId);
    	$supplierDetail = $this->customer->detail($info['supplier']);
    	
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
    	
    	$data = array(
    		'supplier' => $this->customer->detail($row['supplier']),
    		'info' => $row
    	);

       	$html = $this->load->view('pdf/purchase/purchase', $data, true);
       	//echo $html;exit;
       	$this->mpdf
            ->setTitle('Purchase Order')
            ->setHtml($html)
            ->show();
    } 

    /**
     * Invoice PDF
     * 
     * @param  bool
     * @return this
     */
    public function invoice($invoiceId = 0) {
    	//get purchase detail
  		$row = $this->sales->detail($invoiceId);

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

        if(!empty($row['service'])) {
            foreach($row['service'] as $k => $v) {
                $name = $this->inventory->detail($v['id'], array('code', 'name'));

                $row['service'][$k]['name'] = '('.$name['code'].') '.$name['name'];
            }
        }

    	$data = array(
    		'customer' => $this->customer->detail($row['customer']),
    		'info' => $row
    	);

       	$html = $this->load->view('pdf/invoice/invoice', $data, true);

       	//echo $html;
       	$this->mpdf
            ->setTitle('Sales Invoice')
            ->setHtml($html)
            ->show();
    }


    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}