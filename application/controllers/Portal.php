<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends MY_Controller {
	
	/* Constants
    -------------------------------*/

    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/
    public function __construct() {

        parent::__construct();
    
        if($this->login->status() != 'portal') {

            redirect($this->login->status());
        }

    }

    /* Private Properties
    -------------------------------*/

    /* Constructor
    -------------------------------*/

    /* Public Function
    -------------------------------*/
	public function index() {
        $data['js']  = $this->_landingJs;
        $data['css'] = $this->_landingCss;

		$this->load->view('landing', $data);
	}

    /**
     * Get the selected organization and save info to session
     * 
     * @return json
     */
    public function login() {
        
        if(!isset($_POST['id'])) {
            return $this->_returnError('no_id_found');
        }

        $id = $_POST['id'];

        //get detail of organization
        $organization = $this->organization->detail2($id);

        if(!empty($organization)) {
            //then save to session
            $this->login->savePortal($organization);   
        }

        return $this->_returnSuccess('organization_found');
        
    }

    public function createOrganization() {
        parent::post();

        $this->organization->save($_POST);
    }


    /**
     * Change password of the user
     * 
     * @return json
     */
    public function changePassword() {
        //no post data
        parent::post();
        
        $return = $this->organization->changePassword(loginId(), $_POST);

        if($return == 'error') {
            return $this->_returnError();
        }

        return $this->_returnSuccess();
    }

    /**
     * Organisations list
     * 
     * @return json
     */
    public function organisationList() {

        $user   = $this->session->userdata('has_login');
        $userid = $user['_id']->{'$id'};
        
        $current = $this->user->detail(loginId());
     
        if(!isset($current['organization']) || empty($current['organization'])) {
            //we check if he has current org
            $check = $this->cimongo
                ->get_where(MY_Model::ORGANIZATION, array(
                    'user_id' => loginId(),
                    'status'  => 1
                ))->result_array();

            foreach($check as $v) {
                $update = $this->user->detail(loginId());
                //update organization
                $org = array(
                    'id'    => $v['_id']->{'$id'}, 
                    'role'  => 1,
                    'owner' => 1
                );

                $update['organization'][] = $org;
                $where = array('_id' => new MongoId(loginId()));

                $this->cimongo
                    ->where($where)
                    ->update(MY_Model::USERS_TABLE, $update);
            }
        }

        // $organizations = $this->organization->getList(loginId());
        $organizations = $this->organization->getList($userid);
        
        return $this->_returnData($organizations);

    }

    /**
     * Get the account data
     * 
     * @return json
     */
    public function loadContent() {
        
        parent::post();

        $data = $this->cimongo
            ->get_where('users', array(
                '_id' => new MongoId(loginId())))
            ->row_array();

        return $this->_returnData($data);
        
    }

    /**
     * Delete organization
     * 
     * @return json
     */
    public function deleteOrganisation() {        

        $user   = $this->session->userdata('has_login');
        $userid = $user['_id']->{'$id'};

        $this->xero->deleteOrganisation($_POST['id'], $userid);

        return $this->_returnSuccess();

    }

	/* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/

}
