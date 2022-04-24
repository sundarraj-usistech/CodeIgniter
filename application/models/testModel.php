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
			$query=$this->db->insert("student_details",$new_data);
			if ($query==true){
				echo "Successfully Added";
			}
			else{
				echo "Add User Failed";
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
		public function deleteDataView($roll_no){
			$query=$this->db->get_where("student_details",array('student_roll_no'=>$roll_no));
			return $query;
		}
		public function deleteData($roll_no){
			$query=$this->db->delete("student_details" , array('student_roll_no'=>$roll_no));
			if ($query==true){
				echo "Successfully Deleted";
			}
			else{
				echo "Delete Failed";
			}
		}
	}
 ?>
 