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
            $this->form_validation->set_rules('report', 'Report',
            'required');
            $this->form_validation->set_rules('category', 'Category',
            'required');
            $this->form_validation->set_rules('year', 'Year',
            'required');
            $this->form_validation->set_rules('class', 'Class',
            'required');
            $this->form_validation->set_rules('month_from', 'Month',
            'required');
            $this->form_validation->set_rules('month_to', 'Month',
            'required');

            if($this->form_validation->run() === FALSE){
                $user['user'] = $this->budget_allocation_model->get_user();
    
                // echo json_encode($data['allotment_amt_all']);
                $this->load->view('templates/header', $user);
                $this->load->view('reports/reports-view');
                // $this->load->view('js/reports-js');
                $this->load->view('templates/footer');
                
            }else{

                
                $data['allotment_amt_all'] = $this->budget_allocation_model->allotment_report();
                $data['obligation'] = $this->budget_obligations_model->view_obligation();
                $data['disbursements'] = $this->budget_disbursements_model->view_disbursements();
                // echo json_encode($data['allotment_amt_all']);

                $user['user'] = $this->budget_allocation_model->get_user();
                $data['details'] = array(
                    'report' => $this->input->post('report'),
                    'category' => $this->input->post('category'),
                    'year' => $this->input->post('year'),
                    'class' => $this->input->post('class'),
                    'month_from' => $this->input->post('month_from'),
                    'month_to' => $this->input->post('month_to')
                );

                //  echo json_encode($data['allotment_amt_all']);
                $this->load->view('templates/header', $user);
                $this->load->view('reports/reports-view', $data);
                $this->load->view('templates/footer');
            }

           
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