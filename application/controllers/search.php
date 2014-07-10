<?php

class Search extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
        $this->load->model('house_model');
        $this->load->model('user_model', 'User', true);
        $this->load->model('rent_model');
        $this->load->model('search_model');
        $this->load->model('car_model');
        $this->load->model('welcome_model', 'Welcome');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('Jquery_pagination');

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

    public function index() {
        $this->loginCheck("search/index");
        $keyword = trim($this->input->post('keyword'));
        $array = explode(" ", $keyword);
        $this->session->set_userdata('keyword', $array);
        if ($array[0] == 'add' or (in_array('road', $array) or in_array('rd', $array) or in_array('street', $array) or in_array('st', $array) or in_array('ave', $array) or in_array('avenue', $array) or in_array('pde', $array) or in_array('parade', $array) or in_array('cls', $array) or in_array('close', $array) or in_array('blvd', $array) or in_array('boulevarde', $array) )) {
            $this->house();
            //            echo "search houses from houses table";
        } else if ((count($array) == 1) and is_numeric($array[0]) and strlen($array[0]) == 5) {
            $this->users();
//            echo "employees only with admin id";
        } else if ($array[0] == 'emp') {
            $this->users();
//            echo "employees only with contact no";
        } else if ($array[0] == 'eid' and (count($array) == 2) and is_numeric($array[1]) and (strlen($array[1]) == 5)) {
            $this->users();
//            echo "employees only with contact no";
        } else if ($array[0] == 'id' and (count($array) == 2) and is_numeric($array[1]) and (strlen($array[1]) == 5)) {
            $this->users();
//            echo "employees only with contact no";
        } elseif ((count($array) == 1) and $array[0] <> 'rent' and (in_array('road', $array) or in_array('rd', $array) or in_array('street', $array) or in_array('st', $array) or in_array('ave', $array) or in_array('avenue', $array) or in_array('pde', $array) or in_array('parade', $array) or in_array('cls', $array) or in_array('close', $array) or in_array('blvd', $array) or in_array('boulevarde', $array))) {
//                echo "search houses from houses table";

            $this->house();
        } else if (count($array) >= 2 and ($array[0] == 'pay' OR $array[0] == 'wage')) {
//            echo "Search from batch payment";
            $this->batchpayment();
        } else if ((count($array) == 2) and !is_numeric($array[0]) and !is_numeric($array[1]) and $array[0] <> 'rent' and ($array[0] <> 'app')) {
            if ($array[0] == 'car' or $array[0] == 'cars') {
                $this->cars();
//                echo "search car";
            } elseif ((in_array('road', $array) or in_array('rd', $array) or in_array('street', $array) or in_array('st', $array) or in_array('ave', $array) or in_array('avenue', $array) or in_array('pde', $array) or in_array('parade', $array) or in_array('cls', $array) or in_array('close', $array) or in_array('blvd', $array) or in_array('boulevarde', $array))) {
//                echo "search houses from houses table";
                $this->house();
            } else if ($array[0] == 'emp') {
                $this->users();
            } else {
                $this->noMatches();
            }
        } else if ((count($array) == 2) and !is_numeric($array[0]) and is_numeric($array[1]) and ($array[0] == 'car' or $array[0] == 'cars')) {
            $this->cars();
//            echo "search car";
        } else if ((count($array) == 3) and !is_numeric($array[0]) and ($array[0] == 'car' or $array[0] == 'cars')) {
            $this->cars();
        } else if ((count($array) == 3) and !is_numeric($array[0]) and ($array[0] == 'emp' or $array[0] == 'emp')) {
            $this->users();
        } else if ((count($array) == 3) and is_numeric($array[0]) and (strlen($array[0]) < 4) and (in_array('road', $array) or in_array('rd', $array) or in_array('street', $array) or in_array('st', $array) or in_array('ave', $array) or in_array('avenue', $array) or in_array('pde', $array) or in_array('parade', $array) or in_array('cls', $array) or in_array('close', $array) or in_array('blvd', $array) or in_array('boulevarde', $array) )) {
//            echo "Search houses from house table";
            $this->house();
        } else if ((count($array) == 1) and $array[0] <> 'rent' and  !is_numeric($array[0]) ) {
            $address1 = explode("/", $array[0]);
            $address2 = explode("-", $array[0]);
            if ((is_numeric($address1[0]) AND strlen($address1[0]) < 4) OR (count($address2) == 2 AND is_numeric($address2[0]) AND strlen($address2[0]) < 4)) {
//                echo "Search houses from house table";
                $this->house();
            } else {
                $this->noMatches();
            }
        } else if ((count($array) == 2) and $array[0] <> 'rent' and (in_array('road', $array) or in_array('rd', $array) or in_array('street', $array) or in_array('st', $array) or in_array('ave', $array) or in_array('avenue', $array) or in_array('pde', $array) or in_array('parade', $array) or in_array('cls', $array) or in_array('close', $array) or in_array('blvd', $array) or in_array('boulevarde', $array) )) {
            $address1 = explode("/", $array[0]);
            $address2 = explode("-", $array[0]);
            if ((count($address1) == 2 AND is_numeric($address1[0]) AND strlen($address1[0]) < 4) OR (count($address2) == 2 AND is_numeric($address2[0]) AND strlen($address2[0]) < 4)) {
//                echo "Search houses from house table";
                $this->house();
            } else if (strlen($array[0]) < 4 AND is_numeric($array[0])) {
//                echo "Search houses from house table";
                $this->house();
            } else {
                $this->noMatches();
            }
        } else if (count($array) == 2 and ($array[0] == 'pay' OR $array[0] == 'wage') and is_numeric($array[1]) and (strlen($array[1]) > 4)) {
//            echo "Search from batch payment";
            $this->batchpayment();
        } else if ($array[0] == 'app' and (in_array('app', $array) OR in_array('m', $array) OR in_array('f', $array) OR in_array('male', $array) OR in_array('female', $array))) {
//            echo "Search from applicant list";
            $this->applicant();
        } else if ((count($array) == 3 OR count($array) == 2) and $array[0] == 'rent' and ((in_array('road', $array) or in_array('rd', $array) or in_array('street', $array) or in_array('st', $array) or in_array('ave', $array) or in_array('avenue', $array) or in_array('pde', $array) or in_array('parade', $array) or in_array('cls', $array) or in_array('close', $array) or in_array('blvd', $array) or in_array('boulevarde', $array) ) OR (strlen($array[1]) < 4 AND is_numeric($array[1])))) {

            $address1 = explode("/", $array[1]);
            $address2 = explode("-", $array[1]);
            if ((count($address1) == 2 AND is_numeric($address1[0]) AND strlen($address1[0]) < 4) OR (count($address2) == 2 AND is_numeric($address2[0]) AND strlen($address2[0]) < 4)) {
//                echo "Search rent from house table";
                $this->rent();
            } else if (strlen($array[1]) < 4 AND is_numeric($array[1])) {
//                echo "Search rent from house table";
                $this->rent();
            } else if (!is_numeric($array[1])) {
//                echo "Search rent from house table";
                $this->rent();
            } else {
                $this->noMatches();
            }
        } else if ((count($array) == 4) and $array[0] == 'rent' and is_numeric($array[1]) and (strlen($array[1]) < 4) and (in_array('road', $array) or in_array('rd', $array) or in_array('street', $array) or in_array('st', $array) or in_array('ave', $array) or in_array('avenue', $array) or in_array('pde', $array) or in_array('parade', $array) or in_array('cls', $array) or in_array('close', $array) or in_array('blvd', $array) or in_array('boulevarde', $array) )) {
//            echo "Search rent from house table";
            $this->rent();
        } else {
            $this->noMatches();
        }
    }

    function ajax_users($status = 0, $worksite_id = 0, $time, $offset = 0) {
        $this->load->library('Jquery_pagination');
        if ($status == 'worksite')
            $config['base_url'] = site_url('search/ajax_users/worksite/' . $worksite_id . "/" . $time . "/");
        else
            $config['base_url'] = site_url('search/ajax_users/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        if ($status == 'worksite')
            $config['uri_segment'] = 6;
        else
            $config['uri_segment'] = 3;
        $config['total_rows'] = $this->search_model->countUsers('normal_user', $worksite_id, 'all');
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['users'] = $this->search_model->usersList($config['per_page'], $offset, "normal_user", $worksite_id, 'all');
        $this->load->view('search/user/userListAjax', $data);
    }

    public function users($status = 0, $worksite_id = 0, $time = 0, $offset = 0) {
        $this->loginCheck("users/index/" . $status . "/" . $worksite_id . "/" . $time . "/" . $offset);
        ob_start();
        $this->ajax_users($status, $worksite_id, $time, $offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Contractors Search Results";
        $user_detail = $this->Welcome->fullUserDetail($this->session->userdata('userId'));
        $data['role'] = $user_detail['role'];
        $data['ajax_content'] = '<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'search/user/usersList', $data);
    }

    public function cars() {
        $this->loginCheck("carManage/index");
        $config['base_url'] = base_url() . "search/cars";
        $config['total_rows'] = $this->search_model->countCars();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $cars = $this->search_model->carList($config['per_page'], $this->uri->segment(3));
        $data['title'] = "Search Results From Cars List";
        $this->pagination->initialize($config);
        $data['cars'] = $cars;
        $this->template->load('front', 'carManage/index', $data);
    }

    public function house($status = 0, $worksite_id = 0, $offset = 0) {
        $this->loginCheck("houses/index/" . $status . "/" . $worksite_id . "/" . $offset);
        ob_start($offset = 0);
        $this->ajax_houses($status, $worksite_id, $offset);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Search Results From Houses List";
        $data['offset'] = $offset;
        $data['worksite_id'] = $worksite_id;
        $data['status'] = $status;
        $data['ajax_content'] = '<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'houses/index', $data);
    }

    function ajax_houses($status = 0, $worksite_id = 0, $offset = 0) {
        $this->load->library('Jquery_pagination');
        if ($status == 'worksite')
            $config['base_url'] = site_url('search/ajax_houses/worksite/' . $worksite_id . "/");
        else
            $config['base_url'] = site_url('search/ajax_houses/');
        $config['div'] = '#middle-content';
        $limit = $this->limit;
        if ($status == 'worksite')
            $config['uri_segment'] = 5;
        else
            $config['uri_segment'] = 3;
        $config['total_rows'] = $this->search_model->counthouses($worksite_id);
        if ($this->input->get('order') <> NULL) {
            $this->session->set_userdata('rent_due_date', $this->input->get('order'));
        }
        $config['per_page'] = $limit;
        $config['loadingId'] = 'loading-image';
        $this->jquery_pagination->initialize($config);
        $data['title'] = "Houses List";
        $data['houses'] = $this->search_model->housesList($config['per_page'], $this->uri->segment($config['uri_segment']), "normal_house", $worksite_id);
        $data['offset'] = $offset;
        $data['worksite_id'] = $worksite_id;
        $data['status'] = $status;
        $this->load->view('houses/ajaxHouses', $data);
    }

    public function applicant() {
        $this->loginCheck("applicant/index");
        $config['base_url'] = base_url() . "search/applicant";
        $config['total_rows'] = $this->search_model->countApplicant();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $applicant = $this->search_model->powerusersList($config['per_page'], $this->uri->segment(3), "normal_poweruser");
        $data['title'] = "Applicants List";
        $this->pagination->initialize($config);
        $data['applicant'] = $applicant;
        $this->template->load('front', 'applicant/index', $data);
    }

    public function batchpayment() {
        $config['base_url'] = base_url() . "search/batchpayment";
        $config['total_rows'] = $this->search_model->countPaymentsEmployee();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $payment = $this->search_model->paymentListEmployee($config['per_page'], $this->uri->segment(3));
        $data['title'] = "Payments List";
        $this->pagination->initialize($config);
        $data['payment'] = $payment;
        $this->template->load('front', 'search/batchPayment', $data);
    }

    public function rent($offset = 0) {
        $this->loginCheck("rent/index/" . $offset);
        ob_start();
        $this->ajax_rent(0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['ajax_content'] = '<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $data['title'] = "Rent Payment List";
        $this->template->load('front', 'rent/index', $data);
    }

    function ajax_rent($offset = 0) {
        $config['base_url'] = site_url('search/ajax_rent/');
        $config['div'] = '#middle-content';
        $config['total_rows'] = $this->search_model->countRent();
        $config['loadingId'] = 'loading-image';
        if ($this->session->userdata('record') == '400') {
            $config['per_page'] = 400;
            $data['rents'] = $this->search_model->rentListLatest($config['per_page'], $offset);
        } else {
            $config['per_page'] = $this->limit;
            $data['rents'] = $this->search_model->rentList($config['per_page'], $offset);
        }
        $this->jquery_pagination->initialize($config);
        $data['title'] = "Rent Payment List";
        $this->load->view('rent/ajax_rent', $data);
    }

//        $config['base_url'] = base_url() . "search/index";
//        $config['total_rows'] = $this->house_model->countCompany();
//        $config['per_page'] = $this->limit;
//        $config['uri_segment'] = 3;
//        $company = $this->house_model->companyList($config['per_page'], $this->uri->segment(3));
//        $data['title'] = "Companies List";
//        $this->pagination->initialize($config);
//        $data['company'] = $company;
//        $this->template->load('front', 'company/index', $data);
    function noMatches() {
        $data['title'] = "No Matches Found";
        $this->template->load('front', 'search/noRecord', $data);
    }

}
