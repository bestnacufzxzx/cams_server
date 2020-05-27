<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Lecturers_model extends CI_Model{

        private $tbl_name = "lecturers";
        const num = 0;
        function get_all(){
            $result = $this->db->get($this->tbl_name);
            return $result->result();   //result คือ อาเรย์ of object
        }

        function getteachcoursesmodel($teaching){
            // $data['startdate'] = date('Y-m-d H:i:s');
            // $datestart = date('Y-m-d',time());

            $result = $this->db->from($this->tbl_name);
            $this->db->join('teaching', 'teaching.lecturerID = lecturers.lecturerID');
            $this->db->join('courses', 'courses.courseID = teaching.courseID');
            $this->db->join('class', 'class.courseID = courses.courseID');
            $this->db->join('room','room.roomID = class.roomID');
            $this->db->join('building','building.buildingID = room.buildingID');
            // $this->db->where($data);
            $this->db->where('teaching.teachingID', $teaching);
            
            $result = $this->db->get();
            return $result->result();
        }

        function getsearch_all($keyword){
            $this->db->like('firstName', $keyword);
            $result = $this->db->get($this->tbl_name);
            return $result->result();   //result คือ อาเรย์ of object
        }

        function insert($data){
            return $this->db->insert($this->tbl_name, $data);
        }

        function update($data){
            $this->db->where('lecturerID',$data['lecturerID']);
            $this->db->update($this->tbl_name,$data);
            $result = $this->db->get($this->tbl_name);
            return $result;
        }
        // function historystudentabycoursesmodel($courseID){
        //     $this->db->from('teaching');
        //     $this->db->join('courses', 'courses.courseID = teaching.courseID');
        //     $this->db->join('class', 'class.courseID = courses.courseID');
        //     $this->db->join('checkname', 'class.classID = class.classID');
        //     $this->db->join('students', 'students.studentID = checkname.studentID');
        //     // $this->db->join('checkname', 'checkname.classID = class.classID');
        //     $this->db->where('class.courseID', $courseID);
        //     $result = $this->db->get();
        //     return $result->result();
        // }

        // ดึง class  แสดง
        function getparamdataclassbyclassIDmodel($classID){
            $this->db->from('class');
            $this->db->join('room', 'room.roomID = class.roomID');
            $this->db->join('building', 'building.buildingID = room.buildingID');

            $this->db->where('class.classID', $classID);
            $result = $this->db->get();
            return $result->result();
        }

        /// เริ่ม
        function getlecturersbyCoursemodel($courseID){
            $this->db->from('courses');
            // $this->db->join('class', 'class.courseID = class.courseID');
            // $this->db->join('room', 'room.roomID = class.roomID');
            // $this->db->join('building', 'building.buildingID = room.buildingID');
            // $this->db->join('teaching', 'teaching.lecturerID = lecturers.lecturerID');
            // $this->db->join('courses', 'courses.courseID = teaching.courseID');
            $this->db->join('class', 'class.courseID = courses.courseID');
            $this->db->join('room','room.roomID = class.roomID');
            $this->db->join('building','building.buildingID = room.buildingID');

            $this->db->where('class.courseID', $courseID);

            $result = $this->db->get();
            return $result->result();
        }

        function getCourseByteachingModel($lecturerID,$roleID){
            $this->db->from('teaching');
            $this->db->join('courses', 'courses.courseID = teaching.courseID');
            $this->db->where('teaching.lecturerID', $lecturerID);
            $this->db->where('teaching.roleID', $roleID);
            $result = $this->db->get();
            return $result->result();
        }
        // 
        function getCourseByteachingNoRolemodel($lecturerID){
            $this->db->from('teaching');
            // $this->db->join('courses', 'teaching.courseID = courses.courseID and teaching.lecturerID = '.$lecturerID, 'right');
            $this->db->join('courses', 'courses.courseID = teaching.courseID');
            // $this->db->join('class', 'class.courseID = courses.courseID');
            $this->db->where('teaching.lecturerID', $lecturerID);
            $result = $this->db->get();
            return $result->result();
        }

        function getAlloursemodel(){
            $this->db->from('courses');
            $result = $this->db->get();
            return $result->result();
        }
        function createcouresbylecturer_model(){
            $this->db->from('class');
            $this->db->where('classID', $classID);
            $this->db->where('studentID', $studentID);
            $this->db->where('roomID', $roomID);
            $this->db->where('starttime', $starttime);
            $this->db->where('endtime', $endtime);
            $this->db->where('startdate', $startdate);
            $this->db->where('startcheck', $startcheck);
            $this->db->where('endcheck', $endcheck);

            // $this->db->where('latitude', $latitude);
            // $this->db->join('courses', 'courses.courseID = teaching.courseID');
            // $this->db->where('courses.teachingID', $teachingID);
            // $this->db->where('courses.courseID', $courseID);
            // $this->db->where('lecturerID.lecturerID', $lecturerID);

            $result = $this->db->get();
            return $result->result();   
        }

        function insert_createcouresbylecturer_model($data){
            return $this->db->insert('teaching', $data);
        }
        // เพิ่มตัวเซ็คข้อมูลซ้ำ
        function chackdatabeforinsertdatacreatecouresbylecturer($courseID,$lecturerID,$roleID){
            $this->db->from('teaching');
            $this->db->where('courseID', $courseID);
            $this->db->where('lecturerID', $lecturerID);
            $this->db->where('roleID', $roleID);
            $result = $this->db->get();
            if(empty( $result->result() )){
                return false; 
            }else{
                return true; 
            }
        }
        // เพิ่มกำหนดการเรียนการสอน
        function insertdatacreatecouresbylecturer($data){
            return $this->db->insert('teaching', $data);
        }
        // เพิ่มตัวเซ็คข้อมูลซ้ำ
        function chackdatacreateclassbyTeachs($courseID,$starttime,$roomID,$startdate){
                $this->db->from('class');
                $this->db->where('courseID', $courseID);
                $this->db->where('starttime', $starttime);
                $this->db->where('roomID', $roomID);
                $this->db->where('startdate', $startdate);
                // $result = $this->db->get();
                // return $result->result();
                $result = $this->db->get();
                if(empty( $result->result() )){
                    return false; 
                }else{
                    return true; 
                }
        }

        function updatedatacreateclassbyTeachs($data){
            $this->db->where('classID',$data['classID']);
            $this->db->update('class',$data);
            $result = $this->db->get('class');
            return $result;
        }

        function insertdatacreateclassbyTeachs($data){
            return $this->db->insert('class', $data);
        }

        
        // แสดงชื่อนักศึกษา
        function getstudentbycouresmodel(){
            $this->db->from('students');
            $result = $this->db->get();
            return $result->result();
        }

        // update courses
        function update_courses($data){
            $this->db->where('teachingID',$data['teachingID']);
            $this->db->update('teaching',$data);
            $result = $this->db->get('teaching');
            return $result;
        }

        // get_courses
        function get_courses(){
            $this->db->where('courseID', $courseID);
            $result = $this->db->get('class');
            return $result->result();
        }
        //chack_delete
        function chack_delete($courseID){    
            $this->db->where('courseID', $courseID); 
            $result = $this->db->get('class');  
            return $result->result();
        }
        //delete 
        function delete($teachingID){    
            $this->db->where('teachingID', $teachingID); 
            return $this->db->delete('teaching');  
        }
        function getBeforeCourse($teachingID){
            $this->db->select('teaching.teachingID, teaching.courseID, teaching.lecturerID, courses.courseCode, courses.courseName');
            $this->db->where('teachingID', $teachingID);
            $this->db->join('courses', 'courses.courseID = teaching.courseID');
            $result = $this->db->get('teaching');
            return $result->result();
        }

        // get historystudentID 
        function historystudentIDbycoursesmodel($courseID){
            $this->db->select('studentsregeter.studentID');
            $this->db->from('studentsregeter');
            $this->db->join('students', 'students.studentID = studentsregeter.studentID');
            $this->db->where('studentsregeter.courseID', $courseID);
            $result = $this->db->get();
            return $result->result();
        }
        // historystudentabycoursesmodel
        function historystudentabycoursesmodel($courseID){
            $this->db->from('studentsregeter');
            $this->db->join('students', 'students.studentID = studentsregeter.studentID');
            $this->db->where('studentsregeter.courseID', $courseID);
            $result = $this->db->get();
            return $result->result();
        }
        //
        function percent_check_name_model($courseID,$studentID){
            $this->db->select("*, concat(class.startdate, ' ', class.endtime) as datetime");
            $this->db->from('checkname');
            $this->db->join('class', 'checkname.classID = class.classID and checkname.studentID = '.$studentID, 'right');
            $this->db->join('room','room.roomID = class.roomID');
            $this->db->join('building','building.buildingID = room.buildingID');
            $this->db->join('courses', 'courses.courseID = class.courseID');
            $this->db->where('class.courseID', $courseID);
            // $this->db->group_start();
            // $this->db->where('datetime <= ', date('y-m-d H:i:s'));
            // $this->db->where('class.endtime <= ', date('H:i:s',time()));
            // $this->db->group_end();
            $result = $this->db->get();
            // echo $this->db->last_query();
            // exit();
            return $result->result();
        }
        //
    // start time 20/5/63
        //get id student and coures รับค่า id นักศึกษา กับรายวิชา => เข้าเรียน มาสาย ขาดเรียน
        function get_idstudentandcoures_model($courseID,$studentID){
            $this->db->select("*, concat(class.startdate, ' ', class.endtime) as datetime");
            $this->db->from('checkname');
            $this->db->join('class', 'checkname.classID = class.classID and checkname.studentID = '.$studentID, 'right');
            $this->db->join('room','room.roomID = class.roomID');
            $this->db->join('building','building.buildingID = room.buildingID');
            $this->db->join('courses', 'courses.courseID = class.courseID');
            $this->db->where('class.courseID', $courseID);
            $result = $this->db->get();
            // echo $this->db->last_query();
            // exit();
            return $result->result();
        }
        // end

        // set id and coures ส่ง id นศ กับ รายวิชา ดึงคาบเรียนแจ่ละคาบออกมาพร้อมบอกแต่ละคาบ มาสาย เข้าเรียน หรือ ขาดเรียน ออกมา
        function receive_idstudentandcouresgetclassteaching_model($courseID,$studentID){
            $this->db->from('checkname');
            $this->db->join('class', 'checkname.classID = class.classID and checkname.studentID = '.$studentID, 'right');
            $this->db->where('class.courseID', $courseID);
            $result = $this->db->get();
            return $result->result();
        }
        //
        // ดึงนักศึกษาทุกคนในรายวิชา
        function get_studentsincoures_model($courseID){
            $this->db->from('courses');
            $this->db->join('studentsregeter', 'studentsregeter.courseID = courses.courseID');
            $this->db->join('students', 'students.studentID = studentsregeter.studentID');
            $this->db->where('studentsregeter.courseID', $courseID);
            $result = $this->db->get();
            return $result->result();
        }
        // รับรายวิชานี้แล้วดึงคาบทั้งหมด
        function get_couresbyclass_model($courseID){
            $this->db->from('courses');
            $this->db->join('class', 'class.courseID = courses.courseID');
            $this->db->where('class.courseID', $courseID);
            $result = $this->db->get();
            return $result->result();
        }
        //
    // endtime
        // getroom
        function getAllroom(){
            $this->db->from('room');
            $result = $this->db->get();
            return $result->result();
        }
         // delete_classid 
         function delete_classid($classID){    
            $this->db->where('classID', $classID); 
            return $this->db->delete('class');  
        }


            //getsutdentByCourses
        function getsutdentByCourses_model($courseID){
            $this->db->from('studentsregeter');
            $this->db->join('students', 'students.studentID = studentsregeter.studentID');
            $this->db->where('studentsregeter.courseID', $courseID);
            $result = $this->db->get();
            return $result->result();
        }


        // //getsutdentByCourses
        // function getsutdentByCourses_model($lecturerID,$courseID){
        //     $this->db->select('teaching.teachingID, studentsregeter.studentsregeterID,courses.courseID,  students.prefix, students.firstName, students.lastName, ');
        //     $this->db->from('teaching');
        //     $this->db->join('courses', 'courses.courseID = teaching.courseID');
        //     $this->db->join('studentsregeter', 'studentsregeter.courseID = courses.courseID');
        //     $this->db->join('students', 'students.studentID = studentsregeter.studentID');

        //     $this->db->where('teaching.lecturerID', $lecturerID);
        //     $this->db->where('teaching.courseID', $courseID);
        //     // $this->db->where()
        //     $result = $this->db->get();
        //     return $result->result();
        // }
         

        function get_all_sutdentByCourses_model($courseID){
            $student = $this->getsutdentByCourses_model($courseID);
            $arrStudent = [];
            foreach ($student as $key => $row) {
                $arrStudent[] = $row->studentID;
            }
            $this->db->from('students');
            if(!empty($arrStudent)){
                $this->db->where_not_in('studentID', $arrStudent);
            }
            $result = $this->db->get();
            return $result->result();
        }

        function insert_studentByCourses_model($data){
            return $this->db->insert_batch('studentsregeter', $data);
        }

        function get_all_studentsregeter_sutdentByCourses_model($courseID,$studentID){
            $this->db->from('studentsregeter');
            $this->db->where('courseID', $courseID);
            $this->db->where_in('studentID', $studentID);
            $result = $this->db->get();
            return $result->result();
        }
        //

        // function delete_studentByCourses_model($studentsregeterID){    
        //     $this->db->where('studentsregeterID', $studentsregeterID);
        //     return $this->db->delete('studentsregeter');  
        // }

        function delete_studentByCourses_model($studentsregeterID){    
            $this->db->where('studentsregeterID', $studentsregeterID); 
            return $this->db->delete('studentsregeter');  
        }

        // function get_id_history_student_get_model($courseID){
        //     // $this->db->select('checkname.checknameID,checkname.studentID,students.prefix,students.firstName,students.lastName,checkname.latitude,checkname.longitude,checkname.datetime ');
        //     // $this->db->select('checkname.checknameID,checkname.studentID,students.prefix,students.firstName,students.lastName,checkname.latitude,checkname.longitude,checkname.datetime ');

        //     $this->db->from('class');
        //     $this->db->join('checkname', 'checkname.classID = class.classID');
        //     $this->db->join('students', 'students.studentID = checkname.studentID');

        //     $this->db->select_max('checknameID');
        //     // $this->db->where('checkname.studentID', $studentID);
        //     $this->db->where('courseID', $courseID);
        //     // $this->db->where('checkname.classID', $classID);

        //     $result = $this->db->get();
        //     return $result->result();


        // }

        function get_id_history_student_get_model($studentID,$courseID){
            $this->db->select('checkname.studentID, checkname.classID , checkname.datetime ,checkname.status ,checkname.latitude ,checkname.longitude ');
            $this->db->from('checkname');
            $this->db->join('class', 'class.classID = checkname.classID');
            $this->db->where('checkname.studentID', $studentID);
            $this->db->where('class.courseID', $courseID);
            $result = $this->db->get();
            return $result->result();
        }
        
        // function get_id_history_student_get_model($studentID,$courseID){
        //     $this->db->select('checkname.studentID, checkname.checknameID, checkname.classID , checkname.datetime ,checkname.status ,checkname.latitude ,checkname.longitude ');
        //     $this->db->from('checkname');
        //     $this->db->select_max('checkname.checknameID'); 
        //     // $this->db->join('class', 'class.classID = checkname.classID');
        //     $this->db->group_by('checkname.classID');  

        //     // $this->db->like('checkname.classID ', 'match', 'after');
        //     $this->db->where('checkname.studentID', $studentID);
        //     // $this->db->where('class.courseID', $courseID);
        //     $result = $this->db->get();
        //     return $result->result();
        // }

        function import_lecturer($data){
            $this->db->trans_begin();

                foreach ($data['user'] as $i => $v) {
                    $this->db->insert('users', $v);
                    $user_id = $this->db->insert_id();
                    $data['lecturer'][$i]['user_id'] = $user_id;
                    $this->db->insert('lecturers',  $data['lecturer'][$i]);
                }

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                return false;
            }
            else
            {
                $this->db->trans_commit();
                return true;
            }
        }
    }
?>