<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin_showcourse_model extends CI_Model{

        private $tbl_name = "courses";

        function get_all_courses(){
            $result = $this->db->get($this->tbl_name);
            return $result->result();   //result คือ อาเรย์ of object
        }

        function delete_teaching($teachingID){    
            $this->db->where('teachingID', $teachingID); 
            return $this->db->delete('teaching');  
        }

        // delete_courseid
        function delete_courseid($courseID){    
            $this->db->where('courseID', $courseID); 
            return $this->db->delete($this->tbl_name);  
        }
        function delete_coursesid_teaching($courseID){
            // $this->db->from('room');
            // $this->db->join('building', 'building.courseID = room.courseID');
            $this->db->where('teaching.courseID', $courseID);
            $this->db->delete('teaching');
            $result = $this->db->get('teaching');
            return $result->result();
        }

        //studentsregeterID
        function delete_studentsregeter_model($studentsregeterID){    
            $this->db->where('studentsregeterID', $studentsregeterID); 
            return $this->db->delete('studentsregeter');  
        }

        // importcorses
        function import($data){
            $this->db->trans_begin();
            $result["successData"] = [];
            $result["duplicateData"] = [];
            $result['emptyData'] = [];
    
            foreach ($data as $key => $row) {
    
                $isDuplicate = $this->isImportDuplicate($row["courses"]["courseID"],$row["courses"]["courseCode"],$row["courses"]["courseName"]);
                if(!$isDuplicate){
    
                    if(!isNull($row["courses"])){
                    $this->db->insert('courses', $row["courses"]);

                    $result["successData"][] = array(
                        "courseCode" => $row["courses"]["courseCode"],
                        "courseName" => $row["courses"]["courseName"],
                    );
                    }else{
                        $result['emptyData'][] = $result;
                    }
                }else{
                    $result["duplicateData"][] = array(
                        "courseCode" => $row["courses"]["courseCode"],
                        "courseName" => $row["courses"]["courseName"],                        
                    );
                }
    
            }
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            }else{
                $this->db->trans_commit();
                return $result;
            }
        }  

        function showusername_teacher_model(){
            $result = $this->db->get($this->tbl_name);
            return $result->result();   //result คือ อาเรย์ of object
        }
        // function import($data){
        //     try {
        //         // Start a new transaction
        //         $this->db->beginTransaction();
        //         foreach ($data as $obj) {
        //             if(!empty($obj->username)){
        //                 $sql = "INSERT INTO `courses`(`courseID`, `courseCode`, `courseName`) VALUES (
        //                     null, :courseCode, :courseName
        //                 )";
        //                 $query = $this->db->prepare($sql);
        //                 $query->bindValue('courseCode', $obj->courseCode);
        //                 $query->bindValue('courseName', $obj->courseCode);
        //                 $query->execute();   
        //             }
        //         }    
        
        //         // Commit all transaction changes
        //         $this->db->commit();
        //         return true;
        //     } catch (\Exception $exception) {
        //         // Roll back all transaction changes
        //         $this->db->rollBack();
        //         return false;
        //         // $returning_info['error_message'] = $exception->getMessage();
        //     }
        // }

    }
?>