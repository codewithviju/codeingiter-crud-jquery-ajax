<?php 

class userModel extends CI_Model
{
    var $table = "users";

    public function getAllData($criteria = array())
    {
       $this->db->select("*");
       $this->db->from($this->table);
       if (!empty($criteria['searchVal'])) {
        $searchVal = $criteria['searchVal'];
        $this->db->where("(Username LIKE '%$searchVal%' OR Email LIKE '%$searchVal%' OR Marks LIKE '%$searchVal%')");
    }
    
       $result = $this->db->get();
       return $result->result();
    }

    public function insert($data)
    {
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }

    public function update($where,$data)
    {
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }
    public function deleteUser($criteria = array())
    {
        $this->db->where('UserID', $criteria['UserID']);
        return $this->db->delete($this->table);
    }
    public function getByID($criteria)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        if(!empty($criteria['UserID']))
        {
            $this->db->where("UserID",$criteria['UserID']);
        }
        $result = $this->db->get();
        return $result->row();
    }
}

?>