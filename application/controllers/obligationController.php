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

            //echo json_encode($data['allotment_amount']);
            $this->load->view('templates/header');
            $this->load->view('obligation/obligation-view',  $data);
            $this->load->view('js/obligation-js');
            $this->load->view('templates/footer');
        }

        public function obligation_month($id){
            $data['allotments'] = $this->budget_allocation_model->view_allotment_one($id);
            $data['allotment_amount'] = $this->budget_allocation_model->view_allotment_amount($id);

            // echo json_encode($data['allotment_amount']);
            $this->load->view('templates/header');
            $this->load->view('obligation/obligation-month-view',  $data);
            $this->load->view('js/obligation-js');
            $this->load->view('templates/footer');
        }
    }
?>