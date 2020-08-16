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
        $this->db_budget->select('*');
        $this->db_budget->from('sub_pap');
        $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');

        $query = $this->db_budget->get();
        return $query->result_array();
    }

    public function add_sub_pap(){
        $data = array(
            'sp_code' => $this->input->post('sp_code'),
            'sp_name' => $this->input->post('sp_name'),
            'sp_description' => $this->input->post('sp_description'),
            'sp_mp_id' => $this->input->post('sp_mp_id'),
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

    // ---------------------------------- ALLOTMENT TABLE ----------------------------------
    public function add_allotment(){
        $ps = array(
            'region' => $this->input->post('region'),
            'year' => $this->input->post('year'),
            'amount' => $this->input->post('ps_amount'),
            'type' => $this->input->post('type'),
            'mp_id' => $this->input->post('mp_id'),
            'sp_id' => $this->input->post('sp_id'),
        );

        $this->db_budget->insert('allotment', $ps);

        $mooe = array(
            'region' => $this->input->post('region'),
            'year' => $this->input->post('year'),
            'amount' => $this->input->post('mooe_amount'),
            'type' => $this->input->post('type'),
            'mp_id' => $this->input->post('mp_id'),
            'sp_id' => $this->input->post('sp_id'),
        );

        $this->db_budget->insert('allotment', $mooe);

        $co = array(
            'region' => $this->input->post('region'),
            'year' => $this->input->post('year'),
            'amount' => $this->input->post('co_amount'),
            'type' => $this->input->post('type'),
            'mp_id' => $this->input->post('mp_id'),
            'sp_id' => $this->input->post('sp_id'),
        );

        $this->db_budget->insert('allotment', $co);

        $rlip = array(
            'region' => $this->input->post('region'),
            'year' => $this->input->post('year'),
            'amount' => $this->input->post('rlip_amount'),
            'type' => $this->input->post('type'),
            'mp_id' => $this->input->post('mp_id'),
            'sp_id' => $this->input->post('sp_id'),
        );

        $this->db_budget->insert('allotment', $rlip);

        return true;
    }
    // ---------------------------------- END ALLOTMENT TABLE ----------------------------------
   
}
?>