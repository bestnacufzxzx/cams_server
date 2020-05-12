<?php
    // defined('BASEPATH') OR exit('No direct script access allowed');
    // header('Access-Control-Allow-Origin: *');
    // header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    class Profile extends BD_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('profile_model');

        }

        function getprofilebystudent_get(){
            $user_id = $this->get('user_id');
            $result = $this->profile_model->getprofilebystudent_model($user_id);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        function getprofilebylecturers_get(){
            $user_id = $this->get('user_id');
            $result = $this->profile_model->getprofilebylecturers_model($user_id);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        function getprofilebyadmin_get(){
            $user_id = $this->get('user_id');
            $result = $this->profile_model->getprofilebyadmin_model($user_id);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        

        function updateprofilebystudent_post(){
            $user_id = $this->post('user_id');
            $prefix = $this->post('prefix');
            $firstName = $this->post('firstName');
            $lastName = $this->post('lastName');
            $email = $this->post('email');
            $phone = $this->post('phone');
            $username = $this->post('username');
            $password = $this->post('password');
            $date_users = [
                'user_id' => $user_id,
                'prefix' => $prefix,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'phone' => $phone,
                'email' => $email,
            ];
            if($password){
                $data_user = [
                    'user_id' => $user_id,
                    'username' => $username,
                    'password' => password_hash($this->post("password"), PASSWORD_BCRYPT)
                ];       
            }else{
                $data_user = [
                    'user_id' => $user_id,
                    'username' => $username,
                ];    
            }
            
            $result_roleID = $this->profile_model->getrolebyusers_model($user_id);
            foreach ($result_roleID as $i => $v) {
                $roleID = $v->roleID;
            }
            
            if($roleID  == 1 ){
                $result = $this->profile_model->updateprofilebyadmin_model($date_users);
            }else if($roleID  == 4 || $roleID  == 5 || $roleID  == 6 ){
                $result = $this->profile_model->updateprofilebylecturer_model($date_users);
            }else if($roleID == 7){
                $result = $this->profile_model->updateprofilebystudent_model($date_users);
            }
            
            $result = $this->profile_model->post_updateuser_users($data_user);


            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
            
        }

        function getrole_post() {
            // $user_id = $this->get('user_id');
            // $result = $this->profile_model->getrolebyusers_model($user_id);
            // $this->response($result);

            $user_id = $this->post("user_id");
            $result = $this->profile_model->getrolebyusers_model($user_id);
            foreach ($result as $i => $v) {
                $roleID = $v->roleID;
            }
            $this->response($roleID);
        }

    }
?>