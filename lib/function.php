<?php
include $_SERVER['DOCUMENT_ROOT']."/lib/class/img.class.php";

// 날짜변환 26-FEB-13 일- 월 - 년
$key = 'nl1609mediconnect09018365khascp6';

function AES_Encode($plain_text)
{
    global $key;
    return base64_encode(openssl_encrypt($plain_text, "aes-256-cbc", $key, true, str_repeat(chr(0), 16)));
}

function AES_Decode($base64_text)
{
    global $key;
    return openssl_decrypt(base64_decode($base64_text), "aes-256-cbc", $key, true, str_repeat(chr(0), 16));
}

function _deg2rad($deg)
{
$radians = 0.0;
$radians = $deg * M_PI/180.0;
return($radians);
}


function geoDistance($lat1, $lon1, $lat2, $lon2, $unit="k")
{
$theta = $lon1 - $lon2;
$dist = sin(_deg2rad($lat1)) * sin(_deg2rad($lat2)) + cos(_deg2rad($lat1)) * cos(_deg2rad($lat2)) * cos(_deg2rad($theta));
$dist = acos($dist);
$dist = rad2deg($dist);
$miles = $dist * 60 * 1.1515;
$unit = strtolower($unit);

if ($unit == "k") {
return ($miles * 1.609344);
} else {
return $miles;
}
}



function date_change($str){
	$change = array(
	'-JAN-'=>'-01-','-FEB-'=>'-02-','-MAR-'=>'-03-','-APR-'=>'-04-','-MAY-'=>'-05-','-JUN-'=>'-06-',
	'-JUL-'=>'-07-','-AUG-'=>'-08-','-SEP-'=>'-09-','-OCT-'=>'-10-','-NOV-'=>'-11-','-DEC-'=>'-12-');

	$result = strtr(strtoupper($str),$change);
	//echo $result."result";
	$tmp = explode("-",$result);

	$result = "20".$tmp[2]."-".$tmp[1]."-".$tmp[0];
	return $result;
}
//푸쉬 함수
function push_phone($ostype, $message, $token, $badge = 1, $menu, $polltype, $snum){

	if( $ostype == 'ios' ){

		// 개발용
		$apnsHost = 'gateway.sandbox.push.apple.com';
		$apnsCert = $_SERVER['DOCUMENT_ROOT'].'/lib/themasher_dev.pem';

		// 실서비스용
		//$apnsHost = 'gateway.push.apple.com';
		//$apnsCert = $_SERVER['DOCUMENT_ROOT'].'/lib/kumc_dev.pem';

		$payload = array('aps' => array('alert' 	=> $message,
														'badge' 	=> $badge,
														'sound' 	=> 'default'
													 ),
													 'menu' => $menu,
													 'polltype' => $polltype,
													 'snum' => $snum
						);
		$payload = json_encode($payload);

		//echo $payload;

		$apnsPort = 2195;
		$streamContext = stream_context_create();
		stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
		$apns = stream_socket_client('ssl://'.$apnsHost.':'.$apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);

		if($apns){
			$apnsMessage = chr(0).chr(0).chr(32).pack('H*', str_replace(' ', '', $token)).chr(0).chr(strlen($payload)).$payload;
			fwrite($apns, $apnsMessage);
			fclose($apns);
			//echo $apns;
		}


	}

	if( $ostype == 'aos' ){

		//gcm token ..

		/** 이부분을 받는 방법을 수정 **/
		$registrationIDs = "$token";

		//echo "aaa";

		$url = 'https://android.googleapis.com/gcm/send';
		/** 이 부분을 주석처리 **
		$fields = array('registration_ids'  => $registrationIDs,
										'data' => array( 'msg' => $message, 'type' => $msg_type, 'snum' => $snum)
									 );
		***/

		/** 새롭게 수정**/
		$fields   = array();
		$fields['data'] = array();
		$fields['data']['snum'] = "$snum";
		$fields['data']['polltype'] = "$polltype";
		$fields['data']['menu'] = "$menu";
		$fields['data']['badge'] = "$badge";
		$fields['data']['alert'] = "$message";
		$fields['registration_ids'] = array();
		$fields['registration_ids'][0] = "$registrationIDs";

		$headers = array(
			'Content-Type:application/json',
			'Authorization:key=AIzaSyAAqZJA1wQPtcRAPWZNUyebiwOQ3VnucuM'
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($fields) );

		$result = curl_exec($ch);

		//echo "re : ".$result;


		if(curl_errno($ch)){ echo 'Curl error: ' . curl_error($ch); }
		curl_close($ch);

	}



}

