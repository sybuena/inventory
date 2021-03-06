<?php //-->

class User_model extends MY_Model {

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
    public function search($query, $orgId) {
        $where = array(
            'status' => 1,
            'organization' => array(
                '$elemMatch' => array(
                    'id' => $orgId
                )
            ),
        );

        $query = urldecode($query);
        $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        $where['$or'][]['first_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        $where['$or'][]['last_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        
        $list = $this->cimongo
            ->get_where(self::USERS_TABLE, $where)
            ->result_array();
       
        $data = array();

        foreach($list as $k => $v) {
            if(isset($v['name'])) {
                $data[$k]['text'] = $v['name'];
                $data[$k]['value'] = $v['name'];
                $data[$k]['id'] = $v['_id']->{'$id'};
            } else {    
                $data[$k]['text'] = $v['first_name'].' '.$v['last_name'];
                $data[$k]['value'] = $v['first_name'].' '.$v['last_name'];
                $data[$k]['id'] = $v['_id']->{'$id'};
            }
        }

        return $data;
    }

    /**
     * DB call to get user login
     *
     * @param string
     * @param string
     * @return array
     */
    public function detail($id, $select = array()) {
        $where = array(
            '_id' => new MongoId($id),
            'status' => 1
        );
        if(!empty($select)) {
            return $this->cimongo
                ->select($select)
                ->get_where(self::USERS_TABLE, $where)
                ->row_array();
        } 
        return $this->cimongo
            ->get_where(self::USERS_TABLE, $where)
            ->row_array();
    }

    /**
     * DB call to update user
     * 
     * @param string
     * @param array
     * @return bool
     */
    public function update($id, $updateData) {
        $where = array('_id' => new MongoId($id));

        return $this->cimongo
            ->where($where)
            ->update(self::USERS_TABLE, $updateData);
    }

    /**
     * Get the info of the users
     *
     * @param  id
     * @param  array
     * @return bool
     */
    public function userInfo($id, $select = array(), $orgInclude = null) {

        $role = '';
        $user = $this->cimongo
            ->select($select)
            ->get_where(self::USERS_TABLE, array(
                '_id' => new MongoId($id)))
            ->row_array();
        
        foreach ($user['organization'] as $key => $value) {
            if($value['id'] == loginOrg()) {
                $role = $value['role'];
                if($value['role'] == 1) {
                    $user['role_name'] = 'Administrator';
                    $user['role'] = 1;
                } else if($value['role'] == 2) {
                    $user['role_name'] = 'Accountant';
                    $user['role'] = 2;
                }
            }
        }

        // If unidentified value lets put an empty field
        foreach ($select as $key => $value) {            
            if(!isset($user[$value])) {
                // Put empty string
                $user[$value] = '';
            } 
        }

        if(is_null($orgInclude)) {
            // lets unset the orgs
            unset($user['organization']);            
        }

        return $user;
        
    }
    
    public function saveInfo($id, $data, $basic = null) {

        $info = $this->userInfo($id, array(), 1);

        if(!is_null($basic)) {

            // Change the role of the user based of organization
            foreach ($info['organization'] as $key => $value) {
                if($value['id'] == loginOrg()) {
                    $info['organization'][$key]['role'] = $data['role'];
                }
            }

            // Set the organization
            $data['organization'] = $info['organization'];  
            $data['name'] = $data['first_name'] . ' ' . $data['last_name'];          

        }

        $this->cimongo
            ->where(array(
                '_id' => new MongoId($id)))
            ->update(self::USERS_TABLE, $data);

        return;
        
    }

    /**
     * Mark user as active now, 
     * 
     * @param string
     * @return bool
     */
    public function markActive($userId) {
        $where  = array('_id' => new MongoId($userId));
        $update = array('active' => 1);

        return $this->cimongo
            ->where($where)
            ->update(self::USERS_TABLE, $update);
    }

    /**
     * Create user
     *
     * @param array
     * @return array
     */
    public function create($data) {

        $data = array(
            'username'      => $data['username'],
            'password'      => md5($data['password']),
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'name'          => $data['first_name'].' '.$data['last_name'],
            'date_created'  => strtotime('now'),
            'date_updated'  => strtotime('now'),
            'status'        => 1,
            //mark as pending user, need confirmation
            'active'        => 0
        );

        //add user
        $this->cimongo->insert(self::USERS_TABLE, $data);

        //get insert id
        $object = $this->cimongo->insert_id();
        $userId = $object->{'$id'};
        
        //create nonce and save it to database
        $nonce = $this->nonce->create($userId, 1);
        
        //now we create link
        $link = $this->_protocol.$_SERVER['HTTP_HOST'].'/login/confirmAccount/'.$nonce.'/'.$userId;

        $html = '<a href="'.$link.'">CLICK HERE<a> BITCH';

        //now we need to send email confirnation to the user
        $this->email
            ->from($this->_defaultEmail, $this->_defaultEmailName)
            ->to($data['username'])
            ->subject('Confirmation Instructions')
            ->message($html)
            ->send();
    }

    /**
     * Update create account from user invitation
     *
     * @param array
     * @return bool
     */
    public function updateCreateAccount($data) {

        $row = array(
            'password'      => md5($data['password']),
            'date_updated'  => strtotime('now'),
            'active'        => 1
        );
        //where statement for update
        $where = array('_id' => new MongoId($data['user_id']));
        //now mark the nonce as expired
        $this->nonce->markExpired($data['nonce']);
        //now update user with password and mark active
        return $this->cimongo
            ->where($where)
            ->update(self::USERS_TABLE, $row);
    }
    
    /**
     * Get user activity
     * 
     * @param string
     * @param string
     * @param int
     * @param int
     * @return array
     */
    public function getUserActivity($id, $order, $search, $offset, $limit) {

        $where = array('login_user' => $id);

        //search query
        if(!empty($search)) {
            $query = urldecode($search);
            $where['$or'][]['action'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['browser'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['ip_address'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));

        }
        
        $row['rows'] = $this->cimongo
            ->order_by($order)
            ->select(array('login_date', 'ip_address', 'browser'))
            ->get_where(self::LOGIN_ACTIVITY, $where, $limit, ((int)$offset - 1) * 10)
            ->result_array();
        
        $row['total'] = $this->cimongo
            ->where($where)
            ->count_all_results(self::LOGIN_ACTIVITY);

        return $row;        
    }
    
    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
}