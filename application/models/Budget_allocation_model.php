<?php
class Budget_allocation_model extends CI_Model{
    public function __construct(){
        //$this->load->database();
        
        $this->db_budget = $this->load->database('bud_db', TRUE);
    }


    public function get_user(){
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        // $api = file_get_contents("https://iis.emb.gov.ph/embis/pbsapi/?token=". $_SESSION['token'] ."&token_id=". $_SESSION['token_id'] ."",  false, stream_context_create($arrContextOptions));
        $token = 'AW0TyLdAFClNSDyh6Xt7O1mN5GFsL1Kw40kWUkPB6VEpIN9TYg~FTttra9YtugEsBhZ1iubokRgWe7PBGASTQA--';
        $api = file_get_contents("https://iis.emb.gov.ph/embis/pbsapi/?token=$token&token_id=33955f2d1416677fc",  false, stream_context_create($arrContextOptions));
        
        $user = json_decode($api);

        return $user;
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

    public function view_allotment_one($id){
        $this->db_budget->where('all_id', $id);
        $query = $this->db_budget->get('allotment');
        return $query->result_array();
    }

    public function view_allotment_amount($id){
        $this->db_budget->select('*');
        $this->db_budget->from('allotment_amount');
        $this->db_budget->join('sub_pap', 'sub_pap.sp_id = allotment_amount.amt_sub_pap_id');
        $this->db_budget->where('allotment_amount.amt_all_id', $id);
        $query = $this->db_budget->get();
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

            // insert logs
            $logs = array(
                'log_action' => 'create allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $allotment_id,
            );

            $this->db_budget->insert('logs', $logs);
        
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
        }else if($createbtn == 'create_cu_or'){
            // CREATE CURRENT OTHER RELEASES
            // allotment table
            $allotment = array(
                'all_region' => $this->input->post('region'),
                'all_year' => $this->input->post('year'),
                'all_category' => $this->input->post('all_category_cu'),
                'all_type' => $this->input->post('type_cu'),
                'all_funding' => $this->input->post('funding_cu'),
                'all_saa_no' => $this->input->post('or_number_cu'),
                'all_saa_desc' => $this->input->post('or_desc_cu'),
                'all_class' => $this->input->post('class_cu'),
            );

            $this->db_budget->insert('allotment', $allotment);
            $allotment_id = $this->db_budget->insert_id();

             // insert logs
             $logs = array(
                'log_action' => 'create allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $allotment_id,
            );

            $this->db_budget->insert('logs', $logs);
            
        
            // allotment_amount table
            $this->db_budget->select('*');
            $this->db_budget->from('sub_pap');
            $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
            $this->db_budget->order_by('sp_code ASC');
    
            $query = $this->db_budget->get();

            foreach($query->result_array() as $row){
                $sp_id = $row['sp_id'];

                $amount = array(
                    'amt_jan' => $this->input->post('newAct_'.$sp_id.'_input_jan_cu_or'),
                    'amt_feb' => $this->input->post('newAct_'.$sp_id.'_input_feb_cu_or'),
                    'amt_mar' => $this->input->post('newAct_'.$sp_id.'_input_mar_cu_or'),
                    'amt_apr' => $this->input->post('newAct_'.$sp_id.'_input_apr_cu_or'),
                    'amt_may' => $this->input->post('newAct_'.$sp_id.'_input_may_cu_or'),
                    'amt_jun' => $this->input->post('newAct_'.$sp_id.'_input_jun_cu_or'),
                    'amt_jul' => $this->input->post('newAct_'.$sp_id.'_input_jul_cu_or'),
                    'amt_aug' => $this->input->post('newAct_'.$sp_id.'_input_aug_cu_or'),
                    'amt_sep' => $this->input->post('newAct_'.$sp_id.'_input_sep_cu_or'),
                    'amt_oct' => $this->input->post('newAct_'.$sp_id.'_input_oct_cu_or'),
                    'amt_nov' => $this->input->post('newAct_'.$sp_id.'_input_nov_cu_or'),
                    'amt_dec' => $this->input->post('newAct_'.$sp_id.'_input_dec_cu_or'),
                    'amt_sub_pap_id' =>  $sp_id,
                    'amt_all_id' => $allotment_id,
                );

                if(($this->input->post('newAct_'.$sp_id.'_input_jan_cu_or')) !== null){
                    $this->db_budget->insert('allotment_amount', $amount);
                }
                
            };
        }else if($createbtn == 'create_cu_sa'){
            // CREATE CURRENT SAA
            // allotment table
            $allotment = array(
                'all_region' => $this->input->post('region'),
                'all_year' => $this->input->post('year'),
                'all_category' => $this->input->post('all_category_cu'),
                'all_type' => $this->input->post('type_cu'),
                'all_funding' => $this->input->post('funding_cu'),
                'all_saa_no' => $this->input->post('SAA_number_cu'),
                'all_saa_desc' => $this->input->post('SAA_desc_cu'),
                'all_class' => $this->input->post('class_cu'),
            );

            $this->db_budget->insert('allotment', $allotment);
            $allotment_id = $this->db_budget->insert_id();

             // insert logs
             $logs = array(
                'log_action' => 'create allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $allotment_id,
            );

            $this->db_budget->insert('logs', $logs);
        
            // allotment_amount table
            $this->db_budget->select('*');
            $this->db_budget->from('sub_pap');
            $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
            $this->db_budget->order_by('sp_code ASC');
    
            $query = $this->db_budget->get();

            foreach($query->result_array() as $row){
                $sp_id = $row['sp_id'];

                $amount = array(
                    'amt_jan' => $this->input->post('newActsaa_'.$sp_id.'_input_jan_cu_sa'),
                    'amt_feb' => $this->input->post('newActsaa_'.$sp_id.'_input_feb_cu_sa'),
                    'amt_mar' => $this->input->post('newActsaa_'.$sp_id.'_input_mar_cu_sa'),
                    'amt_apr' => $this->input->post('newActsaa_'.$sp_id.'_input_apr_cu_sa'),
                    'amt_may' => $this->input->post('newActsaa_'.$sp_id.'_input_may_cu_sa'),
                    'amt_jun' => $this->input->post('newActsaa_'.$sp_id.'_input_jun_cu_sa'),
                    'amt_jul' => $this->input->post('newActsaa_'.$sp_id.'_input_jul_cu_sa'),
                    'amt_aug' => $this->input->post('newActsaa_'.$sp_id.'_input_aug_cu_sa'),
                    'amt_sep' => $this->input->post('newActsaa_'.$sp_id.'_input_sep_cu_sa'),
                    'amt_oct' => $this->input->post('newActsaa_'.$sp_id.'_input_oct_cu_sa'),
                    'amt_nov' => $this->input->post('newActsaa_'.$sp_id.'_input_nov_cu_sa'),
                    'amt_dec' => $this->input->post('newActsaa_'.$sp_id.'_input_dec_cu_sa'),
                    'amt_sub_pap_id' =>  $sp_id,
                    'amt_all_id' => $allotment_id,
                );

                if(($this->input->post('newActsaa_'.$sp_id.'_input_jan_cu_sa')) !== null){
                    $this->db_budget->insert('allotment_amount', $amount);
                }
                
            };
        }

        // CREATE CONTINUING APPROPRIATION AGENCY SPECIFIC
        if($createbtn == 'create_ca_as'){
            // allotment table
            $allotment = array(
                'all_region' => $this->input->post('region'),
                'all_year' => $this->input->post('year'),
                'all_category' => $this->input->post('all_category_ca'),
                'all_type' => $this->input->post('type_ca'),
                'all_funding' => $this->input->post('funding_ca'),
                'all_class' => $this->input->post('class_ca'),
            );

            $this->db_budget->insert('allotment', $allotment);
            $allotment_id = $this->db_budget->insert_id();

             // insert logs
             $logs = array(
                'log_action' => 'create allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $allotment_id,
            );

            $this->db_budget->insert('logs', $logs);
        
            // allotment_amount table
            $this->db_budget->select('*');
            $this->db_budget->from('sub_pap');
            $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
            $this->db_budget->order_by('sp_code ASC');
    
            $query = $this->db_budget->get();

            foreach($query->result_array() as $row){
                $sp_id = $row['sp_id'];

                $amount = array(
                    'amt_jan' => $this->input->post($sp_id.'-amount-jan-ca'),
                    'amt_feb' => $this->input->post($sp_id.'-amount-feb-ca'),
                    'amt_mar' => $this->input->post($sp_id.'-amount-mar-ca'),
                    'amt_apr' => $this->input->post($sp_id.'-amount-apr-ca'),
                    'amt_may' => $this->input->post($sp_id.'-amount-may-ca'),
                    'amt_jun' => $this->input->post($sp_id.'-amount-jun-ca'),
                    'amt_jul' => $this->input->post($sp_id.'-amount-jul-ca'),
                    'amt_aug' => $this->input->post($sp_id.'-amount-aug-ca'),
                    'amt_sep' => $this->input->post($sp_id.'-amount-sep-ca'),
                    'amt_oct' => $this->input->post($sp_id.'-amount-oct-ca'),
                    'amt_nov' => $this->input->post($sp_id.'-amount-nov-ca'),
                    'amt_dec' => $this->input->post($sp_id.'-amount-dec-ca'),
                    'amt_sub_pap_id' =>  $sp_id,
                    'amt_all_id' => $allotment_id,
                );

                $this->db_budget->insert('allotment_amount', $amount);
            };
        }else if($createbtn == 'create_ca_or'){
            // CREATE CONTINUING APPROPRIATION OTHER RELEASES
            // allotment table
            $allotment = array(
                'all_region' => $this->input->post('region'),
                'all_year' => $this->input->post('year'),
                'all_category' => $this->input->post('all_category_ca'),
                'all_type' => $this->input->post('type_ca'),
                'all_funding' => $this->input->post('funding_ca'),
                'all_saa_no' => $this->input->post('or_number_ca'),
                'all_saa_desc' => $this->input->post('or_desc_ca'),
                'all_class' => $this->input->post('class_ca'),
            );

            $this->db_budget->insert('allotment', $allotment);
            $allotment_id = $this->db_budget->insert_id();

             // insert logs
             $logs = array(
                'log_action' => 'create allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $allotment_id,
            );

            $this->db_budget->insert('logs', $logs);
        
            // allotment_amount table
            $this->db_budget->select('*');
            $this->db_budget->from('sub_pap');
            $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
            $this->db_budget->order_by('sp_code ASC');
    
            $query = $this->db_budget->get();

            foreach($query->result_array() as $row){
                $sp_id = $row['sp_id'];

                $amount = array(
                    'amt_jan' => $this->input->post('newAct_'.$sp_id.'_input_jan_ca_or'),
                    'amt_feb' => $this->input->post('newAct_'.$sp_id.'_input_feb_ca_or'),
                    'amt_mar' => $this->input->post('newAct_'.$sp_id.'_input_mar_ca_or'),
                    'amt_apr' => $this->input->post('newAct_'.$sp_id.'_input_apr_ca_or'),
                    'amt_may' => $this->input->post('newAct_'.$sp_id.'_input_may_ca_or'),
                    'amt_jun' => $this->input->post('newAct_'.$sp_id.'_input_jun_ca_or'),
                    'amt_jul' => $this->input->post('newAct_'.$sp_id.'_input_jul_ca_or'),
                    'amt_aug' => $this->input->post('newAct_'.$sp_id.'_input_aug_ca_or'),
                    'amt_sep' => $this->input->post('newAct_'.$sp_id.'_input_sep_ca_or'),
                    'amt_oct' => $this->input->post('newAct_'.$sp_id.'_input_oct_ca_or'),
                    'amt_nov' => $this->input->post('newAct_'.$sp_id.'_input_nov_ca_or'),
                    'amt_dec' => $this->input->post('newAct_'.$sp_id.'_input_dec_ca_or'),
                    'amt_sub_pap_id' =>  $sp_id,
                    'amt_all_id' => $allotment_id,
                );

                if(($this->input->post('newAct_'.$sp_id.'_input_jan_ca_or')) !== null){
                    $this->db_budget->insert('allotment_amount', $amount);
                }
                
            };
        }else if($createbtn == 'create_ca_sa'){
            // CREATE CONTINUING APPROPRIATION SAA
            // allotment table
            $allotment = array(
                'all_region' => $this->input->post('region'),
                'all_year' => $this->input->post('year'),
                'all_category' => $this->input->post('all_category_ca'),
                'all_type' => $this->input->post('type_ca'),
                'all_funding' => $this->input->post('funding_ca'),
                'all_saa_no' => $this->input->post('SAA_number_ca'),
                'all_saa_desc' => $this->input->post('SAA_desc_ca'),
                'all_class' => $this->input->post('class_ca'),
            );

            $this->db_budget->insert('allotment', $allotment);
            $allotment_id = $this->db_budget->insert_id();

             // insert logs
             $logs = array(
                'log_action' => 'create allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $allotment_id,
            );

            $this->db_budget->insert('logs', $logs);
        
            // allotment_amount table
            $this->db_budget->select('*');
            $this->db_budget->from('sub_pap');
            $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
            $this->db_budget->order_by('sp_code ASC');
    
            $query = $this->db_budget->get();

            foreach($query->result_array() as $row){
                $sp_id = $row['sp_id'];

                $amount = array(
                    'amt_jan' => $this->input->post('newActsaa_'.$sp_id.'_input_jan_ca_sa'),
                    'amt_feb' => $this->input->post('newActsaa_'.$sp_id.'_input_feb_ca_sa'),
                    'amt_mar' => $this->input->post('newActsaa_'.$sp_id.'_input_mar_ca_sa'),
                    'amt_apr' => $this->input->post('newActsaa_'.$sp_id.'_input_apr_ca_sa'),
                    'amt_may' => $this->input->post('newActsaa_'.$sp_id.'_input_may_ca_sa'),
                    'amt_jun' => $this->input->post('newActsaa_'.$sp_id.'_input_jun_ca_sa'),
                    'amt_jul' => $this->input->post('newActsaa_'.$sp_id.'_input_jul_ca_sa'),
                    'amt_aug' => $this->input->post('newActsaa_'.$sp_id.'_input_aug_ca_sa'),
                    'amt_sep' => $this->input->post('newActsaa_'.$sp_id.'_input_sep_ca_sa'),
                    'amt_oct' => $this->input->post('newActsaa_'.$sp_id.'_input_oct_ca_sa'),
                    'amt_nov' => $this->input->post('newActsaa_'.$sp_id.'_input_nov_ca_sa'),
                    'amt_dec' => $this->input->post('newActsaa_'.$sp_id.'_input_dec_ca_sa'),
                    'amt_sub_pap_id' =>  $sp_id,
                    'amt_all_id' => $allotment_id,
                );

                if(($this->input->post('newActsaa_'.$sp_id.'_input_jan_ca_sa')) !== null){
                    $this->db_budget->insert('allotment_amount', $amount);
                }
                
            };
        }

        // CREATE AUTOMATIC APPROPRIATION AGENCY SPECIFIC
        if($createbtn == 'create_aa_as'){
            // allotment table
            $allotment = array(
                'all_region' => $this->input->post('region'),
                'all_year' => $this->input->post('year'),
                'all_category' => $this->input->post('all_category_aa'),
                'all_type' => $this->input->post('type_aa'),
                'all_funding' => $this->input->post('funding_aa'),
                'all_class' => $this->input->post('class_aa'),
            );

            $this->db_budget->insert('allotment', $allotment);
            $allotment_id = $this->db_budget->insert_id();

             // insert logs
             $logs = array(
                'log_action' => 'create allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $allotment_id,
            );

            $this->db_budget->insert('logs', $logs);
        
            // allotment_amount table
            $this->db_budget->select('*');
            $this->db_budget->from('sub_pap');
            $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
            $this->db_budget->order_by('sp_code ASC');
    
            $query = $this->db_budget->get();

            foreach($query->result_array() as $row){
                $sp_id = $row['sp_id'];

                $amount = array(
                    'amt_jan' => $this->input->post($sp_id.'-amount-jan-aa'),
                    'amt_feb' => $this->input->post($sp_id.'-amount-feb-aa'),
                    'amt_mar' => $this->input->post($sp_id.'-amount-mar-aa'),
                    'amt_apr' => $this->input->post($sp_id.'-amount-apr-aa'),
                    'amt_may' => $this->input->post($sp_id.'-amount-may-aa'),
                    'amt_jun' => $this->input->post($sp_id.'-amount-jun-aa'),
                    'amt_jul' => $this->input->post($sp_id.'-amount-jul-aa'),
                    'amt_aug' => $this->input->post($sp_id.'-amount-aug-aa'),
                    'amt_sep' => $this->input->post($sp_id.'-amount-sep-aa'),
                    'amt_oct' => $this->input->post($sp_id.'-amount-oct-aa'),
                    'amt_nov' => $this->input->post($sp_id.'-amount-nov-aa'),
                    'amt_dec' => $this->input->post($sp_id.'-amount-dec-aa'),
                    'amt_sub_pap_id' =>  $sp_id,
                    'amt_all_id' => $allotment_id,
                );

                $this->db_budget->insert('allotment_amount', $amount);
            };
        }else if($createbtn == 'create_aa_or'){
            // CREATE AUTOMATIC APPROPRIATION OTHER RELEASES
            // allotment table
            $allotment = array(
                'all_region' => $this->input->post('region'),
                'all_year' => $this->input->post('year'),
                'all_category' => $this->input->post('all_category_aa'),
                'all_type' => $this->input->post('type_aa'),
                'all_funding' => $this->input->post('funding_aa'),
                'all_saa_no' => $this->input->post('or_number_aa'),
                'all_saa_desc' => $this->input->post('or_desc_aa'),
                'all_class' => $this->input->post('class_aa'),
            );

            $this->db_budget->insert('allotment', $allotment);
            $allotment_id = $this->db_budget->insert_id();

             // insert logs
             $logs = array(
                'log_action' => 'create allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $allotment_id,
            );

            $this->db_budget->insert('logs', $logs);
        
            // allotment_amount table
            $this->db_budget->select('*');
            $this->db_budget->from('sub_pap');
            $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
            $this->db_budget->order_by('sp_code ASC');
    
            $query = $this->db_budget->get();

            foreach($query->result_array() as $row){
                $sp_id = $row['sp_id'];

                $amount = array(
                    'amt_jan' => $this->input->post('newAct_'.$sp_id.'_input_jan_aa_or'),
                    'amt_feb' => $this->input->post('newAct_'.$sp_id.'_input_feb_aa_or'),
                    'amt_mar' => $this->input->post('newAct_'.$sp_id.'_input_mar_aa_or'),
                    'amt_apr' => $this->input->post('newAct_'.$sp_id.'_input_apr_aa_or'),
                    'amt_may' => $this->input->post('newAct_'.$sp_id.'_input_may_aa_or'),
                    'amt_jun' => $this->input->post('newAct_'.$sp_id.'_input_jun_aa_or'),
                    'amt_jul' => $this->input->post('newAct_'.$sp_id.'_input_jul_aa_or'),
                    'amt_aug' => $this->input->post('newAct_'.$sp_id.'_input_aug_aa_or'),
                    'amt_sep' => $this->input->post('newAct_'.$sp_id.'_input_sep_aa_or'),
                    'amt_oct' => $this->input->post('newAct_'.$sp_id.'_input_oct_aa_or'),
                    'amt_nov' => $this->input->post('newAct_'.$sp_id.'_input_nov_aa_or'),
                    'amt_dec' => $this->input->post('newAct_'.$sp_id.'_input_dec_aa_or'),
                    'amt_sub_pap_id' =>  $sp_id,
                    'amt_all_id' => $allotment_id,
                );

                if(($this->input->post('newAct_'.$sp_id.'_input_jan_aa_or')) !== null){
                    $this->db_budget->insert('allotment_amount', $amount);
                }
                
            };
        }else if($createbtn == 'create_aa_sa'){
            // CREATE AUTOMATIC APPROPRIATION SAA
            // allotment table
            $allotment = array(
                'all_region' => $this->input->post('region'),
                'all_year' => $this->input->post('year'),
                'all_category' => $this->input->post('all_category_aa'),
                'all_type' => $this->input->post('type_aa'),
                'all_funding' => $this->input->post('funding_aa'),
                'all_saa_no' => $this->input->post('SAA_number_aa'),
                'all_saa_desc' => $this->input->post('SAA_desc_aa'),
                'all_class' => $this->input->post('class_aa'),
            );

            $this->db_budget->insert('allotment', $allotment);
            $allotment_id = $this->db_budget->insert_id();

             // insert logs
             $logs = array(
                'log_action' => 'create allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $allotment_id,
            );

            $this->db_budget->insert('logs', $logs);
        
            // allotment_amount table
            $this->db_budget->select('*');
            $this->db_budget->from('sub_pap');
            $this->db_budget->join('main_pap', 'sub_pap.sp_mp_id = main_pap.mp_id');
            $this->db_budget->order_by('sp_code ASC');
    
            $query = $this->db_budget->get();

            foreach($query->result_array() as $row){
                $sp_id = $row['sp_id'];

                $amount = array(
                    'amt_jan' => $this->input->post('newActsaa_'.$sp_id.'_input_jan_aa_sa'),
                    'amt_feb' => $this->input->post('newActsaa_'.$sp_id.'_input_feb_aa_sa'),
                    'amt_mar' => $this->input->post('newActsaa_'.$sp_id.'_input_mar_aa_sa'),
                    'amt_apr' => $this->input->post('newActsaa_'.$sp_id.'_input_apr_aa_sa'),
                    'amt_may' => $this->input->post('newActsaa_'.$sp_id.'_input_may_aa_sa'),
                    'amt_jun' => $this->input->post('newActsaa_'.$sp_id.'_input_jun_aa_sa'),
                    'amt_jul' => $this->input->post('newActsaa_'.$sp_id.'_input_jul_aa_sa'),
                    'amt_aug' => $this->input->post('newActsaa_'.$sp_id.'_input_aug_aa_sa'),
                    'amt_sep' => $this->input->post('newActsaa_'.$sp_id.'_input_sep_aa_sa'),
                    'amt_oct' => $this->input->post('newActsaa_'.$sp_id.'_input_oct_aa_sa'),
                    'amt_nov' => $this->input->post('newActsaa_'.$sp_id.'_input_nov_aa_sa'),
                    'amt_dec' => $this->input->post('newActsaa_'.$sp_id.'_input_dec_aa_sa'),
                    'amt_sub_pap_id' =>  $sp_id,
                    'amt_all_id' => $allotment_id,
                );

                if(($this->input->post('newActsaa_'.$sp_id.'_input_jan_aa_sa')) !== null){
                    $this->db_budget->insert('allotment_amount', $amount);
                }
                
            };
        }

        return true;
    }

    public function delete_allotment($id){
        $this->db_budget->select('*');
        $this->db_budget->from('allotment_amount');
        $this->db_budget->join('disbursements', 'allotment_amount.amt_id = disbursements.dis_amt_id');

        $query = $this->db_budget->get();

        foreach($query->result_array() as $row){
            $amt_id = $row['amt_id'];

            $this->db_budget->where('dis_amt_id', $amt_id);
            $this->db_budget->delete('disbursements');
        }

        $this->db_budget->select('*');
        $this->db_budget->from('allotment_amount');
        $this->db_budget->join('obligations', 'allotment_amount.amt_id = obligations.ob_amt_id');

        $query1 = $this->db_budget->get();

        foreach($query1->result_array() as $row1){
            $amt_id = $row1['amt_id'];

            $this->db_budget->where('ob_amt_id', $amt_id);
            $this->db_budget->delete('obligations');
        }

        
        $this->db_budget->where('amt_all_id', $id);
        $this->db_budget->delete('allotment_amount');

        $this->db_budget->where('all_id', $id);
        $this->db_budget->delete('allotment');
        return true;
    }

    public function edit_allotment($id){
        $this->db_budget->select('*');
        $this->db_budget->from('allotment');
        $this->db_budget->join('allotment_amount', 'allotment.all_id = allotment_amount.amt_all_id');
        $this->db_budget->join('sub_pap', 'sub_pap.sp_id = allotment_amount.amt_sub_pap_id');
        $this->db_budget->where('allotment.all_id', $id);
        $query = $this->db_budget->get();

        return $query->result_array();
    }

