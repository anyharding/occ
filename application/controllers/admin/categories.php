<?php
class Categories extends CI_Controller
{
	function __construct()
	{
            parent::__construct();
            $this->load->model('category_model','Category',true);
	}
	public $limit = 10;
	public function index() {
            $config['base_url']      = base_url()."admin/categories/index";
            $data['parent_id']= NULL;
            $config['total_rows']    = $this->Category->countCategories();
            $config['per_page']      = $this->limit; 
            $this->load->library('pagination');
            if(isset($_POST['search'])) {
                if($_POST['search'] == '')
                    $search = 'all';
                else
                    $search = $this->input->post('search');
                $config['total_rows']    = $this->Category->countsearchCategories($search);
                $config['base_url']  = base_url()."admin/categories/index/search/".$search;
                $config['uri_segment']   = 6;
                $countries_list = $this->Category->searchCategories($search, $config['per_page'], $this->uri->segment(6));
            }
            else {
                if($this->uri->segment(4) == 'search') {
                    $search                  = $this->uri->segment(5);
                    $config['total_rows']    = $this->Category->countsearchCategories($search);
                    $config['base_url']      = base_url()."admin/categories/index/search/".$search;
                    $config['uri_segment']   = 6;
                    $countries_list = $this->Category->searchCategories($search, $config['per_page'], $this->uri->segment(6));
                }
                else {
                    $config['uri_segment']   = 4;
                    $countries_list = $this->Category->categoriesList($config['per_page'], $this->uri->segment(4));
                }
            }
            $data['title'] = "Countries List";
            $this->pagination->initialize($config);
            $data['categories'] = $countries_list;
            $data['pagination'] = $this->pagination->create_links();
            $this->template->load('admin','admin/categories/index',$data);
	}
        
