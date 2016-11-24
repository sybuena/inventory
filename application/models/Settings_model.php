<?php //-->

class Settings_model extends MY_Model {

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
    public function update($data) {
        $where = array('org_id' => loginOrg());
        
        $this->cimongo
            ->where($where)
            ->update(self::SETTINGS, $data);

        return $this;    
    }
    /**
     * For generate settings
     * 
     * @return array
     */
    public function getAllSequence() {
        $where = array('org_id' => loginOrg());

        return $this->cimongo
            ->select(array('invoice', 'purchase_order', 'quotation'))
            ->get_where(self::SETTINGS, $where)
            ->row_array();
    }

    public function updateNextNumber($type) {
        $where = array('org_id' => loginOrg());
        $data = $this->cimongo
            ->select(array($type))
            ->get_where(self::SETTINGS, $where)
            ->row_array();
        //plus one the next number
        $data[$type]['next'] = $data[$type]['next'] + 1;
        
        unset($data['_id']);
        
        $this->update($data);
        
        return $this;
    }

    public function nextNumber($type = 'invoice') {
        $where = array('org_id' => loginOrg());
        $data = $this->cimongo
            ->get_where(self::SETTINGS, $where)
            ->row_array();

        return $data[$type]['prefix'].'-'.sprintf('%0'.$data[$type]['digit'].'d', $data[$type]['next']);
    }

    /**
     * First time save sequence
     * 
     * @return bool
     */
    public function saveSequence() {
        $data = array(
            'created_by' => strtotime('now'),
            'org_id' => loginOrg(),
            'invoice' => array(
                'prefix' => 'INV',
                'digit'  => 6,
                'next'   => 1
            ),
            'purchase_order' => array(
                'prefix' => 'PO',
                'digit' => 6,
                'next'   => 1
            ),
            'quotation' => array(
                'prefix' => 'QUO',
                'digit'  => 6,
                'next'   => 1
            ),
        );

        return $this->cimongo->insert(self::SETTINGS, $data);
    }
   
    
    /* Protected Function
    -------------------------------*/
   
    /* Private Function
    -------------------------------*/
}