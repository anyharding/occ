<?php

class carManage extends CI_Controller {

    private $limit = 20;
    private $uri_segment = 3;

    function __construct() {
        parent::__construct();
//        if (!$this->session->userdata('userId')) {
//            redirect('welcome/myProfile');
//        }
        $this->load->model('car_model');
        $this->load->model('welcome_model', 'Welcome');
        $this->load->model('user_model', 'User');
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

    public function index1() {
        $this->loginCheck("carManage/index");
        $config['base_url'] = base_url() . "carManage/index";
        $config['total_rows'] = $this->car_model->countCars();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $cars = $this->car_model->carList($config['per_page'], $this->uri->segment(3));
        $data['title'] = "Cars List";
        $this->pagination->initialize($config);
        $data['cars'] = $cars;
        $this->template->load('front', 'carManage/index', $data);
    }

    function ajax_index($offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('carManage/ajax_index/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->car_model->countCars();
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['cars'] = $this->car_model->carList($config['per_page'], $this->uri->segment(3));
        $this->load->view('carManage/ajax_index', $data);
    }

    public function index($offset = 0) {
        $this->loginCheck("carManage/index/");
        ob_start();
        $this->ajax_index($offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Cars List";
        $data['ajax_content'] = $initial_content;//'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'carManage/index', $data);
    }

    public function addCar() {
        $this->loginCheck("carManage/addCar");
        $redirect = '/carManage/';
        $data['title'] = "Add New Car";
        $this->form_validation->set_rules('purchase_date', 'Purchase date', 'trim|required');
        $this->form_validation->set_rules('vin', 'Vehicle Identification Number', 'trim|required');
        $this->form_validation->set_rules('eng_no', 'Engine no', 'trim|required');
        $this->form_validation->set_rules('car_username', 'Car user name', 'trim|required');
        $this->form_validation->set_rules('next_ser_km', 'Next Service KM', 'trim|numeric');
        $this->form_validation->set_rules('service_km', 'Service KM', 'trim|numeric');
        $this->form_validation->set_rules('licence_no', 'License No', 'trim|numeric');
        $this->form_validation->set_rules('latest_km', 'Latest KM', 'trim|numeric');
        $this->form_validation->set_rules('e_troll_password', 'E-toll password ', 'min_length[8]');
        if ($this->form_validation->run() == FALSE) {
            $data['users'] = $this->car_model->get_tenants();
            $data['company'] = $this->car_model->getCompanies();
            $data['worksites'] = $this->User->get_worksites();
            $this->template->load('front', 'carManage/addCar', $data);
        } else {
            $data = array(
                'purchase_date' => $this->input->post('purchase_date'),
                'ownership_comp' => $this->input->post('ownership_comp'),
                'rego_no' => $this->input->post('rego_no'),
                'rego_exp_date' => $this->input->post('rego_exp_date'),
                'vin' => $this->input->post('vin'),
                'eng_no' => $this->input->post('eng_no'),
                'color' => $this->input->post('color'),
                'next_ser_date' => $this->input->post('next_ser_date'),
                'next_ser_km' => $this->input->post('next_ser_km'),
                'service_date' => $this->input->post('service_date'),
                'service_km' => $this->input->post('service_km'),
                'car_username' => $this->input->post('car_username'),
                'dob' => $this->input->post('dob'),
                'licence_no' => $this->input->post('licence_no'),
                'latest_km' => $this->input->post('latest_km'),
                'car_make' => $this->input->post('car_make'),
                'model' => $this->input->post('model'),
                'year' => $this->input->post('year'),
                'purchase_price' => $this->input->post('purchase_price'),
                'insurance_comp' => $this->input->post('insurance_comp'),
                'policy_no' => $this->input->post('policy_no'),
                'insurance_start_date' => $this->input->post('insurance_start_date'),
                'insurance_end_date' => $this->input->post('insurance_end_date'),
                'insurance_cover_cost' => $this->input->post('insurance_cover_cost'),
//                'insurance_cover_amount' => $this->input->post('insurance_cover_amount'),
                'car_use_location' => $this->input->post('car_use_location'),
                'roadside' => $this->input->post('roadside'),
                'e_troll' => $this->input->post('e_troll'),
                'e_troll_account' => $this->input->post('e_troll_account'),
                'e_troll_tag' => $this->input->post('e_troll_tag'),
                'e_troll_password' => $this->input->post('e_troll_password'),
                'notes' => $this->input->post('notes'),
                'roadside_assist_number' => $this->input->post('roadside_assist_number'),
                'roadside_assist_company' => $this->input->post('roadside_assist_company'),
                'roadside_expiry_date' => $this->input->post('roadside_expiry_date'),
                'seating_capacity' => $this->input->post('seating_capacity'),
                'date' => time()
            );
            $this->car_model->carRegistration($data);
            $user = $this->car_model->getEmail($this->input->post('car_username'));
            $this->email->set_mailtype("html");
            $mail_data['text'] = "Your Car details has been successfully added on " . SITE_TITLE . ' from admin';
            $mail_data['purchase_date'] = $this->input->post('purchase_date');
            $mail_data['vin'] = $this->input->post('vin');
            $mail_data['firstname'] = $user['firstname'];
            $this->load->library('parser');
            $msg = $this->parser->parse('email/carTemplate', $mail_data, TRUE);
            $this->email->from(FORM_EMAIL, SITE_TITLE);
            $this->email->to($user['email']);
            $this->email->subject("Your Car details has been successfully added on " . SITE_TITLE);
            $this->email->message($msg);
            $this->email->send();

            $this->session->set_flashdata('smessage', 'Car Successfully added');
            redirect($redirect);
        }
    }

    public function editCar() {
        $this->loginCheck("carManage/editCar/" . $this->uri->segment(3));
        $id = $this->uri->segment(3);
        $car = $this->car_model->carDetail($id);
        $data['car'] = $car;
        $data['title'] = "Edit Car Details";
        $this->form_validation->set_rules('purchase_date', 'Purchase date', 'trim|required');
        $this->form_validation->set_rules('vin', 'Vehicle Identification Number', 'trim|required');
        $this->form_validation->set_rules('eng_no', 'Engine no', 'trim|required');
        $this->form_validation->set_rules('next_ser_km', 'Next Service KM', 'trim|numeric');
        $this->form_validation->set_rules('service_km', 'Service KM', 'trim|numeric');
        $this->form_validation->set_rules('licence_no', 'License No', 'trim|numeric');
        $this->form_validation->set_rules('latest_km', 'Latest KM', 'trim|numeric');
        $this->form_validation->set_rules('e_troll_password', 'E-toll password ', 'min_length[8]');

        if ($this->form_validation->run() == FALSE) {
            $data['users'] = $this->car_model->get_tenants();
            $data['company'] = $this->car_model->getCompanies();
            $data['worksites'] = $this->User->get_worksites();
            $this->template->load('front', 'carManage/editCar', $data);
        } else {

            $data = array(
                'purchase_date' => $this->input->post('purchase_date'),
                'ownership_comp' => $this->input->post('ownership_comp'),
                'rego_no' => $this->input->post('rego_no'),
                'rego_exp_date' => $this->input->post('rego_exp_date'),
                'vin' => $this->input->post('vin'),
                'eng_no' => $this->input->post('eng_no'),
                'color' => $this->input->post('color'),
                'next_ser_date' => $this->input->post('next_ser_date'),
                'next_ser_km' => $this->input->post('next_ser_km'),
                'service_date' => $this->input->post('service_date'),
                'service_km' => $this->input->post('service_km'),
                'dob' => $this->input->post('dob'),
                'licence_no' => $this->input->post('licence_no'),
                'latest_km' => $this->input->post('latest_km'),
                'car_make' => $this->input->post('car_make'),
                'model' => $this->input->post('model'),
                'notes' => $this->input->post('notes'),
                'year' => $this->input->post('year'),
                'purchase_price' => $this->input->post('purchase_price'),
                'insurance_comp' => $this->input->post('insurance_comp'),
                'policy_no' => $this->input->post('policy_no'),
                'insurance_start_date' => $this->input->post('insurance_start_date'),
                'insurance_end_date' => $this->input->post('insurance_end_date'),
                'insurance_cover_cost' => $this->input->post('insurance_cover_cost'),
//                'insurance_cover_amount' => $this->input->post('insurance_cover_amount'),
                'car_use_location' => $this->input->post('car_use_location'),
                'roadside' => $this->input->post('roadside'),
                'e_troll' => $this->input->post('e_troll'),
                'e_troll_account' => $this->input->post('e_troll_account'),
                'e_troll_tag' => $this->input->post('e_troll_tag'),
                'e_troll_password' => $this->input->post('e_troll_password'),
                'roadside_assist_number' => $this->input->post('roadside_assist_number'),
                'roadside_assist_company' => $this->input->post('roadside_assist_company'),
                'roadside_expiry_date' => $this->input->post('roadside_expiry_date'),
                'seating_capacity' => $this->input->post('seating_capacity'),
                'date' => time()
            );
            if ($this->input->post('log_new_entry')) {
                $data['log'] = $car['log'] . "<p>" . $this->input->post('log_new_entry') . ": " . date('M d, Y h:i A') . "</p>";
            }
            $this->car_model->editCar($data, $id);
            $this->session->set_flashdata('smessage', 'Car Details Successfully updated');
            redirect('/carManage/index/');
        }
    }

    public function viewCarDetail($id) {
        $this->loginCheck("carManage/viewCarDetail/" . $id);
        $car = $this->car_model->carDetail($id);
        $data['car'] = $car;
        $data['title'] = "View Car Details";
        $this->template->load('front', 'carManage/viewCar', $data);
    }

    public function deleteCar() {
        $id = $this->uri->segment(3);
        $this->loginCheck("carManage/deleteCar/" . $id);
        $this->car_model->deleteCar($id);
        $this->session->set_flashdata('smessage', 'Car Details Successfully deleted');
        redirect('/carManage/');
    }

    public function activateallRent() {
        $id = $this->uri->segment(3);
        $this->loginCheck("carManage/activateallRent/" . $id);
        $this->rent_model->activateRent($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/carManage/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->rent_model->activateRent($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Rents successfully activated');
        redirect('/carManage/');
    }

    public function deactivateallRent() {
        $id = $this->uri->segment(3);
        $this->loginCheck("carManage/deactivateallRent/" . $id);
        $this->rent_model->activateRent($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/carManage/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->rent_model->deactivateRent($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Rents successfully deactivated');
        redirect('/carManage/');
    }

    public function deleteallRent() {
        $id = $this->uri->segment(3);
        $this->loginCheck("carManage/deleteallRent/" . $id);
        $this->rent_model->activateRent($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/rent/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->rent_model->deleteRent($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Rents successfully deleted');
        redirect('/rent/');
    }

    public function deactivateRent() {
        $id = $this->uri->segment(3);
        $this->loginCheck("carManage/deactivateRent/" . $id);
        $this->rent_model->deactivateRent($id);
        $this->session->set_flashdata('smessage', 'Rent successfully deactivated');
        redirect('/carManage/');
    }

    public function activateRent() {
        $id = $this->uri->segment(3);
        $this->loginCheck("carManage/activateRent/" . $id);
        $this->rent_model->activateRent($id);
        $this->session->set_flashdata('smessage', 'Rent successfully activated');
        redirect('/carManage/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
