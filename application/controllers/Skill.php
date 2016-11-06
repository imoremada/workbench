<?php

class Skill extends CI_Controller {
    
    public function index() {
        $data['main_content'] = "add_skill_view";
	$this->load->view("layouts/main", $data);
    }
    
    public function addSkill(){
        $this->load->model('skill_model');
        $this->skill_model->addSkill();
        $data['main_content'] = "home_view";
        $this->load->view("layouts/main", $data);
    }
}
