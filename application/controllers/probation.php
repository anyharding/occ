<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Probation extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('welcome/myProfile');
        }
        $this->load->model('welcome_model', 'Welcome', true);
        $this->load->model('user_model', 'User', true);
        $this->load->model('household_model');
        $this->load->model('house_model');
        $this->load->model('admin_model');
        $this->load->model('rent_model');
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

    public function index() {
        $worksite_id = $this->uri->segment(3);
        $this->loginCheck("probation/index/" . $worksite_id);
        $config['base_url'] = base_url() . "probation/index/" . $worksite_id;
        $config['num_links'] = 10;
        $config['total_rows'] = $this->User->countWorksiteUsersProbation($worksite_id);
        $config['per_page'] = 1000000;
        $config['uri_segment'] = 4;
        $users_list = $this->User->usersWorksiteProbationList($worksite_id);
        $data['title'] = "Contractors in worksite";
        $this->pagination->initialize($config);
        $data['users'] = $users_list;
        $data['worksites'] = $this->User->get_worksites();
        $this->template->load('front', 'probation/index', $data);
    }

    public function getList() {
        $worksite_id = $this->uri->segment(3);
        $users_list = $this->User->usersWorksiteProbationList($worksite_id);
        $data['users'] = $users_list;
        $data['worksites'] = $this->User->get_worksites();
        $this->load->view('probation/getList', $data);
    }

    public function updateDetail() {
        $this->loginCheck("probation/index/");
        $emp_id = $this->input->post('employee_id');
        $site_rate = $this->input->post('site_rate');
        $hourlyrate_des = $this->input->post('hourlyrate_des');
        $hourlyrate = $this->input->post('hourlyrate');
        $probation = $this->input->post('probation');
        for ($i = 0; $i < count($emp_id); $i++) {
            $data = array(
                'site_rate' => $site_rate[$i],
                'hourlyrate' => $hourlyrate[$i],
                'probation' => $this->input->post('probation' . ($i + 1))
            );
            $this->User->editUser($data, $emp_id[$i]);
        }
        $this->session->set_flashdata('smessage', 'probation profiles successfully updated');
        redirect('/probation/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */