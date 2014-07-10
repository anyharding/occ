<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
//        if (!$this->session->userdata('userId')) {
//            redirect('welcome/myProfile');
//        }
        $this->load->model('welcome_model', 'Welcome', true);
        $this->load->model('user_model', 'User', true);
        $this->load->model('household_model');
        $this->load->model('house_model');
        $this->load->model('admin_model');
        $this->load->model('applicant_model');
        $this->load->model('payment_model');
        $this->load->model('rent_model');
        $this->load->library('pagination');
        $this->load->library('Jquery_pagination');
        date_default_timezone_set('Asia/Calcutta');
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
    }

    function loginCheck($str) {
        if (!$this->session->userdata('userId')) {
            $this->session->set_userdata('returnURL', $str);
            redirect('welcome/login');
        }
    }

    function ajax_users($status = 0, $worksite_id = 0, $time, $offset = 0) {
        $this->load->library('Jquery_pagination');
        if ($status == 'worksite')
            $config['base_url'] = site_url('users/ajax_users/worksite/' . $worksite_id . "/" . $time . "/");
        else
            $config['base_url'] = site_url('users/ajax_users/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        if ($status == 'worksite')
            $config['uri_segment'] = 6;
        else
            $config['uri_segment'] = 3;
        $config['total_rows'] = $this->User->countUsers('normal_user', $worksite_id, 'all');
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['worksites'] = $this->User->get_worksites();
        $data['users'] = $this->User->usersList($config['per_page'], $offset, "normal_user", $worksite_id, 'all');
        $this->load->view('user/userListAjax', $data);
    }

    public function index($status = 0, $worksite_id = 0, $time = 0, $offset = 0) {
        $this->loginCheck("users/index/" . $status . "/" . $worksite_id . "/" . $time . "/" . $offset);
        ob_start();
        $this->ajax_users($status, $worksite_id, $time, $offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Contractors List";
        $user_detail = $this->Welcome->fullUserDetail($this->session->userdata('userId'));
        $data['role'] = $user_detail['role'];
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'user/usersList', $data);
    }

    public function changeAddressCheck($offset = 0) {
        $this->loginCheck("users/changeAddressCheck/" . $offset);
        ob_start();
        $this->ajax_changeAddressCheck(0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Change address check";
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'payment/changeAddressCheck', $data);
    }

    function ajax_changeAddressCheck($offset = 0) {
        $config['base_url'] = site_url('users/ajax_changeAddressCheck/');
        $config['div'] = '#middle-content';
        $config['loadingId'] = 'loading-image';
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        if ($this->session->userdata('day') == 'last_three') {
            $config['total_rows'] = $this->payment_model->countUsersChangeAddress('last_three');
            $data['users'] = $this->payment_model->getUsersChangeAddress('last_three', $config['per_page'], $offset);
        }
        if ($this->session->userdata('day') == 'thee_more') {
            $config['total_rows'] = $this->payment_model->countUsersChangeAddress('thee_more');
            $data['users'] = $this->payment_model->getUsersChangeAddress('thee_more', $config['per_page'], $offset);
        }
        if ($this->session->userdata('day') == "" OR $this->session->userdata('day') == NULL) {
            $config['total_rows'] = $this->payment_model->countUsersChangeAddress('0');
            $data['users'] = $this->payment_model->getUsersChangeAddress('0', $config['per_page'], $offset);
        }
//        echo $config['total_rows'];
//        echo count($data['users']);
        $data['title'] = "Change address check";
        $this->jquery_pagination->initialize($config);
        $this->load->view('payment/ajax_changeAddressCheck', $data);
    }

    public function last_three() {
        $this->session->set_userdata('day', 'last_three');
        $this->ajax_changeAddressCheck(0);
    }

    public function thee_more() {
        $this->session->set_userdata('day', 'thee_more');
        $this->ajax_changeAddressCheck(0);
    }

    public function employeeInHouse($house_id, $offset = 0) {
        $this->loginCheck("users/employeeInHouse/" . $house_id . "/" . $offset);
        ob_start();
        $this->ajax_employeeInHouse($house_id, 0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Contractors List";
        $data['ajax_content'] = '<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'user/usersList', $data);
    }

    function ajax_employeeInHouse($house_id, $offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('users/ajax_employeeInHouse/' . $house_id . '/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['total_rows'] = $this->User->countHouseUsers($house_id);
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['title'] = "Contractors List";
        $data['users'] = $this->User->usersHousesList($config['per_page'], $offset, $house_id);
        $this->load->view('user/userListAjax', $data);
    }

    function ajax_employeeInWorksite($worksite_id, $offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('users/ajax_employeeInWorksite/' . $worksite_id . '/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['total_rows'] = $this->User->countWorksiteUsers($worksite_id);
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['users'] = $this->User->usersWorksiteList($config['per_page'], $this->uri->segment(4), $worksite_id);
        $this->load->view('user/userListAjax', $data);
    }

    public function employeeInWorksite($worksite_id, $offset = 0) {
        $this->loginCheck("users/employeeInWorksite/" . $worksite_id . "/" . $offset);
        ob_start();
        $this->ajax_employeeInWorksite($worksite_id, 0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['ajax_content'] = '<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'user/usersList', $data);
    }

    public function employeeInWorksite1() {
        $worksite_id = $this->uri->segment(3);
        $config['base_url'] = base_url() . "users/employeeInWorksite/" . $worksite_id;
        $config['total_rows'] = $this->User->countWorksiteUsers($worksite_id);
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 4;
        $users_list = $this->User->usersWorksiteList($config['per_page'], $this->uri->segment(4), $worksite_id);
        $data['title'] = "Contractors in worksite";
        $this->pagination->initialize($config);
        $data['users'] = $users_list;
        $this->template->load('front', 'user/usersList', $data);
    }

    public function employeeInHouse1() {
        $house_id = $this->uri->segment(3);
        $config['base_url'] = base_url() . "users/employeeInHouse/" . $house_id;
        $config['total_rows'] = $this->User->countHouseUsers($house_id);
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 4;
        $users_list = $this->User->usersHousesList($config['per_page'], $this->uri->segment(4), $house_id);
        $data['title'] = "Houses";
        $this->pagination->initialize($config);
        $data['users'] = $users_list;
        $this->template->load('front', 'user/usersList', $data);
    }

    function ajax_empResigList($segment3 = "all", $segment4 = "all", $offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('users/ajax_empResigList/' . $segment3 . "/" . $segment4 . "/");
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['uri_segment'] = 5;
        $config['total_rows'] = $this->User->countResignUsers('normal_user', $segment3, $segment4);
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['users'] = $this->User->usersResignList($config['per_page'], $offset, "normal_user", $segment3, $segment4);
        $this->load->view('user/ajax_empResigList', $data);
    }

    public function empResigList($segment3 = "all", $segment4 = "all", $offset = 0) {
        $this->loginCheck("users/empResigList/" . $segment3 . "/" . $segment4);
        ob_start();
        $this->ajax_empResigList($segment3, $segment4, $offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Contractors Resignation List";
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'user/empResigList', $data);
    }

    function ajax_listHR($offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('users/ajax_listHR/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->User->countHR('normal_user');
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['users'] = $this->User->hrList($config['per_page'], $offset, "normal_user");
        $this->load->view('user/ajax_listHR', $data);
    }

    public function listHR($offset = 0) {
        $this->loginCheck("users/listHR/");
        ob_start();
        $this->ajax_listHR($offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "HR List";
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'user/hrList', $data);
    }

    public function viewUser() {
        $this->loginCheck("users/viewUser/" . $this->uri->segment(3));
        $data['houses'] = $this->household_model->get_houses();
        $data['countries'] = $this->User->get_countries();
        $data['worksites'] = $this->rent_model->get_worksites();
        if (!$this->session->userdata('userId')) {
            redirect('welcome/');
        }
        $data['countries'] = $this->User->get_countries();
        $id = $this->uri->segment(3);
        $user_detail = $this->Welcome->fullUserDetail($id);
        if (empty($user_detail)) {
            $this->session->set_flashdata('message', "Sorry, contractor not available");
            redirect('users/');
        }
        $data['title'] = "My Profile";
        $data['user_detail'] = $user_detail;
        $this->template->load('front', 'user/viewUser', $data);
    }

    public function viewHR() {
        $this->loginCheck("users/viewHR/" . $this->uri->segment(3));
        $data['houses'] = $this->household_model->get_houses();
        $data['countries'] = $this->User->get_countries();
        $data['worksites'] = $this->rent_model->get_worksites();
        if (!$this->session->userdata('userId')) {
            redirect('welcome/');
        }
        $data['countries'] = $this->User->get_countries();
        $id = $this->uri->segment(3);
        $user_detail = $this->Welcome->fullUserDetail($id);
        $data['title'] = "My Profile";
        $data['user_detail'] = $user_detail;
        $this->template->load('front', 'user/viewHR', $data);
    }

    public function deleteUser($id, $status = "") {
//        die;
        $this->loginCheck("users/deleteUser/" . $this->uri->segment(3) . "/" . $status);

        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $id = $this->uri->segment(3);
        $user_detail = $this->User->userDetail($id);
        if ($status == 'move') {
            if (!$this->User->checkEmailApplicant($user_detail[0]['email'])) {
                $data = array(
                    'firstname' => $user_detail[0]['firstname'],
                    'lastname' => $user_detail[0]['lastname'],
                    'mobile' => $user_detail[0]['contact_no'],
                    'email' => $user_detail[0]['email'],
                    'gender' => $user_detail[0]['gender'],
                    'height' => $user_detail[0]['height'],
                    'weight' => $user_detail[0]['weight'],
                    'passport_no' => $user_detail[0]['passport_number'],
                    'date1' => $user_detail[0]['q1'],
                    'date2' => $user_detail[0]['q2'],
                    'visa_number' => $user_detail[0]['visa_number'],
                    'expiry' => $user_detail[0]['visa_expiry_date'],
                    'vahicle' => $user_detail[0]['vehicle'],
                    'comment' => $user_detail[0]['notes'],
                    'status' => '1'
                );
                $this->applicant_model->addApplicant($data);
            }

            $this->User->editUser(array('left_australia' => '2', 'employee_employed' => '1'), $id);
            $this->session->set_flashdata('smessage', 'Contractor Successfully moved');
        } else {
            $this->User->deleteUser($id);
            $this->session->set_flashdata('smessage', 'Contractor Successfully deleted');
        }
        redirect('/users/');
    }

    public function deleteUserResign() {
        $this->loginCheck("users/deleteUserResign/" . $this->uri->segment(3));

        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $id = $this->uri->segment(3);
        $user_detail = $this->User->userDetail($id);
        $this->User->deleteUser($id);
        $this->session->set_flashdata('smessage', 'Contractor Successfully deleted');
        redirect('/users/empResigList');
    }

    public function deleteHR() {
        $this->loginCheck("users/deleteHR/" . $this->uri->segment(3));

        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $id = $this->uri->segment(3);
        $user_detail = $this->User->userDetail($id);
        $this->User->deleteUser($id);
        $this->session->set_flashdata('smessage', 'HR Successfully deleted');
        redirect('/users/listHR');
    }

    public function loadForm($applicant_id) {


        $data['houses'] = $this->household_model->get_houses();
        $data['countries'] = $this->User->get_countries();
        $data['worksites'] = $this->rent_model->get_worksites();
        $data['banks'] = $this->User->get_banks();
        $data['applicant'] = $this->User->get_applicants();
        $data['detail'] = $this->User->applicantDetail($applicant_id);

        $user_detail = $this->User->userDetailEmail($data['detail']['email']);
        if (!empty($user_detail)) {
            $this->User->editUser(array('employee_employed' => '2', 'left_australia' => '1'), $user_detail[0]['id']);
            $this->User->deleteApplicant($data['detail']['id']);
            $this->session->set_flashdata('smessage', 'Contractor sucessfully added');
            echo "redirect";
        } else {
            $this->load->view('user/loadform', $data);
        }
    }

    public function addUser() {
        $this->loginCheck("users/addUser/");
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $data['houses'] = $this->household_model->get_houses();
        $data['countries'] = $this->User->get_countries();
        $data['worksites'] = $this->rent_model->get_worksites();
        $data['banks'] = $this->User->get_banks();
        $data['applicant'] = $this->User->get_applicants();
        $data['title'] = "Registration";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('enname', 'English Name', 'trim|alpha');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[emp_users.email]|is_unique[emp_powerusers.email]|is_unique[emp_recruitments.email]');

        $this->form_validation->set_rules('contact', 'Contact Number', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_message('is_unique', 'The e-mail address is already registered in Contractor Management');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|min_length[8]');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('height', 'Height', 'trim|numeric');
        $this->form_validation->set_rules('weight', 'Weight', 'trim|numeric');
        $this->form_validation->set_rules('taxtype', 'Tax Type', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
        $this->form_validation->set_rules('statusvaccination', 'Vaccination status', 'trim|required');
        $this->form_validation->set_rules('shifttype', 'Shift Type', 'trim|required');
        $this->form_validation->set_rules('shifttype', 'Shift Type', 'trim|required');
        $this->form_validation->set_rules('country_id', 'Nationality', 'trim|required');

        $this->form_validation->set_rules('passport_number', 'Passport number', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('visa_type', 'Visa Type', 'trim|required');
        $this->form_validation->set_rules('country_id', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');
        $this->form_validation->set_rules('nameofbank', 'Account Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('numberofbank', 'Account Number', 'trim|required');
        $this->form_validation->set_rules('employmentdate', 'Start employment date', 'trim|required');
        $this->form_validation->set_rules('hourlyrate', 'Hourly Rate ', 'trim|required|numeric');
        $this->form_validation->set_rules('employmentdate', 'Start employment date', 'trim|required');

        $this->form_validation->set_rules('deductions', 'Deductions', 'trim|numeric');
        $this->form_validation->set_rules('placeofwork', 'Place of work', 'trim|required');
        $this->form_validation->set_rules('rental_type', 'Rental Type', 'trim|required');
        if ($this->input->post(rental_type) == 'company') {
            if ($this->input->post('statusofbond') == '1') {
                $this->form_validation->set_rules('bondamount', 'Amount of bond payment ', 'trim|numeric|required');
            }
            $this->form_validation->set_rules('weeklyrent', 'Weekly rent rate', 'trim|numeric|required');
            $this->form_validation->set_rules('statusofbond', 'Bond Payed ', 'trim|required');
        }

        $this->form_validation->set_rules('equipment_value1', 'Equipment value 1 ', 'trim|numeric');
        $this->form_validation->set_rules('equipment_value2', 'Equipment value 2  ', 'trim|numeric');
        $this->form_validation->set_rules('equipment_value3', 'Equipment value 3  ', 'trim|numeric');
        $this->form_validation->set_rules('future_employment', 'Possible Future employment ', 'trim|required');
        $this->form_validation->set_rules('employee_employed', 'Currently Employed  ', 'trim|required');

        $this->form_validation->set_rules('left_australia', 'Left Australia', 'trim|required');

        //$this->form_validation->set_message('requiredd', 'Please accept terms and condition');

        if ($this->input->post('employmentdate') <> NULL) {
            $employmentdate = $this->input->post('employmentdate');
            $date = strtotime(date("Y-m-d", strtotime($employmentdate)) . " +2 month");
            $date = strtotime(date("Y-m-d", $date) . " +15 days");
            if ($date > time() and $this->input->post('probation') == "no") {
                $this->form_validation->set_rules('date_check', 'date_check', 'trim|required');
                $this->form_validation->set_message('required', "You can not add user with probation 'no' because you have seleced date in employment date in 2.5 months from today");
            }
            if ($date < time() and $this->input->post('probation') == "yes") {
                $this->form_validation->set_rules('date_check', 'date_check', 'trim|required');
                $this->form_validation->set_message('required', "You can not add user with probation 'yes' because you have seleced date in employment date before 2.5 months from today");
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'user/addUser', $data);
        } else {
            if ($this->input->post('non_comp_address') <> "") {
                $address_update_date = date('Y-m-d');
            } else {
                $address_update_date = "";
            }
            $employmentdate = $this->input->post('employmentdate');
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $gender = $this->input->post('gender');
            $height = $this->input->post('height');
            $weight = $this->input->post('weight');
            $taxtype = $this->input->post('taxtype');
            $dob = $this->input->post('dob');
            $position = $this->input->post('position');
            $reason = $this->input->post('reason');
            $country = $this->input->post('country_id');
            $passport_number = $this->input->post('passport_number');
            $visa_type = $this->input->post('visa_type');
            $visa_expiry_date = $this->input->post('visa_expiry_date');
            $firstvisaend = $this->input->post('firstvisaend');
            $secondvisastart = $this->input->post('secondvisastart');
            $secondvisaend = $this->input->post('secondvisaend');
            $contact = $this->input->post('contact');
            $statusofabn = $this->input->post('statusofabn');
            $abnnumber = $this->input->post('abnnumber');
            $nameofbank = $this->input->post('nameofbank');
            $branchofbank = $this->input->post('branchofbank');
            $numberofbank = $this->input->post('numberofbank');
            $placeofwork = $this->input->post('placeofwork');
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
            $left_australia = $this->input->post('left_australia');
            if ($employee_employed == NULL) {
                $employee_employed = '2';
            }
            if ($left_australia == NULL) {
                $left_australia = '1';
            }
            $final_position = $this->input->post('final_position');
            $tax_num = $this->input->post('tax_num');
            $placeofwork = $this->input->post('placeofwork');
            $placeofstay = $this->input->post('placeofstay');
            $site_rate = $this->input->post('site_rate');
            $site_rate = explode('||', $site_rate);
            $site_rate = $site_rate[2];
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
                'enname' => $this->input->post('enname'),
                'probation' => $this->input->post('probation'),
                'reason_deductions' => $this->input->post('reason_deductions'),
                'site_rate' => $site_rate,
                'bank' => $this->input->post('bank'),
                'shifttype' => $this->input->post('shifttype'),
                'reason' => $this->input->post('reason'),
                'position' => $position,
                'reason' => $reason,
                'country_id' => $country,
                'passport_number' => $passport_number,
                'regignation_approve_by' => $this->input->post('r_ap_by'),
                'visa_type' => $visa_type,
                'visa_expiry_date' => $visa_expiry_date,
                'contact_no' => $contact,
                'statusofabn' => $statusofabn,
                'abnnumber' => $abnnumber,
                'nameofbank' => $nameofbank,
                'branchofbank' => $branchofbank,
                'numberofbank' => $this->removespace($numberofbank),
                'worksite_id' => $placeofwork,
                'employmentdate' => $employmentdate,
                'hourlyrate' => $hourlyrate,
                'hourlyrate_des' => $this->input->post('hourlyrate_des'),
                'address_update_date' => $address_update_date,
                'non_comp_address' => $this->input->post('non_comp_address'),
                'rental_type' => $this->input->post('rental_type'),
                'deductions' => $deductions,
                'house_id' => $this->input->post('non_comp_address') ? "" : $placeofstay,
                'statusofbond' => $statusofbond,
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
                'role' => 3,
                'tfn' => $this->input->post('tfn'),
                'abn' => $this->input->post('abn'),
                'fee_member' => $this->input->post('fee_member'),
                'fee_amount' => $this->input->post('fee_amount'),
                'notes' => $this->input->post('notes'),
                'visa_number' => $this->input->post('visa_number'),
                'vehicle' => $this->input->post('vehicle'),
                'q_fever' => $this->input->post('q_fever'),
                'q1' => $this->input->post('q1'),
                'q2' => $this->input->post('q2'),
                'address' => $this->input->post('address'),
            );
            $data['bondamount'] = $bondamount;
            $user_id = $this->User->userRegistration($data);
            $admin_id = substr(str_pad($placeofwork, 2, '0', STR_PAD_LEFT) . str_pad($this->User->getlowestId(), 3, '0', STR_PAD_LEFT), 0, 5);
            $this->User->editUser(array('admin_id' => $admin_id, 'counter_id' => $this->User->getlowestId()), $user_id);

            if ($this->input->post('applicant_id')) {
                $this->User->deleteApplicant($this->input->post('applicant_id'));
            }

            $config['protocol'] = 'mail';
            $config['wordwrap'] = FALSE;
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['crlf'] = "\r\n";
            $config['newline'] = "\r\n";
            $this->load->library('email', $config);
            $this->email->set_mailtype("html");
            $mail_data['userDetail'] = $data;
            $mail_data['text'] = 'Welcome to our company, we hope you have a safe time while with our company. We have made available to you an online system that allows you to check your periodic invoices made to our company. If you have any questions please check this online system before calling our offices. Below is your login details for this system, please note that these details cannot be changed. ';
            $mail_data['username'] = $user_id;
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

    public function removespace($str) {
        return preg_replace('#[\s]+#', ' ', $str);
    }

    public function addHRRecr1() {
        $data['houses'] = $this->household_model->get_houses();
        $data['countries'] = $this->User->get_countries();
        $data['worksites'] = $this->rent_model->get_worksites();
        $data['title'] = "Registration";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[emp_users.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[emp_users.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|min_length[8]');
        $this->form_validation->set_message('is_unique', 'The e-mail address is already registered in Contractor Management');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        //$this->form_validation->set_message('requiredd', 'Please accept terms and condition');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'user/addHR', $data);
        } else {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $contact = $this->input->post('contact');
            $data = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'password' => $password,
                'username' => $this->input->post('username'),
                'email' => $email,
                'contact_no' => $contact,
                'created' => date('Y-m-d'),
                'status' => '1',
                'role' => 4
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
            $mail_data['text'] = "Your account has been created successfully By Power User on " . SITE_TITLE . ' as a HR' . '<br><br>Click here link to login ' . HTTP_PATH . 'welcome';
            $mail_data['email'] = $email;
            $mail_data['username'] = $this->input->post('username');
            $mail_data['password'] = $password;
            $mail_data['firstname'] = $firstname;
            $this->load->library('parser');
            $msg = $this->parser->parse('email/template', $mail_data, TRUE);
            $this->email->from(FORM_EMAIL, SITE_TITLE);
            $this->email->to($email);
            $this->email->subject('Login Details');
            $this->email->message($msg);
            $this->email->send();
            $this->session->set_flashdata('smessage', 'HR Successfully added');
            redirect('users/listHR');
        }
    }

    public function addHr() {
        $this->loginCheck("users/addHr/");
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
            $dob = $this->input->post('dob');
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

    public function editUser() {
        $id = $this->uri->segment(3);
        $this->loginCheck("users/editUser/" . $id);

        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $user_detail = $this->User->userDetail($id);
//        echo "<pre>";print_r($user_detail);
        $data['houses'] = $this->household_model->get_houses();
        $data['countries'] = $this->User->get_countries();
        $data['worksites'] = $this->User->get_worksites();
        $data['banks'] = $this->User->get_banks();
        $data['user_detail'] = $user_detail;
        $redirect = '/welcome/myProfile';

        $data['countries'] = $this->User->get_countries();
        $data['title'] = "Edit Profile";

        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('enname', 'English Name', 'trim|alpha');
        $this->form_validation->set_rules('email', 'Email', "valid_email|required|is_unique_again[emp_users.email.$id]");
        $this->form_validation->set_message('is_unique_again', 'The e-mail address is already registered in Contractor Management');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        //$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('height', 'Height', 'trim|numeric');
        $this->form_validation->set_rules('weight', 'Weight', 'trim|numeric');
        $this->form_validation->set_rules('taxtype', 'Tax Type', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
        $this->form_validation->set_rules('statusvaccination', 'Vaccination status', 'trim|required');
        $this->form_validation->set_rules('shifttype', 'Shift Type', 'trim|required');
        $this->form_validation->set_rules('shifttype', 'Shift Type', 'trim|required');
        $this->form_validation->set_rules('country_id', 'Nationality', 'trim|required');

        $this->form_validation->set_rules('passport_number', 'Passport number', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('visa_type', 'Visa Type', 'trim|required');
        $this->form_validation->set_rules('country_id', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');
        $this->form_validation->set_rules('nameofbank', 'Account Name', 'trim|required|alpha_dash');
        $this->form_validation->set_rules('numberofbank', 'Account Number', 'trim|required');
        $this->form_validation->set_rules('employmentdate', 'Start employment date', 'trim|required');
        $this->form_validation->set_rules('hourlyrate', 'Hourly Rate ', 'trim|required|numeric');
        $this->form_validation->set_rules('employmentdate', 'Start employment date', 'trim|required');

        $this->form_validation->set_rules('deductions', 'Deductions', 'trim|numeric');
        $this->form_validation->set_rules('placeofwork', 'Place of work', 'trim|required');
//        $this->form_validation->set_rules('placeofstay', 'Place of stay', 'trim|required');
        $this->form_validation->set_rules('rental_type', 'Rental Type', 'trim|required');
        $this->form_validation->set_rules('weeklyrent', 'Weekly rent rate', 'trim|numeric|required');
        $this->form_validation->set_rules('statusofbond', 'Bond Payed ', 'trim|required');
        if ($this->input->post('statusofbond') == '1') {
            $this->form_validation->set_rules('bondamount', 'Amount of bond payment ', 'trim|numeric|required');
        }
        $this->form_validation->set_rules('equipment_value1', 'Equipment value 1 ', 'trim|numeric');
        $this->form_validation->set_rules('equipment_value2', 'Equipment value 2  ', 'trim|numeric');
        $this->form_validation->set_rules('equipment_value3', 'Equipment value 3  ', 'trim|numeric');
        if ($this->input->post('employee_employed') == '1')
            $this->form_validation->set_rules('future_employment', 'Possible Future employment ', 'trim|required');
        $this->form_validation->set_rules('employee_employed', 'Currently Employed  ', 'trim|required');

        if ($this->input->post('employmentdate') <> NULL) {
            $employmentdate = $this->input->post('employmentdate');
            $date = strtotime(date("Y-m-d", strtotime($employmentdate)) . " +2 month");
            $date = strtotime(date("Y-m-d", $date) . " +15 days");
            if ($date > time() and $this->input->post('probation') == "no") {
                $this->form_validation->set_rules('date_check', 'date_check', 'trim|required');
                $this->form_validation->set_message('required', "You can not add user with probation 'no' because you have seleced date in employment date in 2.5 months from today");
            }
            if ($date < time() and $this->input->post('probation') == "yes") {
                $this->form_validation->set_rules('date_check', 'date_check', 'trim|required');
                $this->form_validation->set_message('required', "You can not add user with probation 'yes' because you have seleced date in employment date before 2.5 months from today");
            }
        }
        if ($this->input->post('employee_employed') == '1')
            $this->form_validation->set_rules('left_australia', 'Left Australia', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'user/editUser', $data);
        } else {

            if ($this->input->post('non_comp_address') <> $user_detail[0]['non_comp_address']) {
                $address_update_date = date('Y-m-d');
            } else {
                $address_update_date = $this->input->post('address_update_date');
            }
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $gender = $this->input->post('gender');
            $height = $this->input->post('height');
            $weight = $this->input->post('weight');
            $taxtype = $this->input->post('taxtype');
            $dob = $this->input->post('dob');
            $position = $this->input->post('position');
            $reason = $this->input->post('reason');
            $country = $this->input->post('country_id');
            $passport_number = $this->input->post('passport_number');
            $visa_type = $this->input->post('visa_type');
            $visa_expiry_date = $this->input->post('visa_expiry_date');
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

            if ($employee_employed == NULL) {
                $employee_employed = '1';
            }
            if ($left_australia == NULL) {
                $left_australia = '2';
            }
            $tax_num = $this->input->post('tax_num');
            $placeofwork = $this->input->post('placeofwork');
            $placeofstay = $this->input->post('placeofstay');
            $site_rate = $this->input->post('site_rate');
            $site_rate = explode('||', $site_rate);
            if (!empty($site_rate)) {
                $site_rate = $site_rate[2];
            } else {
                $site_rate = '';
            }
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
                'enname' => $this->input->post('enname'),
                'probation' => $this->input->post('probation'),
                'reason_deductions' => $this->input->post('reason_deductions'),
                'notes' => $this->input->post('notes'),
                'password' => $this->input->post('password'),
                'site_rate' => $site_rate,
                'shifttype' => $this->input->post('shifttype'),
                'reason' => $this->input->post('reason'),
                'position' => $position,
                'reason' => $reason,
                'country_id' => $country,
                'passport_number' => $passport_number,
                'regignation_approve_by' => $this->input->post('r_ap_by'),
                'visa_type' => $visa_type,
                'visa_expiry_date' => $visa_expiry_date,
                'contact_no' => $contact,
                'statusofabn' => $statusofabn,
                'abnnumber' => $abnnumber,
                'nameofbank' => $nameofbank,
                'branchofbank' => $branchofbank,
                'numberofbank' => $this->removespace($numberofbank),
                'worksite_id' => $placeofwork,
                'employmentdate' => $employmentdate,
                'hourlyrate' => $hourlyrate,
                'hourlyrate_des' => $this->input->post('hourlyrate_des'),
                'address_update_date' => $address_update_date,
                'non_comp_address' => $this->input->post('non_comp_address'),
                'rental_type' => $this->input->post('rental_type'),
                'bank' => $this->input->post('bank'),
                'deductions' => $deductions,
                'house_id' => $this->input->post('non_comp_address') ? "" : $placeofstay,
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
                'employee_employed' => $employee_employed,
                'final_position' => $final_position,
                'tfn' => $this->input->post('tfn'),
                'abn' => $this->input->post('abn'),
                'fee_member' => $this->input->post('fee_member'),
                'fee_amount' => $this->input->post('fee_amount'),
                'vehicle' => $this->input->post('vehicle'),
                'q_fever' => $this->input->post('q_fever'),
                'q1' => $this->input->post('q1'),
                'q2' => $this->input->post('q2'),
                'visa_number' => $this->input->post('visa_number'),
                'address' => $this->input->post('address'),
                'last_update' => date('Y-m-d H:i:S')
            );
//            echo "<pre>";
//            print_r($data);
//            die;
//            if ($this->input->post('employee_employed') == '1') {
            $data['future_employment'] = $future_employment;
            $data['left_australia'] = $left_australia;
//            }
            $admin_id = substr(str_pad($placeofwork, 2, '0', STR_PAD_LEFT), 0, 2) . substr($user_detail[0]['admin_id'], 2, 5);
            $data['admin_id'] = $admin_id;

//            echo $admin_id;
//            die;
            $this->User->editUser($data, $id);
            $this->session->set_flashdata('smessage', 'Profile Successfully Updated');
            redirect('users/');
        }
    }

    public function editHR() {
        $id = $this->uri->segment(3);

        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $this->loginCheck("users/editHR/" . $id);
        $user_detail = $this->User->userDetail($id);
        $data['countries'] = $this->User->get_countries();
        $data['user_detail'] = $user_detail;
        $data['countries'] = $this->User->get_countries();
        $data['title'] = "Edit HR Profile";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', "valid_email|required|is_unique_again[emp_users.email.$id]");
        $this->form_validation->set_rules('username', 'Username', "required|is_unique_again1[emp_users.username.$id]");
        $this->form_validation->set_message('is_unique_again1', 'The username is already registered in Contractor Management');
        $this->form_validation->set_message('is_unique_again', 'The e-mail address is already registered in Contractor Management');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'user/editHR', $data);
        } else {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $contact = $this->input->post('contact');
            $data = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'username' => $this->input->post('username'),
                'contact_no' => $contact,
            );
            $this->User->editUser($data, $id);
            $this->session->set_flashdata('smessage', 'Profile Successfully Updated');
            redirect('users/listHR');
        }
    }

    public function getWorksiteRateAndName($id, $id1 = NULL) {
        if ($id and ($id <> 'all')) {
            $rate = $this->User->getWorksiteRateAndName($id);
            echo '<option value="">Select Site Rate Name</option>';
            for ($i = 1; $i < 16; $i++) {
                if ($rate['site_rate_name' . $i]) {
                    echo "<option value='" . $rate['site_rate' . $i] . "||" . $rate['site_rate_name' . $i] . "||" . $i . "'";
                    if ($this->uri->segment(4) == $i) {
                        echo 'selected="selected"';
                    }
                    echo " >" . $rate['site_rate_name' . $i] . "</option>";
                }
            }
        } else {
            echo '<option>Select Site Rate Name</option>';
        }
    }

    public function getWorksiteRateAndName1($id, $id1) {
        if ($id and ($id <> 'all')) {
            $rate = $this->User->getWorksiteRateAndName($id);
            echo '<option value="">Select Site Rate Name</option>';
            for ($i = 1; $i < 10; $i++) {
                echo "<option value='" . $i . "'";
                if (isset($id1) and $id1 <> NULL and ($id1 <> 'all')) {
                    if ($id1 == $i) {
                        echo 'selected="selected"';
                    }
                }
                echo ">" . $rate['site_rate_name' . $i] . "</otion>";
            }
        } else {
            echo '<option>Select Site Rate Name</option>';
        }
    }

    public function getHousesList($id, $selected = '') {
        $array = $this->house_model->housesListInWorksite($id);
        echo form_dropdown('houses', $array, $selected, ' id="house" class="textfield_input"');
    }

    public function getEmployeesList($id, $selected = '') {
        $array = $this->User->getEmployeesListInWorksite($id);
        echo form_dropdown('employee', $array, $selected, ' id="employee" class="textfield_input"');
    }

    public function sixmonthcheck($offset = 0) {
        $this->loginCheck("users/sixmonthcheck/" . $offset);
        ob_start();
        $this->ajax_sixmonthcheck(0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "6 month check";
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'user/sixmonthcheck', $data);
    }

    function ajax_sixmonthcheck($offset = 0) {
        $config['base_url'] = site_url('users/ajax_sixmonthcheck/');
        $config['div'] = '#middle-content';
        $config['loadingId'] = 'loading-image';
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        if ($this->session->userdata('visaDays') == '14days') {
            $config['total_rows'] = $this->payment_model->countUsersSixMonth('14days');
            $data['users'] = $this->payment_model->getUsersSixMonth('14days', $config['per_page'], $offset);
        }
        if ($this->session->userdata('visaDays') == '30days') {
            $config['total_rows'] = $this->payment_model->countUsersSixMonth('30days');
            $data['users'] = $this->payment_model->getUsersSixMonth('30days', $config['per_page'], $offset);
        }
        if ($this->session->userdata('visaDays') == '60days') {
            $config['total_rows'] = $this->payment_model->countUsersSixMonth('60days');
            $data['users'] = $this->payment_model->getUsersSixMonth('60days', $config['per_page'], $offset);
        }
        if ($this->session->userdata('visaDays') == "" OR $this->session->userdata('visaDays') == NULL) {
            $config['total_rows'] = $this->payment_model->countUsersSixMonth('0');
            $data['users'] = $this->payment_model->getUsersSixMonth('0', $config['per_page'], $offset);
        }
        $data['title'] = "Visa Expiry Check Management";
        $this->jquery_pagination->initialize($config);
        $this->load->view('user/ajax_sixmonthcheck', $data);
    }

    public function day_45() {
        $this->session->set_userdata('visaDays', '14days');
        $this->ajax_sixmonthcheck(0);
    }

    public function day_56() {
        $this->session->set_userdata('visaDays', '30days');
        $this->ajax_sixmonthcheck(0);
    }

    public function day_6() {
        $this->session->set_userdata('visaDays', '60days');
        $this->ajax_sixmonthcheck(0);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */