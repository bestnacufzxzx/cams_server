<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// class Students extends API_Controller{
class Students extends BD_Controller{

    function __construct()
    {    
        parent::__construct();
        $this->load->model('students_model');
    }
    function insert_get(){
        $courseID = $this->get('courseID');
        $courseCode = $this->get('courseCode');
        $courseName = $this->get('courseName');
        $result = $this->courses_model->insert($courseID,$courseCode,$courseName);
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
        $courseID = $this->post('courseID');
        $courseCode = $this->post('courseCode');
        $courseName = $this->post('courseName');
        $result = $this->courses_model->updete($courseID,$courseCode,$courseName);
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
        $courseID = $this->get('courseID');
        $result = $this->courses_model->delete($courseID);
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
        $keyword = $this->get('keyword');
        $result = $this->courses_model->get_all($keyword);
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

    function improt_student_post(){
        $student = $this->post('student');

            $data = [];
            foreach ($student as $i => $v) {
                $data['student'][$i] = [
                    'studentID' => $v['idstudent'],
                    'firstName' => $v['fname'],
                    'lastName' => $v['lname'],
                    'email' => $v['email'],
                    'phone' => $v['tel'],
                    'user_id' => ''
                ];

                $data['user'][$i] = [
                    'username' => $v['username'],
                    'password' => password_hash($this->post("password"), PASSWORD_BCRYPT),
                    'roleID' => '7',
                    'name' => $v['fname'].' '.$v['lname']
                ];
            }

            $result = $this->students_model->import_student($data);
            if ($result != null)
            {
                $this->response([
                    'status' => true,
                    'response' => $result
                ], REST_Controller::HTTP_OK); 
            }else{
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
    }
    
}