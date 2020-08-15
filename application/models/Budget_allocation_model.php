<?php
class Budget_allocation_model extends CI_Model{
    public function __construct(){
        //$this->load->database();
        
        $this->db_budget = $this->load->database('bud_db', TRUE);
    }

    // ---------------------------------- MAIN PAP TABLE ----------------------------------
    public function view_main_pap(){
        $query = $this->db_budget->get('main_pap');
        return $query->result_array();
    }

    public function add_main_pap(){
        $data = array(
            'mp_code' => $this->input->post('mp_code'),
            'mp_name' => $this->input->post('mp_name'),
            'mp_description' => $this->input->post('mp_description'),
        );

        return $this->db_budget->insert('main_pap', $data);
    }

    public function view_main_pap_one($id){
        $query = $this->db_budget->get_where('main_pap', array('mp_id' => $id));
        return $query->row_array();
    }

    public function update_main_pap(){
        $data = array(
            'mp_code' => $this->input->post('mp_code'),
            'mp_name' => $this->input->post('mp_name'),
            'mp_description' => $this->input->post('mp_description'),
        );

        $this->db_budget->where('mp_id', $this->input->post('mp_id'));
        return $this->db_budget->update('main_pap', $data);
    }

    public function delete_main_pap($id){
        $this->db_budget->where('mp_id', $id);
        $this->db_budget->delete('main_pap');
        return true;
    }
    // ---------------------------------- END MAIN PAP TABLE ----------------------------------

    // ---------------------------------- SUB PAP TABLE ----------------------------------
    public function view_sub_pap(){
        $query = $this->db_budget->get('sub_pap');
        return $query->result_array();
    }

    public function add_sub_pap(){
        $data = array(
            'sp_code' => $this->input->post('sp_code'),
            'sp_name' => $this->input->post('sp_name'),
            'sp_description' => $this->input->post('sp_description'),
        );

        return $this->db_budget->insert('sub_pap', $data);
    }

    public function view_sub_pap_one($id){
        $query = $this->db_budget->get_where('sub_pap', array('sp_id' => $id));
        return $query->row_array();
    }

    public function update_sub_pap(){
        $data = array(
            'sp_code' => $this->input->post('sp_code'),
            'sp_name' => $this->input->post('sp_name'),
            'sp_description' => $this->input->post('sp_description'),
        );

        $this->db_budget->where('sp_id', $this->input->post('sp_id'));
        return $this->db_budget->update('sub_pap', $data);
    }

    public function delete_sub_pap($id){
        $this->db_budget->where('sp_id', $id);
        $this->db_budget->delete('sub_pap');
        return true;
    }
    // ---------------------------------- END SUB PAP TABLE ----------------------------------

    public function allotment_create(){

         // ---------------------------------- allotment TABLE ----------------------------------

        $allotment = array(
            'region' => $this->input->post('region'),
            'year' => $this->input->post('year'),
            'status' => '0'
        );

        $this->db_budget->insert('allotment', $allotment);
        $allotment_id = $this->db_budget->insert_id();

        $gms_allotment_ps = array(
            'GMS_PAP_CAT' => $this->input->post('GMS_PAP_CAT_PS'),
            'GMS_PAP' => $this->input->post('GMS_PAP_PS'),
            'GMS_AMT' => $this->input->post('GMS_AMT_PS'),
            'GMS_ALLOTMENT_id' => $allotment_id,
        );
        $this->db_budget->insert('gms_allotment', $gms_allotment_ps);

        $gms_allotment_mooe = array(
            'GMS_PAP_CAT' => $this->input->post('GMS_PAP_CAT_MOOE'),
            'GMS_PAP' => $this->input->post('GMS_PAP_MOOE'),
            'GMS_AMT' => $this->input->post('GMS_AMT_MOOE'),
            'GMS_ALLOTMENT_id' => $allotment_id,
        );
        $this->db_budget->insert('gms_allotment', $gms_allotment_mooe);

        $gms_allotment_co = array(
            'GMS_PAP_CAT' => $this->input->post('GMS_PAP_CAT_CO'),
            'GMS_PAP' => $this->input->post('GMS_PAP_CO'),
            'GMS_AMT' => $this->input->post('GMS_AMT_CO'),
            'GMS_ALLOTMENT_id' => $allotment_id,
        );
        $this->db_budget->insert('gms_allotment', $gms_allotment_co);

        $gms_allotment_rlip = array(
            'GMS_PAP_CAT' => $this->input->post('GMS_PAP_CAT_RLIP'),
            'GMS_PAP' => $this->input->post('GMS_PAP_RLIP'),
            'GMS_AMT' => $this->input->post('GMS_AMT_RLIP'),
            'GMS_ALLOTMENT_id' => $allotment_id,
        );
        $this->db_budget->insert('gms_allotment', $gms_allotment_rlip);

        return true;
      
    }

    public function saa_create(){

        // ---------------------------------- any TABLE ----------------------------------
        
        $pap = $this->input->post('table_name');
        $table_insert = tolower($pap);
        $query_allocation = $this->db_budget->get_where('allotment', array('region' => $this->input->post('region'), 'year' => $this->input->post('year')));
        
        $allotment_saa = array(
            $pap.'_PAP_CAT' => $this->input->post('PAP_CAT'),
            $pap.'_PAP' => $this->input->post('SAA_name'),
            $pap.'_AMT' => $this->input->post('SAA_amount'),
            $pap.'_ALLOTMENT_id' => $allotment_id,
        );
        return $this->db_budget->insert($table_insert, $allotment_saa);
    }
}
?>