<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Postsmodel extends Model
{
	
	public function __construct()
	{
		parent::Model();	
	}
	
	public function count_posts($cat='')
	{
		($cat)? $this->db->where('category', $cat) : '' ;
		return $this->db->count_all_results('posts');
	}
	
	public function list_posts($limit, $offset, $cat='')
	{
		($cat)? $this->db->where('category', $cat) : '' ;
		$this->db->limit($limit, $offset);
		$query = $this->db->get('posts');
		return $query->result();
	}
}