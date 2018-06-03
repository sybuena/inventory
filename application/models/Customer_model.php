<?php //-->

class Customer_model extends MY_Model {

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
    public function index() {
       
    }

    public function getAllContacts() {
        $select = array('company_name', 'account_number');
        $where = array(
            'org_id' => loginOrg(),
            'status' => 1
        );

        return $this->cimongo
            ->select($select)
            ->get_where(self::CUSTOMER, $where)
            ->result_array();
    }

    public function getByEmail($email, $orgId) {
        $where = array(
            'status' => 1,
            'org_id' => $orgId,
            'email'  => $email
        );

        return $this->cimongo
            ->get_where(self::CUSTOMER, $where)
            ->row_array();
    }

    public function search($query, $orgId) {
        $where = array(
            'status' => 1,
            'org_id' => $orgId
        );

        $query = urldecode($query);
        $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        $where['$or'][]['first_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        $where['$or'][]['last_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        
        $list = $this->cimongo
            ->get_where(self::CUSTOMER, $where)
            ->result_array();
       
        $data = array();

        foreach($list as $k => $v) {
            if(isset($v['name'])) {
                $name = $v['name'];
                if(!empty($v['account_number'])) {
                    $name = $v['name'].' ('.$v['account_number'].')';
                }
            } else {    
                $name = $v['first_name'].' '.$v['last_name'];
                if(!empty($v['account_number'])) {
                    $name = $v['first_name'].' '.$v['last_name'].' ('.$v['account_number'].')';
                }
            }

            $data[$k]['text'] = $name;
            $data[$k]['value'] = $name;
            $data[$k]['type'] = $v['contacts'];
            $data[$k]['id'] = $v['_id']->{'$id'};
        }

        return $data;
    }

    /**
     * Customer detail will get everything
     * 
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
                ->get_where(self::CUSTOMER, $where)
                ->row_array();
        } else {
            return $this->cimongo
                ->get_where(self::CUSTOMER, $where)
                ->row_array();
        }
    }
    
    /**
     * Update customer detail
     * 
     * @param string
     * @param array
     * @return bool
     */
    public function updateCustomer($id, $data) {

        $where = array('_id' => new MongoId($id));

        return $this->cimongo
            ->where($where)
            ->update(self::CUSTOMER, $data);
    }

    /**
     * Create Customer group
     * 
     * @param array
     * @return array
     */
    public function createGroup($post) {
        
        //check if email is already in the system
        if($this->checkGroup($post['name'])) {
            return array(
                'message'       => 'duplicate_name',
                'long_message'  => 'Group name already in the system'
            );
        }

        $data = array(
            'date_created'  => strtotime('now'),
            'date_updated'  => strtotime('now'),
            'status'        => 1,
            'name'          => $post['name'],
            'description'   => $post['description'],
            'org_id'        => $this->_organization['_id']->{'$id'},
            'created_by'    => loginId()
        );

        $this->cimongo->insert(self::CUSTOMER_GROUP, $data);

        return array();
    }

    /**
     * Create Customer
     * 
     * @param arra
     * @return array
     */
    public function createCustomer($post) {

        //check if email is already in the system
        // if($this->checkEmail($post['email'])) {
        //     return array(
        //         'message'       => 'duplicate_email',
        //         'long_message'  => 'Email address already in the system'
        //     );
        // }
        //check if there is group
        if(!empty($post['group'])) {
            //now get group name
            $group = $this->customer->getGroupDetail($post['group'], array('name'));

            $post['group'] = array(
                'id'    => $post['group'],
                'name'  => $group['name']
            );
        }

        $data = array(
            'call_balance'  => 0,
            'last_call'     => '',
            'date_created'  => strtotime('now'),
            'date_updated'  => strtotime('now'),
            'status'        => 1,
            'primary_name'  => $post['first_name'].' '.$post['last_name'],
            'org_id'        => $this->_organization['_id']->{'$id'},
            'created_by'    => loginId()
        );
        
        $this->cimongo->insert(self::CUSTOMER, array_merge($post, $data));

        return array();
    }

    public function getGroupDetail($id, $select = array()) {
        $where = array(
            'status' => 1,
            '_id' => new MongoId($id)
        );

        if(!empty($select)) {
            return $this->cimongo
                ->select($select)
                ->get_where(self::CUSTOMER_GROUP, $where)
                ->row_array();
        } else {
            return $this->cimongo
                ->get_where(self::CUSTOMER_GROUP, $where)
                ->row_array();
        }
    }

    /**
     * Check if email is existing already
     * 
     * @param email
     * @return bool
     */
    public function checkEmail($email) {
        $where = array(
            'email'     => $email,
            'status'    => 1,
            'org_id'    => $this->_organization['_id']->{'$id'}
        );

        $data = $this->cimongo
            ->select(array('_id'))
            ->get_where(self::CUSTOMER, $where)
            ->row_array();

        return (empty($data)) ? false : true;
    }

    /**
     * Check if group name is existing already
     * 
     * @param string
     * @return bool
     */
    public function checkGroup($name) {
        $where = array(
            'name'     => $name,
            'status'    => 1,
            'org_id'    => $this->_organization['_id']->{'$id'}
        );

        $data = $this->cimongo
            ->select(array('_id'))
            ->get_where(self::CUSTOMER_GROUP, $where)
            ->row_array();

        return (empty($data)) ? false : true;
    }

    public function getGroupList() {
        $where = array(
            'status' => 1,
            'org_id' => $this->_organization['_id']->{'$id'}
        );

        return $this->cimongo
            ->get_where(self::CUSTOMER_GROUP, $where)
            ->result_array();
    }

    /**
     * Get list of customer with pagination
     * 
     * @param string 
     * @param string 
     * @param array 
     * @param string 
     * @param string|int 
     * @param string|int 
     * @return array 
     */
    public function getList($group, $orgId, $order, $search, $offset, $limit) {
        $where = array(
            'status' => 1,
            'org_id' => $orgId
        );

        if($group != 'all') {
            $where['group.id'] = $group;
        }
        
        //search query
        if(!empty($search)) {
            $query = urldecode($search);
            $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['first_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['last_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['email'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['group.name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        }

        $list = $this->cimongo
            ->order_by($order)
            ->get_where(self::CUSTOMER, $where, $limit, ($limit * ($offset - 1)))
            ->result_array();
                
        $row['rows'] = array();

        foreach($list as $k => $v) {

            $createdBy = $this->user->detail($v['created_by']);
            
            $row['rows'][$k]['created_by'] = $createdBy['first_name'].' '.$createdBy['last_name'];
            $row['rows'][$k]['id']    = $v['_id']->{'$id'};
            $row['rows'][$k]['group']  = isset($v['group']['name']) ? $v['group']['name'] : '<i>None</i>';
            $row['rows'][$k]['name']  = $v['company_name'];
            $row['rows'][$k]['account_number']  = isset($v['account_number']) ? $v['account_number'] : 'n/a';
            $row['rows'][$k]['first_name']  = $v['first_name'];
            $row['rows'][$k]['last_name']  = $v['last_name'];
            $row['rows'][$k]['email']  = $v['email'];
            $row['rows'][$k]['image']  = showImage($v);
            $row['rows'][$k]['last_update'] = (isset($v['last_update'])) ?
                $v['last_update']:
                $v['date_created'];
        }
      
        $row['total'] = (int)$this->cimongo
            ->where($where)
            ->count_all_results(self::CUSTOMER);

        return $row;
    }
    
    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
    

}