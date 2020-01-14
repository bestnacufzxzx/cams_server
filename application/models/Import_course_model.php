<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import_course_model extends CI_Model {
    private $tbl_name = "students";

    function import_course($data){
        $this->db->trans_begin();

            foreach ($data['course'] as $i => $v) {
                $this->db->insert('courses', $v);
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