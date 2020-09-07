<?php
class Budget_obligations_model extends CI_Model{
    public function __construct(){
        //$this->load->database();
        
        $this->db_budget = $this->load->database('bud_db', TRUE);
    }

    // ---------------------------------- OBLIGATION TABLE ----------------------------------

    public function view_obligation(){
        $query = $this->db_budget->get('obligations');
        return $query->result_array();
    }

    // ---------------------------------- END OBLIGATION TABLE ----------------------------------

    
}
?>