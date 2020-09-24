<?php
    class Obligationcontroller extends CI_Controller{
        public function index(){
                
            $this->load->view('templates/header');
            $this->load->view('home');
            $this->load->view('templates/footer');
        }
    // ------------------------OBLIGATION------------------------
        public function obligation(){
            $data['allotments'] = $this->budget_allocation_model->view_allotment();
            $user['user'] = $this->budget_allocation_model->get_user();

            //echo json_encode($data['allotment_amount']);
            $this->load->view('templates/header', $user);
            $this->load->view('obligation/obligation-view',  $data);
            $this->load->view('js/obligation-js');
            $this->load->view('templates/footer');
        }

        public function obligation_month($id){
            $data['allotments'] = $this->budget_allocation_model->view_allotment_one($id);
            $data['allotment_amount'] = $this->budget_allocation_model->view_allotment_amount($id);
            $data['main_pap'] = $this->budget_allocation_model->view_main_pap();
            $data['obligations'] = $this->budget_obligations_model->view_obligation();

            $user['user'] = $this->budget_allocation_model->get_user();

            // echo json_encode($data['obligations']);
            $this->load->view('templates/header', $user);
            $this->load->view('obligation/obligation-month-view',  $data);
            $this->load->view('js/obligation-js');
            $this->load->view('templates/footer');
        }

        public function obligation_month_summary($id){
            $data['allotments'] = $this->budget_allocation_model->view_allotment_one($id);
            $data['allotment_amount'] = $this->budget_allocation_model->view_allotment_amount($id);
            $data['main_pap'] = $this->budget_allocation_model->view_main_pap();
            $data['obligations'] = $this->budget_obligations_model->view_obligation();

            // echo json_encode($data['obligations']);
            $this->load->view('obligation/obligation-month-summary',  $data);
            $this->load->view('js/obligation-js');
        }

        public function obligation_update(){

            $data['obligations'] = $this->budget_obligations_model->insert_obligation();
            
            // echo json_encode($data['allotments']);
            $this->session->set_flashdata('successmsg', 'Obligation successfully updated!');
            $url = $_SERVER['HTTP_REFERER'];
            redirect($url);
        }
    }
?>