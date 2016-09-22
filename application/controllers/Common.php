<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->view("template/header");
        $this->load->view('template/frame');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    public function index()
    {
        $this->load->view('template/dashboard');
        $this->load->view('template/footer');
    }

    public function list_project()
    {
        $this->load->view('project/list_project');
        $this->load->view('template/footer');
    }

    public function form2()
    {
        $this->load->view('forms2');
        $this->load->view('template/footer');
    }

    public function imageupload()
    {
        $this->load->view('image_upload',array('error' => ' ','success' => ' ' ));
        $this->load->view('template/footer');
    }

    public function doupload() {

     $root = $_SERVER['DOCUMENT_ROOT'];
     $name;
     $temp;
     $album;
     $date;
     $des;
     $chk = 0;
     $temp = array();
     $name = array();
     $data = array();
     if($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])){
        $filesCount = count($_FILES['userFiles']['name']);
        for($i = 0; $i < $filesCount; $i++){
            $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
            $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
            $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
            $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
            $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
                // echo '<pre>';
                // print_r($name[0]);
                // echo '</pre>';
            $name = explode('.', $_FILES['userFiles']['name'][$i]);
            $temp = explode('_', $name[0]);
            $album = $temp[0];
            $date = $temp[1];
            $desc = $temp[2]; 
                // print "$album <br />";
                // print "$date <br />" ;
                // print "$desc <br />" ;

            // check whether there is a folder in the document root if not create
            if (!is_dir($root.'/'.'gallery')) 
            {
                mkdir($root.'/'.'gallery', 0777, true);
            }        

            // check whether there is a folder for album inside the gallery if not create
            if (!is_dir($root.'/'.'gallery'.'/'.$album)) 
            {
                mkdir($root.'/'.'gallery'.'/'.$album, 0777, true);
            }  
            // check whether there is a folder for date inside the album if not create
            if (!is_dir($root.'/'.'gallery'.'/'.$album.'/'.$date)) 
            {
                mkdir($root.'/'.'gallery'.'/'.$album.'/'.$date, 0777, true);
            }

            $uploadPath = $root.'/'.'gallery'.'/'.$album.'/'.$date;
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('userFile'))
            {
                $chk = 1;
            }
        }
        if($chk == 1)
        {
        $error = array('error' => 'Image Upload Failed, Try Again !','success' => '');
        }
        else
        {
        $error = array('error' => '','success' => 'Image Upload Successfully!'); 
        }
        $this->load->view('image_upload',$error);
        $this->load->view('template/footer');
    }
    else{
        // throw server side error
    }

}

public function validation()
{
    $this->load->view('validation');
    $this->load->view('template/footer');			
}

public function validation_submit()
{
 $this->form_validation->set_rules('name','Name','trim|required');
 $this->form_validation->set_rules('mobile','Mobile No','trim|required');
 $this->form_validation->set_rules('email','Email Id','trim|required');	
 if ($this->form_validation->run() == TRUE)
 {
 }
 else
 {
    $this->load->view('validation');
    $this->load->view('template/footer');	
}
}

public function form4()
{
    $this->load->view('forms');
}	
}
