<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin_showcourse extends BD_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('admin_showcourse_model');
            
        }

        function get_all_courses_get(){         // all_get || all_post || all_delete
            $result = $this->admin_showcourse_model->get_all_courses();
            $this->response($result); 

        }

        function delete_get(){
            $teachingID = $this->get('teachingID');
            $result = $this->admin_showcourse_model->delete_teaching($teachingID);
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

        function get_delete_courseid_get(){
            $courseID = $this->get('courseID');
            $result = $this->admin_showcourse_model->delete_coursesid_teaching($courseID);
            $result = $this->admin_showcourse_model->delete_courseid($courseID);

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

        //studentsregeterID
        function get_delete_studentsregeter_get(){
            $studentsregeterID = $this->get('studentsregeterID');
            // $result = $this->admin_showcourse_model->delete_coursesid_teaching($studentsregeterID);
            $result = $this->admin_showcourse_model->delete_studentsregeter_model($studentsregeterID);

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

        function admin_importcourse_post($data){
            $data = $this->post('data');
            $data = [];
            foreach ($data as $key => $row) {
                $data[$key]["courses"] = array(
                    'courseCode' => !empty($row[0]) ? $row[0] : '',
                    'courseName' => !empty($row[1]) ? $row[1] : '',
                );
            }
    
            // $result = $this->admin_showcourse_model->import($data);
    
            // if (is_array($result)) {
            //     $this->response([
            //         'status' => true,
            //         'response' => $result,
            //         'message' => 'บันทึกสำเร็จ'
            //     ],REST_Controller::HTTP_OK);
            // } else {
            //     $this->response([
            //         'status' => false,
            //         'message' => "เกิดข้อผิดพลาดในการบันทึก"
            //     ], REST_Controller::HTTP_CONFLICT);
            // }
        }

        function showusername_teacher_get(){
            $result = $this->admin_showcourse_model->showusername_teacher_model();
            $this->response($result); 
        }


      

        // function admin_importcourse($request, $response, $args) {
        //     $admin_showcourse_model = new Courses($this->container);
        //     $coursesData = json_decode($request->getBody());
        //     $result = $admin_showcourse_model->import($coursesData);
        //     return $response->withJson(array("result" => $result), 200);
        // }
        

    }