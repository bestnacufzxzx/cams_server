<?php
    defined('BASEPATH') OR exit('No direct script access allowed');



    class Checknamestudent_model extends CI_Model{

         
        private $tbl_name = "studentsregeter";

        // function get_all(){
        //     $this->db->select("courses.courseID, courses.courseCode, courses.courseName, courses.lesson, checkname.courseID, checkname.status, checkname.day, studentsregeter.courseID, studentsregeter.studentID ");
        //     $this->db->from($this->tbl_name);
        //     $this->db->join('studentsregeter', 'courses.courseID = studentsregeter.courseID');
        //     // $this->db->join('checkname', 'class.courseID = checkname.courseID');
        //     $this->db->join('class', 'courses.courseID = class.courseID');
        //     $result = $this->db->get();
        //     return $result->result();
        // }

        function getCourseByUserId($userID){
            $datestart = date('Y-m-d',time());
            $this->db->from($this->tbl_name);
            $this->db->join('courses', 'courses.courseID = studentsregeter.courseID');
            
            $this->db->where('studentsregeter.studentID', $userID);
            $this->db->join('students', 'students.studentID = studentsregeter.studentID');
            $result = $this->db->get();
            return $result->result();

        }

        function getdatatime($coursesid){
            $datestart = date('Y-m-d',time());
            $this->db->from('class');
            // $this->db->where('class.classID', $coursesid );
            $this->db->where('class.courseID', $coursesid);
            $this->db->where('class.startdate', $datestart);
            $result = $this->db->get();
            return $result->row();


        }

        function getcheckname($datetime){
            $this->db->from('checkname');
            $this->db->where('checkname.datetime',$datetime);
            $result = $this->db->get();
            return $result->row();
        }

        function postChecknamedata($studentID){
            $this->db->from('checkname');
            $this->db->where('studentID', $studentID);
            $result = $this->db->get();
            return $result->result();
        }

        function postCheckstarttime_time($classID){
            $this->db->select("class.starttime");
            $this->db->from('class');
            $this->db->where('classID', $classID);
            $result = $this->db->get();
            return $result->row('starttime');
        }
        function postCheckendtime_time($classID){
            $this->db->select("class.endtime");
            $this->db->from('class');
            $this->db->where('classID', $classID);
            $result = $this->db->get();
            return $result->row('endtime');
        }
        function postCheckstartdate_time($classID){
            $this->db->select("class.startdate");
            $this->db->from('class');
            $this->db->where('classID', $classID);
            $result = $this->db->get();
            return $result->row('startdate');
        }
        function postCheckstartcheck_time($classID){
            $this->db->select("class.startcheck");
            $this->db->from('class');
            $this->db->where('classID', $classID);
            $result = $this->db->get();
            return $result->row('startcheck');
        }
        function postCheckendcheck_time($classID){
            $this->db->select("class.endcheck");
            $this->db->from('class');
            $this->db->where('classID', $classID);
            $result = $this->db->get();
            return $result->row('endcheck');
        }

        function insert($data){
            return $this->db->insert('checkname', $data);  //table ''
        }

        // function gethistorycourse($courses){
        //     $this->db->from('courses');
        //     $this->db->where('courseID', $courses);
        //     $result = $this->db->get();
        //     return $result->row();
        // }

        function gethistorycoruse($userID){
            $this->db->from($this->tbl_name);
            $this->db->join('courses', 'courses.courseID = studentsregeter.courseID');
            $this->db->join('class', 'class.courseID = courses.courseID');
            $this->db->join('checkname', 'checkname.classID = class.classID');
            $this->db->group_by('courses.courseID');
            $this->db->where('checkname.studentID', $userID);
            $result = $this->db->get();
            return $result->result();
        }

        function getnamebystudentidmodle($studentID){
            $this->db->select("students.firstName,students.lastName,students.prefix");
            $this->db->from('students');
            $this->db->where('students.studentID', $studentID);
            $result = $this->db->get();
            // echo $this->db->last_query();
            // exit();
            return $result->result();
        }

        function updatestudentstatusmodle(){
            
        }

        function posthistorydata($courseID, $studentID){
                $this->db->select("*, concat(class.startdate, ' ', class.endtime) as datetime");
                $this->db->from('checkname');
                $this->db->join('class', 'checkname.classID = class.classID and checkname.studentID = '.$studentID, 'right');
                $this->db->join('room','room.roomID = class.roomID');
                $this->db->join('building','building.buildingID = room.buildingID');
                $this->db->join('courses', 'courses.courseID = class.courseID');
                $this->db->where('class.courseID', $courseID);
                // $this->db->group_start();
                // $this->db->where('datetime <= ', date('y-m-d H:i:s'));
                // $this->db->where('datetime <= ', date('Y-m-d H:i:s', strtotime('2011-08-10 20:40:12')));
                // $this->db->where('class.endtime <= ', date('H:i:s',time()));
                // $this->db->group_end();
                $result = $this->db->get();
                // echo $this->db->last_query();
                // exit();
                return $result->result();
            }

            function totalPassCheckName($courseID, $studentID){
                $this->db->select("count(checkname.status) as number");
                $this->db->from('checkname');
                $this->db->join('class', 'class.classID = checkname.classID');
                $this->db->join('room','room.roomID = class.roomID');
                $this->db->join('building','building.buildingID = room.buildingID');
                $this->db->join('courses', 'courses.courseID = class.courseID');
                $this->db->where('class.courseID', $courseID);
                $this->db->where('checkname.studentID', $studentID);
                $this->db->where_in('checkname.status', [1]);           
                $result = $this->db->get();
                return $result->row('number');
            }

            function totalPassCheckName_LateClass($courseID, $studentID){
                $this->db->select("count(checkname.status) as number");
                $this->db->from('checkname');
                $this->db->join('class', 'class.classID = checkname.classID');
                $this->db->join('room','room.roomID = class.roomID');
                $this->db->join('building','building.buildingID = room.buildingID');
                $this->db->join('courses', 'courses.courseID = class.courseID');
                $this->db->where('class.courseID', $courseID);
                $this->db->where('checkname.studentID', $studentID);
                $this->db->where_in('checkname.status', [2]);           
                $result = $this->db->get();
                return $result->row('number');
            }

            function totalPassCheckName_MissClass($courseID, $studentID){

                $this->db->select("count(class.classID) as number");
                $this->db->from('checkname');
                $this->db->join('class', 'checkname.classID = class.classID and checkname.studentID = '.$studentID, 'right');
                $this->db->join('room','room.roomID = class.roomID');
                $this->db->join('building','building.buildingID = room.buildingID');
                $this->db->join('courses', 'courses.courseID = class.courseID');
                $this->db->where('class.courseID', $courseID);
                $this->db->where('class.startdate <= ', date('y-m-d'));
                $this->db->where('checkname.status IS NULL', null, false);
                $result = $this->db->get();
                // echo $this->db->last_query();
                // exit();
                return $result->row('number');
            }

            
            function totalCheckName($courseID){
                $this->db->select("count(checkname.status) as number");
                $this->db->from('checkname');
                $this->db->join('class', 'class.classID = checkname.classID');
                $this->db->where('class.courseID', $courseID);
                $result = $this->db->get();
                return $result->row('number');
            }

            function totalCheckNameByClass($courseID){
                $this->db->select("count(class.courseID) as number");
                $this->db->from('class');
                $this->db->where('class.courseID', $courseID);
                $result = $this->db->get();
                return $result->row('number');
            }

            function chacknamesutdantmodel($checknameID){
                $this->db->from('checkname');
                $this->db->where('checkname.checknameID', $checknameID);
                $result = $this->db->get();
                return $result->result();
            }

            function classbycourse($courseID,$studentID){
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


            // function classbycourse($courseID){
            //     // $datecheck = date('H:i:s');
            //     // echo($datecheck);
            //     $this->db->from('class');
            //     // $this->db->where('class.classID', $classID);
            //     $this->db->join('courses', 'courses.courseID = class.courseID');
                
            //     $this->db->where('courses.courseID', $courseID);
            //     // $this->db->where('class.startdate', $datecheck);
            //     // $this->('datecheck',$datecheck);
            //     $result = $this->db->get();
            //     return $result->result();
            // }

            // function classbycourse($studentID,$courseID){
            //     $this->db->from('studentsregeter');
            //     $this->db->join('class', 'class.courseID = studentsregeter.courseID');
            //     // $this->db->where('class.courseID', $courseID);
            //     $result = $this->db->get();
            //     return $result->result();
            // }

            function getclassbycoursesModel($courseID,$classID){
                $this->db->from('class');
                $this->db->join('checkname', 'checkname.classID = class.classID');
                $this->db->where('checkname.classID', $classID);
                $this->db->where('class.courseID', $courseID);
                $result = $this->db->get();
                return $result->result();

            }

    }
?>