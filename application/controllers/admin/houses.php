<?php
class Houses extends CI_Controller
{
	private $limit       = 10;
        private $uri_segment = 4;
        function __construct()
	{
            parent::__construct();
            $this->load->model('house_model');
            $this->load->library('pagination');
	}
	public function index() {
            $config['base_url']      = base_url()."admin/houses/index";
            $config['total_rows']    = $this->house_model->getHouseRate(1);
            $config['per_page']      = $this->limit; 
            $config['uri_segment']   = $this->uri_segment;
            if(isset($_POST['search'])) {
                if($_POST['search'] == '')
                    $search = 'all';
                else
                    $search = $this->input->post('search');
                $config['total_rows']    = $this->house_model->countsearchhouses($search);
                $config['base_url']  = base_url()."admin/houses/index/search/".$search;
                $houses_list = $this->house_model->searchhouses($search, 'normal_house', $config['per_page'], $this->uri->segment(6));
            }
            else {
                    if($this->uri->segment(4) == 'search') {
                        $search                  = $this->uri->segment(5);
                        $config['total_rows']    = $this->house_model->countsearchhouses($search);
                        $config['base_url']      = base_url()."admin/houses/index/search/".$search;
                        $config['uri_segment']   = 6;
                        $houses_list = $this->house_model->searchhouses($search, 'normal_house', $config['per_page'], $this->uri->segment(6));
                    }
                    else 
                        $houses_list = $this->house_model->housesList($config['per_page'], $this->uri->segment(4), "normal_house");
            }
            $data['title'] = "House List";
            $this->pagination->initialize($config);
            $data['houses'] = $houses_list;
            $this->template->load('admin','admin/houses/index',$data);
	}
	public function housesInWorksite() {
            $worksite_id = $this->uri->segment(4);
            $config['base_url']      = base_url()."admin/houses/housesInWorksite/".$worksite_id;
            $config['total_rows']    = $this->house_model->countWorksitehouses($worksite_id);
            $config['per_page']      = $this->limit; 
            $config['uri_segment']   = $this->uri_segment;
            if(isset($_POST['search'])) {
                if($_POST['search'] == '')
                    $search = 'all';
                else
                    $search = $this->input->post('search');
                $config['total_rows']    = $this->house_model->countsearchhouses($search);
                $config['base_url']  = base_url()."admin/houses/index/search/".$search;
                $houses_list = $this->house_model->searchhouses($search, 'normal_house', $config['per_page'], $this->uri->segment(7));
            }
            else {
                    if($this->uri->segment(5) == 'search') {
                        $search                  = $this->uri->segment(6);
                        $config['total_rows']    = $this->house_model->countsearchhouses($search);
                        $config['base_url']      = base_url()."admin/houses/index/search/".$search;
                        $config['uri_segment']   = 7;
                        $houses_list = $this->house_model->searchhouses($search, 'normal_house', $config['per_page'], $this->uri->segment(7));
                    }
                    else 
                        $houses_list = $this->house_model->housesWorksiteList($config['per_page'], $this->uri->segment(5), $worksite_id);
            }
            $data['title'] = "House List";
            $this->pagination->initialize($config);
            $data['houses'] = $houses_list;
            $this->template->load('admin','admin/houses/index',$data);
	}
	public function addHouse() {
            $redirect    = '/admin/houses/';
            $data['users'] = $this->house_model->get_tenants();
            $data['title'] = "Add House";
              
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('rent_payment_amount', 'Rent per week', 'trim|required|numeric');
            $this->form_validation->set_rules('payment_cycle', 'Payment cycle', 'trim|required');
            $this->form_validation->set_rules('retailor_company_name', 'Realtor Company name', 'trim|required');
            $this->form_validation->set_rules('retailor_name', 'Realtor name', 'trim|required');
            $this->form_validation->set_rules('enployee_id', 'Telnet', 'trim|required');
            $this->form_validation->set_rules('retailor_bank', 'Realtor bank', 'trim|required');
            $this->form_validation->set_rules('retailot_acc_no', 'Realtor account number', 'required');
            $this->form_validation->set_rules('retailot_acc_bsb', 'Realtor account BSB', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                    $this->template->load('admin','admin/houses/addHouse',$data);
            }
            else {
                    if($_POST) {

                        $address	 = $this->input->post('address');
                        $rent_payment_amount	 = $this->input->post('rent_payment_amount');
                        $payment_cycle	         = $this->input->post('payment_cycle');
                        $telnat	         = $this->input->post('enployee_id');
                        $rent_due_date	 = $this->input->post('rent_due_date');
                        $retailor_company_name	 = $this->input->post('retailor_company_name');                        
                        $retailor_name	         = $this->input->post('retailor_name');
                        $retailor_bank	         = $this->input->post('retailor_bank');                      
                        $retailot_acc_no	 = $this->input->post('retailot_acc_no');                         
                        $retailot_acc_bsb	 = $this->input->post('retailot_acc_bsb');
                        
                        $data        = array(
                                            'address'	=>$address,
                                            'rent_payment_amount'	=>$rent_payment_amount,
                                            'payment_cycle'=>$payment_cycle,
                                            'tenant_id'   =>$telnat,
                                            'company_name'=>$retailor_company_name,
                                            'realtor_name' =>$retailor_name,
                                            'realtor_bank'=>$retailor_bank,
                                            'realtor_account'=>$retailot_acc_no,
                                            'realtor_account_bsb'=>$retailot_acc_bsb,  
                                            'created'	=>date('Y-m-d'),
                                            'status'	=>'1'
                                            );
                        $this->house_model->houseRegistration($data);
                        /*
                         * $this->email->set_mailtype("html");
                        $mail_data['houseDetail'] = $data;
                        $mail_data['text'] = "Your account has been created successfully on ".SITE_TITLE;
                        $mail_data['email'] = $email;
                        $mail_data['username'] = $username;
                        $mail_data['password'] = $password;
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

                        $this->session->set_flashdata('smessage', 'House Successfully added');
                        redirect($redirect);
                    }
            }
		
	}
	
	public function editHouse() {
            $id                  = $this->uri->segment(4);
            $data['users'] = $this->house_model->get_tenants();
            $house_detail         = $this->house_model->houseDetail($id);        
            $data['house_detail'] = $house_detail;
            $data['title'] = "Edit House";
            //print_r($house_detail);
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('rent_payment_amount', 'Rent Payment Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('payment_cycle', 'Payment cycle', 'trim|required');
            $this->form_validation->set_rules('retailor_company_name', 'Realtor Company name', 'trim|required');
            $this->form_validation->set_rules('retailor_name', 'Realtor name', 'trim|required');
            //$this->form_validation->set_rules('enployee_id', 'Telnet', 'trim|required');
            $this->form_validation->set_rules('retailor_bank', 'Realtor bank', 'trim|required');
            $this->form_validation->set_rules('retailot_acc_no', 'Realtor account number', 'required');
            $this->form_validation->set_rules('retailot_acc_bsb', 'Realtor account BSB', 'trim|required');

            if($this->form_validation->run() == FALSE) {                
                    $this->template->load('admin','admin/houses/editHouse',$data);
            }
            else {
                    if($_POST) { 
                        $address	 = $this->input->post('address');
                        $rent_payment_amount	 = $this->input->post('rent_payment_amount');
                        $payment_cycle	         = $this->input->post('payment_cycle');
                        $telnat	         = $this->input->post('enployee_id');
                        $retailor_company_name	 = $this->input->post('retailor_company_name');                        
                        $retailor_name	         = $this->input->post('retailor_name');
                        $retailor_bank	         = $this->input->post('retailor_bank');                      
                        $retailot_acc_no	 = $this->input->post('retailot_acc_no');                         
                        $retailot_acc_bsb	 = $this->input->post('retailot_acc_bsb');
                        
                        $data        = array(
                                            'address'	=>$address,
                                            'rent_payment_amount' =>$rent_payment_amount,
                                            'payment_cycle'=>$payment_cycle,
                                            /*'tenant_id'   =>$telnat,*/
                                            'company_name'=>$retailor_company_name,
                                            'realtor_name' =>$retailor_name,
                                            'realtor_bank'=>$retailor_bank,
                                            'realtor_account'=>$retailot_acc_no,
                                            'realtor_account_bsb'=>$retailot_acc_bsb,  
                                            'created'	=>date('Y-m-d'),
                                            'status'	=>'1'
                                            );
                        $this->house_model->edithouse($data, $id);
                        $this->session->set_flashdata('smessage', 'House Successfully updated');
                        redirect('/admin/houses/index/');
                    }
            }
	}
	public function deleteHouse() {
            $id = $this->uri->segment(4);
//            $house_detail = $this->house_model->houseDetail($id);
//            if(file_exists('house_images/'.$house_detail[0]['image'])){
//                unlink('house_images/'.$house_detail[0]['image']);}
            $this->house_model->deletehouse($id);
            $this->session->set_flashdata('smessage', 'House Successfully deleted');
                redirect('/admin/houses/');
	}
	public function activateallHouse() {
            $id = $this->uri->segment(4);
            $this->house_model->activatehouse($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one House');
                     redirect('/admin/houses/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->house_model->activatehouse($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Houses successfully activated');
            redirect('/admin/houses/');
	}
	public function deactivateallHouse() {
            $id = $this->uri->segment(4);
            $this->house_model->activatehouse($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one House');
                    redirect('/admin/houses/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->house_model->deactivatehouse($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Houses successfully deactivated');
            redirect('/admin/houses/');
	}
	public function deleteallHouse() {
            $id = $this->uri->segment(4);
            $this->house_model->activatehouse($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one House');
                    redirect('/admin/houses/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->house_model->deletehouse($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Houses successfully deleted');
            redirect('/admin/houses/');
	}
	public function deactivateHouse() {
            $id = $this->uri->segment(4);
            $this->house_model->deactivatehouse($id);
            $this->session->set_flashdata('smessage', 'House successfully deactivated');
            redirect('/admin/houses/');
	}
	public function activateHouse() {
            $id = $this->uri->segment(4);
            $this->house_model->activatehouse($id);
            $this->session->set_flashdata('smessage', 'House successfully activated');
            redirect('/admin/houses/');
	}	

}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
