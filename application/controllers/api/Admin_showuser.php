<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin_showuser extends BD_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('admin_showuser_model');
            
        }
        function showusername_teacher_get(){
            $result = $this->admin_showuser_model->showusername_teacher_model();
            $this->response($result); 
        }

        function get_delete_lecturerid_get(){
            $lecturerID = $this->get('lecturerID');
            $result = $this->admin_showuser_model->delete_lecturer($lecturerID);
            // $this->response($result); 
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        function getBeforelecturerID_get(){
            $lecturerID = $this->get('lecturerID');
            $result = $this->admin_showuser_model->getBeforelecturerID_model($lecturerID);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        function post_updatelecturer_post(){
            $lecturerID = $this->post('lecturerID');
            $prefix = $this->post('prefix');
            $firstName = $this->post('firstName');
            $lastName = $this->post('lastName');
            $email = $this->post('email');
            $phoneNumber = $this->post('phoneNumber');
            if ( !empty($prefix) && !empty($firstName) && !empty($lastName) ){
                $data = [
                    'lecturerID' => $lecturerID,
                    'prefix' => $prefix,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'email' => $email,
                    'phoneNumber' => $phoneNumber,
                ];
                $result = $this->admin_showuser_model->post_updatelecturer($data);
    
                $this->response([
                    'status' => true,
                    'response' => $result
                ],REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
           
            
        }

        //student
        function showusername_student_get(){
            $result = $this->admin_showuser_model->showusername_student_model();
            $this->response($result); 
        }
        // delete student
        function get_delete_studentid_get(){
            $studentID = $this->get('studentID');
            $result = $this->admin_showuser_model->delete_student($studentID);
            // $this->response($result); 
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }
        // get update
        function getBeforestudentID_get(){
            $studentID = $this->get('studentID');
            $result = $this->admin_showuser_model->getBeforestudentID_model($studentID);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }
        //update
        function post_updatestudent_post(){
            $studentID = $this->post('studentID');
            $prefix = $this->post('prefix');
            $firstName = $this->post('firstName');
            $lastName = $this->post('lastName');
            $email = $this->post('email');
            $phone = $this->post('phone');
            // echo("asndoasndo"+$studentID);
            // echo("asndoasndo"+$firstName);
            // echo("asndoasndo"+$lastName);
            // echo("asndoasndo"+$email);
            // echo("asndoasndo"+$phone);
            if ( !empty($prefix) && !empty($firstName) && !empty($lastName) ){
                $data = [
                    'studentID' => $studentID,
                    'prefix' => $prefix,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'email' => $email,
                    'phone' => $phone,
                ];
                $result = $this->admin_showuser_model->post_updatestudent($data);
    
                $this->response([
                    'status' => true,
                    'response' => $result
                ],REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
        }

            function getupdate_userid_get(){
                $user_id = $this->get('user_id');
                $result = $this->admin_showuser_model->getupdate_userid_lecturers($user_id);
                $this->response([
                    'status' => true,
                    'response' => $result
                ],REST_Controller::HTTP_OK);
            }

            
       
    }