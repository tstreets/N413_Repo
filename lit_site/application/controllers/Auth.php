<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller { 
 
    public function __construct() {
        parent::__construct();   
        $this->load->model('auth_model');   
    }    
    
    public function index(){
        $data["page_title"] = "Questboard | Login";
        $data["this_page"] = "login";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/login', $data);
    }    

    public function authenticate(){
        $credentials = $this->input->post();
        $messages = $this->auth_model->authenticate($credentials);
        echo json_encode($messages);
    }

    public function logout(){
        $data["page_title"] = "Questboard | Logout";
        $data["this_page"] = "logout";
        $this->session->user_id = 0; //remove the log-in
        $this->session->sess_destroy(); //delete the session variables (for the next page load)
        $this->load->view('templates/head', $data);
        $this->load->view('auth/logout', $data);
    }

    public function register(){
        $data["page_title"] = "Questboard | Register";
        $data["this_page"] = "register";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/register', $data);
    }
}