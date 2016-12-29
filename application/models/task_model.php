<?php

class task_model extends CI_Model {

    public function save($publisherId, $title, $desc, $estimation, $filePath, $skills) {
        $data = array(
            'title' => $title,
            'description' => $desc,
            'estimated_time' => $estimation,
            'attachment_path' => $filePath,
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

    public function getAllTasks() {
        $query = $this->db->query('SELECT * FROM task');
        $ret = $query->result_array();
        return $ret;
    }

    public function updateTaskProgressTo($taskId, $progress) {
        $taskData = array(
            'progress' => $progress
        );

        $condition = array(
            'id' => $taskId
        );
        $this->db->where($condition);
        $this->db->update('task', $taskData);
    }

    public function insertIntoUserTask($uId, $taskId) {
        $userTaskData = array(
            'user_id' => $uId,
            'task_id' => $taskId,
            'status' => '1'
        );
        $this->db->insert('user_task', $userTaskData);
    }

    public function getAllCurrentUserInprogressTasks() {
        $userId = $this->session->userdata('user_id');
        $query = $this->db->query('SELECT * FROM task, user_task WHERE user_task.task_id = task.id AND user_task.status = 1'
                . ' AND user_task.user_id = ' . $userId);
        $ret = $query->result_array();
        return $ret;
    }

    public function getAllTaskByProgress($progress) {

        $query = $this->db->query('SELECT * FROM task, user_task WHERE user_task.task_id = task.id AND task.progress = ' . $progress);
        $ret = $query->result_array();
        return $ret;
    }

    public function reject($taskId, $userId) {
        $array = array('task_id' => $taskId, 'user_id' => $userId);
        $this->db->where($array);
        $this->db->delete('user_task');
    }

    public function delete($taskId) {
        $array = array('id' => $taskId);
        $this->db->where($array);
        $this->db->delete('task');

        $array1 = array('task_id' => $taskId);
        $this->db->where($array1);
        $this->db->delete('user_task');

        $array2 = array('task_id' => $taskId);
        $this->db->where($array2);
        $this->db->delete('task_skill');
    }

    public function completeUserTask($taskId, $userId) {

        $condition = array(
            'task_id' => $taskId,
            'user_id' => $userId
        );

        $curDate = date("Y-m-d");
        $array = array('end_date' => $curDate);
        $this->db->where($condition);
        $this->db->update('user_task', $array);
    }

    public function updateUserTaskProgressTo($taskId, $userId, $progress) {
        $taskData = array(
            'status' => $progress
        );
        $condition = array(
            'task_id' => $taskId,
            'user_id' => $userId
        );
        $this->db->where($condition);
        $this->db->update('user_task', $taskData);
    }

    public function getUserPickedTaskByTaskId($taskId, $userId) {

        $query = $this->db->query('SELECT * FROM user_task WHERE task_id =' . $taskId . ' AND user_id = ' . $userId);
        $ret = $query->result_array();
        return $ret;
    }

    public function getAllUserPickedTasksByProgress($progress) {

        $query = $this->db->query('SELECT * FROM task, user_task WHERE user_task.task_id = task.id AND user_task.status = ' . $progress);
        $ret = $query->result_array();
        return $ret;
    }

    public function updateTaskCompletedUser($taskId, $userId) {
        $taskData = array(
            'completed_user_id' => $userId
        );

        $condition = array(
            'id' => $taskId
        );
        $this->db->where($condition);
        $this->db->update('task', $taskData);
    }

    public function getTaskById($taskId) {

        $query = $this->db->query('SELECT * FROM task WHERE id = ' . $taskId);
        $ret = $query->result_array();
        return $ret;
    }

    public function updateUserTaskRatingTo($userId, $taskId, $rating) {
        $taskData = array(
            'rating' => $rating
        );

        $condition = array(
            'task_id' => $taskId,
            'user_id' => $userId
        );
        $this->db->where($condition);
        $this->db->update('user_task', $taskData);
    }

}
