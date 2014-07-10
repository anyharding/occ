<?php

class payment_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function getuserInfo($user_id) {
        $this->db->select('worksite_id,  hourlyrate');
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $query = $this->db->get_where('users', array('id' => $user_id));
        $array = $query->row_array();
        $worksite = $this->getWorksiteName($array['worksite_id']);
        return $worksite . "::" . $array['firstname'] . " " . $array['lastname'] . "::" . $array['hourlyrate'];
    }

    public function getWorksiteName($id) {
        $this->db->select('company');
        $query = $this->db->get_where('worksite', array('id' => $id));
        $result = $query->row_array();
        return $result['company'];
    }

    public function get_tenants() {
        $sql = "SELECT AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname,AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname, `id` FROM (`emp_users`) WHERE (`left_australia` != '2' 
                OR `employee_employed` != '1') and `role` = 3";
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

    public function addPayment($data) {
        $query = $this->db->insert('payment', $data);
    }

    public function addBatchPayment($data) {
        $query = $this->db->insert('batch_payment', $data);
        return $this->db->insert_id();
    }

    public function addInvoice($data) {
        $query = $this->db->insert('invoice', $data);
        return $this->db->insert_id();
    }

    public function getinvoice($id) {
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select(' company.company,  company.address,  company.acn,  company.abn, invoice.*, invoice.id as invoice_id, invoice.comment as invoice_comment, payment.*');
        $this->db->join('company', 'company.id = invoice.company_id', 'inner');
        $this->db->join('users', 'users.id = invoice.employee_id', 'inner');
        $this->db->join('payment', 'payment.id = invoice.payment_id', 'inner');
        $query = $this->db->get_where('invoice', array('invoice.id' => $id));
        return $query->row_array();
    }

    public function checkpowerusername($username) {
        $query = $this->db->get_where('applicant', array('username' => $username));
        return $query->num_rows();
    }

    public function checkEmail($email) {
        $query = $this->db->get_where('applicant', array('email' => $email));
        return $query->num_rows();
    }

    public function paymentList($num, $offset) {
        $this->db->order_by('payment.id', 'desc');
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select('payment.*,  worksite.company');
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        $query = $this->db->get('payment', $num, $offset);
        return $query->result();
    }

    public function paymentBatchList($id, $user_id = 0, $limit = array()) {
        $this->db->order_by('payment.id', 'desc');
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);

        $this->db->select("AES_DECRYPT(emp_users.branchofbank, '" . KEY . "') as branchofbank", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.numberofbank, '" . KEY . "') as numberofbank", FALSE);

        $this->db->select('payment.*, users.id as user_id, users.house_id,  users.bank, users.nameofbank, users.admin_id');
        $this->db->join('users', 'users.id = payment.employee_id');
        if ($user_id) {
            $this->db->where('users.id', $user_id);
        }

        if (!empty($limit)) {
            $this->db->limit($limit[1], $limit[0]);
        }
        $query = $this->db->get_where('payment', array('batch_id' => $id));
        return $query->result();
    }

    public function countPayments() {
        $this->db->select('payment.id');
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        $query = $this->db->get('payment');
        return $query->num_rows();
    }

    public function countInvoicess($worksite = 0) {
        $this->db->select('invoice.id');
        $this->db->join('company', 'company.id = invoice.company_id', 'inner');
        $this->db->join('users', 'users.id = invoice.employee_id', 'inner');
        $this->db->join('payment', 'payment.id = invoice.payment_id', 'inner');
        if ($worksite) {
            $this->db->where('users.worksite_id', $worksite);
        }
        $query = $this->db->get('invoice');
        return $query->num_rows();
    }

    public function invoicesList($worksite = 0, $num, $offset) {
        $this->db->order_by('invoice.id', 'desc');
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select('company.company,  company.address,  company.acn,  company.abn, invoice.*, invoice.id as invoice_id, payment.*');
        $this->db->join('company', 'company.id = invoice.company_id', 'inner');
        $this->db->join('users', 'users.id = invoice.employee_id', 'inner');
        $this->db->join('payment', 'payment.id = invoice.payment_id', 'inner');
        if ($worksite) {
            $this->db->where('users.worksite_id', $worksite);
        }
        $query = $this->db->get('invoice', $num, $offset);
        return $query->result();
    }

    public function searchAddress($address) {
        $this->db->order_by('houses.id', 'desc');
        $this->db->like('houses.address', $address);
        $this->db->select('houses.address, houses.id');

        $query = $this->db->get('houses', $num, $offset);
        return $query->result_array();
    }

    public function countPaymentsEmployee() {
        $this->db->select('payment.id');
        $this->db->where('users.id', $this->session->userdata('employeeId'));
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        $query = $this->db->get('payment');
        return $query->num_rows();
    }

    public function paymentListEmployee($num, $offset) {
        $this->db->order_by('payment.id', 'desc');
        $this->db->where('users.id', $this->session->userdata('employeeId'));
        $this->db->select('payment.*,  worksite.company');
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        $query = $this->db->get('payment', $num, $offset);
        return $query->result();
    }

    public function batchPaymentList($num, $offset, $worksite = "") {
        $this->db->order_by('batch_payment.id', 'desc');
        if ($worksite) {
            $this->db->where('batch_payment.worksite_id', $worksite);
        }
        $this->db->select('batch_payment.*, worksite.company');
        $this->db->join('worksite', 'worksite.id = batch_payment.worksite_id');
        $query = $this->db->get('batch_payment', $num, $offset);
        return $query->result();
    }

    public function countBatchPayments($worksite = "") {
        $this->db->select('batch_payment.id');
        if ($worksite) {
            $this->db->where('batch_payment.worksite_id', $worksite);
        }
        $this->db->join('worksite', 'worksite.id = batch_payment.worksite_id');
        $query = $this->db->get('batch_payment');
        return $query->num_rows();
    }

    public function getUsers($type = "", $offset, $num) {
        $now = date('Y-m-d');
        if (!$type) {
            $sql = "SELECT  `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM emp_users
            WHERE visa_expiry_date < '" . $now . "'  AND `role` = 3   and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";

            $sql .= " LIMIT " . $num;
            if ($offset) {
                $sql .= ',' . $offset;
            }
        } else {
            if ($type == '14days') {
                $to = date('Y-m-d', strtotime($now . ' + 14 days'));
                $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE visa_expiry_date > '" . $now . "' and visa_expiry_date <= '" . $to . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            if ($type == '30days') {
                $from = date('Y-m-d', strtotime($now . ' + 14 days'));
                $to = date('Y-m-d', strtotime($now . ' + 30 days'));
                $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE visa_expiry_date > '" . $now . "' and visa_expiry_date <= '" . $to . "' and visa_expiry_date > '" . $from . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            if ($type == '60days') {
                $from = date('Y-m-d', strtotime($now . ' + 30 days'));
                $to = date('Y-m-d', strtotime($now . ' + 60 days'));
                $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE visa_expiry_date > '" . $now . "' and visa_expiry_date > '" . $from . "' and visa_expiry_date <='" . $to . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            $sql .= " LIMIT " . $num;
            if ($offset) {
                $sql .= ',' . $offset;
            }
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function countUsers($type = "") {
        $now = date('Y-m-d');
        if (!$type) {
            $sql = "SELECT * FROM emp_users
            WHERE visa_expiry_date < '" . $now . "'  AND `role` = 3   and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
        } else {
            if ($type == '14days') {
                $to = date('Y-m-d', strtotime($now . ' + 14 days'));
                $sql = "SELECT * FROM emp_users
            WHERE visa_expiry_date > '" . $now . "' and visa_expiry_date <= '" . $to . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            if ($type == '30days') {
                $from = date('Y-m-d', strtotime($now . ' + 14 days'));
                $to = date('Y-m-d', strtotime($now . ' + 30 days'));
                $sql = "SELECT * FROM emp_users
            WHERE visa_expiry_date > '" . $now . "' and visa_expiry_date <= '" . $to . "' and visa_expiry_date > '" . $from . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            if ($type == '60days') {
                $from = date('Y-m-d', strtotime($now . ' + 30 days'));
                $to = date('Y-m-d', strtotime($now . ' + 60 days'));
                $sql = "SELECT * FROM emp_users
            WHERE visa_expiry_date > '" . $now . "' and visa_expiry_date > '" . $from . "' and visa_expiry_date <= '" . $to . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getUsersSixMonth($type = "", $num, $offset) {
        $now = date('Y-m-d');
        $from = date('Y-m-d', strtotime($now . ' - 4 months'));
        $from = date('Y-m-d', strtotime($from . ' - 15 days'));
        if (!$type) {
            $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE employmentdate <= '" . $from . "'  AND `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            $sql .= " LIMIT " . $num;
            if ($offset) {
                $sql .= ',' . $offset;
            }
        } else {
            if ($type == '14days') {
                $to = date('Y-m-d', strtotime($now . ' - 5 months'));
                $to = date('Y-m-d', strtotime($to . ' - 15 days'));
                $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE employmentdate <= '" . $from . "' and employmentdate >= '" . $to . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            if ($type == '30days') {
                $from = date('Y-m-d', strtotime($now . ' - 5 months'));
                $from = date('Y-m-d', strtotime($from . ' - 15 days'));
                $to = date('Y-m-d', strtotime($now . ' - 6 months'));
                $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE employmentdate < '" . $from . "' and employmentdate >= '" . $to . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            if ($type == '60days') {
                $from = date('Y-m-d', strtotime($now . ' - 6 months'));
                $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE employmentdate < '" . $from . "' and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            $sql .= " LIMIT " . $num;
            if ($offset) {
                $sql .= ',' . $offset;
            }
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function countUsersSixMonth($type = "") {
        $now = date('Y-m-d');
        $from = date('Y-m-d', strtotime($now . ' - 4 months'));
        $from = date('Y-m-d', strtotime($from . ' - 15 days'));
        if (!$type) {
            $sql = "SELECT id FROM emp_users
            WHERE employmentdate <= '" . $from . "'  AND `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
        } else {
            if ($type == '14days') {
                $to = date('Y-m-d', strtotime($now . ' - 5 months'));
                $to = date('Y-m-d', strtotime($to . ' - 15 days'));
                $sql = "SELECT id FROM emp_users
            WHERE employmentdate <= '" . $from . "' and employmentdate >= '" . $to . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            if ($type == '30days') {
                $from = date('Y-m-d', strtotime($now . ' - 5 months'));
                $from = date('Y-m-d', strtotime($from . ' - 15 days'));
                $to = date('Y-m-d', strtotime($now . ' - 6 months'));
                $sql = "SELECT id FROM emp_users
            WHERE employmentdate < '" . $from . "' and employmentdate >= '" . $to . "'  and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
            if ($type == '60days') {
                $from = date('Y-m-d', strtotime($now . ' - 6 months'));
                $sql = "SELECT id FROM emp_users
            WHERE employmentdate < '" . $from . "' and `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
            }
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function countUsersChangeAddress($type = "") {
        $now = date('Y-m-d');
        if (!$type) {
            $sql = "SELECT id FROM emp_users
            WHERE `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";
        } else {
            if ($type == 'last_three') {
                $to = date('Y-m-d', strtotime($now . ' - 3 days'));
                $sql = "SELECT * FROM emp_users
            WHERE  address_update_date >= '" . $to . "' and   `employee_employed` = '2' AND `role` = '3'  and left_australia='1' and address_update_date != ''";
            }
            if ($type == 'thee_more') {
                $from = date('Y-m-d', strtotime($now . ' - 21 days'));
                $sql = "SELECT * FROM emp_users
            WHERE  address_update_date <= '" . $from . "' and  `employee_employed` = '2' AND `role` = '3'  and left_australia='1' and address_update_date != ''";
            }
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getUsersChangeAddress($type = "", $offset, $num) {
        $now = date('Y-m-d');
        if (!$type) {
            $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE `employee_employed` = '2' AND `role` = '3'  and left_australia='1'";

            $sql .= " LIMIT " . $num;
            if ($offset) {
                $sql .= ',' . $offset;
            }
        } else {
            if ($type == 'last_three') {
                $to = date('Y-m-d', strtotime($now . ' - 3 days'));
                $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE  address_update_date >= '" . $to . "' and   `employee_employed` = '2' AND `role` = '3'  and left_australia='1' and address_update_date != ''";
            }
            if ($type == 'thee_more') {
                $from = date('Y-m-d', strtotime($now . ' - 21 days'));
                $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank  FROM emp_users
            WHERE  address_update_date <= '" . $from . "' and  `employee_employed` = '2' AND `role` = '3'  and left_australia='1' and address_update_date != ''";
            }
            $sql .= " LIMIT " . $num;
            if ($offset) {
                $sql .= ',' . $offset;
            }
        }
//        echo $sql;
        $query = $this->db->query($sql);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function get_powerusers() {
        $query = $this->db->get_where('applicant', array('role' => 2));
        $powerusers = $query->result_array();
        $new = array();
        for ($i = 0; $i < count($powerusers); $i++) {
            $key = $powerusers[$i]['id'];
            $value = $powerusers[$i]['powerusername'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function getPayCompany() {
        $query = $this->db->get_where('pay_company');
        $company = $query->result_array();
        $new = array('' => 'Please Select');
        for ($i = 0; $i < count($company); $i++) {
            $key = $company[$i]['id'];
            $value = $company[$i]['account_name'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function paymentBAtchDetail($id) {
        $this->db->select('batch_payment.*, worksite.company');
        $this->db->join('worksite', 'worksite.id = batch_payment.worksite_id');
        $query = $this->db->get_where('batch_payment', array('batch_payment.id' => $id));
        return $query->row_array();
    }

    public function paymentDetail($id) {
        $this->db->select('payment.*,  worksite.company');
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        $query = $this->db->get_where('payment', array('payment.id' => $id));
        return $query->row_array();
    }

    public function batchPaymentDetail($id) {
        $this->db->select('payment.*,  worksite.company');
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        $this->db->order_by('payment.id', 'desc');
        $query = $this->db->get_where('payment', array('users.id' => $id, 'payment.invoiced' => 'no'));
        return $query->row_array();
    }

    public function editApplicant($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('applicant', $data);
    }

    public function editPayment($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('payment', $data);
    }

    public function updateAddress($data) {
        $this->db->where('id', $this->session->userdata('employeeId'));
        $this->db->update('users', $data);
    }

    public function deletePayment($id) {
        $this->db->delete('payment', array('id' => $id));
    }

    public function deleteBatchPayment($id) {
        $this->db->delete('batch_payment', array('id' => $id));
        $this->db->delete('payment', array('batch_id' => $id));
    }

    public function activatepoweruser($id) {
        $this->db->where('id', $id);
        $this->db->update('applicant', array('status' => '1'));
    }

    public function deactivatepoweruser($id) {
        $this->db->where('id', $id);
        $this->db->update('applicant', array('status' => '0'));
    }

    public function searchPayment($search, $num, $offset) {
        $this->db->select('payment.*,  worksite.company');
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        if ($search <> 'all') {
            $this->db->like(array("AES_DECRYPT(emp_users.firstname, '" . KEY . "')" => $search));
            $this->db->or_like(array('worksite.company' => $search));
        }
        $query = $this->db->get('payment', $num, $offset);
        return $query->result();
    }

    public function getEmail($id) {
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.email, '" . KEY . "') as email", FALSE);
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function getFI($id) {
        $query = $this->db->get_where('pay_company', array('id' => $id));
        return $query->row_array();
    }

    public function getpoweruserName($id) {
        $this->db->select('username');
        $query = $this->db->get_where('applicant', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            return $array['username'];
        } else {
            return '';
        }
    }

    public function countsearchPayment($search) {
        $this->db->select('payment.id');
        $this->db->join('users', 'users.id = payment.employee_id');
        $this->db->join('worksite', 'worksite.id = users.worksite_id');
        if ($search <> 'all') {
            $this->db->like(array("AES_DECRYPT(emp_users.firstname, '" . KEY . "')" => $search));
            $this->db->or_like(array('worksite.company' => $search));
        }
        $query = $this->db->get('payment');
        return $query->num_rows();
    }

}
