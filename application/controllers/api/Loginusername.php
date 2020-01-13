<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Loginusername extends BD_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('loginusername_model');
            
        }
        function get_username_student_login_get(){
            $user_id = $this->get('user_id');
            // $roleID = $this->get('roleID');
            $data = $this->loginusername_model->chack_role_username_model($user_id);

            $this->response([
                'status' => true,
                'response' => $data
            ],REST_Controller::HTTP_OK);
        }
    }