<?php

class Car_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function noOfEmployees($worksite_id) {
        $this->db->select('count(id) as no');
        $query = $this->db->get_where('users', array('worksite_id' => $worksite_id));
        $array = $query->row_array();
        return $array['no'];
    }

    public function noOfHouses($worksite_id) {
        $this->db->select('count(id) as no, house_id');
        $this->db->distinct();
        $this->db->group_by('id');
        $query = $this->db->get_where('users', array('worksite_id' => $worksite_id, 'house_id <> ' => 0));
        return $array = $query->num_rows();
        /* if(!empty($array)) {
          return $array['no'];
          }
          else {
          return 0;
          }
         * 
         */
    }

    public function carRegistration($data) {
        $this->db->insert('carmanage', $data);
    }

    public function getUsername($id) {
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
        $query = $this->db->get_where('users', array('id' => $id));
        $array = $query->row_array();
        return $array['firstname'];
    }

    public function getCompanyName($id) {
        $this->db->select('company');
        $query = $this->db->get_where('company', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array))
            return $array['company'];
        else
            return "N/A";
    }

    public function getUsername1($id) {
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
        $query = $this->db->get_where('users', array('id' => $id));
        $array = $query->row_array();
        return $array['firstname'] . " " . $array['lastname'];
    }

    public function getUserDOB($id) {
        $this->db->select("AES_DECRYPT(dob, '" . KEY . "') as dob", FALSE);
        $query = $this->db->get_where('users', array('id' => $id));
        $array = $query->row_array();
        return $array['dob'];
    }

    public function checkEmail($email) {
        $query = $this->db->get_where('carmanage', array('email' => $email));
        return $query->num_rows();
    }

    public function carList($num, $offset) {
        $this->db->select('carmanage.*');
        $this->db->order_by('carmanage.id', 'desc');
        $this->db->where('users.role', '3');
        $this->db->join('users', 'users.id = carmanage.car_username', 'inner');
        $query = $this->db->get('carmanage', $num, $offset);
        return $query->result();
    }

    public function get_houses() {
        $query = $this->db->get('carmanage');
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

    public function getEmail($id) {
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(email, '" . KEY . "') as email", FALSE);
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function carDetail($id) {
        $this->db->select('carmanage.*');
        $this->db->join('users', 'users.id = carmanage.car_username', 'inner');
        $query = $this->db->get_where('carmanage', array('carmanage.id' => $id));
        return $query->row_array();
    }

    public function editCar($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('carmanage', $data);
    }

    public function deleteCar($id) {
        $this->db->delete('carmanage', array('id' => $id));
    }

    public function getCarUsers() {
        $query1 = $this->db->select('car_username');
        $query1 = $this->db->get('carmanage');
        $array = $query1->result_array();
        $new = array();
        for ($i = 0; $i < count($array); $i++) {
            $new[$i] = $array[$i]['car_username'];
        }
        return $new;
    }

    public function get_tenants() {
        $users = $this->getCarUsers();
        $sql = "SELECT AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, `id` FROM (`emp_users`) WHERE (`left_australia` != '2' 
            OR `employee_employed` != '1') and `role` = 3";

        if (!empty($users)) {
            $sql .= " and id not IN(" . implode(',', $users) . ")";
        }
        $query = $this->db->query($sql);
        $new[''] = "Select";
        $users = $query->result_array();
        for ($i = 0; $i < count($users); $i++) {
            $key = $users[$i]['id'];
            $value = $users[$i]['firstname'] . ' ' . $users[$i]['lastname'];
            $new[$key] = $value;
        }
        if (!empty($users)) {
            return $new;
        } else {
            return array();
        }
    }

    public function getCompanies() {
        $query = $this->db->get('company');
        $users = $query->result_array();
        $new = array('' => 'Select');
        for ($i = 0; $i < count($users); $i++) {
            $key = $users[$i]['id'];
            $value = $users[$i]['company'];
            $new[$key] = $value;
        }
        if (!empty($users)) {
            return $new;
        } else {
            return array();
        }
    }

    public function activateCar($id) {
        $this->db->where('id', $id);
        $this->db->update('carmanage', array('status' => '1'));
    }

    public function deactivateCar($id) {
        $this->db->where('id', $id);
        $this->db->update('carmanage', array('status' => '0'));
    }

    public function searchCars($search, $num, $offset) {
        if ($search <> 'all') {
            $this->db->join('users', 'carmanage.car_username = users.id');
            $this->db->or_like(array("AES_DECRYPT(emp_users.firstname, '" . KEY . "')" => $search));
        }
        $query = $this->db->get('carmanage', $num, $offset);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function countCars() {
        $this->db->select('carmanage.id');
        $this->db->where('users.role', '3');
        $this->db->join('users', 'users.id = carmanage.car_username', 'inner');
        $query = $this->db->get('carmanage');
        return $query->num_rows();
    }

    public function countsearchCars($search) {
        $this->db->select('carmanage.id');
        if ($search <> 'all') {
            $this->db->join('users', 'carmanage.car_username = users.id');
            $this->db->or_like(array("AES_DECRYPT(emp_users.firstname, '" . KEY . "')" => $search));
        }
        $query = $this->db->get('carmanage');
        return $query->num_rows();
    }

}
