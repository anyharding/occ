<?php
class PaymentManagement extends CI_Controller
{
	private $limit       = 10;
        private $uri_segment = 4;
        function __construct()
	{
            parent::__construct();
            $this->load->model('classified_model');
            $this->load->model('user_model');
            $this->load->library('pagination');
	}
	public function index() {
            $config['base_url']      = base_url()."admin/paymentManagement/index";
            $config['total_rows']    = $this->classified_model->countOrders();
            $config['per_page']      = $this->limit; 
            $config['uri_segment']   = $this->uri_segment;
            if(isset($_POST['search'])) {
                if($_POST['search'] == '')
                    $search = 'all';
                else
                    $search = $this->input->post('search');
                $config['total_rows']    = $this->classified_model->countsearchOrders($search);
                $config['base_url']  = base_url()."admin/paymentManagement/index/search/".$search;
                $orders_list = $this->classified_model->searchOrders($search, $config['per_page'], $this->uri->segment(6));
            }
            else {
                    if($this->uri->segment(4) == 'search') {
                        $search                  = $this->uri->segment(5);
                        $config['total_rows']    = $this->classified_model->countsearchOrders($search);
                        $config['base_url']      = base_url()."admin/paymentManagement/index/search/".$search;
                        $config['uri_segment']   = 6;
                        $orders_list = $this->classified_model->searchOrders($search, $config['per_page'], $this->uri->segment(6));
                    }
                    else 
                        $orders_list = $this->classified_model->ordersList($config['per_page'], $this->uri->segment(4));
            }
            $data['title'] = "Orders List";
            $this->pagination->initialize($config);
            $data['orders'] = $orders_list;
            $this->template->load('admin','admin/payment/index',$data);
            //echo "<pre>";print_r($users_list);
	}
	
	public function deleteOrder() {
            $id = $this->uri->segment(4);
            $this->classified_model->deleteOrder($id);
            $this->session->set_flashdata('smessage', 'Order Successfully deleted');
            redirect('/admin/paymentManagement/');
	}
	public function activateallOrder() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one order');
                redirect('/admin/paymentManagement/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->classified_model->activateOrder($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected orders successfully approved');
            redirect('/admin/paymentManagement/');
	}
	public function deactivateallOrder() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one order');
                redirect('/admin/paymentManagement/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->classified_model->deactivateOrder($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected orders successfully pending');
            redirect('/admin/paymentManagement/');
	}
	public function deleteallOrder() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one order');
                redirect('/admin/paymentManagement/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->classified_model->deleteOrder($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected orders successfully deleted');
           redirect('/admin/paymentManagement/');
	}
        public function managePlans() {
            $plans_list            = $this->classified_model->plansList();
            $data['plans_list']    = $plans_list;
            $data['title']           = "Planes List";
            $this->template->load('admin','admin/payment/planslist',$data);
        }  
        public function editPlan() {
		$id = $this->uri->segment(4);
		$plan_detail = $this->classified_model->planDetail($id);
		$data['plan_detail'] = $plan_detail;
                if($plan_detail[0]['title'] <> 'Free') {
                    $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                }
		$this->form_validation->set_rules('day', 'Day', 'trim|required|numeric');
                $data['title'] = "Edit Plan";
		if($this->form_validation->run() == FALSE) {
                     $this->template->load('admin','admin/payment/editPlan', $data);
		}
		else {
			if($_POST) {
				$amount	 = $this->input->post('amount');
				$day = $this->input->post('day');
		
				$data		 = array(
							'amount' 	=>$amount,
							'day'	=>$day
							);
				$this->classified_model->updatePlan($data, $id);
                                $this->session->set_flashdata('smessage', 'Plans successfully updated');
				redirect('/admin/paymentManagement/managePlans');
			}
		}
	}
        public function updatePaypalEmail() {
		$paypal_email_detail = $this->classified_model->paypalEmailDetail();
		$data['old_email'] = $paypal_email_detail[0]['email'];
		$this->form_validation->set_rules('email', 'New Email', 'trim|required|valid_email|matches[cemail]');
		$this->form_validation->set_rules('cemail', 'Confirm Email', 'trim|required|valid_email');
                $data['title'] = "Change Paypal Email";
		if($this->form_validation->run() == FALSE) {
                     $this->template->load('admin','admin/payment/editPaypalEmail', $data);
		}
		else {
			if($_POST) {
				$email	 = $this->input->post('email');
				$data		 = array(
							'email' =>$email
							);
				$this->classified_model->updatePaypalEmail($data);
                                $this->session->set_flashdata('smessage', 'Paypal email successfully updated');
				redirect('/admin/paymentManagement/updatePaypalEmail');
			}
		}
	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
