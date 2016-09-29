<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('project_Model');
        $this->load->library('session');
        $this->load->view("template/header");
        $this->load->view('template/frame');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    public function list_project()
    {
        $data['records'] = $this->project_Model->getProject();
        $this->load->view('project/list_project',$data);
        $this->load->view('template/footer');
    }

    public function add_project()
    {
        $this->load->view('project/add_project');
        $this->load->view('template/footer');
        //test
    }
    public function add_new_project()
    {
        $username = $this->session->userdata('username');
        $id=$this->session->userdata('uid');
        $data = array('pjct_name' =>$this->input->post("strProjectName"),'pjct_from' => date("Y-m-d", strtotime($this->input->post("dateFrom"))),'pjct_to'=>date("Y-m-d", strtotime($this->input->post("dateTo"))));
        $result = $this->project_Model->project_add($data);
        if($result==true){
            redirect('project/list_project', 'refresh');
        }else{
            $this->load->view('project/add_project');
            $this->load->view('template/footer');
        }
    }
    public function delete_project(){
        $id= $this->input->post('id');
        $this->project_Model->delete_Project($id);
    }
    public function update_project(){
        $id= $this->input->post('projectId');
        $pjct_name=$this->input->post("strProjectName");
        $pjct_from = $this->input->post("dateFrom");
        $pjct_to=$this->input->post("dateTo");
        $result=$this->project_Model->update_project($id,$pjct_name,$pjct_from,$pjct_to);
        if($result==true){
            $sess_array = array("message" =>"Added Successfully","type" => 1);
            $this->session->set_userdata('message', $sess_array);
            $this->load->view('project/list_project');
            $this->load->view('template/footer');
        }
        else
        {
            return false;
        }
    }


}