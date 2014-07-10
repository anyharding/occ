<?php

class House_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function housesholdsList($house_id) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('house_hold', array('house_id' => $house_id));
        return $query->result();
    }

    public function noOfHouseholds($house_id) {
        $this->db->select('count(id) as no');
        $query = $this->db->get_where('house_hold', array('house_id' => $house_id));
        $array = $query->row_array();
        return $array['no'];
    }

    public function noOfEmployees($house_id) {

        $sql = "SELECT count(id) as no FROM (`emp_users`) WHERE (`left_australia` != '2' OR `employee_employed` != '1') AND `house_id` = '" . $house_id . "'";
        $query = $this->db->query($sql);
        $array = $query->row_array();
        return $array['no'];
    }

    public function getHouseRate($id) {
        $this->db->select('payment_cycle, rent_payment_amount');
        $query = $this->db->get_where('houses', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            if ($array['payment_cycle'] == 'W') {
                $rent = $array['rent_payment_amount'];
            }
            if ($array['payment_cycle'] == 'M') {
                $rent = $array['rent_payment_amount'] * (0.25);
            }
            if ($array['payment_cycle'] == 'F') {
                $rent = $array['rent_payment_amount'] * (0.5);
            }
            return $rent;
        } else {
            return NULL;
        }
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

    public function getUserFirstLastName($id) {
        $this->db->select('firstname, lastname');
        $query = $this->db->get_where('users', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            return $array['firstname'] . ' ' . $array['lastname'];
        } else {
            return '';
        }
    }

    public function houseRegistration($data) {
        $query = $this->db->insert('houses', $data);
    }

    public function companyRegistration($data) {
        $query = $this->db->insert('company', $data);
    }

    public function PAYcompanyRegistration($data) {
        $query = $this->db->insert('pay_company', $data);
    }

    public function checkhousename($username) {
        $query = $this->db->get_where('houses', array('username' => $username));
        return $query->num_rows();
    }

    public function countsearchhouses($search) {

        $this->db->select('id');
        if ($search <> 'all') {
            $this->db->or_like(array('firstname' => $search));
            $this->db->or_like(array('email' => $search));
            $this->db->or_like(array('lastname' => $search));
        }
        $query = $this->db->get('houses');
        return $query->num_rows();
    }

    public function edithouse($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('houses', $data);
    }

    public function editComp($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('company', $data);
    }

    public function editpayComp($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('pay_company', $data);
    }

    public function deleteCompany($id) {
        $this->db->delete('company', array('id' => $id));
    }

    public function deletepayCompany($id) {
        $this->db->delete('pay_company', array('id' => $id));
    }

    public function deletehouse($id) {
        $this->db->delete('houses', array('id' => $id));
    }

    public function deletehouseholds($id) {
        $this->db->delete('house_hold', array('house_id' => $id));
    }

    public function activatehouse($id) {
        $this->db->where('id', $id);
        $this->db->update('houses', array('status' => '1'));
    }

    public function deactivatehouse($id) {
        $this->db->where('id', $id);
        $this->db->update('houses', array('status' => '0'));
    }

    public function searchhouses($search, $type, $num, $offset) {
        if ($search <> 'all') {
            $this->db->or_like(array('firstname' => $search));
            $this->db->or_like(array('email' => $search));
            $this->db->or_like(array('lastname' => $search));
        }
        $query = $this->db->get('houses', $num, $offset);
        return $query->result();
    }

    public function houseDetail($id) {
        $query = $this->db->get_where('houses', array('id' => $id));
        return $query->result_array();
    }

    public function companyDetail($id) {
        $query = $this->db->get_where('company', array('id' => $id));
        return $query->row_array();
    }

    public function paycompanyDetail($id) {
        $query = $this->db->get_where('pay_company', array('id' => $id));
        return $query->row_array();
    }

    public function get_users() {
        $this->db->select('firstname, lastname, id');
        $query = $this->db->get('users');
        $users = $query->result_array();
        for ($i = 0; $i < count($users); $i++) {
            $key = $users[$i]['id'];
            $value = $users[$i]['firstname'] . ' ' . $users[$i]['lastname'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function get_tenants() {
        $this->db->select('emp_users.id');
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
//        $this->db->select('firstname, lastname, id');
        $query = $this->db->get_where('users', array('house_id' => 0, 'role' => 3));
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

    public function get_houses_address($id) {
        $query = $this->db->get_where('houses', array('id' => $id));
        $houses = $query->row_array();
        return $houses['address'];
    }

    public function housesList($num, $offset, $type, $worksite_id = 0) {
//        if ($worksite_id) {
//            $this->db->select('users.house_id');
//            $this->db->distinct();
//            $query = $this->db->get_where('users', array('worksite_id' => $worksite_id, 'house_id <> ' => 0), $num, $offset);
//            $array = $query->result_array();
//            $new_array = array();
//            for ($i = 0; $i < count($array); $i++) {
//                array_push($new_array, $array[$i]['house_id']);
//            }
//            if (empty($new_array)) {
//                return '';
//            }
//            if ($this->session->userdata('rent_due_date')) {
//                $this->db->order_by('rent_due_date', $this->session->userdata('rent_due_date'));
//            } else {
//                $this->db->order_by('rent_due_date', 'ASC');
//            }
//            $this->db->where_in('id', $new_array);
//            $query1 = $this->db->get('houses');
//            return $query1->result();
//        } else {
		$housesTable = $this->db->dbprefix('houses');
		$this->db->select($housesTable.".*");
		$this->db->join('rent', 'rent.house_id=houses.id', 'inner');
        if ($this->session->userdata('rent_due_date')) {
            $this->db->order_by($housesTable.'.rent_due_date', $this->session->userdata('rent_due_date'));
        } else {
            $this->db->order_by($housesTable.'.id', 'DESC');
        }
		
        if ($worksite_id) {
            $this->db->where($housesTable.'.worksite_id', $worksite_id);
            $query = $this->db->get('houses', $num, $offset);
        } else {
            $query = $this->db->get('houses', $num, $offset);
        }
		//echo $this->db->last_query();
        return $query->result();
//        }
    }

    public function companyList($num, $offset) {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('company', $num, $offset);
        return $query->result();
    }

    public function paycompanyList($num, $offset) {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('pay_company', $num, $offset);
        return $query->result();
    }

    public function housesList1($num, $offset, $type, $worksite_id = 0) {
        if ($worksite_id) {
            $this->db->select('users.house_id');
            $this->db->distinct();
            $query = $this->db->get_where('users', array('worksite_id' => $worksite_id, 'house_id <> ' => 0), $num, $offset);
            $array = $query->result_array();
            $new_array = array();
            for ($i = 0; $i < count($array); $i++) {
                array_push($new_array, $array[$i]['house_id']);
            }
            if (empty($new_array)) {
                return '';
            }
            $this->db->select('houses.*, rent.payment_due_date');
            $this->db->order_by('rent.payment_due_date', 'DESC');
            $this->db->where_in('houses.id', $new_array);
            $this->db->join('rent', 'rent.house_id = houses.id', 'left');
            $query1 = $this->db->get('houses');
            return $query1->result();
        } else {
            $this->db->select('houses.*, rent.payment_due_date');
            $this->db->order_by('rent.payment_due_date', 'DESC');
            $this->db->group_by('rent.house_id');
            $this->db->join('rent', 'rent.house_id = houses.id', 'left');
            $query = $this->db->get('houses', $num, $offset);
            return $query->result();
        }
    }

    public function housesListInWorksite($worksite_id = 0) {
        $new[''] = 'Select House';
//        $this->db->select('users.house_id');
//        $this->db->distinct();
//        $query = $this->db->get_where('users', array('worksite_id' => $worksite_id, 'house_id <> ' => 0));
//        $array = $query->result_array();
//        $new_array = array();
//        for ($i = 0; $i < count($array); $i++) {
//            array_push($new_array, $array[$i]['house_id']);
//        }
//        if (empty($new_array)) {
//            return $new;
//        }
////        $this->db->select('');
//        $this->db->order_by('id', 'DESC');
//        $this->db->where_in('id', $new_array);
//        $query1 = $this->db->get('houses');
//        $houses = $query1->result_array();
//        for ($i = 0; $i < count($houses); $i++) {
//            $key = $houses[$i]['id'];
//            $value = $houses[$i]['address'];
//            $new[$key] = $value;
//        }
//        return $new;
        $query1 = $this->db->get_where('houses', array('worksite_id' => $worksite_id));
        $houses = $query1->result_array();
        for ($i = 0; $i < count($houses); $i++) {
            $key = $houses[$i]['id'];
            $value = $houses[$i]['address'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function counthouses($worksite_id = 0) {
//        if ($worksite_id) {
//            $this->db->select('users.house_id');
//            //$this->db->join('users', 'users.house_id = houses.id');
//            $query = $this->db->get_where('users', array('worksite_id' => $worksite_id));
//            $array = $query->result_array();
//            $new_array = array();
//
//            for ($i = 0; $i < count($array); $i++) {
//                array_push($new_array, $array[$i]['house_id']);
//            }
//            if (empty($new_array)) {
//                return '';
//            }
//            $this->db->select('id');
//            $this->db->order_by('id', 'DESC');
//            $this->db->where_in('id', $new_array);
//            $query1 = $this->db->get('houses');
//            return $query1->num_rows();
//        } else {
        $this->db->select('id');
        if ($worksite_id) {
            $query = $this->db->get_where('houses', array('worksite_id' => $worksite_id));
        } else {
            $query = $this->db->get('houses');
        }
        return $query->num_rows();
//        }
    }

    public function countCompany() {
        $this->db->select('id');
        $query = $this->db->get('company');
        return $query->num_rows();
    }

    public function countPayCompany() {
        $this->db->select('id');
        $query = $this->db->get('pay_company');
        return $query->num_rows();
    }

    public function countWorksitehouses($worksite_id = 0) {
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');
        $this->db->where_in('worksite_id', $worksite_id);
        $query1 = $this->db->get('houses');
        return $query1->num_rows();
    }

    public function housesWorksiteList($num, $offset, $worksite_id) {
        $this->db->order_by('id', 'DESC');
        $this->db->where_in('worksite_id', $worksite_id);
        $query1 = $this->db->get_where('houses', array('worksite_id' => $worksite_id), $num, $offset);
        return $query1->result();
    }

}
