<?php
    class Regioncontroller extends CI_Controller{
        public function __construct(){
            //$this->load->database();
            parent::__construct();
            $this->db_budget = $this->load->database('bud_db', TRUE);
        }
        
        public function region(){
            
            $data['allotments'] = $this->budget_allocation_model->view_allotment();

            $this->load->view('templates/header');
            $this->load->view('region/region', $data);
            $this->load->view('templates/footer');
        }

        public function region_class($id){
            
            $data['allotment_class'] = $this->budget_allocation_model->view_allotment_class($id);

            $this->load->view('templates/header');
            $this->load->view('region/class/region-class', $data);
            $this->load->view('templates/footer');
        }
    }
?>