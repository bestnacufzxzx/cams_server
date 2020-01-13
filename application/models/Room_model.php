<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Room_model extends CI_Model {
    private $tbl_name = "room";

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

    function get_class_room($classID){
        $this->db->from($this->tbl_name);
        $this->db->join('class', 'room.roomID = class.roomID');
        $this->db->where('class.classID', $classID);
        $query = $this->db->get();
        return $query->row();
    }

}