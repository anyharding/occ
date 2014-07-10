<?php

class Search_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function countUsers($type, $worksite = NULL, $site_rate = NULL) {

        $sql = "SELECT `id` FROM (`emp_users`) WHERE (`left_australia` = '1' and `employee_employed` = '2') AND `role` = 3 ";
        if ($worksite) {
            $sql.=" AND worksite_id = " . $worksite;
        }
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            if (count($array) == 1 and is_numeric($array[0]) and strlen($array[0]) == 5) {
                $sql .= "AND admin_id = '" . $array[0] . "'";
            } else if (count($array) == 2 and (count($array[1]) < 3) and is_numeric($array[1]) and $array[0] != 'eid' and $array[0] != 'id') {
                $sql .= "AND id = '" . $array[1] . "'";
            } else if (($array[0] == 'eid' or $array[0] == 'id') and (count($array) == 2) and is_numeric($array[1]) and (strlen($array[1]) == 5)) {
                $sql .= "AND admin_id = '" . $array[1] . "'";
            } else if (count($array) >= 2) {
                $sql .= "AND ( ";
                $i = 0;
                foreach ($array as $key => $value) {
                    if ($key <> 0 and trim($value)) {
                        $i += 1;
                        $sql .= "lower(CONVERT(AES_DECRYPT(emp_users.firstname, '" . KEY . "') USING latin1)) like '%" . $value . "%' OR lower(CONVERT(AES_DECRYPT(emp_users.lastname, '" . KEY . "')USING latin1)) like '%" . $value . "%' ";
                        if ($i <> (count($array) - 1)) {
                            $sql .= " OR ";
                        }
                    }
                }
                $sql .= " )";
            }
        }
//        echo $sql;die;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function usersList($num, $offset, $type, $worksite = NULL, $site_rate = NULL) {
        $sql = "SELECT  `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`) WHERE (`left_australia` = '1' and `employee_employed` = '2') AND `role` = 3 ";
        if ($worksite) {
            $sql.=" AND worksite_id = " . $worksite;
        }
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            if (count($array) == 1 and is_numeric($array[0]) and strlen($array[0]) == 5) {
                $sql .= "AND admin_id = '" . $array[0] . "'";
            } else if (count($array) == 2 and (count($array[1]) < 3) and is_numeric($array[1]) and $array[0] != 'eid' and $array[0] != 'id') {
                $sql .= "AND id = '" . $array[1] . "'";
            } else if (($array[0] == 'eid' or $array[0] == 'id') and (count($array) == 2) and is_numeric($array[1]) and (strlen($array[1]) == 5)) {
                $sql .= "AND admin_id = '" . $array[1] . "'";
            } else if (count($array) >= 2) {
                $sql .= "AND ( ";
                $i = 0;
                foreach ($array as $key => $value) {
                    if ($key <> 0 and trim($value)) {
                        $i += 1;
                        $sql .= "lower(CONVERT(AES_DECRYPT(emp_users.firstname, '" . KEY . "') USING latin1)) like '%" . $value . "%' OR lower(CONVERT(AES_DECRYPT(emp_users.lastname, '" . KEY . "')USING latin1)) like '%" . $value . "%' ";
                        if ($i <> (count($array) - 1)) {
                            $sql .= " OR ";
                        }
                    }
                }
                $sql .= " )";
            }
        }
        if ($offset == NULL) {
            $sql .= " LIMIT " . $num;
        } else {
            $sql .= " LIMIT " . $offset . ", " . $num;
        }
