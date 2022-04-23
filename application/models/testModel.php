<?php 
	class testModel extends CI_model{
		public function __construct(){
			parent::__construct();
		}
		public function viewData(){
			$query=$this->db->get("student_details"); 
			return $query;
		}
		public function addData($data){
			if ($this->db->insert("student_details",$data)) {
				echo "Successfully Added";
			}	
			else{
				echo "Insert Failed";
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
				echo "Successfully Updated";
			}
			else{
				echo "Update Failed";
			}
		}
		public function deleteData($data){
			if ($this->db->delete("student_details","student_roll_no = '$data'")){
				echo "Successfully Deleted";
			}
			else{
				echo "Delete Failed";
			}
		}
	}
 ?>
 