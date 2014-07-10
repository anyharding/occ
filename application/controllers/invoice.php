<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
        $this->load->model('welcome_model', 'Welcome', true);
        $this->load->model('user_model', 'User', true);
        $this->load->model('household_model');
        $this->load->model('house_model');
        $this->load->model('payment_model');
        $this->load->model('admin_model');
        $this->load->model('rent_model');
        $this->load->library('pagination');
        $this->load->library('Jquery_pagination');
//        if (!$this->session->userdata('userId')) {
//            redirect('/');
//        }

        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
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
        $this->loginCheck("invoice/index/");
        if ($this->uri->segment(3) <> NULL) {
            $segment3 = $this->uri->segment(3);
        } else {
            $segment3 = 'all';
        }
        if ($this->uri->segment(4) <> NULL) {
            $segment4 = $this->uri->segment(4);
        } else {
            $segment4 = 'all';
        }
        $config['base_url'] = base_url() . "users/index/" . $segment3 . '/' . $segment4;
        $data['worksites'] = $this->User->get_worksites();
        $config['total_rows'] = $this->User->countUsers('normal_user', $this->uri->segment(3), $this->uri->segment(4));
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 5;
        $users_list = $this->User->usersList($config['per_page'], $this->uri->segment(5), "normal_user", $this->uri->segment(3), $this->uri->segment(4));
        $data['title'] = "Contractors List";
        $this->pagination->initialize($config);
        $data['users'] = $users_list;
        $this->template->load('front', 'invoice/invoice', $data);
    }

    public function generateInvoice() {
        $this->loginCheck("invoice/generateInvoice/");
        $data['worksites'] = $this->User->get_worksites();
        $data['companies'] = $this->User->companies();
        $data['title'] = "Generate Invoice";
        $this->template->load('front', 'invoice/generateInvoice', $data);
    }

    function getInvoice($employee_id) {
        $data['user_detail'] = $this->Welcome->fullUserDetail($employee_id);
        $data['payment'] = $this->payment_model->batchPaymentDetail($employee_id);
//        print_r($data['payment']);
        $this->load->view('invoice/invoice', $data);
    }

    function submitInvoice() {
        $data = array(
            'employee_id' => $this->input->post('employee'),
            'company_id' => $this->input->post('company'),
            'payment_id' => $this->input->post('payment_id'),
            'comment' => $this->input->post('comment'),
            'description' => $this->input->post('description'),
            'prize' => $this->input->post('prize'),
            'invoice_date' => time(),
            'current_date' => time()
        );
        $this->payment_model->editPayment(array('invoiced' => 'yes'), $this->input->post('payment_id'));
        $id = $this->payment_model->addInvoice($data);
        redirect('invoice/viewInvoice/' . $id . "/" . md5($id));
    }

    function ajax_listinvoices($worksite = 0, $offset = 0) {
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('invoice/ajax_listinvoices/' . $worksite . "/");
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->payment_model->countInvoicess($worksite);
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $data['worksites'] = $this->User->get_worksites();
        $this->jquery_pagination->initialize($config);
        $data['invoice'] = $this->payment_model->invoicesList($worksite, $config['per_page'], $offset);
        $this->load->view('invoice/ajax_listinvoices', $data);
    }

    public function listinvoices($worksite = 0, $offset = 0) {
        $this->loginCheck("invoice/listinvoices/" . $worksite . "/");
        ob_start();
        $this->ajax_listinvoices($worksite, $offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Invoices List";
        $data['ajax_content'] = $initial_content;//'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'invoice/listinvoices', $data);
    }

    function getCompanyAddress($id) {
        $data = $this->User->getCompanyAddress($id);
        if (!empty($data))
            echo json_encode($data);
        else
            return "0";
    }

    function viewInvoice($id, $code) {
        $this->loginCheck("invoice/viewInvoice/" . $id . "/" . $code);
        $invoice = $this->payment_model->getinvoice($id);
        $data['payment'] = $invoice;
        $data['title'] = 'View Invoice Details';
        $this->template->load('front', 'invoice/view', $data);
    }

    public function getWorksiteRateAndName($id, $id1 = NULL) {
        if ($id and ($id <> 'all')) {
            $rate = $this->User->getWorksiteRateAndName($id);
            echo '<option value="">Select Site Rate Name</option>';
            for ($i = 1; $i < 10; $i++) {
                echo "<option value='" . $rate['site_rate' . $i] . "||" . $rate['site_rate_name' . $i] . "||" . $i . "'";
                if ($this->uri->segment(4) == $i) {
                    echo 'selected="selected"';
                }

                echo " >" . $rate['site_rate_name' . $i] . "</otion>";
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */