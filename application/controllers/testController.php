 <?php 
 	// if (!defined('BASEPATH')) exit('No direct script access allowed');	
	// use PhpOffice\PhpSpreadsheet\Spreadsheet;
	// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	
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
			date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
			error_reporting(0);
		}

		public function index(){
			$this->load->view('loginView');
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
			if ($flag=='1') {
				$loginTime= date("d/m/Y (h:i:s A)");
				$sessionData=array(
					'username'=>$enteredData['username'],
					'loginTime'=>$loginTime
				);
				$this->session->set_userdata($sessionData); 
				redirect(base_url()."index.php/testController/view");
			}
			else if($flag=='2'){
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

		public function signup(){
			$data=$this->input->post();
			$insertData=array(
				'username'=>$data['username'],
				'password'=>$data['password']
			);
			if($data['password']==$data['confirmpassword']){
				$flag=$this->testModel->signup($insertData);
				if ($flag) {
					$loginTime= date("d/m/Y (h:i:s A)");
					$sessionData=array(
						'username'=>$insertData['username'],
						'loginTime'=>$loginTime
					);
					$this->session->set_userdata($sessionData);
					redirect(base_url()."index.php/testController/view");
				}
			}
			else{
				$error['data']="Password Mismatch";
				$this->load->view('signupView',$error);
			}
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

			//Bootstrap configs for pagination----------------------------------------------
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
			//------------------------------------------------------------------------------

			$this->pagination->initialize($config);
			$query['data']=$this->testModel->pagination($config['per_page'],$page);
			$this->load->view('mainView',$query);
		}

	 	public function addUserView(){                              
			$this->load->view('addUserView');
		}

		public function addUser(){
			$data=$this->input->post();
			$new_data=array(
				'student_roll_no'=>$data['roll_no'],
				'student_name'=>$data['name'],
				'student_class'=>$data['class'],
				'student_section'=>$data['section']
			);
			$flag=$this->testModel->addUser($new_data);
			if ($flag) {
				redirect(base_url()."index.php/testController/view");
			}
		}

		public function editUserView()	{
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->editUserView($roll_no);
			$this->load->view('editUserView',$query);
		}

		public function editUser(){
			$data=$this->input->post();
			$old_roll_no=$data['old_roll_no'];
			$edited_data=array(
				'student_roll_no'=>$data['roll_no'],
				'student_name'=>$data['name'],
				'student_class'=>$data['class'],
				'student_section'=>$data['section']
			);
			$flag=$this->testModel->editUser($edited_data,$old_roll_no);
			if ($flag) {
				redirect(base_url()."index.php/testController/view");
			}
		}

		public function deleteUserView(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->deleteUserView($roll_no);
			$this->load->view('deleteUserView',$query);
		}

		public function deleteUser(){
			$data=$this->input->post();
			$roll_no=$data['roll_no'];
			$flag=$this->testModel->deleteUser($roll_no);
			if ($flag) {
				redirect(base_url()."index.php/testController/view");
			}
		}

		public function fileUploadView(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->fileUploadView($roll_no);
			$this->load->view('fileUploadView',$query);
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
			$this->load->view('imageUploadView',$query);
		}

		public function imageUpload(){
			$data=$this->input->post();
			$imageName=$_FILES['image']['name'];
            $tempName=explode(".", $imageName);
			$newImageName=round(microtime(true)) . '.' . end($tempName);
			$config['upload_path']='./student_image/';
            $config['allowed_types']='jpeg|jpg|png|svg';
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

		public function viewUserDetails(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->viewUserDetails($roll_no);
			$this->load->view('ViewUserDetails',$query);
		}

		public function searchData(){
			$keyword=$this->input->post('keyword');
			$query['data']=$this->testModel->searchData($keyword);
			$query['flag']=true;
			if ($query['data']==false) {
				$query['err_msg']="No Data Found";
				$this->load->view('mainView',$query);
			}
			else{
				$this->load->view('mainView',$query);
			}
		}

		public function GeneratePdf(){
			if ($this->session->userdata('username')) { 
				$query['data']=$this->testModel->GeneratePdf();
				$this->load->view('pdfView',$query);
				$html = $this->output->get_output();
		        // Load pdf library
				$this->load->library('pdf');
				$this->pdf->loadHtml($html);
				$this->pdf->setPaper('A4', 'landscape');
				$this->pdf->render();
				// Output the generated PDF (1 = download and 0 = preview)
				$this->pdf->stream("html_contents.pdf", array("Attachment"=> 0));
			}
			else{
				$this->load->view('mainView');
			}		
		}

		public function datatable(){
			$this->load->view('datatableView');
		}

		public function get_datatable(){
	      	$draw=intval($this->input->get("draw"));
	      	$start=intval($this->input->get("start"));
	      	$length=intval($this->input->get("length"));
      		$query=$this->testModel->datatable();
	      	$data=[];
	      	foreach($query->result() as$r) {
	           $data[] =array(
	                $r->student_roll_no,
	                $r->student_name,
	                $r->student_class,
	                $r->student_section,
	                $r->student_document,
	                $r->student_image
	           );
	      	}
	      	$result=array(
	            "draw"=>$draw,
                "recordsTotal"=>$query->num_rows(),
                "recordsFiltered"=>$query->num_rows(),
                "data"=>$data
	        );
	      	echo json_encode($result);
	      	exit();
   		}

		// public function sortTable(){
		// 	$data=$this->input->post();
		// 	$sortOption=$data['sort'];
		// 	if ($sortOption=='sortrollnoasc') {
		// 		$query['data']=$this->testModel->sortRollNoAsc();
		// 		$this->load->view('mainView',$query);
		// 	}
		// 	elseif ($sortOption=='sortrollnodesc'){
		// 		$query['data']=$this->testModel->sortRollNoDesc();
		// 		$this->load->view('mainView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortnameasc'){
		// 		$query['data']=$this->testModel->sortNameAsc();
		// 		$this->load->view('mainView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortnamedesc'){
		// 		$query['data']=$this->testModel->sortNameDesc();
		// 		$this->load->view('mainView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortclassasc'){
		// 		$query['data']=$this->testModel->sortClassAsc();
		// 		$this->load->view('mainView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortclassdesc'){
		// 		$query['data']=$this->testModel->sortClassDesc();
		// 		$this->load->view('mainView',$query);	
		// 	}
		// }

		// public function GenerateExcel(){
		// 	if ($this->session->userdata('username')) { 
		// 		$this->load->library('Excel');
		// 		$this->load->library('PHPExcel_IOFactory');
		// 		$object=new PHPExcel();
		// 		$object->setActiveSheetIndex(0);
		// 		$tableColumns=array("Roll Number","Name","Class","Section","Document","Image");
		// 		$column=0;
		// 		foreach($table_columns as $field){
		// 			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
		// 			$column++;
		// 		}
		// 		$excel_row=2;
		// 		foreach($data as $row){
		// 			$object->getActiveSheet()->setCellValueByColumnAndRow(0,'Hello');
		// 			$object->getActiveSheet()->setCellValueByColumnAndRow(1,'Hello');
		// 			$object->getActiveSheet()->setCellValueByColumnAndRow(2,'Hello');
		// 			$object->getActiveSheet()->setCellValueByColumnAndRow(3,'Hello');
		// 			$object->getActiveSheet()->setCellValueByColumnAndRow(4,'Hello');
		// 			$object->getActiveSheet()->setCellValueByColumnAndRow(5,'Hello');
		// 			$excel_row++;
		// 		}
		// 		$object_writer=PHPExcel_IOFactory::createWriter($object,'Excel2007');
		// 		header('Content-Type: application/vnd.ms-excel');
		// 		header('Content-Disposition: attachment;fileName="StudentDetails.xls"');
		// 		$object_writer->save('php://output');
		// 	}
		// 	else{
		// 		$this->load->view('mainView');
		// 	}
		// }

		// public function GenerateSpreadsheet(){
		// 	$this->load->library('PhpOffice/PhpSpreadsheet/Spreadsheet');
		// 	$spreadsheet = new Spreadsheet();
		// 	$sheet = $spreadsheet->getActiveSheet();
		// 	$sheet->setCellValue('A1', 'Hello World !');
		// 	$writer = new Xlsx($spreadsheet);
		// 	$writer->save('hello world.xlsx');
		// }

		// public function pictureUploadView(){
		// 	$this->load->view('pictureUploadView');
		// }

		// public function pictureUpload(){
		// 	$data=$this->input->post();
		// 	$file=$_FILES['picture'];
		// 	$pictureTempPath=$_FILES['picture']['tmp_name']; 
  		//  $pictureContent=addslashes(file_get_contents($pictureTempPath));
		// 	$pictureName=$_FILES['picture']['name'];
	 	//  $tempName=explode(".", $pictureName);
		// 	$newPictureName=round(microtime(true)) . '.' . end($tempName);
  		//  $created_time= date("d/m/Y (h:i:s A)");
  		//  $insertPicture=array(
	  	//  'image'=>$pictureContent,
	  	//  'created_time'=>$created_time
  		//   );
		// 	$this->testModel->pictureUpload($insertPicture);
		// }

		// public function pictureView(){
		// 	$query['data']=$this->testModel->pictureView();
		// 	$this->load->view('pictureView',$query);
		// }
		
	}
 ?>