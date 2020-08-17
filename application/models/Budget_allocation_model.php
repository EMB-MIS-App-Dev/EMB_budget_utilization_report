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
    public function view_allotment(){
        $query = $this->db_budget->get('allotment');
        return $query->result_array();
    }

    public function add_allotment(){

        $allotment = array(
            'region' => $this->input->post('region'),
            'year' => $this->input->post('year'),
        );

        $this->db_budget->insert('allotment', $allotment);
        $allotment_id = $this->db_budget->insert_id();

        $this->db_budget->select('*');
        $this->db_budget->from('sub_pap');
        $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
        $query = $this->db_budget->get();

        $sp_count = $query->num_rows();

        foreach ($query->result_array() as $row) {
            $sp_code = $row['sp_code'];
            $sp_id = $row['sp_id'];

            for ($i = 1; $i <= 4; $i++) {
                $cl_name = array("N/A","ps", "mooe", "co", "rlip");
                $count = $sp_code.'-'.$cl_name[$i].'-amount-'.$i;
                
                $data = array(
                    
                    'cl_name' =>  $cl_name[$i],
                    'cl_amount' => $this->input->post($count),
                    'cl_sp_id' =>  $sp_id,
                    'cl_allotment_id' =>  $allotment_id,
                    // 'cl_amount' => $count,
                );

                $this->db_budget->insert('class', $data);
            };
        };
        return true;            
        
    }

    public function view_allotment_class($id){
        $this->db_budget->select('*');
        $this->db_budget->from('allotment');
        $this->db_budget->join('class', 'class.cl_allotment_id = allotment.id');
        $this->db_budget->join('sub_pap', 'sub_pap.sp_id = class.cl_sp_id');
        $this->db_budget->join('main_pap', 'main_pap.mp_id = sub_pap.sp_mp_id');
        $this->db_budget->where('cl_allotment_id', $id);
        $query = $this->db_budget->get();

        return $query->result_array();
    }

    // ---------------------------------- END ALLOTMENT TABLE ----------------------------------
}
?>