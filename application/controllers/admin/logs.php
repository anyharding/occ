<?php

class Logs extends CI_Controller {

    private $limit = 10;
    private $uri_segment = 4;

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('pagination');
    }

    public function index() {
        $data['title'] = "Contractors Login Log monthly";
        $data['unique_logns'] = $this->user_model->getLogs();
        $this->template->load('admin', 'admin/logs/index', $data);
        //echo "<pre>";print_r($powerusers_list);
    }

    public function weekly() {
        $data['title'] = "Contractors Login Log weekly";
        $data['unique_logns'] = $this->user_model->getLogs();
        $this->template->load('admin', 'admin/logs/weekly', $data);
        //echo "<pre>";print_r($powerusers_list);
    }

    public function lastsixMonths() {
        $data['title'] = "Contractors Login Log for six months";
        $data['unique_logns'] = $this->user_model->getLogs();
        $this->template->load('admin', 'admin/logs/lastsixMonths', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
