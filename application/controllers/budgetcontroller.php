<?php
    class Budgetcontroller extends CI_Controller{
        
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

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('settings/sub_pap/create-pap');
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

        public function allotment(){
            
            $this->load->view('templates/header');
            $this->load->view('allotment');
            $this->load->view('templates/footer');
        }

        public function saa(){
            
            $this->load->view('templates/header');
            $this->load->view('saa');
            $this->load->view('templates/footer');
        }

        public function saa_create(){
            
            $this->form_validation->set_rules('region', 'Region',
                    'required');
            $this->form_validation->set_rules('month', 'Month',
                    'required');
            $this->form_validation->set_rules('year', 'Year',
                    'required');
            $this->form_validation->set_rules('SAA_name', 'SAA',
                    'required');
            
            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('saa/create');
                $this->load->view('templates/footer');
            }else{
                $this->budget_allocation_model->saa_create();
                $this->session->set_flashdata('successmsg', 'SAA successfully created!');
                redirect('saa');
            }
        }

        public function allotment_create(){
            $this->form_validation->set_rules('region', 'Region',
                    'required');
            $this->form_validation->set_rules('year', 'Year',
                    'required');
            
            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('allotment/create');
                $this->load->view('templates/footer');
            }else{
                $this->budget_allocation_model->allotment_create();
                $this->session->set_flashdata('successmsg', 'Allotment successfully created!');
                redirect('allotment');
            }
          
        }    
        
    }
?>