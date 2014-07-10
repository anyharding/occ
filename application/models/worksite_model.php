<?php

class Worksite_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function noOfEmployees($worksite_id) {
        $sql = "SELECT count(id) as no FROM (`emp_users`) WHERE (`employee_employed` != '1'  and left_australia='1') AND `role` = '3'  AND `worksite_id` = '" . $worksite_id . "'";
        $query = $this->db->query($sql);
        $array = $query->row_array();
        return $array['no'];
    }

    public function noOfHouses($worksite_id) {
        $this->db->select('count(id) as no, id');
        $this->db->distinct();
        $this->db->group_by('id');
        $query = $this->db->get_where('houses', array('worksite_id' => $worksite_id));
        return $array = $query->num_rows();
    }

    public function worksiteRegistration($data) {
        $this->db->insert('worksite', $data);
    }

    public function checkhousename($username) {
        $query = $this->db->get_where('worksite', array('username' => $username));
        return $query->num_rows();
    }

    public function checkEmail($email) {
        $query = $this->db->get_where('worksite', array('email' => $email));
        return $query->num_rows();
    }

    public function worksiteList($num, $offset, $type) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('worksite', $num, $offset);
        return $query->result();
    }

    public function get_houses() {
        $query = $this->db->get('worksite');
        $houses = $query->result_array();
        $new = array();
        for ($i = 0; $i < count($houses); $i++) {
            $key = $houses[$i]['id'];
            $value = $houses[$i]['housename'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function get_users() {
        $query = $this->db->get('users');
        $users = $query->result_array();
        for ($i = 0; $i < count($users); $i++) {
            $key = $users[$i]['id'];
            $value = $users[$i]['username'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function worksiteDetail($id) {
        $query = $this->db->get_where('worksite', array('id' => $id));
        return $query->result_array();
    }

    public function editworksite($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('worksite', $data);
    }

    public function deleteworksite($id) {
        $this->db->delete('worksite', array('id' => $id));
    }

    public function activateworksite($id) {
        $this->db->where('id', $id);
        $this->db->update('worksite', array('status' => '1'));
    }

    public function deactivateworksite($id) {
        $this->db->where('id', $id);
        $this->db->update('worksite', array('status' => '0'));
    }

    public function searchworksites($search, $num, $offset) {
        if ($search <> 'all') {
            $this->db->or_like(array('company' => $search));
        }
        $query = $this->db->get('worksite', $num, $offset);
        return $query->result();
    }

    public function countworksites() {
        $this->db->select('id');
        $query = $this->db->get('worksite');
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

    public function countsearchworksites($search) {
        $this->db->select('id');
        if ($search <> 'all') {
            $this->db->or_like(array('company' => $search));
        }
        $query = $this->db->get('worksite');
        return $query->num_rows();
    }

}
