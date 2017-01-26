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
        $data['js']       = $this->config->item('jobOrder_js');
        $data['css']      = $this->config->item('jobOrder_css');
        $data['jobOrder']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user']     = loginData();

        $this->load->view('jobOrder/list', $data);
    }



    public function calculateHeader() {
        $where = array(
            'status' => array('$ne' => 0),
            'org_id' => loginOrg()
        );
        $row = $this->cimongo   
            ->select(array('total_amount', 'status', 'due_date'))
            ->get_where(MY_Model::JOB_ORDER, $where)
            ->result_array();

        $data = array(
            'draft'   => 0, 
            'sent'     => 0,
            'accepted'   => 0,
            'invoiced'   => 0
        );

        foreach($row as $v) {
            if($v['status'] ==  1) {
                $data['sent'] += $v['total_amount'];
            }
            if($v['status'] ==  2) {
                $data['draft'] += $v['total_amount'];
            }
            if($v['status'] ==  3) {
                $data['accepted'] += $v['total_amount'];
            }
            if($v['status'] ==  4) {
                $data['invoiced'] += $v['total_amount'];
            }
        }
        $data['sent'] = money($data['sent']);
        $data['draft'] = money($data['draft']);
        $data['accepted'] = money($data['accepted']);
        $data['invoiced'] = money($data['invoiced']);

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
        $row = $this->jobOrder->getList($sort, $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);     
    }

     /**
     * Get quote draft detail
     * 
     * @param string
     * @return json
     */
    public function draftDetail($id) {
        //detail of quote 
        $row = $this->jobOrder->detail($id);
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
     * Add quote
     * 
     * @param string
     * @return json
     */
    public function add() {

        parent::post(); 
       
        $_POST['service'] = (isset($_POST['service'])) ? $_POST['service'] : array();
        $_POST['other'] = (isset($_POST['other'])) ? $_POST['other'] : array();

        $this->jobOrder->create($_POST);

        //now update numner
        $this->settings->updateNextNumber('job_order');

        return $this->_returnSuccess();
    }

    /**
     * Edit quote
     * 
     * @param string
     * @return json
     */
    public function edit($id) {

        parent::post();

        $_POST['line'] = (isset($_POST['line'])) ? $_POST['line'] : array();
        $_POST['service'] = (isset($_POST['service'])) ? $_POST['service'] : array();
        $_POST['other'] = (isset($_POST['other'])) ? $_POST['other'] : array();

        $this->jobOrder->edit($id, $_POST);

        return $this->_returnSuccess();
    }

    
    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
