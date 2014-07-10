<?php

class Applicant extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
//        if (!$this->session->userdata('userId')) {
//            redirect('welcome/myProfile');
//        }
        $this->load->model('applicant_model');
        $this->load->model('user_model', 'User', true);
        $this->load->model('rent_model');
        $this->load->model('house_model');
        $this->load->model('welcome_model', 'Welcome');
        $this->load->library('session');
        $this->load->library('pagination');

        if ($this->session->userdata('role')) {
            if ($this->session->userdata('role') <> 'hr') {
                $this->session->set_flashdata('message', "You don't have permission to access this page ");
                redirect('/payment/visaExpiryCheck/14days');
            }
        } else {
            redirect("/");
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

        $this->loginCheck("applicant/index");
        $config['base_url'] = base_url() . "applicant/index";
        $config['total_rows'] = $this->applicant_model->countApplicant();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $applicant = $this->applicant_model->powerusersList($config['per_page'], $this->uri->segment(3), "normal_poweruser");
        $data['title'] = "Applicants List";
        $this->pagination->initialize($config);
        $data['applicant'] = $applicant;
        $this->template->load('front', 'applicant/index', $data);
    }

    public function viewApplicant() {
        $id = $this->uri->segment(3);
        $this->loginCheck("applicant/viewApplicant/" . $id);
        $data['users'] = $this->house_model->get_tenants();
        $house_detail = $this->house_model->houseDetail($id);
        $data['house_detail'] = $house_detail;
        $data['title'] = "Edit House";
        if (!$this->session->userdata('userId')) {
            redirect('welcome/');
        }
        $user_detail = $this->Welcome->fullUserDetail($id);
        $users_list = $this->User->usersHousesListOnView($id);
        $houshold_list = $this->house_model->housesholdsList($id);
        $data['title'] = "House Detail";
        $data['house_detail'] = $house_detail;
        $data['household'] = $houshold_list;
        $data['users'] = $users_list;
        $this->template->load('front', 'houses/viewHouse', $data);
    }

    public function addApplicant() {
        $this->loginCheck("applicant/addApplicant/");
        $data['users'] = $this->house_model->get_tenants();
        $data['title'] = "Add Applicant";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[emp_users.email]|is_unique[emp_applicant.email]');
        $this->form_validation->set_message('is_unique', ' Email address already added');
        $this->form_validation->set_rules('status', 'Application Status', 'required');
        $this->form_validation->set_rules('height', 'Height', 'trim|numeric');
        $this->form_validation->set_rules('weight', 'Weight', 'trim|numeric');
        if ($this->form_validation->run() == FALSE) {
            $data['users'] = $this->applicant_model->get_tenants();
            $this->template->load('front', 'applicant/addApplicant', $data);
        } else {
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'referrer' => $this->input->post('referrer'),
                'gender' => $this->input->post('gender'),
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),
                'passport_no' => $this->input->post('passport_no'),
                'date1' => $this->input->post('date1'),
                'date2' => $this->input->post('date2'),
                'english' => $this->input->post('english'),
                'visa_number' => $this->input->post('visa_number'),
                'expiry' => $this->input->post('expiry'),
                'exp' => $this->input->post('exp'),
                'vahicle' => $this->input->post('vehicle'),
                'comment' => $this->input->post('comment'),
                'status' => $this->input->post('status')
            );
            $this->applicant_model->addApplicant($data);
            /*
             * $this->email->set_mailtype("html");
              $mail_data['houseDetail'] = $data;
              $mail_data['text'] = "Your account has been created successfully on ".SITE_TITLE;
              $mail_data['email'] = $email;
              $mail_data['username'] = $username;
              $mail_data['password'] = $password;
              $mail_data['firstname'] = $firstname;
              $this->load->library('parser');
              $msg =  $this->parser->parse('email/template', $mail_data, TRUE);
              $this->email->from(FORM_EMAIL, SITE_TITLE);
              $this->email->to($email);
              $this->email->subject('Login Details');
              $this->email->message( $msg );
              $this->email->send();
             * 
             */

            $this->session->set_flashdata('smessage', 'Applicant Successfully added');
            redirect('applicant');
        }
    }

    public function editApplicant() {
        $id = $this->uri->segment(3);
        $this->loginCheck("applicant/editApplicant/" . $id);
        $applicant = $this->applicant_model->applicantDetail($id);
        $data['applicant'] = $applicant;
        $data['title'] = "Edit Applicant";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', "valid_email|required|is_unique_again[emp_users.email.$id]|is_unique_again[emp_applicant.email.$id]");
        $this->form_validation->set_message('is_unique_again', ' Email address already added');
        $this->form_validation->set_rules('status', 'Application Status', 'required');
        $this->form_validation->set_rules('height', 'Height', 'trim|numeric');
        $this->form_validation->set_rules('weight', 'Weight', 'trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['users'] = $this->applicant_model->get_tenants();
            $this->template->load('front', 'applicant/editApplicant', $data);
        } else {
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'mobile' => $this->input->post('mobile'),
                'referrer' => $this->input->post('referrer'),
                'gender' => $this->input->post('gender'),
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),
                'passport_no' => $this->input->post('passport_no'),
                'date1' => $this->input->post('date1'),
                'date2' => $this->input->post('date2'),
                'english' => $this->input->post('english'),
                'visa_number' => $this->input->post('visa_number'),
                'expiry' => $this->input->post('expiry'),
                'exp' => $this->input->post('exp'),
                'vahicle' => $this->input->post('vehicle'),
                'comment' => $this->input->post('comment'),
                'status' => $this->input->post('status')
            );
//            print_r($data);die;
            $this->applicant_model->editApplicant($data, $id);
            $this->session->set_flashdata('smessage', 'Applicant Successfully updated');
            redirect('applicant/index/');
        }
    }

    public function deleteApplicant() {
        $id = $this->uri->segment(3);
        $this->loginCheck("applicant/deleteApplicant/" . $id);
        $this->applicant_model->deleteApplicant($id);
        $this->session->set_flashdata('smessage', 'Applicant Successfully deleted');
        redirect('applicant/');
    }

}

