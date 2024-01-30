<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('asset_url()')) {
	function asset_url()
	{
		return base_url() . 'assets/';
	}
}

if (!function_exists('lib_url()')) {
	function lib_url()
	{
		return base_url() . 'lib/';
	}
}

if (!function_exists('admin_url()')) {
	function admin_url()
	{ // adminPortal sub-domain ==================
		return base_url() . 'adminPortal/';
	}
}

if (!function_exists('rs()')) {
	function rs()
	{ // Indian curreny symbol ==================
		return '₹';
	}
}
if (!function_exists('own()')) {
	function own()
	{ // To check its availability ==================
		echo 44;
	}
}

if (!function_exists('random_str()')) {
	function random_str($count = 32)
	{
		//$input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$input = 'ab1c2d3e4f5g6h7i8j9kl1m2n34p5q6r7s8t9uv1w2x3y4z5A6B7C8D9EF1G2H3I4J5K6L7M8N9P1Q2R3S4T5U6V7W8X9YZ';
		$input_length = strlen($input);
		$random_string = '';
		for ($i = 0; $i < $count; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
}

if (!function_exists('strLimit()')) {
	function strLimit($str, $count = 50)
	{
		$out = strlen($str) > $count ? substr($str, 0, $count) . "..." : $str;
		return $out;
	}
}

if (!function_exists('transactioncharges()')) {
	function transactioncharges($amount, $acc_type)
	{
		$charges = 0;
		if ($acc_type != 'upi') {
			$charges = round($amount * 0.025, 2);  // 2.5% Charges
		}
		return $charges;
	}
}

if (!function_exists('random_color()')) {
	function random_color()
	{
		$arr = array('#e84e40', '#ec407a', '#ab47bc', '#7e57c2', '#5c6bc0', '#29b6f6', '#26c6da', '#26a69a', '#2baf2b', '#9ccc65', '#d4e157', '#ffee58', '#ffa726', '#ff7043', '#8d6e63', '#bdbdbd', '#78909c', '#e51c23', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#03a9f4', '#00bcd4', '#009688', '#259b24', '#8bc34a', '#cddc39', '#ffeb3b', '#ff9800', '#ff5722', '#795548', '#9e9e9e', '#607d8b');
		$random_keys = array_rand($arr);
		return $arr[$random_keys];
	}
}

if (!function_exists('poche_reg_addr_proof()')) {
	function poche_reg_addr_proof($proof)
	{
		if ($proof == 'ltdcom') {
			$reg_type = 'Limited Company';
		} elseif ($proof == 'prvltd') {
			$reg_type = 'Private Limited';
		} elseif ($proof == 'partner') {
			$reg_type = 'Partnership';
		} elseif ($proof == 'llp') {
			$reg_type = 'LLP';
		} elseif ($proof == 'gst') {
			$reg_type = 'GST Registered';
		} elseif ($proof == 'dl') {
			$reg_type = 'Driving License';
		} elseif ($proof == 'vote') {
			$reg_type = 'Voter ID';
		} elseif ($proof == 'aad') {
			$reg_type = 'Aadhar Card';
		} elseif ($proof == 'pp') {
			$reg_type = 'Passport';
		} else {
			$reg_type = '';
		}
		return $reg_type;
	}
}

if (!function_exists('txn_status_textclass()')) {
	function txn_status_textclass($status)
	{
		$data = array('text_class' => '', 'text' => '', 'bg_class' => '', 'button_class' => '');
		if ($status == 12) {
			$data = array('text_class' => 'text-success', 'text' => 'Success', 'bg_class' => 'bg-green', 'button_class' => 'btn-success');
		} elseif (in_array($status, array('2', '3', '13'))) {
			$data = array('text_class' => 'text-danger', 'text' => 'Failed', 'bg_class' => 'bg-red', 'button_class' => 'btn-danger');
		} elseif ($status == 'T') {
			$data = array('text_class' => 'text-danger', 'text' => 'Timed Out', 'bg_class' => 'bg-red', 'button_class' => 'btn-danger');
		} elseif ($status == 10) {
			$data = array('text_class' => 'text-warning', 'text' => 'Pending', 'bg_class' => 'bg-orange', 'button_class' => 'btn-warning');
		} elseif ($status == 4) {
			$data = array('text_class' => 'text-warning', 'text' => 'Queued', 'bg_class' => 'bg-orange', 'button_class' => 'btn-warning');
		} elseif ($status == 1 || $status == 9) {
			$data = array('text_class' => 'text-warning', 'text' => 'Initiated', 'bg_class' => 'bg-orange', 'button_class' => 'btn-warning');
		} elseif ($status == 'F') {
			$data = array('text_class' => 'text-danger', 'text' => 'Failed', 'bg_class' => 'bg-red', 'button_class' => 'btn-danger');
		} elseif ($status == 'S') {
			$data = array('text_class' => 'text-success', 'text' => 'Success', 'bg_class' => 'bg-green', 'button_class' => 'btn-success');
		} elseif ($status == 'P') {
			$data = array('text_class' => 'text-warning', 'text' => 'Pending', 'bg_class' => 'bg-orange', 'button_class' => 'btn-warning');
		} elseif ($status == 'Q') {
			$data = array('text_class' => 'text-warning', 'text' => 'Queued', 'bg_class' => 'bg-orange', 'button_class' => 'btn-warning');
		} elseif ($status == 'I') {
			$data = array('text_class' => 'text-warning', 'text' => 'Initiated', 'bg_class' => 'bg-orange', 'button_class' => 'btn-warning');
		}
		return $data;
	}
}

if (!function_exists('check_progress_width()')) {
	function check_progress_width($percentage)
	{
		if ($percentage <= 0) {
			return 0;
		} else if ($percentage > 0 && $percentage <= 5) {
			return 5;
		} else if ($percentage >= 6 && $percentage <= 10) {
			return 10;
		} else if ($percentage >= 11 && $percentage <= 15) {
			return 15;
		} else if ($percentage >= 16 && $percentage <= 20) {
			return 20;
		} else if ($percentage >= 21 && $percentage <= 25) {
			return 25;
		} else if ($percentage >= 26 && $percentage <= 30) {
			return 30;
		} else if ($percentage >= 31 && $percentage <= 35) {
			return 35;
		} else if ($percentage >= 36 && $percentage <= 40) {
			return 40;
		} else if ($percentage >= 41 && $percentage <= 45) {
			return 45;
		} else if ($percentage >= 46 && $percentage <= 50) {
			return 50;
		} else if ($percentage >= 51 && $percentage <= 55) {
			return 55;
		} else if ($percentage >= 56 && $percentage <= 60) {
			return 60;
		} else if ($percentage >= 61 && $percentage <= 65) {
			return 65;
		} else if ($percentage >= 66 && $percentage <= 70) {
			return 70;
		} else if ($percentage >= 71 && $percentage <= 75) {
			return 75;
		} else if ($percentage >= 76 && $percentage <= 80) {
			return 80;
		} else if ($percentage >= 81 && $percentage <= 85) {
			return 85;
		} else if ($percentage >= 86 && $percentage <= 90) {
			return 90;
		} else if ($percentage >= 91 && $percentage <= 95) {
			return 95;
		} else if ($percentage >= 96) {
			return 100;
		}
	}
}


function jwt_webdecode($token)
{
	$jwt = new jwt();

	$d_token = $jwt->decode($token, JWT_SECRETKEY, 'HS256');
	return $letpayid = $d_token->letpayid;
}
function jwt_admindecode($token)
{
	debug($token);
	exit;
	$jwt = new jwt();

	$d_token = $jwt->decode($token, JWT_SECRETKEY, 'HS256');

	return $d_token->adminid;
}
function jwt_decode($token)
{
	$jwt = new jwt();
	$d_token = $jwt->decode($token, JWT_SECRETKEY, 'HS256');

	return $id = $d_token->token;
}

function jwt_exp($token)
{
	$jwt = new jwt();
	$d_token = $jwt->decode($token, JWT_SECRETKEY, 'HS256');

	return $exp = $d_token->exp;
}

function aes128encrypt($data, $type)
{
	$cipher_algo = "AES-128-CTR";
	$iv_length = openssl_cipher_iv_length($cipher_algo);
	$option = 0;
	$iv = '8746376827619797';
	$key = "axisbank12345678";
	if ($type == 'enc') {
		$output = openssl_encrypt($data, $cipher_algo, $key, $option, $iv);
	} elseif ($type == 'dec') {
		$output = openssl_decrypt($data, $cipher_algo, $key, $option, $iv);
	}

	return $output;
}

function formatresponse($res)
{


	$result = array(
		'BRN' => explode('=', $res[0])[1],
		'STC' => explode('=', $res[1])[1],
		'RMK' => explode('=', $res[2])[1],
		'TRN' => explode('=', $res[3])[1],
		'TET' => explode('=', $res[4])[1],
		'PMD' => explode('=', $res[5])[1],
		'RID' => explode('=', $res[6])[1],
		'VER' => explode('=', $res[7])[1],
		'CID' => explode('=', $res[8])[1],
		'TYP' => explode('=', $res[9])[1],
		'CRN' => explode('=', $res[10])[1],
		'CNY' => explode('=', $res[11])[1],
		'AMT' => explode('=', $res[12])[1],
		'CKS' => explode('=', $res[13])[1],

	);
	return $result;
}

function formatstatusresponse($res)
{
	$result = array(
		'VER' => explode('=', $res[0])[1],
		'RID' => explode('=', $res[1])[1],
		'CID' => explode('=', $res[2])[1],
		'TYP' => explode('=', $res[3])[1],
		'CRN' => explode('=', $res[4])[1],
		'BRN' => explode('=', $res[5])[1],
		'CNY' => explode('=', $res[6])[1],
		'AMT' => explode('=', $res[7])[1],
		'STC' => explode('=', $res[8])[1],
		'RMK' => explode('=', $res[9])[1],
		'TRN' => explode('=', $res[10])[1],
		'TET' => explode('=', $res[11])[1],
		'PMD' => explode('=', $res[12])[1],
		'CKS' => explode('=', $res[13])[1],

	);
	return $result;
}

function calculate_merchant_charges($amount, $type, $u_type, $id)
{
	//type  => settle
	//type  => ecart
	$ci = &get_instance();
	$ci->load->library('mongodb');
	$ci->load->library('encryption', NULL, 'enc');
	$db = $ci->mongodb->getConn();
	if ($u_type == "business") {
		$cond = array('bizid' => $id, 'biz_status' => 1);
		$table = 'businessusertable';
	} else {
		$cond = array('userid' => $id, 'status' => 1);
		$table = 'usertable';
	}
	$user = $db->$table->findOne($cond);
	if (isset($user['settlement_charges'])) {
		$settle = $ci->enc->decrypt($user['settlement_charges']);
	} else {
		$settle = 0;
	}

	$res = array();
	if ($type == "settle") {
		$percent = (float)$settle;         //(float)0.25;
		$limit = 20000;
	} elseif ($type == "ecart") {
		$percent = (float)$settle;			//(float)0.99;
		$limit = 5000;
	}



	if ($amount < $limit) {
		$percent = 0;
	}


	$charges = ($percent / 100) * $amount;
	$charges = str_replace(',', '', number_format($charges, 2));


	$settle_amount = $amount - $charges;
	$settle_amount = str_replace(',', '', number_format($settle_amount, 2));
	$res_data = array('settle_amount' => $settle_amount, 'amount' => $amount, 'charges' => $charges);





	return $res_data;
}

function calculate_pg_charges_new($amount, $type, $u_type, $id)
{
	$ci = &get_instance();
	$ci->load->library('mongodb');
	$ci->load->library('encryption', NULL, 'enc');
	$db = $ci->mongodb->getConn();
	if ($u_type == "business") {
		$cond = array('bizid' => $id, 'biz_status' => 1);
		$table = 'businessusertable';
	} else {
		$cond = array('userid' => $id, 'status' => 1);
		$table = 'usertable';
	}
	$user = $db->$table->findOne($cond);
	if (isset($user['pg_charges'])) {
		$pg = $ci->enc->decrypt($user['pg_charges']);
	} else {
		$pg = 0;
	}

	$amount = str_replace(',', '', number_format($amount, 2));
	$limit = 2000;
	if ($type == "business") {
		$percent = $pg;                  //(float)2.40;           
	} elseif ($type == "customer") {
		$percent =  $pg;                 //(float)2.40;
	}
	if ($amount < $limit) {
		$percent = 0;
	}

	$charges = ($percent / 100) * $amount;
	// debug($charges);exit;
	$charges = str_replace(',', '', number_format($charges, 2));
	if ($type == "business") {
		$total_amount = $amount - $charges;
	} else {
		$total_amount = $amount + $charges;
	}
	$total_amount = str_replace(',', '', number_format($total_amount, 2));
	$res_data = array('total_amount' => $total_amount, 'base_amount' => $amount, 'charges' => $charges, 'type' => $type);
	return $res_data;
}



function calculate_pg_charges($amount, $type)
{
	$amount = str_replace(',', '', number_format($amount, 2));
	$limit = 2000;
	if ($type == "ib" || $type == "card") {
		$percent = (float)1.1;

		if ($amount < $limit) {
			$percent = 0;
		}
	} elseif ($type == "upi") {
		$percent = 0;
	}


	$charges = ($percent / 100) * $amount;
	$charges = str_replace(',', '', number_format($charges, 2));

	$total_amount = $amount + $charges;
	$total_amount = str_replace(',', '', number_format($total_amount, 2));
	$res_data = array('total_amount' => $total_amount, 'base_amount' => $amount, 'charges' => $charges, 'type' => $type);
	return $res_data;
}

function acc_type_show($type)
{
	if ($type == 'w') {
		return 'Wallet';
	} elseif ($type == 'wdc') {
		return 'Wallet + CARD';
	} elseif ($type == 'wcc') {
		return 'Wallet + CARD';
	} elseif ($type == 'wupi') {
		return 'Wallet + UPI';
	} elseif ($type == 'wintbank') {
		return 'Wallet + Internet Banking';
	} elseif ($type == 'dc' || $type == 'CD') {
		return 'CARD';
	} elseif ($type == 'cc') {
		return 'CARD';
	} elseif ($type == 'upi') {
		return 'UPI';
	} elseif ($type == 'card') {
		return 'CARD';
	} elseif ($type == 'ib') {
		return 'Internet Banking';
	} elseif ($type == 'AIB' || $type == 'OIB') {
		return 'Net Banking';
	} else {
		return $type;
	}
}

function backgroung_mode($status)
{

	//debug($status);exit;
	$arrmode['mode'] = '';
	$arrmode['modeval'] = $status;
	if ($status == 1) {

		echo $arrmode['mode'] = "<link rel='stylesheet' href='" . asset_url() . "css/darkmode.css'>";
	} else if ($status == 0) {
		echo $arrmode['mode'] = "<style>
				.todoapp {
				  background-color: #fff;
				 }
				</style>";
	}
	return $arrmode;
}

function getmodeApi($token = '')
{

	$cinstance = &get_instance();
	$cinstance->load->library('mongodb');
	$db = $cinstance->mongodb->getConn();

	$profilemode = $db->profilemode;

	$check_device = $db->userdevicetable->findOne(array('token' => (string)$token, 'u_type' => 'business', 'session' => true));
	if (!empty($check_device)) {
		$deviceid = $check_device['deviceid'];

		$profilemode = $profilemode->findOne(array('u_type' => 'app_business', 'deviceid' => $deviceid));
		//debug($profilemode);exit;
		if (!empty($profilemode)) {
			$mode = $profilemode['mode'];
			$arrmode = backgroung_mode($mode);
			return $arrmode;
		}
	}
}

function getcaptcha($check)
{

	$startProcess = curl_init();

	curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

	curl_setopt($startProcess, CURLOPT_POST, true);

	curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));

	curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

	$receiveData = curl_exec($startProcess);

	$finalResponse = json_decode($receiveData, true);

	return $finalResponse;
}



if (!function_exists('verifytoken')) {
	function verifytoken($token)
	{
		$key = 12345;
		$jwt = new JWT();
		$verify = $jwt->decode($token, $key, 'HS256');

		return $verify_json = $jwt->jsonEncode($verify);
	}
}

if (!function_exists('check_admin_session')) {
	function check_admin_session()
	{


		if (isset($_SESSION['last_logged'])) {
			if (time() - $_SESSION['last_logged'] > 18000) {

				redirect('signout');
			} else {
				$_SESSION['last_logged'] = time();

				return true;
			}
		} else {

			return false;
		}
	}
}


function getStatuslabel($data)

{
	$label = ($data == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">In Active</span>';
	return $label;
}


function getnotificationicon($type)
{
	switch ($type) {
		case 'create_category':
			$icon = 'mdi-view-list';
			$bg_color = 'bg-success';
			break;

		default:
			$icon = '';
			$bg_color = '';
			break;
	}

	$result = array('icon' => $icon, 'bg' => $bg_color);
	return $result;
}

if (!function_exists('createSlug()')) {
	function createSlug($string)
	{
		// Convert the string to lowercase
		$string = strtolower($string);

		// Replace spaces with hyphens
		$string = str_replace(' ', '-', $string);

		// Remove special characters
		$string = preg_replace('/[^a-z0-9-]/', '', $string);

		// Remove consecutive hyphens
		$string = preg_replace('/-+/', '-', $string);

		return $string;
	}
}
// Example usage:
