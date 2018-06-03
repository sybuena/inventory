<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google extends MY_Controller {
    
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
        
        $this->_google = array(
            'key' => '872675838288-7corbmaj3lsj7crcskl7mrvsgqnu5erb.apps.googleusercontent.com',
            'secret' =>'DVIsI6gSLF3sd3EkTATxiQ0D',
            'url'   => 'http://crm-tenelleven.com/integration/google/callback'
        );
    }

    /* Public Function
    -------------------------------*/
    public function index() {
       
        $imap = eden('mail')->imap('imap.googlemail.com', 'sy@tenelleven.com', 'W@lkingd3@d2', 993, false);
        $mailboxes = $imap->getMailboxes(); 
        pre($mailboxes);
    }

    public function callback() {
        pre($_GET);exit;
    }

    public function webhook() {
        $body = json_decode(file_get_contents('php://input'), true);
        $data['body'] = $body;
        $data['date'] = strtotime('now');
        $this->cimongo->insert('test_hook', $data);
    }

    public function check() {
        $row = $this->cimongo
            ->get_where('test_hook')
            ->result_array();
        pre($row);
    }

    public function webhook2() {
        $body = json_decode(file_get_contents('php://input'), true);
        $data['body'] = $body;
        $data['date'] = strtotime('now');
        $this->cimongo->insert('test_hook2', $data);
    }    

    public function check2() {
        $row = $this->cimongo
            ->get_where('test_hook2')
            ->result_array();
        pre($row);
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/
}
