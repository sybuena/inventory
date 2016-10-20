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
        
    	$data['js']       = $this->config->item('quoteDetail_js');
        $data['css']      = $this->config->item('quoteDetail_css');
        $data['sales']     = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['org'] 	  = $this->_organization;
        $data['user']     = loginData();

  		$id = $_GET['id'];
  		//get purchase detail
  		$row = $this->quote->detail($id);

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

        //get supplier detail
        $row['customer'] = $this->customer->detail($row['customer']);
        
    	$data['quote'] = $row;
        $data['id'] = $id;

        if($row['status'] == 1) {
            $data['status_text'] = 'Pending Sales Quote';
            $data['status_class'] = 'bgm-orange';
        } else if($row['status'] == 2) {
            $data['status_text'] = 'Draft Sales Quote';
            $data['status_class'] = 'bgm-cyan';
        } else if($row['status'] == 3) {
            $data['status_text'] = 'Approved Sales Quote';
            $data['status_class'] = 'bgm-lightgreen';
        } else if($row['status'] == 4) {
            $data['status_text'] = 'Declined Sales Quote';
            $data['status_class'] = 'bgm-red';
        }

    	$this->load->view('quote/detail', $data);
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

        $this->quote->edit($id, $update);
        
        return $this->_returnSuccess();
    }
 	
    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
