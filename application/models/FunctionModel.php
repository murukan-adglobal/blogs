<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require 'vendor/autoload.php';
// use Aws\Sns\SnsClient;
// use Aws\Credentials\Credentials;
// use Aws\Exception\AwsException;

class FunctionModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	function clientIpAddressInternal()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
		    $ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
		    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
		    $ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		    $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
		    $ipaddress = getenv('REMOTE_ADDR');
		else
		    $ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	function create_guid() { // Create GUID (Globally Unique Identifier)
        $guid = '';
        $namespace = rand(11111, 99999);
        $uid = uniqid('', true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash,  0,  8) . '-' .
                substr($hash,  8,  4) . '-' .
                substr($hash, 12,  4) . '-' .
                substr($hash, 16,  4) . '-' .
                substr($hash, 20, 12);
        return $guid;
    }
	
    function checkguid_session(){
		if(empty($this->session->userdata('guid'))){
			$guid = $this->create_guid();
			$this->session->set_userdata('guid',$guid);
			return $guid;
		}else{
			return $this->session->userdata('guid');
		}
    }
	
	public function unixDateTime() {
		date_default_timezone_set ("UTC");
		$unixdate = (time()*1000);
        return $unixdate;
	}
	
	public function validDate() {
		date_default_timezone_set ("UTC");
		$unixdate = time();
        return $unixdate;
	}
	
	public function expityDate() {
		date_default_timezone_set ("UTC");
		$expirydate = strtotime('+30 minutes', time());
        return $expirydate;
	}
	
	public function todayDate() {
		date_default_timezone_set ("UTC");
		$date = date('c');
		$today = explode('T',$date);
		return $today[0];
	}
	
	public function biz_kyc_type_show($type){
		if($type == 'ltdcom'){
			return 'Limited Company';
		}elseif($type == 'prvltd'){
			return 'Private Limited';
		}elseif($type == 'partner'){
			return 'Partnership';
		}elseif($type == 'llp'){
			return 'LLP';
		}elseif($type == 'gst'){
			return 'GST Registered';
		}else{
			return '';
		}
	}
	
	public function acc_type_show($type){
		if($type=='w'){
			return 'Wallet';
		}elseif($type=='wdc'){
			return 'Wallet + CARD';
		}elseif($type=='wcc'){
			return 'Wallet + CARD';
		}elseif($type=='wupi'){
			return 'Wallet + UPI';
		}elseif($type=='wintbank'){
			return 'Wallet + Internet Banking';
		}elseif($type=='dc'){
			return 'CARD';
		}elseif($type=='cc'){
			return 'CARD';
		}elseif($type=='upi'){
			return 'UPI';
		}elseif($type=='card'){
			return 'CARD';
		}elseif($type=='ib'){
			return 'Internet Banking';
		}else{
			return '';
		}
	}
	
	public function t_type_show($type){
		if($type == 'a'){
			return 'Add Money';
		}elseif($type == 'p'){
			return 'Pay Money';
		}elseif($type == 'upi'){
			return 'UPI Money';
		}elseif($type == 's'){
			return 'Send Money';
		}elseif($type == 'u'){
			return 'Utilities';
		}elseif($type == 'pm'){
			return 'Payments';
		}elseif($type == 'c'){
			return 'Credit Memo';
		}elseif($type == 'r'){
			return 'Refund Amount';
		}elseif($type == 'ecart'){
			return 'LetPay EcART';
		}elseif($type == 'link'){
			return 'link';
		}
		elseif($type == 'local-ite'){
			return 'local-ite';
		}
		elseif($type == 'feepaylink'){
			return 'Fee Payment Link';
		}
		else{
			return '';
		}
	}
	
	function p_type_cat_show($type){
		if($type == 'upi'){
			return 'UPI Money';
		}elseif($type == 'fee'){
			return 'Fees Payment';
		}elseif($type == 'loan'){
			return 'Loan Repayment';
		}elseif($type == 'card'){
			return 'Credit Card Payment';
		}elseif($type == 'rent'){
			return 'Rent Payment';
		}elseif($type == 'memo'){
			return 'Debt Memo Payment';
		}elseif($type == 'recharge'){
			return 'Mobile Recharge';
		}elseif($type == 'dth'){
			return 'DTH Recharge';
		}elseif($type == 'eb'){
			return 'Electricity';
		}elseif($type == 'insure'){
			return 'Insurance Pay';
		}elseif($type == 'pl'){
			return 'Payment Link';
		}elseif($type == 'pur'){
			return 'LetPay EcART';
		}elseif($type == 'biz_refund'){
			return 'Bank Transfer';
		}elseif($type == 'link'){
			return 'Payment Link';
		}
		elseif($type == 'feepaylink'){
			return 'Payment Link';
		}
		else{
			return '';
		}
	}
	
	public function checkEndDate($filter) {
		if($filter == 'month'){
			$e_date = strtotime("-1 month")*1000;
		}elseif($filter == 'year'){
			$e_date = strtotime("-1 year")*1000;
		}elseif($filter == 'week'){
			$e_date = strtotime("-1 week")*1000;
		}else{
			$e_date = strtotime("-1 day")*1000;
		}
		return $e_date;
	}
	
	public function time_ago($time) {

		$diff = time() - (int)$time;
		if ($diff == 0) {
			return 'Just now';
		}
		$intervals = array(
			1 => array('year', 31556926),
			$diff < 31556926 => array('month', 2628000),
			$diff < 2629744 => array('week', 604800),
			$diff < 604800 => array('day', 86400),
			$diff < 86400 => array('hour', 3600),
			$diff < 3600 => array('minute', 60),
			$diff < 60 => array('second', 1)
		);

		$value = floor($diff/$intervals[1][1]);
		$ago = $value.' '.$intervals[1][0].($value > 1 ? 's' : '');
		$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

		$day = $days[date('w', $time)];

		if ($ago == '1 day') {
			return 'Yesterday at '.date('H:i', $time);
		}
		elseif ($ago == '2 days' || $ago == '3 days' || $ago == '4 days' || $ago == '5 days' || $ago == '6 days' || $ago == '7 days') {
			return $day.' at '.date('H:i', $time);
		}
		elseif ($value <= 59 && $intervals[1][0] == 'second' ||  $intervals[1][0] == 'minute' ||  $intervals[1][0] == 'hour') {
			return $ago.' ago';
		}
		else {
			return date('M', $time).' '.date('d', $time).', '.date('Y', $time).' at '.date('H:i', $time);
		}
	}
	
	public function response($code,$msg,$data='')
	{
		if(empty($data)){
			if($code==200){
				$data = array('status'=>'success');
			}else{
				$data = array('status'=>'error');
			}
		}
		$result = array();
		$result['code'] = (int)$code;
		$result['msg'] = $msg;
		return array_merge($result,$data);
	}
	
	public function random_string($count = 9) {
		$input = 'ab1c2d3e4f5g6h7i8j9kl1m2n34p5q6r7s8t9uv1w2x3y4z5A6B7C8D9EF1G2H3I4J5K6L7M8N9P1Q2R3S4T5U6V7W8X9YZ';
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $count; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
	
	public function random_charactes($count = 11) {
		$input = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $count; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
	
	public function float_rand($min, $max, $decimals = 0) {
		$scale = pow(10, $decimals);
		return mt_rand($min * $scale, $max * $scale) / $scale;
	}
	
	public function idIncrement($latest_id,$prefix="")
	{
		$prefix_count = strlen($prefix);
		$id_count = strlen($latest_id);
		$latest_id_count = substr($latest_id,$prefix_count,$id_count);
		$new_latest_id_count = (int)$latest_id_count + 1;
		return $new_latest_id = $prefix.$new_latest_id_count;
	}


	
	public function sendoptsms($message,$mobile,$otp,$country='+91'){
		
		$access_key_id = "AKIA3KH2K6APGRE4VPBQ";
		$secret = "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";
		//$sender_id = "LETPAY"

		$client = new SnsClient([
			'region' => 'ap-south-1',
			'version' => 'latest',
			'credentials' => array(
			        'key'    => $access_key_id,
			        'secret' => $secret,
			)
		]);

		$phone = $country.$mobile;
		
		$payload = [
			'Message'          => $message,
			//'MessageStructure' => 'string',
			'MessageStructure' => 'SMS',
			'PhoneNumber' 	   => $phone,
			'MessageAttributes' => [

				'LETPAY.SNS.SMS.TopicARN' => [
					'DataType' => 'String',
					'StringValue' => 'Default',
				],
				'LETPAY.SNS.SMS.Subscribers.Mobile' => [
					'DataType' => 'String',
					'StringValue' => $phone,
				],	
				'LETPAY.SNS.SMS.SenderID' => [
					'DataType'    => 'String',
					'StringValue' => 'LETPAY',
				],
				'LETPAY.SNS.SMS.SMSType'  => [
				       	'DataType'    => 'String',
				       	'StringValue' => 'Transactional',
				],
			    	'LETPAY.MM.SMS.EntityId' => [
			    		'DataType'    => 'String',
			    		'StringValue' => '1001313140000076955',
			    	],
			    	'LETPAY.MM.SMS.TemplateId' => [
			    		'DataType'    => 'String',
			    		'StringValue' => 'OTP Verification',
			    	],
			    	'LETPAY.MM.SMS.OriginationNumber' => [
			    		'DataType'    => 'String',
			    		'StringValue' => 'Default',
			    	]
			],
		
		];
		// debug($payload);exit;
		  return $result = $client->publish($payload);
		// debug($result);exit;
	}

	
		
	public function sendtxnsms($message,$mobile,$country=91){

		$access_key_id = "AKIA3KH2K6APGRE4VPBQ";
		$secret = "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";

		$client = SnsClient::factory(array(
			'region' => 'ap-south-1',
			'version' => 'latest',
			'credentials' => array(
			        'key'    => $access_key_id,
			        'secret' => $secret
			)
		));

		$phone = '+'.$country.$mobile;

		$payload = [
			'Message'          => $message,
			'MessageStructure' => 'string',
			'PhoneNumber' => $phone,
			'MessageAttributes' => [
			    'AWS.SNS.SMS.SenderID' => [
			        'DataType'    => 'String',
			        'StringValue' => 'LETPAY',
			    ],
			    'AWS.SNS.SMS.SMSType'  => [
			        'DataType'    => 'String',
			        'StringValue' => 'Transactional',
			    ]
			]
		];

		return $result = $client->publish($payload);
		
		}


	
	public function accMasking($no) {
		if(strlen($no)>5){
			return str_repeat('X', strlen($no) - 4) . substr($no, -4);
		}else{
			return '';
		}
	}
	
	public function ccMasking($no) {
		error_reporting(0);
		$str = substr($no, 0, 4) . str_repeat('X', strlen($no) - 8) . substr($no, -4);
		return rtrim(chunk_split($str,4,'-'),'-');
	}
	
	public function mobMasking($no) {
		if(strlen($no)>8){
			return substr($no, 0, 2) . str_repeat('*', strlen($no) - 4) . substr($no, -4);
		}else{
			return '';
		}
	}
	
	public function emailMasking($email) {
		if(!empty($email)){
			$em   = explode("@",$email);
			$name = implode('@', array_slice($em, 0, count($em)-1));
			$len  = floor(strlen($name)/2);
			return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
		}else{
			return '';
		}
	}
	
	public function txnccMasking($no) {
		$new_no = substr($no, 0, 7);
		return  str_repeat('X', strlen($new_no) - 3) . substr($new_no, -4);
	}
	public function upiidMasking($no) {
		if(strlen($no)>3){
			return str_repeat('X', strlen($no) - 6) . substr($no, -6);
		}else{
			return '';
		}
	}
	
	// Function to get the client IP address
	public function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function getBrowser()
	{
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}

		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Trident/i',$u_agent))
		{ // this condition is for IE11
			$bname = 'Internet Explorer';
			$ub = "rv";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}
	   
		// finally get the correct version number
		// Added "|:"
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		 ')[/|: ]+(?<version>[0-9.|a-zA-Z.]*)#';
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
	
	function asRupees($value) {
	  if ($value<0) return "-".$this->asRupees(-$value);
	  //return number_format($value, 2);
	  return number_format($value);
	}
	
	public function getCashback($type,$amt=0,$acc_type = ''){
		/*if($type == 'a'){
			if($amt >=500){
				$cash = rand(0,25);
			}elseif($amt <100){
				$cash = rand(0,5);
			}else{
				$cash = rand(0,15);
			}
		}elseif($type == 'p'){
			if($amt >=500){
				$cash = rand(0,25);
			}elseif($amt <100){
				$cash = rand(0,5);
			}else{
				$cash = rand(0,15);
			}
		}*/
		if($type == 'upi'){
			if($amt >=500){
				$cash = rand(0,25);
			}elseif($amt <100){
				$cash = rand(0,5);
			}else{
				$cash = rand(0,15);
			}
		}elseif($type == 'u'){
			if($amt >=500){
				$cash = rand(0,25);
			}elseif($amt <100){
				$cash = rand(0,5);
			}else{
				$cash = rand(0,15);
			}
		}elseif($type == 'pm'){
			if($amt >=500){
				$cash = rand(0,25);
			}elseif($amt <100){
				$cash = rand(0,5);
			}else{
				$cash = rand(0,15);
			}
		}elseif($type == 'c'){
			if($amt >=500){
				$cash = rand(0,25);
			}elseif($amt <100){
				$cash = rand(0,5);
			}else{
				$cash = rand(0,15);
			}
		}else{
			$cash = 0;
		}
		return $cash;
	}
	
	public function progress_value($wid) {
		if($wid == 0){return 0;}else if($wid>0 && $wid <=5){return 5;}else if($wid>=6 && $wid <=10){return 10;}else if($wid>=11 && $wid <=15){return 15;}else if($wid>=16 && $wid <=20){return 20;}
		if($wid>=21 && $wid <=25){return 25;}else if($wid>=26 && $wid <=30){return 30;}else if($wid>=31 && $wid <=35){return 35;}else if($wid>=36 && $wid <=40){return 40;}
		if($wid>=41 && $wid <=45){return 45;}else if($wid>=46 && $wid <=50){return 50;}else if($wid>=51 && $wid <=55){return 55;}else if($wid>=56 && $wid <=60){return 60;}
		if($wid>=61 && $wid <=65){return 65;}else if($wid>=66 && $wid <=70){return 70;}else if($wid>=71 && $wid <=75){return 75;}else if($wid>=76 && $wid <=80){return 80;}
		if($wid>=81 && $wid <=85){return 85;}else if($wid>=86 && $wid <=90){return 90;}else if($wid>=91 && $wid <=95){return 95;}else if($wid>=96 && $wid <=100){return 100;}
	}
}

?>