//썸네일생성
function crateThumImg($img, $data_path, $thumb_path, $img_width = 1000,$img_height = 500, $img_quality = 99, $option = 2)
{
	if (!function_exists("imagecopyresampled")) alert("GD 2.0.1 이상 버전이 설치되어 있어야 사용할 수 있습니다.");

	@mkdir($thumb_path, 0707);
	@chmod($thumb_path, 0707);

	$thumb = $thumb_path.$img;
	// 썸네일 이미지가 존재하지 않는다면
	if (!file_exists($thumb)) {
		$file = $data_path.$img;
		// 업로드된 파일이 이미지라면
		if (preg_match("/\.(jp[e]?g|gif|png)$/i", $file) && file_exists($file)) {
			$size = getimagesize($file);

			if ($size[2] == 1){
				$src = imagecreatefromgif($file);
				$image_ext = "gif";
			}else if ($size[2] == 2){
				$src = imagecreatefromjpeg($file);
				$image_ext = "jpg";
			}else if ($size[2] == 3){
				$src = imagecreatefrompng($file);
				$image_ext = "png";
			}else{
				//break;
			}

			if($option == 1){ // 세로 기준으로 맞춤

				if (($img_width / $img_height) > ($size[0] / $size[1])){	// 세로가 더 긴 이미지
					$rate = $img_height / $size[1];
					$width = (int)($size[0] * $rate);

					// 설정된 이미지 높이로 복사본 이미지 생성
					$dst = imagecreatetruecolor($width, $img_height);
					imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $img_height, $size[0], $size[1]);
					imagejpeg($dst, $thumb_path.$img, $img_quality);
					chmod($thumb_path.$img, 0777);
				} else {	// 가로가 더 긴 이미지
					$rate = $img_height / $size[1];
					$width = (int)($size[0] * $rate);

					// 계산된 썸네일 이미지의 높이가 설정된 이미지의 높이보다 작다면

					// 설정된 이미지 높이로 복사본 이미지 생성
					$dst = imagecreatetruecolor($img_width, $img_height);
					imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $img_height, $size[0], $size[1]);
					imagejpeg($dst, $thumb_path.$img, $img_quality);
					chmod($thumb_path.$img, 0777);
				}

			} else if($option == 2){ // 가로세로 비율 유지
				$rate = $img_width / $size[0];
				$height = (int)($size[1] * $rate);

				// 설정된 이미지 높이로 복사본 이미지 생성
				$dst = imagecreatetruecolor($img_width, $height);
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $img_width, $height, $size[0], $size[1]);
				imagejpeg($dst, $thumb_path.$img, $img_quality);
				chmod($thumb_path.$img, 0777);

			} else if($option == 3) { //설정된 크기로 가운데 크롭
				//원본의 이미지 리소스를 받아온다. 정사각형 크롭
				list($src, $src_w, $src_h) = get_image_resource_from_file ($file);
				if (empty($src)) die($GLOBALS['errormsg'] . "<br />\n");
				$dst_w = $img_width;
				$dst_h = $img_height;
				$dst_200X200 = get_image_cropresize($src, $src_w, $src_h, $dst_w, $dst_h);
				if ($dst_200X200 === false) die($GLOBALS['errormsg'] . "<br />\n");

				$result_save = save_image_from_resource ($dst_200X200, $thumb);//저장
			} else if($option == 4) { //원본사이즈
				$width = $size[0];
				$height = $size[1];

				// 설정된 이미지 높이로 복사본 이미지 생성
				$dst = imagecreatetruecolor($width, $height);
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
				imagejpeg($dst, $thumb_path.$img, $img_quality);
				chmod($thumb_path.$img, 0777);

			}
			else if($option == 5){ // 가로기준 정사각형
					//echo "asdas";
					$rate = $img_width / $size[0];
					$height = (int)($size[1] * $rate);

					// 설정된 이미지 높이로 복사본 이미지 생성
					$dst_200X200 = get_image_cropresize($src, $src_w, $src_h, $dst_w, $dst_h);
					$dst = imagecreatetruecolor($img_width, $height);
					imagecopyresampled($dst, $src, 0, 0, 0, 0, $img_width, $img_height, $img_width, $height);
					imagejpeg($dst, $thumb_path.$img, $img_quality);
					chmod($thumb_path.$img, 0777);


			}
		}
	}

	if (file_exists($thumb)){
		return $thumb;
	}
}


