<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin_accountUser extends BD_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('admin_accountUser_model');
            
        }

        //showaccountuser
        function showaccountUser_get(){
            $result = $this->admin_accountUser_model->showaccountUser_model();
            $this->response($result); 
        }

        // get update
        function getBeforeaccountUser_get(){
            $user_id = $this->get('user_id');
            $result = $this->admin_accountUser_model->getBeforeaccountUser_model($user_id);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        //update
        function post_updateaccountUser_post(){
            $user_id = $this->post('user_id');
            $username = $this->post('username');
            $password = $this->post('password');
            $data = [
                'user_id' => $user_id,
                'username' => $username,
                'password' => password_hash($this->post("password"), PASSWORD_BCRYPT),
                // password_hash('password', PASSWORD_BCRYPT),
            ];       
            $result = $this->admin_accountUser_model->post_updateuser($data);

            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
            
        }

        // student

        // showaccountUser_student_model
        function showaccountUser_student_get(){
            $result = $this->admin_accountUser_model->showaccountUser_student_model();
            $this->response($result); 
        }

        // delete user
        function get_delete_accountuserid_get(){
            $studentID = $this->get('studentID');
            $user_id = $this->get('user_id');
            $result = $this->admin_showuser_model->delete_accountuser($studentID,$user_id);
            // $this->response($result); 
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

    }