<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin_accountUser_model extends CI_Model{

        private $tbl_users = "users";
        // private $tbl_lecturers = "lecturers";

        // getshowaccountuser
        function showaccountUser_model(){
            $this->db->select("lecturers.user_id,lecturers.prefix,lecturers.firstName,lecturers.lastName,lecturers.email,lecturers.phoneNumber,users.username,users.password");
            $this->db->from($this->tbl_users);
            $this->db->join('lecturers', 'lecturers.user_id = users.user_id');
            $result = $this->db->get();
            return $result->result();
        }
        // delete accountuser
        function delete_student($studentID,$user_id){    
            $this->db->where('studentID', $studentID); 
            $this->db->from($this->tbl_users);
            $this->db->join('lecturers', 'lecturers.user_id = users.user_id');
            return $this->db->delete('students');  
        }

        // getupdate
        function getBeforeaccountUser_model($user_id){
            $this->db->where('user_id', $user_id);
            $result = $this->db->get($this->tbl_users);
            return $result->result();
        }

        function post_updateuser($data){
            $this->db->where('user_id',$data['user_id']);
            $this->db->update($this->tbl_users,$data);
            $result = $this->db->get($this->tbl_users);
            return $result;
        }
        



        // getshowaccountuser
        function showaccountUser_student_model(){
            $this->db->select("students.user_id,students.studentID,students.prefix,students.firstName,students.lastName,students.email,students.phone,users.username,users.password");
            $this->db->from($this->tbl_users);
            $this->db->join('students', 'students.user_id = users.user_id');
            $result = $this->db->get();
            return $result->result();
        }

        // // getupdate
        // function getBeforeaccountUser_student_model($user_id){
        //     $this->db->where('user_id', $user_id);
        //     $result = $this->db->get($this->tbl_users);
        //     return $result->result();
        // }

        // function post_student_updateuser($data){
        //     $this->db->where('user_id',$data['user_id']);
        //     $this->db->update($this->tbl_users,$data);
        //     $result = $this->db->get($this->tbl_users);
        //     return $result;
        // }

    }
?>