<?php
class Countries extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('country_model','Country',true);
	}
	public $limit = 10;
        
	public function index() {
            $config['base_url']      = base_url()."admin/countries/index";
            $config['total_rows']    = $this->Country->countCountries();
            $config['per_page']      = $this->limit; 
            $this->load->library('pagination');
            if(isset($_POST['search'])) {
                if($_POST['search'] == '')
                    $search = 'all';
                else
                    $search = $this->input->post('search');
                $config['total_rows']    = $this->Country->countsearchCountries($search);
                $config['base_url']      = base_url()."admin/countries/index/search/".$search;
                $config['uri_segment']   = 6;
                $countries_list = $this->Country->searchCountries($search, $config['per_page'], $this->uri->segment(6));
            }
            else {
                    if($this->uri->segment(4) == 'search') {
                        $search                  = $this->uri->segment(5);
                        $config['total_rows']    = $this->Country->countsearchCountries($search);
                        $config['base_url']      = base_url()."admin/countries/index/search/".$search;
                        $config['uri_segment']   = 6;
                        $countries_list = $this->Country->searchCountries($search, $config['per_page'], $this->uri->segment(6));
                    }
                    else {
                        $config['uri_segment']   = 4;
                        $countries_list = $this->Country->countriesList($config['per_page'], $this->uri->segment(4));
                    }
            }
            $data['title'] = "Countries List";
            $this->pagination->initialize($config);
            $data['countries'] = $countries_list;
            $data['pagination'] = $this->pagination->create_links();
            $this->template->load('admin','admin/countries/index',$data);
	}
        
	/*public function index($sort_by = 'id', $sort_order = 'asc', $offset = 0){
		$results = $this->Country->getcountries($this->limit, $offset, $sort_by, $sort_order);
		//print_r($results);die;
		$data['countries'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		$data['page'] = $this->uri->segment(6);
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/countries/index/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 6;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
                $data['title'] = "Countries List";
		$this->template->load('admin','admin/countries/index',$data);
	}*/
	public function addCountry(){
		if($_POST){
			$this->form_validation->set_rules('country_name', 'Country Name','trim|required|is_unique[tbl_countries.country_name]');
			if($this->form_validation->run() == FALSE)
			{
					
			}else{
				$this->Country->save();
				$this->session->set_userdata('smessage','country added successfully.');
				redirect('admin/countries/index');
			}

		}
                $data['title'] = "Add Country";
		$this->template->load('admin','admin/countries/add_country', $data);
	}

	public function editCountry($id){
		if($_POST){
			$this->form_validation->set_rules('country_name', 'Country Name', 	'trim|required');
			if($this->form_validation->run() == FALSE)
			{
					
			}else{
				$this->Country->update();
				$this->session->set_userdata('smessage','Country updated successfully.');
				redirect('admin/countries/index');

			}
		}
		$data['result'] = $this->Country->getCountryDetail($id);	
                $data['title'] = "Edit Country";
		$this->template->load('admin','admin/countries/edit_country',$data);
	}

	public function deactivateCountry($id){
		$this->Country->deactivate($id);
		$this->session->set_userdata('smessage','Country deactivate successfully.');
		redirect('admin/countries/index');
	}

	public function activateCountry($id){
		$this->Country->activate($id);
		$this->session->set_userdata('smessage','Country activated successfully.');
		redirect('admin/countries/index');
	}

	public function deleteCountry($id){
		$this->Country->delete($id);
		$this->session->set_userdata('smessage','Country deleted successfully.');
		redirect('admin/countries/index');
	}
	
	public function states($countId, $sort_by = 'id', $sort_order = 'asc', $offset = 0){
		$data['country_id']= $countId;
		$data['country_name']=$this->Country->getCountryName($countId);
		$results = $this->Country->getStates($countId,$this->limit, $offset, $sort_by, $sort_order);
		//print_r($results);die;
		$data['provinces'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		$data['page'] = $this->uri->segment(7);
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/countries/states/$countId/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 7;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
                $data['title'] = "State";
		$this->template->load('admin','admin/countries/state_index',$data);
	}
	
	public function addProvince($Cid){
		$data['country_id']= $Cid;
		$data['countries'] = $this->Country->countryList();//print_r($data['countries']);
		if($_POST){
			$this->form_validation->set_rules('province_name', 'Province Name', 	'trim|required|is_unique[tbl_province.province_name]');
			if($this->form_validation->run() == FALSE)
			{
					
			}else{
				$this->Country->saveProvince();
				$this->session->set_flashdata('smessage','Province added successfully.');
				redirect('admin/countries/states/'.$Cid);
			}

		}
                $data['title'] = "Add Province";
		$this->template->load('admin','admin/countries/add_province',$data);
	}
	
	public function editProvince($id, $cid){
		if($_POST){
			$this->form_validation->set_rules('province_name', 'Province Name', 	'trim|required');
			if($this->form_validation->run() == FALSE)
			{
					
			}else{
				$this->Country->updateProvince();
				$this->session->set_flashdata('smessage','Province updated successfully.');
				redirect('admin/countries/states/'.$cid);

			}
		}
		$data['countries'] = $this->Country->countryList();
		$data['result'] = $this->Country->getProvinceDetail($id);
                $data['title'] = "Edit Province";
		$this->template->load('admin','admin/countries/edit_province',$data);
	}
	
	public function deactivateProvince($id,$Cid){
		$this->Country->deactivateProvince($id);
		$this->session->set_flashdata('smessage','Province deactivated successfully.');
		redirect('admin/countries/states/'.$Cid);
	}

	public function activateProvince($id,$Cid){
		$this->Country->activateProvince($id);
		$this->session->set_flashdata('smessage','Province activated successfully.');
		redirect('admin/countries/states/'.$Cid);
	}

	public function deleteProvince($id,$Cid){
		$this->Country->deleteProvince($id);
		$this->session->set_flashdata('smessage','Province deleted successfully.');
		redirect('admin/countries/states/'.$Cid);
	}
	
	public function cities($PId, $sort_by = 'id', $sort_order = 'asc', $offset = 0){
                $PId = $this->uri->segment(4);
		$data['province_id']= $this->uri->segment(4);
		$provinceDetail = $this->Country->getProvinceName($PId);
		$data['province_name']=$provinceDetail['province_name'];
		$data['country_id']=$provinceDetail['country_id'];
		$data['country_name']=$this->Country->getCountryName($provinceDetail['country_id']);
		
		$results = $this->Country->getCities($PId,$this->limit, $offset, $sort_by, $sort_order);
		//print_r($results);die;
		$data['cities'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		$data['page'] = $this->uri->segment(7);
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/countries/cities/$PId/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 7;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
                $data['title'] = "Cities";
		$this->template->load('admin','admin/countries/city_index',$data);
	}
	
	public function addCity($Pid){
                $Pid = $this->uri->segment(5);
		$country_id = $this->Country->countryId($Pid);
		$data['country_id']= $country_id;
		$data['country_name']= $this->Country->getCountryName($country_id);
		$data['province_id']= $Pid;
		$provinceDetail = $this->Country->getProvinceName($Pid);
		$data['province_name']=$provinceDetail['province_name'];
		$data['provinces'] = $this->Country->provinceList($country_id);
		if($_POST){
			$this->form_validation->set_rules('city_name', 'City Name','trim|required|is_unique[tbl_cities.city_name]');
			if($this->form_validation->run() == FALSE)
			{
					
			}else{ 
				$this->Country->saveCity();
				$this->session->set_flashdata('smessage','City added successfully.');
				redirect('admin/countries/cities/'.$_POST['province_id']);
			}

		}
                $data['title'] = "Add City";
		$this->template->load('admin','admin/countries/add_city',$data);
	}
	
	public function editCity($id,$pid){
		$data['result'] = $this->Country->getCityDetail($id);
		
		$country_id = $this->Country->countryId($pid);
		$data['country_id']= $country_id;
		$data['country_name']= $this->Country->getCountryName($country_id);
		$data['province_id']= $pid;
		$provinceDetail = $this->Country->getProvinceName($pid);
		$data['province_name']=$provinceDetail['province_name'];
		$data['provinces'] = $this->Country->provinceList($country_id);
		if($_POST){
			$this->form_validation->set_rules('city_name', 'City Name', 	'trim|required');
			if($this->form_validation->run() == FALSE)
			{
					
			}else{
				$this->Country->updateCity();
				$this->session->set_flashdata('smessage','City updated successfully.');
				redirect('admin/countries/cities/'.$_POST['province_id']);

			}
		}
		
                $data['title'] = "Edit City";
		$this->template->load('admin','admin/countries/edit_city',$data);
	}
	
	public function deactivateCity($id,$Pid){
		$this->Country->deactivateCity($id);
		$this->session->set_flashdata('smessage','City deactivated successfully.');
		redirect('admin/countries/cities/'.$Pid);
	}

	public function activateCity($id,$Pid){
		$this->Country->activateCity($id);
		$this->session->set_flashdata('smessage','City activated successfully.');
		redirect('admin/countries/cities/'.$Pid);
	}

	public function deleteCity($id,$Pid){
		$this->Country->deleteCity($id);
		$this->session->set_flashdata('smessage','City deleted successfully.');
		redirect('admin/countries/cities/'.$Pid);
	}
        public function activateallCountries() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one country');
                redirect('/admin/countries/index');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Country->activate($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected countries successfully activated');
            redirect('/admin/countries/index');
	}
	public function deactivateallCountries() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one country');
                redirect('/admin/countries/index');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Country->deactivate($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected countries successfully deactivated');
            redirect('/admin/countries/index');
	}
	public function deleteallCountries() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one country');
                redirect('/admin/countries/index');
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Country->delete($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Countries users successfully deleted');
            redirect('/admin/countries/index');
	}
        
        //for states
        public function activateallStates() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one state');
                redirect('/admin/countries/states/'.$id);
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Country->activateProvince($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected states successfully activated');
            redirect('/admin/countries/states/'.$id);
	}
	public function deactivateallStates() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one state');
                redirect('/admin/countries/states/'.$id);
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Country->deactivateProvince($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected states successfully deactivated');
            redirect('/admin/countries/states/'.$id);
	}
	public function deleteallStates() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one state');
                redirect('/admin/countries/states/'.$id);
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Country->deleteProvince($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'States users successfully deleted');
            redirect('/admin/countries/states/'.$id);
	}
        
        //for cities
        public function activateallCities() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one city');
                redirect('/admin/countries/cities/'.$id);
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Country->activateCity($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected cities successfully activated');
            redirect('/admin/countries/cities/'.$id);
	}
	public function deactivateallCities() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one city');
                redirect('/admin/countries/cities/'.$id);
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Country->deactivateCity($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'Selected cities successfully deactivated');
            redirect('/admin/countries/cities/'.$id);
	}
	public function deleteallCities() {
            $id = $this->uri->segment(4);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                $this->session->set_flashdata('message', 'Please select atleast one city');
                redirect('/admin/countries/cities/'.$id);
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Country->deleteCity($checked[$i]);
            }
            $this->session->set_flashdata('smessage', 'States cities successfully deleted');
            redirect('/admin/countries/cities/'.$id);
	}

}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
