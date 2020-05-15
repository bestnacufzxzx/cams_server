<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin_teaching_model extends CI_Model{

        private $tbl_name = "teaching";

        function get_all_lecturer_model(){
            $this->db->select("lecturerID,firstName,lastName,user_id");
            $this->db->from('lecturers');
            $result = $this->db->get();
            return $result->result();
        }

        function get_teaching_model($courseID){
            $this->db->from('courses');

            $this->db->join('teaching', 'teaching.courseID = courses.courseID');
            $this->db->where('teaching.courseID', $courseID);
            $this->db->join('lecturers', 'lecturers.lecturerID = teaching.lecturerID');
            

            $result = $this->db->get();
            return $result->result();
        }
        
        function befor_chack_insert($courseID,$lecturerID,$roleID){
            $this->db->from('teaching');
            $this->db->where('teaching.courseID', $courseID);
            $this->db->where('teaching.lecturerID', $lecturerID);
            $this->db->where('teaching.roleID', $roleID);
            $result = $this->db->get();
            return $result->result();

        }

        function insert($courseID,$lecturerID,$roleID){
            $this->db->set('courseID', $courseID);
            $this->db->set('lecturerID', $lecturerID);
            $this->db->set('roleID', $roleID);
            $this->db->insert('teaching');
            $result = $this->db->get('teaching');
            return $result;
        }
        function befor_chack($lecturerID){
            $this->db->select("users.user_id,users.username,users.password,users.roleID,users.name");
            $this->db->from('lecturers');
            $this->db->join('users', 'users.user_id = lecturers.user_id');
            $this->db->where('lecturers.lecturerID', $lecturerID);
            $result = $this->db->get();
            return $result->result();

        }

        
        function get_data_teaching($teachingID){
            $this->db->select("teaching.roleID");

            $this->db->from('teaching');
            $this->db->where('teaching.teachingID', $teachingID);
            $result = $this->db->get();
            return $result->result();
        }
        
        function befor_chack_data($courseID,$lecturerID){
            $this->db->from('teaching');
            $this->db->where('teaching.courseID', $courseID);
            $this->db->where('teaching.lecturerID', $lecturerID);
            $result = $this->db->get();
            return $result->result();
        }

        function befor_chack_data_teaching($courseID,$lecturerID){
            $this->db->from('teaching');
            $this->db->where('teaching.courseID', $courseID);
            $this->db->where('teaching.lecturerID', $lecturerID);
            $result = $this->db->get();
            return $result->result();
        }

        function Get_User_model($lecturerID){
            $this->db->select("users.user_id,users.username,users.password,users.roleID,users.name");

            $this->db->from('teaching');
            $this->db->join('lecturers', 'lecturers.lecturerID = teaching.lecturerID');
            $this->db->join('users', 'users.user_id = lecturers.user_id');
            $this->db->group_by('lecturers.lecturerID');

            $this->db->where('teaching.lecturerID', $lecturerID);

            $result = $this->db->get();
            return $result->result();
        }

        function update_roleID_teaching($data){
            $this->db->where('teachingID',$data['teachingID']);
            $this->db->update('teaching',$data);
            $result = $this->db->get('teaching');
            return $result;
        }
        
        function update_roleID_User_model($data){
            $this->db->where('user_id',$data['user_id']);
            $this->db->update('users',$data);
            $result = $this->db->get('users');
            return $result;
        }

        function update_teaching_model($data){
            $this->db->where('courseID',$data['courseID']);
            $this->db->update('courses',$data);
            $result = $this->db->get('courses');
            return $result;
        }
        function befor_update_status_role($lecturerID){
            $this->db->from('teaching');
            $this->db->join('lecturers', 'lecturers.lecturerID = teaching.lecturerID');
            $this->db->join('users', 'users.user_id = lecturers.user_id');
            $this->db->where('teaching.lecturerID', $lecturerID);

            $result = $this->db->get();
            return $result->result();
        }
    }
?>