<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends API_Controller{
    function __construct()
    {    
        parent::__construct();
        $this->load->model('role_model');
        
    }
    function insert_get(){
        $roleID = $this->get('roleID');
        $roleName = $this->get('roleName');
        $result = $this->role_model->insert($roleID,$roleName);
        if ($result != null)
            {
                $this->response([
                    'status' => true,
                    'response' => $result
                ], REST_Controller::HTTP_OK); 
            }else{
            //error
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
        
        /*error
        $this->response([
            'stetus' => false,
            'massage' => $result
        ], REST_Controller::HTTP_CONFLICT);*/
    }
    function updete_post(){
        $roleID = $this->post('roleID');
        $roleName = $this->post('roleName');
        $result = $this->role_model->updete($roleID,$roleName);
        if ($result != null)
            {
                $this->response([
                    'status' => true,
                    'response' => $result
                ], REST_Controller::HTTP_OK); 
            }else{
            //error
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
        

        /*error
        $this->response([
            'stetus' => false,
            'massage' => $result
        ], REST_Controller::HTTP_CONFLICT);*/
    }
    function delete_get(){
        $roleID = $this->get('roleID');
        $result = $this->role_model->delete($roleID);
        if ($result != null)
            {
                $this->response([
                    'status' => true,
                    'response' => $result
                ], REST_Controller::HTTP_OK); 
            }else{
            //error
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
        

        /*error
        $this->response([
            'stetus' => false,
            'massage' => $result
        ], REST_Controller::HTTP_CONFLICT);*/
    }
    function get_all_get(){
        $roleID = $this->get('roleID');
        $result = $this->role_model->get_all($roleID);
        if ($result != null)
            {
                $this->response([
                    'status' => true,
                    'response' => $result
                ], REST_Controller::HTTP_OK); 
            }else{
            //error
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
        
        /*error
        $this->response([
            'stetus' => false,
            'massage' => $result
        ], REST_Controller::HTTP_CONFLICT);*/
    }
    
}