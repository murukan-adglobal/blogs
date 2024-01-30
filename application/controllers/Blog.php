<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{


	public function __construct()
	{

		parent::__construct();
		$this->load->library('session');
		$this->load->library('encryption', NULL, 'enc');
		$this->load->model('BlogModel', 'blog');
		$this->load->library('pagination');
	}

	public function create_blog()
	{
		if(isset($_SESSION['adminid']) && $_SESSION['adminid']!='')
		{
			$this->load->view('admin/create_blog');
		}
		else
		{
			 redirect('admin');
		}
	
		
	}



	public function index()
	{
		$data['tags'] = $this->blog->tags();

		$this->load->view('index', $data);
	}
	public function indexbk()
	{
		

		$perPage=3;
		$config['base_url'] = base_url();
		$page=0;

		if($this->input->get('page'))
		{
			$page = $this->input->get('page');
		}

		$start_index=0;
		if($page != 0)
		{
			$start_index = $perPage * ($page - 1);
		}

		$total_rows = 0;
		$slug='';
		
		// if($this->input->get('search_text') != null) {
		// 	$search_text = $this->input->get('search_text');
		// 	$this->data['users'] = $this->my_model->getSearchUsers($perPage,$start_index,$search_text,$is_count=0);
		// 	$total_rows = $this->my_model->getSearchUsers(null,null,$search_text,$is_count=1);
		// }
		// else 
		// {
			$this->data['blogs'] = $this->blog->fetch_blogs($perPage,$start_index,$slug);
			//  $total_rows = $this->my_model->getSearchUsers(null,null,null,$is_count=1);
			 $total_rows=  $this->blog->fetch_count();
		// }

		// debug($this->data['blogs']);die;
		$config['total_rows'] = $total_rows;

		$config['per_page']= $perPage;
		$config['enable_query_strings']= true;
		$config['use_page_numbers']= true;
		$config['page_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['reuse_query_string']= true;
		$config['full_tag_open']= '<ul  class="pagination">';
		$config['full_tag_close']= '</ul'>
		$config['first_link']= 'First';
		$config['last_link']= 'Last';
		$config['first_tag_open']=  '<li  class="page-item"><spann class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['prev_link']= '&laquo';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';

		$config['prev_tag_close'] = '</span></li>';
		$config['next_link']= '&raquo';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>'; 

		$this->pagination->initialize($config);
		$this->data['page'] =$page;
		$this->data['links']= $this->pagination->create_links();
		$this->data['tags'] = $this->blog->tags();
		$this->load->view('index',$this->data);
	}


	public function load_more($offset = 0, $slug = '')
	{



		if (isset($_GET['slug'])) {
			$slug = $_GET['slug'];
		}

		$limit = 9;

		$data['blogs'] = $this->blog->fetch_blogs($limit, $offset, $slug);
		$data['blog_count']=count($data['blogs']);
		$data['total_count']=$this->blog->fetch_count();
		$data['limit']=$limit;

		
        echo json_encode($data);



		// $this->load->view('blogs', $data);
	}




	public function save_blog()
	{

		$this->form_validation->set_rules('title', 'Blog Title', 'required');
		$this->form_validation->set_rules('content', 'Blog Content', 'required');
		

		    if($this->form_validation->run() == FALSE) {
				$result_json = array('status' => 'error','msg' => validation_errors(),'st_code'=>400);
			}else {	

		      $data = $this->blog->save_blog($_POST);
			  $result_json = array('status' => 'success','msg' => 'Blog Created Successfully','st_code'=>200);
			}
		echo json_encode($result_json);
	}

	public function blog_details()
	{
		$slug=$this->uri->segment(2);
		$data['blog_details']=$this->blog->blog_details($slug);
		$this->load->view('blogs_details',$data);
	}



	public function update_status()
	{
		$data=$this->blog->update_status($_POST);
		if($data)
		{
			$result_json = array('status' => 'success','msg' => 'Status Updated','st_code'=>200);
		}
		else
		{
			$result_json = array('status' => 'error','msg' => 'Something went wrong','st_code'=>400);
		}
		echo json_encode($result_json);
	}

	public function delete_blog()
	{
		if(isset($_GET['id']))
		{
			$delete= $this->blog->delete_blog($_GET['id']);
		}

		redirect('admin/dashboard');
	}
	
}