function rotate($src_img, $degrees){

// file size
  list($f_width, $f_height, $f_type, $f_attr) = getimagesize($src_img);

  if($degrees == 180){
	$src_img  = ImageCreateFromjpeg($src_img);
	$dst_img = imagerotate($src_img, $degrees, 0);
  }
  else{ // 90, 270 인 경우..
	  if($f_width > $f_height){
		$size = $f_width;
	  }
	  else{
		$size = $f_height;
	  }

	  //1..
	  $dst_img = imagecreatetruecolor($size, $size);
	  $src_img  = ImageCreateFromjpeg($src_img);  // 지정한 위치에 있는 파일로부터 새로운 이미지 생성..
	  imagecopy($dst_img, $src_img, 0,0,0,0,$f_width,$f_height);
	  $dst_img = imagerotate($dst_img, $degrees, 0);
	  $src_img = $dst_img;

	  //2..
	  $dst_img = imagecreatetruecolor($f_height, $f_width);

	// degrees 와 이미지의 넓이와 높이의 차이에 따라 복사된 이미지의 위치가 틀려짐..

	  if( (($degrees == 90) && ($f_width > $f_height)) || (($degrees == 270) && ($f_width < $f_height)) ){
		imagecopy($dst_img, $src_img, 0,0,0,0,$size,$size);
	  }
	  if(($degrees == 90) && ($f_width < $f_height)){
		imagecopy($dst_img, $src_img, 0,0,0,$size-$f_width,$size,$size);
	  }
	  if(($degrees == 270) && ($f_width > $f_height)){
		imagecopy($dst_img, $src_img, 0,0,$size-$f_height,0,$size,$size);
	  }
  }

  return $dst_img;

} // rotate function end.


function generateRandomPassword($length=8, $strength=0) {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength & 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 2) {
        $vowels .= "AEUY";
    }
    if ($strength & 4) {
        $consonants .= '23456789';
    }
    if ($strength & 8) {
        $consonants .= '@#$%';
    }

    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}

