<?php
class Content extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('content_model');
		$this->load->library('pagination');
	}
	public function index() {
            $content_list            = $this->content_model->contentList();
            $data['content_list']    = $content_list;
                $data['title']       = "Content List";
            $this->template->load('admin','admin/content/contentlist',$data);
		//echo "<pre>";print_r($users_list);
	}
        public function contentManagement() {
		$id = $this->uri->segment(4);
		$content_detail = $this->content_model->contentDetail($id);
		$data['content_detail'] = $content_detail;
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('content', 'content', 'trim|required');
                $data['title'] = "Manage Content";
		if($this->form_validation->run() == FALSE) {
                     $this->template->load('admin','admin/content/helpandSupport', $data);
		}
		else {
			if($_POST) {
				$title	 = $this->input->post('title');
				$content = $this->input->post('content');
		
				$data		 = array(
							'title' 	=>$title,
							'content'	=>$content
							);
				$this->content_model->updateContent($data, $id);
                                $this->session->set_flashdata('smessage', 'Contents successfully updated');
				redirect('/admin/content/');
			}
		}
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
