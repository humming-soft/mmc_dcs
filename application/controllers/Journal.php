<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('project_Model');
        $this->load->model('journal_model');
        $this->load->library('session');
        $this->load->view("template/header");
        $this->load->view('template/frame');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }
    public function list_journals()
    {
        $data['records'] = $this->project_Model->project_get();
        $data['journalType'] = $this->journal_model->journal_type_get();
        $data['journal'] = $this->journal_model->journal_get();
        $this->load->view('journal/list_journals',$data);
        $this->load->view('template/footer');;
    }
    public function add_journal()
    {
        $data['records'] = $this->project_Model->project_get();
        $data['journalType'] = $this->journal_model->journal_type_get();
        $this->load->view('journal/add_journal',$data);
        $this->load->view('template/footer');;
    }
    public function add_new_journal()
    {
        $date1=date('Y-m-d H:i:s');
        $data = array('pjct_master_id' =>$this->input->post("intPjtId"),'journal_name' =>$this->input->post("strJournal"),'journal_type_id' => $this->input->post("intJournalType"),'cre_by' => $this->session->userdata('uid'),'cre_date' => $date1,'mod_by'=>$this->session->userdata('uid'),'mod_date' => $date1);
        $result = $this->journal_model->journal_add($data);
        if($result==true){
            redirect('journal/list_journals', 'refresh');
        }else{
            redirect('journal/add_journal', 'refresh');
        }
    }
    public function update_journal(){
        $id= $this->input->post('journalId');
        $jrnl_name=$this->input->post("strJournal");
        $jrnl_type = $this->input->post("intJournalType");
        $result=$this->journal_model->update_journal($id,$jrnl_name,$jrnl_type);
        if($result==true){
            redirect('journal/list_journals', 'refresh');
        }else{
            redirect('journal/add_journal', 'refresh');
        }
    }
    public function delete_journal(){
        $id= $this->input->post('id');
        $this->journal_model->delete_journal($id);
    }

}