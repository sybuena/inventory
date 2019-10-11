<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
    
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
        
        if($this->login->status() != 'login') {
            
            redirect($this->login->status());
        }

    }

    /* Public Function
    -------------------------------*/
    public function index() {
        
        // Load the list of assets from the config then add it on page
        $data['js']  = $this->_loginJs;
        $data['css'] = $this->_loginCss;

        //default
        $data['disabled'] = '';
        $data['userId']   = '';
        $data['nonce']    = '';
        $data['login']    = '';
        $data['register'] = '';
        $data['forgot']   = '';
        $data['redirect'] = false;
        $data['expired']  = 'hide';
        
        //if coming from create account
        if(isset($_GET['id']) && isset($_GET['nonce'])) {
            //check nonce and id is expired  
            //if expired          
            if($this->nonce->isExired($_GET['nonce'])) {
                //show expired message
                $data['expired'] = '';
            } else {
                //get the user detail
                $data['user']       = $this->user->detail($_GET['id'], array('first_name', 'last_name', 'username'));
                $data['disabled']   = 'disabled';
                $data['userId']     = $_GET['id'];
                $data['nonce']      = $_GET['nonce'];
            }
        }   

        if(isset($_GET['id']) && (isset($_GET['action']) && $_GET['action'] == 'login') ) {
            $user = $this->user->detail($_GET['id'], array('first_name', 'last_name', 'username'));

            $data['username'] = $user['username'];
            $data['redirect'] = true;
        }

        $data[isset($_GET['action']) ? $_GET['action'] : 'login'] = 'toggled';
       // exit;
        $this->load->view('login/main', $data);
    }

    /**
     * Activate account with nonce, 
     * if nonce is used once, then it will be expired
     * 
     * @param string
     * @param string
     * @return html
     */
    public function confirmAccount($nonce, $userId) {

        $data['error']   = '';
        $data['success'] = '';

        //check if nonce is expired
        //if nonce is expired
        if($this->nonce->isExired($nonce)) {
            $data['success'] = 'hide';
        //else, we no proceed
        } else {
            $data['error'] = 'hide';
            //mark nonce as expired
            $this->nonce->markExpired($nonce);
            //now update the account as active
            $this->user->markActive($userId);
        }

        $data['js']  = $this->_loginJs;
        $data['css'] = $this->_loginCss;
        
        $this->load->view('login/confirm_account', $data);

    }

    /**
     * Login user
     * 
     * @return json
     */
    public function login() {
        $username = isset($_POST['username']) ? $_POST['username'] : 'no_username';
        $password = isset($_POST['password']) ? $_POST['password'] : 'no_password';
        
        //if there is recaptcha
        if(isset($_POST['recaptcha']) && !empty($_POST['recaptcha'])) {
            //verify if code is correct
            $response = $this->recaptcha->verifyResponse($_POST['recaptcha']);
            //if recaptchat is correct
            if($response['success']) {
                //we remove the lock
                $this->login->removeAttempt($username);
            }
        }

        //check for login attempt
        if($this->login->attempt($username) > 3) {
            //show recaptcha
            return $this->_returnError('login_attempt');
        }

        $user = $this->login->in($username, $password);
        
        //else we found something        
        if(!empty($user)) {
            //if user account is not yet activated
            if(!$user['active']) {
                return $this->_returnError('pending_user', 'This account is still in <b>Pending Status</b>');
            }

            //else account is lock
            if(isset($user['login_attempt']) && $user['login_attempt'] > 3) {
                //show recaptcha
                return $this->_returnError('login_attempt');
            }

            //save session as login, but no selected org
            $this->login
                ->saveLogin($user)
                ->resetAttempt($user)
                ->loginActivity($user);
            
            //check we checl how many organization this user has
            //if only one, then will will not go to portal
            if(count($user['organization']) == 1) {

                $organization = $this->organization->detail2($user['organization'][0]['id']);
                
                if(!empty($organization)) {
                    //then save to session
                    $this->login->savePortal($organization);   
                }
            }


            return $this->_returnSuccess('user_found');

        //else no user found    
        } else {
            return $this->_returnError('no_user_found', 'Your Username or Password is incorrect');
        }

    }

    public function createNow() {

        $data = array(
            'username'      => 'sy@apgars.com',
            'password'      => md5('passsword'),
            'first_name'    => 'Sy',
            'last_name'     => 'Buena',
            'name'          => 'Sy Buena',
            'date_created'  => strtotime('now'),
            'date_updated'  => strtotime('now'),
            'status'        => 1,
            //mark as pending user, need confirmation
            'active'        => 1
        );

        //add user
        $this->cimongo->insert(MY_Model::USERS_TABLE, $data);
    }

    /**
     * Register (not yet done, not sure of needed)
     *
     * @return json
     */
    public function register() {

        parent::post();

        //check if
        //1 .) from create account, no user id
        //2 .) from user invitation
        
        //must be create account
        if(empty($_POST['user_id'])) {

            //check if email is already register
            $isExist = $this->register->hasAccount($_POST['username']);
            //if username is already register
            if(!empty($isExist)) {
                return $this->_returnError('already_register', 'Email Adress is already register');

            } else {
                //create new account
                $this->user->create($_POST);
                //return success
                return $this->_returnSuccess(
                    'An email has been sent to you with detailed instructions on how to activate it'
                );
            }

        //else from user invitation
        } else {
            //update user information and mark nonce as expired
            $this->user->updateCreateAccount($_POST);

            return $this->_returnSuccess('');
        }
    }
    
    /**
     * Send email notification to email address
     * to reset password
     * 
     * @return json
     */
    public function forgotPassword() {

        if(!isset($_POST['email'])) {
            return $this->_returnError('no_email_found');
        }

        return $this->_returnSuccess();
    }

    public function send() {

        $this->email
            ->from('sybuena@gmail.com', 'Assasin')
            ->to('sybuena2@gmail.com')
            ->subject('Youre Next')
            ->message('HIDE NOW!!')
            ->send();
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}