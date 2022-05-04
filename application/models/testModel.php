<?php 
	class testModel extends CI_model{
		public function __construct(){
			parent::__construct();
		}
		public function viewData(){
			$query=$this->db->get("student_details"); 
			return $query;
		}
		public function addData($new_data){
			if ($this->db->insert("student_details",$new_data)){
				return true;
			}
			else{
				return false;
			}
		}
		public function editDataView($roll_no){
			$query=$this->db->get_where("student_details",array('student_roll_no'=>$roll_no));
			return $query;
		}
		public function editData($edited_data,$old_roll_no){
			$this->db->set($edited_data);
			$this->db->where('student_roll_no',$old_roll_no);
			if ($this->db->update('student_details',$edited_data)){
				return true;
			}
			else{
				return false;
			}
		}
		public function deleteDataView($roll_no){
			$query=$this->db->get_where("student_details",array('student_roll_no'=>$roll_no));
			return $query;
		}
		public function deleteData($roll_no){
			if ($this->db->delete("student_details" , array('student_roll_no'=>$roll_no))){
				return true;
			}
			else{
				return false;
			}
		}
		public function countRows(){
			$query=$this->db->get('student_details');
			return $query->num_rows();
			$this->db->count_all_results();
		}
		public function firstRecord($currentPage, $perPage){
			return ($currentPage-1)*$perPage;
		}
		public function pagination($limit, $offset){
			$this->db->limit($limit);
			$this->db->offset($offset);
			$query=$this->db->get("student_details");
			return $query;
		}
		public function sortRollNoAsc(){
			$this->db->order_by('student_roll_no');
			$query=$this->db->get("student_details"); 
			return $query;			
		}
		public function sortRollNoDesc(){
			$this->db->order_by('student_roll_no','DESC');
			$query=$this->db->get("student_details"); 
			return $query;			
		}
		public function sortNameAsc(){
			$this->db->order_by('student_name');
			$query=$this->db->get("student_details"); 
			return $query;			
		}
		public function sortNameDesc(){
			$this->db->order_by('student_name','DESC');
			$query=$this->db->get("student_details"); 
			return $query;			
		}
		public function sortClassAsc(){
			$this->db->order_by('student_class');
			$query=$this->db->get("student_details"); 
			return $query;			
		}
		public function sortClassDesc(){
			$this->db->order_by('student_class','DESC');
			$query=$this->db->get("student_details"); 
			return $query;			
		}
		public function fileUploadView($roll_no){
			$query=$this->db->get_where("student_details",array('student_roll_no'=>$roll_no));
			return $query;
		}
		public function fileUpload($roll_no,$docName){
			$this->db->set('student_document',$docName);
			$this->db->where('student_roll_no',$roll_no);
			if ($this->db->update('student_details')){
				return true;
			}
			else{
				return false;
			}
		}
	}
 ?>
 