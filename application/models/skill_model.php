<?php

class skill_model extends CI_Model {

    public function getAllSkills(){
        $query = $this->db->query('SELECT * FROM skill');
        $ret = $query->result_array(); 
        return $ret;
    }
    
    public function addSkill(){
         $data = array(
            'type' => $this->input->post('skill'),
            'description' => $this->input->post('description')
        );
          $this->db->insert('skill', $data);
    }
    
    public function editSkill(){
        
    }
}

