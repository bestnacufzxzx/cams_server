<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Building_model extends CI_Model {
    private $tbl_name = "building";

    function insert($buildingID,$buildingName){
        $this->db->set('buildingID', $buildingID);
        $this->db->set('buildingName', $buildingName);
        $this->db->insert('building');
        $result = $this->db->get($this->tbl_name);
        return $result;
    }
    function updete($buildingID,$buildingName){
        $this->db->where('buildingID',$buildingID);    
        $this->db->set('buildingID', $buildingID);
        $this->db->set('buildingName', $buildingName);
         //$this->db->update($tbl_name, $data);
         $result = $this->db->get($this->tbl_name);
         return $result->result();
     }
     function delete($buildingID){
        //$this->db->where('courseID',$courseID);
        //$this->db->delete($tbl_name);
        $this->db->where('buildingID', $buildingID);
        $this->db->delete('building');
        $result = $this->db->get($this->tbl_name);
        return $result->result();
    }
    function get_all($buildingID){
        $this->db->like('buildingID',$buildingID);
        $result = $this->db->get($this->tbl_name);
        return $result->result();

    }

}