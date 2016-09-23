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
        date_default_timezone_set('Asia/Calcutta'); // to set the time zone
    }

    /**
     * @jane
     * date:15/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is to show the data entry page
     */
    public function add_data()
    {
        $this->load->view('data_entry/add_data');
        $this->load->view('template/footer');
    }

    /**
     * @jane
     * date:123/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is extract data from csv or excel file and write it to db
     */
    public function parse_data()
    {
        if (isset($_POST["submit"])) {
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

        }
    }
}