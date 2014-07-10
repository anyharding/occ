<?php
class Payment extends CI_Controller
{
	private $limit       = 10;
        private $uri_segment = 4;
        function __construct()
	{
            parent::__construct();
            $this->load->model('payment_model');
            $this->load->model('rent_model');
            $this->load->model('household_model');
            $this->load->model('welcome_model', 'Welcome');
            $this->load->model('user_model');
            $this->load->library('pagination');
	}
	public function index() {
            $config['base_url']      = base_url()."admin/payment/index";
            $config['total_rows']    = $this->payment_model->countPayments();
            $config['per_page']      = $this->limit; 
            $config['uri_segment']   = $this->uri_segment;
            if(isset($_POST['search'])) {
                if($_POST['search'] == '')
                    $search = 'all';
                else
                    $search = $this->input->post('search');
                $config['total_rows']    = $this->payment_model->countsearchPayment($search);
                $config['base_url']  = base_url()."admin/payment/index/search/".$search;
                $payment = $this->payment_model->searchPayment($search, $config['per_page'], $this->uri->segment(6));
            }
            else {
                    if($this->uri->segment(4) == 'search') {
                        $search                  = $this->uri->segment(5);
                        $config['total_rows']    = $this->payment_model->countsearchPayment($search);
                        $config['base_url']      = base_url()."admin/payment/index/search/".$search;
                        $config['uri_segment']   = 6;
                        $payment = $this->payment_model->searchPayment($search, $config['per_page'], $this->uri->segment(6));
                    }
                    else 
                        $payment = $this->payment_model->paymentList($config['per_page'], $this->uri->segment(4));
            }
            $data['title'] = "Payments List";
            $this->pagination->initialize($config);
            $data['payment'] = $payment;
            $this->template->load('admin','admin/payment/index',$data);
	}
	public function addPayment() {

            $data['title'] = "Add payment Amount";
            $this->form_validation->set_rules('employee_id', 'Employee', 'trim|required');
            //$this->form_validation->set_rules('worksite', 'Worksite', 'trim|required');
            //$this->form_validation->set_rules('name', 'Employee Name', 'trim|required');
            $this->form_validation->set_rules('hourly_rate', 'Hourly Rate', 'trim|numeric|required');
            $this->form_validation->set_rules('hours', 'Hours Worked', 'trim|numeric|required');
            $this->form_validation->set_rules('gst', 'Gross Wage Amount', 'trim|numeric');
            $this->form_validation->set_rules('overtime', 'Overtime', 'trim|numeric');
            $this->form_validation->set_rules('net_payment', 'Net Payment Amount', 'trim|numeric');
            $this->form_validation->set_rules('rent_deduction', 'Rent Deduction', 'trim|numeric');
            $this->form_validation->set_rules('transport_deduction', 'Transport Deduction', 'trim|numeric');
            $this->form_validation->set_rules('other_deduction', 'Other Deductions', 'trim|numeric');
            $this->form_validation->set_rules('total_payment_amount', 'Total Payment Amount ', 'trim');
            if($this->form_validation->run() == FALSE) {
                $data['users'] = $this->payment_model->get_tenants();
                $this->template->load('admin','admin/payment/addPayment',$data);
            }
            else {
                $data        = array(
                                    'employee_id'	=>$this->input->post('employee_id'),
                                    'hourly_rate'	=>$this->input->post('hourly_rate'),
                                    'hours'	=>$this->input->post('hours'),
                                    'gross_amount'	=>$this->input->post('gst'),
                                    'overtime'	=>$this->input->post('overtime'),
                                    'net_payment'	=>$this->input->post('net_payment'),
                                    'rent_deduction'	=>$this->input->post('rent_deduction'),
                                    'transport_deduction'=>$this->input->post('transport_deduction'),
                                    'other_deduction'	=>$this->input->post('other_deduction'),
                                    'total_payment_amount'	=>$this->input->post('total_payment_amount'),
                                    'other_payments'	=>$this->input->post('other_payments'),
                                    'date'=>time()
                                    );
                
                $this->payment_model->addPayment($data);
                $data['worksite'] = $this->input->post('worksite');
                $user = $this->payment_model->getEmail($this->input->post('employee_id'));
                $this->email->set_mailtype("html");
                $mail_data['text'] = "Your Payment details has been successfully added on ".SITE_TITLE.' from admin';
                $mail_data['data'] = $data;
                $mail_data['firstname'] = $user['firstname'];
                $this->load->library('parser');
                $msg =  $this->parser->parse('email/paymentTemplate', $mail_data, TRUE);
                $this->email->from(FORM_EMAIL, SITE_TITLE);
                $this->email->to($user['email']);
                $this->email->subject("Your Payment details has been successfully added on ".SITE_TITLE);
                $this->email->message( $msg );
                $this->email->send();
                
                
                /*
                $this->email->set_mailtype("html");
                $mail_data['poweruserDetail'] = $data;
                $mail_data['text'] = "Your account has been created successfully on ".SITE_TITLE.' from admin as an Applicant<br><br>Click here link to login '.HTTP_PATH.'welcome';
                $mail_data['email'] = $email;
                $mail_data['password'] = $password;
                $mail_data['username'] = $this->input->post('username');
                $mail_data['firstname'] = $firstname;
                $this->load->library('parser');
                $msg =  $this->parser->parse('email/template', $mail_data, TRUE);
                $this->email->from(FORM_EMAIL, SITE_TITLE);
                $this->email->to($email);
                $this->email->subject('Login Details');
                $this->email->message( $msg );
                $this->email->send();
                 * 
                 */

                $this->session->set_flashdata('smessage', 'Payment Successfully added');
                redirect('/admin/payment/');
            }
		
	}
	
