<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Building extends API_Controller{
    function __construct()
    {    
        parent::__construct();
        $this->load->model('building_model');
    }
    function insert_get(){
        $buildingID = $this->get('buildingID');
        $buildingName = $this->get('buildingName');
        $result = $this->building_model->insert($buildingID,$buildingName);
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
    function updete_get(){
        $buildingID = $this->get('buildingID');
        $buildingName = $this->get('buildingName');
        $result = $this->building_model->updete($buildingID,$buildingName);
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
        $buildingID = $this->get('buildingID');
        $result = $this->building_model->delete($buildingID);
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
        $buildingID = $this->get('buildingID');
        $result = $this->building_model->get_all($buildingID);
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