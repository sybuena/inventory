<?php //-->

class MY_Controller extends CI_Controller {

	/* Constants
    -------------------------------*/
    const ORGANIZATION = 'organization';
    const TAXRATES     = 'tax_rates';
    const OFFSET = '0';
    const LIMIT = '10';
    
    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/
    protected $_loginCss    = array();
    protected $_loginJs     = array();
    protected $_landingCss  = array();
    protected $_landingJs   = array();
    protected $_digongCss   = array();
    protected $_digongJs    = array();
    protected $_organization = array();
    protected $_orgInfo      = array();
    
    /* Private Properties
    -------------------------------*/

    /* Constructor
    -------------------------------*/
    public function __construct() {

     
        date_default_timezone_set('Asia/Manila');

		parent::__construct();
        
        $this->load->helper('super');
        
        // Get the Assets from Config
        $this->_loginCss   = $this->config->item('login_css');
        $this->_loginJs    = $this->config->item('login_js');
        
        $this->_landingCss = $this->config->item('landing_css');
        $this->_landingJs  = $this->config->item('landing_js');

        $this->_digongCss  = $this->config->item('digong_css');
        $this->_digongJs   = $this->config->item('digong_js');
        
        $this->_accountSettingsCss  = $this->config->item('accountSettings_css');
        $this->_accountSettingsJs   = $this->config->item('accountSettings_js');

        $this->_reportCss  = $this->config->item('report_css');
        $this->_reportJs   = $this->config->item('report_js');

        //if already have org
        $org = $this->session->userdata('has_organization');
        
        if(isset($org)) {
            $this->_organization = $org;
        } 
        
	}

	/* Public Function
    -------------------------------*/
   	public function index() {

   		
   	}

    public function post() {
        if(!isset($_POST) || empty($_POST)) {
            $this->_returnError('no_post_data');    
            exit;        
        }

    }
    
    /* Protected Function
    -------------------------------*/
    protected function _returnRaw($data) {

        echo json_encode($data);
        
        exit;
    }

    protected function _returnData($data) {

        echo json_encode(array(
            'error' => 0,
            'data' => $data
        ));
        
        exit;
    }

    protected function _returnSuccess($message = null) {

        if(is_null($message)) {
            $message = 'Success';
        }

        echo json_encode(array(
            'error' => 0,
            'message' => $message
        ));
        
        exit;
    }

    protected function _returnError($message = null, $longMessage = 'n/a'){

        if(is_null($message)) {
            $message = 'Error';
        }

        echo json_encode(array(
            'error' => 1,
            'message' => $message,
            'long_message' => $longMessage
        ));

        exit;
    }


    /* Private Function
    -------------------------------*/
}