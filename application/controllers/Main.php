<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
    
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
        
        if($this->login->status() == 'login') {
            redirect($this->login->status());
        }
    }

    /* Public Function
    -------------------------------*/
    public function index() {
       redirect('login');
    }

    /**
     * Logout user
     * 
     * @param  bool
     * @return this
     */
    public function logout($hard = 1) {
        //logout now
        $this->login->out($hard);

        if($hard) {
            redirect('login');
        } else {
            redirect('portal');
        }

        return $this;
    } 


    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
