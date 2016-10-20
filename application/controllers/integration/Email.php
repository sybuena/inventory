<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_Controller {
    
    /* Constants
    -------------------------------*/

    /* Public Properties
    -------------------------------*/

    /* Protected Properties
    -------------------------------*/
    protected $_google = array();

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
       
    }

    public function org() {
        echo $this->_organization['_id']->{'$id'};
    }

    public function showUser() {

    }
    
    /**
     * Reply to ticket from zendesk
     * 
     * @param int
     * @return json
     */
    public function replyToTicket($number) {
        //get post data, and user the login user zendesk id as author_id of reply
        $this->zendesk->replyTicket($number, $_POST);
        
        return $this->_returnSuccess();
    }
    /**
     * Webhook for ticket update
     * 
     * @param string
     * @return json
     */
    public function updateTicket($orgId) {
        //$_POST['ticket_id'] = '21';
        //if no post data
        if(!isset($_POST['ticket_id'])) {
            return $this; 
        }
        //at this point we know that the ticket is in database
        $ticketId = $_POST['ticket_id'];
        //get ticket comment list
        $list   = $this->zendesk->getTicketComment($ticketId);
        $detail = $this->zendesk->getTicketDetail($ticketId);
        
        $data = array(
            'status'    => $detail['ticket']['status'],
            'priority'  => $detail['ticket']['priority'],
            'type'      => $detail['ticket']['type'],
            'zendesk_assignee_id' => $detail['ticket']['assignee_id'],
            'comment_list'  => array()
        );
        
        //rebuild the comment section
        foreach($list['comments'] as $v) {
            $data['comment_list'][] = array(
                'zendesk_comment_id' => $v['id'],
                'zendesk_author_id'  => $v['author_id'],
                'date_created'       => strtotime($v['created_at']),
                'body'               => $v['body'],
                'html_body'          => $v['html_body']
            );
        }
        //DB UPDATE
        $where = array(
            'zendesk_id' => $ticketId,
            'org_id'     => $orgId
        );  
        
        $this->cimongo
            ->where($where)
            ->update(MY_Model::TICKET, $data);

        return $this;
    }

    /**
     * Zendesk webhook for new ticket created
     * 
     * @param string
     * @param int
     * @return this 
     */
    public function zendesk($orgId, $test = 0) {
        
        $array = $_POST;

        //we check if the email address is already in the system
        $customerInfo = $this->customer->getByEmail($array['customer_email'], $orgId);

        //if already in system
        if(!empty($customerInfo)) {
            //that was easy
            $data = array(
                'zendesk_id'   => $array['ticket_number'],
                'zendesk_url'  => $array['ticket_url'],
                'type'         => 'Incident',
                'priority'     => 'High',  
                'subject'      => $array['ticket_subject'],
                'content'      => $array['ticket_description'],
                'customer'     => $customerInfo['_id']->{'$id'},
                'assigned'     => 0,
                'source'       => 'zendesk',
                'is_test'      => $test
            );

            //as of now, only convert the email that already our customer
            $this->ticket->save($orgId, $data);
        } 

        return $this;
    }

    public function send() {

        echo (int)$this->email
            //->from('', $this->_defaultEmailName)
            ->from('sy@tenelleven.com', 'Sy Buena')
            ->reply_to('sy@tenelleven.com', 'Sy Buena')
            ->to('sybuena@gmail.com')
            ->subject('Reply Daw')
            ->message('noasdasdasdasdasd')
            ->send();

        echo $this->email->print_debugger();
    }

    /**
     * handle new email 
     * 
     * @return book
     */
    public function webhook($orgId) {
        //57698dc2902e07c4435f0cd8
        
        $body = json_decode(file_get_contents('php://input'), true);
        
        if(!empty($body)) {
          
            //we check if the email address is already in the system
            $customerInfo = $this->customer
                ->getByEmail($body['message_data']['addresses']['from']['email'], $orgId);

            //if already in system
            if(!empty($customerInfo)) {
                //that was easy
                $data = array(
                    'type'         => 'Incident',
                    'priority'     => 'High',  
                    'subject'      => $body['message_data']['subject'],
                    'content'      => $body['message_data']['bodies'][0]['content'],
                    'customer'     => $customerInfo['_id']->{'$id'},
                    'assigned'     => 0,
                    'source'       => 'email'
                );

                //as of now, only convert the email that already our customer
                $this->ticket->save($orgId, $data);
            }
        }

        return true;
    }
    
    public function webhookFail() {

    }

    /**
     * Check for new email fron webhook
     * 
     * @return json
     */
    public function check() {

        $row = $this->cimongo
            ->get_where(MY_Model::TICKET)
            ->result_array();
        pre($row);
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/
}
