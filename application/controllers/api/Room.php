<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends API_Controller{
    function __construct()
    {    
        parent::__construct();
        $this->load->model('room_model');
        
    }
    function insert_post(){
        $roomID = $this->post('roomID');
        $location = $this->post('location');
        $buildingID = $this->post('buildingID');
        $result = $this->room_model->insert($roomID,$location,$buildingID);
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
        $roomID = $this->post('roomID');
        $location = $this->post('location');
        $buildingID = $this->post('buildingID');
        $result = $this->room_model->updete($roomID,$location,$buildingID);
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
        $roomID = $this->get('roomID');
        $result = $this->room_model->delete($roomID);
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
        $roomID = $this->get('roomID');
        $result = $this->room_model->get_all($roomID);
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