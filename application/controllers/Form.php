<?php
  
   class Form extends CI_Controller { 
	
      public function index() { 
         
         $this->load->helper(array('form'));
			
         $this->load->library('form_validation');
			 
         $this->form_validation->set_rules('username', 'Username', 'required');
         $this->form_validation->set_rules('password', 'Password', 'required');
			
         if ($this->form_validation->run() == FALSE) { 
             $this->load->view('loginView'); 
         } 
         else { 
            echo "hit"; 
         } 
      }
   }
?>
