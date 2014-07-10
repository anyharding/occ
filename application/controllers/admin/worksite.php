<?php

class Worksite extends CI_Controller {

    private $limit = 10;
    private $uri_segment = 4;

    function __construct() {
        parent::__construct();
        $this->load->model('worksite_model');
        $this->load->library('pagination');
    }

    public function index() {
        $config['base_url'] = base_url() . "admin/worksite/index";
        $config['total_rows'] = $this->worksite_model->countworksites();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        if (isset($_POST['search'])) {
            if ($_POST['search'] == '')
                $search = 'all';
            else
                $search = $this->input->post('search');
            $config['total_rows'] = $this->worksite_model->countsearchworksites($search);
            $config['base_url'] = base_url() . "admin/worksite/index/search/" . $search;
            $worksites = $this->worksite_model->searchworksites($search, $config['per_page'], $this->uri->segment(6));
        }
        else {
            if ($this->uri->segment(4) == 'search') {
                $search = $this->uri->segment(5);
                $config['total_rows'] = $this->worksite_model->countsearchworksites($search);
                $config['base_url'] = base_url() . "admin/worksite/index/search/" . $search;
                $config['uri_segment'] = 6;
                $worksites = $this->worksite_model->searchworksites($search, $config['per_page'], $this->uri->segment(6));
            }
            else
                $worksites = $this->worksite_model->worksiteList($config['per_page'], $this->uri->segment(4), "normal_house");
        }
        $data['title'] = "Worksites List";
        $this->pagination->initialize($config);
        $data['worksites'] = $worksites;
        $this->template->load('admin', 'admin/worksite/index', $data);
    }

    public function addworksite() {
        $redirect = '/admin/worksite/';
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
            $this->template->load('admin', 'admin/worksite/addWorksite', $data);
        } else {
            if ($_POST) {
                $company = $this->input->post('company');
                $site_rate = $this->input->post('site_rate');
                $site_rate_name = $this->input->post('site_rate_name');

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
    }

    public function editworksite() {
        $id = $this->uri->segment(4);
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
            $this->template->load('admin', 'admin/worksite/editWorksite', $data);
        } else {
            if ($_POST) {
                $company = $this->input->post('company');
                $site_rate = $this->input->post('site_rate');
                $site_rate_name = $this->input->post('site_rate_name');

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
                redirect('/admin/worksite/index/');
            }
        }
    }

    public function deleteworksite() {
        $id = $this->uri->segment(4);
        $this->worksite_model->deleteworksite($id);
        $this->session->set_flashdata('smessage', 'Worksite Successfully deleted');
        redirect('/admin/worksite/');
    }

    public function activateallworksite() {
        $id = $this->uri->segment(4);
        $this->worksite_model->activateworksite($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/admin/worksite/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->worksite_model->activateworksite($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Worksites successfully activated');
        redirect('/admin/worksite/');
    }

    public function deactivateallworksite() {
        $id = $this->uri->segment(4);
        $this->worksite_model->activateworksite($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/admin/worksite/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->worksite_model->deactivateworksite($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Worksites successfully deactivated');
        redirect('/admin/worksite/');
    }

    public function deleteallworksite() {
        $id = $this->uri->segment(4);
        $this->worksite_model->activateworksite($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/admin/worksite/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->worksite_model->deleteworksite($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Worksites successfully deleted');
        redirect('/admin/worksite/');
    }

    public function deactivateworksite() {
        $id = $this->uri->segment(4);
        $this->worksite_model->deactivateworksite($id);
        $this->session->set_flashdata('smessage', 'Worksite successfully deactivated');
        redirect('/admin/worksite/');
    }

    public function activateworksite() {
        $id = $this->uri->segment(4);
        $this->worksite_model->activateworksite($id);
        $this->session->set_flashdata('smessage', 'Worksite successfully activated');
        redirect('/admin/worksite/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
