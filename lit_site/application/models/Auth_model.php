<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Auth_model extends CI_Model {  
        public function __construct() {
            parent::__construct();
            //this causes the database library to be autoloaded
            //loading of any other models would happen here   
        }

        public function authenticate($credentials){
            $messages = array();
            $messages["status"] = 0;
            $messages["role"] = 0;;
            $messages["success"] = "";	
            $messages["failed"] = "";
            
            $username = $credentials["username"];
            $password = $credentials["password"];
        
            $sql = "SELECT * FROM `users` 
                    WHERE username = '".$username."'
                    LIMIT 1";
            $query = $this->db->query($sql);
            $row = $query->row_array();
    
            if($row){
                if(password_verify($password, $row["password"])){
                    $this->session->user_id = $row["id"];
                    $this->session->role = $row["role"];
                }
            }
            
            if($this->session->user_id > 0){
                $messages["status"] = "1";
                $messages["role"] = $this->session->role;
                $messages["success"] = '<h3 class="text-center">You are now Logged In.</h3>';
            }else{
                /* $messages["failed"] = '<h3 class="text-center">The Log-in was not successful.</h3>
                <div class="col-12 text-center"><a href="'.site_url().'/auth"><button type="button" class="btn btn-primary mt-5">Try Again</button></a></div>'; */

                $messages["failed"] = "Entered: " . $password;
            }  
            return $messages;
        }
    }

    