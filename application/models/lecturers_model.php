<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class lecturers_model extends CI_Model{

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

        function getCourseByteachingModel($lecturerID){
            $this->db->from('teaching');
            $this->db->join('courses', 'courses.courseID = teaching.courseID');
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

        function insertdatacreatecouresbylecturer($data){
            return $this->db->insert('teaching', $data);
        }

        function chackdatacreateclassbyTeachs($courseID,$starttime,$roomID){
                $this->db->from('class');
                $this->db->where('courseID', $courseID);
                $this->db->where('starttime', $starttime);
                $this->db->where('roomID', $roomID);
                $result = $this->db->get();
                return $result->result();
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

        // historystudentabycoursesmodel
        function historystudentabycoursesmodel($courseID){
            $this->db->from('studentsregeter');
            $this->db->join('students', 'students.studentID = studentsregeter.studentID');
            $this->db->where('studentsregeter.courseID', $courseID);
            $result = $this->db->get();
            return $result->result();
        }

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
        function getsutdentByCourses_model($lecturerID,$courseID){
            $this->db->select('teaching.teachingID, studentsregeter.studentsregeterID,courses.courseID,  students.prefix, students.firstName, students.lastName, ');
            $this->db->from('teaching');
            $this->db->join('courses', 'courses.courseID = teaching.courseID');
            $this->db->join('studentsregeter', 'studentsregeter.courseID = courses.courseID');
            $this->db->join('students', 'students.studentID = studentsregeter.studentID');

            $this->db->where('teaching.lecturerID', $lecturerID);
            $this->db->where('teaching.courseID', $courseID);
            // $this->db->where()
            $result = $this->db->get();
            return $result->result();
        }
         

        function get_all_sutdentByCourses_model(){
            $this->db->from('students');
            $result = $this->db->get();
            return $result->result();
        }
        function insert_studentByCourses_model($data){
            return $this->db->insert('studentsregeter', $data);
        }

        function get_all_studentsregeter_sutdentByCourses_model($courseID,$studentID){
            $this->db->from('studentsregeter');
            $this->db->where('courseID', $courseID);
            $this->db->where('studentID', $studentID);
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


    }
?>