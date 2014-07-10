<?php
class Rent extends CI_Controller
{
	private $limit       = 10;
        private $uri_segment = 4;
        function __construct()
	{
            parent::__construct();
            $this->load->model('rent_model');
            $this->load->model('household_model');
            $this->load->library('pagination');
	}
	public function index() {
            $config['base_url']      = base_url()."admin/rent/index";
            $config['total_rows']    = $this->rent_model->countRent();
            $config['per_page']      = $this->limit; 
            $config['uri_segment']   = $this->uri_segment;
            if(isset($_POST['search'])) {
                if($_POST['search'] == '')
                    $search = 'all';
                else
                    $search = $this->input->post('search');
                $config['total_rows']    = $this->rent_model->countsearchRent($search);
                $config['base_url']  = base_url()."admin/rent/index/search/".$search;
                $rents = $this->rent_model->searchRent($search, $config['per_page'], $this->uri->segment(6));
            }
            else {
                    if($this->uri->segment(4) == 'search') {
                        $search                  = $this->uri->segment(5);
                        $config['total_rows']    = $this->rent_model->countsearchRent($search);
                        $config['base_url']      = base_url()."admin/rent/index/search/".$search;
                        $config['uri_segment']   = 6;
                        $rents = $this->rent_model->searchRent($search, $config['per_page'], $this->uri->segment(6));
                    }
                    else 
                        $rents = $this->rent_model->rentList($config['per_page'], $this->uri->segment(4));
            }
            $data['title'] = "Rent List";
            $this->pagination->initialize($config);
            $data['rents'] = $rents;
            $this->template->load('admin','admin/rent/index',$data);
	}
	public function addRent() {
            $redirect    = '/admin/rent/';
            $data['get_worksite'] = $this->rent_model->get_worksites();
            $data['get_houses'] = $this->household_model->get_houses();
            $data['users'] = $this->rent_model->get_users();
            $data['title'] = "Add Rent";
              
            $this->form_validation->set_rules('house', 'Select House', 'trim|required');
            $this->form_validation->set_rules('amount', 'Payment Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('payment_date', 'Payment Date', 'trim|required');
            $this->form_validation->set_rules('due_date', 'Rent Due Date', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                    $this->template->load('admin','admin/rent/addRent',$data);
            }
            else {
                if($_POST) {
                    $house	 = $this->input->post('house');
                    $amount	 = $this->input->post('amount');
                    $payment_date = $this->input->post('payment_date');
                    $due_date = $this->input->post('due_date');

                    $data   = array(
                                    'house_id'	=>$house,
                                    'amount'	=>$amount,
                                    'payment_date'=>$payment_date,
                                    'payment_due_date'	=>$due_date,
                                    'created'	=>time(),
                                    'status'	=>'1'
                                    );
                    $this->rent_model->rentRegistration($data);
                    $this->session->set_flashdata('smessage', 'Rent Successfully added');
                    redirect($redirect);
                }
            }
	}
	
	public function editRent() {
            $id                  = $this->uri->segment(4);
            $data['users'] = $this->rent_model->get_users();
            $edit_rent         = $this->rent_model->rentDetail($id);   
            $data['get_worksite'] = $this->rent_model->get_worksites();
            $data['get_houses'] = $this->household_model->get_houses();       
            $data['edit_rent'] = $edit_rent;
            $data['title'] = "Edit Rent";
            //print_r($house_detail);
            $this->form_validation->set_rules('house', 'Select House', 'trim|required');
            $this->form_validation->set_rules('amount', 'Payment Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('payment_date', 'Payment Date', 'trim|required');
            $this->form_validation->set_rules('due_date', 'Rent Due Date', 'trim|required');

            if($this->form_validation->run() == FALSE) {                
                $this->template->load('admin','admin/rent/editRent',$data);
            }
            else {
                    if($_POST) { 
                        $house	 = $this->input->post('house');
                        $amount	 = $this->input->post('amount');
                        $payment_date = $this->input->post('payment_date');
                        $due_date = $this->input->post('due_date');

                        $data   = array(
                                        'house_id'	=>$house,
                                        'amount'	=>$amount,
                                        'payment_date'=>$payment_date,
                                        'created'	=>time(),
                                        'status'	=>'1'
                                        );
                        $this->rent_model->editRent($data, $id);
                        $this->session->set_flashdata('smessage', 'Rent Successfully updated');
                        redirect('/admin/rent/index/');
                    }
            }
	}
	public function deleteRent() {
            $id = $this->uri->segment(4);
//            $worksite_detail = $this->rent_model->worksiteDetail($id);
//            if(file_exists('worksite_images/'.$worksite_detail[0]['image'])){
//                unlink('worksite_images/'.$worksite_detail[0]['image']);}
            $this->rent_model->deleteRent($id);
            $this->session->set_flashdata('smessage', 'Rent Successfully deleted');
                redirect('/admin/rent/');
	}
	public function activateallRent() {
            $id = $this->uri->segment(4);
            $this->rent_model->activateRent($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Worksite');
                     redirect('/admin/rent/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->rent_model->activateRent($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Rents successfully activated');
            redirect('/admin/rent/');
	}
	public function deactivateallRent() {
            $id = $this->uri->segment(4);
            $this->rent_model->activateRent($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Worksite');
                    redirect('/admin/rent/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->rent_model->deactivateRent($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Rents successfully deactivated');
            redirect('/admin/rent/');
	}
	public function deleteallRent() {
            $id = $this->uri->segment(4);
            $this->rent_model->activateRent($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Worksite');
                    redirect('/admin/rent/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->rent_model->deleteRent($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Rents successfully deleted');
            redirect('/admin/rent/');
	}
	public function deactivateRent() {
            $id = $this->uri->segment(4);
            $this->rent_model->deactivateRent($id);
            $this->session->set_flashdata('smessage', 'Rent successfully deactivated');
            redirect('/admin/rent/');
	}
	public function activateRent() {
            $id = $this->uri->segment(4);
            $this->rent_model->activateRent($id);
            $this->session->set_flashdata('smessage', 'Rent successfully activated');
            redirect('/admin/rent/');
	}	

}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
