<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Students_model extends CI_Model {
    private $tbl_name = "students";

    function insert($roomID,$location,$buildingID){
        $this->db->set('roomID', $roomID);
        $this->db->set('location', $location);
        $this->db->set('buildingID', $buildingID);
        $this->db->insert('room');
        $result = $this->db->get($this->tbl_name);
        return $result;
    }
    function updete($roomID,$location,$buildingID){
        $this->db->where('roomID',$roomID);    
        $this->db->set('roomID', $roomID);
        $this->db->set('location', $location);
        $this->db->set('buildingID', $buildingID);
         //$this->db->update($tbl_name, $data);
         $result = $this->db->get($this->tbl_name);
         return $result->result();
     }
     function delete($roomID){
        //$this->db->where('courseID',$courseID);
        //$this->db->delete($tbl_name);
        $this->db->where('roomID', $roomID);
        $this->db->delete('room');
        $result = $this->db->get($this->tbl_name);
        return $result->result();
    }
    function get_all($roomID){
        $this->db->like('roomID',$roomID);
        $result = $this->db->get($this->tbl_name);
        return $result->result();

    }

    function import_student($data){
        $this->db->trans_begin();
        foreach ($data['user'] as $i => $v) {
            $this->db->insert('users', $v);
            $user_id = $this->db->insert_id();
            $data['student'][$i]['user_id'] = $user_id;
            $this->db->insert('students',  $data['student'][$i]);
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