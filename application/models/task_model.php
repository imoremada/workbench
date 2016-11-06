<?php

class task_model extends CI_Model {

    public function save($publisherId) {
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'estimated_time' => $this->input->post('estimation'),
            'publisher_id' => $publisherId
        );
        $this->db->insert('task', $data);
        $task_id = $this->db->insert_id();
        $skills = $this->input->post('skills');
        foreach ($skills as $item) {
            $skillData = array(
                'skill_id' => $item,
                'task_id' => $task_id
            );
            $this->db->insert('task_skill', $skillData);
        }
    }

    public function getAllTasks(){
         $query = $this->db->query('SELECT * FROM task');
        $ret = $query->result_array(); 
        return $ret;
    }
    
    public function updateProgressTo($taskId, $progress){
        $taskData = array(
            'progress' => $progress
        );

        $this->db->where('id', $taskId);
        $this->db->update('task', $taskData);
    }
    
    public function insertIntoUserTask($uId, $taskId){
        $userTaskData = array(
            'user_id' => $uId,
            'task_id' => $taskId,
            'status' =>'1'
        );
        $this->db->insert('user_task', $userTaskData);
    }
    
     public function getAllInprogressTasks(){
        $query = $this->db->query('SELECT * FROM task where progress = 1');
        $ret = $query->result_array(); 
        return $ret;
    }
}
