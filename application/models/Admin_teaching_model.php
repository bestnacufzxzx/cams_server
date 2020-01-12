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
       

        function insert($courseID,$lecturerID,$roleID){
            $this->db->set('courseID', $courseID);
            $this->db->set('lecturerID', $lecturerID);
            $this->db->set('roleID', $roleID);
            $this->db->insert('teaching');
            $result = $this->db->get('teaching');
            return $result;
        }

        function update_teaching_model($data){
            $this->db->where('courseID',$data['courseID']);
            $this->db->update('courses',$data);
            $result = $this->db->get('courses');
            return $result;
        }
    }
?>