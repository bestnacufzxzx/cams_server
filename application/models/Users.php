<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Users extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'users';
    }

    function countUsers($condition=[],$isOr=false,$isLike=false)
    {
        // $this->db->select("user.id, staff.staff_id, staff.name_title, staff.firstname, staff.lastname, staff.email, staff.phone");
        $this->db->from($this->tableName);
        // $this->db->join("staff","user.id = staff.user_id"); //***\\

        // $this->db->group_start();
        foreach($condition as $k => $v){
            if($isOr){
                if($isLike){
                    $this->db->or_like($k,$v);
                }else{
                    $this->db->or_where($k,$v);
                }
            }else{
                if($isLike){
                    $this->db->like($k,$v);
                }else{
                    $this->db->where($k,$v);
                }
            }
        }
        
        $this->db->where("users.role", 1);
        // $this->db->group_end();
        // $this->db->where("staff.deleted_at", null);
        return $this->db->count_all_results();
    }

    function getUsers($condition=[],$conditionOrder=[],$limit=null, $start=null,$isOr=false,$isLike=false) {
        foreach($conditionOrder as $k => $v){
            $this->db->order_by($k, $v);
        }

        // $this->db->select("user.id, staff.staff_id, staff.name_title, staff.firstname, staff.lastname, staff.email, staff.phone");
        $this->db->from($this->tableName);
        // $this->db->join("staff","user.id = staff.user_id");
        if(sizeof($condition) > 0 ){
            // $this->db->group_start();
            foreach($condition as $k => $v){
                if($isOr){
                    if($isLike){
                        $this->db->or_like($k,$v);
                    }else{
                        $this->db->or_where($k,$v);
                    }
                }else{
                    if($isLike){
                        $this->db->like($k,$v);
                    }else{
                        $this->db->where($k,$v);
                    }
                }
            }
            // $this->db->group_end();
        }
        $this->db->where("users.role", 1);
        
        if(!is_null($limit)&&!is_null($start)){
            $this->db->limit($limit, $start);
        }
        // dd($this->db->last_query());
        // $this->db->where("staff.deleted_at", null);
        return $this->db->get()->result_array();
    }
    
    function insert($data){
        $this->db->trans_begin();
            
            $this->db->insert("users",$data["users"]);
            $userId = $this->db->insert_id();

            $data["user_id"] = $userId;

            // $this->db->insert("staff",$data["staff"]);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
    }

    function updateRole($data){
        $this->db->trans_begin();

            if(!empty($data['user']['password'])){
                $this->db->where("id", $data['user']['id']);
                $this->db->update("users",$data["users"]);
            }

            // $this->db->where("user_id", $data["staff"]["user_id"]);
            // $this->db->update("staff",$data["staff"]);

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
    }
}