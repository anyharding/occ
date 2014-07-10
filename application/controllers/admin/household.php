<?php
class Household extends CI_Controller
{
	private $limit       = 10;
        private $uri_segment = 4;
        function __construct()
	{
            parent::__construct();
            $this->load->model('household_model');
            $this->load->library('pagination');
	}
	public function index() {
            $config['base_url']      = base_url()."admin/household/index";
            $config['total_rows']    = $this->household_model->counthouses('normal_house');
            $config['per_page']      = $this->limit; 
            $config['uri_segment']   = $this->uri_segment;
            if(isset($_POST['search'])) {
                if($_POST['search'] == '')
                    $search = 'all';
                else
                    $search = $this->input->post('search');
                $config['total_rows']    = $this->household_model->countsearchhouses($search);
                $config['base_url']  = base_url()."admin/household/index/search/".$search;
                $houses_list = $this->household_model->searchhouses($search, 'normal_house', $config['per_page'], $this->uri->segment(6));
            }
            else {
                    if($this->uri->segment(4) == 'search') {
                        $search                  = $this->uri->segment(5);
                        $config['total_rows']    = $this->household_model->countsearchhouses($search);
                        $config['base_url']      = base_url()."admin/household/index/search/".$search;
                        $config['uri_segment']   = 6;
                        $houses_list = $this->household_model->searchhouses($search, 'normal_house', $config['per_page'], $this->uri->segment(6));
                    }
                    else 
                        $houses_list = $this->household_model->housesList($config['per_page'], $this->uri->segment(4), "normal_house");
            }
            $data['title'] = "Household List";
            $this->pagination->initialize($config);
            $data['household'] = $houses_list;
            $this->template->load('admin','admin/household/index',$data);
            //echo "<pre>";print_r($houses_list);
	}
	public function addHousehold() {
            $redirect    = '/admin/household/';
            $data['category'] = $this->household_model->get_category();
            $data['get_houses'] = $this->household_model->get_houses();
            $data['title'] = "Add Household";
            $this->form_validation->set_rules('category', 'Select Household Category', 'required');
            $this->form_validation->set_rules('contact', 'Suppliers Contact Number', 'trim|required');
            $this->form_validation->set_rules('time', 'Purchased Time', 'trim|required');
            
            $this->form_validation->set_rules('shop', 'Shop Name', 'trim|required');
            $this->form_validation->set_rules('site', 'Site', 'trim|required');
            $this->form_validation->set_rules('other', 'other', 'trim|required');
            
            $this->form_validation->set_rules('receipt', 'Purchased Receipt', 'trim|required');
            $this->form_validation->set_rules('house', 'Select House', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                    $this->template->load('admin','admin/household/addHouseHold',$data);
            }
            else {
                    if($_POST) {

                        $category	 = serialize($this->input->post('category'));
                        $contact	 = $this->input->post('contact');
                        $time	         = $this->input->post('time');
                        $shop	         = $this->input->post('shop');
                        $site	         = $this->input->post('site');
                        $other	         = $this->input->post('other');
                        $receipt	 = $this->input->post('receipt');
                        $house	 = $this->input->post('house');
                        
                        $data        = array(
                                            'category'	=>$category,
                                            'contact_no'=>$contact,
                                            'purchase_time'=>$time,
                                            'shop_name'=>$shop,
                                            'site' =>$site,
                                            'other'=>$other,
                                            'purchase_receipt'=>$receipt,
                                            'description'=>$this->input->post('des'),
                                            'house_id'=>$house, 
                                            'date'=>date('Y-m-d'),
                                            'status'=>'1'
                                            );
                        $this->household_model->householdRegistration($data);
                       /*
                        *  $this->email->set_mailtype("html");
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

                        $this->session->set_flashdata('smessage', 'Household Successfully added');
                        redirect($redirect);
                    }
            }
		
	}
	
	public function editHousehold() {
            $id                  = $this->uri->segment(4);
            $data['get_houses'] = $this->household_model->get_houses();
            $data['category'] = $this->household_model->get_category();
            $household_detail         = $this->household_model->householdDetail($id);          
            $data['household_detail'] = $household_detail;
            $data['title'] = "Edit Household";
            //print_r($house_detail);
            $this->form_validation->set_rules('category', 'Select Household Category', 'required');
            $this->form_validation->set_rules('contact', 'Suppliers Contact Number', 'trim|required');
            $this->form_validation->set_rules('time', 'Purchased Time', 'trim|required');
            
            $this->form_validation->set_rules('shop', 'Shop Name', 'trim|required');
            $this->form_validation->set_rules('site', 'Site', 'trim|required');
            $this->form_validation->set_rules('other', 'other', 'trim|required');
            
            $this->form_validation->set_rules('receipt', 'Purchased Receipt', 'trim|required');
            $this->form_validation->set_rules('house', 'Select House', 'trim|required');

            if($this->form_validation->run() == FALSE) {                
                    $this->template->load('admin','admin/household/editHouseHold',$data);
            }
            else {
                    if($_POST) { 
                        $category	 = serialize($this->input->post('category'));
                        $contact	 = $this->input->post('contact');
                        $time	         = $this->input->post('time');
                        $shop	         = $this->input->post('shop');
                        $site	         = $this->input->post('site');
                        $other	         = $this->input->post('other');
                        $receipt	 = $this->input->post('receipt');
                        $house	 = $this->input->post('house');
                        
                        $data        = array(
                                            'category'	=>$category,
                                            'contact_no'=>$contact,
                                            'purchase_time'=>$time,
                                            'shop_name'=>$shop,
                                            'site' =>$site,
                                            'other'=>$other,
                                            'purchase_receipt'=>$receipt,
                                            'description'=>$this->input->post('des'),
                                            'house_id'=>$house, 
                                            'date'=>date('Y-m-d'),
                                            'status'=>'1'
                                            );
                        $this->household_model->edithouse($data, $id);
                        $this->session->set_flashdata('smessage', 'Household Successfully updated');
                        redirect('/admin/household/index/');
                    }
            }
	}
	public function deleteHousehold() {
            $id = $this->uri->segment(4);
//            $house_detail = $this->household_model->houseDetail($id);
//            if(file_exists('house_images/'.$house_detail[0]['image'])){
//                unlink('house_images/'.$house_detail[0]['image']);}
            $this->household_model->deletehouse($id);
            $this->session->set_flashdata('smessage', 'Household Successfully deleted');
                redirect('/admin/household/');
	}
	public function activateallHousehold() {
            $id = $this->uri->segment(4);
            $this->household_model->activatehouse($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Household');
                     redirect('/admin/household/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->household_model->activatehouse($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Households successfully activated');
            redirect('/admin/household/');
	}
	public function deactivateallHousehold() {
            $id = $this->uri->segment(4);
            $this->household_model->activatehouse($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Household');
                    redirect('/admin/household/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->household_model->deactivatehouse($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Households successfully deactivated');
            redirect('/admin/household/');
	}
	public function deleteallHousehold() {
            $id = $this->uri->segment(4);
            $this->household_model->activatehouse($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Household');
                    redirect('/admin/household/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->household_model->deletehouse($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Households successfully deleted');
            redirect('/admin/household/');
	}
	public function deactivateHousehold() {
            $id = $this->uri->segment(4);
            $this->household_model->deactivatehouse($id);
            $this->session->set_flashdata('smessage', 'Household successfully deactivated');
            redirect('/admin/household/');
	}
	public function activateHousehold() {
            $id = $this->uri->segment(4);
            $this->household_model->activatehouse($id);
            $this->session->set_flashdata('smessage', 'Household successfully activated');
            redirect('/admin/household/');
	}	

}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