//        echo $sql;
        $query = $this->db->query($sql);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function countCars() {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            $this->db->where("(emp_carmanage.car_make like '%" . $array[1] . "%' OR emp_carmanage.model like '%" . $array[1] . "%')");
        }
        $this->db->select('carmanage.id');
        $this->db->where('users.role', '3');
        $this->db->join('users', 'users.id = carmanage.car_username', 'inner');
        $query = $this->db->get('carmanage');
        return $query->num_rows();
    }

    public function carList($num, $offset) {
        if ($this->session->userdata('keyword') and count($this->session->userdata('keyword')) == 2) {
            $array = $this->session->userdata('keyword');
            $this->db->where("(emp_carmanage.car_make like '%" . $array[1] . "%' OR emp_carmanage.model like '%" . $array[1] . "%')");
        } else {
            $array = $this->session->userdata('keyword');
            $this->db->where("(emp_carmanage.car_make like '%" . $array[1] . "%' OR emp_carmanage.model like '%" . $array[1] . "%')");
            $this->db->join('worksite', 'worksite.id = carmanage.car_use_location', 'inner');
            $this->db->where("(emp_worksite.company like '%" . $array[2] . "%')");
        }
        $this->db->select('carmanage.*');
        $this->db->order_by('carmanage.id', 'desc');
        $this->db->where('users.role', '3');
        $this->db->join('users', 'users.id = carmanage.car_username', 'inner');
        $query = $this->db->get('carmanage', $num, $offset);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function counthouses($worksite_id = 0) {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            unset($array[0]);

            $needal = array('road', 'rd', 'street', 'st', 'ave', 'avenue', 'pde', 'parade', 'cls', 'close', 'blvd', 'boulevarde');
            $search_type_array = array();
            foreach ($array as $key => $value) {
                if (in_array($value, $needal)) {
                    if (isset($array[$key - 1]) and !in_array($array[$key - 1], $needal)) {
                        $search_type_array[] = $array[$key - 1] . " " . $value;
                        $key_delete = array_search($array[$key - 1] . " " . $value, $search_type_array) - 1;
                        unset($search_type_array[$key_delete]);
                    }
                } else {
                    $search_type_array[] = $value;
                }
            }
            $str = "";
            $counter = 0;
            foreach ($search_type_array as $key_search) {
                $counter += 1;
                $str .= "address like '%" . $key_search . "%' ";
                if ($counter <> count($search_type_array)) {
                    $str .=" OR ";
                }
            }
//            echo $str;
            $this->db->where($str);
        }
        $this->db->select('id');
        $query = $this->db->get('houses');
        return $query->num_rows();
    }

    public function housesList($num, $offset, $type, $worksite_id = 0) {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            unset($array[0]);
            $needal = array('road', 'rd', 'street', 'st', 'ave', 'avenue', 'pde', 'parade', 'cls', 'close', 'blvd', 'boulevarde');
            $search_type_array = array();
            foreach ($array as $key => $value) {
                if (in_array($value, $needal)) {
                    if (isset($array[$key - 1]) and !in_array($array[$key - 1], $needal)) {
                        $search_type_array[] = $array[$key - 1] . " " . $value;
                        $key_delete = array_search($array[$key - 1] . " " . $value, $search_type_array) - 1;
                        unset($search_type_array[$key_delete]);
                    }
                } else {
                    $search_type_array[] = $value;
                }
            }
            $str = "";
            $counter = 0;
            foreach ($search_type_array as $key_search) {
                $counter += 1;
                $str .= "address like '%" . $key_search . "%' ";
                if ($counter <> count($search_type_array)) {
                    $str .=" OR ";
                }
            }
//            echo $str;
            $this->db->where($str);
//            if (count($array) == 3) {
//                $this->db->where("address like '%" . $array[0] . " " . $array[1] . "%'");
//            } else {
//                $this->db->where("address like '%" . $array[0] . "%'");
//            }
        }
        if ($this->session->userdata('rent_due_date')) {
            $this->db->order_by('rent_due_date', $this->session->userdata('rent_due_date'));
        } else {
            $this->db->order_by('rent_due_date', 'ASC');
        }
        $query = $this->db->get('houses', $num, $offset);
        return $query->result();
    }

    public function countApplicant() {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            if ($array[1] == 'male') {
                $this->db->where("gender like '%M%'");
            } else if ($array[1] == 'female') {
                $this->db->where("gender like '%F%'");
            } else if ($array[1] == 'f') {
                $this->db->where("gender like '%F%'");
            } else if ($array[1] == 'm') {
                $this->db->where("gender like '%M%'");
            }
            if ($array[2]) {
                $height = str_replace('cm', '', $array[2]);
                $this->db->where("height = '" . $height . "'");
            }
            if ($array[3]) {
                $weight = str_replace('kg', '', $array[3]);
                $this->db->where("weight = '" . $weight . "'");
            }
        }
        $this->db->select('id');
        $query = $this->db->get('applicant');
        return $query->num_rows();
    }

    public function powerusersList($num, $offset, $type) {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            if ($array[1] == 'male') {
                $this->db->where("gender like '%M%'");
            } else if ($array[1] == 'female') {
                $this->db->where("gender like '%F%'");
            } else if ($array[1] == 'f') {
                $this->db->where("gender like '%F%'");
            } else if ($array[1] == 'm') {
                $this->db->where("gender like '%M%'");
            }
            if ($array[2]) {
                $height = str_replace('cm', '', $array[2]);
                $this->db->where("height = '" . $height . "'");
            }
            if ($array[3]) {
                $weight = str_replace('kg', '', $array[3]);
                $this->db->where("weight = '" . $weight . "'");
            }
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('applicant', $num, $offset);
        return $query->result();
    }

    public function countPaymentsEmployee() {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            if (count($array) == 3) {
                $this->db->where("AES_DECRYPT(emp_users.firstname, '" . KEY . "') like '%" . $array[1] . "%' AND AES_DECRYPT(emp_users.lastname, '" . KEY . "') like '%" . $array[2] . "%'");
            } else {
                $this->db->where("emp_users.contact_no like '%" . $array[1] . "%'");
            }
        }
        $this->db->select('payment.id');
