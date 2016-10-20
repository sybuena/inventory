<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zendesk extends MY_Controller {
    
    /* Constants
    -------------------------------*/

    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/
    protected $_google = array();

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
       
    }

    public function test() {
        
        echo $this->zendesk->getOrganizationId();
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/
}
