<?php

class Payment extends CI_Controller {

    private $limit = 20;
    private $uri_segment = 3;

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        $this->load->model('payment_model');
        $this->load->model('rent_model');
        $this->load->model('household_model');
        $this->load->model('welcome_model', 'Welcome');
        $this->load->model('user_model', 'User');
        $this->load->library('pagination');
        $this->load->library('jquery_pagination');
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
        $config['base_url'] = base_url() . "payment/index";
        $config['total_rows'] = $this->payment_model->countPayments();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $payment = $this->payment_model->paymentList($config['per_page'], $this->uri->segment(3));
        $data['title'] = "Payments List";
        $this->pagination->initialize($config);
        $data['payment'] = $payment;
        $this->template->load('front', 'payment/index', $data);
    }

    public function index($status = 0, $worksite_id = 0, $time = 0, $offset = 0) {
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        $this->loginCheck("payment/index/" . $status . "/" . $worksite_id . "/" . $time . "/" . $offset);
        ob_start();
        $this->ajax_payment($status, $worksite_id, $time, $offset);
        $data['title'] = "List Batch Payments";
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $data['title'] = "Payments List";
        $this->template->load('front', 'payment/index', $data);
    }

    function ajax_payment($status = 0, $worksite_id = 0, $time = 0, $offset = 0) {
        $config['base_url'] = site_url('payment/ajax_payment/worksite/' . $worksite_id . "/" . $time . "/");
        $config['div'] = '#middle-content';
        $config['uri_segment'] = 6;
        $config['total_rows'] = $this->payment_model->countBatchPayments($worksite_id);
        $config['loadingId'] = 'loading-image';
        $config['per_page'] = $this->limit;
        $data['worksites'] = $this->User->get_worksites();
        $data['payment'] = $this->payment_model->batchPaymentList($config['per_page'], $offset, $worksite_id);
        $data['title'] = "Payments List";
        $this->jquery_pagination->initialize($config);
        $this->load->view('payment/ajax_payment', $data);
    }

