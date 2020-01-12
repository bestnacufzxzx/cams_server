<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin_teaching extends BD_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('admin_teaching_model');
            
        }

        // function get_teaching_get(){
        //     $result = $this->admin_teaching_model->get_teaching_model($courseID);
        //     $this->response($result); 
        // }

        function get_teaching_get(){
            $courseID = $this->get('courseID');
            $result = $this->admin_teaching_model->get_teaching_model($courseID);
            $this->response($result); 
        }

        function get_all_lecturer_get(){
            $result = $this->admin_teaching_model->get_all_lecturer_model();
            $this->response($result); 
        }

        function create_teaching_post(){
            $courseID = $this->post('courseID');
            $lecturerID = $this->post('lecturerID');
            $roleID = $this->post('roleID');
    
            $data = array(  
                "courseID" => $courseID,
                "lecturerID" => $lecturerID,
                "roleID" => $roleID

            );
    
            $data["courses"] = array(
                'roleID' => $this->post("roleID"),    
            );
            $result = $this->admin_teaching_model->update($data);

            $data["teaching"] = array(
                'courseID' => $this->post("courseID"),
                'lecturerID' => $this->post("lecturerID")
            );
    
            $result = $this->admin_teaching_model->insert($data);
    
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
        }
       
          //Createteaching
          function update_status_teaching_post(){
            
            $courseID = $this->post('courseID');
            $lecturerID = $this->post('lecturerID');
            $roleID = $this->post('roleID');
            $data = [
                'courseID' => $courseID,
                'roleID' => $roleID,
            ];
            $result = $this->admin_teaching_model->update_teaching_model($data);
            $result = $this->admin_teaching_model->insert($courseID,$lecturerID,$roleID);

            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
            
        }
    }