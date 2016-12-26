<?php

class task_model extends CI_Model {

    public function save($publisherId, $title, $desc, $estimation, $filePath, $skills) {
        $data = array(
            'title' => $title,
            'description' => $desc,
            'estimated_time' => $estimation,
            'attachment_path' =>$filePath,
            'publisher_id' => $publisherId
        );
        $this->db->insert('task', $data);
        $task_id = $this->db->insert_id();
        
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
        $userId = $this->session->userdata('user_id');
        $query = $this->db->query('SELECT * FROM task, user_task WHERE user_task.task_id = task.id AND task.progress = 1'
                . ' AND user_task.user_id = '.$userId);
        $ret = $query->result_array(); 
        return $ret;
    }
    
     public function reject($taskId, $userId){
           $array = array('task_id' => $taskId, 'user_id' => $userId);
           $this->db->where($array);
           $this->db->delete('user_task');
     }
}
