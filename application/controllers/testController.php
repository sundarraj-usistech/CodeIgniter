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
			$perPage=3;
			if($this->uri->segment(3)){
				$page=$this->uri->segment(3);
			}
			else{
				$page=0;
			}
			$config = array();
			$config['base_url']=base_url()."index.php/testController/index";
			$config['total_rows']=$this->testModel->countRows();
			$config['per_page']=$perPage;
			$config['uri_segment']=3;
			
			//Bootstrap configs
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

			$this->pagination->initialize($config);
			$query['data']=$this->testModel->pagination($config['per_page'],$page);
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
		}
	}
 ?>