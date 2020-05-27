<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Lecturers extends BD_Controller{
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('lecturers_model');
            $this->load->model('checknamestudent_model');
            
        }

        function get_all_get(){         // all_get || all_post || all_delete
            $result = $this->lecturers_model->get_all();
            $this->response($result); 

        }
        function getsearch_get(){         // all_get || all_post || all_delete
            $keyword = $this->get('keyword');
            $result = $this->lecturers_model->getsearch_all($keyword);
            $this->response($result); 

        }

        function getteachcourses_get(){
            // $datetime = date('Y-m-d H:i:s');
            $teaching = $this->get('teachingID');
            // $startdate = $this->get("startdate");
            // if($startdate >= $datetime){
            // }
            $result = $this->lecturers_model->getteachcoursesmodel($teaching);

            $this->response($result);
        }

        function create_post(){
            // $user_id = $this->post('user_id');
            $firstName = $this->post('firstName');
            $lastName = $this->post('lastName');
            $email = $this->post('email');
            $phoneNumber = $this->post('phoneNumber');
            $data = [
                'lecturerID' => null,
                'roleID' => 2,
                'userID' => 1,
                'firstName' => $firstName,
                // 'user_id' => $user_id,
                'lastName' => $lastName,
                'phoneNumber' => $phoneNumber,
                'email' => $email
            ];
            $result = $this->lecturers_model->insert($data);
            $this->response($result);
        }
        
        function update_post(){
            $firstName = $this->post('firstName');
            $lastName = $this->post('lastName');
            $email = $this->post('email');
            $phoneNumber = $this->post('phoneNumber');
            $data = [
                'lecturerID' => null,
                'roleID' => 2,
                'userID' => null,
                'firstName' => $firstName,
                // 'user_id' => $user_id,
                'lastName' => $lastName,
                'phoneNumber' => $phoneNumber,
                'email' => $email
            ];
            $result = $this->lecturers_model->update($data);
            // $this->response([
            //     'status' => true,
            //     'response' => $result
            // ],REST_Controller::HTTP_OK);
            $this->response($result);

        }
        function historystudentabycourses_get(){
            $courseID = $this->get('courseID');
            $result = $this->lecturers_model->historystudentabycoursesmodel($courseID);
            $this->response($result); 
        }

        // ดึง class  แสดง
        function getparamdataclassbyclassID_get(){
            $classID = $this->get('classID');
            $result = $this->lecturers_model->getparamdataclassbyclassIDmodel($classID);
            $this->response($result); 
        }

        ///เริ่ม 
        function getlecturersbyCourse_get(){
            $courseID  = $this->get('courseID');
            $result = $this->lecturers_model->getlecturersbyCoursemodel($courseID);
            $this->response($result); 
        }

        function getCourseByteaching_get(){
            $lecturerID = $this->get('lecturerID');
            $roleID = $this->get('roleID');
            $result = $this->lecturers_model->getCourseByteachingmodel($lecturerID,$roleID);
            $this->response($result);      
        }

        function getCourseByteachingNoRole_get(){
            $lecturerID = $this->get('lecturerID');
            $result = $this->lecturers_model->getCourseByteachingNoRolemodel($lecturerID);
            $this->response($result);      
        }


        //วิชาทั้งหมดมาแสดง
        function getAllourse_get(){
            $result = $this->lecturers_model->getAlloursemodel();
            $this->response($result); 
        }

        // เพิ่มตัว เช็ครายชื่อวิชาซ้ำที่จะนำเข้า
        // insert กำหนดการเรียนการสอน
        function createcouresbylecturer_post(){
            // $teachingID = $this->post('teachingID');
            $courseID = $this->post('courseID');
            $lecturerID = $this->post('lecturerID');
            $roleID = $this->post('roleID');
            $data = array(
                // "teachingID" => $teachingID,
                "courseID"=> $courseID,
                "lecturerID" => $lecturerID,
                "roleID" => $roleID,
            );
            $datachack = $this->lecturers_model->chackdatabeforinsertdatacreatecouresbylecturer($courseID,$lecturerID,$roleID);
            if( $datachack == true){
                $result =   $this->response([
                            'status' => false,
                            'message' => ''
                            ], REST_Controller::HTTP_CONFLICT);
            }else{
                $result = $this->lecturers_model->insertdatacreatecouresbylecturer($data);
            }         
            $this->response($result); 

            // $result = $this->lecturers_model->insertdatacreatecouresbylecturer($data);
            // $this->response($result); 
            
        }

        // แสดงนักศึกษาทั้งหมด
        function getallstudentbycoures_get(){
            $students = $this->get('students');
            $result = $this->lecturers_model->getstudentbycouresmodel();
            $this->response($result);
        }
        // update กำหนดการเรียนการสอน Teachs
        function updateclassbyTeachs_post(){
            $classID = $this->post('classID');
            $courseID = $this->post('courseID');
            $roomID = $this->post('roomID');
            $starttime = $this->post('starttime');
            $endtime = $this->post('endtime');
            $startdate = $this->post('startdate');
            $startcheck = $this->post('startcheck');
            $endcheck = $this->post('endcheck');

            $data = array(
                'classID' => $this->post('classID'),
                'courseID' => $this->post('courseID'),
                'roomID' => $this->post('roomID'),
                'starttime' => $this->post('starttime'),
                'endtime' => $this->post('endtime'),
                'startdate' => $this->post('startdate'),
                'startcheck' => $this->post('startcheck'),
                'endcheck' => $this->post('endcheck'),
            );
            $result = $this->lecturers_model->updatedatacreateclassbyTeachs($data);
            $this->response($result); 

            if( $result == true){
                $this->response([
                    'status' => true,
                    'response' => $result
                ],REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);            }
        }
        // insert กำหนดการเรียนการสอน Teachs
        function createclassbyTeachs_post(){
            $classID = $this->post('classID');
            $courseID = $this->post('courseID');
            $roomID = $this->post('roomID');
            $starttime = $this->post('starttime');
            $endtime = $this->post('endtime');
            $startdate = $this->post('startdate');
            $startcheck = $this->post('startcheck');
            $endcheck = $this->post('endcheck');

            $resultchackdate = $this->lecturers_model->chackdatacreateclassbyTeachs($courseID,$starttime,$roomID,$startdate);
            if( $resultchackdate == true){
                $result =   $this->response([
                            'status' => false,
                            'message' => 'เวลาจองห้องซ้ำ'
                            ], REST_Controller::HTTP_CONFLICT);
            }else{
            // if(!$resultchackdate == $courseID && !$resultchackdate == $roomID){
                $data = array(
                    "courseID"=> $courseID,
                    'classID' => $this->post('classID'),
                    'roomID' => $this->post('roomID'),
                    'starttime' => $this->post('starttime'),
                    'endtime' => $this->post('endtime'),
                    'startdate' => $this->post('startdate'),
                    'startcheck' => $this->post('startcheck'),
                    'endcheck' => $this->post('endcheck'),
                );
                $result = $this->lecturers_model->insertdatacreateclassbyTeachs($data);
                $this->response($resultchackdate); 
                
            // }else{
            //     $this->response([
            //         'status' => false,
            //         'message' => ''
            //     ], REST_Controller::HTTP_CONFLICT);
            }

            
        }

        // update courses
        function post_updatecourses_post(){
            $teachingID = $this->post('teachingID');
            $courseID = $this->post('courseID');
            $lecturerID = $this->post('lecturerID');
            $data = [
                'teachingID' => $teachingID,
                'courseID' => $courseID,
                'lecturerID' => $lecturerID,
            ];
            $result = $this->lecturers_model->update_courses($data);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        //delete Course
        function get_delete_get(){
            $teachingID = $this->get('teachingID');
            $courseID = $this->get('courseID');
            $resultchackdelete = $this->lecturers_model->chack_delete($courseID);
            if(!$resultchackdelete == $courseID){
                $result = $this->lecturers_model->delete($teachingID);
                $this->response($resultchackdelete); 
            }else{
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
        }

        // get BeforeCourse
        function getBeforeCourse_get(){
            $teachingID = $this->get('teachingID');
            $result = $this->lecturers_model->getBeforeCourse($teachingID);
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }

        // git history by Timetreatment
        function gethistorytimetreatment_get(){
            $courseID = $this->get('courseID');
            // $lecturerID = $this->get('lecturerID');
            // $result = $this->lecturers_model->historystudentabycoursesmodel($courseID);
            $result = [];
            $result['schedule'] = $this->get_couresbyclass($courseID);
            $student = $this->get_studentsincoures($courseID);
            $studentRatting = [];
            foreach ($student as $key => $v) {
                $studentRatting[$v->studentID] = $this->get_idstudentandcoures($courseID, $v->studentID);
            }
            $checkArray = [];
            foreach ($student as $key => $v) {
                $checkArray[$v->studentID] = $this->receive_idstudentandcouresgetclassteaching($courseID, $v->studentID);
            }
            $result['student'] = $student;
            $result['rating'] = $studentRatting;
            $result['check'] = $checkArray;
            $this->response($result, REST_Controller::HTTP_OK); 
        }

        // starttime 20/5/62
        // รับค่า id นักศึกษา กับรายวิชา => เข้าเรียน มาสาย ขาดเรียน
        function get_idstudentandcoures($courseID,$studentID){
            // $courseID = $this->get("courseID");
            // $studentID = $this->get("studentID");
            $number = $this->checknamestudent_model->totalPassCheckName($courseID, $studentID);
            $numberLateClass = $this->checknamestudent_model->totalPassCheckName_LateClass($courseID, $studentID);
            $numberMissClass = $this->checknamestudent_model->totalPassCheckName_MissClass($courseID, $studentID);
            $total = $this->checknamestudent_model->totalCheckNameByClass($courseID);
            if(!empty($total)){
                $percent = [
                    'percentattendclass' => round(($number*100/$total),2),
                    'percentLateClass' => round(($numberLateClass*100/$total),2),
                    'percentMissClass' => round((($numberMissClass*100)/$total),2),
                ];
                return $percent;
            }else{
                $percent = [
                    'percentattendclass' => "ยังไม่มีประวัติคะแนน",
                    'percentLateClass' => "ยังไม่มีประวัติคะแนน",
                    'percentMissClass' => "ยังไม่มีประวัติคะแนน",
                ];
                return $percent;
            }

        }

        function receive_idstudentandcouresgetclassteaching($courseID,$studentID){
            // $courseID = $this->get("courseID");
            // $studentID = $this->get("studentID");
            $result = $this->lecturers_model->receive_idstudentandcouresgetclassteaching_model($courseID,$studentID);
            return $result;
        }

        function get_studentsincoures($courseID){
            // $courseID = $this->get("courseID");
            $result = $this->lecturers_model->get_studentsincoures_model($courseID);
            return $result;
        }
        function get_couresbyclass($courseID){
            // $courseID = $this->get("courseID");
            $result = $this->lecturers_model->get_couresbyclass_model($courseID);
            return $result;
        }
        // endtime
        // 
        function percent_check_name_get(){
            $courseID = $this->get("courseID");
            $studentID = $this->get("studentID");
            // $result = $this->lecturers_model->percent_check_name_model($courseID,$studentID);
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
            $this->response($percent); 
            // $this->response($result); 
        }
        //

        // get room
        function getroom_get(){
            $result = $this->lecturers_model->getAllroom();
            $this->response($result); 
        }
        function get_delete_classid_get(){
            $classID = $this->get('classID');
            $result = $this->lecturers_model->delete_classid($classID);
            // $this->response($result); 
            $this->response([
                'status' => true,
                'response' => $result
            ],REST_Controller::HTTP_OK);
        }


        // function create_get(){
        //     $roomID = $this->get('roomID');
        //     $location = $this->get('location');
        //     $buildingID = $this->get('buildingID');
        //     $buildingName = $this->get('buildingName');
        //     $data = array(
        //         "roomID" => $roomID,
        //         "location" => $location,
        //         "buildingID" => $buildingID,
        //         "buildingName" => $buildingName
        //     );
    
        //     $data["room"] = array(
        //         'roomID' => $this->get("roomID"),
        //         'location' => $this->get("location"),
        //         'buildingID' => $this->get("buildingID") 
        //     );
        //     $data["building"] = array(
        //         'buildingName' => $this->get("buildingName"),
        //         'buildingID' => $this->get("buildingID")
        //     );
    
        //     $result = $this->insertlocation_model->insertdata($data);
    
        //     if ($result != null)
        //         {
        //             $this->response([
        //                 'status' => true,
        //                 'response' => $result
        //             ], REST_Controller::HTTP_OK); 
        //         }else{
        //         //error
        //             $this->response([
        //                 'status' => false,
        //                 'message' => ''
        //             ], REST_Controller::HTTP_CONFLICT);
        //         }
            
        //     /*error
        //     $this->response([
        //         'stetus' => false,
        //         'massage' => $result
        //     ], REST_Controller::HTTP_CONFLICT);*/
        // }

        // get studentby courses lecturer
        function get_studentByCourses_get(){
            // $lecturerID = $this->get('lecturerID');
            $courseID = $this->get('courseID');
            $result = $this->lecturers_model->getsutdentByCourses_model($courseID);
            // if($result != null){
            //     $this->response([
            //         'status' => true,
            //         'response' => $result
            //     ], REST_Controller::HTTP_OK); 
            // }else{
            //     $res = [
            //         'status' => false
            //     ];
            //     $this->response($res); 
            // }
            $this->response($result); 

        }
        // get student 
        function get_all_sutdentByCourses_get(){
            $courseID = $this->get('courseID');
            $result = $this->lecturers_model->get_all_sutdentByCourses_model($courseID);
            $this->response($result); 
        }
        // createstudent by lecturer
        function insert_studentByCourses_post(){
            $courseID = $this->post('courseID');
            $studentID = $this->post('studentID');
            $resulcourseIDbystudent = $this->lecturers_model->get_all_studentsregeter_sutdentByCourses_model($courseID,$studentID);

            if(sizeof($resulcourseIDbystudent) == 0){
                $data = [];
                foreach ($studentID as $row) {
                    $temp_data = array(
                        "courseID"=> $courseID,
                        "studentID" => $row
                    );
                    array_push($data, $temp_data);
                }
                $result = $this->lecturers_model->insert_studentByCourses_model($data);
                $this->response($resulcourseIDbystudent); 
            }else{
                // $output['status'] = false;
                // $output['message'] = 'รายชื่อนักศึกษาซ้ำ';
                // $this->response($output, REST_Controller::HTTP_OK);
                $this->response([
                    'status' => false,
                    'message' => ''
                ], REST_Controller::HTTP_CONFLICT);
            }
        }

        function get_delete_studentByCourses_get(){
            $studentsregeterID = $this->get('studentsregeterID');
            $result = $this->lecturers_model->delete_studentByCourses_model($studentsregeterID);
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

        function get_id_history_student_get(){
            $courseID = $this->get('courseID');
            $studentID = $this->get('studentID');
            $result = $this->lecturers_model->get_id_history_student_get_model($studentID,$courseID);
            $this->response($result);   
        }

        function import_post(){
            $prefix = $this->post('prefix');
            $firstName = $this->post('firstName');
            $lastName = $this->post('lastName');
            $email = $this->post('email');
            $phoneNumber = $this->post('phoneNumber');
            $user_id = $this->post('user_id');

            $data = [
                'prefix' => $prefix,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'phoneNumber' => $phoneNumber,
                'user_id' => $user_id,
            ];
        }

        function import_lecturer_post(){
            $lecturer = $this->post('lecturer');

            $data = [];
            foreach ($lecturer as $i => $v) {
                $data['lecturer'][$i] = [
                    'firstName' => $v['fname'],
                    'lastName' => $v['lname'],
                    'email' => $v['email'],
                    'phoneNumber' => $v['tel'],
                    'user_id' => ''
                ];

                $data['user'][$i] = [
                    'username' => $v['username'],
                    'password' => password_hash($this->post("password"), PASSWORD_BCRYPT),
                    'roleID' => '3',
                    'name' => $v['fname'].' '.$v['lname']
                ];
            }

            $result = $this->lecturers_model->import_lecturer($data);
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
?>