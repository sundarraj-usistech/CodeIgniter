<?php 

	class testController extends CI_Controller{

		function __construct()
		{
			parent::__construct();
			$autoload['libraries']=array('student');
			$this->load->helper('url');
			$this->load->model('testModel');
			$this->load->library('pagination');
		}
		public function index(){
			$query['data']=$this->testModel->viewData();
			$this->load->view('testView',$query);
		}
	 	public function addDataView(){                              
			$this->load->view('testAddView');
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
				
				redirect('http://localhost/CodeIgniter/index.php/testController/');
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
				redirect('http://localhost/CodeIgniter/index.php/testController/');
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
				redirect('http://localhost/CodeIgniter/index.php/testController/');
			}
		}
		// public function pagination(){
		// 	$data=$this->input->get();
		// 	if ($data) {
		// 		$perPage=$data['page'];
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
		// 	$config['base_url']=base_url()."index.php/testController/index";
		// 	$config['total_rows']=$this->testModel->countRows();
		// 	$config['per_page']=$perPage;
		// 	$config['uri_segment']=3;
		// 	$this->pagination->initialize($config);
		// 	$query['data']=$this->testModel->viewData($config['per_page'],$page);
		// }
		public function sortTable(){
			$data=$this->input->post();
			$sortOption=$data['sort'];
			if ($sortOption=='sortrollnoasc') {
				$query['data']=$this->testModel->sortRollNoAsc();
				$this->load->view('testView',$query);
			}
			elseif ($sortOption=='sortrollnodesc'){
				$query['data']=$this->testModel->sortRollNoDesc();
				$this->load->view('testView',$query);	
			}
			elseif ($sortOption=='sortnameasc'){
				$query['data']=$this->testModel->sortNameAsc();
				$this->load->view('testView',$query);	
			}
			elseif ($sortOption=='sortnamedesc'){
				$query['data']=$this->testModel->sortNameDesc();
				$this->load->view('testView',$query);	
			}
			elseif ($sortOption=='sortclassasc'){
				$query['data']=$this->testModel->sortClassAsc();
				$this->load->view('testView',$query);	
			}
			elseif ($sortOption=='sortclassdesc'){
				$query['data']=$this->testModel->sortClassDesc();
				$this->load->view('testView',$query);	
			}
			// public function filter(){
			// 	$data=$this->input->post();
			// 	$filterOption=$data['filter'];
			// 	if ($filterOption=='filterbyclass') {
			// 		$query['data']=$this->testModel->();
			// 		$this->load->view('testView',$query);
			// 	}
			// 	elseif ($filterOption=='filterbysection') {
			// 		$query['data']=$this->testModel->();
			// 		$this->load->view('testView',$query);
			// 	}

			// }
		}
	}
 ?>