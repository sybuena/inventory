<?php //-->

function getOrgImage($data) {

    if(!isset($data['image']) || empty($data['image'])) {
        return '/assets/img/default_avatar_org.png';
    } 
    if(substr($data['image'], 0, 1) != '/') {
        $data['image'] = '/'.$data['image'];
    }
    
    return $data['image'];
}

function getContactsImage($user, $size = 500, $image = true) {

    //if no specific instruction for image
    if(!isset($user['image']) || empty($user['image'])) {
        //use the default
        $imageLink = getGravatar($user['username'], $size, 'mm', 'g', $image);
    }

    //at this point we know there is instruction
    if($user['image'] == 'twitter') {
        $imageLink = getTwitterImage($user['twitter'], $size);
        
        if($image) {
            $imageLink = '<img src="' .$imageLink. '" width="'.$size.'"/>';
        }
    } else if($user['image'] == 'email') {
        $imageLink = 
            '<div class="no-redirect">
                <script src="http://www.avatarapi.com/js.aspx?email='.$user['email'].'&size=200">
                </script>
            </div>';   
    } else {
        $imageLink = getGravatar($user['username'], $size, 'mm', 'g', $image);
    }

    return $imageLink;
}

function getImage($user, $size = 500, $image = false) {

    //if no specific instruction for image
    if(!isset($user['image']) || empty($user['image'])) { 
        //use the default
        $imageLink = getGravatar($user['username'], $size, 'mm', 'g', $image);
    }

    //at this point we know there is instruction
    if($user['image'] == 'twitter') {
        $imageLink = getTwitterImage($user['twitter'], $size);
        
        if($image) {
            $imageLink = '<img src="' .$imageLink. '" width="'.$size.'"/>';
        }
    } else if($user['image'] == 'email') {
        $imageLink = 
            '<div class="no-redirect">
                <script src="http://www.avatarapi.com/js.aspx?email='.$user['username'].'&size=200">
                </script>
            </div>';   
    }
    
    return $imageLink;
}

function getTwitterImage($screenName) {
    return 'https://twitter.com/'.$screenName.'/profile_image?size=original';
}

function getGravatar($email, $s = 80, $d = 'identicon', $r = 'g', $img = false, $atts = array()) {

    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    
    if($img) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val ) {
            $url .= ' ' . $key . '="' . $val . '"';
        }
        $url .= ' />';
    }

    return $url;
}

function money($num, $sign = '₱') {
    
    return $sign.' '.decim($num);
}

function decim($num) {
    
    return number_format($num, 2, '.', ',');
}
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%h hour(s), %i minute(s)');
}

function showImage($info) {
    if(!isset($info['image'])) {
        $explode = explode(' ', $info['company_name']);
        $name = '';
        foreach($explode as $v) {
            $name .= substr($v, 0, 1);
        }
        
       // $name = substr($info['first_name'], 0, 1).substr($info['last_name'], 0, 1);
        $color = 'bgm-red';
       
        return '<div class="lv-avatar '.$color.' pull-left" style="margin-left:0px">'.$name.'</div>';   
    } else {
        return ' <img src="'.$info['image'].'" alt="'.$info['name'].'">';
    }
}

function hardLink($url) {
    
    if($_SERVER['SCRIPT_NAME'] == '/crm/index.php') {
        return base_url().$url;
    } else {
        return $url;
    }
}
function serverPath() {
    if($_SERVER['SCRIPT_NAME'] == '/crm/index.php') {
        return 'live';
    } else {
        return 'local';
    }
}
function loadAssets($assets, $type) {

    if($_SERVER['HTTP_HOST'] == 'tenelleven.com') {
        foreach($assets as $key => $value) {
            echo ($type == 'css') ?
            '<link href="/crm'.$value.'" rel="stylesheet">' :
            '<script type="text/javascript" src="/crm'.$value.'"></script>';     
        }
    } else {
        foreach($assets as $key => $value) {
            echo ($type == 'css') ?
            '<link href="'.$value.'" rel="stylesheet">' :
            '<script type="text/javascript" src="'.$value.'"></script>';     
        }
    }
}

