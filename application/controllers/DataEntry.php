<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataentry extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common_model');
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
                $res = $this->common_model->parse_data($viaduct_master_id, $incident_date, $incident_desc, $data_date, $cre_by, $crea_date, $mod_by, $mod_date);
                $i++;
            }
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