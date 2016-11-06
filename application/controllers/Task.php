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

    public function index() {
        $this->load->model('skill_model');
        $data['main_content'] = "add_task_view";
	$this->load->view("layouts/main", $data);
    }
    
    public function addTask(){
        $this->load->model('task_model');
        $publisherId = $this->session->userdata('user_id');
        $this->task_model->save($publisherId);
        $data['main_content'] = "home_view";
        $this->load->view("layouts/main", $data);
    }
    
    public function showAll(){
        $this->load->model('task_model');
        $data['main_content'] = "show_all_task_view";
	$this->load->view("layouts/main", $data);
    }
    
    public function pick($taskId){
         $id = base64_decode(urldecode($taskId));
         $this->load->model('task_model');
         $this->task_model->updateProgressTo($id, "1");
         
          $userId = $this->session->userdata('user_id');
          $this->task_model->insertIntoUserTask($userId, $id);
          
          $data['main_content'] = "show_all_task_view";
          $this->load->view("layouts/main", $data);
    }
     
    public function taskByUser() {
        $this->load->model('task_model');
        $data['main_content'] = "show_my_task_view";
	$this->load->view("layouts/main", $data);
    }
}
