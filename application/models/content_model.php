<?php

class Content_model extends CI_MOdel
{
	public function __construct() {
		parent::__construct();
	}
	public function contentList() {
                $this->db->select('id, title');
		$query = $this->db->get('content');
		return $query->result();
	}
	public function contentDetail($id) {
		$query = $this->db->get_where('content', "id = $id");
		return $query->result_array();
	}
	public function updateContent($data, $id) {
                $this->db->where("id = $id");
		$this->db->update('content', $data);
	}
	

}
