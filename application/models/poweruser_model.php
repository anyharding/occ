<?php

class Poweruser_model extends CI_MOdel
{
	public function __construct() {
            parent::__construct();
	}

	public function poweruserRegistration($data) {
            $query = $this->db->insert('users', $data);
	}
        public function checkpowerusername($username) {
            $query = $this->db->get_where('users', array('username'=>$username));
            return $query->num_rows();
        }
        public function checkEmail($email) {
            $query = $this->db->get_where('users', array('email'=>$email));
            return $query->num_rows();
        }
        public function powerusersList($num, $offset, $type) {
            $this->db->order_by('id','desc');
            $query = $this->db->get_where('users', array('role'=>2), $num, $offset);
            return $query->result();
	}
	public function get_powerusers() {
            $query = $this->db->get_where('users', array('role'=>2));
            $powerusers = $query->result_array();
            $new = array();
            for($i = 0; $i<count($powerusers); $i++){ 
                    $key = $powerusers[$i]['id'];
                    $value = $powerusers[$i]['powerusername'];
                    $new[$key] = $value;
            }
            return $new;
	}
	public function get_countries() {
            $query = $this->db->get('countries');
            $countries = $query->result_array(); 
            for($i = 0; $i<count($countries); $i++){ 
                    $key = $countries[$i]['id'];
                    $value = $countries[$i]['country_name'];
                    $new[$key] = $value;
            }
            return $new;
	}
	public function get_province($country_id = NULL) {
            $query = $this->db->get_where('province', array('country_id'=>$country_id));
            $province = $query->result();
            $new = array();
            return $province;
	}
	public function get_provinces_for_listing($country_id = NULL) {
            $query = $this->db->get_where('province', array('country_id'=>$country_id, 'status'=>'1'));
            $province = $query->result_array();
            $new = array();
            if(!empty($province)) {
                return $province;
            }
            else {
                return $new;
            }
	}
	public function get_provinces_name_for_listing($id = NULL) {
            $query = $this->db->get_where('province', array('id'=>$id, 'status'=>'1'));
            $province = $query->row_array();
            if(!empty($province)) {
                return $province['province_name'];
            }
            else {
                return '';
            }
	}
	public function get_city_name_for_listing($id = NULL) {
            $query = $this->db->get_where('cities', array('id'=>$id, 'status'=>'1'));
            $city = $query->row_array();
            if(!empty($city)) {
                return $city['city_name'];
            }
            else {
                return '';
            }
	}
	public function get_provinces($country_id = NULL) {
            $query = $this->db->get_where('province', array('country_id'=>$country_id, 'status'=>'1'));
            $province = $query->result_array();
            $new = array();
            if(!empty($province))
                for($i = 0; $i<count($province); $i++){ 
                        $key = $province[$i]['id'];
                        $value = $province[$i]['province_name'];
                        $new[$key] = $value;
                }
            return $new;
	}
	public function get_cities($province_id = NULL) {
            $query = $this->db->get_where('cities', array('province_id'=>$province_id));
            $cities = $query->result_array(); 
            $new = array();
            if(!empty($cities))
                for($i = 0; $i<count($cities); $i++){ 
                        $key = $cities[$i]['id'];
                        $value = $cities[$i]['city_name'];
                        $new[$key] = $value;
                }
            return $new;
	}
	public function poweruserDetail($id) {
            $query = $this->db->get_where('users', array('id'=>$id));
            return $query->result_array();
	}
	public function editpoweruser($data, $id) {
            $this->db->where('id', $id);
            $this->db->update('users', $data);
	}
	public function deletepoweruser($id) {
            $this->db->delete('users', array('id'=>$id));
	}
	public function activatepoweruser($id) {
            $this->db->where('id', $id);
            $this->db->update('users', array('status'=>'1'));
	}
	public function deactivatepoweruser($id) {
            $this->db->where('id', $id);
            $this->db->update('users', array('status'=>'0'));
	}
	public function searchpowerusers($search, $type, $num, $offset) {
            if($search <> 'all') {
                $this->db->or_like(array('firstname'=>$search));
            }
            $query = $this->db->get_where('users', array('role'=>2), $num, $offset);
            return $query->result();
	}
	public function countpowerusers($type) {
            $this->db->select('id');
            $query = $this->db->get_where('users', array('role'=>2));
            return $query->num_rows();
	}
	public function getpoweruserName($id) {
            $this->db->select('username');
            $query = $this->db->get_where('users', array('id'=>$id));
            $array = $query->row_array();
            if(!empty($array)) {
                return $array['username'];
            }
            else {
                return '';
            }
	}
        public function countsearchpowerusers($search) {
            $this->db->select('id');
            if($search <> 'all') {
                $this->db->or_like(array('firstname'=>$search));
            }
            $query = $this->db->get_where('users', array('role'=>2));
            return $query->num_rows();
	}

}
