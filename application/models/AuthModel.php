<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function doLogin($data)
    {
        $response = array();
        $jwt = new jwt();
        $this->db->where('email', $data['email']);
        $result = $this->db->get('adminusertable')->result_array();

        if (!empty($result)) {

            if ($result[0]['password'] == $data['password']) {
                $this->db->where('adminid', $this->session->userdata('adminid'));
                $this->db->where('deviceid', $this->session->userdata('guid'));
                $this->db->where('session', true);
                $check_device = $this->db->get('admindevicetable')->result_array();


                $token_date = new DateTime();
                $token_data = array(
                    'token' => $result[0]['adminid'],
                    'iat' => $token_date->getTimestamp(),
                    'exp' => $token_date->getTimestamp() + 60 * 60 * 5,
                );
                $token = $jwt->encode($token_data, '12345', 'HS256');
                $date = $this->fn->unixDateTime();
                $deviceid = $this->fn->checkguid_session();
                $res_data = array(
                    'adminid' => $result[0]['adminid'],
                    'deviceid' => $deviceid,
                    'token' => $token,
                    'session' => true,
                    'platform' => $this->ua->platform(),
                    'browser' => $this->ua->browser(),
                    'version' => $this->ua->version(),
                    'robot' => $this->ua->robot(),
                    'mobile' => $this->ua->mobile(),
                    'loggedon' => $date,
                    'datecreated' => $date,
                    'createdby' => $result[0]['adminid'],
                    'createdguid' => $deviceid,
                );

                $up_data = array(
                    'adminid' => $result[0]['adminid'],
                    'deviceid' => $deviceid,
                    'token' => $token,
                    'session' => true,
                    'platform' => $this->ua->platform(),
                    'browser' => $this->ua->browser(),
                    'version' => $this->ua->version(),
                    'robot' => $this->ua->robot(),
                    'mobile' => $this->ua->mobile(),
                    'loggedon' => $date,
                    'dateupdated' => $date,
                    'updatedby' => $result[0]['adminid'],
                    'updatedguid' => $deviceid,
                );

                if (!empty($check_device)) {

                    $this->db->update('admindevicetable', $up_data, array('id' => $check_device[0]['id']));
                } else {
                    $this->db->insert('admindevicetable', $res_data);
                }



                $insert = ($this->db->affected_rows() != 1) ? false : true;
                if ($insert) {
                    $sess_data = array('adminid' => $result[0]['adminid'], 'name' => $result[0]['name'], 'mobile' => $result[0]['mobile'], 'email' => $result[0]['email'], 'guid' => $deviceid, 'last_logged' => time(), 'token' => $token);
                    $this->session->set_userdata($sess_data);
                    $response = array('status' => 'success', 'st_code' => 200, 'msg' => 'Logged In');
                }
            } else {
                $response = array('status' => 'error', 'st_code' => 201, 'msg' => 'Invalid Password');
            }
        } else {
            $response = array('status' => 'error', 'st_code' => 201, 'msg' => 'Invalid User');
        }

        return $response;
    }

    public function delete_log_session($adminid,$token){
		

		$this->db->where('adminid',$adminid);
		$this->db->where('token',$token);
		$this->db->where('session',true);
        $check_device = $this->db->get('admindevicetable')->result_array();
        
		if(!empty($check_device)){	
		$this->db->where('adminid',$adminid);
		$this->db->where('session',true);
		$this->db->delete('admindevicetable');

		}

		return true;
		
	}
  
}
