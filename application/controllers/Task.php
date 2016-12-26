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
        $this->load->model('skill_model');
        $data['main_content'] = "add_task_view";
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

    public function reject($taskId, $view) {
        $this->load->model('task_model');

        $id = base64_decode(urldecode($taskId));
        $this->task_model->updateProgressTo($id, "0");
        $userId = $this->session->userdata('user_id');

        $this->task_model->reject($id, $userId);
        $viewTobeDisplayed = '';
        if (base64_decode(urldecode($view)) === '1') {
            $viewTobeDisplayed = 'show_all_task_view';
        } else {
            $viewTobeDisplayed = 'show_my_task_view';
        }
        $data['main_content'] = $viewTobeDisplayed;
        $this->load->view("layouts/main", $data);
    }

    public function download($filePath)
    {
        force_download($id = base64_decode(urldecode($filePath)), NULL);
    }
}
