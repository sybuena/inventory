<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twitter extends MY_Controller {
    
    /* Constants
    -------------------------------*/
    const TEST = 'n@kakaumaka2';

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
    
        $this->_app = array(
            'key' => 'ze09RxE1jlYvmG1k20lEh6rMu',
            'secret' =>'BqA5XmbtQsgggJrsfFb48N1qSaAJaBVgWtOq2CSzRNG7Aurv9T',
            'url'   => 'http://crm-tenelleven.com/integration/twitter/callback'
        );
    }

    /* Public Function
    -------------------------------*/
    public function index() {
        //3 step auth
        //init
        $auth = eden('twitter')->auth($this->_app['key'], $this->_app['secret']);
        //get access token
        $token = $auth->getRequestToken();
        //login url
        $login = $auth->getLoginUrl($token['oauth_token'], $this->_app['url']);
        
        $token['login'] = $login;

        return $this->_returnData($token);  
    }

    public function stream(){
        header('Content-type: text/html; charset=utf-8');
        
        $this->output('Begin... (counting to 10)');

        for( $i = 0 ; $i < 10 ; $i++ ) {
            $this->output($i+1);
        }

        $this->output('End...');

    }

    public function stream2() {
        // get user/pass from config/twitter.php
       // $this->CI->config->load('twitter');

        $user = 'sybueba2';//$this->CI->config->item('user');
        $pass = self::TEST;//$this->CI->config->item('pass');
        // check if user and pass are set
        if( !isset($user) || !isset($pass) || !$user || !$pass ) {
            echo 'ERROR: Username or password not found.'.PHP_EOL;
        } else {
            // start an infinite loop for reconnection attempts
            //for( $i = 0 ; $i < 10 ; $i++ ) {

                $fp = fsockopen("ssl://stream.twitter.com", 443, $errno, $errstr, 30); // has to be ssl
                
                if(!$fp) {
                    echo $errstr.'('.$errno.')'.PHP_EOL;
                } else {
                  
                    // build request
                    $trackstring = implode(',', array());
                    $query_data = array(
                        'track' => $trackstring,
                        'include_entities' => 'true'
                    );

                    $request = "GET /1/statuses/filter.json?" . http_build_query($query_data) . " HTTP/1.1\r\n";
                    $request .= "Host: stream.twitter.com\r\n";
                    $request .= "Authorization: Basic " . base64_encode($user . ':' . $pass) . "\r\n\r\n";
                    // write request
                    fwrite($fp, $request);
                    // set stream to non-blocking - research if this is really needed.
                    // stream_set_blocking($fp, 0);
                    while(!feof($fp)) {
                        $read   = array($fp);
                        $write  = null;
                        $except = null;
                        // Select, wait up to 10 minutes for a tweet.
                        // If no tweet, reconnect by retsarting loop.
                        $res = stream_select($read, $write, $except, 600, 0);
                        if (($res == false) || ($res == 0) )
                        {
                            break;
                        }
                        $json = fgets($fp);
                        echo $json;
                        $data = json_decode($json, true);
                        pre($data);
                        if($data) {
                           // pre($data);
                            //$this->process($data);
                        }
                    }
                    fclose($fp);
                    // sleep for ten seconds before reconnecting
             //       sleep(10);
                }
           // }
        }
    }

    public function output($val){
        echo $val;
        flush();
        ob_flush();
        usleep(500000);
    }

    public function getMention() {
        $test  = $this->ticket->getToken('twitter');
        $sample = eden('twitter')
            ->timeline($this->_app['key'], $this->_app['secret'], $test['oauth_token'], $test['oauth_token_secret']);

        pre($test);

        $t = $sample->getMentionTimeline();
        pre($t);

    }
    /**
     * Check status, if already connected
     * 
     * @return json
     */
    public function status() {
        $orgId  = $this->_organization['_id']->{'$id'};
        //if alread connected
        $twitter = $this->ticket->sourceStatus('twitter', $orgId);
        //if not connected
        if(empty($twitter)) {
            //we get url from 
            $this->_returnData(array(
                'is_connected' => 0,
                'url'    => $this->loginUrl()
            ));
        } 
        //default
        $this->_returnData(array(
            'is_connected' => 1,
            'url' => ''
        ));
    }

    public function callback() {
        //get the temp data
        $temp  = $this->ticket->getToken('twitter', 1);

        $token = eden('twitter')
            ->auth($this->_app['key'], $this->_app['secret'])
            ->getAccessToken($_GET['oauth_token'], $temp['oauth_token_secret'], $_GET['oauth_verifier']);
        
        //lastly, save the token in session
        $this->ticket->saveToken($token, 'twitter');
        $this->closePopup();
    }

    /* Protected Function
    -------------------------------*/

    /* Private Function
    -------------------------------*/
    /**
     * Close the oathpop.js
     *
     * @return mixed
     */
    private function closePopup() {
       
        echo '<script type="text/javascript">window.close();</script>'; exit;
    }

    private function loginUrl() {
        //3 step auth
        //init
        $auth = eden('twitter')->auth($this->_app['key'], $this->_app['secret']);
        //get access token
        $token = $auth->getRequestToken();
        //save token to database
        $this->ticket->saveToken($token, 'twitter', 1);
        //login url
        return $auth->getLoginUrl($token['oauth_token'], $this->_app['url']);   
    }
}




