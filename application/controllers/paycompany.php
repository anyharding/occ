<?php

class Paycompany extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
//        if (!$this->session->userdata('userId')) {
//            redirect('welcome/myProfile');
//        }
        $this->load->model('house_model');
        $this->load->model('user_model', 'User', true);
        $this->load->model('rent_model');
        $this->load->model('welcome_model', 'Welcome');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('Jquery_pagination');

        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        if ($this->session->userdata('day')) {
            $this->session->unset_userdata('day');
        }
    }

    function loginCheck($str) {
        if (!$this->session->userdata('userId')) {
            $this->session->set_userdata('returnURL', $str);
            redirect('welcome/login');
        }
    }

    public function index1() {
        $this->loginCheck("paycompany/index");
        $config['base_url'] = base_url() . "paycompany/index";
        $config['total_rows'] = $this->house_model->countPayCompany();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $paycompany = $this->house_model->paycompanyList($config['per_page'], $this->uri->segment(3));
        $data['title'] = "Pay Companies List";
        $this->pagination->initialize($config);
        $data['paycompany'] = $paycompany;
        $this->template->load('front', 'paycompany/index', $data);
    }

    function ajax_index($offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('paycompany/ajax_index/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->house_model->countpaycompany();
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['paycompany'] = $this->house_model->paycompanyList($config['per_page'], $offset);
        $this->load->view('paycompany/ajax_index', $data);
    }

    public function index($offset = 0) {
        $this->loginCheck("paycompany/index/");
        ob_start();
        $this->ajax_index($offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Pay Companies List";
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'paycompany/index', $data);
    }

    public function addCompany() {
        $this->loginCheck("paycompany/addCompany");
        $redirect = '/paycompany/';
        $data['title'] = "Add Pay company";
        $this->form_validation->set_rules('account_name', 'Account Name', 'trim|required');
        $this->form_validation->set_rules('if_code', 'IF Code', 'trim|required');
        $this->form_validation->set_rules('account_number', 'Account Number', 'trim|required');
        $this->form_validation->set_rules('bsb', 'BSB', 'trim|required');
        $this->form_validation->set_rules('de_user_id', 'DE User ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $data['banks'] = $this->User->get_banksifs();
            $this->template->load('front', 'paycompany/addCompany', $data);
        } else {
            $data = array(
                'account_name' => $this->input->post('account_name'),
                'if_code' => $this->input->post('if_code'),
                'account_number' => $this->input->post('account_number'),
                'de_user_id' => $this->input->post('de_user_id'),
                'bsb' => $this->input->post('bsb')
            );
            $this->house_model->PAYcompanyRegistration($data);
            $this->session->set_flashdata('smessage', 'Pay company Successfully added');
            redirect($redirect);
        }
    }

    public function deleteCompany() {
        $id = $this->uri->segment(3);
        $this->loginCheck("paycompany/deleteCompany/" . $id);
        $this->house_model->deletepayCompany($id);
        $this->session->set_flashdata('smessage', 'Pay Company Successfully deleted');
        redirect('/paycompany/');
    }

    public function editCompany() {
        $id = $this->uri->segment(3);
        $this->loginCheck("paycompany/editCompany/" . $id);
        $comp_detail = $this->house_model->paycompanyDetail($id);
        $data['comp_detail'] = $comp_detail;
        $data['title'] = "Edit Pay company";
        $this->form_validation->set_rules('account_name', 'Account Name', 'trim|required');
        $this->form_validation->set_rules('if_code', 'IF Code', 'trim|required');
        $this->form_validation->set_rules('account_number', 'Account Number', 'trim|required');
        $this->form_validation->set_rules('bsb', 'BSB', 'trim|required');
        $this->form_validation->set_rules('de_user_id', 'DE User ID', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $data['banks'] = $this->User->get_banksifs();
            $this->template->load('front', 'paycompany/editCompany', $data);
        } else {
            $data = array(
                'account_name' => $this->input->post('account_name'),
                'if_code' => $this->input->post('if_code'),
                'account_number' => $this->input->post('account_number'),
                'de_user_id' => $this->input->post('de_user_id'),
                'bsb' => $this->input->post('bsb')
            );
            $this->house_model->editpayComp($data, $id);
            $this->session->set_flashdata('smessage', 'Pay company Successfully updated');
            redirect("paycompany/");
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
