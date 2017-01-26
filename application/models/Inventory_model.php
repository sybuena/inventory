<?php //-->

class Inventory_model extends MY_Model {

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
     * Get list of inventory with pagination
     * 
     * @param string 
     * @param string 
     * @param array 
     * @param string 
     * @param string|int 
     * @param string|int 
     * @return array 
     */
    public function getQuantityList($id, $offset, $limit) {
        $where = array(
            'inventory_id' => $id,
            'status' => 1,
            'org_id' => loginOrg()
        );
 
        $list = $this->cimongo
            ->order_by(array('_id' => -1))
            ->get_where(self::QUANTITY_LOG, $where, $limit, ($limit * ($offset - 1)))
            ->result_array();
                
        $row['rows'] = array();
        
        foreach($list as $k => $v) {
            $customer = '<i>n/a</i>';

            if(!empty($v['customer'])) {
                $info = $this->customer->detail($v['customer']);
                $customer = $info['first_name'].' '.$info['last_name'];
            }
            
            $current = ($v['operation'] == 'add') ?
                 decim($v['current'] + $v['delimeter']) : 
                 decim($v['current'] - $v['delimeter']);
            
            $row['rows'][] = array(
                'date'        => date('m-d-Y', $v['date']),
                'type'        => ucfirst($v['type']),
                'number'      => !empty($v['type_number']) ? $v['type_number'] : '<i>n/a</i>',
                'customer'    => $customer,
                'description' => !empty($v['description']) ? $v['description'] : '<i>n/a</i>',
                'add'         => ($v['operation'] == 'add') ? 
                    '<span class="badge bgm-red">'.decim($v['delimeter']).'</span>' : '',
                'minus'       => ($v['operation'] == 'minus') ? 
                    '<span class="badge bgm-green">'.decim($v['delimeter']).'</span>' : '',
                'prev'        => decim($v['current']),
                'current'     => $current,
            );
        }

        $row['total'] = (int)$this->cimongo
            ->where($where)
            ->count_all_results(self::QUANTITY_LOG);

        return $row;
    }

    /**
     * Save logs of add quantity
     * 
     * @param string
     * @param int
     * @param string
     * @param stirng
     * @param string
     * @return this
     */
    public function addQuantityLog($inventoryId, $delimeter, $description, $type, $typeId = '') {

        $inventory = $this->detail($inventoryId);
       
        if($type == 'manual') {
            $customer  = '';    
            $typeNumber = '';    
        }

        if($type == 'purchase' && !empty($typeId)) {
            $detail   = $this->purchase->detail($typeId);

            $customer   = $detail['supplier'];
            $typeNumber = $detail['order_number'];
        }

        $data = array(
            'inventory_id' => $inventoryId,
            'description' => $description,
            'current'     => $inventory['stock'],
            'operation'   => 'add',
            'delimeter'   => $delimeter,  
            'type_number' => $typeNumber,
            'type_id'     => $typeId,
            'type'        => $type,
            'date'        => strtotime('now'),
            'customer'    => $customer,
            'created_by'  => loginId(),
            'status'      => 1,
            'org_id'      => loginOrg()
        );

        $this->cimongo->insert(self::QUANTITY_LOG, $data);

        return $this;
    }

    public function minusQuantityLog($inventoryId, $delimeter, $description, $type, $typeId = '') {

        $inventory = $this->detail($inventoryId);
       
        if($type == 'manual') {
            $customer  = '';    
            $typeNumber = '';    
        }

        if($type == 'invoice' && !empty($typeId)) {
            $detail   = $this->sales->detail($typeId);

            $customer   = $detail['customer'];
            $typeNumber = $detail['invoice_number'];
        }
        
        $data = array(
            'inventory_id' => $inventoryId,
            'description'  => $description,
            'current'      => $inventory['stock'],
            'operation'    => 'minus',
            'delimeter'    => $delimeter,  
            'type_number'  => $typeNumber,
            'type_id'      => $typeId,
            'type'         => $type,
            'date'         => strtotime('now'),
            'customer'     => $customer,
            'created_by'   => loginId(),
            'status'       => 1,
            'org_id'       => loginOrg()
        );

        $this->cimongo->insert(self::QUANTITY_LOG, $data);

        return $this;
    }

    public function itemPendingSales($id) {
        $where = array(
            'status' => array('$in' => array(1, '1')),
            'org_id' => loginOrg(),
          //  'line'   => array('$elemMatch' => array('id' => $id))
        );
        $where['$or'][]['line'] = array(
            '$elemMatch' => array(
                'id' => $id
            )
        );
        $where['$or'][]['service'] = array(
            '$elemMatch' => array(
                'id' => $id
            )
        );

        $list = $this->cimongo
            ->select(array('line', 'service'))
            ->get_where(self::INVOICE, $where)
            ->result_array(); 

        $count = 0;

        foreach($list as $v) {
            foreach($v['line'] as $val) {
                $count += ($val['id'] == $id) ? $val['quantity'] : 0;
            }
            foreach($v['service'] as $val) {
                $count += ($val['id'] == $id) ? $val['quantity'] : 0;
            }
        }

        return $count;
    }

