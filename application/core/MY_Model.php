<?php defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Model extends CI_Model {

    /* Constants
    -------------------------------*/
    const USERS_TABLE     = 'users';
    const LOGIN_ACTIVITY  = 'login_activity';
    const ORGANIZATION    = 'organization';
    const NONCE           = 'nonce';
    const MEMBER          = 'member';
    

    const ACTIVITY_HISTORY  = 'activity_history';
    //CRM
    const CUSTOMER          = 'customer';
    const CUSTOMER_GROUP    = 'customer_group';
    
    //INVENTORY
    const INVENTORY_CATEGORY = 'inventory_category';
    const INVENTORY          = 'inventory';

    const PURCHASE          = 'purchase';
    const INVOICE           = 'invoice';
    const QUOTE             = 'quote';
    const NOTES             = 'notes';

    //SETTINGS
    const SETTINGS = 'settings';

    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/
    protected $_defaultEmail      = null;
    protected $_defaultEmailName  = null;
    protected $_protocol          = null;

    /* Private Properties
    -------------------------------*/
    
    /* Constructor
    -------------------------------*/
	public function __construct() {
        
		parent::__construct();

        $this->_defaultEmail        = 'no-reply@inventory-apgars.com';
        $this->_defaultEmailName    = 'The Apgars Team';

        $this->_protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';

        //if already have org
        $org = $this->session->userdata('has_organization');
        
        if(isset($org)) {
            $this->_organization = $org;
        } 
	}

    /* Public Properties
    -------------------------------*/

    /* Constructor
    -------------------------------*/

    /* Public Function
    -------------------------------*/

    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/ 
   
}