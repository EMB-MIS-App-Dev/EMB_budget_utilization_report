<?php
    class Disbursementscontroller extends CI_Controller{
        public function index(){
                
            $this->load->view('templates/header');
            $this->load->view('home');
            $this->load->view('templates/footer');
        }

        public function disbursements(){
            $data['allotments'] = $this->budget_allocation_model->view_allotment();
            $user['user'] = $this->budget_allocation_model->get_user();

            //echo json_encode($data['allotment_amount']);
            $this->load->view('templates/header', $user);
            $this->load->view('disbursements/disbursements-view',  $data);
            $this->load->view('js/disbursements-js');
            $this->load->view('templates/footer');
        }

        public function disbursements_month($id){
            $data['allotments'] = $this->budget_allocation_model->view_allotment_one($id);
            $data['allotment_amount'] = $this->budget_allocation_model->view_allotment_amount($id);
            $data['main_pap'] = $this->budget_allocation_model->view_main_pap();

            $data['obligations'] = $this->budget_obligations_model->view_obligation();
            $data['disbursements'] = $this->budget_disbursements_model->view_disbursements();
            
            $user['user'] = $this->budget_allocation_model->get_user();
            
            // echo json_encode($data['obligations']);
            $this->load->view('templates/header', $user);
            $this->load->view('disbursements/disbursements-month-view', $data);
            $this->load->view('js/disbursements-js');
            $this->load->view('templates/footer');
        }

        public function disbursements_update(){

            $data['disbursements'] = $this->budget_disbursements_model->insert_disbursements();
            
            // echo json_encode($data['allotments']);
            $this->session->set_flashdata('successmsg', 'Disbursements successfully updated!');
            $url = $_SERVER['HTTP_REFERER'];
            redirect($url);
        }
    }
?>