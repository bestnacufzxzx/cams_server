<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Role_model extends CI_Model {
    private $tbl_name = "role";

    function insert($roleID,$roleName){
        $this->db->set('roleID', $roleID);
        $this->db->set('roleName', $roleName);
        $this->db->insert('role');
        $result = $this->db->get($this->tbl_name);
        return $result;
    }
    function updete($roleID,$roleName){
        $this->db->where('roleID',$roleID);    
        $this->db->set('roleID', $roleID);
        $this->db->set('roleName', $roleName);
         //$this->db->update($tbl_name, $data);
         $result = $this->db->get($this->tbl_name);
         return $result->result();
     }
     function delete($roleID){
        //$this->db->where('courseID',$courseID);
        //$this->db->delete($tbl_name);
        $this->db->where('roleID', $roleID);
        $this->db->delete('role');
        $result = $this->db->get($this->tbl_name);
        return $result->result();
    }
    function get_all($roleID){
        $this->db->like('roleID',$roleID);
        $result = $this->db->get($this->tbl_name);
        return $result->result();

    }

}