    public function itemJobOrder($id) {
        $where = array(
            'status' => array('$nin' => array('0', 0, 4, '4')),
            'org_id' => loginOrg(),
            'service'   => array('$elemMatch' => array('id' => $id))
        );

        $list = $this->cimongo
            ->select(array('service'))
            ->get_where(self::JOB_ORDER, $where)
            ->result_array(); 
            
        $count = 0;

        foreach($list as $v) {
            foreach($v['service'] as $val) {
                $count += ($val['id'] == $id) ? $val['quantity'] : 0;
            }
        }

        return $count;
    }

    public function itemQuantation($id) {
        $where = array(
            'status' => array('$nin' => array('0', 0, 4, '4')),
            'org_id' => loginOrg(),
        );

        $where['$or'][]['line'] = array(
            '$elemMatch' => array(
                'id' => $id
            )
        );
        $where['$or'][]['service'] = array(
            '$elemMatch' => array(
                'id' => $id
            )
        );

        $list = $this->cimongo
            ->select(array('line', 'service'))
            ->get_where(self::QUOTE, $where)
            ->result_array(); 

        $count = 0;

        foreach($list as $v) {
            foreach($v['line'] as $val) {
                $count += ($val['id'] == $id) ? $val['quantity'] : 0;
            }
            foreach($v['service'] as $val) {
                $count += ($val['id'] == $id) ? $val['quantity'] : 0;
            }
        }
        return $count;
    }

    public function itemPendingPurchase($id) {
        //status 1 = pending
        $where = array(
            'status' => array('$in' => array(1, '1')),
            'org_id' => loginOrg(),
        );
        $where['$or'][]['line'] = array(
            '$elemMatch' => array(
                'id' => $id
            )
        );
        $where['$or'][]['service'] = array(
            '$elemMatch' => array(
                'id' => $id
            )
        );

        $list = $this->cimongo
            ->select(array('line', 'service'))
            ->get_where(self::PURCHASE, $where)
            ->result_array(); 
        
        $count = 0;

        foreach($list as $v) {
            foreach($v['line'] as $val) {
                $count += ($val['id'] == $id) ? $val['quantity'] : 0;
            }
            foreach($v['service'] as $val) {
                $count += ($val['id'] == $id) ? $val['quantity'] : 0;
            }
        }

        return $count;
    }


    public function detail($id, $select = array()) {
        $where = array(
            'status' => 1,
            '_id' => new MongoId($id)
        );
        
        if(empty($select)) {
            return $this->cimongo
                ->get_where(self::INVENTORY, $where)
                ->row_array();   
        } else {
            return $this->cimongo
                ->select($select)
                ->get_where(self::INVENTORY, $where)
                ->row_array();   
        }
    }

