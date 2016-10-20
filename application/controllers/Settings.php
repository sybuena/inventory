<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include(APPPATH.'controllers/Main.php');

class Settings extends MY_Controller {
	
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
        
        if($this->login->status() != 'app' && $this->login->status() != 'setUp') {
            
            redirect($this->login->status());
        }    
    }

    /* Public Function
    -------------------------------*/
	public function index() {
        
        $data['js']         = $this->config->item('settings_js');
        $data['css']        = $this->config->item('settings_css');
        $data['org_name']   = $this->_organization['name'];
        $data['settings']   = 'active';
        $data['user']       = loginData();
        
		$this->load->view('settings', $data);
	}

    /**
     * Get organization member list
     * 
     * @param int
     * @param int
     * @return json
     */
    public function getMember() {
        
        parent::post();

        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';
        $orgId = $this->_organization['_id']->{'$id'};

        //get member list
        $row = $this->organization->getMember($orgId, $_POST['sort'], $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);
    }

    /**
     * Remove User in bathc
     * 
     * @return json
     */
    public function removeMemberBatch() {
        parent::post();
        
        foreach($_POST['list'] as $value) {
            //get user detail
            $user = $this->user->detail($value);
            //now remove organization from the list
            foreach($user['organization'] as $k => $v) {
                //match to the current organizatio 
                if($v['id'] == $this->_organization['_id']->{'$id'}) {
                    unset($user['organization'][$k]);
                    break;
                }
            }

            //unset id to prevent error
            unset($user['_id']);
            
            //now update the user
            $this->user->update($value, $user);
        }

        return $this->_returnSuccess();
    }

    /**
     * Remove the current organization to the user
     * organization listing
     * 
     * @param string
     * @return json
     */
    public function removeMember($userId) {
        //get user detail
        $user = $this->user->detail($userId);
        //now remove organization from the list
        foreach($user['organization'] as $k => $v) {
            //match to the current organizatio 
            if($v['id'] == $this->_organization['_id']->{'$id'}) {
                unset($user['organization'][$k]);
                break;
            }
        }

        //unset id to prevent error
        unset($user['_id']);
        
        //now update the user
        $this->user->update($userId, $user);

        return $this->_returnSuccess();
    }

    /**
     * Add Member add send email notification
     * 
     * @return json
     */
    public function addMember() {
        //no post data
        parent::post();
        
        //check if user is already member
        if($this->organization->checkIfMember($this->_organization['_id']->{'$id'}, $_POST)) {

            return $this->_returnError(
                'already_member', 
                'Email Address is already member of the organization'
            );
        }
        //this will add member and also create user in zendesk
        $row = $this->organization
            ->addMember($this->_organization['_id']->{'$id'}, $_POST);

        return $this->_returnSuccess();
    }

    /**
     * Get organization info
     * 
     * @return json
     */
    public function getOrganizationInfo() {
        //no post data
        parent::post();
        
        $info = $this->organization->organizationInfo($this->_organization['_id']->{'$id'});

        return $this->_returnData($info);
    }

    /**
     * Tin number add / update
     * 
     * @return json
     */
    public function tinNumberUpdate() {
        //no post data
        parent::post();
        
        $this->organization->tinNumber($_POST);

        return $this->_returnSuccess();
    }

    /**
     * Setting conversion date
     * 
     * @return json
     */
    public function setConversionDate() {
        //no post data
        parent::post();
        
        $this->organization->setConversionDate($_POST);

        return $this->_returnSuccess();
    }

    /**
     * Save the rdo code
     * 
     * @return json
     */
    public function saveRdoCode() {
        //no post data
        parent::post();
        
        $this->organization->saveRdoCode($_POST, $this->_organization['_id']->{'$id'});

        return $this->_returnSuccess();
    }

    /**
     * Set-up oraganization done
     * 
     * @return json
     */
    public function setUpOrgDone() {
        //no post data
        parent::post();
        
        $info = $this->organization->setUpOrgDone($this->_organization['_id']->{'$id'});
        $portalStatus = $this->session->userdata('has_organization');
        $portalStatus['set_up'] = 1;

        $this->session->set_userdata('has_organization', $portalStatus); 

        return $this->_returnData($info);
    }

	/* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/
}
