<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employees extends CI_Controller {

    var $limit = 10;

    function __construct() {
        parent::__construct();
        $this->load->model('welcome_model', 'Welcome', true);
        $this->load->model('user_model', 'User', true);
        $this->load->model('payment_model');
        $this->load->model('household_model');
        $this->load->model('admin_model');
        $this->load->model('rent_model');
        $this->load->model('house_model');
        $this->load->library('pagination');
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
    }

    public function index() {
        if ($this->session->userdata('employeeId'))
            redirect('s/employees/batchpayment');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $pasword = $this->input->post('password');
            $checkAdminLoginDeatils = $this->Welcome->employeeLogin($username, $pasword);
            if ($checkAdminLoginDeatils == 'false') {
                $this->session->set_userdata('message', 'Invaild password or employee id please contact the Administrator');
            }
            if ($checkAdminLoginDeatils == 'true') {
                redirect('s/employees/batchpayment');
            }
        }
        $data['title'] = "Employees Login";
        $this->template->load('front', 'employee/index', $data);
    }

    function login() {
        if ($this->session->userdata('employeeId'))
            redirect('s/employees/batchpayment');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $pasword = $this->input->post('password');
            $checkAdminLoginDeatils = $this->Welcome->employeeLogin($username, $pasword);
            if ($checkAdminLoginDeatils == 'false') {
                $this->session->set_userdata('message', 'Invaild password or employee id please contact the Administrator');
            }
            if ($checkAdminLoginDeatils == 'true') {
                redirect('s/employees/batchpayment');
            }
        }
        $data['title'] = "Employees Login";
        $this->template->load('front', 'employee/index', $data);
    }

    public function myProfile() {
        $data['houses'] = $this->household_model->get_houses();
        $data['countries'] = $this->User->get_countries();
        $data['worksites'] = $this->rent_model->get_worksites();
        if (!$this->session->userdata('employeeId')) {
            redirect('s/employees/');
        }
        $data['countries'] = $this->User->get_countries();
        $id = $this->session->userdata('employeeId');
        $user_detail = $this->Welcome->fullUserDetail($id);
        $data['title'] = "My Profile";
        $data['user_detail'] = $user_detail;
        $this->template->load('front', 'employee/myProfile', $data);
    }

    public function termAndConditions() {
        $data['title'] = 'Terms and Conditions';
        $data['contents'] = $this->User->contentDetail(2);
        $this->template->load('front', 'user/termAndCondition', $data);
    }

    function logout() {
        $this->session->unset_userdata('employeeId');
        $this->session->set_userdata('smessage', 'You have logged out successfully.');
        redirect('s/employees/');
    }

    public function changeAddress() {
        if (!$this->session->userdata('employeeId'))
            redirect('s/employees/');
        $id = $this->uri->segment(4);
        $user_detail = $this->User->userDetail($id);
        $data['user_detail'] = $user_detail;
        $data['title'] = "Update Non Company Address Details";
//        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha');
        if ($this->input->post('employee_employed') == '1')
            $this->form_validation->set_rules('left_australia', 'Left Australia', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'employee/changeAddress', $data);
        } else {
            if ($this->input->post('non_comp_address') <> $user_detail[0]['non_comp_address']) {
                $address_update_date = date('Y-m-d');
            } else {
                $address_update_date = $user_detail[0]['address_update_date'];
            }
            $data = array(
                'address_update_date' => $address_update_date,
                'non_comp_address' => $this->input->post('non_comp_address'),
            );
        }
    }

    public function batchpayment() {
        if (!$this->session->userdata('employeeId')) {
            redirect('s/employees/');
        }
        $user_detail = $this->User->userDetail($this->session->userdata('employeeId'));
        $now = date('Y-m-d');
        $to = strtotime($now . ' - 14 days');
        if ($user_detail[0]['address_update_date'] == "" or $to >= strtotime($user_detail[0]['address_update_date'])) {
            redirect('/s/employees/changeAddress');
        }
        $config['base_url'] = base_url() . "s/employees/batchpayment";
        $config['total_rows'] = $this->payment_model->countPaymentsEmployee();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $payment = $this->payment_model->paymentListEmployee($config['per_page'], $this->uri->segment(4));
        $data['title'] = "Payments List";
        $this->pagination->initialize($config);
        $data['payment'] = $payment;
        $this->template->load('front', 'employee/batchPayment', $data);
    }

    public function getsearchRecord() {
        $address = $this->input->post('non_comp_address');
        $record = $this->payment_model->searchAddress($address);
        $count = 0;
        $content = '<div class="result_main"><div class="field_name please_select_address">Please select address</div>';
        foreach ($record as $key => $value) {
            $count +=1;
            $content .= '<div class="user_name_box2 address_result"><div class="text_field_bg radio_button"><span class="radio_span"></span>' . form_radio("select_address", $value['id'], FALSE, "class='radio_button select_val_" . $count . "' id='radio" . $count . "'") . '<span class="radio_span"></span><label class="ancor-pointer" for="radio' . $count . '">' . $value['address'] . '</label></div></div>';
        }
        $content .= '<div class="user_name_box2 address_result"><div class="text_field_bg radio_button"><span class="radio_span"></span>' . form_radio("select_address", "", FALSE, "class='radio_button select_val_0' id='radio0'") . '<span class="radio_span"></span><label class="ancor-pointer" for="radio0">Not any of above address</label></div></div>';
        $content .= "<input type='hidden' value='" . $address . "' name='searched_address'>";
        $content .= "</div>";
        if (empty($record)) {
            $valid = false;
        } else {
            $valid = true;
        }
        echo json_encode(array('content' => $content, 'valid' => $valid, 'redirect' => false));
    }

    public function updateNewAddress() {
        $address = $this->input->post('non_comp_address');
        $this->payment_model->updateAddress(array('non_comp_address' => $address, 'house_id' => 0, 'address_update_date' => date('Y-m-d')));
        $this->session->set_userdata('smessage', "Non company address successfully updated");
        echo json_encode(array('redirect' => HTTP_PATH . 's/employees/myProfile'));
    }

    public function updateAddress() {
        $address = $this->input->post('select_address');
        $searched_address = $this->input->post('searched_address');
        if ($address) {

            $house_detail = $this->house_model->houseDetail($address);
            $rent = 0;
            if ($house_detail[0]['payment_cycle'] == 'W') {
                $rent = $house_detail[0]['rent_payment_amount'];
            }
            if ($house_detail[0]['payment_cycle'] == 'M') {
                $rent = $house_detail[0]['rent_payment_amount'] * (0.25);
            }
            if ($house_detail[0]['payment_cycle'] == 'F') {
                $rent = $house_detail[0]['rent_payment_amount'] * (0.5);
            }

            $data = array(
                'rental_type' => 'company',
                'non_comp_address' => "",
                'house_id' => $address,
                'address_update_date' => date('Y-m-d'),
                'weeklyrent' => $rent,
                'statusofbond' => '1',
                'bondamount' => $house_detail[0]['rent_bound'],
            );
            $this->payment_model->updateAddress($data);
            $this->session->set_userdata('smessage', "Company address successfully updated");
            redirect('s/employees/myProfile');
        } else {
            $data = array(
                'rental_type' => 'non-company',
                'non_comp_address' => $searched_address,
                'house_id' => '0',
                'address_update_date' => date('Y-m-d'),
                'weeklyrent' => 0,
                'statusofbond' => '1',
                'bondamount' => 0,
            );
            $this->payment_model->updateAddress($data);
            $this->session->set_userdata('smessage', "Non company address successfully updated");
            redirect('s/employees/myProfile');
        }
    }

    public function viewPayment() {
        $id = $this->uri->segment(4);
        $payment = $this->payment_model->paymentDetail($id);
        $data['payment'] = $payment;
        $data['title'] = "View Payment Details";
        $this->template->load('front', 'employee/viewPayment', $data);
    }

}