    public function update_allotment(){
        // allotment table
        $allotment = array(
            'all_saa_no' => $this->input->post('SAA_number'),
            'all_saa_desc' => $this->input->post('SAA_desc'),
        );

        $this->db_budget->where('all_id', $this->input->post('allotment_id'));
        $this->db_budget->update('allotment', $allotment);

         // insert logs
            $logs = array(
                'log_action' => 'edit allotment',
                'log_user' => $_SESSION['user'],
                'log_remarks' => 'allotment id',
                'log_data' =>  $this->input->post('allotment_id'),
            );

            $this->db_budget->insert('logs', $logs);

        // allotment_amount table
        $this->db_budget->select('*');
        $this->db_budget->from('allotment');
        $this->db_budget->join('allotment_amount', 'allotment.all_id = allotment_amount.amt_all_id');
        $this->db_budget->join('sub_pap', 'sub_pap.sp_id = allotment_amount.amt_sub_pap_id');
        $this->db_budget->where('allotment.all_id', $this->input->post('allotment_id'));
        $query = $this->db_budget->get();

        
        //return $query->result_array();
        
        foreach($query->result_array() as $row){
            $sp_id = $row['amt_sub_pap_id'];
            $amt_id = $row['amt_id'];
            
            $amt = array(
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
            );

            $this->db_budget->where('amt_id', $amt_id);
            $this->db_budget->update('allotment_amount', $amt);
            
        };
        

        return true;
    }
    // ---------------------------------- END ALLOTMENT TABLE ----------------------------------

    // ---------------------------------- ALLOTMENT REPORT ----------------------------------
    public function allotment_report(){
        $this->db_budget->select('*');
        $this->db_budget->from('allotment_amount');
        $this->db_budget->join('allotment', 'allotment.all_id = allotment_amount.amt_all_id');
        $this->db_budget->join('sub_pap', 'sub_pap.sp_id = allotment_amount.amt_sub_pap_id');
        $query = $this->db_budget->get();
        return $query->result_array();
    }
    // ---------------------------------- END ALLOTMENT REPORT ----------------------------------
}
?>