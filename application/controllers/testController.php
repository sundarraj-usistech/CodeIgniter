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
			$data=this->input->post();
			if (this->input->post()) {
				$perPage=$data['page'];
			}
			else{
				$perPage=5;
			}

			$config = array();
			$config['base_url']=base_url()."index.php/testController/index";
			$config['total_rows']=$this->testModel->countRows();
			$config['per_page']=5;
			$config['uri_segment']=$perPage;
			// $config['full_tag_open']='<p>';
			// $config['full_tag_close']='</p>';
			// $config['first_link'] = 'First';
			// $config['first_tag_open'] = '<div>';
			// $config['first_tag_close'] = '</div>';
			// $config['last_link'] = 'Last';
			// $config['last_tag_open'] = '<div>';
			// $config['last_tag_close'] = '<div>';
			// $config['use_page_numbers']=true;
			$this->pagination->initialize($config);
			if($this->uri->segment(3)){
				$page=$this->uri->segment(3);
			}
			else{
				$page=0;
			}
			// $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
			$query['data']=$this->testModel->viewData($config['per_page'],$page);
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
	}
 ?>