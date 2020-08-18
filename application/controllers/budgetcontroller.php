<?php
    class Budgetcontroller extends CI_Controller{
        public function __construct(){
            //$this->load->database();
            parent::__construct();
            $this->db_budget = $this->load->database('bud_db', TRUE);
        }
        
        public function index(){
            
            $this->load->view('templates/header');
            $this->load->view('home');
            $this->load->view('templates/footer');
        }

        // ------------------------MAIN PAP------------------------
        public function main_pap_viewall(){
            
            $data['main_pap'] = $this->budget_allocation_model->view_main_pap();

            $this->load->view('templates/header');
            $this->load->view('settings/main_pap/main-pap', $data);
            $this->load->view('templates/footer');
        }

        public function main_pap_create(){
            $this->form_validation->set_rules('mp_code', 'Code',
                    'required');
            $this->form_validation->set_rules('mp_name', 'Name',
                    'required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('settings/main_pap/create-pap');
                $this->load->view('templates/footer');
            }else{
                $this->budget_allocation_model->add_main_pap();
                $this->session->set_flashdata('successmsg', 'PAP successfully created!');
                redirect('mp');
            }
        }

        public function main_pap_edit($id){
            $data['main_pap'] = $this->budget_allocation_model->view_main_pap_one($id);

            // echo json_encode($data['budgets']);
            $this->load->view('templates/header');
            $this->load->view('settings/main_pap/edit-pap', $data);
            $this->load->view('templates/footer');
        }

        public function main_pap_update(){
            $this->budget_allocation_model->update_main_pap();
            $this->session->set_flashdata('successmsg', 'PAP successfully updated!');
            redirect('mp');
        }

        public function main_pap_delete($id){
            $this->budget_allocation_model->delete_main_pap($id);
            $this->session->set_flashdata('successmsg', 'PAP successfully deleted!');
            redirect('mp');
        }
        // ------------------------END MAIN PAP------------------------

        // ------------------------SUB PAP------------------------
        public function sub_pap_viewall(){
            
            $data['sub_pap'] = $this->budget_allocation_model->view_sub_pap();

            $this->load->view('templates/header');
            $this->load->view('settings/sub_pap/sub-pap', $data);
            $this->load->view('templates/footer');
        }

        public function sub_pap_create(){
            $this->form_validation->set_rules('sp_code', 'Code',
                    'required');
            $this->form_validation->set_rules('sp_name', 'Name',
                    'required');

            $data['main_pap'] = $this->budget_allocation_model->view_main_pap();

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('settings/sub_pap/create-pap', $data);
                $this->load->view('templates/footer');
            }else{
                $this->budget_allocation_model->add_sub_pap();
                $this->session->set_flashdata('successmsg', 'PAP successfully created!');
                redirect('sp');
            }
        }

        public function sub_pap_edit($id){
            $data['sub_pap'] = $this->budget_allocation_model->view_sub_pap_one($id);

            // echo json_encode($data['budgets']);
            $this->load->view('templates/header');
            $this->load->view('settings/sub_pap/edit-pap', $data);
            $this->load->view('templates/footer');
        }

        public function sub_pap_update(){
            $this->budget_allocation_model->update_sub_pap();
            $this->session->set_flashdata('successmsg', 'PAP successfully updated!');
            redirect('sp');
        }

        public function sub_pap_delete($id){
            $this->budget_allocation_model->delete_sub_pap($id);
            $this->session->set_flashdata('successmsg', 'PAP successfully deleted!');
            redirect('sp');
        }
        // ------------------------END SUB PAP------------------------

        // ------------------------ALLOTMENT------------------------
        public function allotment(){
            $data['allotments'] = $this->budget_allocation_model->view_allotment();

            // echo json_encode($data['allotments']);
            $this->load->view('templates/header');
            $this->load->view('allotment/allotment',  $data);
            $this->load->view('templates/footer');
        }

        public function allotment_create(){
            $this->form_validation->set_rules('region', 'Region', 'callback_exists_check');

            $this->form_validation->set_rules('year', 'Year',
                    'required');


            $data['sub_pap'] = $this->budget_allocation_model->view_sub_pap();

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('allotment/create', $data);
                $this->load->view('templates/footer');
            }else{
                $data['allotments'] =  $this->budget_allocation_model->add_allotment();

                //echo json_encode($data['allotments']);
                $this->session->set_flashdata('successmsg', 'Allotment successfully created!');
                redirect('allotment/create', $data);
            }
           
        }

        public function exists_check(){   
            $region = $this->input->post('region');// get region
            $year = $this->input->post('year');// get year
            $sf = $this->input->post('fund_source');// source_fund
            $this->db_budget->select('*');
            $this->db_budget->from('allotment');
            $this->db_budget->where('region', $region);
            $this->db_budget->where('year', $year);
            $this->db_budget->where('fund_source', $sf);
            $query = $this->db_budget->get();
            $num = $query->num_rows();
            if ($num > 0) {
                $this->form_validation->set_message('exists_check', 'Budget for this year already exists.');
                return FALSE;
            } else {
                return TRUE;
            }
            
            return FALSE;
        }


        //CLASS
        public function allotment_class($id){
            
           $data['allotment_class'] = $this->budget_allocation_model->view_allotment_class($id);

            //echo json_encode($data['allotment_class']);
            $this->load->view('templates/header');
            $this->load->view('allotment/class/allotment-class', $data);
            $this->load->view('templates/footer');
        }

        public function allotment_class_update(){
            $data['allotment_id'] = $this->budget_allocation_model->update_allotment_class();

            $this->session->set_flashdata('successmsg', 'PAP successfully updated!');

            $url = $_SERVER['HTTP_REFERER'];
            redirect($url);
        }


        //SAA
        public function allotment_class_saa($id){
            
            $data['saa'] = $this->budget_allocation_model->view_saa($id);
            $data['allotment_class'] = $this->budget_allocation_model->view_one_allotment_class($id);

            // echo json_encode($data['allotment_class']);
            $this->load->view('templates/header');
            $this->load->view('allotment/class/saa/saa',  $data);
            $this->load->view('templates/footer');
        }
        // ------------------------END ALLOTMENT------------------------

        public function allotment_class_saa_create(){
            $this->load->view('templates/header');
            $this->load->view('allotment/class/saa/create');
            $this->load->view('templates/footer');
        }
    }
?>