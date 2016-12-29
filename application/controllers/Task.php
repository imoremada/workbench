<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Task
 *
 * @author Kalpani
 */
class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('download');
    }

    public function index() {
    }

    public function manageTasks($view) {
        $id = base64_decode(urldecode($view));
        $this->load->model('skill_model');
        $this->load->model('task_model');
        $data['main_content'] = "add_task_view";
        if($id === '2'){
        $data['main_content'] = "show_all_pending_task_view";
    }
     else if($id === '3'){
        $data['main_content'] = "show_all_completed_task_view";
    }
        $this->load->view("layouts/main", $data);
    }
    
    public function addTask() {
        $this->load->model('task_model');
        $publisherId = $this->session->userdata('user_id');
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'zip|rar|gif|jpg|png';
        $config['max_size'] = '8192';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $fullPath = 'null';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {
//            echo $fileName;
//            echo $this->upload->display_errors();
            $this->load->view('error_view');
        }
        else
        {
            $retData = array('upload_data' => $this->upload->data());
            $fullPath = $retData['upload_data']['full_path'];
        }
        
        $this->task_model->save($publisherId, $this->input->post('title'), $this->input->post('description'), 
                $this->input->post('estimation'), $fullPath, $this->input->post('skills'));
       
        $data['main_content'] = "home_view";
        $this->load->view("layouts/main", $data);
    }

    public function showAll() {
        $this->load->model('task_model');
        $data['main_content'] = "show_all_task_view";
        $this->load->view("layouts/main", $data);
    }

    public function pick($taskId) {
        $id = base64_decode(urldecode($taskId));
        $this->load->model('task_model');
        $userId = $this->session->userdata('user_id');
        $resultArray = $this->task_model->getUserPickedTaskByTaskId($id, $userId);
        if (empty($resultArray)) 
        {
            $this->task_model->updateUserTaskProgressTo($id, $userId, "1");

            $this->task_model->insertIntoUserTask($userId, $id);
        }
        $data['main_content'] = "show_all_task_view";
        $this->load->view("layouts/main", $data);
    }

    public function taskByUser() {
        $this->load->model('task_model');
        $data['main_content'] = "show_my_task_view";
        $this->load->view("layouts/main", $data);
    }

    public function rejectUserTask($taskId, $view) {
        $this->load->model('task_model');

        $id = base64_decode(urldecode($taskId));
        $userId = $this->session->userdata('user_id');
        $this->task_model->updateUserTaskProgressTo($id, $userId, "0");

        $this->task_model->rejectUserTask($id, $userId);
        $viewTobeDisplayed = '';
        if (base64_decode(urldecode($view)) === '1') {
            $viewTobeDisplayed = 'show_all_task_view';
        } else {
            $viewTobeDisplayed = 'show_my_task_view';
        }
        $data['main_content'] = $viewTobeDisplayed;
        $this->load->view("layouts/main", $data);
    }

     public function finishUserTask($taskId) {
        $this->load->model('task_model');

        $id = base64_decode(urldecode($taskId));
        $userId = $this->session->userdata('user_id');
        $this->task_model->updateUserTaskProgressTo($id,$userId, "2");
        
        $this->task_model->completeUserTask($id, $userId);
        
        $data['main_content'] = 'show_my_task_view';
        $this->load->view("layouts/main", $data);
    }
    
    public function download($filePath)
    {
        force_download($id = base64_decode(urldecode($filePath)), NULL);
    }
    
    public function remove($taskId)
    {
        $this->load->model('task_model');
        $id = base64_decode(urldecode($taskId));
        $userId = $this->session->userdata('user_id');
        $this->task_model->delete($id);
        $data['main_content'] = 'show_all_completed_task_view';
        $this->load->view("layouts/main", $data);
    }
    
    public function closeTask($taskId, $uId) {
        $this->load->model('task_model');
        $this->load->model('user_model');

        //$id = base64_decode(urldecode($taskId));
        //$userId = base64_decode(urldecode($uId));
        //$this->task_model->updateTaskProgressTo($id, "2");
        
        //$this->task_model->updateTaskCompletedUser($id, $userId);  
        
        $data['taskId'] = $taskId;
        $data['userId'] = $uId;
        $data['main_content'] = 'finalize_task_view';
        
        $this->load->view("layouts/main", $data);
    }
    
    public function finalize()
    {
        $this->load->model('task_model');
        $id = $this->input->post('task_id');
        $userId = $this->input->post('user_id');
        $rating = $this->input->post('rating');
        
        $this->task_model->updateTaskProgressTo($id, "2");
        
        $this->task_model->updateTaskCompletedUser($id, $userId);  
        $this->task_model->updateUserTaskRatingTo($userId, $id, $rating);
        
        $data['main_content'] = 'show_all_completed_task_view';
        
        $this->load->view("layouts/main", $data);
    }
}
