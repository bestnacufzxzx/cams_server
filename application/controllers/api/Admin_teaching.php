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

            $teachingID = $this->post('teachingID');
            

            $resultchackdates = $this->admin_teaching_model->befor_chack_insert($courseID,$lecturerID,$roleID);
            $befor_chacks = $this->admin_teaching_model->befor_chack($lecturerID);
            $get_data_teachings = $this->admin_teaching_model->get_data_teaching($lecturerID);
            $befor_chack_datas = $this->admin_teaching_model->befor_chack_data($courseID,$lecturerID);
            $befor_chack_data_teachings = $this->admin_teaching_model->befor_chack_data_teaching($courseID,$lecturerID);

            foreach ($befor_chack_datas as $befor_chack_data) {
                $befor_datas = array(
                    "teachingID" => $befor_chack_data->teachingID,
                    "courseID" => $befor_chack_data->courseID,
                    "lecturerID" => $befor_chack_data->lecturerID,
                    "roleID" => $befor_chack_data->roleID,
                );
            }

            foreach ($befor_chack_data_teachings as $befor_chack_data_teaching) {
                $befor_datas_teachings = array(
                    "teachingID" => $befor_chack_data_teaching->teachingID,
                    "courseID" => $befor_chack_data_teaching->courseID,
                    "lecturerID" => $befor_chack_data_teaching->lecturerID,
                    "roleID" => $roleID,
                );
            }

            foreach ($befor_chacks as $befor_chack) {
                $data_chacks = array(
                    "user_id" => $befor_chack->user_id,
                    "username" => $befor_chack->username,
                    "password" => $befor_chack->password,
                    "roleID" => $roleID,
                    "name" => $befor_chack->name,
                );
            }
            foreach ($get_data_teachings as $get_data_teaching) {
                $get_data = array(
                    "teachingID" => $get_data_teaching->teachingID,
                    "courseID" => $get_data_teaching->courseID,
                    "lecturerID" => $get_data_teaching->lecturerID,
                    "roleID" => $roleID,
                );
            }

            if($teachingID != ""){
                $result = $this->admin_teaching_model->update_roleID_teaching($get_data);
                $resultchackdate = $this->admin_teaching_model->update_roleID_User_model($data_chacks);
            }

            if( $resultchackdates == true){
                $result =   $this->response([
                            'status' => false,
                            'message' => 'อาจารย์ในรายวิชาซ้ำ'
                            ], REST_Controller::HTTP_CONFLICT);
            }else{
                foreach ($resultchackdates as $resultchackdate) {
                    $data = array(
                        "teachingID" => $resultchackdate->teachingID,
                        "courseID" => $resultchackdate->courseID,
                        "lecturerID" => $resultchackdate->lecturerID,
                        "roleID" => $resultchackdate->roleID,
                    );
                }

            if($befor_datas == false ){
                $update_roleID_User_model = $this->admin_teaching_model->insert($courseID,$lecturerID,$roleID);
                $resultchackdate = $this->admin_teaching_model->update_roleID_User_model($data_chacks);
                $resultchackdate = $resultchackdate;

            }else{
                $update_roleID_User_model = $this->admin_teaching_model->update_roleID_teaching($befor_datas_teachings);
                $resultchackdate = $this->admin_teaching_model->update_roleID_User_model($data_chacks);
            }
            
            // if($resultchackdates == false && ($roleID =='4' || $roleID =='3' || $roleID =='5')){ 
            //     if($befor_chack_data == true || $befor_chack_data == true || $befor_chack_data == true){          
            //         $update_roleID_User_model = $this->admin_teaching_model->update_roleID_teaching($get_data);
            //         $resultchackdate = $this->admin_teaching_model->update_roleID_User_model($data_chacks);

            //     }else{
            //         if($resultchackdate->roleID == '3' || $resultchackdate->roleID == '4' || $resultchackdate->roleID =='5'){
            //             $update_roleID_User_model = $this->admin_teaching_model->insert($courseID,$lecturerID,$roleID);

            //             $resultchackdate = $this->admin_teaching_model->update_roleID_User_model($data_chacks);
            //             $resultchackdate = $resultchackdate;
            //         }
            //     }        
            // }
            // else if($resultchackdate->roleID == '3' || $resultchackdate->roleID == '4' || $resultchackdate->roleID =='5'){          
            //     $update_roleID_User_model = $this->admin_teaching_model->update_roleID_teaching($get_data);
            //     $resultchackdate = $this->admin_teaching_model->update_roleID_User_model($data_chacks);
            // }
            // else if ($resultchackdate->roleID == '3' || $resultchackdate->roleID == '4'){
            //     $result = $this->admin_teaching_model->insert($courseID,$lecturerID,$roleID);
            //     $resultchackdate = $this->admin_teaching_model->update_roleID_User_model($data);
            // }else if ($resultchackdate->roleID == '5' && ($roleID == '4' || $roleID == '3')){
            //     $result =   $this->response([
            //         'status' => false,
            //         'message' => 'ไม่สามารถสร้างอาจารย์ผู้ประสานรายวิชาหรืออาจารย์ผู้สอนได้เนื่องจากมีสถานะเป็นอาจารย์ผู้ประสานรายวิชาและอาจารย์ผู้สอนอยู่แล้ว'
            //         ], REST_Controller::HTTP_CONFLICT);
            // }
            }
             
            $this->response([
                'status' => true,
                'response' => $resultchackdate,
                'message' => 'บันทึกสำเร็จ'
            ],REST_Controller::HTTP_OK);
            
        }
        
    }