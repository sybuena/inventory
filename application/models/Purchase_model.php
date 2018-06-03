<?php //-->

class Purchase_model extends MY_Model {

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
    public function detail($id) {
        $where = array('_id' => new MongoId($id));

        return $this->cimongo
            ->get_where(self::PURCHASE, $where)
            ->row_array();
    }

    public function edit($id, $data) {
        $where = array('_id' => new MongoId($id));
        $data['date_updated']  = strtotime('now');
        $data['updated_by']    = loginId();
        
        if(isset($data['supplier'])) {
            $select = array('company_name', 'account_number');
            $data['supplier_info'] = $this->customer->detail($data['supplier'], $select);
        }
        
        $this->cimongo
            ->where($where)
            ->update(self::PURCHASE, $data);

    }

    public function create($data) {
        $data['org_id']         = loginOrg();
        $data['created_by']     = loginId();
        $data['date_created']   = strtotime('now');
        $data['date_updated']   = strtotime('now');
        //get supplier detail
        $select = array('company_name', 'account_number');
        $data['supplier_info'] = $this->customer->detail($data['supplier'], $select);

        $this->cimongo->insert(self::PURCHASE, $data);

        return true;
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
    public function getList($order, $search, $offset, $limit) {
        $where = array(
            'status' => array('$ne' => 0),
            'org_id' => loginOrg()
        );
        
        //search query
        if(!empty($search)) {
            $query = urldecode($search);
             if(strstr($query, '-')) {
                $explode = explode('-', $query);
                if(isset($explode[1]) && $explode[1] != '0') {
                    $where['status'] =  array('$in' => array((int) $explode[1], (string) $explode[1]));
                }
                
            } else {
                $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
                $where['$or'][]['code'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            }
        }

        $select = array('status', 'order_number', 'reference_number', 'date', 'due_date', 'total_amount', 'supplier_info');
        
        $list  = $this->cimongo
            ->order_by($order)
            ->select($select)
            ->get_where(self::PURCHASE, $where, $limit, ($limit * ($offset - 1)))
            ->result_array();

        foreach($list as $k => $v) {
            //change name of status
            $list[$k]['status_text'] = $v['status'];
            $list[$k]['id'] = $v['_id']->{'$id'};
            unset($list[$k]['status']);
        }      

        $row['rows'] = $list;
        $row['total'] = (int)$this->cimongo
            ->where($where)
            ->count_all_results(self::PURCHASE);

        return $row;
    }

    /**
     * Get inventory purchase
     *
     * @param string
     * @param array
     * @param string
     * @param int
     * @param int
     * @return array
     */
    public function getInventoryPurchase($id, $order, $search, $offset, $limit) {
        
        $where = array(
            'status' => array('$ne' => 0),
            'org_id' => loginOrg(),
            'line'   => array(
                '$elemMatch' => array(
                    'id' => $id
                )
            )
        );
        
        //search query
        if(!empty($search)) {
            $query = urldecode($search);
             if(strstr($query, '-')) {
                $explode = explode('-', $query);
                if(isset($explode[1]) && $explode[1] != '0') {
                    $where['status'] =  array('$in' => array((int) $explode[1], (string) $explode[1]));
                }
                
            } else {
                $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
                $where['$or'][]['code'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            }
        }

        $select = array('status', 'order_number', 'reference_number', 'date', 'due_date', 'total_amount', 'supplier_info');
        
        $list  = $this->cimongo
            ->order_by($order)
            ->select($select)
            ->get_where(self::PURCHASE, $where, $limit, ($limit * ($offset - 1)))
            ->result_array();

        foreach($list as $k => $v) {
            //change name of status
            $list[$k]['status_text'] = $v['status'];
            $list[$k]['id'] = $v['_id']->{'$id'};
            unset($list[$k]['status']);
        }      

        $row['rows'] = $list;
        $row['total'] = (int)$this->cimongo
            ->where($where)
            ->count_all_results(self::PURCHASE);

        return $row;
    }

    /**
     * Get inventory purchase
     *
     * @param string
     * @param array
     * @param string
     * @param int
     * @param int
     * @return array
     */
    public function getCustomerPurchase($id, $order, $search, $offset, $limit) {
        
        $where = array(
            'status' => array('$ne' => 0),
            'org_id' => loginOrg(),
            'supplier' => $id
        );
        
        //search query
        if(!empty($search)) {
            $query = urldecode($search);
             if(strstr($query, '-')) {
                $explode = explode('-', $query);
                if(isset($explode[1]) && $explode[1] != '0') {
                    $where['status'] =  array('$in' => array((int) $explode[1], (string) $explode[1]));
                }
                
            } else {
                $where['$or'][]['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
                $where['$or'][]['code'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            }
        }

        $select = array('status', 'order_number', 'reference_number', 'date', 'due_date', 'total_amount', 'supplier_info');
        
        $list  = $this->cimongo
            ->order_by($order)
            ->select($select)
            ->get_where(self::PURCHASE, $where, $limit, ($limit * ($offset - 1)))
            ->result_array();

        foreach($list as $k => $v) {
            //change name of status
            $list[$k]['status_text'] = $v['status'];
            $list[$k]['id'] = $v['_id']->{'$id'};
            unset($list[$k]['status']);
        }      

        $row['rows'] = $list;
        $row['total'] = (int)$this->cimongo
            ->where($where)
            ->count_all_results(self::PURCHASE);

        return $row;
    }

    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
}