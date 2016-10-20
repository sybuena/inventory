<?php //-->

class Register_model extends MY_Model {

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
    /**
     * DB call to get user login
     *
     * @param string
     * @param string
     * @return array
     */
    public function hasAccount($username) {
        $where = array('username' => $username);
        
        return $this->cimongo
            ->get_where(self::USERS_TABLE, $where)
            ->row_array();
    }

    
    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
}