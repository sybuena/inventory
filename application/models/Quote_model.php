<?php //-->

class Quote_model extends MY_Model {

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
            ->get_where(self::QUOTE, $where)
            ->row_array();
    }
    /**
     * Create sales invoice
     * 
     * @param array
     * @return bool
     */
    public function create($data) {
        $data['org_id']         = loginOrg();
        $data['created_by']     = loginId();
        $data['date_created']   = strtotime('now');
        $data['date_updated']   = strtotime('now');
        //get supplier detail
        $select = array('company_name', 'account_number');
        $data['customer_info'] = $this->customer->detail($data['customer'], $select);

        return $this->cimongo->insert(self::QUOTE, $data);        
    }

    /**
     * Edit qoute from draft or declined status
     * 
     * @param string
     * @param array
     * @return bool
     */
    public function edit($id, $data) {
        $where = array('_id' => new MongoId($id));
        $data['date_updated'] = strtotime('now');
        $data['updated_by']  = loginId();

        //only if has customer data
        if(isset($data['customer'])) {
            $select = array('company_name', 'account_number');
            $data['customer_info'] = $this->customer->detail($data['customer'], $select);
        }
        
        return $this->cimongo
            ->where($where)
            ->update(self::QUOTE, $data);

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
            $where['$or'][]['quote_number'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['customer_info.company_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        }

        $select = array('status', 'quote_number', 'reference_number', 'date', 'due_date', 'total_amount', 'customer_info');
        
        $list  = $this->cimongo
            ->order_by($order)
            ->select($select)
            ->get_where(self::QUOTE, $where, $limit, ($limit * ($offset - 1)))
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
            ->count_all_results(self::QUOTE);

        return $row;
    }

    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
}