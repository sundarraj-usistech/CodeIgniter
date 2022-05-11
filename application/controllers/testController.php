 <?php 
	 	
	class testController extends CI_Controller{

		function __construct()
		{
			parent::__construct();
			$this->load->database('student');
			$this->load->model('testModel');
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->library('pagination');
			$this->load->library('upload');
			$this->load->library('form_validation');
			$this->load->library('session');
			error_reporting(0);
		}
		public function index(){
			$this->load->view('loginView');
		}
		public function view(){
			$data=$this->input->post();
			if($data){
				$perPage=$data['per_page'];	
			}
			else{
				$perPage=5;
			}
			if($this->uri->segment(3)){
				$page=$this->uri->segment(3);
			}
			else{
				$page=0;
			}
			$config = array();
			$config['base_url']=base_url()."index.php/testController/view";
			$config['total_rows']=$this->testModel->countRows();
			$config['per_page']=$perPage;
			$config['uri_segment']=3;

			//Bootstrap configs for pagination---------------------------------------------
 				$config['full_tag_open'] = '<ul class="pagination justify-content-center">';        
			    $config['full_tag_close'] = '</ul>';        
			    $config['first_link'] = 'First';        
			    $config['last_link'] = 'Last';        
			    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
			    $config['first_tag_close'] = '</span></li>';        
			    $config['prev_link'] = 'Previous';        
			    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
			    $config['prev_tag_close'] = '</span></li>';        
			    $config['next_link'] = 'Next';        
			    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
			    $config['next_tag_close'] = '</span></li>';        
			    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
			    $config['last_tag_close'] = '</span></li>';        
			    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';        
			    $config['cur_tag_close'] = '</a></li>';        
			    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
			    $config['num_tag_close'] = '</span></li>';
			//-----------------------------------------------------------------------------

			$this->pagination->initialize($config);
			$query['data']=$this->testModel->pagination($config['per_page'],$page);
			$this->load->view('testView',$query);
		}
	 	public function addDataView(){                              
			$this->load->view('testAddView');
			$this->form_validation->set_rules('roll_no', 'Roll Number', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('class', 'Class', 'required');
			$this->form_validation->set_rules('section', 'Section', 'required');
		}
		public function addData(){
			$data=$this->input->post();
			$new_data=array(
				'student_roll_no'=>$data['roll_no'],
				'student_name'=>$data['name'],
				'student_class'=>$data['class'],
				'student_section'=>$data['section']
			);
			$flag=$this->testModel->addData($new_data);
			if ($flag) {
				redirect(base_url()."index.php/testController/view");
			}
		}
		public function editDataView()	{
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->editDataView($roll_no);
			$this->load->view('testEditView',$query);
		}
		public function editData(){
			$data=$this->input->post();
			$old_roll_no=$data['old_roll_no'];
			$edited_data=array(
				'student_roll_no'=>$data['roll_no'],
				'student_name'=>$data['name'],
				'student_class'=>$data['class'],
				'student_section'=>$data['section']
			);
			$flag=$this->testModel->editData($edited_data,$old_roll_no);
			if ($flag) {
				redirect(base_url()."index.php/testController/view");
			}
		}
		public function deleteDataView(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->deleteDataView($roll_no);
			$this->load->view('testDeleteView',$query);
		}
		public function deleteData(){
			$data=$this->input->post();
			$roll_no=$data['roll_no'];
			$flag=$this->testModel->deleteData($roll_no);
			if ($flag) {
				redirect(base_url()."index.php/testController/view");
			}
		}
		// public function sortTable(){
		// 	$data=$this->input->post();
		// 	$sortOption=$data['sort'];
		// 	if ($sortOption=='sortrollnoasc') {
		// 		$query['data']=$this->testModel->sortRollNoAsc();
		// 		$this->load->view('testView',$query);
		// 	}
		// 	elseif ($sortOption=='sortrollnodesc'){
		// 		$query['data']=$this->testModel->sortRollNoDesc();
		// 		$this->load->view('testView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortnameasc'){
		// 		$query['data']=$this->testModel->sortNameAsc();
		// 		$this->load->view('testView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortnamedesc'){
		// 		$query['data']=$this->testModel->sortNameDesc();
		// 		$this->load->view('testView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortclassasc'){
		// 		$query['data']=$this->testModel->sortClassAsc();
		// 		$this->load->view('testView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortclassdesc'){
		// 		$query['data']=$this->testModel->sortClassDesc();
		// 		$this->load->view('testView',$query);	
		// 	}
		// }
		public function fileUploadView(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->fileUploadView($roll_no);
			$this->load->view('testFileUploadView',$query);
		}
		public function fileUpload(){
			$data=$this->input->post();
			$fileName=$_FILES['file']['name'];
            $tempName=explode(".", $fileName);
			$newFileName=round(microtime(true)) . '.' . end($tempName);
			$config['upload_path']='./student_document/';
            $config['allowed_types']='doc|docx|pdf';
            $config['max_size']=2000; // PHP installation has its own limit, as specified in the php.ini file. Usually 2 MB (or 2048 KB) by default.
			$config['file_name']=$data['name'].$newFileName;
			$config['remove_spaces']= FALSE;
			$this->upload->initialize($config); 
			$docName=$config['file_name'];
			$roll_no=$data['roll_no'];    
			if ($this->upload->do_upload('file')){
            	$data = array('upload_data' => $this->upload->data());
            	$flag=$this->testModel->fileUpload($roll_no,$docName);
            	if ($flag) {
            		redirect(base_url()."index.php/testController/view");
            	}
            	else{
            		echo "Upload Error";
            	}  
            }
            else{
                echo $this->upload->display_errors();
            }		 	
		}
		public function imageUploadView(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->imageUploadView($roll_no);
			$this->load->view('testImageUploadView',$query);
		}
		public function imageUpload(){
			$data=$this->input->post();
			$imageName=$_FILES['image']['name'];
            $tempName=explode(".", $imageName);
			$newImageName=round(microtime(true)) . '.' . end($tempName);
			$config['upload_path']='./student_image/';
            $config['allowed_types']='jpeg|jpg|png';
            $config['max_size']=2000;// PHP installation has its own limit, as specified in the php.ini file. Usually 2 MB (or 2048 KB) by default.
			$config['file_name']=$data['name'].$newImageName;
			$config['remove_spaces']= FALSE;
			$this->upload->initialize($config); 
			$imgName=$config['file_name'];
			$roll_no=$data['roll_no'];    
			if ($this->upload->do_upload('image')){
            	$data = array('upload_data' => $this->upload->data());
            	$flag=$this->testModel->imageUpload($roll_no,$imgName);
            	if ($flag) {
            		redirect(base_url()."index.php/testController/view");
            	}
            	else{
            		echo "Upload Error";
            	}  
            }
            else{
                echo $this->upload->display_errors();
            }		 	
		}
		public function viewAllDetails(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->viewAllDetails($roll_no);
			$this->load->view('testViewAllDetails',$query);
		}
		public function searchData(){
			$keyword=$this->input->post('keyword');
			$query['data']=$this->testModel->searchData($keyword);
			$query['flag']=true;
			if ($query['data']=='false') {
				$query['err_msg']="No Data Found";
				$this->load->view('testView',$query);
			}
			else{
				$this->load->view('testView',$query);
			}
		}
		public function loginView(){
			$this->load->view('loginView');
		}
		public function loginCheck(){
			$enteredData=$this->input->post();
			$data=array(
				'username'=>$enteredData['username'],
				'password'=>$enteredData['password']
			);
			$flag=$this->testModel->loginCheck($data);
			if ($flag=='a') {
				$this->session->set_userdata('username',$enteredData['username']); 
				redirect(base_url()."index.php/testController/view");
			}
			else if($flag=='b'){
				$error['data']="Incorrect Password";
				$this->load->view('loginView',$error);
			}
			else{ 
				$error['data']="This Account does not exist";
				$this->load->view('loginView',$error);
			}
		}
		public function logout(){
			$this->session->unset_userdata('username');
			redirect(base_url()."index.php/testController/loginView");
		}
		public function signupView(){
			$this->load->view('signupView');
		}
		public function signupInsert(){
			$data=$this->input->post();
			$insertData=array(
				'username'=>$data['username'],
				'password'=>$data['password']
			);
			if($data['password']==$data['confirmpassword']){
				$flag=$this->testModel->signupInsert($insertData);
				if ($flag) {
					$this->session->set_userdata('username',$data['username']);
					redirect(base_url()."index.php/testController/view?name=".$sessionData['username']);
				}
			}
			else{
				$error['data']="Password Mismatch";
				$this->load->view('signupView',$error);
			}
		}
		function pdfDownload(){
	        $this->load->library('pdf');
	        // $query=$this->db->get('student_details');
	        $html = $this->load->view('pdfView');
	        $this->pdf->createPDF($html, 'mypdf', false);
	    // // $this->load->view('welcome_message');
        
     //    // Get output html
     //    $html = $this->output->get_output();
        
     //    // Load pdf library
     //    $this->load->library('pdf');
        
     //    // Load HTML content
     //    $this->dompdf->loadHtml($html);
        
     //    // (Optional) Setup the paper size and orientation
     //    $this->dompdf->setPaper('A4', 'landscape');
        
     //    // Render the HTML as PDF
     //    $this->dompdf->render();
        
     //    // Output the generated PDF (1 = download and 0 = preview)
     //    $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
    	}
	}
 ?>