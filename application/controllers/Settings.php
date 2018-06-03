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
        
        if($this->login->status() != 'app') {
            
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

    public function getNumber($type = 'invoice') {
        //$this->settings->updateNextNumber($type);

        return $this->_returnData(array('number' => $this->settings->nextNumber($type)));
    }

    /**
     * Update invoice, purchase order, quotation number
     * 
     * @return json
     */
    public function updateSequence() {
        
        parent::post();

        $_POST['date_updated'] = strtotime('now');
        $_POST['updated_by'] = loginId();

        $_POST['invoice']['digit'] = strlen($_POST['invoice']['sequence']);
        $_POST['invoice']['next'] = +$_POST['invoice']['sequence'];

        $_POST['purchase_order']['digit'] = strlen($_POST['purchase_order']['sequence']);
        $_POST['purchase_order']['next'] = +$_POST['purchase_order']['sequence'];

        $_POST['quotation']['digit'] = strlen($_POST['quotation']['sequence']);
        $_POST['quotation']['next'] = +$_POST['quotation']['sequence'];

        $_POST['job_order']['digit'] = strlen($_POST['job_order']['sequence']);
        $_POST['job_order']['next'] = +$_POST['job_order']['sequence'];
        
        unset($_POST['invoice']['sequence']);
        unset($_POST['purchase_order']['sequence']);
        unset($_POST['quotation']['sequence']);
        unset($_POST['job_order']['sequence']);

        $this->settings->update($_POST);
        
        return $this->_returnSuccess();
    }

    /**
     * Get general setting for financial information
     * 
     * @return json
     */
    public function general() {
           
        $data =$this->settings->getAllSequence();
        //format number
        $data['invoice']['next'] = 
            sprintf('%0'.$data['invoice']['digit'].'d', $data['invoice']['next']);
        $data['purchase_order']['next'] = sprintf('%0'.$data['purchase_order']['digit'].'d', $data['purchase_order']['next']);
        $data['quotation']['next'] = 
            sprintf('%0'.$data['quotation']['digit'].'d', $data['quotation']['next']);
        $data['job_order']['next'] = 
            sprintf('%0'.$data['job_order']['digit'].'d', $data['job_order']['next']);
            
        return $this->_returnData($data);
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

        //get member list
        $row = $this->organization->getMember($_POST['sort'], $search, $offset, $limit);

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
        if($this->organization->checkIfMember(loginOrg(), $_POST)) {

            return $this->_returnError(
                'already_member', 
                'Email Address is already member of the organization'
            );
        }
        
        $row = $this->organization->addMember($_POST);

        return $this->_returnSuccess();
    }

    public function updateOrg() {
        parent::post();
        $_POST['updated_by']   = loginId();
        $_POST['updated_date'] = strtotime('now');

        $this->organization->update($_POST);

        return $this->_returnSuccess();
    }

    public function getCurrentOrg() {

        $info = $this->organization->detail2(loginOrg());
        //pre($info);exit;
        return $this->_returnData($info);
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
