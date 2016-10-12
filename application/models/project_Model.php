<?php (defined('BASEPATH')) OR exit('aNo direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ancy Mathew
 * Date: 9/23/2016
 * Time: 9:18 PM
 */

class project_Model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    // Inserting in Table Data Attribute
    function project_add($data)
    {
            $this->db->insert('tbl_project_master', $data);
            return true;
    }
    function getProject()
    {
        $this->db->select('*');
        $this->db->from('tbl_project_master');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function getCategory(){
        $this->db->select('*');
        $this->db->from('tbl_category_type');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function delete_Project($id)
    {
        $this->db->where('pjct_master_id', $id);
        $this->db->delete('tbl_project_master');
    }
    function update_project($id,$pjct_name,$pjct_from,$pjct_to,$pjct_desc,$cont_name,$has_parking,$has_depot,$modified_by,$modified_date)
    {
        $this->db->where('pjct_master_id',$id);
        $this->db->set('pjct_name',$pjct_name );
        $this->db->set('pjct_desc',$pjct_desc );
        $this->db->set('pjct_from',$pjct_from );
        $this->db->set('pjct_to',$pjct_to );
        $this->db->set('cont_name',$cont_name );
        $this->db->set('has_parking',$has_parking );
        $this->db->set('has_depot',$has_depot );
        $this->db->set('modified_by',$modified_by );
        $this->db->set('modified_date',$modified_date );
        $this->db->update('tbl_project_master');
        return true;
    }
}