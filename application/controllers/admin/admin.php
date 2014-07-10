<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    function adminLoginChack() {
        if (!$this->session->userdata('adminId')) {
            redirect('admin/admin/login');
        }
    }

    function dashboard() {
        $data['title'] = "Admin Dashboard";
        $this->template->load('admindashboard', 'admin/admin/dashboard', $data);
    }

    function login() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $checkAdminLoginDeatils = $this->admin_model->adminLogin();
            if ($checkAdminLoginDeatils == false) {
                $this->session->set_userdata('message', 'Invalid username or password');
            } else {
//                echo $this->session->userdata('adminId');die;
                redirect('admin/admin/dashboard');
            }
        }
        $data['title'] = "Admin Login";
        $this->template->load('adminlogin', 'admin/admin/login', $data);
    }

    public function forgotPassword() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $config['protocol'] = 'mail';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");

        if ($this->form_validation->run() == TRUE) {
            $adminDetail = $this->admin_model->adminDetail();
            $data['adminDetail'] = $adminDetail;
            if (count($adminDetail) == 0) {
                $this->session->set_userdata('message', 'Your Email not match please re-enter.');
            } else {
                $this->load->library('parser');

                $mail_data['text'] = "Your login details";
                $mail_data['email'] = $adminDetail['email'];
                $mail_data['password'] = $adminDetail['password'];
                $mail_data['username'] = $adminDetail['username'];
                $mail_data['firstname'] = "Admin";

                $msg = $this->parser->parse('email/template', $mail_data, TRUE);

                $this->email->from(FORM_EMAIL, SITE_TITLE);
                $this->email->to($adminDetail['email']);
                $this->email->subject('Forgot Password');
                $this->email->message($msg);
                $this->email->send();
                $this->email->print_debugger();
                $this->session->set_userdata('smessage', 'Your password has been sent on your email id.');
            }
        }
        $data['title'] = "Forgot Password";
        $this->template->load('adminlogin', 'admin/admin/forgotpassword', $data);
    }

    function logout() {
        $this->session->unset_userdata('adminId');
        $this->session->set_userdata('message', 'You have logout successfully.');
        redirect('admin/admin/login');
    }

    function changePassword() {
        $this->form_validation->set_rules('opassword', 'Old Password', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|matches[cpassword]');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Change Password";
            $this->template->load('admin', 'admin/admin/changePassword', $data);
        } else {
            $response = $this->admin_model->checkPassword($this->input->post('opassword'));
            if (empty($response)) {
                $this->session->set_flashdata('message', 'Please enter correct password');
                redirect('/admin/admin/changePassword/');
            } else {
                $data = array('password' => $this->input->post('password'));
                $this->admin_model->changePassword($data);
                $this->session->set_flashdata('smessage', 'Password successfully changed');
                redirect('/admin/admin/changePassword/');
            }
        }
    }

    function changeEmail() {
        $this->form_validation->set_rules('email', 'New Email', 'trim|required|matches[cemail]|valid_email');
        $this->form_validation->set_rules('cemail', 'Confirm email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $response = $this->admin_model->checkEmail();
            $data['old_email'] = $response[0]['email'];
            $data['title'] = "Change Email";
            $this->template->load('admin', 'admin/admin/changeEmail', $data);
        } else {
            $data = array('email' => $this->input->post('email'));
            $this->admin_model->changeEmail($data);
            $this->session->set_flashdata('smessage', 'New Email successfully changed');
            redirect('/admin/admin/changeEmail/');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */