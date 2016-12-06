<?php //-->

class Organization_model extends MY_Model {

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
    public function save($data) {

        // git the user info
        $user   = $this->session->userdata('has_login');
        $userId = $user['_id']->{'$id'};
        $newOrg = array();
        $newOrganization = array();

        // Info for the organization
        $data['user_id']       = $userId;
        $data['date_created']  = time();
        $data['status']        = 1;
        $data['created_by']    = $userId;

        // insert the organization
        $this->cimongo->insert(self::ORGANIZATION, $data);

        $id = $this->cimongo->insert_id();

        // Now add the org in the user listing
        $userOrg = $this->user->detail($userId);

        //main organization
        $newOrganization[] = array(
            'id'    => $id->{'$id'},
            'role'  => 1,
            'owner' => 1
        );

        // if not empty loop the orgs then add it on the list
        if(!empty($userOrg['organization'])) {
            // merge the old org/s and the new one
            $newOrg = array_merge($newOrganization, $userOrg['organization']);
            // Update the user organization
            $this->user->update($userId, array('organization' => $newOrg));
        } else {
            //Add new single org
            $this->user->update($userId, array('organization' => $newOrganization));
        }

        return $this;
    }
    
    public function update($data) {

        $where = array('_id' => new MongoId(loginOrg()));
        
        return $this->cimongo
            ->where($where)
            ->update(self::ORGANIZATION, $data);
    }

    /**
     * DB call to get user login
     *
     * @param string
     * @param string
     * @return array
     */
    public function detail2($id, $select = array()) {
        $where = array(
            '_id'    => new MongoId($id),
            'status' => 1
        );

        if(empty($select)) {
            return $this->cimongo
                ->get_where(self::ORGANIZATION, $where)
                ->row_array();
        } else {
            return $this->cimongo
                ->select($select)
                ->get_where(self::ORGANIZATION, $where)
                ->row_array();
        }
    }

    /**
     * DB call to get user login
     *
     * @param string
     * @param string
     * @return array
     */
    public function detail($muid, $select = array()) {
        $where = array(
            'xero_org_muid' => $muid,
            'status'        => 1
        );

        if(empty($select)) {
            return $this->cimongo
                ->get_where(self::ORGANIZATION, $where)
                ->row_array();
        } else {
            return $this->cimongo
                ->select($select)
                ->get_where(self::ORGANIZATION, $where)
                ->row_array();
        }
    }

    public function isExisting($muid) {
        //get the org list of current user
        $user = $this->user->detail(loginId());
        
        foreach($user['organization'] as $v) {
            //get org detail
            $where = array('_id' => new MongoId($v['id']));
            $check = $this->cimongo
                ->get_where(self::ORGANIZATION, $where)
                ->row_array();
            //and check MUID 
            if($check['xero_org_muid'] == $muid) {
                return $check;
                break;
            }

        }

        return false;
    }

    /**
     * Get user organization listing
     *
     * @param string
     * @return array
     */
    public function getList($id) {
        $list = array();
        $row = $this->user->detail($id);
        
        if(!empty($row['organization'])) {
            
            foreach($row['organization'] as $v) {
                $where = array(
                    '_id' => new MongoId($v['id']),
                    'status'  => 1
                );

                $orgData = $this->cimongo
                    ->get_where(self::ORGANIZATION, $where)
                    ->row_array();
                if(!empty($orgData)) {
                    $list[] = $orgData;
                }
            }
        } 

        return $list;
    }

    /**
     * Add member to the organization
     *
     * @param stirng
     * @param string
     * @return bool
     */
    public function addMember($orgId, $data) {

        //check first if this user has already have account in system
        $check = $this->cimongo
            ->select(array('_id', 'organization'))
            ->get_where(self::USERS_TABLE, array('username' => $data['username']))
            ->row_array();

        //main organization
        $newOrganization = array(
            'id'   => $orgId,
            'role' => $data['role'],
            'main' => 0
        );

        //if empty, means not yet created
        if(empty($check)) {
            //pass this, we need it later
            $role = $data['role'];
            //now we need to create user first
            $data = array(
                'username'      => $data['username'],
                'password'      => md5('password'), //default
                'first_name'    => $data['first_name'],
                'last_name'     => $data['last_name'],
                'name'          => $data['first_name'].' '.$data['last_name'],
                'date_created'  => strtotime('now'),
                'date_updated'  => strtotime('now'),
                'status'        => 1,
                //mark as pending user, need confirmation
                'active'        => 0,
                //organization listing
                'organization' => array($newOrganization)
            );

            //add user
            $this->cimongo->insert(self::USERS_TABLE, $data);

            //get insert id
            $object = $this->cimongo->insert_id();
            $userId = $object->{'$id'};
            
            //send email as create account
            $this->sendInvitation($data, $orgId, $userId, 1);

            //sync this user to zendesk
            //get the zendesk user id
            //add update again the user to insert zendesk user id
            //we need that id to assigning ticket
            $this->zendesk->createUser($data, $role, $userId);

        //else user alread have account
        } else {
            //get user id
            $userId = $check['_id']->{'$id'};
            //and update the user for the current organization
            $check['organization'][] = $newOrganization;
            //unset
            unset($check['_id']);

            $this->cimongo
                ->where(array('_id' => new MongoId($userId)))
                ->update(self::USERS_TABLE, $check);
            //send email as invitation 
            $this->sendInvitation($data, $orgId,$userId, 2);
        }

        return $this;
    }

    /**
     * Check if email address is already member of the current organizatin
     * 
     * @param string
     * @param array
     * @return bool
     */
    public function checkIfMember($orgId, $data) {
        
        $where = array(
            'username'       => $data['username'],
            'status'         => 1,
            'organization'   => array(
                '$elemMatch' => array('id' => $orgId)
            )
        );

        $row = $this->cimongo
            ->get_where(self::USERS_TABLE, $where)
            ->row_array();

        return empty($row) ? false : true;
    }

