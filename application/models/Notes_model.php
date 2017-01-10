<?php //-->

class Notes_model extends MY_Model {

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
    public function getList($order, $search, $offset, $limit) {
        $where = array(
            'status' => array('$ne' => 0),
            'org_id' => loginOrg()
        );
        
        //search query
        if(!empty($search)) {
            $query = urldecode($search);
            $where['$or'][]['title'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['description'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['amount'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
        }

        $list  = $this->cimongo
            ->order_by($order)
            ->get_where(self::NOTES, $where, $limit, ($limit * ($offset - 1)))
            ->result_array();
       // pre($list);exit;
        foreach($list as $k => $v) {
            //change name of status
            $list[$k]['status_text'] = $v['status'];
            $list[$k]['id'] = $v['_id']->{'$id'};
            $list[$k]['amount'] = decim(!isset($v['amount']) || empty($v['amount']) ? 0 : $v['amount']);
            
            $user = $this->user->detail($v['created_by']);

            $list[$k]['created_by'] = $user['first_name'].' '.$user['last_name'];
            unset($list[$k]['status']);
        }      

        $row['rows'] = $list;
        $row['total'] = (int)$this->cimongo
            ->where($where)
            ->count_all_results(self::NOTES);

        return $row;
    }

    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
}