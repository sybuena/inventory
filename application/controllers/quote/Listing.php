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
        $data['js']       = $this->config->item('quote_js');
        $data['css']      = $this->config->item('quote_css');
        $data['quote']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user']     = loginData();

        $this->load->view('quote/list', $data);
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
        $row = $this->quote->getList($sort, $search, $offset, $limit);

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
        $row = $this->quote->detail($id);
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
     * Add quote
     * 
     * @param string
     * @return json
     */
    public function add() {

        parent::post(); 
        
        $_POST['line'] = (isset($_POST['line'])) ? $_POST['line'] : array();
        $_POST['service'] = (isset($_POST['service'])) ? $_POST['service'] : array();
        $_POST['other'] = (isset($_POST['other'])) ? $_POST['other'] : array();

        $this->quote->create($_POST);

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

        $this->quote->edit($id, $_POST);

        return $this->_returnSuccess();
    }

    
    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
