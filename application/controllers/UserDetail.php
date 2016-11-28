<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include(APPPATH.'controllers/Main.php');

class UserDetail extends MY_Controller {
    
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
        

    }

    /* Public Function
    -------------------------------*/
    public function index() {

    }

    /**
     * Load the data of the user
     * 
     * @param  id
     * @return json
     */
    public function info($id) {

        $data['js']  = $this->config->item('userDetail_js');
        $data['css'] = $this->config->item('userDetail_css');

        $data['user'] = loginData();
        $data['settings']   = 'active';
        $data['org_name']   = $this->_organization['name'];
        
        $data['info'] = $this->user->userInfo($id);
        $data['id']   = $id;
        if(!isset($data['info']['image']) || empty($data['info']['image'])) {
            $data['info']['image'] = getImage($data['info']);
        } else {
            $data['info']['image'] = '/'.$data['info']['image'];
        }

        $this->load->view('settings/userDetail', $data);

    }
    /**
     * Get user info type
     * 
     * @return json
     */
    public function userType() {

        $org  = $this->session->userdata('has_organization');
        $user = $this->session->userdata('has_login'); 
        $type = 0;

        $orgId = $org['_id']->{'$id'};

        foreach ($user['organization'] as $key => $value) {

            if($value['id'] == $orgId) {
                $type = $value['role'];
            }
        }

        return $this->_returnData(
            array('role' => $type)
            );

    }

    /**
     * Change user profile image
     * 
     * @param string
     * @return this
     */
    public function changePhoto($id) {
        
        //create path
        $targetPath = 'assets/uploads/users/'.$id.'/primary_img/';

        //if no directory yet
        if (!is_dir($targetPath)) {
            //we create
            mkdir($targetPath, 0777, true);
        }

        $targetPath = $targetPath.$_FILES[0]['name'];
        //now move the files
        $success = move_uploaded_file($_FILES[0]['tmp_name'], $targetPath);

        if($success) {
            //update user
            $update = array('image' => $targetPath);
            //update user for the new image path
            $this->user->update($id, $update);
        }
        //if we are changing the login user profile image
        if($id == loginId()) {
            $data = array(
                'path'      => $targetPath,
                'is_login'  => true
            );
            
            //now update the session data
            //update the login user session
            $user = $this->user->detail($id);

            $this->session->set_userdata('has_login', $user);

        } else {
            $data = array(
                'path'      => $targetPath,
                'is_login'  => false
            );
        }   

        return $this->_returnData($data);
    }

    /**
     * Get the basic information
     * 
     * @param  id
     * @return json
     */
    public function getBasicInformation($id) {

        $select = array('first_name', 'last_name', 'organization');

        $info = $this->user->userInfo($id, $select);

        return $this->_returnData($info);

    }

    /**
     * Get the Contact information
     * 
     * @param  id
     * @return json
     */
    public function getContactInformation($id) {

        $select = array('username', 'mobile', 'phone', 'facebook', 'twitter', 'skype', 'organization', 'name');

        $info = $this->user->userInfo($id, $select);

        return $this->_returnData($info);

    }

    /**
     * Save the edit of Basic information
     * 
     * @param  id
     * @return json
     */
    public function saveBasicInformation($id) {

        $data = $_POST;

        $this->user->saveInfo($id, $data, 1);

        return $this->_returnSuccess();

    }


    /**
     * Save the edit of Basic information
     * 
     * @param  id
     * @return json
     */
    public function saveContactInformation($id) {

        $data = $_POST;

        $this->user->saveInfo($id, $data);

        return $this->_returnSuccess();

    }

    public function userActivity($id) {
        
        parent::post();

        $offset = (isset($_POST['current'])) ? $_POST['current'] : parent::OFFSET;
        $limit  = (isset($_POST['rowCount'])) ? $_POST['rowCount'] : parent::LIMIT;
        $search = (isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])) ? $_POST['searchPhrase'] : '';

        //get member list
        $row = $this->user->getUserActivity($id, $_POST['sort'], $search, $offset, $limit);

        $row['current']  = (int)$offset;
        $row['rowCount'] = (int)$limit;

        //return json
        return $this->_returnRaw($row);
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/
    public function email() {


        $this->email->from('anjotamondong@gmail.com', 'Your Name');
        $this->email->to('anjotamondong@gmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();

    }

}
