<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Showimportstudent_model extends CI_Model{

        private $tbl_name = "students";

        function get_all($keyword){
            $this->db->like('firstName', $keyword);
            $result = $this->db->get($this->tbl_name);
            return $result->result();   //result คือ อาเรย์ of object
        }

    }
?>