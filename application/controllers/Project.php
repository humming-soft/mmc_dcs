<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->view("template/header");
        $this->load->view('template/frame');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    /**
     * @jane
     * date:15/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is for add projects
     */
    public function add_project()
    {
        $this->load->view('project/add_project');
        $this->load->view('template/footer');
    }

    /**
     * @jane
     * date:15/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is for list projects
     */
    public function list_project()
    {
        $this->load->view('project/list_project');
        $this->load->view('template/footer');
    }
}