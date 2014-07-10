<?php

class Applicant extends CI_Controller {

    private $limit = 10;
    private $uri_segment = 4;

    function __construct() {
        parent::__construct();
        $this->load->model('applicant_model');
        $this->load->library('pagination');
    }

    public function index() {
        $config['base_url'] = base_url() . "admin/applicant/index";
        $config['total_rows'] = $this->applicant_model->countApplicant();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        if (isset($_POST['search'])) {
            if ($_POST['search'] == '')
                $search = 'all';
            else
                $search = $this->input->post('search');
            $config['total_rows'] = $this->applicant_model->countsearchApplicant($search);
            $config['base_url'] = base_url() . "admin/applicant/index/search/" . $search;
            $applicant = $this->applicant_model->searchApplicant($search, $config['per_page'], $this->uri->segment(6));
        }
        else {
            if ($this->uri->segment(4) == 'search') {
                $search = $this->uri->segment(5);
                $config['total_rows'] = $this->applicant_model->countsearchApplicant($search);
                $config['base_url'] = base_url() . "admin/applicant/index/search/" . $search;
                $config['uri_segment'] = 6;
                $applicant = $this->applicant_model->searchApplicant($search, $config['per_page'], $this->uri->segment(6));
            }
            else
                $applicant = $this->applicant_model->powerusersList($config['per_page'], $this->uri->segment(4), "normal_poweruser");
        }
        $data['title'] = "Applicant List";
        $this->pagination->initialize($config);
        $data['applicant'] = $applicant;
        $this->template->load('admin', 'admin/applicant/index', $data);
    }

    public function addApplicant() {

        $data['title'] = "Add Applicant";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[emp_users.email]|is_unique[emp_applicant.email]');
        $this->form_validation->set_message('is_unique', 'The e-mail address is already Employed');
        $this->form_validation->set_rules('status', 'Application Status', 'required');
        $this->form_validation->set_rules('height', 'Height', 'trim|numeric');
        if ($this->form_validation->run() == FALSE) {
            $data['users'] = $this->applicant_model->get_tenants();
            $this->template->load('admin', 'admin/applicant/addApplicant', $data);
        } else {
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'referrer' => $this->input->post('referrer'),
                'gender' => $this->input->post('gender'),
                'height' => $this->input->post('height'),
                'passport_no' => $this->input->post('passport_no'),
                'date1' => $this->input->post('date1'),
                'date2' => $this->input->post('date2'),
                'english' => $this->input->post('english'),
                'exp' => $this->input->post('exp'),
                'vahicle' => $this->input->post('vehicle'),
                'comment' => $this->input->post('comment'),
                'notes' => $this->input->post('notes'),
                'status' => $this->input->post('status')
            );
            $this->applicant_model->addApplicant($data);

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

            $this->session->set_flashdata('smessage', 'Applicant Successfully added');
            redirect('/admin/applicant/');
        }
    }

    public function editApplicant() {
        $id = $this->uri->segment(4);
        $applicant = $this->applicant_model->applicantDetail($id);
        $data['applicant'] = $applicant;
        $data['title'] = "Edit Applicant";
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_message('is_unique_again', 'The e-mail address is already Employed');
        $this->form_validation->set_rules('status', 'Application Status', 'required');
        $this->form_validation->set_rules('height', 'Height', 'trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['users'] = $this->applicant_model->get_tenants();
            $this->template->load('admin', 'admin/applicant/editApplicant', $data);
        } else {
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'mobile' => $this->input->post('mobile'),
                'referrer' => $this->input->post('referrer'),
                'gender' => $this->input->post('gender'),
                'height' => $this->input->post('height'),
                'passport_no' => $this->input->post('passport_no'),
                'date1' => $this->input->post('date1'),
                'date2' => $this->input->post('date2'),
                'english' => $this->input->post('english'),
                'exp' => $this->input->post('exp'),
                'vahicle' => $this->input->post('vehicle'),
                'comment' => $this->input->post('comment'),
                'notes' => $this->input->post('notes'),
                'status' => $this->input->post('status')
            );
            $this->applicant_model->editApplicant($data, $id);
            $this->session->set_flashdata('smessage', 'Applicant Successfully updated');
            redirect('/admin/applicant/index/');
        }
    }

    public function deleteApplicant() {
        $id = $this->uri->segment(4);
        $this->applicant_model->deleteApplicant($id);
        $this->session->set_flashdata('smessage', 'Applicant Successfully deleted');
        redirect('/admin/applicant/');
    }

    public function activateallApplicant() {
        $id = $this->uri->segment(4);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Applicant');
            redirect('/admin/applicant/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->applicant_model->activateApplicant($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Applicants successfully activated');
        redirect('/admin/applicant/');
    }

    public function deactivateallApplicant() {
        $id = $this->uri->segment(4);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Applicant');
            redirect('/admin/applicant/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->applicant_model->deactivateApplicant($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Applicants successfully deactivated');
        redirect('/admin/applicant/');
    }

    public function deleteallApplicant() {
        $id = $this->uri->segment(4);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Applicant');
            redirect('/admin/applicant/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->applicant_model->deleteApplicant($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Applicants successfully deleted');
        redirect('/admin/applicant/');
    }

    public function deactivateApplicant() {
        $id = $this->uri->segment(4);
        $this->applicant_model->deactivateApplicant($id);
        $this->session->set_flashdata('smessage', 'Applicant successfully deactivated');
        redirect('/admin/applicant/');
    }

    public function activateApplicant() {
        $id = $this->uri->segment(4);
        $this->applicant_model->activateApplicant($id);
        $this->session->set_flashdata('smessage', 'Applicant successfully activated');
        redirect('/admin/applicant/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
