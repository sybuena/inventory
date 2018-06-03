<?php

class Import extends MY_Controller {
    
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
       //prepare variables we need
        $data['js']       = $this->config->item('inventoryImport_js');
        $data['css']      = $this->config->item('inventory_css');
        $data['inventory']      = 'active';
        $data['org_name'] = $this->_organization['name'];
        $data['user']     = loginData();

        $this->load->view('inventory/import', $data);
    }

    public function save($id) {
        $data = $this->cimongo
            ->get_where('temp_import', array('_id' => new MongoId($id)))
            ->row_array(); 

        if(!empty($data)) {
            $listData = $data['data'];
            
            foreach($listData as $k => $v) {
                //if we found id in the array
                //it must be update
                if(isset($v['id'])) {
                    $id = $v['id'];
                    //remove the id before updating
                    unset($listData[$k]['id']);
                    //and update 
                    //always override
                    $this->cimongo
                        ->where(array('_id' => new MongoId($id)))
                        ->update(MY_Model::INVENTORY, $listData[$k]);
                //else if no ID found
                //it is new organization
                } else {
                    //insert org
                    $this->cimongo->insert(MY_Model::INVENTORY, $listData[$k]);
                }
            }
        }

        return $this->_returnData(array(
            'count' => count($data['data'])
        ));
    }

    /**
     * Read csv before importing
     * 
     * @return json
     */
    public function parse() {
        $fileName    = $_FILES['afile']['name'];
        $fileType    = $_FILES['afile']['type'];
        //get the file
        $raw = $this->getCsv($_FILES['afile']['tmp_name']);
        $listData     = array();

        $successCount = 0;
        $errorCount   = 0;
        $itemCount    = 0;
        $serviceCount = 0;
        $updateCount  = 0;
        $newCount     = 0;
        $errorMessage = array();

        $raw = $this->_removeDuplicate($raw);
        //now we check for new or updated inventory
        foreach($raw as $k => $v) {
            $hasError = false;
            $message  = array();

            if(empty($v['Code'])) {
                $hasError = true;
                $message[] = '<b>"Code"</b> field cannot be empty';
            }

            if(empty($v['Name'])) {
                $hasError = true;
                $message[] = '<b>"Name"</b> field cannot be empty';
            }

            if(empty($v['Type'])) {
                $hasError = true;
                $message[] = '<b>"Type"</b> field cannot be empty';
            }
            $v['Type'] = ucfirst($v['Type']);
            if(!in_array($v['Type'], array('Item', 'Service'))) {
          //  if($v['Type'] != 'Item' || $v['Type'] != 'Service') {
                $hasError = true;
                $message[] = '<b>"Type"</b> accepted fields are <b>Item</b> and <b>Service</b> only';
            } 

            //if there is a invalid value
            if($hasError) {
                $errorCount++;
                $errorMessage[] = array(
                    'line'      => ($k + 2),
                    'message'   => $message
                );

            //else if there is no error
            } else {
                $successCount++;
                //we check first if the organization is already existing
                $where  = array(
                    'type'      => strtolower($v['Type']),
                    'code'      => $v['Code'],
                    'org_id'    => loginOrg(),
                    'status'    => 1,
                    '$or'            => array(
                        array('name' => array('$regex' => new MongoRegex('/^'.$v['Name'].'/i'))),
                    )
                );

                $invData = $this->cimongo
                    ->select(array('name'))
                    ->get_where(MY_Model::INVENTORY, $where)
                    ->row_array();

                //if name is already exiting
                if(!empty($invData)) {
                    //make this as update
                    $updateCount++;
                } else {
                    $newCount++;
                }
                if($v['Type'] == 'Item') {
                    $itemCount++;
                } 

                if($v['Type'] == 'Service') {
                    $serviceCount++;
                }

                $listData[$k] = array(
                    'name'          => $v['Name'],
                    'code'          => $v['Code'],
                    'type'          => strtolower($v['Type']),
                    'description'   => isset($v['Description'])  ? $v['Description'] : '',
                    'location'      => isset($v['Location'])  ? $v['Location'] : '',
                    'sales'         => isset($v['Sales Price']) ? $v['Sales Price'] : 0,
                    'cost'          => isset($v['Cost Price']) ? $v['Cost Price'] : 0,
                    'status'        => 1,
                    'stock'         => 0,
                    'category'      => '',
                    'created_by'    => loginId(),
                    'date_created'  => strtotime('now'),
                    'date_updated'  => strtotime('now'),
                    'org_id'        => loginOrg()
                );

                if(isset($invData['_id'])) {
                    $listData[$k]['id']  = $invData['_id']->{'$id'};
                }
            }
        }

        $this->cimongo->insert('temp_import', array(
            'date_created' => strtotime('now'),
            'data'         => $listData
        ));
        
        $lastInsert = $this->cimongo->insert_id();
        $id = $lastInsert->{'$id'};
        
        $report = array(
            'id'            => $id,
            'success'       => $successCount,
            'error'         => $errorCount,
            'new'           => $newCount,
            'update'        => $updateCount,
            'error_message' => $errorMessage,
            'item_count'    => $itemCount,
            'service_count' => $serviceCount,
            'total'         => count($raw)
        );

        return $this->_returnData($report);
    }

    public function download() {
        $header = array('Code', 'Name', 'Type', 'Location', 'Sales Price', 'Cost Price', 'Description');
        return $this->convertToCsv($header, array(), 'inventory_import');
    }


    /* Protected Function
    -------------------------------*/
    protected function convertToCsv($header, $csv, $title = '') {
        //HEADER
        $array = array_merge(array($header), $csv);

        $filename = $title.'.csv';
        $delimiter = ",";
        // open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://memory', 'w');
        // loop over the input array
        foreach ($array as $line) {
            // generate csv lines from the inner arrays
            fputcsv($f, $line, $delimiter);
        }
        // rewrind the "file" with the csv lines
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachement; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
        
        //return $data;
    }

    protected function _removeDuplicate($array) {
        return array_map('unserialize', array_unique(array_map('serialize', $array)));
    }

    protected function getCsv($csvfile) {
        $row = 1;
        $csv     = array();
        $successCount  = 0;
        $errorCount    = 0;
        $totalRow      = 0;

        //now convert the csv to array
        if(($handle = fopen($csvfile, "r")) !== FALSE) {

            $max_line_length = defined('MAX_LINE_LENGTH') ? MAX_LINE_LENGTH : 10000;
            $header          = fgetcsv($handle, $max_line_length);
            $header_colcount = count($header);

            while (($row = fgetcsv($handle, $max_line_length)) !== FALSE) {
                $row_colcount = count($row);
                if($row_colcount == $header_colcount) {
                    $entry = array_combine($header, $row);
                    $csv[] = $entry;

                    $successCount++;
                } else {
                    $errorCount++;
                }

                $totalRow++;
            }

            fclose($handle);

        } else {
            $errorCount++;
        }

        return $csv;
    }

    /* Private Function
    -------------------------------*/

}
