<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataentry extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('journal_model');
        $this->load->model('project_Model');
        $this->load->view("template/header");
        $this->load->view('template/frame');
        $this->load->library('excel');
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }
    /**
     * @jane
     * date:15/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is to show the data entry page
     */
    public function add_data(){
        $this->load->view('data_entry/add_data');
        $this->load->view('template/footer');
    }
    public function list_dataentry(){
        $data['records'] = $this->project_Model->project_get();
        $data['journalType'] = $this->journal_model->journal_type_get();
        $data['journal'] = $this->journal_model->journal_get();
        $this->load->view('data_entry/list_dataentry',$data);
        $this->load->view('template/footer');
    }
    /**
     * @Ancy
     * date:29/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is to save the Excel and CSV data in to Database
     */
    public function parse_data(){
        $parse_array = array();
            $file = $_FILES['file']['tmp_name'];
            $parse_array = $this->parse_excel($file);
            $highestRow = $this->get_row($file);
            $id=$this->input->post("journalid");
            $data_date=date("Y-m-d", strtotime($this->input->post("datadate")));
            $cre_by = $this->session->userdata('uid');
            $crea_date = date('Y-m-d H:i:s');
            $mod_date = date('Y-m-d H:i:s');
            $mod_by = $this->session->userdata('uid');
            $row=$this->journal_model->get_journal_name($id);
            foreach ($row as $row):
                $journalname=$row['journal_name'];
            endforeach;
            switch( strtoupper($journalname)){
            /*($val['INSTALL_PERCENTAGE'] == null || $val['INSTALL_PERCENTAGE'] == "") ? '' :  $val['INSTALL_PERCENTAGE']."%",*/
                case "V1 KPI": case "V2 KPI": case "V3 KPI": case "V4 KPI": case "V5 KPI": case "V6 KPI": case "V7 KPI":$i = 2;
                    while ($i <= $highestRow) {
                        $kpi_type=(empty($parse_array[$i][0])) ? "" : $parse_array[$i][0];
                        $baseline=(empty($parse_array[$i][1]) || !is_numeric($parse_array[$i][1]))? 0.00 :$parse_array[$i][1];
                        $kpi_target=(empty($parse_array[$i][2]) || !is_numeric($parse_array[$i][2]))? 0.00 :$parse_array[$i][2];
                        $actual=(empty($parse_array[$i][3]) || !is_numeric($parse_array[$i][3]))? 0.00 :$parse_array[$i][3];
                        $res = $this->common_model->parse_data_kpi($id,$kpi_type,$baseline,$kpi_target,$actual, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);
                        $i++;
                    }
                    if($res){
                        redirect('dataentry/list_dataentry', 'refresh');
                    }else{
                        redirect('journal/list_journals', 'refresh');
                    }
                    break;
                case "V1 KDI": case "V2 KDI":case "V3 KDI":case "V4 KDI":case "V5 KDI" : case "V6 KDI" : case "V7 KDI":$i = 2;
                while ($i <= $highestRow) {
                    $kd_desc=(empty($parse_array[$i][0]))? "" :$parse_array[$i][0];
                    $forecast_date=(empty($parse_array[$i][1]))? "" :date("Y-m-d", strtotime($parse_array[$i][1]));
                    $contract_date=(empty($parse_array[$i][2]))? "" :date("Y-m-d", strtotime($parse_array[$i][2]));
                    $dps_date=(empty($parse_array[$i][3]))? "" :date("Y-m-d", strtotime($parse_array[$i][2]));
                    $res = $this->common_model->parse_data_kdi($id, $data_date,$kd_desc,$forecast_date,$contract_date,$dps_date, $cre_by, $crea_date, $mod_by, $mod_date);
                    $i++;
                }
                if($res){
                    redirect('dataentry/list_dataentry', 'refresh');
                }else{
                    redirect('journal/list_journals', 'refresh');
                }
                break;
                case "PROGRAM MASTER":$i = 2;
                while ($i <= $highestRow) {
                    $prgm_sub_name =(empty($parse_array[$i][0]))? "" :$parse_array[$i][0];
                    $early_prec=(empty($parse_array[$i][1])|| !is_numeric($parse_array[$i][1]))? 0.00 :$parse_array[$i][1];
                    $actual_prec=(empty($parse_array[$i][2])|| !is_numeric($parse_array[$i][2]))? 0.00 :$parse_array[$i][2];
                    $late_prec=(empty($parse_array[$i][3])|| !is_numeric($parse_array[$i][3]))? 0.00 :$parse_array[$i][3];
                    $early_varience=(empty($parse_array[$i][4])|| !is_numeric($parse_array[$i][4]))? 0.00 :$parse_array[$i][4];
                    $late_varience=(empty($parse_array[$i][5])|| !is_numeric($parse_array[$i][5]))? 0.00 :$parse_array[$i][5];
                    $res = $this->common_model->parse_data_project_master($id,$prgm_sub_name,$early_prec,$actual_prec,$late_prec,$early_varience,$late_varience, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);
                    $i++;
                }
                if($res){
                    redirect('dataentry/list_dataentry', 'refresh');
                }else{
                    redirect('journal/list_journals', 'refresh');
                }
                break;
                case "V1 SAFTY INCIDENT": case "V2 SAFTY INCIDENT":case "V3 SAFTY INCIDENT":case "V4 SAFTY INCIDENT":case "V5 SAFTY INCIDENT" : case "V6 SAFTY INCIDENT" : case "V7 SAFTY INCIDENT":$i = 1;
                    while ($i <= $highestRow) {
                        $incident_date=$parse_array[$i][0];
                        $incident_desc=$parse_array[$i][1];
                        $res = $this->common_model->parse_data_safty_incident($id, $data_date,$incident_date,$incident_desc, $cre_by, $crea_date, $mod_by, $mod_date);
                        $i++;
                    }
                    if($res){
                        redirect('dataentry/list_dataentry', 'refresh');
                    }else{
                        redirect('journal/list_journals', 'refresh');
                    }
                    break;
                   default:redirect('journal/list_journals', 'refresh');
                    break;
             }

    }
    /**
     * @Ancy
     * date:29/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is to get number of rows in the file
     */
    public function get_row($file){
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
        return $highestRow;
    }
    /**
     * @Ancy
     * date:29/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is to get file records
     */
    public function parse_excel($file){
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        PHPExcel_Shared_Date::ExcelToPHP($dateValue = 0, $adjustToTimezone = FALSE, $timezone = NULL);
        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
        $c = $objPHPExcel->getActiveSheet()->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($c);
        $val = array();
        for ($row = 1; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col,$row);
                if(PHPExcel_Shared_Date::isDateTime($cell)) {
                    $InvDate= $cell->getValue();
                    $cellVal = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate));
                }
                else{
                    $cellVal=$cell->getValue();
                }
               /* $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row)->getValue();*/
                $val[$row][$col] = $cellVal;
        }
        }
        return $val;
    }

    public function doupload() {
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        $id=$this->input->post("journalimage");
        $data_date=date("Y-m-d", strtotime($this->input->post("datadateImage")));
        $userid = $this->session->userdata('uid');
        $row=$this->project_Model->get_project_name($id);
        foreach ($row as $row):
            $projectname=trim($row['pjct_name']);
        endforeach;
        $chk=0;
        $count=0;
        for($i=0; $i<$cpt; $i++)
        {
            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];
            $array = explode('_', $_FILES['userfile']['name']);
            if(sizeof($array)==3){
                $project = (empty($array[0])) ? "" : trim($array[0]);
                $array2 = explode('.',$array[2]);
                $description = (empty($array2[0])) ? "" : $array2[0];
                if (strlen(substr($array[1], 0, 2)) == 2 && strlen(substr($array[1], 2, 2)) == 2 && strlen(substr($array[1], 4, 4)) == 4 && is_numeric(substr($array[1], 0, 2)) && is_numeric(substr($array[1], 2, 2)) && is_numeric(substr($array[1], 4, 4))) {
                    $uploaddate = (empty($array[1])) ? "" : date("Y-m-d", strtotime(substr($array[1], 0, 2) . '-' . substr($array[1], 2, 2) . '-' . substr($array[1], 4, 4)));
                } else {
                    $uploaddate = "";
                }
            }else{
                $project="";
                $description="";
                $uploaddate="";
            }
            // check whether there is a folder in the document root if not create
            if (!is_dir('gallery')) {
                mkdir('./gallery', 0777, true);
            }
            if (!is_dir('gallery/'.$id)) {
                mkdir('./gallery/'.$id, 0777, true);
            }
            if (!is_dir('gallery/'.$id.'/'.$data_date)) {
                mkdir('./gallery/'.$id.'/'.$data_date, 0777, true);
            }
            $config['upload_path'] = 'gallery/'.$id.'/'.$data_date.'/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '0';
            $config['overwrite']     = FALSE;
            $this->upload->initialize($config);
            if(strcasecmp($projectname,$project)==0){
                if($this->upload->do_upload()){
                    $filedetails=$this->upload->data();
                    $data = array('journal_master_id' => $id,'image_name' => $filedetails['file_name'],'image_path' => $filedetails['file_path'],'image_desc'=>$description,'image_upload_date'=>$uploaddate,'data_date' =>$data_date,'crea_date' => date('Y-m-d H:i:s'),'mod_date' => date('Y-m-d H:i:s'),'cre_by'=>$userid,'mod_by'=>$userid);
                    $this->common_model->image_upload($data);
                    $count++;
                    $chk=1;
                }
            }
        }
        if($chk==1){
            $this->session->set_flashdata('success', $count."  picture(s) attached with journal.");
            redirect('dataentry/list_dataentry', 'refresh');
        }else{
            $this->session->set_flashdata('error', 'Picture not uploaded.');
            redirect('dataentry/list_dataentry', 'refresh');
        }
    }
}

   /* public function doupload() {
            $id=$this->input->post("journalimage");
            $data_date=date("Y-m-d", strtotime($this->input->post("datadate")));
            $cre_by = $this->session->userdata('uid');
            $crea_date = date('Y-m-d H:i:s');
            $mod_date = date('Y-m-d H:i:s');
            $mod_by = $this->session->userdata('uid');
            $row=$this->journal_model->get_journal_name($id);
            foreach ($row as $row):
                $journalname=$row['journal_name'];
            endforeach;
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
                $name = explode('.', $_FILES['userFiles']['name'][$i]);
                $temp = explode('_', $name[0]);
                $album = $temp[0];
                $date = $temp[1];
                $desc = $temp[2];
                // check whether there is a folder in the document root if not create
                if (!is_dir($root.'/'.'gallery')) {
                    mkdir($root.'/'.'gallery', 0777, true);
                }
                // check whether there is a folder for album inside the gallery if not create
                if (!is_dir($root.'/'.'gallery'.'/'.$album)) {
                    mkdir($root.'/'.'gallery'.'/'.$album, 0777, true);
                }
                // check whether there is a folder for date inside the album if not create
                if (!is_dir($root.'/'.'gallery'.'/'.$album.'/'.$date)) {
                    mkdir($root.'/'.'gallery'.'/'.$album.'/'.$date, 0777, true);
                }
                $uploadPath = $root.'/'.'gallery'.'/'.$album.'/'.$date;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile'))
                {
                    $filedetails=$this->upload->data();
                    $data = array('data_entry_no' => $id,'pict_file_name' => $filedetails['file_name'],'pict_file_path' => '/journalimagenonp/'.$id.'/'.$userid.'/','pict_definition' => $this->input->post('imagedesc'),'pict_user_id' => $userid,'data_source' => '1');
                    $this->assessment->add_journal_data_entry_picturenonp($data);
                    $chk == 1;

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

    }*/

    /* for ($x = 1; $x <= $r; $x++) {
               $a=array();
               foreach ($cell_collection as $cell) {
                   $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                   $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                   $data_value = $objPHPExcel->getActiveSheet()->getCell($column.$x)->getValue();
                   if (empty($data_value)) {
                       echo "---";
                   } else {
                       echo "<br>";
                       array_push($a,$data_value);
                       echo $data_value;
                       echo "<br>";
                   }
               }
           }*/
        /*if (isset($_POST["submit"])) {
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file, "r");
            $c = 0;
            while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                $viaduct_master_id = $filesop[0];
                $incident_date = $filesop[1];
                $incident_desc = $filesop[2];
                $data_date = $filesop[3];
                $cre_by = $filesop[4];
                $crea_date = $filesop[5];
                $mod_by = $filesop[6];
                $mod_date = $filesop[7];
                $res = $this->common_model->parse_data($viaduct_master_id, $incident_date, $incident_desc, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);
                $c = $c + 1;
            }
            if ($res) {
                echo "You database has imported successfully . You have inserted " . $c . " recoreds";
                exit;
            } else {
                echo "Sorry!There is some problem .";
                exit;
            }

        }*/
/*public function get_column($file){
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $c = $objPHPExcel->getActiveSheet()->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($c);
        return $highestColumnIndex;
    }*/


/*$viaduct_master_id = $parse_array[$i][0];
$incident_desc = $parse_array[$i][2];
$incident_date = date("Y-m-d", strtotime($parse_array[$i][1]));
$data_date =date("Y-m-d", strtotime($parse_array[$i][3]));
$cre_by = $this->session->userdata('uid');
$crea_date = date('Y-m-d H:i:s');
$mod_date = date('Y-m-d H:i:s');
$mod_by = $this->session->userdata('uid');
$res = $this->common_model->parse_data($viaduct_master_id, $incident_date, $incident_desc, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);*/