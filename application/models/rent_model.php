<?php

class Rent_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function rentRegistration($data) {
        $query = $this->db->insert('rent', $data);
    }

    public function get_houses_address($id) {
        $query = $this->db->get_where('houses', array('id' => $id));
        $houses = $query->row_array();
        if (!empty($houses)) {
            return $houses['address'];
        } else {
            return '';
        }
    }

    public function get_worksite_name($id) {
        $query = $this->db->get_where('houses', array('id' => $id));
        $houses = $query->row_array();
        if (!empty($houses)) {
            $worksite = $houses['worksite_id'];
        } else {
            $worksite = 0;
        }
        if ($worksite) {
            $this->db->select('company');
            $query = $this->db->get_where('worksite', array('id' => $worksite));
            $record = $query->row_array();
            if (!empty($record)) {
                return $record['company'];
            }
        } else {
            return "N/A";
        }
    }

    public function get_worksites() {
        $query = $this->db->get('worksite');
        $houses = $query->result_array();
        $new = array();
        for ($i = 0; $i < count($houses); $i++) {
            $key = $houses[$i]['id'];
            $value = $houses[$i]['company'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function checkhousename($username) {
        $query = $this->db->get_where('rent', array('username' => $username));
        return $query->num_rows();
    }

    public function get_site_name($id) {
        $this->db->select('site_rate_name');
        $query = $this->db->get_where('worksite', array('id' => $id));
        $array = $query->row_array();
        return $array['site_rate_name'];
    }

    public function rentList($worksite = 0, $num, $offset, $old = "gold") {
        $order = $this->input->get('type');
        $type = $this->input->get('order');
        $now = date('Y-m-d');
        $to = date('Y-m-d', strtotime($now . ' - 4 weeks'));
        $this->db->select('rent.*');
        if ($old == 'gold') {
            if ($order == 'company')
                $this->db->order_by('worksite.' . $order, $type);
            else
                $this->db->order_by('rent.paid', 'asc');
        } else {
            if ($order == 'address')
                $this->db->order_by('houses.' . $order, $type);
            if ($order == 'company')
                $this->db->order_by('worksite.' . $order, $type);
            if ($order == 'payment_due_date')
                $this->db->order_by('rent.' . $order, $type);
        }
        $this->db->join("houses", "houses.id = rent.house_id", 'inner');
        $this->db->join("worksite", "worksite.id = houses.worksite_id", 'left');
        if ($worksite) {
            $this->db->where('houses.worksite_id', $worksite);
        }
        if ($old == 'gold')
            $this->db->where("((emp_rent.paid = 'yes' and emp_rent.payment_date >= '" . $to . "' AND emp_rent.payment_date <= '" . $now . "') OR  emp_rent.paid = 'no')");
        else
            $this->db->where("(emp_rent.paid = 'yes' and emp_rent.payment_date < '" . $to . "')");
        $query = $this->db->get('rent', $num, $offset);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function rentListBatch($worksite = 0, $num, $offset, $old = "gold") {
        $order = $this->input->get('type');
        $type = $this->input->get('order');
        $now = date('Y-m-d');
        $to = date('Y-m-d', strtotime($now . ' + 3 days'));
        $this->db->select('rent.*');
        if ($old == 'gold') {
            $this->db->order_by('rent.paid', 'asc');
        } else {
            if ($order == 'address')
                $this->db->order_by('houses.' . $order, $type);
            if ($order == 'company')
                $this->db->order_by('worksite.' . $order, $type);
            if ($order == 'payment_due_date')
                $this->db->order_by('rent.' . $order, $type);
        }
        $this->db->join("houses", "houses.id = rent.house_id", 'inner');
        $this->db->join("worksite", "worksite.id = houses.worksite_id", 'left');
        if ($worksite) {
            $this->db->where('houses.worksite_id', $worksite);
        }
        $this->db->where("(emp_rent.paid = 'yes' and emp_rent.payment_due_date <= '" . $to . "')");
        $query = $this->db->get('rent', $num, $offset);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function countRentBatch($worksite = 0, $old = "gold") {
        $now = date('Y-m-d');
        $to = date('Y-m-d', strtotime($now . ' + 3 days'));
        $this->db->select('rent.id');
        $this->db->join("houses", "houses.id = rent.house_id", 'inner');
        if ($worksite) {
            $this->db->where('houses.worksite_id', $worksite);
        }
        $this->db->where("(emp_rent.paid = 'yes' and emp_rent.payment_due_date <= '" . $to . "')");
        $query = $this->db->get('rent');
        return $query->num_rows();
    }

    public function countRent($worksite = 0, $old = "gold") {
        $now = date('Y-m-d');
        $to = date('Y-m-d', strtotime($now . ' - 4 weeks'));
        $this->db->select('rent.id');
        $this->db->join("houses", "houses.id = rent.house_id", 'inner');
        if ($worksite) {
            $this->db->where('houses.worksite_id', $worksite);
        }
        if ($old == 'gold')
            $this->db->where("((emp_rent.paid = 'yes' and emp_rent.payment_date >= '" . $to . "' AND emp_rent.payment_date <= '" . $now . "') OR  emp_rent.paid = 'no')");
        else
            $this->db->where("(emp_rent.paid = 'yes' and emp_rent.payment_date < '" . $to . "')");
        $query = $this->db->get('rent');
        return $query->num_rows();
    }

    public function rentListLatest($worksite = 0, $num, $offset, $old = "gold") {
        $order = $this->input->get('order');
        $type = $this->input->get('type');
        $now = date('Y-m-d');
        $to = date('Y-m-d', strtotime($now . ' - 4 weeks'));
        $this->db->select('rent.*');
        if ($old == 'gold') {
            $this->db->order_by('rent.paid', 'asc');
        } else {
            if ($order == 'address')
                $this->db->order_by('houses.' . $order, $type);
            if ($order == 'company')
                $this->db->order_by('worksite.' . $order, $type);
            if ($order == 'payment_due_date')
                $this->db->order_by('rent.' . $order, $type);
        }
        $this->db->join("houses", "houses.id = rent.house_id", 'inner');
        $this->db->join("worksite", "worksite.id = houses.worksite_id", 'left');
        if ($worksite) {
            $this->db->where('houses.worksite_id', $worksite);
        }
        if ($old == 'gold')
            $this->db->where("((emp_rent.paid = 'yes' and emp_rent.payment_date >= '" . $to . "' AND emp_rent.payment_date <= '" . $now . "') OR  emp_rent.paid = 'no')");
        else
            $this->db->where("(emp_rent.paid = 'yes' and emp_rent.payment_date < '" . $to . "')");
        $query = $this->db->get('rent', $num, $offset);
        return $query->result();
    }

    public function get_houses() {
        $query = $this->db->get('rent');
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

    public function rentDetail($id, $paid = 0) {
        if ($paid) {
            $this->db->where('paid', 'yes');
        }
        $query = $this->db->get_where('rent', array('id' => $id));
        return $query->result_array();
    }

    public function house_detail($id) {
        $query = $this->db->get_where('houses', array('id' => $id));
        return $query->result();
    }

    public function editRent($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('rent', $data);
    }

    public function deleteRent($id) {
        $this->db->delete('rent', array('id' => $id));
    }

    public function activateRent($id) {
        $this->db->where('id', $id);
        $this->db->update('rent', array('status' => '1'));
    }

    public function deactivateRent($id) {
        $this->db->where('id', $id);
        $this->db->update('rent', array('status' => '0'));
    }

    public function searchRent($search, $num, $offset) {
        if ($search <> 'all') {
            $this->db->like(array('payment_date' => $search));
        }
        $query = $this->db->get('rent', $num, $offset);
        return $query->result();
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

    public function countsearchRent($search) {
        $this->db->select('id');
        if ($search <> 'all') {
            $this->db->like(array('payment_date' => $search));
        }
        $query = $this->db->get('rent');
        return $query->num_rows();
    }

}
