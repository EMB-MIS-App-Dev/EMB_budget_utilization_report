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

            // echo json_encode($data['allotments']);
            $this->load->view('templates/header', $user);
            $this->load->view('reports/reports-view');
            $this->load->view('js/reports-js');
            $this->load->view('templates/footer');
        }
        
    }
?>