 <?php 
 	// if (!defined('BASEPATH')) exit('No direct script access allowed');	
	// use PhpOffice\PhpSpreadsheet\Spreadsheet;
	// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	
	class mainController extends CI_Controller{

		function __construct()
		{
			parent::__construct();
			$this->load->database('student');
			$this->load->model('mainModel');
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
			if ($this->session->userdata('username')) {
				$this->view();
			}
			else{
				$this->load->view('loginView');
			}
		}

		public function loginView(){
			$this->form_validation->set_rules('username','User Name','required');
			$this->form_validation->set_rules('password','Password','required');
			if ($this->form_validation->run() == FALSE){
					$this->load->view('loginView');

            }
		}

		public function loginCheck(){
			$enteredData=$this->input->post();
			$data=array(
				'username'=>$enteredData['username'],
				'password'=>$enteredData['password']
			);
			$flag=$this->mainModel->loginCheck($data);
			if ($flag=='1') {
				$loginTime= date("d/m/Y (h:i:s A)");
				$sessionData=array(
					'username'=>$enteredData['username'],
					'last_login'=>$loginTime
				);
				$this->session->set_userdata($sessionData); 
				$this->mainModel->updateLastLogin($sessionData);
				redirect(base_url()."mainController/view");
			}
			else if($flag=='2'){
				$error['err_msg']="Incorrect Password";
				$this->load->view('loginView',$error);
			}
			else{ 
				$error['err_msg']="This Account does not exist";
				$this->load->view('loginView',$error);
			}
		}

		public function logout(){
			$this->session->unset_userdata('username');
			redirect(base_url()."mainController/loginView");
		}

		public function signupView(){
			$this->form_validation->set_rules('username','User Name','required|min_length[5]|max_length[15]|is_unique[users.username]|regex_match[/^[A-Z a-z 0-9 _]+$/]');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('confirmpassword','Confirm Password', 'required|matches[password]');
			if ($this->form_validation->run() == FALSE){
				$this->load->view('signupView');
			}

		}

		public function signup(){
			$data=$this->input->post();
			$insertData=array(
				'username'=>$data['username'],
				'password'=>$data['password']
			);
			if($data['password']==$data['confirmpassword']){
				$flag=$this->mainModel->signup($insertData);
				if ($flag) {
					$loginTime= date("d/m/Y (h:i:s A)");
					$sessionData=array(
						'username'=>$insertData['username'],
						'last_login'=>$loginTime
					);
					$this->session->set_userdata($sessionData);
					$this->mainModel->updateLastLogin($sessionData);
					redirect(base_url()."mainController/view");
				}
			}
			else{
				$error['err_msg']="Password Mismatch";
				$this->load->view('signupView',$error);
			}
		}

		// public function paginationConfig(){

		// 	$pageValue=$this->input->post('perPage');

		// 	if ($pageValue) {
		// 		$perPage=$pageValue;
		// 	}
		// 	else{
		// 		$perPage=5;
		// 	}

		// 	if($this->uri->segment(3)){
		// 		$page=$this->uri->segment(3);
		// 	}
		// 	else{
		// 		$page=0;
		// 	}

		// 	$config = array();
		// 	$config['base_url']=base_url()."mainController/view";
		// 	$config['total_rows']=$this->mainModel->countRows();
		// 	$config['per_page']=$perPage;
		// 	$config['uri_segment']=3;

		// 	//Bootstrap configs for pagination----------------------------------------------
 	// 			$config['full_tag_open'] = '<ul class="pagination justify-content-center">';        
		// 	    $config['full_tag_close'] = '</ul>';        
		// 	    $config['first_link'] = 'First';        
		// 	    $config['last_link'] = 'Last';        
		// 	    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
		// 	    $config['first_tag_close'] = '</span></li>';        
		// 	    $config['prev_link'] = 'Previous';        
		// 	    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
		// 	    $config['prev_tag_close'] = '</span></li>';        
		// 	    $config['next_link'] = 'Next';        
		// 	    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
		// 	    $config['next_tag_close'] = '</span></li>';        
		// 	    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
		// 	    $config['last_tag_close'] = '</span></li>';        
		// 	    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';        
		// 	    $config['cur_tag_close'] = '</a></li>';        
		// 	    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
		// 	    $config['num_tag_close'] = '</span></li>';
		// 	//-------------------------------------------------------------------------------

		// 	$this->pagination->initialize($config);

		// 	$configData=array(

		// 		'perPage'=>$config['per_page'],
		// 		'page'=>$page

		// 	);
		// 	return $configData;
		// }   		

		public function view(){

			$perPage=5;

			if($this->uri->segment(3)){
				$page=$this->uri->segment(3);
			}
			else{
				$page=0;
			}

			$config = array();
			$config['base_url']=base_url()."mainController/view";
			$config['total_rows']=$this->mainModel->countRows();
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
			//-------------------------------------------------------------------------------

			$this->pagination->initialize($config);
			$query['data']=$this->mainModel->mainView($config['per_page'],$page);
   			$this->load->view('mainView',$query);
		}

	 	public function addUserView(){  
	 		$this->session->set_flashdata("alert", "You are about to create a New User Details !");                        
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
			$flag=$this->mainModel->addUser($new_data);
			if ($flag) {
				redirect(base_url()."mainController/view");
			}
		}

		public function editUserView()	{
			$this->session->set_flashdata("alert", "You are about to Edit this Person's Details !");
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->mainModel->editUserView($roll_no);
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
			$flag=$this->mainModel->editUser($edited_data,$old_roll_no);
			if ($flag) {
				redirect(base_url()."mainController/view");
			}
		}

		public function deleteUserView(){
			$this->session->set_flashdata("alert", "You are about to Delete this Person's Details !");
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->mainModel->deleteUserView($roll_no);
			$this->load->view('deleteUserView',$query);
		}

		public function deleteUser(){
			$data=$this->input->post();
			$roll_no=$data['roll_no'];
			$flag=$this->mainModel->deleteUser($roll_no);
			if ($flag) {
				redirect(base_url()."mainController/view");
			}
		}

		public function viewUserDetails(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->mainModel->viewUserDetails($roll_no);
			$this->load->view('ViewUserDetails',$query);
		}

		public function fileUploadView(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->mainModel->fileUploadView($roll_no);
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
            	$flag=$this->mainModel->fileUpload($roll_no,$docName);
            	if ($flag) {
            		redirect(base_url()."mainController/view");
            	}
            	else{
            		$error['err_msg']="Upload Error";
            		$this->load->view('fileUploadView',$error);
            	}  
            }
            else{
				$error['err_msg']=$this->upload->display_errors();
				$this->load->view('fileUploadView',$error);               
            }		 	
		}

		public function imageUploadView(){
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->mainModel->imageUploadView($roll_no);
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
            	$flag=$this->mainModel->imageUpload($roll_no,$imgName);
            	if ($flag) {
            		redirect(base_url()."mainController/view");
            	}
            	else{
            		$error['err_msg']="Upload Error";
            		$this->load->view('fileUploadView',$error);
            	}  
            }
            else{
                $error['err_msg']=$this->upload->display_errors();
				$this->load->view('fileUploadView',$error);
            }		 	
		}

		public function customPagination(){
   			$data=$this->input->get('perPage');
			if($data){
				$perPage=$data;	
			}
			else{
				$perPage=5;
			}
			$page=$this->input->get('page');
			if($page){
				$currentPage=$page;
			}
			else{
				$currentPage=1;
			}
			$startFrom=($currentPage-1)*$perPage;
			$rowCount=$this->mainModel->countRows();
			$totalPages=ceil($rowCount/$perPage);
			$query['data']=$this->mainModel->customPagination($perPage,$startFrom);
			$query['custompage']=true;
			$query['totalPages']=$totalPages;
			$query['perPage']=$perPage;
			$query['flag']=true;			
			$this->load->view('mainView',$query);
   		}

		public function searchData(){
			$keyword=$this->input->post('keyword');
			$query['data']=$this->mainModel->searchData($keyword, $perPage, $startFrom);
			

			if ($query['data']==false) {
				$query['err_msg']="No Data Found";
				$this->load->view('mainView',$query);
			}
			else{
	   			$data=$this->input->get('perPage');

				if($data){
					$perPage=$data;	
				}
				else{
					$perPage=5;
				}

				$page=$this->input->get('page');

				if($page){
					$currentPage=$page;
				}
				else{
					$currentPage=1;
				}

				$rowCount=$query['data']->num_rows();
				$startFrom=($currentPage-1)*$perPage;
				$totalPages=ceil($rowCount/$perPage);

				$query['flag']=true;
				$query['totalPages']=$totalPages;
				$query['perPage']=$perPage;

				$this->load->view('mainView',$query);
			}
		}

		public function GeneratePdf(){
			if ($this->session->userdata('username')) { 
				$query['data']=$this->mainModel->GeneratePdf();
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
      		$query=$this->mainModel->datatable();
	      	$data=[];

	      	foreach($query->result() as $r) {
	           $data[] =array(
	                $r->student_roll_no,
	                $r->student_name,
	                $r->student_class,
	                $r->student_section,
	               	'<a href="/CodeIgniter/student_document/'.$r->student_document.'" target="_blank" style="text-decoration: none;">'.$r->student_document.'</a>',
	               	'<a href="/CodeIgniter/student_image/'.$r->student_image.'" target="_blank" style="text-decoration: none;">'.$r->student_image.'</a>'
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

   		public function sortByName(){

   			$action=$this->input->get('action');

   			$startFrom=$pageConfig['startFrom'];
   			$perPage=$pageConfig['perPage'];

   			if($action=='asc'){
   			    $query['data']=$this->mainModel->sortNameAsc();
   			    $query['flag']=true;
   			    $query['custompage']=true;
   			}
   			else{
   			    $query['data']=$this->mainModel->sortNameDesc();
   			    $query['flag']=true;
   			    $query['custompage']=true;
   			}
			$this->load->view('mainView',$query);

   		}

   		public function test(){
   			$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required',
                    array('required' => 'You must provide a %s')
            );
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
   			if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('testView');

                }
                else
                {
                    echo "Success	";
                }
   		}

   		public function api(){
   			$data=$this->mainModel->api();
   			echo json_encode($data);
   		}
		// public function sortTable(){
		// 	$data=$this->input->post();
		// 	$sortOption=$data['sort'];
		// 	if ($sortOption=='sortrollnoasc') {
		// 		$query['data']=$this->mainModel->sortRollNoAsc();
		// 		$this->load->view('mainView',$query);
		// 	}
		// 	elseif ($sortOption=='sortrollnodesc'){
		// 		$query['data']=$this->mainModel->sortRollNoDesc();
		// 		$this->load->view('mainView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortnameasc'){
		// 		$query['data']=$this->mainModel->sortNameAsc();
		// 		$this->load->view('mainView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortnamedesc'){
		// 		$query['data']=$this->mainModel->sortNameDesc();
		// 		$this->load->view('mainView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortclassasc'){
		// 		$query['data']=$this->mainModel->sortClassAsc();
		// 		$this->load->view('mainView',$query);	
		// 	}
		// 	elseif ($sortOption=='sortclassdesc'){
		// 		$query['data']=$this->mainModel->sortClassDesc();
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
		// 	$this->mainModel->pictureUpload($insertPicture);
		// }

		// public function pictureView(){
		// 	$query['data']=$this->mainModel->pictureView();
		// 	$this->load->view('pictureView',$query);
		// }

	
	}
 ?>