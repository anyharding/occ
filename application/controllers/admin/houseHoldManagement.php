<?php
class HouseHoldManagement extends CI_Controller
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
            $config['base_url']      = base_url()."admin/newsletter/index";
            $config['total_rows']    = $this->house_model->countNewsletter('normal_user');
            $config['per_page']      = $this->limit; 
            $config['uri_segment']   = $this->uri_segment;
            $newsletters_list = $this->house_model->newsletterList($config['per_page'], $this->uri->segment(4), "normal_user");
            $data['title'] = "List Newsletter Subscribers";
            $this->pagination->initialize($config);
            $data['newsletters'] = $newsletters_list;
            $this->template->load('admin','admin/newsletter/index',$data);
            //echo "<pre>";print_r($users_list);
	}
	public function listNewsletter() {
            $config['base_url']      = base_url()."admin/listNewsletter/index";
            $config['total_rows']    = $this->house_model->countTemplateNewsletter('normal_user');
            $config['per_page']      = $this->limit; 
            $config['uri_segment']   = $this->uri_segment;
            $newsletters_list = $this->house_model->newsletterTemplateList($config['per_page'], $this->uri->segment(4), "normal_user");
            $data['title'] = "List Newsletter";
            $this->pagination->initialize($config);
            $data['newsletters'] = $newsletters_list;
            $this->template->load('admin','admin/newsletter/listNewsletter',$data);
            //echo "<pre>";print_r($users_list);
	}
	public function editNewsletter() {
            $id = $this->uri->segment(4);
            $data['title'] = "Edit Newsletter";
            $data['newsletter'] = $this->house_model->getNewsletterDetail($id);
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                $this->template->load('admin','admin/newsletter/editNewsletter',$data);
            }
            else {
                if($_POST) {
                    $subject	 = $this->input->post('subject');
                    $message	 = $this->input->post('message');
                    $data        = array(
                                        'template'=>$message,
                                        'subject' =>$subject
                                        );
                    $this->house_model->updateNewsletter($data, $id);
                    $this->session->set_flashdata('smessage', 'Newsletter Successfully updated');
                    redirect("admin/newsletter/listNewsletter");
                }
            }
	}
	
	public function addNewsletter() {
            $data['title'] = "Add Newsletter";
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                $this->template->load('admin','admin/newsletter/addNewsletter',$data);
            }
            else {
                if($_POST) {
                    $subject	 = $this->input->post('subject');
                    $message	 = $this->input->post('message');
                    $data        = array(
                                        'template'=>$message,
                                        'subject'	=>$subject
                                        );
                    $this->house_model->addNewsletter($data);
                    $this->session->set_flashdata('smessage', 'Newsletter Successfully added');
                    redirect("admin/newsletter/listNewsletter");
                }
            }
	}
	
	public function deleteNewsletter() {
            $id = $this->uri->segment(4);
            $this->house_model->deleteNewsletter($id);
            $this->session->set_flashdata('smessage', 'Newsletter Subscribers Successfully deleted');
            redirect('/admin/newsletter/');
	}
	public function deleteNewsletterTemplate() {
            $id = $this->uri->segment(4);
            $this->house_model->deleteNewsletterTemplate($id);
            $this->session->set_flashdata('smessage', 'Newsletter Successfully deleted');
            redirect('/admin/newsletter/listNewsletter');
	}
	public function activateallNewsletter() {
            $id = $this->uri->segment(4);
            $this->house_model->activateNewsletter($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Newsletter Subscribers');
               redirect('/admin/newsletter/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->house_model->activateNewsletter($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Newsletter Subscribers successfully activated');
            redirect('/admin/newsletter/');
	}
	public function deactivateallNewsletter() {
            $id = $this->uri->segment(4);
            $this->house_model->activateNewsletter($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Newsletter Subscribers');
                redirect('/admin/newsletter/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->house_model->deactivateNewsletter($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Newsletter Subscribers successfully deactivated');
            redirect('/admin/newsletter/');
	}
	public function deleteallNewsletter() {
            $id = $this->uri->segment(4);
            $this->house_model->activateNewsletter($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Newsletter Subscribers');
                redirect('/admin/newsletter/');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->house_model->deleteNewsletter($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Newsletter Subscribers successfully deleted');
            redirect('/admin/newsletter/');
	}
	public function deleteallNewsletterTemplate() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one Newsletter');
                redirect('/admin/newsletter/listNewsletter');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->house_model->deleteNewsletterTemplate($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected Newsletter successfully deleted');
            redirect('/admin/newsletter/listNewsletter');
	}
	public function deactivateNewsletter() {
            $id = $this->uri->segment(4);
            $this->house_model->deactivateNewsletter($id);
            $this->session->set_flashdata('smessage', 'Newsletter Subscribers successfully deactivated');
            redirect('/admin/newsletter/');
	}
	public function activateNewsletter() {
            $id = $this->uri->segment(4);
            $this->house_model->activateNewsletter($id);
            $this->session->set_flashdata('smessage', 'Newsletter Subscribers successfully activated');
            redirect('/admin/newsletter/');
	}
        public function sendNewsletter() {
            $data['title'] = "Add Newsletter";
            $data['templates'] = $this->house_model->getTemplates();
            $data['subscribers'] = $this->house_model->getAllSubscribers();
            $all_users = $this->house_model->getAllSubscribersIds();
            $this->form_validation->set_rules('template', 'Template', 'trim|required');
            $this->form_validation->set_rules('user', 'User', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                $this->template->load('admin','admin/newsletter/sendNewsletter',$data);
            }
            else {
                if($_POST) {
                    $template_id	 = $this->input->post('template');
                    $users	 = $this->input->post('user');
                    $name = $this->input->post('name');
                    $data        = array(
                                        'template_id'=>$template_id
                                        );
                    if($users == 'F') {
                        $data['users'] = serialize($this->input->post('name'));
                    }
                    else {
                        $data['users'] = serialize($all_users);
                    }
                    $this->house_model->addNewsletterEmail($data);
                    $this->session->set_flashdata('smessage', 'Newsletter Successfully Send');
                    redirect("admin/newsletter/listNewsletter");
                }
            }
        }
        public function newsletterCron() {
            $email_array = $this->house_model->getCronEmails();
            //echo '<pre>';print_r($email_array);
            for($i = 0; $i < count($email_array); $i++) {
                $users = unserialize($email_array[$i]['users']);
                $template_detail = $this->house_model->getNewsletterDetail($email_array[$i]['template_id']);
                foreach($users as $key) {
                    $email = $this->house_model->getNewsletterEmailDetail($key);
                    $config['protocol'] = 'mail';
                    $config['wordwrap'] = FALSE;
                    $config['mailtype'] = 'html';
                    $config['charset'] = 'utf-8';
                    $config['crlf'] = "\r\n";
                    $config['newline'] = "\r\n";
                    $this->load->library('email', $config);
                    $this->email->set_mailtype("html");
                    
                    echo $msg = $template_detail['template'];die;
                    $this->email->from(FORM_EMAIL, SITE_TITLE);
                    $this->email->to($email);
                    $this->email->subject($template_detail['subject']);
                    $this->email->message( $msg );
                    $this->email->send();
                }
                                //getNewsletterEmailDetail()
            }
        }

}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
