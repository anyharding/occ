<?php

class CarManage extends CI_Controller {

    private $limit = 10;
    private $uri_segment = 4;

    function __construct() {
        parent::__construct();
        $this->load->model('car_model');
        $this->load->model('user_model', 'User');
        $this->load->library('pagination');
    }

    public function index() {
        $config['base_url'] = base_url() . "admin/carManage/index";
        $config['total_rows'] = $this->car_model->countCars();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        if (isset($_POST['search'])) {
            if ($_POST['search'] == '')
                $search = 'all';
            else
                $search = $this->input->post('search');
            $config['total_rows'] = $this->car_model->countsearchCars($search);
            $config['base_url'] = base_url() . "admin/carManage/index/search/" . $search;
            $cars = $this->car_model->searchCars($search, $config['per_page'], $this->uri->segment(6));
        }
        else {
            if ($this->uri->segment(4) == 'search') {
                $search = $this->uri->segment(5);
                $config['total_rows'] = $this->car_model->countsearchCars($search);
                $config['base_url'] = base_url() . "admin/carManage/index/search/" . $search;
                $config['uri_segment'] = 6;
                $cars = $this->car_model->searchCars($search, $config['per_page'], $this->uri->segment(6));
            }
            else
                $cars = $this->car_model->carList($config['per_page'], $this->uri->segment(4));
        }
        $data['title'] = "Cars List";
        $this->pagination->initialize($config);
        $data['cars'] = $cars;
        $this->template->load('admin', 'admin/carManage/index', $data);
    }

    public function addCar() {
        $redirect = '/admin/carManage/';
        $data['title'] = "Add New Car";

        $this->form_validation->set_rules('seating_capacity', 'Seating Capacity', 'trim|numeric');
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
            $this->template->load('admin', 'admin/carManage/addCar', $data);
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
            //$this->car_model->carRegistration($data);
            $user = $this->car_model->getEmail($this->input->post('car_username'));
            $this->email->set_mailtype("html");
            $mail_data['text'] = "Your Car details has been successfully added on " . SITE_TITLE . ' from Poweruser';
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


            $this->car_model->carRegistration($data);
            $this->session->set_flashdata('smessage', 'Car Successfully added');
            redirect($redirect);
        }
    }

    public function editCar() {
        $id = $this->uri->segment(4);
        $car = $this->car_model->carDetail($id);
        $data['car'] = $car;
        $data['title'] = "Edit Car Details";
        $this->form_validation->set_rules('seating_capacity', 'Seating Capacity', 'trim|numeric');
        $this->form_validation->set_rules('purchase_date', 'Purchase date', 'trim|required');
        $this->form_validation->set_rules('vin', 'Vehicle Identification Number', 'trim|required');
        $this->form_validation->set_rules('eng_no', 'Engine no', 'trim|required');
        $this->form_validation->set_rules('next_ser_km', 'Next Service KM', 'trim|numeric');
        $this->form_validation->set_rules('service_km', 'Service KM', 'trim|numeric');
        $this->form_validation->set_rules('licence_no', 'License No', 'trim|numeric');
        $this->form_validation->set_rules('latest_km', 'Latest KM', 'trim|numeric');
        $this->form_validation->set_rules('e_troll_password', 'E-toll password ', 'min_length[8]');

        if ($this->form_validation->run() == FALSE) {

            $data['company'] = $this->car_model->getCompanies();
            $data['worksites'] = $this->User->get_worksites();
            $data['users'] = $this->car_model->get_tenants();
            $this->template->load('admin', 'admin/carManage/editCar', $data);
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
            $this->session->set_flashdata('smessage', 'Car Successfully updated');
            redirect('/admin/carManage/index/');
        }
    }

    public function deleteCar() {
        $id = $this->uri->segment(4);
        $this->car_model->deleteCar($id);
        $this->session->set_flashdata('smessage', 'Car Details Successfully deleted');
        redirect('/admin/carManage/');
    }

    public function activateallCar() {
        $id = $this->uri->segment(4);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Car');
            redirect('/admin/carManage/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->car_model->activateCar($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Cars successfully activated');
        redirect('/admin/carManage/');
    }

    public function deactivateallCar() {
        $id = $this->uri->segment(4);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Car');
            redirect('/admin/carManage/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->car_model->deactivateCar($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Cars successfully deactivated');
        redirect('/admin/carManage/');
    }

    public function deleteallCar() {
        $id = $this->uri->segment(4);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Car');
            redirect('/admin/carManage/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->car_model->deleteCar($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Cars successfully deleted');
        redirect('/admin/carManage/');
    }

    public function deactivateCar() {
        $id = $this->uri->segment(4);
        $this->car_model->deactivateCar($id);
        $this->session->set_flashdata('smessage', 'Car successfully deactivated');
        redirect('/admin/carManage/');
    }

    public function activateCar() {
        $id = $this->uri->segment(4);
        $this->car_model->activateCar($id);
        $this->session->set_flashdata('smessage', 'Car successfully activated');
        redirect('/admin/carManage/');
    }

    public function getUserDOB($id) {
        echo $this->car_model->getUserDOB($id);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