//    public function BatchPaymentDetail($offset = 0) {
//        ob_start();
//        $this->ajax_payment(0);
//        $data['title'] = "List Batch Payments";
//        $initial_content = ob_get_contents();
//        ob_end_clean();
//        $data['ajax_content'] = '<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
//        $this->template->load('front', 'payment/index', $data);
//    }
//
//    function ajax_BatchPaymentDetail($offset = 0) {
//        $config['base_url'] = site_url('payment/ajax_payment/');
//        $config['div'] = '#middle-content';
//        $config['total_rows'] = $this->payment_model->countPayments();
//        $config['loadingId'] = 'loading-image';
//        $config['per_page'] = $this->limit;
//        $data['payment'] = $this->payment_model->paymentList($config['per_page'], $offset);
//        $this->jquery_pagination->initialize($config);
//        $this->load->view('payment/ajax_payment', $data);
//    }

    public function visaExpiryCheck1() {
        if (!$this->session->userdata('userId')) {
            redirect('/');
        }
        $data['title'] = "Visa Expiry Check Management";
        $config['base_url'] = base_url() . "payment/visaExpiryCheck/" . $this->uri->segment(3) . "/";
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 4;
        if ($this->uri->segment(3) == '14days') {
            $config['total_rows'] = $this->payment_model->countUsers('14days');
            $data['users'] = $this->payment_model->getUsers('14days', $config['per_page'], $this->uri->segment(5));
        }
        if ($this->uri->segment(3) == '30days') {
            $config['total_rows'] = $this->payment_model->countUsers('30days');
            $data['users'] = $this->payment_model->getUsers('30days', $config['per_page'], $this->uri->segment(5));
        }
        if ($this->uri->segment(3) == '60days') {
            $config['total_rows'] = $this->payment_model->countUsers('60days');
            $data['users'] = $this->payment_model->getUsers('60days', $config['per_page'], $this->uri->segment(5));
        }
        $this->pagination->initialize($config);
        $this->template->load('front', 'payment/visaExpiryCheck', $data);
    }

    public function visaExpiryCheck($offset = 0) {
        $this->loginCheck("payment/visaExpiryCheck/" . $offset);
        ob_start();
        $this->ajax_visaExpiryCheck(0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['title'] = "Visa Expiry Check Management";
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $this->template->load('front', 'payment/visaExpiryCheck', $data);
    }

    function ajax_visaExpiryCheck($offset = 0) {
        $config['base_url'] = site_url('payment/ajax_visaExpiryCheck/');
        $config['div'] = '#middle-content';
        $config['loadingId'] = 'loading-image';
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        if ($this->session->userdata('visaDays') == '14days') {
            $config['total_rows'] = $this->payment_model->countUsers('14days');
            $data['users'] = $this->payment_model->getUsers('14days', $config['per_page'], $offset);
        }
        if ($this->session->userdata('visaDays') == '30days') {
            $config['total_rows'] = $this->payment_model->countUsers('30days');
            $data['users'] = $this->payment_model->getUsers('30days', $config['per_page'], $offset);
        }
        if ($this->session->userdata('visaDays') == '60days') {
            $config['total_rows'] = $this->payment_model->countUsers('60days');
            $data['users'] = $this->payment_model->getUsers('60days', $config['per_page'], $offset);
        }
        if ($this->session->userdata('visaDays') == "" OR $this->session->userdata('visaDays') == NULL) {
            $config['total_rows'] = $this->payment_model->countUsers('0');
            $data['users'] = $this->payment_model->getUsers('0', $config['per_page'], $offset);
        }
        $data['title'] = "Visa Expiry Check Management";
        $this->jquery_pagination->initialize($config);
        $this->load->view('payment/ajax_visaExpiryCheck', $data);
    }

    public function day_14() {
        $this->session->set_userdata('visaDays', '14days');
        $this->ajax_visaExpiryCheck(0);
    }

    public function day_30() {
        $this->session->set_userdata('visaDays', '30days');
        $this->ajax_visaExpiryCheck(0);
    }

    public function day_60() {
        $this->session->set_userdata('visaDays', '60days');
        $this->ajax_visaExpiryCheck(0);
    }

    public function deletePayment() {
        $id = $this->uri->segment(3);
        $this->loginCheck("payment/deletePayment/" . $id);
        $this->payment_model->deleteBatchPayment($id);
        $this->session->set_flashdata('smessage', 'Payment Details Successfully deleted');
        redirect('/payment/');
    }

    public function addPayment() {
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        $this->loginCheck("payment/addPayment/");
        $data['title'] = "Add payment Amount";
        $this->form_validation->set_rules('employee_id', 'Contractor', 'trim|required');
        $this->form_validation->set_rules('hourly_rate', 'Hourly Rate', 'trim|numeric|required');
        $this->form_validation->set_rules('hours', 'Hours Worked', 'trim|numeric|required');
        $this->form_validation->set_rules('gst', 'Gross Wage Amount', 'trim|numeric');
        $this->form_validation->set_rules('overtime', 'Overtime', 'trim|numeric');
        $this->form_validation->set_rules('net_payment', 'Net Payment Amount', 'trim|numeric');
        $this->form_validation->set_rules('rent_deduction', 'Rent Deduction', 'trim|numeric');
        $this->form_validation->set_rules('transport_deduction', 'Transport Deduction', 'trim|numeric');
        $this->form_validation->set_rules('other_deduction', 'Other Deductions', 'trim|numeric');
        $this->form_validation->set_rules('total_payment_amount', 'Total Payment Amount ', 'trim');
        if ($this->form_validation->run() == FALSE) {
            $data['users'] = $this->payment_model->get_tenants();
            $this->template->load('front', 'payment/addPayment', $data);
        } else {
            $data = array(
                'employee_id' => $this->input->post('employee_id'),
                'hourly_rate' => $this->input->post('hourly_rate'),
                'hours' => $this->input->post('hours'),
                'gross_amount' => $this->input->post('gst'),
                'overtime' => $this->input->post('overtime'),
                'net_payment' => $this->input->post('net_payment'),
                'rent_deduction' => $this->input->post('rent_deduction'),
                'transport_deduction' => $this->input->post('transport_deduction'),
                'other_deduction' => $this->input->post('other_deduction'),
                'total_payment_amount' => $this->input->post('total_payment_amount'),
                'other_payments' => $this->input->post('other_payments'),
                'date' => time()
            );
            $this->payment_model->addPayment($data);
            $data['worksite'] = $this->input->post('worksite');
            $user = $this->payment_model->getEmail($this->input->post('employee_id'));
            $this->email->set_mailtype("html");
            $mail_data['text'] = "Your Payment details has been successfully added on " . SITE_TITLE . ' from admin';
            $mail_data['data'] = $data;
            $mail_data['firstname'] = $user['firstname'];
            $this->load->library('parser');
            $msg = $this->parser->parse('email/paymentTemplate', $mail_data, TRUE);
            $this->email->from(FORM_EMAIL, SITE_TITLE);
            $this->email->to($user['email']);
            $this->email->subject("Your Payment details has been successfully added on " . SITE_TITLE);
            $this->email->message($msg);
            $this->email->send();
            $this->session->set_flashdata('smessage', 'Payment Successfully added');
            redirect('/payment/');
        }
    }

    public function editCar() {
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        $id = $this->uri->segment(3);
        $this->loginCheck("payment/editCar/" . $id);
        $car = $this->payment_model->carDetail($id);
        $data['car'] = $car;
        $data['title'] = "Edit Car Details";
        $this->form_validation->set_rules('purchase_date', 'Purchase date', 'trim|required');
        $this->form_validation->set_rules('vin', 'Vehicle Identification Number', 'trim|required');
        $this->form_validation->set_rules('eng_no', 'Engine no', 'trim|required');
        $this->form_validation->set_rules('next_ser_km', 'Next Service KM', 'trim|numeric');
        $this->form_validation->set_rules('service_km', 'Service KM', 'trim|numeric');
        $this->form_validation->set_rules('licence_no', 'License No', 'trim|numeric');
        $this->form_validation->set_rules('latest_km', 'Latest KM', 'trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['users'] = $this->payment_model->get_tenants();
            $this->template->load('front', 'payment/editCar', $data);
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
                'year' => $this->input->post('year'),
                'purchase_price' => $this->input->post('purchase_price'),
                'insurance_comp' => $this->input->post('insurance_comp'),
                'policy_no' => $this->input->post('policy_no'),
                'insurance_start_date' => $this->input->post('insurance_start_date'),
                'insurance_end_date' => $this->input->post('insurance_end_date'),
                'insurance_cover_cost' => $this->input->post('insurance_cover_cost'),
                'insurance_cover_amount' => $this->input->post('insurance_cover_amount'),
                'car_use_location' => $this->input->post('car_use_location'),
                'date' => time()
            );

            $this->payment_model->editCar($data, $id);
            $this->session->set_flashdata('smessage', 'Car Details Successfully updated');
            redirect('/rent/index/');
        }
    }

    public function viewUser() {
//        if (!$this->session->userdata('userId')) {
//            redirect('/');
//        }
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        $id = $this->uri->segment(3);

        $this->loginCheck("payment/viewUser/" . $id);
        $data['houses'] = $this->household_model->get_houses();
        $data['worksites'] = $this->rent_model->get_worksites();
        $user_detail = $this->Welcome->fullUserDetail($id);
        $data['title'] = "My Profile";
        $data['user_detail'] = $user_detail;

        $data['title'] = "View Visa Expiration details";
        $this->template->load('front', 'payment/viewUser', $data);
    }

    public function batchPayment() {
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        $worksite_id = $this->uri->segment(3);
        $this->loginCheck("payment/batchPayment/" . $worksite_id);
        $config['base_url'] = base_url() . "payment/batchPayment/" . $worksite_id;
        $config['num_links'] = 10;
        $config['total_rows'] = $this->User->countWorksiteUsers($worksite_id);
        $config['per_page'] = 100000000000;
        $config['uri_segment'] = 4;
        $users_list = $this->User->usersWorksiteList($config['per_page'], $this->uri->segment(4), $worksite_id);
        $data['title'] = "Contractors in worksite";
        $this->pagination->initialize($config);
        $data['users'] = $users_list;
        $data['worksites'] = $this->User->get_worksites();
        $this->template->load('front', 'payment/batchPayment', $data);
    }

    public function addBatchPayment() {
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        $employee_id = $this->input->post('employee_id');
        $hourly_rate = $this->input->post('hourly_rate');
        $hours = $this->input->post('hours');
        $gst = $this->input->post('gst');
        $overtime1 = $this->input->post('overtime1');
        $overtimeh1 = $this->input->post('overtimeh1');
        $overtime2 = $this->input->post('overtime2');
        $overtimeh2 = $this->input->post('overtimeh2');
        $overtime3 = $this->input->post('overtime3');
        $overtimeh3 = $this->input->post('overtimeh3');
        $net_payment = $this->input->post('net_payment');
        $rent_deduction = $this->input->post('rent_deduction');
        $transport_deduction = $this->input->post('transport_deduction');
        $total_payment_amount = $this->input->post('total_payment_amount');
        $other_payments = $this->input->post('other_payments');
        $other_deduction = $this->input->post('other_deduction');
        $remark = $this->input->post('remark');
        $comment = $this->input->post('comment');

        $batch_id = $this->payment_model->addBatchPayment(array('payment_start' => $this->input->post('payment_start'), 'payment_close' => $this->input->post('payment_close'), 'worksite_id' => $this->input->post('worksite_id'), 'batch_total' => (array_sum($total_payment_amount)), 'date' => time()));
        for ($i = 0; $i < count($employee_id); $i++) {
            $data = array(
                'batch_id' => $batch_id,
                'employee_id' => $employee_id[$i],
                'hourly_rate' => $hourly_rate[$i],
                'hours' => $hours[$i],
                'gross_amount' => $gst[$i],
                'overtime1' => $overtime1[$i],
                'overtimeh1' => $overtimeh1[$i],
                'overtime2' => $overtime2[$i],
                'overtimeh2' => $overtimeh2[$i],
                'overtime3' => $overtime3[$i],
                'overtimeh3' => $overtimeh3[$i],
                'net_payment' => $net_payment[$i],
                'remark' => $remark[$i],
                'comment' => $comment[$i],
                'rent_deduction' => $rent_deduction[$i],
                'transport_deduction' => $transport_deduction[$i],
                'other_deduction' => $other_deduction[$i],
                'total_payment_amount' => $total_payment_amount[$i],
                'other_deduction' => $other_deduction[$i],
                'other_payments' => $other_payments[$i],
                'date' => time()
            );
            $this->payment_model->addPayment($data);
            $data['worksite'] = $this->input->post('worksite');
            $user = $this->payment_model->getEmail($employee_id[$i]);
            $this->email->set_mailtype("html");
            $mail_data['text'] = "Your Payment details has been successfully added on " . SITE_TITLE . ' from admin';
            $mail_data['data'] = $data;
            $mail_data['firstname'] = $user['firstname'];
            $this->load->library('parser');
            $msg = $this->parser->parse('email/paymentTemplate', $mail_data, TRUE);
            $this->email->from(FORM_EMAIL, SITE_TITLE);
            $this->email->to($user['email']);
            $this->email->subject("Your Payment details has been successfully added on " . SITE_TITLE);
            $this->email->message($msg);
            $this->email->send();
        }
        $this->session->set_flashdata('smessage', 'Payment Successfully added');
        redirect('/payment/');
    }

    public function viewPayment() {
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        $id = $this->uri->segment(3);
        $this->loginCheck("payment/viewPayment/" . $id);
        $payment = $this->payment_model->paymentBAtchDetail($id);
        $batch_payment = $this->payment_model->paymentBatchList($id);
        $data['batch_payment'] = $batch_payment;
        $data['payment'] = $payment;
        $data['title'] = "View Payment Details";
        $this->template->load('front', 'payment/viewBatchPayment', $data);
    }

    public function viewPaymentEmployee() {
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        $id = $this->uri->segment(3);
        $user_id = $this->uri->segment(4);
        $this->loginCheck("payment/viewPaymentEmployee/" . $id . "/" . $user_id);
        $payment = $this->payment_model->paymentBAtchDetail($id);
        $batch_payment = $this->payment_model->paymentBatchList($id, $user_id);
        $data['batch_payment'] = $batch_payment;
        $data['payment'] = $payment;
        $data['title'] = "View Payment Details";
        $this->template->load('front', 'payment/viewPaymentEmployee', $data);
    }

    public function addABAGeneration($batch_id, $strnum, $company) {

        $fi = $this->payment_model->getFI($company);
        $this->loginCheck("payment/addABAGeneration/" . $batch_id . "/" . $strnum . "/" . $company);

        $payment = $this->payment_model->paymentBAtchDetail($batch_id);
        $batch_payment = $this->payment_model->paymentBatchList($batch_id);

        $break_record = 100;
        if (count($batch_payment) < $break_record) {

            $data = "0";

            $data .= (substr($fi['bsb'], 0, 3) . "-" . substr($fi['bsb'], 3, 6));

            $data .= str_pad(substr($fi['account_number'], 0, 9), 9, '0', STR_PAD_LEFT);

            $data .= " ";

            $data .= "01";

            $data .= $fi['if_code'];

            $data .= "       ";

            $data .= str_pad(substr($fi['account_name'], 0, 26), 26, ' ', STR_PAD_RIGHT);

            $data .= $fi['de_user_id'];

            $data .= "INV PAYMENT ";

            $day = date('D');
            $odd_days = array('Fri' => 3, 'Sat' => 2, 'Sun' => 1);
            if (isset($odd_days[$day])) {
                $days = $odd_days[$day];
                $date = date('dmy', strtotime("+$days days"));
            } else {
                $date = date('dmy');
            }
            $data .= $date;

            $data .= "1030";

            $data .= "                                    ";


            //Detail Record (type 1)
            $data .= "\n";

            foreach ($batch_payment as $row) {

                $data .= "1";

                $data .= (substr($row->branchofbank, 0, 3) . "-" . substr($row->branchofbank, 3, 6));

                $data .= str_pad(substr($row->numberofbank, 0, 9), 9, '0', STR_PAD_LEFT);

                $data .= " ";

                $data .= "50";

                $data .= str_pad(round(($row->total_payment_amount + $row->other_payments), 2) * 100, 10, '0', STR_PAD_LEFT);

                $data .= str_pad(substr(($row->lastname . " " . $row->firstname), 0, 32), 32, ' ', STR_PAD_RIGHT);

                $data .= str_pad("Payment" . date('ymd'), 18, ' ', STR_PAD_RIGHT);

                $data .= (substr($fi['bsb'], 0, 3) . "-" . substr($fi['bsb'], 3, 6)); //Add a text to the page label titled Paying BSB ????

                $data .= str_pad(substr($fi['account_number'], 0, 9), 9, '0', STR_PAD_LEFT); //str_pad(substr($fi['account_name'], 0, 9), 9, ' ', STR_PAD_RIGHT); //Add a text to the page label titled Paying ACC.????

                $data .= str_pad(substr($fi['account_name'], 0, 16), 16, ' ', STR_PAD_RIGHT); //"ACCOUNTNAMEASDFG"; //Add a text to the page label titled Paying ACC. Name.????

                $data .= "0000000"; //By default leave blank, Add a text to the page label titled Withholding Tax Amount. ???

                $data .= "\n";
            }

            //File Total Record (type 7)
            $data .= "7";

            $data .= "999-999";

            // new records must start from here.................
            $data .= str_pad("", 12, ' ', STR_PAD_RIGHT);

            $data .= str_pad(round($payment['batch_total'], 2) * 100, 10, '0', STR_PAD_LEFT);

            $data .= str_pad('', 10, '0', STR_PAD_LEFT);

            $data .= str_pad(round($payment['batch_total'], 2) * 100, 10, '0', STR_PAD_LEFT);

            $data .= str_pad('', 24, ' ', STR_PAD_LEFT);

            $data .= str_pad(count($batch_payment), 6, '0', STR_PAD_LEFT);

            $data .= str_pad('', 40, ' ', STR_PAD_LEFT);

            $this->load->helper('download');
            force_download($this->hideSpecialChar($this->payment_model->getWorksiteName($payment['worksite_id']) . "_" . date('M d,Y', $payment['date'])) . ".aba", $data);
        } else {

            // create zip archives            
            $zip = new ZipArchive();
            $filename = "img/tmp/" . $this->hideSpecialChar($this->payment_model->getWorksiteName($payment['worksite_id']) . "_" . date('M d,Y', $payment['date'])) . ".zip";

            if (file_exists($filename)) {
                unlink($filename);
            }

            if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
                exit("cannot open <$filename>\n");
            }

            $number = count($batch_payment);
            $number = $number / $break_record;
            $sum = 0;

            if (strpos($number, ".")) {
                $number_array = explode(".", $number);
                $sum = $number_array[0];
                if (isset($number_array[1])) {
                    $sum = $sum + 1;
                }
            } else {
                $sum = $number;
            }
//echo $sum;
            $limit = 0;
            $limit1 = 0;
            for ($i = 1; $i <= $sum; $i++) {
                $limit = $limit1;
                $record = $i * $break_record;
                $limit1 = $record;

                // aba generation start
                $data = "0";

                $data .= (substr($fi['bsb'], 0, 3) . "-" . substr($fi['bsb'], 3, 6));

                $data .= str_pad(substr($fi['account_number'], 0, 9), 9, '0', STR_PAD_LEFT);

                $data .= " ";

                $data .= "01";

                $data .= $fi['if_code'];

                $data .= "       ";

                $data .= str_pad(substr($fi['account_name'], 0, 26), 26, ' ', STR_PAD_RIGHT);

                $data .= $fi['de_user_id'];

                $data .= "INV PAYMENT ";

                $day = date('D');
                $odd_days = array('Fri' => 3, 'Sat' => 2, 'Sun' => 1);
                if (isset($odd_days[$day])) {
                    $days = $odd_days[$day];
                    $date = date('dmy', strtotime("+$days days"));
                } else {
                    $date = date('dmy');
                }
                $data .= $date;

                $data .= "1030";

                $data .= "                                    ";


                //Detail Record (type 1)
                $data .= "\n";

                $batch_payment_inner = $this->payment_model->paymentBatchList($batch_id, 0, array($limit, $limit1));
                foreach ($batch_payment_inner as $row) {

                    $data .= "1";

                    $data .= (substr($row->branchofbank, 0, 3) . "-" . substr($row->branchofbank, 3, 6));

                    $data .= str_pad(substr($row->numberofbank, 0, 9), 9, '0', STR_PAD_LEFT);

                    $data .= " ";

                    $data .= "50";

                    $data .= str_pad(round(($row->total_payment_amount + $row->other_payments), 2) * 100, 10, '0', STR_PAD_LEFT);

                    $data .= str_pad(substr(($row->lastname . " " . $row->firstname), 0, 32), 32, ' ', STR_PAD_RIGHT);

                    $data .= str_pad("Payment" . date('ymd'), 18, ' ', STR_PAD_RIGHT);

                    $data .= (substr($fi['bsb'], 0, 3) . "-" . substr($fi['bsb'], 3, 6)); //Add a text to the page label titled Paying BSB ????

                    $data .= str_pad(substr($fi['account_number'], 0, 9), 9, '0', STR_PAD_LEFT); //str_pad(substr($fi['account_name'], 0, 9), 9, ' ', STR_PAD_RIGHT); //Add a text to the page label titled Paying ACC.????

                    $data .= str_pad(substr($fi['account_name'], 0, 16), 16, ' ', STR_PAD_RIGHT); //"ACCOUNTNAMEASDFG"; //Add a text to the page label titled Paying ACC. Name.????

                    $data .= "0000000"; //By default leave blank, Add a text to the page label titled Withholding Tax Amount. ???

                    $data .= "\n";
                }

                //File Total Record (type 7)
                $data .= "7";

                $data .= "999-999";

                // new records must start from here.................
                $data .= str_pad("", 12, ' ', STR_PAD_RIGHT);

                $data .= str_pad(round($payment['batch_total'], 2) * 100, 10, '0', STR_PAD_LEFT);

                $data .= str_pad('', 10, '0', STR_PAD_LEFT);

                $data .= str_pad(round($payment['batch_total'], 2) * 100, 10, '0', STR_PAD_LEFT);

                $data .= str_pad('', 24, ' ', STR_PAD_LEFT);

                $data .= str_pad(count($batch_payment_inner), 6, '0', STR_PAD_LEFT);

                $data .= str_pad('', 40, ' ', STR_PAD_LEFT);
                // aba generation close

                $zip->addFromString($limit . "-" . $limit1 . ".aba", $data);
            }

            $zip->close();

            $this->load->helper('download');
            $data_file = file_get_contents($filename);
            force_download($this->hideSpecialChar($this->payment_model->getWorksiteName($payment['worksite_id']) . "_" . date('M d,Y', $payment['date'])) . ".zip", $data_file);
        }
    }

    public function excelGeneration($batch_id, $strnum) {
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        $this->loginCheck("payment/excelGeneration/" . $batch_id . "/" . $strnum);

        $this->load->helper('download');
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');

        $payment = $this->payment_model->paymentBAtchDetail($batch_id);
        $batch_payment = $this->payment_model->paymentBatchList($batch_id);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
                ->setDescription("description");

        $objPHPExcel->getSheet(0)->setTitle('ABA Excel File');
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Payment Transfer List ');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->applyFromArray(
                array(
                    'name' => 'Calibri',
                    'bold' => true,
                    'size' => 18,
                    'italic' => false,
                    'color' => array(
                        'rgb' => '1F4981'
                    )
                )
        );
        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $styleArray = array(
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => '4F81BD'),
                ),
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'For:');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', $this->payment_model->getWorksiteName($payment['worksite_id']));
        $objPHPExcel->getActiveSheet()->setCellValue('A4', 'For Period Starting:');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', date('M d, Y', strtotime($payment['payment_start'])));
        $objPHPExcel->getActiveSheet()->setCellValue('A5', 'For Period Ending:');
        $objPHPExcel->getActiveSheet()->setCellValue('B5', date('M d, Y', strtotime($payment['payment_close'])));
        $objPHPExcel->getActiveSheet()->setCellValue('A6', 'Batch Payment ID');
        $objPHPExcel->getActiveSheet()->setCellValue('B6', $batch_id);
        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'Total Payments');
        $objPHPExcel->getActiveSheet()->setCellValue('B7', "$" . number_format($payment['batch_total'], 2));

        $array = array(
            'name' => 'Calibri',
            'bold' => true,
            'size' => 11,
            'italic' => false,
            'color' => array(
                'rgb' => '1F4981'
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A3:B3')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A4:B4')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A6:B6')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A7:B7')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->setCellValue('A10', "AdminID");
        $objPHPExcel->getActiveSheet()->setCellValue('B10', "Account Name");
        $objPHPExcel->getActiveSheet()->setCellValue('C10', "Bank");
        $objPHPExcel->getActiveSheet()->setCellValue('D10', "Account Number");
        $objPHPExcel->getActiveSheet()->setCellValue('E10', "BSB");
        $objPHPExcel->getActiveSheet()->setCellValue('F10', "Net Payment Amount");

        $styleArray = array(
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '95B3D7'),
                ),
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A10:F10')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(27);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(27);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(24);

        $objPHPExcel->getActiveSheet()->getStyle('A10:F10')->getFont()->applyFromArray(
                array(
                    'name' => 'Calibri',
                    'bold' => true,
                    'size' => 12,
                    'italic' => false,
                    'color' => array(
                        'rgb' => '1F4981'
                    )
                )
        );

        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(9)->setRowHeight(20);
        $i = 10;
        foreach ($batch_payment as $row) {
            $i +=1;

            $bsb = strval($row->branchofbank);
            $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $i, ($row->admin_id ? $row->admin_id : "N/A"), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, ($row->nameofbank ? $row->nameofbank : "N/A"));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, ($row->bank ? $this->User->getFullbankname($row->bank) : "N/A"));
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, ($row->numberofbank ? $row->numberofbank : "N/A"));
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E' . $i, ($bsb ? $bsb : "N/A"), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, "$" . number_format($row->net_payment, 2));
            $styleArray0 = array(
                'borders' => array(
                    'right' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'DCE6F2')
                )
            );
            $styleArray = array(
                'borders' => array(
                    'right' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B9CDE5')
                )
            );
            $styleArray1 = array(
                'borders' => array(
                    'bottom' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                ),
            );

            if ($i % 2 == 0) {
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->applyFromArray($styleArray0);
            } else {
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->applyFromArray($styleArray);
            }

            if (count($batch_payment) == ($i - 10)) {
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->applyFromArray($styleArray1);
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue('E' . ($i + 2), "Total");
        $objPHPExcel->getActiveSheet()->setCellValue('F' . ($i + 2), "$" . number_format($payment['batch_total'], 2));

        $styleArray = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '4F81BD')
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('E' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('F' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getRowDimension($i + 2)->setRowHeight(20);

        $filename = $this->hideSpecialChar($this->payment_model->getWorksiteName($payment['worksite_id']) . "_" . date('M d, Y', $payment['date'])) . '.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("php://output");
    }

    public function createSlug($string) {
        $old_pattern = array("/[^a-zA-Z0-9]/", "/_+/", "/_$/");
        $new_pattern = array("_", "_", "");
        return strtolower(preg_replace($old_pattern, $new_pattern, $string)) . time();
    }

    public function hideSpecialChar($string) {
        $old_pattern = array("/[^a-zA-Z0-9]/", "/_+/", "/_$/");
        $new_pattern = array("_", "_", "");
        return strtolower(preg_replace($old_pattern, $new_pattern, $string));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
