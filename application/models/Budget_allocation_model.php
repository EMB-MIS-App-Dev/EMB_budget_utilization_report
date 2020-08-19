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

        $allotment = array(
            'region' => $this->input->post('region'),
            'year' => $this->input->post('year'),
            'status' => $this->input->post('status'),
            'fund_source' => $this->input->post('fund_source'),
        );

        $this->db_budget->insert('allotment', $allotment);
        $allotment_id = $this->db_budget->insert_id();

        $this->db_budget->select('*');
        $this->db_budget->from('sub_pap');
        $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
        $this->db_budget->order_by('sp_code ASC');

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
        $query = $this->db_budget->query('SELECT * FROM allotment
                                        INNER JOIN class ON class.cl_allotment_id = allotment.id
                                        INNER JOIN sub_pap ON sub_pap.sp_id = class.cl_sp_id
                                        INNER JOIN main_pap ON main_pap.mp_id = sub_pap.sp_mp_id
                                        where class.cl_allotment_id = '.$id.'
                                        ORDER BY sub_pap.sp_code ASC, FIELD(class.cl_name, "ps","mooe","co","rlip"), class.cl_id');

        return $query->result_array();
    }

    public function view_one_allotment_class($id){
        $this->db_budget->select('*');
        $this->db_budget->from('allotment');
        $this->db_budget->join('class', 'allotment.id = class.cl_allotment_id');
        $this->db_budget->join('sub_pap', 'class.cl_sp_id = sub_pap.sp_id');
        $this->db_budget->where('class.cl_id', $id);

        $query = $this->db_budget->get();


        return $query->result_array();
    }

    public function update_allotment_class(){
        $id = $this->input->post('allotment_id');

        $this->db_budget->select('*');
        $this->db_budget->from('class');
        $this->db_budget->where('cl_allotment_id', $id);
        $query = $this->db_budget->get();
        
        foreach ($query->result_array() as $row) {
            $cl_id = $row['cl_id'];
            $cl_amount = 'cl-amount-'.$cl_id;

            $data = array(
                'cl_amount' => $this->input->post($cl_amount),
            );
    

           
            $this->db_budget->where('cl_id', $cl_id);
            $this->db_budget->update('class', $data);
        }

        // $data = array(
        //     'region' => $id,
        // );
        // $this->db_budget->insert('allotment', $data);

       
        return true;
    }

    // SAA
    public function view_saa($id){
        // $query = $this->db_budget->query("SELECT * FROM saa
        //                                 INNER JOIN class ON class.cl_id = saa.sa_cl_id
        //                                 INNER JOIN allotment ON allotment.id = class.cl_allotment_id
        //                                 where saa.sa_cl_id = '.$id.'");


        $this->db_budget->select('*');
        $this->db_budget->from('saa');
        $this->db_budget->join('class', 'class.cl_id = saa.sa_cl_id');
        $this->db_budget->join('allotment', 'allotment.id = class.cl_allotment_id');
        $this->db_budget->where('saa.sa_cl_id', $id);
        $query = $this->db_budget->get();

        return $query->result_array();
    }

    public function add_saa(){

        $data = array(
            'sa_name' => $this->input->post('SAA_name'),
            'sa_amount' => $this->input->post('SAA_amount'),
            'sa_month' => $this->input->post('month'),
            'sa_description' => $this->input->post('SAA_description'),
            'sa_cl_id' => $this->input->post('cl_id'),
            'sa_allotment_id' => $this->input->post('all_id'),
        );

        $this->db_budget->insert('saa', $data);
        
        // update class
        $this->db_budget->select_sum('sa_amount');
        $this->db_budget->from('saa');
        $this->db_budget->where('sa_cl_id', $this->input->post('cl_id'));
        $sum = $this->db_budget->get();

        foreach ($sum->result_array() as $row) {
            $sum_ttl = $row['sa_amount'];
        };


        $cl_data = array(
            'cl_remarks' => 'regular',
            'cl_amount' => $sum_ttl,
        );

        $this->db_budget->where('cl_id', $this->input->post('cl_id'));
        $this->db_budget->update('class', $cl_data);
        //end update class 

        return true;
    }

    public function delete_saa($id){
        $this->db_budget->where('sa_id', $id);
        $this->db_budget->delete('saa');
        return true;
    }

    public function update_class_with_saa_amount($id){
        // update class
        $this->db_budget->select_sum('sa_amount');
        $this->db_budget->from('saa');
        $this->db_budget->where('sa_cl_id', $id);
        $sum = $this->db_budget->get();

        foreach ($sum->result_array() as $row) {
            $sum_ttl = $row['sa_amount'];
        };

        if ($sum_ttl == 0){
            $cl_data = array(
                'cl_remarks' => NULL,
                'cl_amount' => $sum_ttl,
            );
        }else{
            $cl_data = array(
                'cl_remarks' => 'regular',
                'cl_amount' => $sum_ttl,
            );
        }
        

        $this->db_budget->where('cl_id', $id);
        $this->db_budget->update('class', $cl_data);
        //end update class
    }

    // ---------------------------------- END ALLOTMENT TABLE ----------------------------------
}
?>