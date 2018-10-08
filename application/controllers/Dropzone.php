<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Dropzone extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'members_model' );
		$this->load->library ( 'form_validation' );
		$this->load->library ( 'myupload' );
		$this->load->library('ftp');
		$this->form_validation->set_error_delimiters ( '<div class="alert alert-danger alert-dismissable" role="alert"> ' . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>' );
	
	}
	public function index() {
		$this->load->view ( 'dropzone_view' );
	}
	public function upload() {
		if (! empty ( $_FILES )) {
			$tempFile = $_FILES ['file'] ['tmp_name'];
			$fileName = $_FILES ['file'] ['name'];
			$targetPath = getcwd () . '/uploads/';
			$targetFile = $targetPath . $fileName;
			move_uploaded_file ( $tempFile, $targetFile );
			// if you want to save in db,where here
			// with out model just for example
			// $this->load->database(); // load database
			// $this->db->insert('file_table',array('file_name' => $fileName));
		}
	}
	
	
	public function uploaded(){
	
		$newname = $this->uri->segment(3,0);
		$newname_file = $this->members_model->make_filename();
		$newfolder = "";
		$CI =& get_instance();
		
		//$config['upload_path'] = './public/uploads/' . $folder . '/';
		$newfolder = $this->db->get('tblpath')->last_row()->path_name;
		$folder = FCPATH.'assets/uploads/itunes/'.$newfolder;
	        	
		
		$config['allowed_types'] = 'png|gif|jpg|jpeg';
		
		$config['max_size'] = '100000';
		
		$config['max_width'] = '100000';
		
		$config['max_height'] = '100000';
		
		
		
		if($this->countFiles($folder) > 10){
			$newfolder = $this->make_new_dir();
		}
		else{
			$newfolder = $newfolder;
		}
		
		$config['upload_path'] = FCPATH.'assets/uploads/itunes/'.$newfolder;
		$CI->load->library('upload', $config);
		$CI->load->library('image_lib');
		$CI->upload->initialize($config);
		
			$file= $_FILES;
		// echo $file['files']['name'][$i]; exit;
			$_FILES['file']['name']=$file['file']['name'];
			$_FILES['file']['type']= $file['file']['type'];
			$_FILES['file']['tmp_name']= $file['file']['tmp_name'];
			$_FILES['file']['error']= $file['file']['error'];
			$_FILES['file']['size']= $file['file']['size'];
			
// 			$tempFile = $_FILES ['file'] ['tmp_name'];
// 			$fileName = $_FILES ['file'] ['name'];
// 			$targetPath = getcwd () . '/uploads/';
// 			$targetFile = $targetPath . $fileName;
// 			move_uploaded_file ( $tempFile, $targetFile );

			
			if ($CI->upload->do_upload('file', $newname_file))
			{
				$other_images = $CI->upload->data();
				$othimage = $other_images['file_name'];
				// print_r($other_images);exit;
				//image resize
				$config['image_library'] = 'gd2';
				$config['source_image'] = $other_images['file_path'].$other_images['raw_name'].$other_images['file_ext'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 800;
				$config['height']   = 600;
				
				$CI->image_lib->clear();
				$CI->image_lib->initialize($config);
				$CI->image_lib->resize();
				
				$db_data = array (
						'add_unique_id' => $newname,
						'original_filename' => $file['file']['name'],
						'folder_name' => $newfolder,
						'ad_pic_path' => str_replace('.', '_thumb.', $other_images['file_name']) 
				);
				//image resize end
				$this->db->insert('ad_pic', $db_data);
		
			}else{
				$error = array('error' => $CI->upload->display_errors());
				print_r($error); exit;
			}
		
	}
	
	
	public function uploaded2(){
	
		$newname = $this->uri->segment(3,0);
		$newname_file = $this->members_model->make_filename();
		$newfolder = "";
		$CI =& get_instance();
	
		//$config['upload_path'] = './public/uploads/' . $folder . '/';
		//$newfolder = $this->db->get('tblpath')->last_row()->path_name;
		$folder = FCPATH.'img/slides';
	
	
		$config['allowed_types'] = 'png|gif|jpg|jpeg';
	
		$config['max_size'] = '100000';
	
		$config['max_width'] = '100000';
	
		$config['max_height'] = '100000';
	
	
	
		
	
		$config['upload_path'] = $folder;
		$CI->load->library('upload', $config);
		$CI->load->library('image_lib');
		$CI->upload->initialize($config);
	
		$file= $_FILES;
		// echo $file['files']['name'][$i]; exit;
		$_FILES['file']['name']=$file['file']['name'];
		$_FILES['file']['type']= $file['file']['type'];
		$_FILES['file']['tmp_name']= $file['file']['tmp_name'];
		$_FILES['file']['error']= $file['file']['error'];
		$_FILES['file']['size']= $file['file']['size'];
			
		// 			$tempFile = $_FILES ['file'] ['tmp_name'];
		// 			$fileName = $_FILES ['file'] ['name'];
		// 			$targetPath = getcwd () . '/uploads/';
		// 			$targetFile = $targetPath . $fileName;
		// 			move_uploaded_file ( $tempFile, $targetFile );
	
			
		if ($CI->upload->do_upload('file', $newname_file))
		{
			$other_images = $CI->upload->data();
			$othimage = $other_images['file_name'];
			// print_r($other_images);exit;
			//image resize
			$config['image_library'] = 'gd2';
			$config['source_image'] = $other_images['file_path'].$other_images['raw_name'].$other_images['file_ext'];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']     = 846;
			$config['height']   = 242;
	
			$CI->image_lib->clear();
			$CI->image_lib->initialize($config);
			$CI->image_lib->resize();
	
			$db_data = array (
					'add_unique_id' => $newname,
					'original_filename' => $file['file']['name'],
					'folder_name' => '',
					'ad_pic_path' => str_replace('.', '_thumb.', $other_images['file_name'])
			);
			//image resize end
			$this->db->insert('ad_pic', $db_data);
	
		}else{
			$error = array('error' => $CI->upload->display_errors());
			print_r($error); exit;
		}
	
	}

	public function make_new_dir( ){
		$folder = $this->db->get('tblpath')->last_row();
		$newfolder = $this->members_model->make_folder();
		if (!is_dir(FCPATH.'assets/uploads/itunes/'.$newfolder)) {
		$done=	mkdir(FCPATH.'assets/uploads/itunes/'.$newfolder, 0777, TRUE);
		
		if($done){
			$this->db->insert('tblpath', array('path_name' => $newfolder, 'full_path' => FCPATH.'assets/uploads/itunes/'.$newfolder.'/'));
			return $newfolder;
		}
		else{
			return $folder->path_name;
		}
		
		}
		
	}
	
	
	
	public function countFiles ($myDir) // Fastest method
	{
		$f = new FilesystemIterator($myDir, FilesystemIterator::SKIP_DOTS);
		return iterator_count($f);
	}
	
	public function DeletePic(){
		$str_data =	$this->input->post('str_data');
		
		$rst = $this->db->get_where('ad_pic', array('original_filename' => $str_data ))->last_row();
	
		if($rst != null){
			unlink(FCPATH.'assets/uploads/itunes/'.$rst->folder_name.'/'.$rst->ad_pic_path);
			unlink(FCPATH.'assets/uploads/itunes/'.$rst->folder_name.'/'.str_replace('_thumb.', '.', $rst->ad_pic_path));
			$this->db->where('original_filename', $str_data)->delete('ad_pic');
			
		}
			
				
		
		
	}
	
	public function getcountry(){
		echo $this->members_model->getCountry();
	}
	
	public function fileupload() {
		$newname = $this->uri->segment(3,0);
		if (isset ( $_FILES ) && $image = $this->myupload->uploadFile ( $_FILES, 'assets/uploads/itunes/', $newname )) {
			
			if (isset ( $image ['error'] ) && $image ['error']) {
				// echo $image['error'];
				//$this->form_validation->set_message ( 'fileupload_validate', $image ['error'] );
				return FALSE;
				// exit;
			} else {
				foreach ( $image as $img ) {
					$db_data [] = array (
							'ad_id' => $this->_mycode,
							'ad_pic_path' => $img 
					);
				}
			}
		}
		
		if ($this->members_model->insert_pic ( $db_data )) {
			return TRUE;
		} else {
			//$this->form_validation->set_message ( 'fileupload_validate', $this->upload->display_errors () );
			return FALSE;
		}
		
		return TRUE;
	}
}