function isMultiArray($array) {
    if(count($array) !== count($array, COUNT_RECURSIVE)) {
        return true;
    } else {
        return false;
    }

}

function formatMoney($value, $format = 0) {
    if(!$format) {
        echo 'PHP '.number_format($value, 2);
    } else {
        echo number_format($value, 2);
    }
}

function show($value, $default = '') {
    if($default == 1) {
        echo isset($value) && !empty($value) ? $value : '<span style="font-style: italic;">not specified</span>';
    } else {
        echo isset($value) && !empty($value) ? $value : $default;
    }
}

function loginData() {
    $CI =& get_instance();
    $user = $CI->session->userdata('has_login');
    
    if(isset($user) && !empty($user)){
        if(empty($user['image'])) {
            $user['image'] =  getImage($user);
        } else {
            $backslash = substr($user['image'], 0, 1);
            //if link has no backslash in first instance
            if($backslash != '/') {
                //we add one
                $user['image'] =  '/'.$user['image'];
            }
        }

        $user['user_role'] = 'Administrator';
        
        if(isset($user['organization']) || !empty($user['organization'])) {
            foreach($user['organization'] as $v) {
                if($v['role'] == 2) {
                    $user['user_role'] = 'Accountant';
                }
            }
        }
        return $user;
    }

    return null;
}

function loginOrg() {
    $CI =& get_instance();
    $org = $CI->session->userdata('has_organization');
    if(isset($org) && !empty($org)){
       return $org['_id']->{'$id'};
    }

    return null;
}
function loginId() {
    $CI =& get_instance();
    $user = $CI->session->userdata('has_login');
    
    if(isset($user) && !empty($user)){
       return $user['_id']->{'$id'};
    }

    return null;
}

function decode($data) {
    return json_decode(json_encode($data), true);
}

function pre($array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function getIpAddress() {
  $ip = getIpAddressFromProxy();

  if($ip) {
      return $ip;
  }

  // direct IP address
  if (isset($_SERVER['REMOTE_ADDR'])) {
      return $_SERVER['REMOTE_ADDR'];
  }
    return '';
}

function getIpAddressFromProxy() {
    $trustedProxies = array();
    $header = 'HTTP_X_FORWARDED_FOR';

    if((isset($_SERVER['REMOTE_ADDR']) && !in_array($_SERVER['REMOTE_ADDR'], $trustedProxies))) {
        return false;
    }

    if (!isset($_SERVER[$header]) || empty($_SERVER[$header])) {
        return false;
    }

    // Extract IPs
    $ips = explode(',', $_SERVER[$header]);
    // trim, so we can compare against trusted proxies properly
    $ips = array_map('trim', $ips);
    // remove trusted proxy IPs
    $ips = array_diff($ips, $trustedProxies);

    // Any left?
    if (empty($ips)) {
        return false;
    }

    // Since we've removed any known, trusted proxy servers, the right-most
    // address represents the first IP we do not know about -- i.e., we do
    // not know if it is a proxy server, or a client. As such, we treat it
    // as the originating IP.
    // @see http://en.wikipedia.org/wiki/X-Forwarded-For
    $ip = array_pop($ips);

    return $ip;
}

function getBrowser()  {
    $u_agent 	= $_SERVER['HTTP_USER_AGENT'];
    $bname 		= 'Unknown';
    $platform 	= 'Unknown';
    $version 	= "";
    $osList 	= array(
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach($osList as $k => $v) {
      //First get the platform?

      if(preg_match($k, $u_agent)) {
          $platform = $v;
          break;
      }

    }
    // //First get the platform?
    // if (preg_match('/linux/i', $u_agent)) {
    //     $platform = 'linux';
    // } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    //     $platform = 'mac';
    // } elseif (preg_match('/windows|win32/i', $u_agent)) {
    //     $platform = 'windows';
    // }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif(preg_match('/Firefox/i',$u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif(preg_match('/Chrome/i',$u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif(preg_match('/Safari/i',$u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif(preg_match('/Opera/i',$u_agent)){
        $bname = 'Opera';
        $ub = "Opera";
    } elseif(preg_match('/Netscape/i',$u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}