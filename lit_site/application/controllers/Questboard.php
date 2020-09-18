<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questboard extends CI_Controller {  
    public function __construct() {
        parent::__construct();
        $this->load->model('quest_model');    
        $this->load->model('contact_model');    
    }    

    public function index(){
        $data["page_title"] = "Quest Board | Home";
        $data["this_page"] = "home";
        $data["quest"] = $this->quest_model->get_random_item();
        $this->load->view('templates/head', $data);
        $this->load->view('index', $data);
    }
    
    public function quests(){
        $data["page_title"] = "Quest Board | Quests";
        $data["this_page"] = "quests";
        $data["quests"] = $this->quest_model->get_quests_items();
        $this->load->view('templates/head', $data);
        $this->load->view('quests', $data);
    }
    
    public function contact(){
        $data["page_title"] = "Quest Board | Contact";
        $data["this_page"] = "contact";
        $this->load->view('templates/head', $data);
        $this->load->view('contact', $data);
    }
    
    public function contact_post(){
        $contact = $this->input->post();
        $messages = $this->contact_model->contact_post($contact);

        $data["page_title"] = "Quest Board | Contact Confirmation";
        $data["this_page"] = "contact_confirmation";
        $data["messages"] = $messages;
        $this->load->view('templates/head', $data);
        $this->load->view('contact_confirm', $data);
    }

    public function messages(){
        $data["page_title"] = "AMP JAMS | Quest Messages";
        $data["this_page"] = "messages";
        $data["messages"] = $this->contact_model->get_messages();
        $this->load->view('templates/head', $data);
        $this->load->view('messages', $data);
    }
    
}