	public function viewPayment() {
            $id                  = $this->uri->segment(4);
            $payment         = $this->payment_model->paymentDetail($id);           
            $data['payment'] = $payment;
            $data['title'] = "View Payment Details";        
            $this->template->load('admin','admin/payment/viewPayment',$data);
	}
	
	public function viewUser() {
            
            if(!$this->session->userdata('adminId'))
            {
                redirect('admin/');
            }
            $id = $this->uri->segment(4);
            $data['houses']    = $this->household_model->get_houses();
            $data['worksites'] = $this->rent_model->get_worksites();
            $user_detail = $this->Welcome->fullUserDetail($id);
            $data['title'] = "My Profile";
            $data['user_detail'] = $user_detail;
            
            $data['title'] = "View Visa Expiration details";        
            $this->template->load('admin','admin/payment/viewUser',$data);
	}
	
	public function visaExpiryCheck() {
            $data['title']   = "Visa Expiry Check Management";   
            
            $config['base_url']      = base_url()."admin/payment/visaExpiryCheck/".$this->uri->segment(4)."/";
            $config['per_page']      = $this->limit; 
            $config['uri_segment']   = 5;
            
            if($this->uri->segment(4) == '14days'){
                $config['total_rows']    = $this->payment_model->countUsers('14days');
                $data['users'] = $this->payment_model->getUsers('14days', $config['per_page'], $this->uri->segment(5));
            }
            if($this->uri->segment(4) == '30days'){
                $config['total_rows']    = $this->payment_model->countUsers('30days');
                $data['users'] = $this->payment_model->getUsers('30days', $config['per_page'], $this->uri->segment(5));
            }
            if($this->uri->segment(4) == '60days'){
                $config['total_rows']    = $this->payment_model->countUsers('60days');
                $data['users'] = $this->payment_model->getUsers('60days', $config['per_page'], $this->uri->segment(5));
            }
            $this->pagination->initialize($config);
            $this->template->load('admin','admin/payment/visaExpiryCheck',$data);
	}
	public function deletePayment() {
            $id = $this->uri->segment(4);
            $this->payment_model->deletePayment($id);
            $this->session->set_flashdata('smessage', 'Payment Details Successfully deleted');
            redirect('/admin/payment/');
	}
	public function activateallPayment() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Payment');
                     redirect('/admin/payment/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->payment_model->activatePayment($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Payments successfully activated');
            redirect('/admin/payment/');
	}
	public function deactivateallPayment() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Payment');
                    redirect('/admin/payment/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->payment_model->deactivatePayment($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Payments successfully deactivated');
            redirect('/admin/payment/');
	}
	public function deleteallPayment() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Payment');
                    redirect('/admin/payment/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->payment_model->deletePayment($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Payments successfully deleted');
            redirect('/admin/payment/');
	}
	public function deactivatePayment() {
            $id = $this->uri->segment(4);
            $this->payment_model->deactivatePayment($id);
            $this->session->set_flashdata('smessage', 'Payment successfully deactivated');
            redirect('/admin/payment/');
	}
	public function activatePayment() {
            $id = $this->uri->segment(4);
            $this->payment_model->activatePayment($id);
            $this->session->set_flashdata('smessage', 'Payment successfully activated');
            redirect('/admin/payment/');
	}	
        public function getUserInfo($user_id) {
            echo $this->payment_model->getUserInfo($user_id);
        }

}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
