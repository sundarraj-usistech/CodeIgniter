<?php 
	class mainModel extends CI_model{

		public function __construct(){
			parent::__construct();
		}

		public function loginCheck($data){
			$username=$data['username'];
			$password=$data['password'];
			$this->db->select('password');
			$this->db->from("users");
			$this->db->where('username',$username);
			$query=$this->db->get()->row_array();
			if ($query) {
				if (strcmp($password, $query['password'])==0) {
					return '1';
				}
				else{
					return '2';
				}
			}
			else{
				return '3';
			}
		}

		public function updateLastLogin($sessionData){
			$username=$sessionData['username'];
			$updateData=array(
				'last_login'=>$sessionData['last_login']
			);
			$this->db->set($updateData);
			$this->db->where('username',$username);
			$this->db->update('users',$updateData);
		}

		public function signup($insertData){
			if ($this->db->insert("users",$insertData)){
				return true;
			}
			else{
				return false;
			}
		}

		public function countRows(){
			$query=$this->db->get('student_details');
			return $query->num_rows();
		}

		public function mainView($limit, $offset){
			$this->db->limit($limit);
			$this->db->offset($offset);
			$this->db->order_by('student_roll_no');
			$query=$this->db->get("student_details");
			return $query;
		}

		public function addUser($new_data){
			if ($this->db->insert("student_details",$new_data)){
				return true;
			}
			else{
				return false;
			}
		}

		public function editUserView($roll_no){
			$query=$this->db->get_where("student_details",array('student_roll_no'=>$roll_no));
			return $query;
		}

		public function editUser($edited_data,$old_roll_no){
			$this->db->set($edited_data);
			$this->db->where('student_roll_no',$old_roll_no);
			if ($this->db->update('student_details',$edited_data)){
				return true;
			}
			else{
				return false;
			}
		}

		public function deleteUserView($roll_no){
			$query=$this->db->get_where("student_details",array('student_roll_no'=>$roll_no));
			return $query;
		}

		public function deleteUser($roll_no){
			if ($this->db->delete("student_details" , array('student_roll_no'=>$roll_no))){
				return true;
			}
			else{
				return false;
			}
		}

		public function viewUserDetails($roll_no){
			$query=$this->db->get_where("student_details",array('student_roll_no'=>$roll_no));
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

		public function imageUploadView($roll_no){
			$query=$this->db->get_where("student_details",array('student_roll_no'=>$roll_no));
			return $query;
		}

		public function imageUpload($roll_no,$imgName){
			$this->db->set('student_image',$imgName);
			$this->db->where('student_roll_no',$roll_no);
			if ($this->db->update('student_details')){
				return true;
			}
			else{
				return false;
			}
		}

		public function customPagination($limit, $startFrom){
			$this->db->select('*');
			$this->db->from('student_details');
			$this->db->order_by('student_roll_no');
			$this->db->limit($limit, $startFrom);
			$query=$this->db->get();
			return $query;
		}

		public function searchData($keyword, $limit, $startFrom){
			$this->db->select('*');
			$this->db->from('student_details');
			$this->db->like('student_name',$keyword);
			$this->db->or_like('student_roll_no',$keyword);
			$this->db->or_like('student_class',$keyword);
			$this->db->or_like('student_section',$keyword);
			$this->db->limit($limit, $startFrom);
			$query=$this->db->get();
			$rows=$query->num_rows();
			if ($rows) {
				return $query;
			}
			else{
				return false;
			}	
		}
		
		public function GeneratePdf(){
			$this->db->select('*');
			$this->db->from('student_details');
			$this->db->order_by('student_roll_no');
			$query=$this->db->get();
			return $query;
		}

		public function datatable(){
			$this->db->select('*');
			$this->db->from('student_details');
			$this->db->order_by('student_roll_no');
			$query=$this->db->get();
			return $query;
		}

		public function sortNameAsc(){
			$this->db->select('*');
			$this->db->from('student_details');
			$this->db->order_by('student_name');
			$query=$this->db->get(); 
			return $query;			
		}

		public function sortNameDesc(){
			$this->db->select('*');
			$this->db->from('student_details');                                
			$this->db->order_by('student_name','DESC');
			$query=$this->db->get(); 
			return $query;			
		}

		public function api(){
			$this->db->select('*');
			$this->db->from('student_details');
			$query=$this->db->get();
			return $query->result();
		}

		// public function sortRollNoAsc(){
		// 	$this->db->order_by('student_roll_no');
		// 	$query=$this->db->get("student_details"); 
		// 	return $query;			
		// }

		// public function sortRollNoDesc(){
		// 	$this->db->order_by('student_roll_no','DESC');
		// 	$query=$this->db->get("student_details"); 
		// 	return $query;			
		// }
		
		// public function sortClassAsc(){
		// 	$this->db->order_by('student_class');
		// 	$query=$this->db->get("student_details"); 
		// 	return $query;			
		// }

		// public function sortClassDesc(){
		// 	$this->db->order_by('student_class','DESC');
		// 	$query=$this->db->get("student_details"); 
		// 	return $query;			
		// }

		// public function pictureUpload($insertPicture){
		// 	if($this->db->insert("images",$insertPicture)){
		// 		echo "Success";
		// 	}
		// 	else{
		// 		echo "Failed";
		// 	}
		// }

		// public function pictureView(){
		// 	$query=$this->db->get("images");
		// 	return $query
		// }

	}
?>
 