<?php

class Household extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
        $this->load->model('household_model');
        $this->load->model('rent_model');
        $this->load->model('welcome_model', 'Welcome');
        $this->load->model('user_model', 'User');
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

    function ajax_index($segment3 = "all", $segment4 = "all", $offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url("household/ajax_index/" . $segment3 . "/" . $segment4 . "/");
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['uri_segment'] = 5;
        $config['total_rows'] = $this->household_model->counthouses('normal_house', $segment3);
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['worksites'] = $this->User->get_worksites();
        $data['household'] = $this->household_model->housesList($config['per_page'], $offset, "normal_house", $segment3);
        $this->load->view('household/ajax_index', $data);
    }

    public function index($segment3 = "all", $segment4 = "all", $offset = 0) {
        $this->loginCheck("household/index/" . $status . "/" . $worksite_id . "/" . $time . "/" . $offset);
        ob_start();
        $this->ajax_index($segment3, $segment4, $offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Household List";
        $data['ajax_content'] = $initial_content;//'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'household/index', $data);
    }

    public function addHousehold() {
        $this->loginCheck("household/addHousehold/");
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $redirect = '/household/';
        $data['category'] = $this->household_model->get_category();
        $data['get_houses'] = $this->household_model->get_houses();
        $data['title'] = "Add Household";
        $this->form_validation->set_rules('category', 'Select Household Category', 'required');
        $this->form_validation->set_rules('contact', 'Suppliers Contact Number', 'trim|required|numeric');
        $this->form_validation->set_rules('time', 'Purchased Date', 'trim|required');

        $this->form_validation->set_rules('shop', 'Supplier Name', 'trim|required');

        $this->form_validation->set_rules('receipt', 'Receipt Number', 'trim|required');
        $this->form_validation->set_rules('house', 'Select House', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'household/addHouseHold', $data);
        } else {
            if ($_POST) {

                $category = $this->input->post('category');
                $contact = $this->input->post('contact');
                $time = $this->input->post('time');
                $shop = $this->input->post('shop');
                $site = $this->input->post('site');
                $other = $this->input->post('other');
                $receipt = $this->input->post('receipt');
                $house = $this->input->post('house');

                $data = array(
                    'category' => $category,
                    'contact_no' => $contact,
                    'purchase_time' => $time,
                    'shop_name' => $shop,
                    'site' => $site,
                    'other' => $other,
                    'purchase_receipt' => $receipt,
                    'description' => $this->input->post('des'),
                    'house_id' => $house,
                    'date' => date('Y-m-d'),
                    'status' => '1'
                );
                $this->household_model->householdRegistration($data);
                $this->session->set_flashdata('smessage', 'Household Successfully added');
                redirect($redirect);
            }
        }
    }

    public function viewHousehold($id) {
        $this->loginCheck("household/viewHousehold/" . $id);
        if (!$this->session->userdata('userId')) {
            redirect('welcome/');
        }
        $data['category'] = $this->household_model->getSelectedCategory($id);
        $household_detail = $this->household_model->householdDetail($id);
        $data['household_detail'] = $household_detail;
        $data['title'] = "View Household";
        $this->template->load('front', 'household/viewHousehold', $data);
    }

    public function editHousehold() {
        $id = $this->uri->segment(3);
        $this->loginCheck("household/editHousehold/" . $id);
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $data['get_houses'] = $this->household_model->get_houses();
        $data['category'] = $this->household_model->get_category();
        $household_detail = $this->household_model->householdDetail($id);
        $data['household_detail'] = $household_detail;
        $data['title'] = "Edit Household";

        $this->form_validation->set_rules('category', 'Select Household Category', 'required');
        $this->form_validation->set_rules('contact', 'Suppliers Contact Number', 'trim|required|numeric');
        $this->form_validation->set_rules('time', 'Purchased Date', 'trim|required');

        $this->form_validation->set_rules('shop', 'Supplier Name', 'trim|required');

        $this->form_validation->set_rules('receipt', 'Receipt Number', 'trim|required');
        $this->form_validation->set_rules('house', 'Select House', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'household/editHouseHold', $data);
        } else {
            if ($_POST) {
                $category = $this->input->post('category');
                $contact = $this->input->post('contact');
                $time = $this->input->post('time');
                $shop = $this->input->post('shop');
                $site = $this->input->post('site');
                $other = $this->input->post('other');
                $receipt = $this->input->post('receipt');
                $house = $this->input->post('house');

                $data = array(
                    'category' => $category,
                    'contact_no' => $contact,
                    'purchase_time' => $time,
                    'shop_name' => $shop,
                    'site' => $site,
                    'other' => $other,
                    'purchase_receipt' => $receipt,
                    'description' => $this->input->post('des'),
                    'house_id' => $house,
                    'date' => date('Y-m-d'),
                    'status' => '1'
                );
                $this->household_model->edithouse($data, $id);
                $this->session->set_flashdata('smessage', 'Household Successfully updated');
                redirect('/household/index/');
            }
        }
    }

    public function deleteHousehold() {
        $id = $this->uri->segment(3);
        $this->loginCheck("household/deleteHousehold/" . $id);
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $this->household_model->deletehouse($id);
        $this->session->set_flashdata('smessage', 'Household Successfully deleted');
        redirect('/household/');
    }

    public function activateallHousehold() {
        $id = $this->uri->segment(3);
        $this->loginCheck("household/activateallHousehold/" . $id);
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $this->household_model->activatehouse($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Household');
            redirect('/household/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->household_model->activatehouse($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Households successfully activated');
        redirect('/household/');
    }

    public function deactivateallHousehold() {
        $id = $this->uri->segment(3);
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $this->household_model->activatehouse($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Household');
            redirect('/household/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->household_model->deactivatehouse($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Households successfully deactivated');
        redirect('/household/');
    }

    public function deleteallHousehold() {
        $id = $this->uri->segment(3);
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $this->household_model->activatehouse($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Household');
            redirect('/household/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->household_model->deletehouse($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Households successfully deleted');
        redirect('/household/');
    }

    public function deactivateHousehold() {
        $id = $this->uri->segment(3);
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $this->household_model->deactivatehouse($id);
        $this->session->set_flashdata('smessage', 'Household successfully deactivated');
        redirect('/household/');
    }

    public function activateHousehold() {
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $id = $this->uri->segment(3);
        $this->household_model->activatehouse($id);
        $this->session->set_flashdata('smessage', 'Household successfully activated');
        redirect('/household/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
