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

    public function insert_obligation(){
        
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
                $this->db_budget->from('obligations');
                $this->db_budget->where('ob_month', $this->input->post('monthSel'));
                $this->db_budget->where('ob_amt_id', $amt_id);
                $query2 = $this->db_budget->get();
                $oblCnt = $query2->num_rows();
               
                if($oblCnt ==0){
                    if($row1['mp_id'] == $row['sp_mp_id']){
                        if($this->input->post('obligation-amount-'.$amt_id) == NULL){
                            $thisEmp = '0.00';
                        }else{
                            $thisEmp = $this->input->post('obligation-amount-'.$amt_id);
                        }

                        $data = array(
                            'ob_month' => $this->input->post('monthSel'),
                            'ob_amount' => $thisEmp,
                            'ob_amt_id' => $amt_id,
                        );
    
                        $this->db_budget->insert('obligations', $data);
                    }
                }else{
                    if($row1['mp_id'] == $row['sp_mp_id']){
                        if($this->input->post('obligation-amount-'.$amt_id) == NULL){
                            $thisEmp = '0.00';
                        }else{
                            $thisEmp = $this->input->post('obligation-amount-'.$amt_id);
                        }

                        $update = array(
                            'ob_month' => $this->input->post('monthSel'),
                            'ob_amount' => $thisEmp,
                            'ob_amt_id' => $amt_id,
                        );
    
                        $this->db_budget->where('ob_month', $this->input->post('monthSel'));
                        $this->db_budget->where('ob_amt_id', $amt_id);
                        $this->db_budget->update('obligations', $update);
                    }
                }
                
            };

        };

        

        
        return true;
    }

    // ---------------------------------- END OBLIGATION TABLE ----------------------------------

    
}
?>