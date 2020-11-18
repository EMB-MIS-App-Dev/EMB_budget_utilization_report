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
            $data['disbursements'] = $this->budget_disbursements_model->view_disbursements();
            

            // echo json_encode($data['allotment_amt_all']);
            $this->load->view('templates/header', $user);
            $this->load->view('reports/reports-view', $data);
            $this->load->view('js/reports-js');
            $this->load->view('templates/footer');
        }

        public function logs_view(){
            $user['user'] = $this->budget_allocation_model->get_user();

            $data['logs'] = $this->budget_allocation_model->view_logs();
            

            // echo json_encode($data['logs']);
            $this->load->view('templates/header', $user);
            $this->load->view('reports/logs-view', $data);
            $this->load->view('js/logs-js');
            $this->load->view('templates/footer');
        }
        
    }
?>