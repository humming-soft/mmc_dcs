<?php (defined('BASEPATH')) OR exit('aNo direct script access allowed');

class Common_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    /**
     * @jane
     * date:13/09/2016
     * Parameter:none
     * Return type:
     * Description: function to validate login
     */
    public function validate_login($username, $password)
    {
        $hash_password = hash('sha256', $password);
        $ldap = "";
        $this->db->select('id, username, password, fullname, lastlogin, user_group');
        $this->db->from('users');
        $this->db->where(array('username' => $username));
        $query = $this->db->get();
        $user = $query->row_array();

        if (count($user) != 0) {
            if ($user['password'] == $hash_password) {
                /* Password available in DB, login through DB */
                $this->update_login_lastlog($user);
                $this->log_login_attempt(array('data' => 'Successful login for user ' . $username . ' using custom user in DB', 'ip_address' => $_SERVER['REMOTE_ADDR']));
                return $user;
            } else if ($user['password'] === "") {
                $ldap = $this->login_ad($username, $password);
                /* Empty password in DB, login through AD instead */
                if ($ldap) {
                    $this->update_login_lastlog($user);
                    $this->log_login_attempt(array('data' => 'Successful login ' . $username . ' from AD, username exists in DB', 'ip_address' => $_SERVER['REMOTE_ADDR']));
                    return $user;
                } else {
                    /* Wrong username/password in AD */
                    $this->log_login_attempt(array('data' => 'Wrong username/password for ' . $username, 'ip_address' => $_SERVER['REMOTE_ADDR']));
                    return false;
                }
            } else {
                /* Wrong password in DB */

                /* Login through AD */
                if ($ldap) {
                    $ldap = $this->login_ad($username, $password);
                    /* Login through AD */
                    $this->log_login_attempt(array('data' => 'Successful login ' . $username . ' from AD', 'ip_address' => $_SERVER['REMOTE_ADDR']));
                    return $user;
                } else {
                    /* Nope. */
                    $this->log_login_attempt(array('data' => 'Wrong password for user ' . $username, 'ip_address' => $_SERVER['REMOTE_ADDR']));
                    return false;
                }
                return false;
            }
        }
    }

    /**
     * @jane
     * date:13/09/2016
     * Parameter:none
     * Return type:
     * Description: function to check active directory login
     */
    public function login_ad($username, $password)
    {
        $backslash = strpos($username, "\\");
        $domainuser = "MYMRT\\" . (($backslash === FALSE) ? $username : substr($username, $backslash + 1));
        //$ldap = ldap_connect("eagle.office.hummingsoft.com.my"); //172.16.2.10
        $ldap = ldap_connect("172.16.2.10"); //172.16.2.10
        return ldap_bind($ldap, $domainuser, $password);

        // $ldap = ldap_connect("172.16.2.10"); //172.16.2.10
        // return ldap_bind($ldap, $domainuser, $password);
    }

    /**
     * @jane
     * date:13/09/2016
     * Parameter:none
     * Return type:
     * Description: function to update login log in db
     */
    public function update_login_lastlog($user)
    {
        $this->db->where('id', $user['id']);
        $this->db->set('lastlogin', 'NOW()', FALSE);
        return $this->db->update('users');
    }


    /**
     * @jane
     * date:13/09/2016
     * Parameter:none
     * Return type:
     * Description: This function is extract data from csv or excel file and write it to db
     */
    public function log_login_attempt($data)
    {
        return $this->db->insert('users_log', $data);
    }

    /**
     * @jane
     * date:23/09/2016
     * Parameter:none
     * Return type:
     * Description: function to log login attempt in db
     */
    public function parse_data($id, $incident_date, $incident_desc, $data_date, $cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_safety_incident(journal_master_id, incident_date, incident_desc,data_date,cre_by,crea_date,mod_by,mod_date) VALUES('$id','$incident_date','$incident_desc','$data_date','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }
    public function parse_data_kdi($id, $data_date,$kd_desc,$forecast_date,$contract_date,$dps_date, $cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_kd_master(journal_master_id, data_date, kd_desc,forecast_date,contract_date,dps_date,cre_by,crea_date,mod_by,mod_date) VALUES('$id','$data_date','$kd_desc','$forecast_date','$contract_date','$dps_date','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }
    public function parse_data_kpi($id,$kpi_type,$baseline,$kpi_target,$actual, $data_date, $cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_kpi_master(journal_master_id, kpi_type, baseline,kpi_target,actual,data_date,cre_by,crea_date,mod_by,mod_date) VALUES('$id','$kpi_type','$baseline','$kpi_target','$actual','$data_date','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }
    public function parse_data_safty_incident($id, $incident_date, $incident_desc, $data_date, $cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_safety_incident(journal_master_id, incident_date, incident_desc,data_date,cre_by,crea_date,mod_by,mod_date) VALUES('$id','$incident_date','$incident_desc','$data_date','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }
    public function parse_data_project_master($id,$prgm_sub_name,$early_prec,$actual_prec,$late_prec,$early_varience,$late_varience, $data_date, $cre_by, $crea_date, $mod_by, $mod_date)
    {
        $sql = "INSERT INTO tbl_prgm_master(journal_master_id, prgm_sub_name, early_prec,actual_prec,late_prec,early_varience,late_varience,data_date,cre_by,crea_date,mod_by,mod_date) VALUES('$id','$prgm_sub_name','$early_prec','$actual_prec','$late_prec','$early_varience','$late_varience','$data_date','$cre_by','$crea_date','$mod_by','$mod_date')";
        return $this->db->query($sql);
    }
    /**
     * @AgailE
     * date:18/09/2016
     * Parameter:none
     * Return type:
     * Description: function to upload image
     */
    public function image_upload($data)
    {
        return $this->db->insert('users_log', $data);
    }
}