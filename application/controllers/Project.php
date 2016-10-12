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
        $data['category'] = $this->project_Model->getCategory();
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
        $data = array('pjct_name' =>$this->input->post("strProjectName"),'pjct_desc' =>$this->input->post("strProjectDesc"),'pjct_from' => date("Y-m-d", strtotime($this->input->post("dateFrom"))),'pjct_to'=>date("Y-m-d", strtotime($this->input->post("dateTo"))),'cont_name'=>$this->input->post("strContractName"),'has_parking'=>$this->input->post("intParking"),'has_depot'=>$this->input->post("intDepot"), 'created_by' =>$this->session->userdata('uid'),'created_date'=>date('Y-m-d H:i:s'),'modified_by'=>$this->session->userdata('uid'), 'modified_date'=>date('Y-m-d H:i:s'));
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
        $pjct_desc=$this->input->post("strProjectDesc");
        $pjct_from = $this->input->post("dateFrom");
        $pjct_to=$this->input->post("dateTo");
        $cont_name=$this->input->post("strContractName");
        $has_parking=$this->input->post("intParking");
        $has_depot=$this->input->post("intDepot");
        $modified_by=$this->session->userdata('uid');
        $modified_date=date('Y-m-d H:i:s');
        $result=$this->project_Model->update_project($id,$pjct_name,$pjct_from,$pjct_to,$pjct_desc,$cont_name,$has_parking,$has_depot,$modified_by,$modified_date);
        if($result==true){
            redirect('project/list_project', 'refresh');
        }
        else
        {
            return false;
        }
    }

}