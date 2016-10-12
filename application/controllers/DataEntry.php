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
        $data['records'] = $this->project_Model->getProject();
        $data['journalType'] = $this->journal_model->getJournalType();
        $data['journal'] = $this->journal_model->getJournal();
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
        if (isset($_POST["submit"])) {
            $file = $_FILES['file']['tmp_name'];
            $parse_array = $this->parse_excel($file);
            print_r($parse_array);
            exit;
            $highestRow = $this->get_row($file);
            //  $highestColumnIndex = $this->get_column($file);
            $i = 1;
            while ($i <= $highestRow) {
                $viaduct_master_id = $parse_array[$i][0];
                $incident_date = $parse_array[$i][1];
                $incident_desc = $parse_array[$i][2];
                $data_date = $parse_array[$i][3];
                $cre_by = $this->session->userdata('uid');
                $crea_date = date('Y-m-d H:i:s');
                $mod_date = date('Y-m-d H:i:s');
                $mod_by = $this->session->userdata('uid');
                echo $incident_date;
                echo $data_date;

                //$res = $this->common_model->parse_data($viaduct_master_id, $incident_date, $incident_desc, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);
                $i++;
            }
            exit;
        }
       /* if($res){
            redirect('dataentry/list_dataentry', 'refresh');
        }
        else{
            redirect('journal/list_journals', 'refresh');
        }*/
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
        $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
        $c = $objPHPExcel->getActiveSheet()->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($c);
        $val = array();
        for ($row = 1; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row)->getValue();
                $val[$row][$col] = $cell;
            }
        }
        return $val;
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
}
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