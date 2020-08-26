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
        $this->db_budget->order_by('sp_code ASC');

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
        
        $createbtn = $this->input->post('createbtn');
        // CREATE CURRENT AGENCY SPECIFIC
        if($createbtn == 'create_cu_as'){
            // allotment table
            $allotment = array(
                'all_region' => $this->input->post('region'),
                'all_year' => $this->input->post('year'),
                'all_category' => $this->input->post('all_category_cu'),
                'all_type' => $this->input->post('type_cu'),
                'all_funding' => $this->input->post('funding_cu'),
                'all_class' => $this->input->post('class_cu'),
            );

            $this->db_budget->insert('allotment', $allotment);
            $allotment_id = $this->db_budget->insert_id();
        
            // allotment_amount table
            $this->db_budget->select('*');
            $this->db_budget->from('sub_pap');
            $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
            $this->db_budget->order_by('sp_code ASC');
    
            $query = $this->db_budget->get();

            foreach($query->result_array() as $row){
                $sp_id = $row['sp_id'];

                $amount = array(
                    'amt_jan' => $this->input->post($sp_id.'-amount-jan-cu'),
                    'amt_feb' => $this->input->post($sp_id.'-amount-feb-cu'),
                    'amt_mar' => $this->input->post($sp_id.'-amount-mar-cu'),
                    'amt_apr' => $this->input->post($sp_id.'-amount-apr-cu'),
                    'amt_may' => $this->input->post($sp_id.'-amount-may-cu'),
                    'amt_jun' => $this->input->post($sp_id.'-amount-jun-cu'),
                    'amt_jul' => $this->input->post($sp_id.'-amount-jul-cu'),
                    'amt_aug' => $this->input->post($sp_id.'-amount-aug-cu'),
                    'amt_sep' => $this->input->post($sp_id.'-amount-sep-cu'),
                    'amt_oct' => $this->input->post($sp_id.'-amount-oct-cu'),
                    'amt_nov' => $this->input->post($sp_id.'-amount-nov-cu'),
                    'amt_dec' => $this->input->post($sp_id.'-amount-dec-cu'),
                    'amt_sub_pap_id' =>  $sp_id,
                    'amt_all_id' => $allotment_id,
                );

                $this->db_budget->insert('allotment_amount', $amount);
            };
        }


        return true;
    }
    // ---------------------------------- END ALLOTMENT TABLE ----------------------------------
}
?>