//OS 브라우져 알아내기
function check_agent()
{
    global $HTTP_SERVER_VARS;
    /*-----------------------------------------------------------------
    OS Pattern
    'keyword' => 'name',
    -----------------------------------------------------------------*/
    $OS    = array(
        /* PC */
        array('Android', 'Android'),
        array('Windows CE', 'Windows CE'),
        array('Win98', 'Windows 98'),
        array('Windows 9x', 'Windows ME'),
        array('Windows me', 'Windows ME'),
        array('Windows 98', 'Windows 98'),
        array('Windows 95', 'Windows 95'),
        array('Windows NT 6.0', 'Windows Vista'),
        array('Windows NT 6.1', 'Windows7'),
        array('Windows NT 5.2', 'Windows 2003/XP x64'),
        array('Windows NT 5.01', 'Windows 2000 SP1'),
        array('Windows NT 5.1', 'Windows XP'),
        array('Windows NT 5', 'Windows 2000'),
        array('Windows NT', 'Windows NT'),
        array('Macintosh', 'Macintosh'),
        array('Mac_PowerPC', 'Mac PowerPC'),
        array('Unix', 'Unix'),
        array('bsd', 'BSD'),
        array('Linux', 'Linux'),
        array('Wget', 'Linux'),
        array('windows', 'ETC Windows'),
        array('mac', 'ETC Mac'),
        /* MOBILE */
        array('PSP', 'PlayStation Portable'),
        array('Symbian', 'Symbian PDA'),
        array('Nokia', 'Nokia PDA'),
        array('LGT', 'LG Mobile'),
        array('mobile', 'ETC Mobile'),
		/* WEB ROBOT */
        array('Googlebot', 'GoogleBot'),
        array('OmniExplorer', 'OmniExplorerBot'),
        array('MJ12bot', 'majestic12Bot'),
        array('ia_archiver', 'Alexa(IA Archiver)'),
        array('Yandex', 'Yandex bot'),
        array('Inktomi', 'Inktomi Slurp'),
        array('Giga', 'GigaBot'),
        array('Jeeves', 'Jeeves bot'),
        array('Planetwide', 'IBM Planetwide bot'),
        array('bot', 'ETC Robot'),
        array('Crawler', 'ETC Robot'),
        array('library', 'ETC Robot'),
    );

    /*-----------------------------------------------------------------
    Browser Pattern
    'keyword' => 'name',
    -----------------------------------------------------------------*/
    $BW    = array(
        /* BROWSER */
        array('MSIE 2',    'InternetExplorer 2'),
        array('MSIE 3',    'InternetExplorer 3'),
        array('MSIE 4',    'InternetExplorer 4'),
        array('MSIE 5',    'InternetExplorer 5'),
        array('MSIE 6',    'InternetExplorer 6'),
        array('MSIE 7',    'InternetExplorer 7'),
		array('MSIE 8',    'InternetExplorer 8'),
		array('MSIE 9',    'InternetExplorer 9'),
		array('MSIE 10',    'InternetExplorer 10'),
		array('MSIE 11',    'InternetExplorer 11'),
        array('MSIE', 'ETC InternetExplorer'),
        array('Firefox', 'FireFox'),
        array('Safari', 'Safari'),
        array('Opera', 'Opera'),
        array('Lynx', 'Lynx'),
        array('LibWWW', 'LibWWW'),
        array('Konqueror', 'Konqueror'),
        array('Internet Ninja', 'Internet Ninja'),
        array('Download Ninja', 'Download Ninja'),
        array('WebCapture', 'WebCapture'),
        array('LTH', 'LTH Browser'),
        array('Gecko', 'Gecko compatible'),
        array('Mozilla', 'Mozilla compatible'),
        array('wget', 'Wget command'),
        /* MOBILE */
        array('PSP', 'PlayStation Portable'),
        array('Symbian', 'Symbian PDA'),
        array('Nokia', 'Nokia PDA'),
        array('LGT', 'LG Mobile'),
        array('mobile', 'ETC Mobile'),
        /* WEB ROBOT */
        array('Googlebot', 'GoogleBot'),
        array('OmniExplorer', 'OmniExplorerBot'),
        array('MJ12bot', 'majestic12Bot'),
        array('ia_archiver', 'Alexa(IA Archiver)'),
        array('Yandex', 'Yandex bot'),
        array('Inktomi', 'Inktomi Slurp'),
        array('Giga', 'GigaBot'),
        array('Jeeves', 'Jeeves bot'),
        array('Planetwide', 'IBM Planetwide bot'),
        array('bot', 'ETC Robot'),
        array('Crawler', 'ETC Robot'),
    );
    foreach($OS as $val)
    {
        if(eregi($val[0], $_SERVER['HTTP_USER_AGENT']))
        {
            $os_name    = $val[1];
            break;
        }
    }
    foreach($BW as $val)
    {
        if(eregi($val[0], $_SERVER['HTTP_USER_AGENT']))
        {
            $br_name    = $val[1];
            break;
        }
    }
    $res    = array(
        'os' => $os_name,
        'br' => $br_name
    );
    return $res;
}