	/*function index($id=NULL,$sort_by = 'id', $sort_order = 'asc', $offset = 0) {
		
		$data['parent_id']= $id;
		
		$this->session->set_userdata('userName',$this->input->post('userName'));
		$results = $this->Category->getcategories($id=NULL,$this->limit, $offset, $sort_by, $sort_order);
		//print_r($results);die;
		$data['categories'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		$data['page'] = $this->uri->segment(6);
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/categories/index/0/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 5;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
                $data['title'] = "Categories List";
		$this->template->load('admin','admin/categories/index',$data);
	}
	*/
	public function addCategory($pid=NULL){
            //echo __DIR__;die;
            $data['parent_id'] = $pid;
            $data['parent_name'] = $this->Category->getCategoryName($pid);
            $data['parentCategory'] = $this->Category->parentCategories();
            if($_POST){
                $this->load->library('form_validation');
                if($this->uri->segment(4))
                    $this->form_validation->set_rules('category_name', 'SubCategory Name','required|alpha_int');
                else
                    $this->form_validation->set_rules('category_name', 'Category Name','required|alpha_int');
                if($this->form_validation->run() == FALSE)
                {

                }else{
                    if($this->uri->segment(4))
                        $chkUsername = $this->Category->checksubCategoryname($this->input->post('category_name'), $this->uri->segment(4));
                    else
                        $chkUsername = $this->Category->checkCategoryname($this->input->post('category_name'));
                    if($chkUsername <> 0) {
                        if($this->uri->segment(4))
                            $this->session->set_userdata('message', '-Sub Category already Added');
                        else
                            $this->session->set_userdata('message', '-Category already Added');
                        redirect('/admin/categories/addCategory/'.$this->uri->segment(4));
                    }
                    $config['upload_path'] = 'category_images/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size']	= '200000';
                    $config['max_width']  = '30';
                    $config['max_height']  = '25';

                    $this->load->library('upload', $config);
                        //echo $_FILES['image']['name'];die;
                    if(isset($_FILES['image']['name']) and $_FILES['image']['name'] <> '') {

                        $this->upload->do_upload('image');
                        $image = $this->upload->data();
                        $image = $image['file_name'];
                        if($this->upload->display_errors()) {
                            $error = $this->upload->display_errors();
                            $this->session->set_userdata('message', $error);
                            redirect('admin/categories/addCategory');
                        }
                    }
                    else {
                        $image = '';
                    }
                    /*
                    $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/comp5/free_classified/site/category_img/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']	= '100908980098';
                    $config['max_width']  = '1024123';
                    $config['max_height']  = '768123123';
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('category_image'))
                    {
                        $error = $this->upload->display_errors();
                        $this->session->set_userdata('message', $error);
                        redirect('/admin/categories/addCategory/'.$this->uri->segment(4));
                        $this->load->view('upload_form', $error);
                    }
                    else {
                        $data = $this->upload->data();
                     * 
                     */
                        $this->Category->save($image);
                        if(isset($_POST['parent_id']) and $_POST['parent_id']){
                            $this->session->set_userdata('message','subcategory added successfully.');
                            redirect('admin/categories/subCategories/'.$_POST['parent_id']);
                        }else{
                            $this->session->set_userdata('smessage','category added successfully.');
                            redirect('admin/categories/index');
                        }
                    //}
                }
            }
            $data['title'] = "Add Category";
            $this->template->load('admin','admin/categories/add_category',$data);
	}
	public function editCategory($id,$pid=NULL){
            $data['parent_id'] = $pid;
            $data['parent_name'] = $this->Category->getCategoryName($pid);
            $data['parentCategory'] = $this->Category->parentCategories();
            $categoryDetails = $this->Category->getCategoryDetail($id);
            $data['result'] = $categoryDetails;
            if($_POST){
                $this->form_validation->set_rules('category_name', 'Category Name', 	'trim|required');
                if($this->form_validation->run() == FALSE)
                {

                }else{
                    $config['upload_path'] = 'category_images/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size']	= '200000';
                    $config['max_width']  = '30';
                    $config['max_height']  = '25';

                    $this->load->library('upload', $config);
                        
                    if(isset($_FILES['image']['name']) and $_FILES['image']['name'] <> '') {
                        $this->upload->do_upload('image');
                        $image = $this->upload->data();
                        $image = $image['file_name'];
                        if($this->upload->display_errors()) {
                            $error = $this->upload->display_errors();
                            $this->session->set_userdata('message', $error);
                            redirect('admin/categories/editCategory/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
                        }
                        else{
                            foreach($categoryDetails as $row);
                            if(file_exists('category_images/'.$row->image)){
                                unlink('category_images/'.$row->image);
                            }
                        }
                    }
                    else {
                        foreach($categoryDetails as $row_cat);
                        $image = $row_cat->image;
                    }
                    
                    $this->Category->update($image);
                    if(isset($_POST['parent_id']) and $_POST['parent_id']){
                    $this->session->set_userdata('smessage','subcategory updated successfully.');
                    redirect('admin/categories/subCategories/'.$_POST['parent_id']);
                    }else{
                        $this->session->set_userdata('smessage','category updated successfully.');
                    redirect('admin/categories/index');
                    }
                }
            }
            $data['title'] = "Edit Category";
            $this->template->load('admin','admin/categories/edit_category',$data);
	}
	
	public function deactivateCategory($id,$pid=NULL){
		$this->Category->deactivate($id);
			if($pid){
				$this->session->set_userdata('smessage','Subcategory deactivate successfully.');
				redirect('admin/categories/subCategories/'.$pid);
				}else{
				$this->session->set_userdata('smessage','Category deactivated successfully.');
				redirect('admin/categories/index');
				}
		
		redirect('admin/categories/index');
	}

	public function activateCategory($id,$pid=NULL){
		$this->Category->activate($id);
		if($pid){
				$this->session->set_userdata('smessage','Subcategory activated successfully.');
				redirect('admin/categories/subCategories/'.$pid);
				}else{
				$this->session->set_userdata('smessage','Category activated successfully.');
				redirect('admin/categories/index');
				}
	}

	public function deleteCategory($id,$pid=NULL){
			if($pid){
                                    $this->Category->delete($id);
                                    $this->session->set_userdata('smessage','Subcategory deleted successfully.');
                                    redirect('admin/categories/subCategories/'.$pid);
				}
                                else{
                                    $this->Category->delete($id);
                                    $this->Category->deleteAll($id);
                                    $this->session->set_userdata('smessage','Category deleted successfully.');
                                    redirect('admin/categories/index');
				}
	}
	
	public function subCategories($id, $sort_by = 'category_order', $sort_order = 'asc', $offset = 0){
		$data['parent_name'] = $this->Category->getCategoryName($id);
		$data['fields'] = array(
			'id' => 'ID',
			'category_name' => 'Category',
			'parent_id'     => 'Parent Category'
		);
		$data['parent_id']= $id;
		$this->session->set_userdata('userName',$this->input->post('userName'));
		$results = $this->Category->getcategories($id, $this->limit, $offset, $sort_by, $sort_order);
		//print_r($results);die;
		$data['categories'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		$data['page'] = $this->uri->segment(6);
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/categories/subCategories/$id/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 7;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
                $data['title'] = "SubCategories List";
		$this->template->load('admin','admin/categories/index',$data);
	}
	
	public function deactivateAll() {
            $id = $this->uri->segment(4);
            $this->Category->deactivate($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                if($this->uri->segment(4) == 'subCategories') {
                    $this->session->set_userdata('message', 'Please select atleast one subcategory');
                    redirect('/admin/categories/subCategories/'.$this->uri->segment(5));
                }
                else {
                    $this->session->set_userdata('message', 'Please select atleast one category');
                    redirect('/admin/categories/');
                }
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Category->deactivate($checked[$i]);
            }
            if($this->uri->segment(4) == 'subCategories') {
                $this->session->set_userdata('smessage', 'Selected subcategories successfully deactivated');
                redirect('/admin/categories/subCategories/'.$this->uri->segment(5));
            }
            else {
                $this->session->set_userdata('smessage', 'Selected categories successfully deactivated');
                redirect('/admin/categories/');
            }
	}
	
	public function activateall() {
            $id = $this->uri->segment(4);
            $this->Category->activate($id);
            $checked = $this->input->post('check');
            if(empty($checked)) {
                if($this->uri->segment(4) == 'subCategories') {
                    $this->session->set_userdata('message', 'Please select atleast one subcategory');
                    redirect('/admin/categories/subCategories/'.$this->uri->segment(5));
                }
                else {
                    $this->session->set_userdata('message', 'Please select atleast one category');
                    redirect('/admin/categories/');
                }
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Category->activate($checked[$i]);
            }
            if($this->uri->segment(4) == 'subCategories') {
                $this->session->set_userdata('smessage', 'Selected subcategories successfully activated');
                redirect('/admin/categories/subCategories/'.$this->uri->segment(5));
            }
            else {
                $this->session->set_userdata('smessage', 'Selected categories successfully activated');
                redirect('/admin/categories/');
            }
	}
        public function deleteAll() {
            $checked = $this->input->post('check');
            if(empty($checked)) {
                if($this->uri->segment(4) == 'subCategories') {
                    $this->session->set_userdata('message', 'Please select atleast one subcategory');
                    redirect('/admin/categories/subCategories/'.$this->uri->segment(5));
                }
                else {
                    $this->session->set_userdata('message', 'Please select atleast one category');
                    redirect('/admin/categories/');
                }
            }
            else {
                for($i = 0; $i < count($checked); $i++)
                    $this->Category->deleteallCategories($checked[$i]);
            }
            if($this->uri->segment(4) == 'subCategories') {
                $this->session->set_userdata('smessage', 'subcategories successfully deleted');
                redirect('/admin/categories/subCategories/'.$this->uri->segment(5));
            }
            else {
                $this->session->set_userdata('smessage', 'categories successfully deleted');
                redirect('/admin/categories/');
            }
        }
        public function up() {
            if($this->uri->segment(4) == 'parent') {
                $order = $this->uri->segment(5);
                $category_id = $this->uri->segment(6);
                $parent_id = $this->uri->segment(7);
                $pagging = $this->uri->segment(8);
                $get_upper_category_id =  $this->Category->getUpperCategoryId1($order, $parent_id);
            }
            else {
                $order = $this->uri->segment(4);
                $category_id = $this->uri->segment(5);
                $pagging = $this->uri->segment(6);
                $get_upper_category_id =  $this->Category->getUpperCategoryId($order);
            }
            //print_r($get_upper_category_id);die;
            $this->Category->interChangeId($order, $category_id, $get_upper_category_id['category_order'], $get_upper_category_id['id']);
            if($this->uri->segment(4) == 'parent') {
                redirect('admin/categories/subCategories/'.$parent_id.'/id/asc/'.$pagging);
            }
            else {
                redirect('admin/categories/index/'.$pagging);
            }
        }
        public function down() {
            if($this->uri->segment(4) == 'parent') {
                $order = $this->uri->segment(5);
                $category_id = $this->uri->segment(6);
                $parent_id = $this->uri->segment(7);
                $pagging = $this->uri->segment(8);
                $get_upper_category_id =  $this->Category->getLowerCategoryId1($order, $parent_id);
            }
            else {
                $order = $this->uri->segment(4);
                $category_id = $this->uri->segment(5);
                $pagging = $this->uri->segment(6);
                $get_upper_category_id =  $this->Category->getLowerCategoryId($order);
            }
            //print_r($get_upper_category_id);die;
            $this->Category->interChangeId($order, $category_id, $get_upper_category_id['category_order'], $get_upper_category_id['id']);
            if($this->uri->segment(4) == 'parent') {
                redirect('admin/categories/subCategories/'.$parent_id.'/id/asc/'.$pagging);
            }
            else {
                redirect('admin/categories/index/'.$pagging);
            }
        }
	
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
