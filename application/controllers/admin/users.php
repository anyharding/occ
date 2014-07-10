<?php

class Users extends CI_Controller {

    private $limit = 10;
    private $uri_segment = 4;

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('household_model');
        $this->load->model('rent_model');
        $this->load->library('pagination');
        date_default_timezone_set('Asia/Calcutta');
    }

    public function test() {
        get_browser(null, true);
    }

    public function index() {
        $config['base_url'] = base_url() . "admin/users/index";
        $config['total_rows'] = $this->user_model->countUsers('normal_user');
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        if (isset($_POST['search'])) {
            if ($_POST['search'] == '')
                $search = 'all';
            else
                $search = $this->input->post('search');
            $config['total_rows'] = $this->user_model->countsearchUsers($search);
            $config['base_url'] = base_url() . "admin/users/index/search/" . $search;
            $users_list = $this->user_model->searchUsers($search, 'normal_user', $config['per_page'], $this->uri->segment(6));
        }
        else {
            if ($this->uri->segment(4) == 'search') {
                $search = $this->uri->segment(5);
                $config['total_rows'] = $this->user_model->countsearchUsers($search);
                $config['base_url'] = base_url() . "admin/users/index/search/" . $search;
                $config['uri_segment'] = 6;
                $users_list = $this->user_model->searchUsers($search, 'normal_user', $config['per_page'], $this->uri->segment(6));
            }
            else
                $users_list = $this->user_model->usersList($config['per_page'], $this->uri->segment(4), "normal_user");
        }
        $data['title'] = "Flush Old Employees";
        $this->pagination->initialize($config);
        $data['users'] = $users_list;
        $this->template->load('admin', 'admin/users/index', $data);
    }

    public function getOldUsers() {
        $users_list = $this->user_model->getOldUsers();
        $data['users'] = $users_list;
        $this->load->view('admin/users/aajx_fill_users', $data);
    }

    public function deleteallSelected() {
        $id = $this->input->post('id');
        $id = explode(",", $id);
        foreach ($id as $key => $val) {
            $this->user_model->deleteUser($val);
        }
        echo count($id);
    }

    public function getOldUsersWorksite($id = 0) {
        $users_list = $this->user_model->getOldUsers($id);
        $data['users'] = $users_list;echo count($users_list);
        $this->load->view('admin/users/aajx_fill_users_worksite', $data);
    }

    public function deleteall() {
        echo $this->user_model->delete_old_employees();
    }

    public function getworksites() {
        $worksites = $this->user_model->get_worksites();
        echo form_dropdown("worksite", $worksites, "", 'class="select_worksite" style="width:400px"');
    }

    public function employeeInWorksite() {
        $worksite_id = $this->uri->segment(4);
        $config['base_url'] = base_url() . "admin/users/employeeInWorksite/" . $worksite_id;
        $config['total_rows'] = $this->user_model->countWorksiteUsers($worksite_id);
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        if (isset($_POST['search'])) {
            if ($_POST['search'] == '')
                $search = 'all';
            else
                $search = $this->input->post('search');
            $config['total_rows'] = $this->user_model->countsearchWorksiteUsers($search, $worksite_id);
            $config['base_url'] = base_url() . "admin/users/index/search/" . $search;
            $users_list = $this->user_model->searchWorksiteUsers($search, $worksite_id, $config['per_page'], $this->uri->segment(7));
        }
        else {
            if ($this->uri->segment(5) == 'search') {
                $search = $this->uri->segment(6);
                $config['total_rows'] = $this->user_model->countsearchWorksiteUsers($search, $worksite_id);
                $config['base_url'] = base_url() . "admin/users/employeeInWorksite/" . $worksite_id . "/search/" . $search;
                $config['uri_segment'] = 7;
                $users_list = $this->user_model->searchWorksiteUsers($search, $worksite_id, $config['per_page'], $this->uri->segment(7));
            }
            else
                $users_list = $this->user_model->usersWorksiteList($config['per_page'], $this->uri->segment(5), $worksite_id);
        }

        $data['title'] = "Employees List";
        $this->pagination->initialize($config);
        $data['users'] = $users_list;
        $this->template->load('admin', 'admin/users/index', $data);
    }

    public function employeeInHouse() {
        $house_id = $this->uri->segment(4);
        $config['base_url'] = base_url() . "admin/users/employeeInHouse/" . $house_id;
        $config['total_rows'] = $this->user_model->countHouseUsers($house_id);
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        if (isset($_POST['search'])) {
            if ($_POST['search'] == '')
                $search = 'all';
            else
                $search = $this->input->post('search');
            $config['total_rows'] = $this->user_model->countsearchHouseUsers($search, $house_id);
            $config['base_url'] = base_url() . "admin/users/index/search/" . $search;
            $users_list = $this->user_model->searchHouseUsers($search, $house_id, $config['per_page'], $this->uri->segment(7));
        }
        else {
            if ($this->uri->segment(5) == 'search') {
                $search = $this->uri->segment(6);
                $config['total_rows'] = $this->user_model->countsearchHouseUsers($search, $house_id);
                $config['base_url'] = base_url() . "admin/users/employeeInWorksite/" . $house_id . "/search/" . $search;
                $config['uri_segment'] = 7;
                $users_list = $this->user_model->searchHouseUsers($search, $house_id, $config['per_page'], $this->uri->segment(7));
            }
            else
                $users_list = $this->user_model->usersHousesList($config['per_page'], $this->uri->segment(5), $house_id);
        }

        $data['title'] = "Employees List";
        $this->pagination->initialize($config);
        $data['users'] = $users_list;
        $this->template->load('admin', 'admin/users/index', $data);
    }

    public function advOwners() {
        $config['base_url'] = base_url() . "admin/users/advOwners";
        $config['total_rows'] = $this->user_model->countUsers('adv_user');
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $this->pagination->initialize($config);
        if (isset($_POST['search'])) {
            $search = $this->input->post('search');
            $users_list = $this->user_model->searchUsers($search, "adv_user");
        } else {
            $users_list = $this->user_model->usersList($config['per_page'], $this->uri->segment(4), "adv_user");
        }
        $data['users'] = $users_list;
        $this->template->load('admin', 'admin/users/index', $data);
    }

    public function addUser() {
        $redirect = '/admin/users/';
        $data['houses'] = $this->household_model->get_houses();
        $data['worksites'] = $this->rent_model->get_worksites();
        $data['countries'] = $this->user_model->get_countries();
        $data['province'] = $this->user_model->get_province();
        $data['city'] = $this->user_model->get_city();
        $data['title'] = "Add Employee";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|min_length[8]');
        $this->form_validation->set_message('is_unique', 'The e-mail address is already registered in Employee Management');
        $this->form_validation->set_message('is_unique1', 'The username is already registered in Employee Management');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[emp_users.email]');
        $this->form_validation->set_rules('country_id', 'Country', 'trim|required');
        $this->form_validation->set_rules('deductions', 'Deductions', 'trim|numeric');
        $this->form_validation->set_rules('bondamount', 'Amount of bond payment ', 'trim|numeric');
        $this->form_validation->set_rules('weeklyrent', 'Weekly rent rate', 'trim|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin', 'admin/users/addUser', $data);
        } else {
            if ($_POST) {
                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $gender = $this->input->post('gender');
                $height = $this->input->post('height');
                $weight = $this->input->post('weight');
                $taxtype = $this->input->post('taxtype');
                $dob = date('Y-m-d', strtotime($this->input->post('dob')));
                $shifttype = implode(',', $this->input->post('shifttype'));
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
                $tax_num = $this->input->post('tax_num');
                $left_australia = $this->input->post('left_australia');
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
                    'regignation_approve_by' => $this->input->post('r_ap_by'),
                    'reason_deductions' => $this->input->post('reason_deductions'),
                    'dob' => $dob,
                    'shifttype' => $shifttype,
                    'position' => $position,
                    'reason' => $reason,
                    'country_id' => $country,
                    'passport_number' => $passport_number,
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
                    'status' => '1'
                );
                $username = $this->user_model->userRegistration($data);
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
                $mail_data['username'] = $username;
                $mail_data['password'] = $password;
                $mail_data['firstname'] = $firstname;
//                print_r($mail_data)
                $this->load->library('parser');
                $msg = $this->parser->parse('email/template', $mail_data, TRUE);
                $this->email->from(FORM_EMAIL, SITE_TITLE);
                $this->email->to($email);
                $this->email->subject('Login Details');
                $this->email->message($msg);
                $this->email->send();
                $this->session->set_flashdata('smessage', 'Employee Successfully added');
                redirect($redirect);
            }
        }
    }

    public function editUser() {
        $id = $this->uri->segment(4);
        $data['houses'] = $this->household_model->get_houses();
        $data['worksites'] = $this->rent_model->get_worksites();
        $user_detail = $this->user_model->userDetail($id);
        $data['countries'] = $this->user_model->get_countries();
        $data['provinces'] = $this->user_model->get_provinces($user_detail[0]['country_id']);
        $data['user_detail'] = $user_detail;
        $data['title'] = "Edit User";
//print_r($user_detail);
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', "valid_email|required|is_unique_again[emp_users.email.$id]");
        $this->form_validation->set_message('is_unique_again', 'The e-mail address is already registered in Employee Management');
        $this->form_validation->set_message('is_unique_again1', 'The username is already registered in Employee Management');
        $this->form_validation->set_rules('country_id', 'Country', 'trim|required');
        $this->form_validation->set_rules('deductions', 'Deductions', 'trim|numeric');
        $this->form_validation->set_rules('bondamount', 'Amount of bond payment ', 'trim|numeric');
        $this->form_validation->set_rules('weeklyrent', 'Weekly rent rate', 'trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin', 'admin/users/editUser', $data);
        } else {
            if ($_POST) {
                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname');
                $email = $this->input->post('email');
                $gender = $this->input->post('gender');
                $height = $this->input->post('height');
                $weight = $this->input->post('weight');
                $tax_num = $this->input->post('tax_num');
                $taxtype = $this->input->post('taxtype');
                $dob = date('Y-m-d', strtotime($this->input->post('dob')));
                $shifttype = implode(',', $this->input->post('shifttype'));
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
                $employmentdate = $this->input->post('employmentdate');
                $hourlyrate = $this->input->post('hourlyrate');
                $deductions = $this->input->post('deductions');
                $weeklyrent = $this->input->post('weeklyrent');
                $bondamount = $this->input->post('bondamount');
                $statusofbond = $this->input->post('statusofbond');
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
                $placeofwork = $this->input->post('placeofwork');
                $placeofstay = $this->input->post('placeofstay');

                $data = array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'gender' => $gender,
                    'height' => $height,
                    'weight' => $weight,
                    'taxtype' => $taxtype,
                    'tax_number' => $tax_num,
                    'dob' => $dob,
                    'shifttype' => $shifttype,
                    'position' => $position,
                    'reason' => $reason,
                    'country_id' => $country,
                    'passport_number' => $passport_number,
                    'visa_type' => $visa_type,
                    'firstvisastart' => $firstvisastart,
                    'firstvisaend' => $firstvisaend,
                    'secondvisastart' => $secondvisastart,
                    'regignation_approve_by' => $this->input->post('r_ap_by'),
                    'reason_deductions' => $this->input->post('reason_deductions'),
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
                    'worksite_id' => $placeofwork,
                    'house_id' => $placeofstay,
                    'paidforby2' => $paidforby2,
                    'equipment_name3' => $equipment_name3,
                    'equipment_value3' => $equipment_value3,
                    'paidforby3' => $paidforby3,
                    'statusvaccination' => $statusvaccination,
                    'future_employment' => $future_employment,
                    'employee_employed' => $employee_employed,
                    'final_position' => $final_position,
                    'left_australia' => $left_australia,
                );
                $this->user_model->editUser($data, $id);
                $this->session->set_flashdata('smessage', 'Employee Successfully updated');
                redirect('/admin/users/index/');
            }
        }
    }

    public function deleteUser() {
        $id = $this->uri->segment(4);
        $user_detail = $this->user_model->userDetail($id);
        $this->user_model->deleteUser($id);
        $this->session->set_flashdata('smessage', 'User Successfully deleted');
        if ($this->uri->segment(5) == 'advOwners')
            redirect('/admin/users/advOwners');
        else
            redirect('/admin/users/');
    }

    public function activateallUser() {
        $id = $this->uri->segment(4);
        $this->user_model->activateUser($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one user');
            if ($this->uri->segment(4) == 'advOwners')
                redirect('/admin/users/advOwners');
            else
                redirect('/admin/users/');
        }
        else {
            for ($i = 0; $i < count($checked); $i++)
                $this->user_model->activateUser($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected users successfully activated');
        if ($this->uri->segment(4) == 'advOwners')
            redirect('/admin/users/advOwners');
        else
            redirect('/admin/users/');
    }

    public function deactivateallUser() {
        $id = $this->uri->segment(4);
        $this->user_model->activateUser($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one user');
            if ($this->uri->segment(4) == 'advOwners')
                redirect('/admin/users/advOwners');
            else
                redirect('/admin/users/');
        }
        else {
            for ($i = 0; $i < count($checked); $i++)
                $this->user_model->deactivateUser($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected users successfully deactivated');
        if ($this->uri->segment(4) == 'advOwners')
            redirect('/admin/users/advOwners');
        else
            redirect('/admin/users/');
    }

    public function deleteallUser() {
        $id = $this->uri->segment(4);
        $this->user_model->activateUser($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one user');
            if ($this->uri->segment(4) == 'advOwners')
                redirect('/admin/users/advOwners');
            else
                redirect('/admin/users/');
        }
        else {
            for ($i = 0; $i < count($checked); $i++)
                $this->user_model->deleteUser($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected users successfully deleted');
        if ($this->uri->segment(4) == 'advOwners')
            redirect('/admin/users/advOwners');
        else
            redirect('/admin/users/');
    }

    public function deactivateUser() {
        $id = $this->uri->segment(4);
        $this->user_model->deactivateUser($id);
        $this->session->set_flashdata('smessage', 'User successfully deactivated');
        if ($this->uri->segment(5) == 'advOwners')
            redirect('/admin/users/advOwners');
        else
            redirect('/admin/users/');
    }

    public function activateUser() {
        $id = $this->uri->segment(4);
        $this->user_model->activateUser($id);
        $this->session->set_flashdata('smessage', 'User successfully activated');
        if ($this->uri->segment(5) == 'advOwners')
            redirect('/admin/users/advOwners');
        else
            redirect('/admin/users/');
    }

    public function searchUsers() {
        $search = $this->input->post('search');
        $users_list = $this->user_model->searchUsers($search);
        $data['users_list'] = $users_list;
        $this->load->view('admin/header');
        $this->load->view('admin/admin_left_menu');
        $this->load->view('admin/users/users_list', $data);
        $this->load->view('admin/footer');
    }

    public function getRent() {
        $id = $this->uri->segment(4);
        $data['value'] = $this->user_model->getHouseRate($id);
        if ($data['value'] <> '')
            echo "<div class='user_name_box2'><div class='field_name '> Rent Due Date  <span class='required1'>*</span>   </div>
<div class='text_field_bg'><input type='text' readonly='readonly',  class='textfield_input payment_date1 required' name='due_date' id='payment_date1' value='" . $data['value'] . "'></div></div></div>";

        else
            echo "<div class='user_name_box2'><div class='field_name '> Rent Due Date  <span class='required1'>*</span>   </div>
<div class='text_field_bg'><input type='text' readonly='readonly',  class='textfield_input payment_date1 required' name='due_date' id='payment_date1' ></div></div></div>";
    }

    public function getStatus() {
        $id = $this->uri->segment(4);
        echo $this->user_model->getHouseStatus($id);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