//아이피로 접속ㄴ나라 구하기

function convert_ip($ip) {
    list($w,$x,$y,$z) = split('[.]',$ip);
    $ipnum = 16777216*$w + 65536*$x + 256*$y + $z;
    return $ipnum;
}

// 세션이 없을 경우 리디렉션 시켜준다.
function sessNullBack($sessVal, $msg="")
{
    if ($sessVal=="")
    {
        if ($msg=="")
            $msg = "로그인을 하셔야 이용하실 수 있는 페이지입니다.";
        error($msg);
        exit;
    }
}


/**
 * $_GET / $_POST 등의 인자 받고, 변수로 담는 코드를 생성해준다.
 * 주로 process / CRUD 페이지에 사용.
 */
function request($type="REQUEST")
{
    $request = $type=="get"?$_GET:$_POST;

    $type = strtoupper($type);

    foreach ($request as $key => $value)
    {
        echo $request[$key] = "\$".$key." = \$_".$type."['".$key."'];<br>";
    }
}

function request_log($type="REQUEST")
{
    $request = $type=="get"?$_GET:$_POST;

    $type = strtoupper($type);

	$text = "";
    foreach ($request as $key => $value)
    {
        $text .= "\$".$key." = {$value}\n";
    }
	return $text;

}


/**
 * Long url to short url exchange
 */
function shorten($longUrl="")
{
    // initialize. https://www.googleapis.com/urlshortener/v1/url?shortUrl=http://goo.gl/fbsS&key=AIzaSyCKLZ6sU-w9l_-MgEPfSkjtpSMH_ZXygwQ
    //https://www.googleapis.com/urlshortener/v1/             url?shortUrl=http://goo.gl/fbsS&key=AIzaSyDpKTRL6tSxZwmmv-ggk2nIRpHSTmHFcZ0
    $ch = curl_init();
    $GOOGLE_API_KEY = "AIzaSyDpKTRL6tSxZwmmv-ggk2nIRpHSTmHFcZ0";
    $googleUrl = "https://www.googleapis.com/urlshortener/v1/url?key=".$GOOGLE_API_KEY;

    curl_setopt($ch, CURLOPT_URL, $googleUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $jsonArray = array('longUrl' => $longUrl);
    curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($jsonArray));

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
    //return $result;
}


/**
* cut string in utf-8
* @author gony (http://mygony.com)
* @param $str source string
* @param $len cut length
* @param $checkmb if this argument is true, function treat multibyte character as two bytes. default value is false.
* @param $tail abbreviation symbol
* @return string processed string
*/
function strcut_utf8($str, $len, $checkmb=false, $tail='...')
{
    preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);

    $m      = $match[0];
    $slen   = strlen($str); // length of source string
    $tlen   = strlen($tail); // length of tail string
    $mlen   = count($m); // length of matched characters

    if ($slen <= $len) return $str;
    if (!$checkmb && $mlen <= $len) return $str;

    $ret = array();
    $count = 0;

    for ($i=0; $i < $len; $i++)
    {
        $count += ($checkmb && strlen($m[$i]) > 1)?2:1;
        if ($count + $tlen > $len) break;
        $ret[] = $m[$i];
    }

    return join('', $ret).$tail;
}

/**
 * Send Mail
 * @author Dongkkase (http://eyecandyzero.tistory.com)
 * @param $sender_mail: Are sending the mail
 * @param $sender_name: Sending this
 * @param $to: Recipients of the mail
 * @param $subject: Subject
 * @param $content: Content
 * @example send_mail("admin@able.com", "관리자", "user@gmail.com", "subject", "content");
 */
function send_mail($sender_mail, $sender_name="", $to, $subject="", $content="")
{
    $content = str_replace('\"', "\"", $content);

    $sender_name=$sender_name;
    $sender_mail=$sender_mail;
    $check_email = preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $sender_mail);

    $header  = "Return-Path: {$sender_name} \n";
    $header .= "From: {$sender_name} <{$sender_mail}> \n";
    $header .= "Reply-to: {$sender_mail} \n";
    $header .= "X-Mailer: PHP \n";
    $header .= "X-Priority: 1\n";
    $header .= "Content-Type: text/html; charset=utf-8 \r\n";

    ini_set('sendmail_from', $sender_mail); //Suggested by "Some Guy"
    if( $sender_mail != "" && $check_email ){
        if( $subject != "TAC 문의합니다." ){
            return mail($to,$subject,$content,$header);
        } else {
            return false;
        }
    } else {
        return false;
    }
}


/**
 * Exchange Character Set
 * @author Dongkkase (http://eyecandyzero.tistory.com)
 * @param $arr: target array
 * @param $in_str: '$arr' of the character
 * @param $out_str: Output
 * @example $_POST = param_iconv($_POST,"UTF-8","EUC-KR");
 */
function param_iconv($arr,$in_str="UTF-8",$out_str="EUC-KR")
{
    if (strtoupper(gettype($arr)) == "ARRAY")
    {
        foreach($arr as $key => $value)
        {
            $arr[$key] = iconv($in_str, $out_str, $value);
        }
    }
    else if (strtoupper(gettype($arr)) == "OBJECT")
    {
        foreach($arr as $key => $value)
        {
            $arr->$key = iconv($in_str, $out_str, $value);
        }
    }
    else
    {
        $arr = iconv($in_str, $out_str, $arr);
    }
    return $arr;
}


function create_input($table="")
{
    global $db;
    $tablename = $table;
    $column = $db->get_results("desc $tablename");

    $i = 0;
    foreach($column as $data)
    {
        echo "&lt;tr&gt;<br/>";
        echo "&lt;th&gt;".$data->Field."&lt;/th&gt;<br/>";
        echo "&lt;td&gt;&lt;input type=\"text\" name=\"".$data->Field."\" class=\"text\"/&gt;&lt;/td&gt;<br/> ";
        echo "&lt;/tr&gt;<br/>";
    }
}

function create_param($table="", $name="row")
{
    global $db;
    $tablename = $table;
    $column = $db->get_results("desc $tablename");

    $i = 0;
    foreach($column as $data)
    {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&#36;".$data->Field." = &#36;{$name}->".$data->Field.";<br/>";
    }
}

function create_params($table="")
{
    global $db;
    $tablename = $table;
    $column = $db->get_results("desc $tablename");

    $i = 0;
    foreach($column as $data)
    {
        echo "&#36;sub_list['".$data->Field."'] = &#36;data->".$data->Field.";<br/>";
    }
}

//$json["content_text"] = $content_text;
function create_param_json($table="")
{
    global $db;
    $tablename = $table;
    $column = $db->get_results("desc $tablename");

    $i = 0;
    foreach($column as $data)
    {
        echo "&#36;json['".$data->Field."'] = &#36;".$data->Field.";<br/>";
    }
}


/**
 * Insert query code created(only mysql)
 * @author Dongkkase (http://eyecandyzero.tistory.com)
 * @param $table: table name
 * @example insert_query("Table Name");
 */
function insert_query($table="")
{
    global $db;
    $tablename = $table;
    $column = $db->get_results("desc $tablename");

    $i = 0;
    foreach($column as $data)
    {
        $pk = $data->Key;
        if($pk != "PRI")
        {
            ($i > 0) ? $colum .= "&nbsp;&nbsp;&nbsp;&nbsp;, ". trim($data->Field):$colum .= trim($data->Field);
            $colum .="<br/>";
            $i++;
        }
    }

    $query = "INSERT INTO $tablename<br/>(<br/>&nbsp;&nbsp;&nbsp;&nbsp;";
    $query .= $colum.")<br/>VALUES<br/>(<br/>";

    $i = 1;
    foreach($column as $data)
    {
        if($data->Key != "PRI")
        {
            ($i == 1)?
            $query .="&nbsp;&nbsp;&nbsp;&nbsp;'&#36;".$data->Field."'<br/>"
            :
            $query .="&nbsp;&nbsp;&nbsp;&nbsp;,'&#36;".$data->Field."'<br/>";
            $i++;
        }
    }
    $query .=")";
    echo $query;
}

/**
 * Update query code created(only mysql)
 * @author Dongkkase (http://eyecandyzero.tistory.com)
 * @param $table: table name
 * @example update_query("Table Name");
 */
function update_query($table="")
{
    global $db;
    $tablename = $table;
    $column = $db->get_results("desc $tablename");
    $query="UPDATE $tablename SET <br/>";
    $i = 1;
    foreach($column as $data)
    {
        $pk = $data->Key;
        if($pk == "PRI")
        {
            $pimarikey = $data->Field;
        }
        else
        {
            if($i == 1)
            {
                $query .="&nbsp;&nbsp;&nbsp;&nbsp;".$data->Field." = '&#36;".$data->Field."'<br/>";
            }
            else
            {
                $query .="&nbsp;&nbsp;&nbsp;&nbsp;,".$data->Field." = '&#36;".$data->Field."'<br/>";
            }
            $i++;
        }
    }
    $query .="WHERE $pimarikey = '$".$pimarikey."'";
    echo $query;
}

// 배열타입의 값이나. 개발자가 작성한 쿼리 찍어 볼때 사용.
function pre($str)
{
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}

/**
 * Value is encode or decode
 * @author Dongkkase (http://eyecandyzero.tistory.com)
 * @param $str: value
 * @example encode(value);
 * @example decode(value);
 * @example encode($row->idx);
 */
function encode($str)
{
    return base64_encode(urlencode(urlencode(urlencode(strrev(base64_encode($str))))));
}

function decode($str)
{
    return base64_decode(strrev(urldecode(urldecode(urldecode(base64_decode($str))))));
}


// 페이지 해당 폴더경로 얻어오기
function includeDir(){
    $dirPath = $_SERVER['PHP_SELF'];

    // $spath = split("/", $dirPath);
    // os x를 쓰면서 버전 문제로 인해  split to explode 로 수정.
    $spath = explode("/", $dirPath);

    if(count($spath) <= 3)
    {
        return "undefined";
        exit;
    }

    $rdir = $spath[count($spath) - 2];
    $spath = $spath[count($spath) - 1];

    $dirPath = str_replace($spath, "", $dirPath);

    return $dirPath.$rdir;
}
function confirm($msg="",$url1="",$url2="")
{
	$MSG = "";
    $MSG .= "<script>";
    if ($msg != "")
    {
        $MSG .= "if(confirm('".$msg."'))";
    }
	if ($url1 != "")
    {
        $MSG .= "{location.href='".$url1."';}";
    }
	if ($url2 != "")
    {
        $MSG .= "else {location.href='".$url2."';}";
    }

    $MSG .= "</script>";

    echo $MSG;
}

function error($msg="",$url="")
{

    $MSG = "";
    $MSG .= "<script>";
    if ($msg != "")
    {
        $MSG .= "alert('".$msg."');";
    }
    if ($url=="")
    {
        $MSG .= "history.back();";
    }
    else if ($url=="close")
    {
        $MSG .= "self.close();";
    }
    else if ($url=="close_refresh")
    {
        $MSG .= "opener.location.reload();";
        $MSG .= "self.close();";
    }
	else if ($url=="iframe")
    {
        $MSG .= "parent.location.reload();";
    }

    else
    {
        $MSG .= "location.href='".$url."';";
    }
    $MSG .= "</script>";

    echo $MSG;
}


function select($value, $controll)
{
    if($value==$controll)
    {
        return "selected=\"selected\"";
    }
}

function check($value, $controll)
{
    if($value==$controll)
    {
        return "checked=\"checked\"";
    }
}
function checks($value, $controll)
{

	if(strpos($controll,$value) !== false)
	{
		return "checked=\"checked\"";
	}

}


// 컨텐츠부분의 특수문자를 교체.
function html_to_code_content($str)
{
    $bbcode = array(
        //"/\</is" => "&lt;",
        //"/\>/is" => "&gt;",
        "/\(/is" => "&#40;",
        "/\)/is" => "&#41;",
        "/\#/is" => "&#35;",
        "/\&/is" => "&#38;",
        "/\'/is" => "&#39;",
        "/\"/is" => "&#34;",
        "/\;/is" => "&#59;"
    );
    $str = preg_replace(array_keys($bbcode), array_values($bbcode), $str);
    return $str;
}

// 제목부분의 특수문자를 교체.
function html_to_code_subject($str)
{
    $bbcode = array(
        //"/\</is" => "&lt;",
        //"/\>/is" => "&gt;",
        "/\(/is" => "&#40;",
        "/\)/is" => "&#41;",
        "/\#/is" => "&#35;",
        "/\&/is" => "&#38;",
        "/\'/is" => "&#39",
        "/\"/is" => "&#34",
        "/\;/is" => "&#59;"
    );
    $str = preg_replace(array_keys($bbcode), array_values($bbcode), $str);
    return $str;
}

function popup_seting()
{
    global $db;
    $sql = "select * from popup_config where popup_flag = 'on'";
    $res = $db->get_results($sql);

    if ($res)
    {
        $HTML = "
            <style>
            .popup_bx{display:none;position:absolute; padding:0px;}
            </style>
        ";
        foreach ($res as $data)
        {
            $idx = $data->popup_idx;
			$width = $data->popup_width;
			$width += 80;

            $HTML .= "
            <script>
            $(document).ready(function(){

                if ($.cookie('popup_$idx')!='1')
                {
                    $('#popup_$idx').fadeIn('300');
                }

                $('.popup_close_$idx').click(function(){
                    $('#popup_$idx').fadeOut('300');
                });

                $('.btn_popTodayClose_$idx').click(function(){
                    $('#popup_$idx').fadeOut('300');
                    $.cookie('popup_$idx', '1', { expires: 1});
                });

            });
            </script>
            <div id='popup_$idx' class='popup_bx' style='z-index:".($data->popup_sorts*10)."; top:".$data->popup_position_x."px; left:".$data->popup_position_y."%;'>
				<table cellpadding='0' cellspacing='0' class='pop_tb' style='width:".$width."px;'>
				<colgroup>
					<col width='40'>
					<col width='".$width."'>
					<col width='40'>
				</colgroup>
				<tr>
					<td class='pop_header_left'> </td>
					<td class='pop_header_center'><img src='/image/site/popup/title.png'></td>
					<td class='pop_header_right'><img src='/image/site/popup/round.png'></td>
				</tr>
				<tr class='pop_body'>
					<td class='pop_body_left'> </td>
					<td class='pop_body_center' style='height:".$data->popup_height."px;'>".$data->popup_content."</td>
					<td class='pop_body_right'> </td>
                </tr>
				<tr class='pop_footer'>
					<td class='pop_footer_left'>
						<div style='width:40px; height:10px;'> </div>
					</td>
					<td class='pop_footer_center'>
						<div style='float:left; padding-left:0px;'>
							<span class='btn_popTodayClose_$idx' style='cursor:pointer; padding-right:10px;'>[하루동안닫기]</span>
							<span class='popup_close_$idx' style='cursor:pointer;'>[닫기]</span>

						</div>

					</td>
					<td class='pop_footer_right'>
						<div style='width:40px; height:10px;'> </div>
					</td>

				</tr>
				</table>
            </div>
            ";
        }
    }
    echo $HTML;
}

?>
