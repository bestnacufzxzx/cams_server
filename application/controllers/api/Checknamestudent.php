<?php
    // defined('BASEPATH') OR exit('No direct script access allowed');
    // header('Access-Control-Allow-Origin: *');
    // header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    class Checknamestudent extends BD_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('checknamestudent_model');

        }

        function getCourseByUserId_get(){
            $userID = $this->get('user_ID');
            $result = $this->checknamestudent_model->getCourseByUserId($userID);
            $data = [];
            foreach ($result as $key => $value) {
                $data[$key]['data'] = $value;
                $data[$key]['time'] = $this->checknamestudent_model->getdatatime($value->courseID);
            }
            $this->response($data); 
        }

        function getHistoryByCourse_get(){
            $userID = $this->get('user_ID');
            $result = $this->checknamestudent_model->gethistorycoruse($userID);
            $this->response($result); 

        }
        
        function postHistoryChecknameByCourse_post(){
            $courseID = $this->post("courseID");
            $studentID = $this->post("user_ID");
            $result = $this->checknamestudent_model->posthistorydata($courseID, $studentID);
            $this->response($result); 
        }

        function percent_check_name_post(){
            $courseID = $this->post("courseID");
            $studentID = $this->post("user_ID");
            $number = $this->checknamestudent_model->totalPassCheckName($courseID, $studentID);
            $total = $this->checknamestudent_model->totalCheckName($courseID);
            $percent = [
                'percent' => $number*100/$total
            ];
            $this->response($percent); 
        }

        function getcourse_get(){
            $courseID = $this->get("courseID");
            $result = $this->checknamestudent_model->gethistorycourse($courseID);
            $this->response($result); 
            // $data[$key]['Course'] = $this->checknamestudent_model->gethistorycourse($value->courseID);
        }

        function getbycourse_get(){
            $courseID = $this->get('courseID');
            $result = $this->checknamestudent_model->classbycourse($courseID);
            $this->response($result);
        }

        function postCheckname_post(){
            $data = date('Y-m-d H:i:s',time());
            $classID = $this->post("classID");
            $studentID = $this->post("studentID");
            $latitude = $this->post("latitude");
            $longitude = $this->post("longitude");

            // $data_check = $this->checknamestudent_model->postChecknamedata($studentID);
            // $data_check_time = $this->checknamestudent_model->postChecknamedata_time($classID);
            // if($data_check_time <= ){}
            $data_check_time = $this->checknamestudent_model->postChecknamedata_time($classID);
            
            if($data >= $data_check_time['startcheck'] && $data <= $data_check_time['endcheck'])
            {
                $statusupdatebystudent = "1";
            }else if ($data >= $data_check_time['endcheck'] && $data <= $data_check_time['endtime'])
            {
                $statusupdatebystudent = "2";
            }else{
                $statusupdatebystudent = "3";
            }
                $config['upload_path'] = 'public/image/checkname/';
                $img = $this->post("picture");
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $imageName = uniqid().'.png';
                $file = $config['upload_path']. '/'. $imageName;
                $success = file_put_contents($file, $data);
                

                if (!$success){
                    $output["message"] = REST_Controller::MSG_ERROR;
                    $this->set_response($output, REST_Controller::HTTP_OK);
                }else{
                    $data = array(
                        "classID"=> $classID,
                        "studentID"=> $studentID,
                        "datetime" => date('Y-m-d H:i:s',time()),
                        "picture" => $imageName,
                        "status" => $statusupdatebystudent,
                        "latitude" => $latitude,
                        "longitude" => $longitude
                    );
                    
                    // if(!$classID == $data_check && $data_check !== $studentID){
                        $result = $this->checknamestudent_model->insert($data);
                        $this->response([
                            'status' => $data_check_time
                        ], REST_Controller::HTTP_OK);                       
                    // }else{                  
                    //     $this->response([
                    //         'status' => false,
                    //         'message' => ''
                    //     ], REST_Controller::HTTP_CONFLICT);
                    // }
                
                }
           
            
        }
            function getclassbycourses(){
                $courseID = $this->get("courseID");
                $classID = $this->get("classID");
                $result = $this->checknamestudent_model->getclassbycoursesModel($courseID,$classID);
                $this->response($result); 
            }

            // function getshowhistory(){
            //     $classID = $this->get("classID");

            // }
    }
?>