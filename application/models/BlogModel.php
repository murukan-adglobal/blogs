<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BlogModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FunctionModel', 'fn');
    }
     
	public function fetch_count()
	{
		$query = $this->db->get_where('blogs',array('poststatus' => 'published'));
		$count=$query->num_rows();
		return $count;
	}



    public function fetch_blogs($limit, $start, $slug)
	{


		$res_data = array();
		
	    //    if(empty($slug))
		//    {
			  $this->db->limit($limit, $start);
		//   }
			
		
			     $this->db->like('tag_slug',$slug);
			     $this->db->order_by('datecreated', 'DESC');
		$query = $this->db->get_where('blogs',array('poststatus' => 'active'));
 
		

		if ($query->num_rows() > 0) {
			$result = $query->result_array();

			foreach ($result as $key => $value) {
				
				$tags = explode(',', $value['tag_slug']);
			   
				if (in_array($slug, $tags) || empty($slug)) {
					$data1 = array(
						'title' => $value['title'],
						'slug' => $value['slug'],
						'content' => $value['content'],
						'category' => $value['category'],
						'images' => $value['images'],
						'poststatus' => $value['poststatus'],
						'datecreated' =>  date('F j, Y', $value['datecreated']/1000),
					);

					array_push($res_data, $data1);
				}
			}
		}
		return $res_data;
	}




	public function save_blog($data)
	{



		$result = false;



		$config['upload_path']   = FCPATH . 'uploads/blogs';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = 2048; // 2MB
		$config['encrypt_name']  = TRUE; // Encrypt file name

		$this->load->library('upload', $config);

		$files_data = array();
		$i = 0;
		foreach ($_FILES['featuredImages']['name'] as $key => $filename) {
			$_FILES['featuredImage']['name']     = $_FILES['featuredImages']['name'][$key];
			$_FILES['featuredImage']['type']     = $_FILES['featuredImages']['type'][$key];
			$_FILES['featuredImage']['tmp_name'] = $_FILES['featuredImages']['tmp_name'][$key];
			$_FILES['featuredImage']['error']    = $_FILES['featuredImages']['error'][$key];
			$_FILES['featuredImage']['size']     = $_FILES['featuredImages']['size'][$key];

			if ($this->upload->do_upload('featuredImage')) {
				$upload_data = $this->upload->data();
				$file_data = array(
					'filename' => $upload_data['file_name'],
				);
				$files_data[] = $file_data;
			} else {
				// Handle upload errors
			}
			$i++;
		}



		$image = '';

		foreach ($files_data as $imagedata) {
			// Concatenate the values with a separator
			$image .= implode(', ', $imagedata) . ', ';
		}

		// Remove the trailing comma and space
		$image = rtrim($image, ', ');
		$tags = explode(',', trim($data['tags']));
        $tag_arr= array();
	    foreach ($tags as $key => $tag) {
            $tag_slug= trim(createSlug($tag));

			$data1=array(
				'tag_slug'=>$tag_slug,
			);

			array_push($tag_arr,$data1);
		}

		$tagslug = implode(',', array_map(function($item) {
			return $item['tag_slug'];
		}, $tag_arr));
		
		
    
	
		$res_data = array(
			'title' => $data['title'],
			'slug' => createSlug($data['title']),
			'content' => $data['content'],
			'category' => '',
			'tags' => trim($data['tags']),
			'tag_slug'=>$tagslug,
			'images' => $image,
			'poststatus' => $data['poststatus'],
			'datecreated' => $this->fn->unixDateTime(),
			'createdby' => $_SESSION['adminid']
		);




		$insert = $this->db->insert('blogs', $res_data);
		if ($insert) {
			$result = true;
		}

		return $result;
	}

	public function tags()
	{
		$res_data = array();
		$tag_arr=  array();
		$slug_arr=  array();
		$query = $this->db->get_where('blogs',array('poststatus' => 'active'));
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			
			foreach ($result as $key => $value) {
				if(!empty($value['tags']))
				{
                $tags= explode(',',$value['tags']);
                $slugs= explode(',',$value['tag_slug']);

				foreach ($tags as $key => $tag) {
					$data1= array(
						'tag'=>trim($tag),
					);

					array_push($tag_arr,$data1);
				}

				foreach ($slugs as $key => $slug) {
					$data2= array(
						'slug'=>trim($slug),
					);

					array_push($slug_arr,$data2);
				}

			}

			}

		}

		$unique_tag_Array = array_map("unserialize", array_unique(array_map("serialize", $tag_arr)));
        $tagsArray = array_values($unique_tag_Array);

		$unique_slug_Array = array_map("unserialize", array_unique(array_map("serialize", $slug_arr)));
        $slugsArray = array_values($unique_slug_Array);
       
		$resultArray = array();
        
		foreach ($tagsArray as $key => $tag) {
			$resultArray[] = array(
				'tag' => $tag['tag'],
				'slug' => $slugsArray[$key]['slug']
			);
		}


      

		return $resultArray;
	}


	public function blog_details($slug)
	{
		$result = array();
		 if(empty($slug))
		 {

		 }
		 else
		 {
			 $query=$this->db->get_where('blogs',array('slug'=>$slug));
			 if ($query->num_rows() > 0) {
				$result = $query->result_array();
				
			 }
		 }

		 return $result;
	}


	public function all_blogs()
	{
		$result = array();
		$this->db->order_by('datecreated', 'DESC');
		$query=$this->db->get('blogs');
		if($query->num_rows()>0)
		{
			$result= $query->result_array();
		}

		return $result;
	}

	public function update_status($data)
	{
		$result = false;
        $up_data=array('poststatus'=>$data['status']);
		$this->db->where('id',$data['id']);
		$this->db->update('blogs',$up_data);
		if($this->db->affected_rows()==1)
	    {
             $result= true;
		}
       
		return $result;

	}


	public function delete_blog($id)
	{
		$result=false;
		$this->db->where('id',$id);
		$this->db->delete('blogs');
		if($this->db->affected_rows()==1)
		{
			$result= true;
		}
	}
}
