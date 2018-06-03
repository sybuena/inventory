<?php //-->

class Activity_model extends MY_Model {

    /* Constants
    -------------------------------*/
    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/
    protected $_action      = NULL;
    protected $_title       = NULL;
    protected $_for    = NULL;
    protected $_type        = 'activity';
    protected $_note        = '';

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
     * Get member of the organization
     * 
     * @param string
     * @param string
     * @param int
     * @param int
     * @return array
     */
    public function allActivity($orgId, $order, $search, $offset, $limit) {
        $where = array(
            'status'       => 1,
            'organization_id' => $orgId
        );
        //search query
        if(!empty($search)) {
            $query = urldecode($search);
            
            $where['$or'][]['created_by']['name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['created_by']['first_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['created_by']['last_name'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            $where['$or'][]['title'] = array('$regex' => new MongoRegex('/.*'.$query.'.*/i'));
            
        }
        
        $list = $this->cimongo
            ->order_by($order)
            ->get_where(self::ACTIVITY_HISTORY, $where, $limit, ((int)$offset - 1))
            ->result_array();

        //pre($where);exit;
        foreach($list as $k => $v) {
            //unset this shit
            unset($list[$k]['status']);
            //default
            $name = $v['created_by']['first_name'].' '.$v['created_by']['last_name'];
            $action = $this->action($v['action']);
            
            $list[$k]['id'] = $v['_id']->{'$id'};
            $list[$k]['action'] = ucfirst($v['action']);
            $list[$k]['name'] = $name;
            $list[$k]['date'] = date('m-d-Y', $v['date_created']);

            //we generate the text here
            $list[$k]['description'] = '<b>'.$name.'</b> '.$action.' '.$v['title'];
        }

        $row['rows'] = $list;
        
        $row['total'] = $this->cimongo
            ->where($where)
            ->count_all_results(self::ACTIVITY_HISTORY);

        return $row;        
    }

    /**
     * Get report activity, only get activity that is related
     * to report
     * 
     * @param string
     * @return array
     */
    public function reportActivity($reportId) {
       $where = array(
            'table_id' => $reportId,
            'status'   => 1
       ); 

       $row = $this->cimongo
            ->order_by(array('date_created' => 'DESC'))
            ->get_where(self::ACTIVITY_HISTORY, $where)
            ->result_array();
        
        //get created by name
        foreach($row as $k => $v) {
            
            $action = $this->action($v['action']);
            $name = $v['created_by']['first_name'].' '.$v['created_by']['last_name'];
            //we generate the text here
            $row[$k]['description'] = '<b>'.$name.'</b> '.$action.' '.$v['title'];
        }

        return $row;
    }

    /**
     * Get report activity, only get activity that is related
     * to report
     * 
     * @param string
     * @return array
     */
    public function crmActivity($customerId) {
       $where = array(
            'for_id' => $customerId,
            'status' => 1
       ); 

       $row = $this->cimongo
            ->order_by(array('date_created' => 'DESC'))
            ->get_where(self::ACTIVITY_HISTORY, $where)
            ->result_array();
        
        //get created by name
        foreach($row as $k => $v) {
            
            $action = $this->action($v['action']);
            $name = $v['created_by']['first_name'].' '.$v['created_by']['last_name'];
            //we generate the text here
            $row[$k]['description'] = '<b>'.$name.'</b> '.$action.' '.$v['title'];
        }

        return $row;
    }

    /**
     * Set action name for activity
     * 
     * @param string
     * @return this
     */
    public function setAction($action) {
        $this->_action = $action;

        return $this;
    }

    /**
     * Set title for activity
     * 
     * @param string
     * @return this
     */
    public function setTitle($title) {
        $this->_title = $title;

        return $this;
    }

    /**
     * 
     * 
     * @param string
     * @return this
     */
    public function setFor($for) {
        $this->_for = $for;

        return $this;
    }

    /**
     * Set type
     * 
     * @param string
     * @return this
     */
    public function setType($type) {
        $this->_type = $type;

        return $this;
    }

    /**
     * Set long message to activity
     * 
     * @param string
     * @return this
     */
    public function setNote($note) {
        $this->_note = $note;

        return $this;
    }

    /**
     * Save activity
     * 
     * @param string
     * @param string
     * @return this
     */
    public function save($table = '', $tableId = '') {
        
        $data = array(
            'type'            => $this->_type,
            'table'           => $table,
            'table_id'        => $tableId,
            'for_id'          => $this->_for,
            'created_by'      => $this->user->detail(loginId(), array('first_name', 'last_name', 'name')),
            'date_created'    => strtotime('now'),
            'organization_id' => loginOrg(),
            'action'          => $this->_action,
            'title'           => $this->_title,
            'note'            => $this->_note,
            'status'          => 1
        );

        $this->cimongo->insert(self::ACTIVITY_HISTORY, $data);

        return $this;
    }


    
    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
    private function action($action) {
        
        if(substr($action, -1) == 'e') {
            return $action.'d';
        } 

        return $action;
    }
}