    /**
     * Search inventory
     * 
     * @param string
     * @param string
     * @param bool
     * @return array
     */
    public function search($query, $type, $hasStock = 0) {
        $where = array(
            'status' => 1,
            'org_id' => loginOrg()
        );
        if($type != 'all') {
            $where['type'] = $type;
        }
        //only get item that has stock on it
        if($hasStock) {
            $where['stock'] = array('$ne' => 0);
        }

        $query = urldecode($query);
        $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        $where['$or'][]['code'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        
        $list = $this->cimongo
            ->get_where(self::INVENTORY, $where)
            ->result_array();
       
        $data = array();
        
        foreach($list as $k => $v) {
            $value = '('.$v['code'].') '.$v['name'];

            $data[$k]['text']  = $value;
            $data[$k]['value'] = $value;
            $data[$k]['sales'] = (!empty($v['sales']) ? decim($v['sales']) : decim(0));
            $data[$k]['cost']  = (!empty($v['cost']) ? decim($v['cost']) : decim(0));

            $data[$k]['id'] = $v['_id']->{'$id'};
            
        }

        return $data;
    }

    public function getAllInventory() {

        $select = array('name', 'code', 'description', 'sales', 'cost');
        $where = array(
            'org_id' => loginOrg(),
            'status' => 1
        );

        return $this->cimongo
            ->select($select)
            ->get_where(self::INVENTORY, $where)
            ->result_array();
    }

    /**
     * Create Category for items
     * 
     * @param array
     * @return array
     */
    public function createCategory($post) {
        
        //check if email is already in the system
        if($this->checkGroup($post['name'])) {
            return array(
                'message'       => 'duplicate_name',
                'long_message'  => 'Category name already in the system'
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

        $this->cimongo->insert(self::INVENTORY_CATEGORY, $data);

        return array();
    }

    /**
     * Create Customer
     * 
     * @param arra
     * @return array
     */
    public function add($post) {

        //check if email is already in the system
        if($this->checkCode($post['code'])) {
            return array(
                'message'       => 'duplicate_code',
                'long_message'  => 'Item Code already in the system'
            );
        }

        //check if there is group
        if(!empty($post['category'])) {
            //now get group name
            $group = $this->getCategotyDetail($post['category'], array('name'));

            $post['category'] = array(
                'id'    => $post['category'],
                'name'  => $group['name']
            );
        }

        $data = array(
            'date_created'  => strtotime('now'),
            'date_updated'  => strtotime('now'),
            'status'        => 1,
            'org_id'        => $this->_organization['_id']->{'$id'},
            'created_by'    => loginId(),
            'stock'         => 0
        );
        
        $this->cimongo->insert(self::INVENTORY, array_merge($post, $data));

        return array();
    }

    /**
     * Update item detail
     * 
     * @param string
     * @param array
     * @return bool
     */
    public function updateItem($id, $data) {

        $where = array('_id' => new MongoId($id));

        return $this->cimongo
            ->where($where)
            ->update(self::INVENTORY, $data);
    }


    /**
     * Get list of inventory with pagination
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
            $where['category.id'] = $group;
        }
        
        //search query
        if(!empty($search)) {
            $query = urldecode($search);
            $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['code'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        }

        $list = $this->cimongo
            ->order_by($order)
            ->get_where(self::INVENTORY, $where, $limit, ($limit * ($offset - 1)))
            ->result_array();
                
        $row['rows'] = array();

        foreach($list as $k => $v) {
            $type = '<button class="btn bgm-blue btn-xs waves-effect">Item</button>';
            if($v['type'] == 'service') {
                $type = '<button class="btn bgm-red btn-xs waves-effect">Service</button>';
            }
            $row['rows'][$k] = array( 
                'id'        => $v['_id']->{'$id'},
                'code'      => $v['code'],
                'name'      => $v['name'],
                'type'      => $type,
                'category'  => isset($v['category']['name']) ? $v['category']['name'] : '<i>None</i>',
                'cost'      => isset($v['cost']) && !empty($v['cost']) ? money($v['cost']) : money('0.00'),
                'sales'     => isset($v['sales']) && !empty($v['sales']) ? money($v['sales']) : money('0.00'),
                'stock'  => isset($v['stock']) ? number_format($v['stock'], 2) : '0.00'
            );
        }
      
        $row['total'] = (int)$this->cimongo
            ->where($where)
            ->count_all_results(self::INVENTORY);

        return $row;
    }

     /**
     * Check if code is existing already
     * 
     * @param email
     * @return bool
     */
    public function checkCode($code) {
        $where = array(
            'code'     => $code,
            'status'   => 1,
            'org_id'   => $this->_organization['_id']->{'$id'}
        );

        $data = $this->cimongo
            ->select(array('_id'))
            ->get_where(self::INVENTORY, $where)
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
            ->get_where(self::INVENTORY_CATEGORY, $where)
            ->row_array();

        return (empty($data)) ? false : true;
    }

    /**
     * Get category list base on org
     * 
     * @return array
     */
    public function getCategoryList($select = array()) {
        $where = array(
            'status' => 1,
            'org_id' => $this->_organization['_id']->{'$id'}
        );
        if(empty($select)) {
            return $this->cimongo
                ->get_where(self::INVENTORY_CATEGORY, $where)
                ->result_array();
        } else {
            return $this->cimongo
                ->select($select)
                ->get_where(self::INVENTORY_CATEGORY, $where)
                ->result_array();
        }
    }

    public function getCategotyDetail($id, $select = array()) {
        $where = array(
            'status' => 1,
            '_id' => new MongoId($id)
        );

        if(!empty($select)) {
            return $this->cimongo
                ->select($select)
                ->get_where(self::INVENTORY_CATEGORY, $where)
                ->row_array();
        } else {
            return $this->cimongo
                ->get_where(self::INVENTORY_CATEGORY, $where)
                ->row_array();
        }
    }
    public function searchGlobal($query, $orgId) {

        $where = array(
            'status' => 1,
            'org_id' => $orgId
        );

        $query = urldecode($query);
        $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        $where['$or'][]['code'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        
        $list = $this->cimongo
            ->get_where(self::INVENTORY, $where)
            ->result_array();
       
        $data = array();

        foreach($list as $k => $v) {
            $name = $v['name'].' ('.$v['code'].')';
            $data[$k]['text'] = $name;
            $data[$k]['value'] = $name;
            $data[$k]['type'] = 'inventory';
            $data[$k]['id'] = $v['_id']->{'$id'};
            
        }

        return $data;
    }
    
    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
}