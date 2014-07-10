<?php

class Company extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
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

    function ajax_index($offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('company/ajax_index/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->house_model->countCompany();
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['company'] = $this->house_model->companyList($config['per_page'], $offset);
        $this->load->view('company/ajax_index', $data);
    }

    public function index($offset = 0) {
        $this->loginCheck("company/index/");
        ob_start();
        $this->ajax_index($offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Companies List";
        $data['ajax_content'] = $initial_content;//'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'company/index', $data);
    }

    public function addCompany() {
        $this->loginCheck("company/addCompany");
        $redirect = '/company/';
        $data['title'] = "Add Company";
        $this->form_validation->set_rules('company', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('abn', 'ABN', 'trim|required');
        $this->form_validation->set_rules('acn', 'ACN', 'trim|required');
        $this->form_validation->set_rules('address', 'Company Address', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'company/addCompany', $data);
        } else {
            $data = array(
                'company' => $this->input->post('company'),
                'abn' => $this->input->post('abn'),
                'acn' => $this->input->post('acn'),
                'address' => $this->input->post('address')
            );
            $this->house_model->companyRegistration($data);
            $this->session->set_flashdata('smessage', 'Company Successfully added');
            redirect($redirect);
        }
    }

    public function deleteCompany() {
        $id = $this->uri->segment(3);
        $this->loginCheck("company/deleteCompany/" . $id);
        $this->house_model->deleteCompany($id);
        $this->session->set_flashdata('smessage', 'Company Successfully deleted');
        redirect('/company/');
    }

    public function editCompany() {
        $id = $this->uri->segment(3);
        $this->loginCheck("company/editCompany/" . $id);
        $comp_detail = $this->house_model->companyDetail($id);
        $data['comp_detail'] = $comp_detail;
        $data['title'] = "Edit Company";
        $this->form_validation->set_rules('company', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('abn', 'ABN', 'trim|required');
        $this->form_validation->set_rules('acn', 'ACN', 'trim|required');
        $this->form_validation->set_rules('address', 'Company Address', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'company/editCompany', $data);
        } else {
            $data = array(
                'company' => $this->input->post('company'),
                'abn' => $this->input->post('abn'),
                'acn' => $this->input->post('acn'),
                'address' => $this->input->post('address')
            );
            $this->house_model->editComp($data, $id);
            $this->session->set_flashdata('smessage', 'Company Successfully updated');
            redirect("company/");
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