    /**
     * Get member of the organization
     * 
     * @param string
     * @param string
     * @param int
     * @param int
     * @return array
     */
    public function getMember($orgId, $order, $search, $offset, $limit) {
        $where = array(
            'status'       => 1,
            'organization' => array(
                '$elemMatch' => array('id' => $orgId)
            )
        );
        //search query
        if(!empty($search)) {
            $query = urldecode($search);
            
            $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['username'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['first_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['last_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        }
        
        $list = $this->cimongo
            ->order_by($order)
            ->get_where(self::USERS_TABLE, $where, $limit, ((int)$offset - 1))
            ->result_array();

        foreach($list as $k => $v) {
            //unset this shit
            unset($list[$k]['status']);
            //default
            $list[$k]['active'] = $v['active'] ? 'Active' : 'Pending';
            $list[$k]['id'] = $v['_id']->{'$id'};
            foreach($v['organization'] as $val) {
                if($val['id'] == $orgId) {
                    $list[$k]['role'] = ($val['role'] == 1) ? 'Administrator' : 'Accountant';
                }
            }
            //get last login in login table
            $lastLogin = $this->cimongo
                ->order_by(array('login_date' => 'DESC'))
                ->get_where(self::LOGIN_ACTIVITY, array('login_user' => $v['_id']->{'$id'}))
                ->row_array();
            
            if(!empty($lastLogin)) {
                $list[$k]['last_login'] = $lastLogin['login_date'];
            }
        }

        $row['rows'] = $list;
        
        $row['total'] = $this->cimongo
            ->where($where)
            ->count_all_results(self::USERS_TABLE);

        return $row;        
    }

    /**
     * Get info of the organization
     * 
     * @param id
     * @return array
     */
    public function organizationInfo($id) {

        $info = $this->cimongo
            ->get_where(self::ORGANIZATION, array(
                '_id' => new MongoId($id)))
            ->row_array();

        // This is for the Tax Basis
        $taxBasis      = $info['organisation_info']['Organisations']['Organisation']['SalesTaxBasis'];
        $taxBasisValue = '';

        if($taxBasis == 'CASH') {
            $taxBasisValue = 'Cash Basis';
        } else if($taxBasis == 'ACCRUALS') {
            $taxBasisValue = 'Accruals Basis';
        }

        // This is for Tax Periods
        $taxPeriod      = $info['organisation_info']['Organisations']['Organisation']['SalesTaxPeriod'];
        $taxPeriodValue = '';

        if($taxPeriod == '1MONTHLY') {
            $taxPeriodValue = 'Monthly';
        } else if($taxPeriod == '2MONTHLY') {
            $taxPeriodValue = '2 Monthly';
        } else if($taxPeriod == '3MONTHLY') {
            $taxPeriodValue = '3 Monthly';
        } else if($taxPeriod == '6MONTHLY') {
            $taxPeriodValue = '6 Monthly';
        } else if($taxPeriod == 'ANNUALLY') {
            $taxPeriodValue = 'Anually';
        }

        $info['tax_info']['taxBasis']  = $taxBasisValue;
        $info['tax_info']['taxPeriod'] = $taxPeriodValue;


        return $info;

    }

    /**
     * Resync the organization info
     * 
     * @param id
     * @return array
     */
    public function resyncOrganizationInfo($data, $id) {

        $this->cimongo
            ->where(array('_id' => new MongoId($id)))
            ->update(self::ORGANIZATION,array(
                'organisation_info' => $data)); 

        return;

    }

    /**
     * Get info of the organization
     * 
     * @param id
     * @return array
     */
    public function changePassword($id, $data) {

        $return = array();

        $info = $this->cimongo
            ->select(array('password'))
            ->get_where(self::USERS_TABLE, array(
                '_id' => new MongoId($id)))
            ->row_array();

        // If pasword matched
        if(md5($data['current-password']) == $info['password']) {
            $this->cimongo
                ->where(array('_id' => new MongoId($id)))
                ->update(self::USERS_TABLE, array(
                    'password' => md5($data['new-password'])));
        } else {
            $return = 'error';
        }

        return $return;

    }

    /**
     * Update the tin number
     * 
     * @param data
     */
    public function tinNumber($data) {

        $this->cimongo
            ->where(array('_id' => new MongoId($data['id'])))
            ->update('organization', array(
                'tin_number' => $data['tin']));

        return;

    }

    /**
     * Update the conversion date
     * 
     * @param data
     */
    public function setConversionDate($data) {

        $this->cimongo
            ->where(array('_id' => new MongoId($data['id'])))
            ->update('organization', array(
                'conversion_date' => $data['date']));

        return;

    }

    /**
     * Saving RDO Code
     * 
     * @param data
     */
    public function saveRdoCode($data, $id) {

        $this->cimongo
            ->where(array('_id' => new MongoId($id)))
            ->update('organization', array(
                'rdo_code' => $data['code']));

        return;

    }

    /**
     * Set-up organization to done
     * 
     * @param data
     */
    public function setUpOrgDone($id) {

        $this->cimongo
            ->where(array('_id' => new MongoId($id)))
            ->update('organization', array(
                'set_up' => 1));

        return;
    }
    
    /* Protected Function
    -------------------------------*/
    protected function sendInvitation($data, $orgId, $userId, $type = 1) {
        //get org name
        $orgInfo = $this->cimongo
            ->get_where(self::ORGANIZATION, array('_id' => new MongoId($orgId)))
            ->row_array();
        
        $orgName = $orgInfo['organisation_info']['Organisations']['Organisation']['LegalName'];

        //CREATE ACCOUNT
        if($type == 1) {
            //create nonce and save it to database
            $nonce = $this->nonce->create($userId, 1);
            
            $row = array(
                'name' => $data['first_name'].' '.$data['last_name'],
                'org'  => $orgName,
                'link' => $this->_protocol.$_SERVER['HTTP_HOST'].'/login/?action=register&id='.$userId.'&nonce='.$nonce
            );

            //EMAIL CONTENT
            $html    = $this->load->view('emails/createAccount', $row, TRUE); 
            $subject = 'Invitation to Access Organization';

        } else {
            //send invitation 
            //now we need to send email invitation
            $row = array(
                'name' => $data['first_name'].' '.$data['last_name'],
                'org'  => $orgName,
                'link' => $this->_protocol.$_SERVER['HTTP_HOST'].'/login?action=login&id='.$userId
            );

            //EMAIL CONTENT
            $html    = $this->load->view('emails/createAccount', $row, TRUE); 
            $subject = 'Invitation to Access Organization';
        }
        
        //now we need to send email confirnation to the user
        return $this->email
            ->from($this->_defaultEmail, $this->_defaultEmailName)
            ->to($data['username'])
            ->subject($subject)
            ->message($html)
            ->send();
    }
   
    /* Private Function
    -------------------------------*/
}