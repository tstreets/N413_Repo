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
                $messages["failed"] = '<h3 class="text-center">The Log-in was not successful.</h3>
                <div class="col-12 text-center"><a href="'.site_url().'/auth"><button type="button" class="btn btn-primary mt-5">Try Again</button></a></div>';
            }  
            return $messages;
        }

        public function new_account($credentials){
            $messages = array();
            $messages["status"] = 0;
            $messages["errors"] = 0;
            $messages["username_length"] = "";
            $messages["password_length"] = "";
            $messages["username_exists"] = "";
            $messages["email_exists"] = "";
            $messages["email_validate"] = "";
            $messages["success"] = "";
            $messages["failed"] = ""; 
                       
            $username = $credentials["username"];
            $email = $credentials["email"];
            $password = $credentials["password"];
                
            trim($username); //delete leading and trailing spaces
            if(strlen($username) < 5){
                $messages["errors"] = 1;
                $messages["username_length"] = "The username must have at least 5 characters.";
            }else{
                $username = $this->db->escape_str($username);
            }
      
            if (! filter_var($email, FILTER_VALIDATE_EMAIL)){
                $messages["errors"] = 1;
                $messages["email_validate"] = "There are problems with the e-mail address.  Please correct them.";
            }
                
            trim($password); //delete leading and trailing spaces          
            if(strlen($password) < 8){
                $messages["errors"] = 1;
                $messages["password_length"] = "The password must have at least 8 characters.";
            }else{
                $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
                if($encrypted_password){ 
                    $password = $encrypted_password; 
                }else{
                $messages["errors"] = 1;
                $messages["password_length"] = "Password encryption failed.  You cannot register at this time";
                }
            } 
        
            if( ! $messages["errors"] ){
                $sql = "SELECT * FROM `users` WHERE username = '".$username."'";
                $query = $this->db->query($sql);
                if($query->num_rows() > 0){
                    $messages["errors"] = 1;
                    $messages["username_exists"] = "This username already exists.  Please select another username.";
                }
        
                $sql = "SELECT * FROM `users` WHERE email = '".$email."'";
                $query = $this->db->query($sql);
                if($query->num_rows() > 0){
                    $messages["errors"] = 1;
                    $messages["email_exists"] = "This email is already in use.  You cannot register another account with this email address.";
                }
            }
            
            if( ! $messages["errors"] ){
                $sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) 
                        VALUES (NULL, '".$username."', '".$email."', '".$password."', '0')";
                $query = $this->db->query($sql);
            
                $user_id = $this->db->insert_id();
                if($user_id){
                    $this->session->user_id = $user_id;
                    $this->session->role = 0;
                } // if($user_id)
            }  // if( ! $messages["errors"] )  
        //	
            if($this->session->user_id > 0){
                $messages["status"] = "1";
                $messages["success"] = '<h3 class="text-center">You are now Registered and Logged In.</h3>';
            }else{
                $messages["failed"] = '<h3 class="text-center">The Registration was not successful.</h3><div class="col-12 text-center"><a href="'.site_url().'/auth/register" class="text-center"><button class="btn btn-primary mt-5">Try Again</button></a></div>';
            }
            return $messages;		
        }
    }

    