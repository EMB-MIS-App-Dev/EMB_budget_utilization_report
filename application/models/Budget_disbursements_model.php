<?php
class Budget_disbursements_model extends CI_Model{
    public function __construct(){
        //$this->load->database();
        
        $this->db_budget = $this->load->database('bud_db', TRUE);
    }

    // ---------------------------------- OBLIGATION TABLE ----------------------------------

    public function view_disbursements(){
        $query = $this->db_budget->get('disbursements');
        return $query->result_array();
    }
}
?>