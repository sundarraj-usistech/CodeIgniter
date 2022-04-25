<?php 

	class testController extends CI_Controller{

		function __construct()
		{
			parent::__construct();
			$autoload['libraries']=array('student');
			$this->load->helper('url');
		}
		public function index(){
			$this->load->model('testModel');
			$query['data']=$this->testModel->viewData();
			$this->load->view('testView',$query);
		}
	 	public function addDataView(){                              
			$this->load->view('testAddView');
		}
		public function addData(){
			$this->load->model('testModel');
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
			$this->load->model('testModel');
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->editDataView($roll_no);
			$this->load->view('testEditView',$query);
		}
		public function editData(){
			$this->load->model('testModel');
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
				// $this->load->helper('url');
				redirect('http://localhost/CodeIgniter/index.php/testController/');
			}
		}
		public function deleteDataView(){
			$this->load->model('testModel');
			$roll_no=$this->input->get('rollno');
			$query['data']=$this->testModel->deleteDataView($roll_no);
			$this->load->view('testDeleteView',$query);
		}
		public function deleteData(){
			$this->load->model('testModel');
			$data=$this->input->post();
			$roll_no=$data['roll_no'];
			$flag=$this->testModel->deleteData($roll_no);
			if ($flag) {
				// $this->load->helper('url');
				redirect('http://localhost/CodeIgniter/index.php/testController/');
			}
		}
	}
 ?>