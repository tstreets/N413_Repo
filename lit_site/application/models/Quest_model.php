<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quest_model extends CI_Model {  
    public function __construct() {
        parent::__construct();
        //this causes the database library to be autoloaded
        //loading of any other models would happen here   
    }
    
    public function get_quests_items(){
    	$sql = "SELECT * FROM `quest`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_random_item(){
        $sql = "SELECT * FROM `quest`
                ORDER BY RAND() LIMIT 1";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
}