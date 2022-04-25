<?php 
	class testModel extends CI_model{
		public function __construct(){
			parent::__construct();
		}
		// public function fetch_departments($limit, $start) {
	 //        $this->db->limit($limit, $start);
	 //        $query = $this->db->get("Departments");
	 //        if ($query->num_rows() > 0) {
	 //           foreach ($query->result() as $row) {
	 //               $data[] = $row;
	 //        }
	 //        	return $data;
	 //        }
	 //      	return false;
  //  		}
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
	}
 ?>
 