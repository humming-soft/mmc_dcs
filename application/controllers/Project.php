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
    public function addNewProject()
    {
        $data = array('pjct_name' =>$this->input->post("strProjectName"),'pjct_from' => $this->input->post("dateFrom"),'pjct_to'=>$this->input->post("dateTo"));
        $result = $this->project_Model->addNewProject($data);
        if($result==true){
            redirect('project/list_project', 'refresh');
        }else{
            $this->load->view('project/add_project');
            $this->load->view('template/footer');
        }
    }
    public function deleteProject(){
        $id= $this->input->post('id');
        $this->project_Model->delete_Project($id);
    }
    public function updateProject(){
        $id= $this->input->post('projectId');
        $pjct_name=$this->input->post("strProjectName");
        $pjct_from = $this->input->post("dateFrom");
        $pjct_to=$this->input->post("dateTo");
        $result=$this->project_Model->update_project($id,$pjct_name,$pjct_from,$pjct_to);
        if($result==true){
            redirect('project/list_project', 'refresh');
        }
        else
        {
            return false;
        }
    }
}