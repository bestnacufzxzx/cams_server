<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Showimportteacher extends API_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('showimportteacher_model');
        }
        function get_all_get(){         // all_get || all_post || all_delete
            $keyword = $this->get('keyword');
            $result = $this->showimportteacher_model->get_all($keyword);
            //success
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
            
            //error
            // $this->response([
            //     'status' => false,
            //     'message' => ''
            // ], REST_Controller::HTTP_CONFLICT); 
        }
    }
?>