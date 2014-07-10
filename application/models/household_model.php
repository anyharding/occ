<?php

class Household_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function householdRegistration($data) {
        $query = $this->db->insert('house_hold', $data);
    }

    public function checkEmail($email) {
        $query = $this->db->get_where('house_hold', array('email' => $email));
        return $query->num_rows();
    }

    public function housesList($num, $offset, $type, $house = NULL) {
        if ($house <> NULL and $house <> 'all') {
            $this->db->where('house_id = ' . $house);
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('house_hold', $num, $offset);
        return $query->result();
    }

    public function get_houses() {
        $query = $this->db->get('houses');
        $houses = $query->result_array();
        $new = array();
        for ($i = 0; $i < count($houses); $i++) {
            $key = $houses[$i]['id'];
            $value = $houses[$i]['address'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function get_houses_for_search() {
        $query = $this->db->get('houses');
        $houses = $query->result_array();
        $new = array();
        $new[''] = 'Select House';
        for ($i = 0; $i < count($houses); $i++) {
            $key = $houses[$i]['id'];
            $value = $houses[$i]['address'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function get_category() {
        $query = $this->db->get('house_hold_category');
        $category = $query->result_array();
        for ($i = 0; $i < count($category); $i++) {
            $key = $category[$i]['id'];
            $value = $category[$i]['name'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function getCategoryName($id) {
        $this->db->select('name');
        $query = $this->db->get_where('house_hold_category', array('id' => $id));
        $category = $query->row_array();
        if (!empty($category)) {
            return $category['name'];
        } else {
            return "N/A";
        }
    }

    public function getSelectedCategory($id) {
        $this->db->select('category');
        $query = $this->db->get_where('house_hold', array('id' => $id));
        $category = $query->row_array();
        $category['category'] = unserialize($category['category']);
        $name = '';
        for ($i = 0; $i < count($category['category']); $i++) {
            $name .= $this->getCategoryName($category['category'][$i]) . ', ';
        }
        $name = substr($name, 0, strlen($name) - 2);
        return $name;
    }

    public function householdDetail($id) {
        $query = $this->db->get_where('house_hold', array('id' => $id));
        return $query->row_array();
    }

    public function edithouse($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('house_hold', $data);
    }

    public function deletehouse($id) {
        $this->db->delete('house_hold', array('id' => $id));
    }

    public function activatehouse($id) {
        $this->db->where('id', $id);
        $this->db->update('house_hold', array('status' => '1'));
    }

    public function deactivatehouse($id) {
        $this->db->where('id', $id);
        $this->db->update('house_hold', array('status' => '0'));
    }

    public function searchhouses($search, $type, $num, $offset) {
        if ($search <> 'all') {
            $this->db->or_like(array('firstname' => $search));
            $this->db->or_like(array('email' => $search));
            $this->db->or_like(array('lastname' => $search));
        }
        $query = $this->db->get('house_hold', $num, $offset);
        return $query->result();
    }

    public function counthouses($type, $house = NULL) {
        if ($house <> NULL and $house <> 'all') {
            $this->db->where('house_id = ' . $house);
        }
        $this->db->select('id');
        $query = $this->db->get('house_hold');
        return $query->num_rows();
    }

    public function getUserName($id) {
        $this->db->select('username');
        $query = $this->db->get_where('users', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            return $array['username'];
        } else {
            return '';
        }
    }

    public function countsearchhouses($search) {
        $this->db->select('id');
        if ($search <> 'all') {
            $this->db->or_like(array('firstname' => $search));
            $this->db->or_like(array('email' => $search));
            $this->db->or_like(array('lastname' => $search));
        }
        $query = $this->db->get('house_hold');
        return $query->num_rows();
    }

}
