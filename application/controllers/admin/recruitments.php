<?php

class Recruitments extends CI_Controller {

    private $limit = 10;
    private $uri_segment = 4;

    function __construct() {
        parent::__construct();
        $this->load->model('recruitment_model');
        $this->load->library('pagination');
    }

    public function index() {
        $config['base_url'] = base_url() . "admin/recruitments/index";
        $config['total_rows'] = $this->recruitment_model->countrecruitments('normal_recruitment');
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        if (isset($_POST['search'])) {
            if ($_POST['search'] == '')
                $search = 'all';
            else
                $search = $this->input->post('search');
            $config['total_rows'] = $this->recruitment_model->countsearchrecruitments($search);
            $config['base_url'] = base_url() . "admin/recruitments/index/search/" . $search;
            $recruitments_list = $this->recruitment_model->searchrecruitments($search, 'normal_recruitment', $config['per_page'], $this->uri->segment(6));
        }
        else {
            if ($this->uri->segment(4) == 'search') {
                $search = $this->uri->segment(5);
                $config['total_rows'] = $this->recruitment_model->countsearchrecruitments($search);
                $config['base_url'] = base_url() . "admin/recruitments/index/search/" . $search;
                $config['uri_segment'] = 6;
                $recruitments_list = $this->recruitment_model->searchrecruitments($search, 'normal_recruitment', $config['per_page'], $this->uri->segment(6));
            }
            else
                $recruitments_list = $this->recruitment_model->recruitmentsList($config['per_page'], $this->uri->segment(4), "normal_recruitment");
        }
        $data['title'] = "recruitment List";
        $this->pagination->initialize($config);
        $data['recruitments'] = $recruitments_list;
        $this->template->load('admin', 'admin/recruitments/index', $data);
        //echo "<pre>";print_r($recruitments_list);
    }

    public function addRecruitment() {

        $redirect = '/admin/recruitments/';
        $data['title'] = "Add HR";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|min_length[8]');
        $this->form_validation->set_message('is_unique', 'The e-mail address is already registered in Employee Management');
        $this->form_validation->set_message('is_unique1', 'The Username is already registered in Employee Management');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {

            $this->template->load('admin', 'admin/recruitments/addRecruitment', $data);
        } else {
            if ($_POST) {

                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $contact = $this->input->post('contact');

                $data = array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'username' => $this->input->post('username'),
                    'password' => $password,
                    'email' => $email,
                    'contact_no' => $contact,
                    'role' => 4,
                    'created' => date('Y-m-d'),
                    'status' => '1'
                );
                $this->recruitment_model->recruitmentRegistration($data);
                $this->email->set_mailtype("html");
                $mail_data['recruitmentDetail'] = $data;
                $mail_data['text'] = "Your account has been created successfully on " . SITE_TITLE . ' from admin as a HR<br><br>Click here link to login ' . HTTP_PATH . 'welcome';
                $mail_data['email'] = $email;
                $mail_data['password'] = $password;
                $mail_data['firstname'] = $firstname;
                $mail_data['username'] = $this->input->post('username');
                $this->load->library('parser');
                $msg = $this->parser->parse('email/template', $mail_data, TRUE);
                $this->email->from(FORM_EMAIL, SITE_TITLE);
                $this->email->to($email);
                $this->email->subject('Login Details');
                $this->email->message($msg);
                $this->email->send();

                $this->session->set_flashdata('smessage', 'Recruitment HR Successfully added');
                redirect($redirect);
            }
        }
    }

    public function editRecruitment() {
        $id = $this->uri->segment(4);
        $recruitment_detail = $this->recruitment_model->recruitmentDetail($id);
        $data['countries'] = $this->recruitment_model->get_countries();
        $data['recruitment_detail'] = $recruitment_detail;
        $data['title'] = "Edit Power User";
        //print_r($recruitment_detail);
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', "valid_email|required|is_unique_again[emp_users.email.$id]");
        $this->form_validation->set_rules('username', 'Username', "required|is_unique_again1[emp_users.username.$id]");
        $this->form_validation->set_rules('password', 'Password', "trim|required|min_length[8]");
        $this->form_validation->set_message('is_unique_again', 'The e-mail address is already registered in Employee Management');
        $this->form_validation->set_message('is_unique_again1', 'The username is already registered in Employee Management');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin', 'admin/recruitments/editRecruitment', $data);
        } else {
            if ($_POST) {

                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname');
                $email = $this->input->post('email');
                $contact = $this->input->post('contact');

                $data = array(
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'contact_no' => $contact
                );
                $this->recruitment_model->editrecruitment($data, $id);
                $this->session->set_flashdata('smessage', 'Recruitment HR Successfully updated');
                redirect('/admin/recruitments/index/');
            }
        }
    }

    public function deleteRecruitment() {
        $id = $this->uri->segment(4);
//            $recruitment_detail = $this->recruitment_model->recruitmentDetail($id);
//            if(file_exists('recruitment_images/'.$recruitment_detail[0]['image'])){
//                unlink('recruitment_images/'.$recruitment_detail[0]['image']);}
        $this->recruitment_model->deleterecruitment($id);
        $this->session->set_flashdata('smessage', 'Recruitment HR Successfully deleted');
        redirect('/admin/recruitments/');
    }

    public function activateallRecruitment() {
        $id = $this->uri->segment(4);
        $this->recruitment_model->activaterecruitment($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Recruitment HR');
            redirect('/admin/recruitments/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->recruitment_model->activaterecruitment($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Recruitment HR successfully activated');
        redirect('/admin/recruitments/');
    }

    public function deactivateallRecruitment() {

        $id = $this->uri->segment(4);
        $this->recruitment_model->activaterecruitment($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Recruitment HR');
            redirect('/admin/recruitments/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->recruitment_model->deactivaterecruitment($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Recruitment HR successfully deactivated');
        redirect('/admin/recruitments/');
    }

    public function deleteallRecruitment() {
        $id = $this->uri->segment(4);
        $this->recruitment_model->activaterecruitment($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Recruitment HR');
            redirect('/admin/recruitments/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->recruitment_model->deleterecruitment($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Recruitment HR successfully deleted');
        redirect('/admin/recruitments/');
    }

    public function deactivateRecruitment() {
        $id = $this->uri->segment(4);
        $this->recruitment_model->deactivaterecruitment($id);
        $this->session->set_flashdata('smessage', 'Recruitment HR successfully deactivated');
        redirect('/admin/recruitments/');
    }

    public function activateRecruitment() {
        $id = $this->uri->segment(4);
        $this->recruitment_model->activaterecruitment($id);
        $this->session->set_flashdata('smessage', 'Recruitment HR successfully activated');
        redirect('/admin/recruitments/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
