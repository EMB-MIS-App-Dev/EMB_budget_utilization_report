<?php
    class Disbursementscontroller extends CI_Controller{
        public function index(){
                
            $this->load->view('templates/header');
            $this->load->view('home');
            $this->load->view('templates/footer');
        }

        public function disbursements(){
            $data['allotments'] = $this->budget_allocation_model->view_allotment();

            //echo json_encode($data['allotment_amount']);
            $this->load->view('templates/header');
            $this->load->view('disbursements/disbursements-view',  $data);
            $this->load->view('js/disbursements-js');
            $this->load->view('templates/footer');
        }
    }
?>