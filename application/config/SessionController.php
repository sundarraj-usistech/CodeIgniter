<?php

class SessionController extends CI_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        
        $this->load->view('sessions/index');
    }
    
    public function flash_message(){
        $this->session->set_flashdata('msg', ' Session Message');
        redirect(base_url('flash_index'));
    }
}