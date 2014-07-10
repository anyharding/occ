<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->load->model('welcome_model', 'Welcome', true);
        $this->load->model('user_model', 'User', true);
        $this->load->model('household_model');
        $this->load->model('admin_model');
        $this->load->model('rent_model');
        $this->load->model('poweruser_model');
        $this->load->library('pagination');

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
        if ($this->session->userdata('userId')) {
            redirect('welcome/myProfile');
        } else {
            $data['title'] = "Home";
            $this->template->load('front', 'user/index', $data);
        }
    }

    function login() {
//echo $this->session->userdata('userId');die;
        if ($this->session->userdata('userId'))
            redirect('welcome/myProfile');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $pasword = $this->input->post('password');
            $checkAdminLoginDeatils = $this->Welcome->userLogin($username, $pasword);
            //echo $checkAdminLoginDeatils;die;
            if ($checkAdminLoginDeatils == "admin") {
                redirect('admin/admin/login');
            }
            if ($checkAdminLoginDeatils == 'false') {
                $this->session->set_userdata('message', 'Invaild password or user name please contact the Administrator');
            }
            if ($checkAdminLoginDeatils == 'true') {
                redirect('welcome/myProfile');
            }
            if ($checkAdminLoginDeatils == 'poweruser') {
                if ($this->session->userdata('returnURL') <> '') {
                    $redirect = $this->session->userdata('returnURL');
                    $this->session->unset_userdata('returnURL');
                    redirect($redirect);
                } else {
                    redirect('payment/visaExpiryCheck');
                }
            }
        }
        $data['title'] = "Login";
        //$this->template->load('front', 'user/login', $data);
        $this->template->load('front', 'user/index', $data);
    }

    public function termAndConditions() {
        $data['title'] = 'Terms and Conditions';
        $data['contents'] = $this->User->contentDetail(2);
        $this->template->load('front', 'user/termAndCondition', $data);
    }

    public function myProfile() {
        $this->loginCheck("welcome/myProfile/");
        $data['countries'] = $this->User->get_countries();
        $id = $this->session->userdata('userId');
        $user_detail = $this->Welcome->fullUserDetail($id);
        $data['title'] = "My Profile";
        $data['user_detail'] = $user_detail;
        // $data['provinces'] = $this->User->get_provinces(247);
        $this->template->load('front', 'user/myProfile', $data);
        if ($user_detail['role'] == 4) {
            redirect('applicant');
        }
        redirect('users');
    }

    function logout() {
        $this->session->unset_userdata('visaDays');
        $this->session->unset_userdata('userId');
        $this->session->set_userdata('smessage', 'You have logout successfully.');
        redirect('welcome/');
    }

    public function empRegistration() {
        $data['houses'] = $this->household_model->get_houses();
        $data['countries'] = $this->User->get_countries();
        $data['title'] = "Registration";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[emp_users.email]|is_unique[emp_powerusers.email]|is_unique[emp_recruitments.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|min_length[8]');
        $this->form_validation->set_message('is_unique', 'The e-mail address is already registered in Contractor Management');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        $this->form_validation->set_rules('country_id', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('deductions', 'Deductions', 'trim|numeric');
        $this->form_validation->set_rules('bondamount', 'Amount of bond payment ', 'trim|numeric');
        $this->form_validation->set_rules('weeklyrent', 'Weekly rent rate', 'trim|numeric');
        $this->form_validation->set_rules('capcha', 'Captcha', 'trim|required|matches1[image]');
        $this->form_validation->set_message('matches1', 'The captcha does not match the image text');
        $this->form_validation->set_rules('Yes', 'Terms and Conditions', 'required');
        //$this->form_validation->set_message('requiredd', 'Please accept terms and condition');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'user/empRegistration', $data);
        } else {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $gender = $this->input->post('gender');
            $height = $this->input->post('height');
            $weight = $this->input->post('weight');
            $taxtype = $this->input->post('taxtype');
            $dob = date('Y-m-d', strtotime($this->input->post('dob')));
            $position = $this->input->post('position');
            $reason = $this->input->post('reason');
            $country = $this->input->post('country_id');
            $passport_number = $this->input->post('passport_number');
            $visa_type = $this->input->post('visa_type');
            $firstvisastart = date('Y-m-d', strtotime($this->input->post('firstvisastart')));
            $firstvisaend = date('Y-m-d', strtotime($this->input->post('firstvisaend')));
            $secondvisastart = date('Y-m-d', strtotime($this->input->post('secondvisastart')));
            $secondvisaend = date('Y-m-d', strtotime($this->input->post('secondvisaend')));
            $contact = $this->input->post('contact');
            $statusofabn = $this->input->post('statusofabn');
            $abnnumber = $this->input->post('abnnumber');
            $nameofbank = $this->input->post('nameofbank');
            $branchofbank = $this->input->post('branchofbank');
            $numberofbank = $this->input->post('numberofbank');
            $placeofwork = $this->input->post('placeofwork');
            $employmentdate = $this->input->post('employmentdate');
            $hourlyrate = $this->input->post('hourlyrate');
            $deductions = $this->input->post('deductions');
            $placeofstay = $this->input->post('placeofstay');
            $weeklyrent = $this->input->post('weeklyrent');
            $statusofbond = $this->input->post('statusofbond');
            $bondamount = $this->input->post('bondamount');
            $statusofissued = $this->input->post('statusofissued');
            $equipment_name1 = $this->input->post('equipment_name1');
            $equipment_value1 = $this->input->post('equipment_value1');
            $paidforby1 = $this->input->post('paidforby1');
            $equipment_name2 = $this->input->post('equipment_name2');
            $equipment_value2 = $this->input->post('equipment_value2');
            $paidforby2 = $this->input->post('paidforby2');
            $equipment_name3 = $this->input->post('equipment_name3');
            $equipment_value3 = $this->input->post('equipment_value3');
            $paidforby3 = $this->input->post('paidforby3');
            $statusvaccination = $this->input->post('statusvaccination');
            $future_employment = $this->input->post('future_employment');
            $employee_employed = $this->input->post('employee_employed');
            $final_position = $this->input->post('final_position');
            $left_australia = $this->input->post('left_australia');
            $tax_num = $this->input->post('tax_num');
            $data = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'weeklyrent' => $weeklyrent,
                'password' => $password,
                'email' => $email,
                'gender' => $gender,
                'height' => $height,
                'weight' => $weight,
                'taxtype' => $taxtype,
                'tax_number' => $tax_num,
                'dob' => $dob,
                'reason_deductions' => $this->input->post('reason_deductions'),
                'shifttype' => $this->input->post('shifttype[]'),
                'reason' => $this->input->post('reason'),
                'position' => $position,
                'reason' => $reason,
                'country_id' => $country,
                'passport_number' => $passport_number,
                'regignation_approve_by' => $this->input->post('r_ap_by'),
                'visa_type' => $visa_type,
                'firstvisastart' => $firstvisastart,
                'firstvisaend' => $firstvisaend,
                'secondvisastart' => $secondvisastart,
                'secondvisaend' => $secondvisaend,
                'contact_no' => $contact,
                'statusofabn' => $statusofabn,
                'abnnumber' => $abnnumber,
                'nameofbank' => $nameofbank,
                'branchofbank' => $branchofbank,
                'numberofbank' => $numberofbank,
                'worksite_id' => $placeofwork,
                'employmentdate' => $employmentdate,
                'hourlyrate' => $hourlyrate,
                'hourlyrate_des' => $this->input->post('hourlyrate_des'),
                'deductions' => $deductions,
                'house_id' => $placeofstay,
                'statusofbond' => $statusofbond,
                'bondamount' => $bondamount,
                'statusofissued' => $statusofissued,
                'equipment_name1' => $equipment_name1,
                'equipment_value1' => $equipment_value1,
                'paidforby1' => $paidforby1,
                'equipment_name2' => $equipment_name2,
                'equipment_value2' => $equipment_value2,
                'paidforby2' => $paidforby2,
                'equipment_name3' => $equipment_name3,
                'equipment_value3' => $equipment_value3,
                'paidforby3' => $paidforby3,
                'statusvaccination' => $statusvaccination,
                'future_employment' => $future_employment,
                'employee_employed' => $employee_employed,
                'final_position' => $final_position,
                'left_australia' => $left_australia,
                'created' => date('Y-m-d'),
                'status' => '1',
                'role' => 3
            );
            $this->User->userRegistration($data);
            $config['protocol'] = 'mail';
            $config['wordwrap'] = FALSE;
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['crlf'] = "\r\n";
            $config['newline'] = "\r\n";
            $this->load->library('email', $config);
            $this->email->set_mailtype("html");
            $mail_data['userDetail'] = $data;
            $mail_data['text'] = "Your account has been created successfully on " . SITE_TITLE;
            $mail_data['email'] = $email;
            $mail_data['username'] = $email;
            $mail_data['password'] = $password;
            $mail_data['firstname'] = $firstname;
            $this->load->library('parser');
            $msg = $this->parser->parse('email/template', $mail_data, TRUE);
            $this->email->from(FORM_EMAIL, SITE_TITLE);
            $this->email->to($email);
            $this->email->subject('Login Details');
            $this->email->message($msg);
            $this->email->send();
            $this->session->set_flashdata('smessage', 'Contractor Successfully added');
            redirect('welcome');
        }
    }

    public function editProfile() {
        $this->loginCheck("welcome/editProfile/");
        $id = $this->session->userdata('userId');
        $user_detail = $this->poweruser_model->poweruserDetail($id);
        $data['user_detail'] = $user_detail;
        $redirect = '/welcome/myProfile';

        $data['countries'] = $this->User->get_countries();
        $data['title'] = "Edit Profile";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', "required|is_unique_again1[emp_users.username.$id]");
        $this->form_validation->set_message('is_unique_again1', 'The username is already registered in Contractor Management');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'user/editProfile', $data);
        } else {

            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $gender = $this->input->post('gender');
            $dob = date('Y-m-d', strtotime($this->input->post('dob')));
            $country = $this->input->post('country_id');
            $contact = $this->input->post('contact');
            $position = $this->input->post('position');

            $nameofbank = $this->input->post('nameofbank');
            $visa_type = $this->input->post('visa_type');
            $numberofbank = $this->input->post('numberofbank');
            $branchofbank = $this->input->post('branchofbank');
            $hourlyrate = $this->input->post('hourlyrate');
            $deductions = $this->input->post('deductions');
            $weeklyrent = $this->input->post('weeklyrent');
            $data = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'contact_no' => $contact,
                'username' => $this->input->post('username'),
            );
            $this->poweruser_model->editPoweruser($data, $id);
            /* $this->email->set_mailtype("html");
              $mail_data['poweruserDetail'] = $data;
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
              $this->email->send(); */
            $this->session->set_flashdata('smessage', 'Profile Successully Updated');
            redirect($redirect);
        }
    }

    public function puRegistration() {
        $redirect = '/welcome/';

        $data['countries'] = $this->User->get_countries();
        $data['title'] = "Power User Registration";

        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|min_length[8]');
        $this->form_validation->set_message('is_unique', 'The e-mail address is already registered in Contractor Management');
        $this->form_validation->set_message('is_unique1', 'The Username is already registered in Contractor Management');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[emp_users.email]|is_unique[emp_powerusers.email]|is_unique[emp_recruitments.email]');
        $this->form_validation->set_rules('country_id', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('capcha', 'Captcha', 'trim|required|matches1[image]');
        $this->form_validation->set_message('matches1', 'The captcha does not match the image text');
        $this->form_validation->set_rules('Yes', 'Terms and Conditions', 'trim|required');
        //$this->form_validation->set_message('required1', 'Please accept terms and condition');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'user/puRegistration', $data);
        } else {

            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $gender = $this->input->post('gender');
            $dob = date('Y-m-d', strtotime($this->input->post('dob')));
            $country = $this->input->post('country_id');
            $contact = $this->input->post('contact');
            $left_australia = $this->input->post('left_australia');

            $data = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'password' => $password,
                'email' => $email,
                'gender' => $gender,
                'dob' => $dob,
                'country_id' => $country,
                'contact_no' => $contact,
                'left_australia' => $left_australia,
                'created' => date('Y-m-d'),
                'status' => '0',
                'role' => 2
            );
            $last_id = $this->User->userRegistration($data);
            $this->email->set_mailtype("html");
            $mail_data['poweruserDetail'] = $data;
            $mail_data['text'] = "Your account has been created successfully on " . SITE_TITLE . ' Please wait untill approval from admin';
            $mail_data['email'] = $email;
            $mail_data['username'] = $email;
            $mail_data['password'] = $password;
            $mail_data['firstname'] = $firstname;
            $this->load->library('parser');
            $msg = $this->parser->parse('email/template_p', $mail_data, TRUE);
            $this->email->from(FORM_EMAIL, SITE_TITLE);
            $this->email->to($email);
            $this->email->subject('Login Details');
            $this->email->message($msg);
            $this->email->send();



            $response = $this->admin_model->getEmail();
            $mail_data['poweruserDetail'] = $data;
            $link = HTTP_PATH . 'welcome/activateProfile/' . $last_id . '/andgtywgh-gh67';
            $mail_data['text'] = "Account is created on " . SITE_TITLE . '  by ' . $firstname . ' as Power User <br> <br> Click here to varify user profile <br>' . $link;
            $mail_data['email'] = $email;
            $mail_data['username'] = 'Admin';
            $mail_data['password'] = $password;
            $mail_data['firstname'] = 'Admin';
            $this->load->library('parser');
            $msg = $this->parser->parse('email/template_p', $mail_data, TRUE);
            $this->email->from(FORM_EMAIL, SITE_TITLE);
            $this->email->to($response[0]['email']);
            $this->email->subject('Account varification');
            $this->email->message($msg);
            $this->email->send();

            $this->session->set_flashdata('smessage', 'Your Profile successfully created');
            redirect($redirect);
        }
    }

    public function hrRegistration() {
        $redirect = '/welcome/';
        $data['countries'] = $this->User->get_countries();
        $data['title'] = "HR Registration";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[emp_users.email]|is_unique[emp_powerusers.email]|is_unique[emp_recruitments.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|min_length[8]');
        $this->form_validation->set_message('is_unique', 'The e-mail address is already registered in Contractor Management');
        $this->form_validation->set_message('is_unique1', 'The Username is already registered in Contractor Management');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        $this->form_validation->set_rules('country_id', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('capcha', 'Captcha', 'trim|required|matches1[image]');
        $this->form_validation->set_message('matches1', 'The captcha does not match the image text');
        $this->form_validation->set_rules('Yes', 'Terms and Conditions', 'trim|required');
        $this->form_validation->set_message('required1', 'Please accept terms and condition');
        if ($this->form_validation->run() == FALSE) {

            $this->template->load('front', 'user/hrRegistration', $data);
        } else {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $gender = $this->input->post('gender');
            $dob = date('Y-m-d', strtotime($this->input->post('dob')));
            $country = $this->input->post('country_id');
            $contact = $this->input->post('contact');
            $left_australia = $this->input->post('left_australia');

            $data = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'password' => $password,
                'email' => $email,
                'gender' => $gender,
                'dob' => $dob,
                'country_id' => $country,
                'contact_no' => $contact,
                'left_australia' => $left_australia,
                'created' => date('Y-m-d'),
                'status' => '0',
                'role' => 4
            );
            $last_id = $this->User->userRegistration($data);
            $this->email->set_mailtype("html");
            $mail_data['recruitmentDetail'] = $data;
            $mail_data['text'] = "Your account has been created successfully on " . SITE_TITLE . ' Please wait untill approval from admin';
            $mail_data['email'] = $email;
            $mail_data['username'] = $email;
            $mail_data['password'] = $password;
            $mail_data['firstname'] = $firstname;
            $this->load->library('parser');
            $msg = $this->parser->parse('email/template_p', $mail_data, TRUE);
            $this->email->from(FORM_EMAIL, SITE_TITLE);
            $this->email->to($email);
            $this->email->subject('Login Details');
            $this->email->message($msg);
            $this->email->send();


            $response = $this->admin_model->getEmail();
            $mail_data['poweruserDetail'] = $data;
            $link = HTTP_PATH . 'welcome/activateProfile/' . $last_id . '/andgtywgh-gh67';
            $mail_data['text'] = "Account is created on " . SITE_TITLE . '  by ' . $firstname . ' as HR <br> <br> Click here to varify user profile <br>' . $link;
            $mail_data['email'] = $email;
            $mail_data['username'] = 'Admin';
            $mail_data['password'] = $password;
            $mail_data['firstname'] = 'Admin';
            $this->load->library('parser');
            $msg = $this->parser->parse('email/template_p', $mail_data, TRUE);
            $this->email->from(FORM_EMAIL, SITE_TITLE);
            $this->email->to($response[0]['email']);
            $this->email->subject('Account varification');
            $this->email->message($msg);
            $this->email->send();
            $this->session->set_flashdata('smessage', 'Your Profile successfully created');
            redirect($redirect);
        }
    }

    public function activateProfile() {
        $id = $this->uri->segment(3);
        $data = array(
            'status' => '1'
        );
        $this->User->editUser($data, $id);
        $user_detail = $this->Welcome->fullUserDetail($id);
        $this->email->set_mailtype("html");
        $mail_data['text'] = "Your account has been created successfully Varify by admin on " . SITE_TITLE;
        $mail_data['email'] = $user_detail['email'];
        $mail_data['password'] = $user_detail['password'];
        $mail_data['firstname'] = $user_detail['firstname'];
        $this->load->library('parser');
        $msg = $this->parser->parse('email/template', $mail_data, TRUE);
        $this->email->from(FORM_EMAIL, SITE_TITLE);
        $this->email->to($user_detail['email']);
        $this->email->subject('Login Details');
        $this->email->message($msg);
        $this->email->send();
        $this->session->set_flashdata('smessage', 'User successfully activated.');
        redirect('welcome/');
    }

    public function registration() {
        $this->session->unset_userdata('search');
        if (($this->session->userdata('userId')))
            redirect('welcome/myProfile');
        $data['title'] = 'Registration';
        $this->template->load('front', 'user/registration', $data);
    }

    function changePassword() {
//        if (!$this->session->userdata('userId'))
//            redirect('welcome/');
        $this->loginCheck('welcome/changePassword');
        $this->form_validation->set_rules('opassword', 'Old Password', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[cpassword]|min_length[8]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|min_length[8]');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Change Password";
            $this->template->load('front', 'user/changePassword', $data);
        } else {
            $response = $this->Welcome->checkPassword($this->input->post('opassword'));
            if (empty($response)) {
                $this->session->set_flashdata('message', 'Please enter correct password');
                redirect('welcome/changePassword/');
            } else {
                $data = array('password' => $this->input->post('password'));
                $this->Welcome->changePassword($data);
                $this->session->set_flashdata('smessage', 'Password successfully changed');
                redirect('welcome/changePassword/');
            }
        }
    }

    public function forgotPassword() {
        if (($this->session->userdata('userId')))
            redirect('welcome/myProfile');
        $this->session->unset_userdata('search');
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

            $userDetail = $this->Welcome->userDetail();
            $data['adminDetail'] = $userDetail;
            if (count($userDetail) == 0) {
                $this->session->set_userdata('message', 'Email address is wrong');
            } else {
                $code = rand(78687, 1098789);
                $user_id = $userDetail['id'];
                $code_data = array('code' => md5($code), 'user_id' => $user_id);
                $this->Welcome->resetCode($code_data);
                $this->load->library('parser');
                /*
                  $mail_data['welcome_to'] = lang('welcome_to');
                  $mail_data['click_hear_to'] = lang('click_here');
                  $mail_data['if_you_still'] = lang('if_you_still');
                  $mail_data['thanks'] = lang('thanks');
                  $mail_data['dear'] = lang('dear');
                  $mail_data['the'] = lang('the');
                  $mail_data['team'] = lang('team');
                  $mail_data['touch_you_soon'] = lang('touch_you_soon');

                 * 
                 */
                $mail_data['link'] = HTTP_PATH . 'welcome/resetPassword/' . $user_id . '/' . md5($code);
                $mail_data['firstname'] = $userDetail['firstname'];
                $this->email->set_mailtype("html");
                $msg = $this->parser->parse('email/templateResetPassword', $mail_data, TRUE);
                $this->email->from(FORM_EMAIL, SITE_TITLE);
                $this->email->to($userDetail['email']);
                $this->email->subject('Forgot Password');
                $this->email->message($msg);
                $this->email->send();
                $this->session->set_userdata('smessage', 'Your password has been sent on your email id.');
                redirect('welcome/forgotPassword/');
            }
        }
        $data['title'] = 'Forgot Password';
        $this->template->load('front', 'user/forgotPassword', $data);
    }

    function resetPassword() {
        $this->session->unset_userdata('search');
        $user_id = $this->uri->segment(3);
        $code = $this->uri->segment(4);
        $response = $this->Welcome->matchCode($user_id, $code);
        if ($response) {
            $this->form_validation->set_rules('password', 'New Password', 'trim|required|matches[cpassword]|min_length[8]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|min_length[8]');
            if ($this->form_validation->run() == FALSE) {
                $data['title'] = 'Reset Password';
                $this->template->load('front', 'user/resetPassword', $data);
            } else {
                $data = array('password' => $this->input->post('password'));
                $this->Welcome->changeResetPassword($data, $user_id);
                $this->Welcome->deleteResetCode($user_id);
                $this->session->set_flashdata('smessage', 'Your Password Successfully changed');
                redirect('welcome/');
            }
        } else {
            $this->session->set_flashdata('message', 'You have already used this link');
            redirect('welcome/forgotPassword/');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */