<?php

class Worksite extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
        $this->load->model('worksite_model');
        $this->load->model('welcome_model', 'Welcome');
        $this->load->library('pagination');
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
        $config['base_url'] = site_url('worksite/ajax_index/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->worksite_model->countworksites();
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['worksites'] = $this->worksite_model->worksiteList($config['per_page'], $offset, "normal_house");
        $this->load->view('worksite/ajax_index', $data);
    }

    public function index($offset = 0) {
        $this->loginCheck("worksite/index/");
        ob_start();
        $this->ajax_index($offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Worksites List";
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'worksite/index', $data);
    }

    public function addworksite() {
        $this->loginCheck("worksite/addworksite/");
        $redirect = '/worksite/';
        $data['users'] = $this->worksite_model->get_users();
        $data['title'] = "Add Worksite";

        $this->form_validation->set_rules('company', 'Contacted company', 'trim|required');
        $this->form_validation->set_rules('address', 'Worksite Address', 'trim|required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'trim|required');

        $this->form_validation->set_rules('site_rate1', 'Site rate1', 'trim|required|numeric');
        $this->form_validation->set_rules('site_rate_name1', 'Site rate name1', 'trim|required');

        $this->form_validation->set_rules('site_rate2', 'Site rate2', 'trim|required|numeric');
        $this->form_validation->set_rules('site_rate_name2', 'Site rate name2', 'trim|required');

        $this->form_validation->set_rules('site_rate3', 'Site rate3', 'trim|required|numeric');
        $this->form_validation->set_rules('site_rate_name3', 'Site rate name3', 'trim|required');

        $this->form_validation->set_rules('site_rate4', 'Site rate4', 'trim|numeric');

        $this->form_validation->set_rules('site_rate5', 'Site rate5', 'trim|numeric');

        $this->form_validation->set_rules('site_rate6', 'Site rate6', 'trim|numeric');

        $this->form_validation->set_rules('site_rate7', 'Site rate7', 'trim|numeric');

        $this->form_validation->set_rules('site_rate8', 'Site rate8', 'trim|numeric');

        $this->form_validation->set_rules('site_rate9', 'Site rate9', 'trim|numeric');

        $this->form_validation->set_rules('site_rate10', 'Site rate10', 'trim|numeric');

        $this->form_validation->set_rules('site_rate11', 'Site rate11', 'trim|numeric');

        $this->form_validation->set_rules('site_rate12', 'Site rate12', 'trim|numeric');

        $this->form_validation->set_rules('site_rate13', 'Site rate13', 'trim|numeric');

        $this->form_validation->set_rules('site_rate14', 'Site rate14', 'trim|numeric');

        $this->form_validation->set_rules('site_rate15', 'Site rate15', 'trim|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'worksite/addWorksite', $data);
        } else {
            $data = array(
                'company' => $this->input->post('company'),
                'address' => $this->input->post('address'),
                'contact' => $this->input->post('contact'),
                'site_rate1' => $this->input->post('site_rate1'),
                'site_rate_name1' => $this->input->post('site_rate_name1'),
                'site_rate2' => $this->input->post('site_rate2'),
                'site_rate_name2' => $this->input->post('site_rate_name2'),
                'site_rate3' => $this->input->post('site_rate3'),
                'site_rate_name3' => $this->input->post('site_rate_name3'),
                'site_rate4' => $this->input->post('site_rate4'),
                'site_rate_name4' => $this->input->post('site_rate_name4'),
                'site_rate5' => $this->input->post('site_rate5'),
                'site_rate_name5' => $this->input->post('site_rate_name5'),
                'site_rate6' => $this->input->post('site_rate6'),
                'site_rate_name6' => $this->input->post('site_rate_name6'),
                'site_rate7' => $this->input->post('site_rate7'),
                'site_rate_name7' => $this->input->post('site_rate_name7'),
                'site_rate8' => $this->input->post('site_rate8'),
                'site_rate_name8' => $this->input->post('site_rate_name8'),
                'site_rate9' => $this->input->post('site_rate9'),
                'site_rate_name9' => $this->input->post('site_rate_name9'),
                'site_rate10' => $this->input->post('site_rate10'),
                'site_rate_name10' => $this->input->post('site_rate_name10'),
                'site_rate11' => $this->input->post('site_rate11'),
                'site_rate_name11' => $this->input->post('site_rate_name11'),
                'site_rate12' => $this->input->post('site_rate12'),
                'site_rate_name12' => $this->input->post('site_rate_name12'),
                'site_rate13' => $this->input->post('site_rate13'),
                'site_rate_name13' => $this->input->post('site_rate_name13'),
                'site_rate14' => $this->input->post('site_rate14'),
                'site_rate_name14' => $this->input->post('site_rate_name14'),
                'site_rate15' => $this->input->post('site_rate15'),
                'site_rate_name15' => $this->input->post('site_rate_name15'),
                'created' => date('Y-m-d'),
                'status' => '1'
            );
            $this->worksite_model->worksiteRegistration($data);
            $this->session->set_flashdata('smessage', 'Worksite Successfully added');
            redirect($redirect);
        }
    }

    public function editworksite() {
        $id = $this->uri->segment(3);
        $this->loginCheck("worksite/editworksite/" . $id);
        $data['users'] = $this->worksite_model->get_users();
        $edit_worksite = $this->worksite_model->worksiteDetail($id);
        $data['edit_worksite'] = $edit_worksite;
        $data['title'] = "Edit Worksite";
        $this->form_validation->set_rules('company', 'Contacted company', 'trim|required');
        $this->form_validation->set_rules('address', 'Worksite Address', 'trim|required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'trim|required');

        $this->form_validation->set_rules('site_rate1', 'Site rate1', 'trim|required|numeric');
        $this->form_validation->set_rules('site_rate_name1', 'Site rate name1', 'trim|required');

        $this->form_validation->set_rules('site_rate2', 'Site rate2', 'trim|required|numeric');
        $this->form_validation->set_rules('site_rate_name2', 'Site rate name2', 'trim|required');

        $this->form_validation->set_rules('site_rate3', 'Site rate3', 'trim|required|numeric');
        $this->form_validation->set_rules('site_rate_name3', 'Site rate name3', 'trim|required');

        $this->form_validation->set_rules('site_rate4', 'Site rate4', 'trim|numeric');

        $this->form_validation->set_rules('site_rate5', 'Site rate5', 'trim|numeric');

        $this->form_validation->set_rules('site_rate6', 'Site rate6', 'trim|numeric');

        $this->form_validation->set_rules('site_rate7', 'Site rate7', 'trim|numeric');

        $this->form_validation->set_rules('site_rate8', 'Site rate8', 'trim|numeric');

        $this->form_validation->set_rules('site_rate9', 'Site rate9', 'trim|numeric');

        $this->form_validation->set_rules('site_rate10', 'Site rate10', 'trim|numeric');

        $this->form_validation->set_rules('site_rate11', 'Site rate11', 'trim|numeric');

        $this->form_validation->set_rules('site_rate12', 'Site rate12', 'trim|numeric');

        $this->form_validation->set_rules('site_rate13', 'Site rate13', 'trim|numeric');

        $this->form_validation->set_rules('site_rate14', 'Site rate14', 'trim|numeric');

        $this->form_validation->set_rules('site_rate15', 'Site rate15', 'trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'worksite/editWorksite', $data);
        } else {
            $data = array(
                'company' => $this->input->post('company'),
                'address' => $this->input->post('address'),
                'contact' => $this->input->post('contact'),
                'site_rate1' => $this->input->post('site_rate1'),
                'site_rate_name1' => $this->input->post('site_rate_name1'),
                'site_rate2' => $this->input->post('site_rate2'),
                'site_rate_name2' => $this->input->post('site_rate_name2'),
                'site_rate3' => $this->input->post('site_rate3'),
                'site_rate_name3' => $this->input->post('site_rate_name3'),
                'site_rate4' => $this->input->post('site_rate4'),
                'site_rate_name4' => $this->input->post('site_rate_name4'),
                'site_rate5' => $this->input->post('site_rate5'),
                'site_rate_name5' => $this->input->post('site_rate_name5'),
                'site_rate6' => $this->input->post('site_rate6'),
                'site_rate_name6' => $this->input->post('site_rate_name6'),
                'site_rate7' => $this->input->post('site_rate7'),
                'site_rate_name7' => $this->input->post('site_rate_name7'),
                'site_rate8' => $this->input->post('site_rate8'),
                'site_rate_name8' => $this->input->post('site_rate_name8'),
                'site_rate9' => $this->input->post('site_rate9'),
                'site_rate_name9' => $this->input->post('site_rate_name9'),
                'site_rate10' => $this->input->post('site_rate10'),
                'site_rate_name10' => $this->input->post('site_rate_name10'),
                'site_rate11' => $this->input->post('site_rate11'),
                'site_rate_name11' => $this->input->post('site_rate_name11'),
                'site_rate12' => $this->input->post('site_rate12'),
                'site_rate_name12' => $this->input->post('site_rate_name12'),
                'site_rate13' => $this->input->post('site_rate13'),
                'site_rate_name13' => $this->input->post('site_rate_name13'),
                'site_rate14' => $this->input->post('site_rate14'),
                'site_rate_name14' => $this->input->post('site_rate_name14'),
                'site_rate15' => $this->input->post('site_rate15'),
                'site_rate_name15' => $this->input->post('site_rate_name15'),
                'created' => date('Y-m-d'),
                'status' => '1'
            );
            $this->worksite_model->editWorksite($data, $id);
            $this->session->set_flashdata('smessage', 'Worksite Successfully updated');
            redirect('/worksite/index/');
        }
    }

    public function deleteworksite() {
        $id = $this->uri->segment(3);
        $this->loginCheck("worksite/deleteworksite/" . $id);
        $this->worksite_model->deleteworksite($id);
        $this->session->set_flashdata('smessage', 'Worksite Successfully deleted');
        redirect('/worksite/');
    }

    public function activateallworksite() {
        $id = $this->uri->segment(3);
        $this->worksite_model->activateworksite($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/worksite/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->worksite_model->activateworksite($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Worksites successfully activated');
        redirect('/worksite/');
    }

    public function deactivateallworksite() {
        $id = $this->uri->segment(3);
        $this->worksite_model->activateworksite($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/worksite/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->worksite_model->deactivateworksite($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Worksites successfully deactivated');
        redirect('/worksite/');
    }

    public function deleteallworksite() {
        $id = $this->uri->segment(3);
        $this->worksite_model->activateworksite($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/worksite/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->worksite_model->deleteworksite($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Worksites successfully deleted');
        redirect('/worksite/');
    }

    public function deactivateworksite() {
        $id = $this->uri->segment(3);
        $this->worksite_model->deactivateworksite($id);
        $this->session->set_flashdata('smessage', 'Worksite successfully deactivated');
        redirect('/worksite/');
    }

    public function activateworksite() {
        $id = $this->uri->segment(3);
        $this->worksite_model->activateworksite($id);
        $this->session->set_flashdata('smessage', 'Worksite successfully activated');
        redirect('/worksite/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
