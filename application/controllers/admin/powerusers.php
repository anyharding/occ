<?php

class Powerusers extends CI_Controller {

    private $limit = 10;
    private $uri_segment = 4;

    function __construct() {
        parent::__construct();
        $this->load->model('poweruser_model');
        $this->load->library('pagination');
    }

    public function index() {
        $config['base_url'] = base_url() . "admin/powerusers/index";
        $config['total_rows'] = $this->poweruser_model->countpowerusers('normal_poweruser');
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        if (isset($_POST['search'])) {
            if ($_POST['search'] == '')
                $search = 'all';
            else
                $search = $this->input->post('search');
            $config['total_rows'] = $this->poweruser_model->countsearchpowerusers($search);
            $config['base_url'] = base_url() . "admin/powerusers/index/search/" . $search;
            $powerusers_list = $this->poweruser_model->searchpowerusers($search, 'normal_poweruser', $config['per_page'], $this->uri->segment(6));
        }
        else {
            if ($this->uri->segment(4) == 'search') {
                $search = $this->uri->segment(5);
                $config['total_rows'] = $this->poweruser_model->countsearchpowerusers($search);
                $config['base_url'] = base_url() . "admin/powerusers/index/search/" . $search;
                $config['uri_segment'] = 6;
                $powerusers_list = $this->poweruser_model->searchpowerusers($search, 'normal_poweruser', $config['per_page'], $this->uri->segment(6));
            }
            else
                $powerusers_list = $this->poweruser_model->powerusersList($config['per_page'], $this->uri->segment(4), "normal_poweruser");
        }
        $data['title'] = "poweruser List";
        $this->pagination->initialize($config);
        $data['powerusers'] = $powerusers_list;
        $this->template->load('admin', 'admin/powerusers/index', $data);
        //echo "<pre>";print_r($powerusers_list);
    }

    public function addPoweruser() {

        $redirect = '/admin/powerusers/';

        $data['title'] = "Add Employee";

        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|min_length[8]');
        $this->form_validation->set_message('is_unique', 'The e-mail address is already registered in Employee Management');
        $this->form_validation->set_message('is_unique1', 'The Username is already registered in Employee Management');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin', 'admin/powerusers/addPoweruser', $data);
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
                    'role' => 2,
                    'contact_no' => $contact,
                    'created' => date('Y-m-d'),
                    'status' => '1'
                );
                $this->poweruser_model->poweruserRegistration($data);
                $this->email->set_mailtype("html");
                $mail_data['poweruserDetail'] = $data;
                $mail_data['text'] = "Your account has been created successfully on " . SITE_TITLE . ' from admin as an Power User<br><br>Click here link to login ' . HTTP_PATH . 'welcome';
                $mail_data['email'] = $email;
                $mail_data['password'] = $password;
                $mail_data['username'] = $this->input->post('username');
                $mail_data['firstname'] = $firstname;
                $this->load->library('parser');
                $msg = $this->parser->parse('email/template', $mail_data, TRUE);
                $this->email->from(FORM_EMAIL, SITE_TITLE);
                $this->email->to($email);
                $this->email->subject('Login Details');
                $this->email->message($msg);
                $this->email->send();

                $this->session->set_flashdata('smessage', 'power User Successfully added');
                redirect($redirect);
            }
        }
    }

    public function editPoweruser() {
        $id = $this->uri->segment(4);
        $poweruser_detail = $this->poweruser_model->poweruserDetail($id);
        $data['poweruser_detail'] = $poweruser_detail;
        $data['title'] = "Edit Power User";
        //print_r($poweruser_detail);
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', "valid_email|required|is_unique_again[emp_powerusers.email.$id]");
        $this->form_validation->set_rules('username', 'Username', "required|is_unique_again1[emp_users.username.$id]");
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_message('is_unique_again', 'The e-mail address is already registered in  Employee Management');
        $this->form_validation->set_message('is_unique_again1', 'The username is already registered in  Employee Management');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin', 'admin/powerusers/editPoweruser', $data);
        } else {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $contact = $this->input->post('contact');


            if ($poweruser_detail[0]['password'] <> $this->input->post('password')) {

                $this->email->set_mailtype("html");
                $mail_data['text'] = "Your password has been changed by admin, Please login using new password";
                $mail_data['email'] = $email;
                $mail_data['password'] = $this->input->post('password');
                $mail_data['username'] = $this->input->post('username');
                $mail_data['firstname'] = $firstname;
                $this->load->library('parser');
                $msg = $this->parser->parse('email/template', $mail_data, TRUE);
                $this->email->from(FORM_EMAIL, SITE_TITLE);
                $this->email->to($email);
                $this->email->subject('Password successfully changed');
                $this->email->message($msg);
                $this->email->send();
            }

            $data = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email' => $email,
                'contact_no' => $contact
            );
            $this->poweruser_model->editPoweruser($data, $id);
            $this->session->set_flashdata('smessage', 'Power User Successfully updated');
            redirect('/admin/powerusers/index/');
        }
    }

    public function deletePoweruser() {
        $id = $this->uri->segment(4);
//            $poweruser_detail = $this->poweruser_model->poweruserDetail($id);
//            if(file_exists('poweruser_images/'.$poweruser_detail[0]['image'])){
//                unlink('poweruser_images/'.$poweruser_detail[0]['image']);}
        $this->poweruser_model->deletepoweruser($id);
        $this->session->set_flashdata('smessage', 'Power User Successfully deleted');
        redirect('/admin/powerusers/');
    }

    public function activateallPoweruser() {
        $id = $this->uri->segment(4);
        $this->poweruser_model->activatepoweruser($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Power User');
            redirect('/admin/powerusers/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->poweruser_model->activatepoweruser($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Power Users successfully activated');
        redirect('/admin/powerusers/');
    }

    public function deactivateallPoweruser() {
        $id = $this->uri->segment(4);
        $this->poweruser_model->activatepoweruser($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Power User');
            redirect('/admin/powerusers/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->poweruser_model->deactivatepoweruser($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Power Users successfully deactivated');
        redirect('/admin/powerusers/');
    }

    public function deleteallPoweruser() {
        $id = $this->uri->segment(4);
        $this->poweruser_model->activatepoweruser($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Power User');
            redirect('/admin/powerusers/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->poweruser_model->deletepoweruser($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Power Users successfully deleted');
        redirect('/admin/powerusers/');
    }

    public function deactivatePoweruser() {
        $id = $this->uri->segment(4);
        $this->poweruser_model->deactivatepoweruser($id);
        $this->session->set_flashdata('smessage', 'Power User successfully deactivated');
        redirect('/admin/powerusers/');
    }

    public function activatePoweruser() {
        $id = $this->uri->segment(4);
        $this->poweruser_model->activatepoweruser($id);
        $this->session->set_flashdata('smessage', 'Power User successfully activated');
        redirect('/admin/powerusers/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
