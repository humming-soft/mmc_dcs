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

    public function add_project()
    {
        $this->load->view('project/add_project');
        $this->load->view('template/footer');
    }
}