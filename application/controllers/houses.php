<?php

class Houses extends CI_Controller {

    private $limit = 20;
    private $uri_segment = 4;

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('welcome/myProfile');
        }
        $this->load->model('house_model');
        $this->load->model('user_model', 'User', true);
        $this->load->model('rent_model');
        $this->load->model('welcome_model', 'Welcome');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('Jquery_pagination');

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

    public function index($status = 0, $worksite_id = 0, $offset = 0) {
        $this->loginCheck("houses/index/" . $status . "/" . $worksite_id . "/" . $offset);
        ob_start($offset = 0);
        $this->ajax_houses($status, $worksite_id, $offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Houses List";
        $data['offset'] = $offset;
        $data['worksite_id'] = $worksite_id;
        $data['status'] = $status;
        $data['ajax_content'] = $initial_content;//'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'houses/index', $data);
    }

    function ajax_houses($status = 0, $worksite_id = 0, $offset = 0) {
        $this->load->library('Jquery_pagination');
        if ($status == 'worksite')
            $config['base_url'] = site_url('houses/ajax_houses/worksite/' . $worksite_id . "/");
        else
            $config['base_url'] = site_url('houses/ajax_houses/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        if ($status == 'worksite')
            $config['uri_segment'] = 5;
        else
            $config['uri_segment'] = 3;
        $config['total_rows'] = $this->house_model->counthouses($worksite_id);
        if ($this->input->get('order') <> NULL) {
            $this->session->set_userdata('rent_due_date', $this->input->get('order'));
        }
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['title'] = "Houses List";
        $data['houses'] = $this->house_model->housesList($config['per_page'], $this->uri->segment($config['uri_segment']), "normal_house", $worksite_id);
        $data['worksites'] = $this->User->get_worksites();

        $data['offset'] = $offset;
        $data['worksite_id'] = $worksite_id;
        $data['status'] = $status;
        $this->load->view('houses/ajaxHouses', $data);
    }

    public function housesInWorksite($worksite_id, $offset = 0) {
        $this->loginCheck("houses/housesInWorksite/" . $worksite_id . "/" . $offset);
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        ob_start();
        $this->ajax_housesInWorksite($worksite_id, 0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['ajax_content'] = '<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'houses/index', $data);
    }

    function ajax_housesInWorksite($worksite_id, $offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('houses/ajax_housesInWorksite/' . $worksite_id . "/");
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['total_rows'] = $this->house_model->countWorksitehouses($worksite_id);
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['houses'] = $this->house_model->housesWorksiteList($limit, $offset, $worksite_id);
        $this->load->view('houses/ajaxHouses', $data);
    }

    public function housesInWorksite1() {
        $worksite_id = $this->uri->segment(3);
        $config['base_url'] = base_url() . "houses/housesInWorksite/" . $worksite_id;
        $config['total_rows'] = $this->house_model->countWorksitehouses($worksite_id);
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $houses_list = $this->house_model->housesWorksiteList($config['per_page'], $this->uri->segment(4), $worksite_id);
        $data['title'] = "House List";
        $this->pagination->initialize($config);
        $data['houses'] = $houses_list;
        $this->template->load('front', 'houses/index', $data);
    }

    public function viewHouse() {
        $id = $this->uri->segment(3);
        $this->loginCheck("houses/viewHouse/" . $id);
        $data['users'] = $this->house_model->get_tenants();
        $house_detail = $this->house_model->houseDetail($id);
        $data['house_detail'] = $house_detail;
        $data['title'] = "Edit House";
        if (!$this->session->userdata('userId')) {
            redirect('welcome/');
        }
        $data['worksites'] = $this->User->get_worksites();
        $user_detail = $this->Welcome->fullUserDetail($id);
        $users_list = $this->User->usersHousesListOnView($id);
        $houshold_list = $this->house_model->housesholdsList($id);
        $data['title'] = "House Detail";
        $data['house_detail'] = $house_detail;
        $data['household'] = $houshold_list;
        $data['users'] = $users_list;
        $this->template->load('front', 'houses/viewHouse', $data);
    }

    public function addHouse() {
        $this->loginCheck("houses/addHouse/");
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $redirect = '/houses/';
        $data['users'] = $this->house_model->get_tenants();
        $data['worksites'] = $this->User->get_worksites();
        $data['title'] = "Add House";
		$data['retailor_bank'] = $this->User->get_banks();

        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('payment_cycle', 'Payment cycle', 'trim|required');
        $this->form_validation->set_rules('rent_payment_amount', 'Rent Payment Amount', 'trim|required|numeric');
        $this->form_validation->set_rules('retailor_company_name', 'Realtor Company name', 'trim|required');
        $this->form_validation->set_rules('retailor_name', 'Realtor name', 'trim|required');
        $this->form_validation->set_rules('retailor_bank', 'Realtor bank', 'trim|required');
        $this->form_validation->set_rules('retailot_acc_name', 'Realtor account name', 'trim|required');
        $this->form_validation->set_rules('retailot_acc_no', 'Realtor account number', 'required|numeric');
        $this->form_validation->set_rules('retailot_acc_bsb', 'Realtor account BSB', 'trim|required');
        $this->form_validation->set_rules('rent_bound', 'Rent bond amount', 'numeric');
        $this->form_validation->set_rules('worksite_id', 'Worksite', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'houses/addHouse', $data);
        } else {
            $address = $this->input->post('address');
            $rent_payment_amount = $this->input->post('rent_payment_amount');
            $payment_cycle = $this->input->post('payment_cycle');
            $rent_due_date = $this->input->post('rent_due_date');
            $retailor_company_name = $this->input->post('retailor_company_name');
            $retailor_name = $this->input->post('retailor_name');
            $retailor_bank = $this->input->post('retailor_bank');
			$retailot_acc_name = $this->input->post('retailot_acc_name');
            $retailot_acc_no = $this->input->post('retailot_acc_no');
            $retailot_acc_bsb = $this->input->post('retailot_acc_bsb');

            $data = array(
                'address' => $address,
                'rent_payment_amount' => $rent_payment_amount,
                'payment_cycle' => $payment_cycle,
                'company_name' => $retailor_company_name,
                'realtor_name' => $retailor_name,
                'realtor_bank' => $retailor_bank,
                'realtor_account_name' => $retailot_acc_name,
                'realtor_account' => $retailot_acc_no,
                'realtor_account_bsb' => $retailot_acc_bsb,
                'lcd' => $this->input->post('lcd'),
                'led' => $this->input->post('led'),
                'internet' => $this->input->post('internet'),
                'phone' => $this->input->post('phone'),
                'ele_comp' => $this->input->post('ele_comp'),
                'ele_account' => $this->input->post('ele_account'),
                'gas_comp' => $this->input->post('gas_comp'),
                'gas_account' => $this->input->post('gas_account'),
                'worksite_id' => $this->input->post('worksite_id'),
                'langlord' => $this->input->post('langlord'),
                'rent_bound' => $this->input->post('rent_bound'),
                'created' => date('Y-m-d'),
                'status' => $this->input->post('status'),
                'isp' => $this->input->post('isp'),
                'isp_username' => $this->input->post('isp_username'),
                'isp_password' => $this->input->post('isp_pass'),
                'electricity_meter' => $this->input->post('electricity_meter'),
                'electricity_co' => $this->input->post('electricity_co'),
                'water_utility_company' => $this->input->post('water_utility_company'),
                'water_account' => $this->input->post('water_account'),
                'water_meter' => $this->input->post('water_meter'),
                'notes' => $this->input->post('notes'),
                'water_utility_contact' => $this->input->post('water_utility_contact'),
                'insurance' => $this->input->post('insurance'),
                'insurance_company' => $this->input->post('insurance_company'),
                'insurance_policy' => $this->input->post('insurance_policy'),
            );
            $this->house_model->houseRegistration($data);
            $this->session->set_flashdata('smessage', 'House Successfully added');
            redirect($redirect);
        }
    }

    public function editHouse() {
        $id = $this->uri->segment(3);
        $this->loginCheck("houses/editHouse/" . $id);
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $data['users'] = $this->house_model->get_tenants();
        $house_detail = $this->house_model->houseDetail($id);
        $data['worksites'] = $this->User->get_worksites();
        $data['house_detail'] = $house_detail;
        $data['title'] = "Edit House";
		$data['retailor_bank'] = $this->User->get_banks();
        //print_r($house_detail);
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('payment_cycle', 'Payment cycle', 'trim|required');
        $this->form_validation->set_rules('rent_payment_amount', 'Rent Payment Amount', 'trim|required|numeric');
        //$this->form_validation->set_rules('rent', 'Rent per week', 'trim|required|numeric');
        $this->form_validation->set_rules('retailor_company_name', 'Realtor Company name', 'trim|required');
        $this->form_validation->set_rules('retailor_name', 'Realtor name', 'trim|required');
        $this->form_validation->set_rules('retailor_bank', 'Realtor bank', 'trim|required');
		$this->form_validation->set_rules('retailot_acc_name', 'Realtor account name', 'trim|required');
        $this->form_validation->set_rules('retailot_acc_no', 'Realtor account number', 'required|numeric');
        $this->form_validation->set_rules('retailot_acc_bsb', 'Realtor account BSB', 'trim|required');
        $this->form_validation->set_rules('rent_bound', 'Rent bond amount', 'numeric');
        $this->form_validation->set_rules('worksite_id', 'Worksite', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'houses/editHouse', $data);
        } else {
            if ($_POST) {
                $address = $this->input->post('address');
                $rent_payment_amount = $this->input->post('rent_payment_amount');
                $payment_cycle = $this->input->post('payment_cycle');
                $telnat = $this->input->post('enployee_id');
                $retailor_company_name = $this->input->post('retailor_company_name');
                $retailor_name = $this->input->post('retailor_name');
                $retailor_bank = $this->input->post('retailor_bank');
				$retailot_acc_name = $this->input->post('retailot_acc_name');
                $retailot_acc_no = $this->input->post('retailot_acc_no');
                $retailot_acc_bsb = $this->input->post('retailot_acc_bsb');

                $data = array(
                    'address' => $address,
                    'rent_payment_amount' => $rent_payment_amount,
                    'payment_cycle' => $payment_cycle,
                    /* 'tenant_id'   =>$telnat, */
                    'company_name' => $retailor_company_name,
                    'realtor_name' => $retailor_name,
                    'realtor_bank' => $retailor_bank,
                    'realtor_account_name' => $retailot_acc_name,
                    'realtor_account' => $retailot_acc_no,
                    'realtor_account_bsb' => $retailot_acc_bsb,
                    'lcd' => $this->input->post('lcd'),
                    'led' => $this->input->post('led'),
                    'internet' => $this->input->post('internet'),
                    'phone' => $this->input->post('phone'),
                    'ele_comp' => $this->input->post('ele_comp'),
                    'ele_account' => $this->input->post('ele_account'),
                    'gas_comp' => $this->input->post('gas_comp'),
                    'gas_account' => $this->input->post('gas_account'),
                    'langlord' => $this->input->post('langlord'),
                    'rent_bound' => $this->input->post('rent_bound'),
                    'worksite_id' => $this->input->post('worksite_id'),
                    'created' => date('Y-m-d'),
                    'isp' => $this->input->post('isp'),
                    'isp_username' => $this->input->post('isp_username'),
                    'isp_password' => $this->input->post('isp_pass'),
                    'electricity_meter' => $this->input->post('electricity_meter'),
                    'electricity_co' => $this->input->post('electricity_co'),
                    'water_utility_company' => $this->input->post('water_utility_company'),
                    'water_account' => $this->input->post('water_account'),
                    'water_meter' => $this->input->post('water_meter'),
                    'water_utility_contact' => $this->input->post('water_utility_contact'),
                    'insurance' => $this->input->post('insurance'),
                    'insurance_company' => $this->input->post('insurance_company'),
                    'insurance_policy' => $this->input->post('insurance_policy'),
                    'notes' => $this->input->post('notes'),
                    'status' => $this->input->post('status')
                );
                $this->house_model->edithouse($data, $id);
                $this->session->set_flashdata('smessage', 'House Successfully updated');
                redirect('/houses/index/');
            }
        }
    }

    public function deleteHouse() {
        $id = $this->uri->segment(3);
        $this->loginCheck("houses/deleteHouse/" . $id);
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
//            $house_detail = $this->house_model->houseDetail($id);
//            if(file_exists('house_images/'.$house_detail[0]['image'])){
//                unlink('house_images/'.$house_detail[0]['image']);}
        $this->house_model->deletehouse($id);
        $this->house_model->deletehouseholds($id);
        $this->session->set_flashdata('smessage', 'House Successfully deleted');
        redirect('/houses/');
    }

    public function activateallHouse() {
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $id = $this->uri->segment(3);
        $this->house_model->activatehouse($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one House');
            redirect('/houses/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->house_model->activatehouse($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Houses successfully activated');
        redirect('/houses/');
    }

    public function deactivateallHouse() {
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $id = $this->uri->segment(3);
        $this->house_model->activatehouse($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one House');
            redirect('/houses/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->house_model->deactivatehouse($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Houses successfully deactivated');
        redirect('/houses/');
    }

    public function deleteallHouse() {
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $id = $this->uri->segment(3);
        $this->house_model->activatehouse($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one House');
            redirect('/houses/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->house_model->deletehouse($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Houses successfully deleted');
        redirect('/houses/');
    }

    public function deactivateHouse() {
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $id = $this->uri->segment(3);
        $this->house_model->deactivatehouse($id);
        $this->session->set_flashdata('smessage', 'House successfully deactivated');
        redirect('/houses/');
    }

    public function activateHouse() {
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $id = $this->uri->segment(3);
        $this->house_model->activatehouse($id);
        $this->session->set_flashdata('smessage', 'House successfully activated');
        redirect('/houses/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
