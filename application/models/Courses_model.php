<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses_model extends CI_Model {
    private $tbl_name = "courses";

    function insert($courseID,$courseCode,$courseName){
        $this->db->set('courseID', $courseID);
        $this->db->set('courseCode', $courseCode);
        $this->db->set('courseName', $courseName);
        $this->db->insert('courses');
        $result = $this->db->get($this->tbl_name);
        return $result;
    }
    function updete($courseID,$courseCode,$courseName){
        $this->db->where('courseID',$courseID);    
        $this->db->set('courseID', $courseID);
        $this->db->set('courseCode', $courseCode);
        $this->db->set('courseName', $courseName);
         //$this->db->update($tbl_name, $data);
         $result = $this->db->get($this->tbl_name);
         return $result->result();
     }
     function delete($courseID){
        //$this->db->where('courseID',$courseID);
        //$this->db->delete($tbl_name);
        $this->db->where('courseID', $courseID);
        $this->db->delete('courses');
        $result = $this->db->get($this->tbl_name);
        return $result->result();
    }
    function get_all($keyword){
        $this->db->like('courseCode',$keyword);
        $result = $this->db->get($this->tbl_name);
        return $result->result();

    }

    function import_course(){
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