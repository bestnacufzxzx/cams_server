<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginusername_model extends CI_Model {

    private $tbl_name = "users";

    function chack_role_username_model($user_id){
        // if($roleID == 3 || $roleID == 4 ||  $roleID == 5 ||  $roleID == 6){
            $this->db->from('lecturers');
            $this->db->where('lecturers.user_id', $user_id);
            $this->db->join('teaching', 'teaching.lecturerID = lecturers.lecturerID');
            $result = $this->db->get();
            return $result->result();
        // }else if($roleID == 7){
        //     // $this->db->from('studentsregeter');
        //     // $this->db->where('studentsregeter.user_id', $user_id);
        //     $this->db->select('studentID');
        //     $this->db->from('students');
        //     $this->db->where('students.user_id', $user_id);
        //     $result = $this->db->get();
        //     return $result->result();
        // }

    }

}