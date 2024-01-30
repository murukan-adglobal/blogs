<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->library('encryption', NULL, 'enc');
        $this->load->model('AuthModel', 'auth');
        $this->load->model('BlogModel', 'blog');
    }
    public function index()
	{
        if(isset($_SESSION['adminid']) && $_SESSION['adminid']!='')
		{
            redirect('admin/dashboard');
		}
		else
		{
			$this->load->view('login');
		}
		
	}
    public function doLogin()
    {
       
      
        $login = $this->auth->doLogin($_POST);
        echo  json_encode($login, true);
    }
    public function  dashboard()
	{
	   
		if(isset($_SESSION['adminid']) && $_SESSION['adminid']!='')
		{
            $data['blogs']=$this->blog->all_blogs();
			$this->load->view('admin/list_blog',$data);
		}
		else
		{
			 redirect('admin');
		}
		
	}


    public function signout()
    {
        $logout = $this->auth->delete_log_session($this->session->userdata('adminid'),$this->session->userdata('token'));
        if($logout)
        {
            $this->session->sess_destroy();
        }
        
        redirect('admin');
    }
}



