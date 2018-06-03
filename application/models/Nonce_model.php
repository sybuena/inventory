<?php //-->

class Nonce_model extends MY_Model {

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
     * Create nonce to be used for link verification
     *
     * @param string
     * @param bool
     * @return string
     */
    public function create($id  = 'x', $storeNonce = 0) {
        //Identify Request //(either by username, session, or something)
        $nonce = hash('sha512', $this->makeRandomString());
        
        if($storeNonce) { 
	       	///now store nonce 
	       	$this->storeNonce($nonce, $id);
       	}

        return $nonce;
    }

    /**
     * Check if nonce is expired
     *
     * @param string
     * @return bool
     */
    public function isExired($nonce) {
    	$where = array('nonce' => $nonce);	

    	$row = $this->cimongo
    		->get_where(self::NONCE, $where)
    		->row_array();

    	return (!empty($row)) ? $row['expired'] : false;
    }
    
    /**
     * Mark nonce as expired
     *
     * @param string
     * @return bool
     */
    public function markExpired($nonce) {
    	$where  = array('nonce' => $nonce);	
    	$update = array(
    		'expired' 	   => 1, 
    		'date_updated' => strtotime('now')
    	);

    	return $this->cimongo
    		->where($where)
    		->update(self::NONCE, $update);
    }

    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
    private function storeNonce($nonce, $userId) {
    	$data = array(
    		'nonce_user'   => $userId,
    		'nonce'		   => $nonce,
    		'status'	   => 1,
    		'expired'	   => 0,
    		'date_created' => strtotime('now')
    	);

    	return $this->cimongo->insert(self::NONCE, $data);
    }

    private function makeRandomString($bits = 256) {
        $bytes = ceil($bits / 8);
        $return = '';
        for ($i = 0; $i < $bytes; $i++) {
            $return .= chr(mt_rand(0, 255));
        }
        return $return;
    }
}