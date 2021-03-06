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

    public function insert_disbursements(){
        $this->db_budget->select('*');
        $this->db_budget->from('main_pap');
        $query1 = $this->db_budget->get();
        foreach($query1->result_array() as $row1){
        
            $this->db_budget->select('*');
            $this->db_budget->from('allotment_amount');
            $this->db_budget->join('sub_pap', 'sub_pap.sp_id = allotment_amount.amt_sub_pap_id');
            $this->db_budget->where('allotment_amount.amt_all_id', $this->input->post('amt_all_id'));
            $query = $this->db_budget->get();
            foreach($query->result_array() as $row){
                $amt_id = $row['amt_id'];
                    
                $this->db_budget->select('*');
                $this->db_budget->from('disbursements');
                $this->db_budget->where('dis_month', $this->input->post('monthSel'));
                $this->db_budget->where('dis_amt_id', $amt_id);
                $query2 = $this->db_budget->get();
                $disCnt = $query2->num_rows();
               
                if($disCnt ==0){
                    if($row1['mp_id'] == $row['sp_mp_id']){
                        if($this->input->post('disbursement-amount-'.$amt_id) == NULL){
                            $thisEmp = '0.00';
                        }else{
                            $thisEmp = $this->input->post('disbursement-amount-'.$amt_id);
                        }

                        $data = array(
                            'dis_month' => $this->input->post('monthSel'),
                            'dis_amount' => $thisEmp,
                            'dis_amt_id' => $amt_id,
                        );
    
                        $this->db_budget->insert('disbursements', $data);
                    }
                }else{
                    if($row1['mp_id'] == $row['sp_mp_id']){
                        if($this->input->post('disbursement-amount-'.$amt_id) == NULL){
                            $thisEmp = '0.00';
                        }else{
                            $thisEmp = $this->input->post('disbursement-amount-'.$amt_id);
                        }

                        $update = array(
                            'dis_month' => $this->input->post('monthSel'),
                            'dis_amount' => $thisEmp,
                            'dis_amt_id' => $amt_id,
                        );
    
                        $this->db_budget->where('dis_month', $this->input->post('monthSel'));
                        $this->db_budget->where('dis_amt_id', $amt_id);
                        $this->db_budget->update('disbursements', $update);
                    }
                }
                
            };

        };


        // insert logs
        $logs = array(
            'log_action' => 'create disbursements',
            'log_user' => $_SESSION['user'],
            'log_region' => $_SESSION['region'],
            'log_month' => $this->input->post('monthSel'),
            'log_year' => $this->input->post('year'),
        );

        $this->db_budget->insert('logs', $logs);

        return true;

    }

    
}
?>