<?php
    class Budgetcontroller extends CI_Controller{
        public function get_token(){
            // $_SESSION['token'] = $_GET['token'];
            // $_SESSION['token_id'] = $_GET['token_id'];
            
            $user['user'] = $this->budget_allocation_model->get_user();
            
            $this->load->view('templates/header', $user);
            $this->load->view('home');
            $this->load->view('templates/footer');
        }
        
        public function home(){
            $user['user'] = $this->budget_allocation_model->get_user();

            // echo json_encode($data['user']);
            $this->load->view('templates/header', $user);
            $this->load->view('home');
            $this->load->view('templates/footer');
        }


        // ------------------------ALLOTMENT------------------------
        public function allotment(){
            $data['allotments'] = $this->budget_allocation_model->view_allotment();
            $user['user'] = $this->budget_allocation_model->get_user();

            // echo json_encode($data['allotments']);
            $this->load->view('templates/header', $user);
            $this->load->view('allotment/allotment-view',  $data);
            $this->load->view('js/allotment-js');
            $this->load->view('templates/footer');
        }

        public function allotment_create(){
            
            $this->form_validation->set_rules('region', 'Region', 
                    'required');
            $this->form_validation->set_rules('year', 'Year',
                    'required');

            $createbtn = $this->input->post('createbtn');
                   
            if($createbtn == 'create_cu_as' || $createbtn == 'create_cu_or' || $createbtn == 'create_cu_sa'){
                $this->form_validation->set_rules('type_cu', 'Type', 
                    'required');
                $this->form_validation->set_rules('funding_cu', 'Funding',
                        'required');

                        $funding = $this->input->post('funding_cu');
                        if($funding == 'sa'){
                            $this->form_validation->set_rules('SAA_number_cu', 'SAA Number',
                                    'required');
                            $this->form_validation->set_rules('SAA_desc_cu', 'SAA Description', 
                                    'required');
                        }

                $this->form_validation->set_rules('class_cu', 'Allotment Class', 
                        'required');
            }else if($createbtn == 'create_ca_as' || $createbtn == 'create_ca_or' || $createbtn == 'create_ca_sa'){
                $this->form_validation->set_rules('type_ca', 'Type', 
                    'required');
                $this->form_validation->set_rules('funding_ca', 'Funding',
                        'required');

                        $funding = $this->input->post('funding_ca');
                        if($funding == 'sa'){
                            $this->form_validation->set_rules('SAA_number_ca', 'SAA Number',
                                    'required');
                            $this->form_validation->set_rules('SAA_desc_ca', 'SAA Description', 
                                    'required');
                        }

                $this->form_validation->set_rules('class_ca', 'Allotment Class', 
                        'required');
            }else if($createbtn == 'create_aa_as' || $createbtn == 'create_aa_or' || $createbtn == 'create_aa_sa'){
                $this->form_validation->set_rules('type_aa', 'Type', 
                    'required');
                $this->form_validation->set_rules('funding_aa', 'Funding',
                        'required');

                        $funding = $this->input->post('funding_aa');
                        if($funding == 'sa'){
                            $this->form_validation->set_rules('SAA_number_aa', 'SAA Number',
                                    'required');
                            $this->form_validation->set_rules('SAA_desc_aa', 'SAA Description', 
                                    'required');
                        }

                $this->form_validation->set_rules('class_aa', 'Allotment Class', 
                        'required');
            }
            

            if($this->form_validation->run() === FALSE){
                $data['sub_pap'] = $this->budget_allocation_model->view_sub_pap();
                $data['main_pap'] = $this->budget_allocation_model->view_main_pap();
                $user['user'] = $this->budget_allocation_model->get_user();

                $this->load->view('templates/header', $user);
                $this->load->view('allotment/create', $data);
                $this->load->view('js/allotment-js');
                $this->load->view('templates/footer');
            }else{

                $data['allotment'] =  $this->budget_allocation_model->add_allotment();

                $this->session->set_flashdata('successmsg', 'Allotment successfully created!');

                $url = $_SERVER['HTTP_REFERER'];
                redirect($url);
            }
            
        }

        public function allotment_delete($id){
            $this->budget_allocation_model->delete_allotment($id);
            $this->session->set_flashdata('successmsg', 'Allotment successfully deleted!');
            
            $url = $_SERVER['HTTP_REFERER'];
            redirect($url);
        }

        public function allotment_edit($id){
            $data['allotments'] = $this->budget_allocation_model->edit_allotment($id);
            $data['sub_pap'] = $this->budget_allocation_model->view_sub_pap();
            $data['main_pap'] = $this->budget_allocation_model->view_main_pap();
            $user['user'] = $this->budget_allocation_model->get_user();

            // echo json_encode($data['allotments']);
            $this->load->view('templates/header', $user);
            $this->load->view('allotment/edit', $data);
            $this->load->view('js/allotment-js');
            $this->load->view('templates/footer');
        }

        public function allotment_update(){
            $data['allotments'] = $this->budget_allocation_model->update_allotment();
            
            // echo json_encode($data['allotments']);

            $this->session->set_flashdata('successmsg', 'PAP successfully updated!');
            $url = $_SERVER['HTTP_REFERER'];
            redirect($url);
        }
        // ------------------------END ALLOTMENT------------------------

        // ------------------------MAIN PAP------------------------
        public function main_pap_viewall(){
            
            $data['main_pap'] = $this->budget_allocation_model->view_main_pap();
            $user['user'] = $this->budget_allocation_model->get_user();

            $this->load->view('templates/header', $user);
            $this->load->view('settings/main_pap/main-pap', $data);
            $this->load->view('js/allotment-js');
            $this->load->view('templates/footer');
        }

        public function main_pap_create(){
            $this->form_validation->set_rules('mp_code', 'Code',
                    'required');
            $this->form_validation->set_rules('mp_name', 'Name',
                    'required');

            if($this->form_validation->run() === FALSE){
                $user['user'] = $this->budget_allocation_model->get_user();

                $this->load->view('templates/header', $user);
                $this->load->view('settings/main_pap/create-pap');
                $this->load->view('js/allotment-js');
                $this->load->view('templates/footer');
            }else{
                $this->budget_allocation_model->add_main_pap();
                $this->session->set_flashdata('successmsg', 'PAP successfully created!');
                redirect('mp');
            }
        }

        public function main_pap_edit($id){
            $data['main_pap'] = $this->budget_allocation_model->view_main_pap_one($id);
            $user['user'] = $this->budget_allocation_model->get_user();

            // echo json_encode($data['budgets']);
            $this->load->view('templates/header', $user);
            $this->load->view('settings/main_pap/edit-pap', $data);
            $this->load->view('js/allotment-js');
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
            $user['user'] = $this->budget_allocation_model->get_user();

            $this->load->view('templates/header', $user);
            $this->load->view('settings/sub_pap/sub-pap', $data);
            $this->load->view('js/allotment-js');
            $this->load->view('templates/footer');
        }

        public function sub_pap_create(){
            $this->form_validation->set_rules('sp_code', 'Code',
                    'required');
            $this->form_validation->set_rules('sp_name', 'Name',
                    'required');

            $data['main_pap'] = $this->budget_allocation_model->view_main_pap();

            if($this->form_validation->run() === FALSE){
                $user['user'] = $this->budget_allocation_model->get_user();

                $this->load->view('templates/header', $user);
                $this->load->view('settings/sub_pap/create-pap', $data);
                $this->load->view('js/allotment-js');
                $this->load->view('templates/footer');
            }else{
                $this->budget_allocation_model->add_sub_pap();
                $this->session->set_flashdata('successmsg', 'PAP successfully created!');
                redirect('sp');
            }
        }

        public function sub_pap_edit($id){
            $data['sub_pap'] = $this->budget_allocation_model->view_sub_pap_one($id);
            $user['user'] = $this->budget_allocation_model->get_user();

            // echo json_encode($data['budgets']);
            $this->load->view('templates/header', $user);
            $this->load->view('settings/sub_pap/edit-pap', $data);
            $this->load->view('js/allotment-js');
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
    
        // ------------------------END ALLOTMENT------------------------
        
    }
?>