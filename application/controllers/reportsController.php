<?php
    class Reportscontroller extends CI_Controller{
        public function home(){
            $user['user'] = $this->budget_allocation_model->get_user();

            // echo json_encode($data['user']);
            $this->load->view('templates/header', $user);
            $this->load->view('home');
            $this->load->view('templates/footer');
        }

        public function reports_view(){
            $user['user'] = $this->budget_allocation_model->get_user();

            $data['allotment_amt_all'] = $this->budget_allocation_model->allotment_report();
            $data['obligation'] = $this->budget_obligations_model->view_obligation();
            

            // echo json_encode($data['allotment_amt_all']);
            $this->load->view('templates/header', $user);
            $this->load->view('reports/reports-view', $data);
            $this->load->view('js/reports-js');
            $this->load->view('templates/footer');
        }
        
    }
?>