<?php

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($offset = 0) {
        ob_start();
        $this->ajax_page(0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['table'] = "<div id='content'>" . $initial_content . "</div>";
        $this->load->view('page', $data);
    }

    function ajax_page($offset = 0) {
        $this->load->model('model_table');
        $this->load->library('Jquery_pagination');
        $config['base_url'] = site_url('test/ajax_page/');
        $config['div'] = '#content';
        $limit = 5;
        $config['total_rows'] = $this->model_table->num_rows();
        $config['per_page'] = $limit;
        $this->jquery_pagination->initialize($config);
        $this->load->library('table');
        $html = $this->table->generate($this->model_table->content($limit, $offset)) . "<br>" . $this->jquery_pagination->create_links();
        echo $html;
    }

}

?>