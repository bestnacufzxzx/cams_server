<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Profile_model extends CI_Model{

        private $tbl_users_students = "students";
        private $tbl_users_lecturers = "lecturers";
        private $tbl_users_admin = "admin";
        private $tbl_users = "users";

        function getprofilebystudent_model($user_id){
            $this->db->from('students');
            $this->db->where('students.user_id',$user_id);
            $this->db->join('users', 'users.user_id = students.user_id');
            $result = $this->db->get();
            return $result->result();

        }

        function getprofilebylecturers_model($user_id){
            $this->db->from('lecturers');
            $this->db->where('lecturers.user_id',$user_id);
            $this->db->join('users', 'users.user_id = lecturers.user_id');
            $result = $this->db->get();
            return $result->result();

        }

        function getprofilebyadmin_model($user_id){
            $this->db->from('admin');
            $this->db->where('admin.user_id', $user_id);
            $this->db->join('users', 'users.user_id = admin.user_id');
            $result = $this->db->get();
            return $result->result();
        }

        function getrolebyusers_model($user_id){
            $this->db->select('users.roleID');
            $this->db->from('users');
            $this->db->where('users.user_id', $user_id);
            $result = $this->db->get();
            return $result->result();
        }

        function updateprofilebystudent_model($data){
            $this->db->where('user_id',$data['user_id']);
            $this->db->update($this->tbl_users_students,$data);
            $result = $this->db->get($this->tbl_users_students);
            return $result;
        }

        function post_updateuser_users($data){
            $this->db->where('user_id',$data['user_id']);
            $this->db->update($this->tbl_users,$data);
            $result = $this->db->get($this->tbl_users);
            return $result;
        }
        
        function updateprofilebylecturer_model($data){
            $this->db->where('user_id',$data['user_id']);
            $this->db->update($this->tbl_users_lecturers,$data);
            $result = $this->db->get($this->tbl_users_lecturers);
            return $result;
        }
        
        function updateprofilebyadmin_model($data){
            $this->db->where('user_id',$data['user_id']);
            $this->db->update($this->tbl_users_admin,$data);
            $result = $this->db->get($this->tbl_users_admin);
            return $result;
        }
    }
?>