//        $this->db->where('users.id', $this->session->userdata('employeeId'));
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        $query = $this->db->get('payment');
        return $query->num_rows();
    }

    public function paymentListEmployee($num, $offset) {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            if (count($array) >= 2 and is_numeric($array[1]) and strlen($array[1]) == 5) {
                $this->db->where("emp_users.admin_id like '%" . $array[1] . "%'");
            } else if (count($array) >= 2) {
                $sql .= "( ";
                $i = 0;
                foreach ($array as $key => $value) {
                    if ($key <> 0 and trim($value)) {
                        $i += 1;
                        $sql .= "AES_DECRYPT(emp_users.firstname, '" . KEY . "') like '%" . $value . "%' OR AES_DECRYPT(emp_users.lastname, '" . KEY . "') like '%" . $value . "%' ";
                        if ($i <> (count($array) - 1)) {
                            $sql .= " OR ";
                        }
                    }
                }
                $sql .= " )";
                $this->db->where($sql);
            }
        }
        $this->db->order_by('payment.id', 'desc');
//        $this->db->where('users.id', $this->session->userdata('employeeId'));
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select('payment.*,  worksite.company');
        $this->db->select('users.id as user_id');
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        $query = $this->db->get('payment', $num, $offset);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function countRent() {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            if (count($array) == 4) {
                $this->db->where("address like '%" . $array[1] . " " . $array[2] . "%'");
            } else {
                $this->db->where("address like '%" . $array[1] . "%'");
            }
        }
        $this->db->select('rent.id');
        $this->db->join('houses', 'houses.id = rent.house_id');
        $query = $this->db->get('rent');
        return $query->num_rows();
    }

    public function rentList($num, $offset) {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            if (count($array) == 4) {
                $this->db->where("address like '%" . $array[1] . " " . $array[2] . "%'");
            } else {
                $this->db->where("address like '%" . $array[1] . "%'");
            }
        }
        $this->db->order_by('rent.payment_date', 'desc');
        $this->db->join('houses', 'houses.id = rent.house_id');
        $query = $this->db->get('rent', $num, $offset);
        return $query->result();
    }

    public function rentListLatest($num, $offset) {
        if ($this->session->userdata('keyword')) {
            $array = $this->session->userdata('keyword');
            if (count($array) == 4) {
                $this->db->where("address like '%" . $array[1] . " " . $array[2] . "%'");
            } else {
                $this->db->where("address like '%" . $array[1] . "%'");
            }
        }
        $this->db->order_by('rent.id', 'desc');
        $this->db->join('houses', 'houses.id = rent.house_id');
        $query = $this->db->get('rent', $num, $offset);
        return $query->result();
    }

}
