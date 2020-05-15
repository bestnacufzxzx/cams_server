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

        function getnamebystudentid_post(){
            $studentID = $this->post("user_ID");
            $result = $this->checknamestudent_model->getnamebystudentidmodle( $studentID);
            foreach ($result as $i => $v) {
                $prefix = $v->prefix;
                 $fname = $v->firstName;
                $lname = $v->lastName;
            }
            
            $fullname = [
                'prefix' => $prefix,
                'fname' => $fname,
                'lname' => $lname
            ];
            $this->response($fullname); 
            // $this->response($fname); 

        }

        function updatestudentstatus(){
            
        }
        
        function postHistoryChecknameByCourse_post(){
            $courseID = $this->post("courseID");
            $studentID = $this->post("user_ID");
            $result = $this->checknamestudent_model->posthistorydata($courseID, $studentID);

            $this->response(array('result'=>$result, 'path'=>base_url('Public/image/checkname/'))); 
        }

        function percent_check_name_post(){
            $courseID = $this->post("courseID");
            $studentID = $this->post("user_ID");
            $number = $this->checknamestudent_model->totalPassCheckName($courseID, $studentID);
            $numberLateClass = $this->checknamestudent_model->totalPassCheckName_LateClass($courseID, $studentID);
            $numberMissClass = $this->checknamestudent_model->totalPassCheckName_MissClass($courseID, $studentID);
            $total = $this->checknamestudent_model->totalCheckNameByClass($courseID);
            $percent = [
                'number' => $number,
                'percent' => round(($number*100/$total),2),
                'percentLateClass' => round(($numberLateClass*100/$total),2),
                // 'percentMissClass' => round((($total-($numberMissClass+$numberLateClass))*100)/$total,2),
                'percentMissClass' => round((($numberMissClass*100)/$total),2),
                // 'percentMissClass' => round((100-(($total-($numberMissClass+$numberLateClass))*100)/$total),2),
                'remainMissClass' => round($total-(($total*80)/100)),
                'remain' => round(($total-(($total*80)/100))-$numberMissClass),
                // 'remain' => (round(($total-(($total*80)/100))-$numberMissClass) > 0) ? round(($total-(($total*80)/100))-$numberMissClass) : 0,
                'total' => $total
            ];
            // $is_admin = ($result['permissions'] == 'admin') ? true : false;
            // $test = $percent['percentLateClass']; // ดึงอาเร
            $this->response($percent); 
        }

        function getcourse_get(){
            $courseID = $this->get("courseID");
            $result = $this->checknamestudent_model->gethistorycourse($courseID);
            $this->response($result); 
            // $data[$key]['Course'] = $this->checknamestudent_model->gethistorycourse($value->courseID);
        }

        ///ทดสอบ chack
        function gethitbychackname(){
            $checknameID = $this->get('checknameID');
            $chacknamesutdant = $this->checknamestudent_model->chacknamesutdantmodel($checknameID);
            $this->response($result);
        }

        function getbycourse_get(){
            $courseID = $this->get('courseID');
            $studentID = $this->get('studentID');
            $result = $this->checknamestudent_model->classbycourse($courseID,$studentID);
            // $result = $this->checknamestudent_model->classbycourse($courseID);
            $this->response($result);
        }

        function postgettest_post(){
            // $data = date('H:i:s',time());
            $classID = $this->post("classID");
            $starttime = $this->checknamestudent_model->postCheckstarttime_time($classID);
            $endtime = $this->checknamestudent_model->postCheckendtime_time($classID);
            $startdate = $this->checknamestudent_model->postCheckstartdate_time($classID);
            $startcheck = $this->checknamestudent_model->postCheckstartcheck_time($classID);
            $endcheck = $this->checknamestudent_model->postCheckendcheck_time($classID);

            $datetime = [
                'starttime' => $starttime,
                'endtime' => $endtime,
                'startdate' => $startdate, 
                'startcheck' => $startcheck, 
                'endcheck' => $endcheck
            ];
            $this->response($datetime); 

        }

        function postCheckname_post(){
            $data = date('Y-m-d H:i:s',time());
            $data2 = date('H:i:s',time());

            $classID = $this->post("classID");
            $studentID = $this->post("studentID");
            $latitude = $this->post("latitude");
            $longitude = $this->post("longitude");

            // $data_check = $this->checknamestudent_model->postChecknamedata($studentID);
            // $data_check_time = $this->checknamestudent_model->postChecknamedata_time($classID);
            // if($data_check_time <= ){}
            // $data_check_time = $this->checknamestudent_model->postChecknamedata_time($classID);

            $starttime = $this->checknamestudent_model->postCheckstarttime_time($classID);
            $endtime = $this->checknamestudent_model->postCheckendtime_time($classID);
            $startdate = $this->checknamestudent_model->postCheckstartdate_time($classID);
            $startcheck = $this->checknamestudent_model->postCheckstartcheck_time($classID);
            $endcheck = $this->checknamestudent_model->postCheckendcheck_time($classID);
            
            if($data2 >= $startcheck && $data2 <= $endcheck)
            {
                $statusupdatebystudent = "1";
            }else if ($data2 >= $endcheck && $data2 <= $endtime)
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
                        $result = $this->checknamestudent_model->insert($data);
                        $this->response([
                            'status' => $result
                        ], REST_Controller::HTTP_OK);                                      
                }
           
            
        }
            function getclassbycourses(){
                $courseID = $this->get("courseID");
                $classID = $this->get("classID");
                $result = $this->checknamestudent_model->getclassbycoursesModel($courseID,$classID);
                $this->response($result); 
            }
    }
?>