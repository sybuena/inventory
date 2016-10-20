<?php //-->

class Login_model extends MY_Model {

    /* Constants
    -------------------------------*/
    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/

    /* Private Properties
    -------------------------------*/

    /* Public Properties
    -------------------------------*/

    /* Constructor
    -------------------------------*/
    public function __construct() {

        parent::__construct();
    }

    /* Public Function
    -------------------------------*/
    public function resetAttempt($user) {
        $where  = array('_id'    => $user['_id']);
        $update = array('login_attempt' => 0);
            
        $this->cimongo
            ->where($where)
            ->update(self::USERS_TABLE, $update);

        return $this;
    }

    public function removeAttempt($username) {
        $where = array(
            'username' => $username,
            'status'   => 1
        );

        $update = array('login_attempt' => 0);
            
        $this->cimongo
            ->where($where)
            ->update(self::USERS_TABLE, $update);

        return $this;
    }

    public function attempt($username) {
        $count = 0;

        $where = array(
            'username' => $username,
            'status'   => 1
        );

        //get current user
        $user = $this->cimongo
            ->select(array('login_attempt'))
            ->get_where(self::USERS_TABLE, $where)
            ->row_array();
        
        //if we found user
        if(!empty($user)) {
            $attempt = isset($user['login_attempt']) ? $user['login_attempt'] : 0;
            $count   = ($attempt + 1);
            
            $update = array(
                'login_attempt' => $count
            );
            
            $this->cimongo
                ->where($where)
                ->update(self::USERS_TABLE, $update);
        }
        
        return $count;
    }

    /**
     * DB call to get user login
     *
     * @param string
     * @param string
     * @return array
     */
    public function in($username, $password) {
        $where = array(
            'username' => $username,
            'password' => md5($password)
        );
        
        return $this->cimongo
            ->get_where(self::USERS_TABLE, $where)
            ->row_array();
    }

    /**
     * Save from login page, save session
     *
     * @param array
     * @return bool
     */
    public function saveLogin($user) {

        $this->session->set_userdata('has_login', $user);

        return $this;
    }

    /**
     * Save from organization page, save session
     *
     * @param array
     * @return bool
     */
    public function savePortal($organization) {
        
        return $this->session->set_userdata('has_organization', $organization);
    }

    public function loginActivity($user) {
        
        $info = getBrowser();
        $data = array(
            'login_user'       => $user['_id']->{'$id'},
            'action'           => 'login',
            'status'           => 1,
            'login_date'       => strtotime('now'),
            'ip_address'       => getIpAddress(),
            'browser'          => $info['name'],
            'browser_version'  => $info['version'],
            'userAgent'        => $info['userAgent']
        );

        return $this->cimongo->insert(self::LOGIN_ACTIVITY, $data);
    }

    /**
     * Unset session
     *
     * @param int
     * @return bool
     */
    public function out($hard) {

        //if soft logout, only remove organization
        $this->session->unset_userdata('has_organization');
        //if hard logout, include the user session
        if($hard) $this->session->unset_userdata('has_login');

        return $this;
    }

    /**
     * Check if there is login user
     * 
     * @return string
     */
    public function status() {
        $loginStatus  = $this->session->userdata('has_login');
        $portalStatus = $this->session->userdata('has_organization');


        //if login and no selected organization
        if($loginStatus && !$portalStatus) {
            return 'portal';
        }
        
        //if login and has organization
        if($loginStatus && $portalStatus) {
            return 'app';            
        } 

        return 'login';
    }
    
    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
}