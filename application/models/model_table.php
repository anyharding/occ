<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_table extends CI_Model{
	
	var $tbl_name = 'emp_cities';
	
	function __construct() {
		parent::__construct();
	}
		
	function num_rows() {
		return $this->db->count_all( $this->tbl_name );
	}
	
	function content( $limit, $offset ) {
		return $this->db->get( $this->tbl_name, $limit, $offset );
	}
	
}

?>