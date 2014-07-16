<?php

class User_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function getHouseRate($id) {
        $this->db->select('payment_cycle, created,rent_due_date');
        $query = $this->db->get_where('houses', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            if (isset($array['rent_due_date']) and $array['rent_due_date'] <> '') {
                if ($array['payment_cycle'] == 'W') {
                    $rent = strtotime(date("Y-m-d", strtotime($array['rent_due_date'])) . " +7 day");
                }
                if ($array['payment_cycle'] == 'M') {
                    $rent = strtotime(date("Y-m-d", strtotime($array['rent_due_date'])) . " +30 day");
                }
                if ($array['payment_cycle'] == 'F') {
                    $rent = strtotime(date("Y-m-d", strtotime($array['rent_due_date'])) . " +14 day");
                }
                return date("Y-m-d", $rent);
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public function calculaterentDueDate($date, $id) {
        $this->db->select('payment_cycle, created,rent_due_date');
        $query = $this->db->get_where('houses', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            if ($array['payment_cycle'] == 'W') {
                $rent = strtotime(date("Y-m-d", strtotime($date)) . " +7 day");
            }
            if ($array['payment_cycle'] == 'M') {
                $rent = strtotime(date("Y-m-d", strtotime($date)) . " +30 day");
            }
            if ($array['payment_cycle'] == 'F') {
                $rent = strtotime(date("Y-m-d", strtotime($date)) . " +14 day");
            }
            return date("Y-m-d", $rent);
        } else {
            return NULL;
        }
    }

    public function contentDetail($id) {
        $query = $this->db->get_where('content', "id = $id");
        return $query->row_array();
    }

    public function getHouseStatus($id) {
        $this->db->select('payment_cycle, rent_due_date ');
        $query = $this->db->get_where('houses', array('id' => $id));
        $array = $query->row_array();
        if (isset($array['rent_due_date']) and $array['rent_due_date'] <> '') {
            return '1';
        } else {
            return '0';
        }
    }

    public function userRegistration($data) {
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
            if ($key == 'firstname') {
                $this->db->set('firstname', "AES_ENCRYPT('{$data['firstname']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'lastname') {
                $this->db->set('lastname', "AES_ENCRYPT('{$data['lastname']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'dob') {
                $this->db->set('dob', "AES_ENCRYPT('{$data['dob']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'contact_no') {
                $this->db->set('contact_no', "AES_ENCRYPT('{$data['contact_no']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'email') {
                $this->db->set('email', "AES_ENCRYPT('{$data['email']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'passport_number') {
                $this->db->set('passport_number', "AES_ENCRYPT('{$data['passport_number']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'visa_number') {
                $this->db->set('visa_number', "AES_ENCRYPT('{$data['visa_number']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'numberofbank') {
                $this->db->set('numberofbank', "AES_ENCRYPT('{$data['numberofbank']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'branchofbank') {
                $this->db->set('branchofbank', "AES_ENCRYPT('{$data['branchofbank']}', '" . KEY . "')", FALSE);
            }
        }
        $query = $this->db->insert('users');
        return $this->db->insert_id();
    }

    public function getlowestId() {
        $sql = "SELECT a.counter_id + 1 as fill_id FROM emp_users AS a WHERE NOT EXISTS (SELECT b.counter_id FROM emp_users AS b WHERE a.counter_id + 1 = b.counter_id) GROUP BY a.counter_id";
        $query = $this->db->query($sql);
        $array = $query->row_array();
        return $array['fill_id'];
    }

    public function checkUsername($username) {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->num_rows();
    }

    public function checkEmail($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->num_rows();
    }

    public function checkEmailApplicant($email) {
        $query = $this->db->get_where('applicant', array('email' => $email));
        return $query->num_rows();
    }

    public function getLogs() {
        $sql = "select * from emp_logs  where login_time >= date_sub(now(), interval 12 month) group by user_id order by login_time asc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getLogsBetweenMonth($month, $year = "") {
//        echo $year;
//        $sql = "select distinct user_id from emp_logs where month(login_time) = " . $month . " and year(login_time) = '" . $year . "'";
        $sql = "select distinct user_id from emp_logs  inner join emp_users on  emp_users.id=emp_logs.user_id  where DATE_FORMAT(emp_logs.login_time, '%Y-%m') = '" . $year . "-" . $month . "'";
        $query = $this->db->query($sql);
        $array = $query->result_array();
        return count($array);
    }

    public function getLogsBetweenWeek($start, $end) {
//        echo $year;
//        $sql = "select distinct user_id from emp_logs where month(login_time) = " . $month . " and year(login_time) = '" . $year . "'";
        $sql = "select distinct user_id from emp_logs inner join emp_users on  emp_users.id=emp_logs.user_id where emp_logs.login_time >= '" . $start . "' and emp_logs.login_time <='" . $end . "'";
        $query = $this->db->query($sql);
        $array = $query->result_array();
        return count($array);
    }

    public function getContractorsBetweenMonth($month, $year = "") {
//        $sql = "select id from emp_users where month(created) <= " . $month . " and year(created) <= '" . $year . "'";
        $sql = "select id from emp_users where DATE_FORMAT(created, '%Y-%m') <= '" . $year . "-" . $month . "' and role='3'";
//        if ($year == 2014)
//            echo $sql;
        $query = $this->db->query($sql);
        $array = $query->result_array();
        return count($array);
    }

    public function getContractorsBetweenMonthEmployed($month, $year = "") {
//        $sql = "select id from emp_users where month(created) <= " . $month . " and year(created) <= '" . $year . "'";
        $sql = "select id from emp_users where DATE_FORMAT(created, '%Y-%m') <= '" . $year . "-" . $month . "' and role='3' and employee_employed = '2'";
//        if ($year == 2014)
//            echo $sql;
        $query = $this->db->query($sql);
        $array = $query->result_array();
        return count($array);
    }

    public function getContractorsBetweenWEmployed($end) {
//        $sql = "select id from emp_users where month(created) <= " . $month . " and year(created) <= '" . $year . "'";
        $sql = "select id from emp_users where created <= '" . $end . "' and role='3' and employee_employed = '2'";
//        if ($year == 2014)
//            echo $sql;
        $query = $this->db->query($sql);
        $array = $query->result_array();
        return count($array);
    }

    public function getContractorsBetweenW($end) {
//        $sql = "select id from emp_users where month(created) <= " . $month . " and year(created) <= '" . $year . "'";
        $sql = "select id from emp_users where created <= '" . $end . "' and role='3'";
//        if ($year == 2014)
//            echo $sql;
        $query = $this->db->query($sql);
        $array = $query->result_array();
        return count($array);
    }

    public function getLogsBetweenMonthWeekly($month) {
        $sql = "select distinct emp_logs.user_id from emp_logs innerjoin emp_users on emp_users.id= emp_logs.user_id where emp_users.employee_employed='2' and month(emp_logs.login_time) = " . $month;
        $query = $this->db->query($sql);
        $array = $query->result_array();
        return count($array);
    }

    public function getWorksiteCompName($id) {
        $this->db->select('company');
        $query = $this->db->get_where('worksite', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            return $array['company'];
        } else {
            return '';
        }
    }

    public function usersWorksiteList($num, $offset, $worksite_id) {
        if ($worksite_id) {
            $query = "SELECT  `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`)
WHERE (`employee_employed` != '1')
AND `worksite_id` = " . $worksite_id . "
AND `role` = '3'
ORDER BY `id` desc ";
            if ($offset == NULL) {
                $query .= "LIMIT " . $num;
            } else {
                $query .= "LIMIT " . $offset . ", " . $num;
            }
            $query1 = $this->db->query($query);
            return $query1->result();
        } else {
            return array();
        }
    }

    public function usersWorksiteProbationList($worksite_id) {
        if ($worksite_id) {
            $query = "SELECT  `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`)
WHERE (`left_australia` != '2'
OR `employee_employed` != '1')
AND `probation` = 'yes'
AND `worksite_id` = " . $worksite_id . "
AND `employmentdate` >= (DATE_SUB(CURDATE(), INTERVAL 3 MONTH) + INTERVAL 15 DAY)
ORDER BY `id` desc ";
            $query1 = $this->db->query($query);
            return $query1->result();
        } else {
            $query = "SELECT  `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`)
WHERE (`left_australia` != '2'
OR `employee_employed` != '1')
AND `probation` = 'yes'
AND `employmentdate` >= (DATE_SUB(CURDATE(), INTERVAL 3 MONTH) + INTERVAL 15 DAY)
ORDER BY `id` desc ";
            $query1 = $this->db->query($query);
            return $query1->result();
        }
        echo $this->db->last_query();
    }

    public function usersHousesList($num, $offset, $house_id) {

        $query = "SELECT  `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`)
WHERE (`left_australia` != '2'
OR `employee_employed` != '1')
AND `house_id` = " . $house_id . "
ORDER BY `id` desc ";
        if ($offset == NULL) {
            $query .= "LIMIT " . $num;
        } else {
            $query .= "LIMIT " . $offset . ", " . $num;
        }
        $query1 = $this->db->query($query);
        return $query1->result();
    }

    public function usersHousesListOnView($house_id) {
        $this->db->select('*');
        $this->db->select("AES_DECRYPT(contact_no, '" . KEY . "') as contact_no", FALSE);
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->order_by('id', 'desc');
        $this->db->where('house_id = ' . $house_id);
        $query = $this->db->get('users');
        return $query->result();
    }

    public function hrList($num, $offset, $type) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('users', array('role' => 4), $num, $offset);
        return $query->result();
    }

    public function get_users() {
        $query = $this->db->get('users');
        $users = $query->result_array();
        $new = array();
        for ($i = 0; $i < count($users); $i++) {
            $key = $users[$i]['id'];
            $value = $users[$i]['username'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function get_subcategories($id) {
        $query = $this->db->get_where('categories', array('parent_id' => $id));
        $subcategory = $query->result_array();
        $new = array();
        for ($i = 0; $i < count($subcategory); $i++) {
            $key = $subcategory[$i]['id'];
            $value = $subcategory[$i]['category_name'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function getWorksiteRateAndName($id) {
        $query = $this->db->get_where('worksite', array('id' => $id));
        return $query->row_array();
    }

    public function get_worksites() {
        $query = $this->db->get('worksite');
        $houses = $query->result_array();
        $new = array();
        $new[''] = 'Select Worksite';
        for ($i = 0; $i < count($houses); $i++) {
            $key = $houses[$i]['id'];
            $value = $houses[$i]['company'] . " (ID: " . $houses[$i]['id'] . ")";
            $new[$key] = $value;
        }
        return $new;
    }

    public function get_applicants() {
        $this->db->select('emp_applicant.id');
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
        $query = $this->db->get('applicant');
        $houses = $query->result_array();
        $new = array();
        $new[''] = 'Select Applicant';
        for ($i = 0; $i < count($houses); $i++) {
            $key = $houses[$i]['id'];
            $value = $houses[$i]['lastname'] . ", " . $houses[$i]['firstname'] . " (ApplicantId: " . $houses[$i]['id'] . ")";
            $new[$key] = $value;
        }
        return $new;
    }

    public function companies() {
        $query = $this->db->get('company');
        $company = $query->result_array();
        $new = array();
        $new[''] = 'Select Company';
        for ($i = 0; $i < count($company); $i++) {
            $key = $company[$i]['id'];
            $value = $company[$i]['company'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function get_banks() {
        $query = $this->db->get('banks');
        $houses = $query->result_array();
        $new = array();
        $new[''] = 'Select Bank';
        for ($i = 0; $i < count($houses); $i++) {
            $key = $houses[$i]['id'];
            $value = $houses[$i]['name'];
            $new[$key] = $value;
        }
		asort($new);
        return $new;
    }

    public function get_banksifs() {
        $query = $this->db->get('banks');
        $houses = $query->result_array();
        $new = array();
        $new[''] = 'Select Bank';
        for ($i = 0; $i < count($houses); $i++) {
            $key = $houses[$i]['code'];
            $value = $houses[$i]['name'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function getbankname($id) {
        $query = $this->db->get_where('banks', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            return $array['code'];
        } else {
            return "000";
        }
    }

    public function getFullbankname($id) {
        $query = $this->db->get_where('banks', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            return $array['name'];
        } else {
            return "000";
        }
    }

    public function get_category() {
        $query = $this->db->get_where('categories', array('parent_id' => 0));
        $category = $query->result_array();
        $new = array();
        for ($i = 0; $i < count($category); $i++) {
            $key = $category[$i]['id'];
            $value = $category[$i]['category_name'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function get_countries() {
        $query = $this->db->get('countries');
        $countries = $query->result_array();
        for ($i = 0; $i < count($countries); $i++) {
            $key = $countries[$i]['id'];
            $value = $countries[$i]['country_name'];
            $new[$key] = $value;
        }
        return $new;
    }

    public function get_province($country_id = NULL) {
        $query = $this->db->get_where('province', array('country_id' => $country_id));
        $province = $query->result();
        $new = array();
        return $province;
    }

    public function get_subcategory($category_id) {
        if ($category_id == '') {
            return array();
        }
        $query = $this->db->get_where('categories', array('parent_id' => $category_id));
        $sub_category = $query->result();
        return $sub_category;
    }

    public function get_subcategory1($category_id) {
        if ($category_id == '') {
            return result_array();
        }
        $query = $this->db->get_where('categories', array('parent_id' => $category_id, 'status' => '1'));
        $sub_category = $query->result_array();
        return $sub_category;
    }

    public function get_provinces_for_listing($country_id = NULL) {
        $query = $this->db->get_where('province', array('country_id' => $country_id, 'status' => '1'));
        $province = $query->result_array();
        $new = array();
        if (!empty($province)) {
            return $province;
        } else {
            return $new;
        }
    }

    public function get_provinces_name_for_listing($id = NULL) {
        $query = $this->db->get_where('province', array('id' => $id, 'status' => '1'));
        $province = $query->row_array();
        if (!empty($province)) {
            return $province['province_name'];
        } else {
            return '';
        }
    }

    public function get_city_name_for_listing($id = NULL) {
        $query = $this->db->get_where('cities', array('id' => $id, 'status' => '1'));
        $city = $query->row_array();
        if (!empty($city)) {
            return $city['city_name'];
        } else {
            return '';
        }
    }

    public function get_provinces($country_id = NULL) {
        $query = $this->db->get_where('province', array('country_id' => $country_id, 'status' => '1'));
        $province = $query->result_array();
        $new = array();
        if (!empty($province))
            for ($i = 0; $i < count($province); $i++) {
                $key = $province[$i]['id'];
                $value = $province[$i]['province_name'];
                $new[$key] = $value;
            }
        return $new;
    }

    public function get_city($province_id = NULL) {
        $query = $this->db->get_where('cities', array('province_id' => $province_id, 'status' => '1'));
        $cities = $query->result();
        return $cities;
    }

    public function get_cities($province_id = NULL) {
        $query = $this->db->get_where('cities', array('province_id' => $province_id));
        $cities = $query->result_array();
        $new = array();
        if (!empty($cities))
            for ($i = 0; $i < count($cities); $i++) {
                $key = $cities[$i]['id'];
                $value = $cities[$i]['city_name'];
                $new[$key] = $value;
            }
        return $new;
    }

    public function userDetail($id) {
        $this->db->select('emp_users.*');
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select("AES_DECRYPT(dob, '" . KEY . "') as dob", FALSE);
        $this->db->select("AES_DECRYPT(contact_no, '" . KEY . "') as contact_no", FALSE);
        $this->db->select("AES_DECRYPT(email, '" . KEY . "') as email", FALSE);
        $this->db->select("AES_DECRYPT(passport_number, '" . KEY . "') as passport_number", FALSE);
        $this->db->select("AES_DECRYPT(visa_number, '" . KEY . "') as visa_number", FALSE);
        $this->db->select("AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank", FALSE);
        $this->db->select("AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank", FALSE);
        $this->db->select('admin_id');
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->result_array();
    }

    public function userDetailEmail($id) {
        $this->db->select('emp_users.*');
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select("AES_DECRYPT(dob, '" . KEY . "') as dob", FALSE);
        $this->db->select("AES_DECRYPT(contact_no, '" . KEY . "') as contact_no", FALSE);
        $this->db->select("AES_DECRYPT(email, '" . KEY . "') as email", FALSE);
        $this->db->select("AES_DECRYPT(passport_number, '" . KEY . "') as passport_number", FALSE);
        $this->db->select("AES_DECRYPT(visa_number, '" . KEY . "') as visa_number", FALSE);
        $this->db->select("AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank", FALSE);
        $this->db->select("AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank", FALSE);
        $this->db->select('admin_id');
        $this->db->where("AES_DECRYPT(email, '" . KEY . "')= '" . $id . "'");
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function applicantDetail($id) {
        $this->db->select('emp_applicant.*');
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select("AES_DECRYPT(mobile, '" . KEY . "') as mobile", FALSE);
        $this->db->select("AES_DECRYPT(email, '" . KEY . "') as email", FALSE);
        $this->db->select("AES_DECRYPT(passport_no, '" . KEY . "') as passport_no", FALSE);
        $this->db->select("AES_DECRYPT(visa_number, '" . KEY . "') as visa_number", FALSE);
        $query = $this->db->get_where('applicant', array('id' => $id));
        return $query->row_array();
    }

    public function editUser($data, $id) {
        $this->db->where('id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
            if ($key == 'firstname') {
                $this->db->set('firstname', "AES_ENCRYPT('{$data['firstname']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'lastname') {
                $this->db->set('lastname', "AES_ENCRYPT('{$data['lastname']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'dob') {
                $this->db->set('dob', "AES_ENCRYPT('{$data['dob']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'contact_no') {
                $this->db->set('contact_no', "AES_ENCRYPT('{$data['contact_no']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'email') {
                $this->db->set('email', "AES_ENCRYPT('{$data['email']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'passport_number') {
                $this->db->set('passport_number', "AES_ENCRYPT('{$data['passport_number']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'visa_number') {
                $this->db->set('visa_number', "AES_ENCRYPT('{$data['visa_number']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'numberofbank') {
                $this->db->set('numberofbank', "AES_ENCRYPT('{$data['numberofbank']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'branchofbank') {
                $this->db->set('branchofbank', "AES_ENCRYPT('{$data['branchofbank']}', '" . KEY . "')", FALSE);
            }
        }
        $this->db->update('users');
//        echo $this->db->last_query();
//        die;
    }

    public function deleteUser($id) {
        $this->db->delete('users', array('id' => $id));
    }

    public function deleteApplicant($id) {
        $this->db->delete('applicant', array('id' => $id));
    }

    public function activateUser($id) {
        $this->db->where('id', $id);
        $this->db->update('users', array('status' => '1'));
    }

    public function deactivateUser($id) {
        $this->db->where('id', $id);
        $this->db->update('users', array('status' => '0'));
    }

    public function searchUsers($search, $type, $num, $offset) {
        if ($search <> 'all') {
            $this->db->or_like(array('firstname' => $search));
            $this->db->or_like(array('email' => $search));
            $this->db->or_like(array('lastname' => $search));
        }
        $query = $this->db->get('users', $num, $offset);
        return $query->result();
    }

    public function searchWorksiteUsers($search, $worksite_id, $num, $offset) {
        $query = "SELECT  `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`)
WHERE (worksite_id = " . $worksite_id . ") AND (`firstname` LIKE '%" . $search . "%' OR `email` LIKE '%" . $search . "%' OR `lastname` LIKE '%" . $search . "%') LIMIT " . $num . ' ' . $offset;

        $res = $this->db->query($query);
        return $res->result();
    }

    public function searchHouseUsers($search, $house_id, $num, $offset) {
        $query = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`)
WHERE (house_id = " . $house_id . ") AND (`firstname` LIKE '%" . $search . "%' OR `email` LIKE '%" . $search . "%' OR `lastname` LIKE '%" . $search . "%') LIMIT " . $num . ' ' . $offset;

        $res = $this->db->query($query);
        return $res->result();
    }

    public function usersList($num, $offset, $type, $worksite = NULL, $site_rate = NULL) {
//        $sql = "SELECT  `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`) WHERE `employee_employed` != '1' AND `role` = 3 AND (`employmentdate` < (DATE_SUB(CURDATE(), INTERVAL 3 MONTH) + INTERVAL 15 DAY)) ";
//        $sql = "SELECT * FROM (`emp_users`) WHERE `employee_employed` = '2' AND `role` = '3' and left_australia = '1'";
//        if ($worksite) {
//            $sql.=" AND worksite_id = " . $worksite;
//        }
//        if ($offset == NULL) {
//            $sql .= " LIMIT " . $num;
//        } else {
//            $sql .= " LIMIT " . $offset . ", " . $num;
//        }

        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select("AES_DECRYPT(dob, '" . KEY . "') as dob", FALSE);
        $this->db->select("AES_DECRYPT(contact_no, '" . KEY . "') as contact_no", FALSE);
        $this->db->select("AES_DECRYPT(email, '" . KEY . "') as email", FALSE);
        $this->db->select("AES_DECRYPT(passport_number, '" . KEY . "') as passport_number", FALSE);
        $this->db->select("AES_DECRYPT(visa_number, '" . KEY . "') as visa_number", FALSE);
        $this->db->select("AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank", FALSE);
        $this->db->select("AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank", FALSE);

        $this->db->select("id, admin_id, probation, worksite_id, house_id, rental_type, non_comp_address");
        if ($worksite) {
            $this->db->where('worksite_id', $worksite);
        }
        $query = $this->db->get_where('users', array('employee_employed' => '2', 'role' => '3', 'left_australia' => '1'), $num, $offset);

//        $query = $this->db->query($sql);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function countUsers($type, $worksite = NULL, $site_rate = NULL) {
//        $sql = "SELECT `id` FROM (`emp_users`) WHERE `employee_employed` != '1' AND `role` = 3 AND (`employmentdate` < (DATE_SUB(CURDATE(), INTERVAL 3 MONTH) + INTERVAL 15 DAY)) ";
        $sql = "SELECT `id` FROM (`emp_users`) WHERE `employee_employed` = '2' AND `role` = 3 and left_australia = '1'";
        if ($worksite) {
            $sql.=" AND worksite_id = " . $worksite;
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function usersResignList($num, $offset, $type, $worksite = NULL, $site_rate = NULL) {
        $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`) WHERE (`employee_employed` = '1' or left_australia = '2') AND `role` = 3 order by id desc ";
//        $this->db->order_by('id', 'desc');
//        $this->db->where('left_australia = ', '1');
//        $this->db->where('employee_employed = ', '1');
//        $this->db->where('future_employment = ', '2');
//        $query = $this->db->get_where('users', array('role' => '3'), $num, $offset);
        if ($offset == NULL) {
            $sql .= " LIMIT " . $num;
        } else {
            $sql .= " LIMIT " . $offset . ", " . $num;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getOldUsers($id = 0) {
        $now = date('Y-m-d');
        $from = date('Y-m-d', strtotime($now . ' - 3 months'));
        $sql = "SELECT `emp_users`.*, AES_DECRYPT(firstname, '" . KEY . "') as firstname, AES_DECRYPT(lastname, '" . KEY . "') as lastname, AES_DECRYPT(dob, '" . KEY . "') as dob, AES_DECRYPT(contact_no, '" . KEY . "') as contact_no, AES_DECRYPT(email, '" . KEY . "') as email, AES_DECRYPT(passport_number, '" . KEY . "') as passport_number, AES_DECRYPT(visa_number, '" . KEY . "') as visa_number, AES_DECRYPT(numberofbank, '" . KEY . "') as numberofbank, AES_DECRYPT(branchofbank, '" . KEY . "') as branchofbank FROM (`emp_users`) WHERE (`employee_employed` = '1' OR left_australia = '2' OR last_update < '" . $from . "') AND `role` = 3";
        if ($id) {
            $sql .= " AND worksite_id = '" . $id . "'";
        }
        $sql .= " order by id desc";
        $query = $this->db->query($sql);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function delete_old_employees() {
        $now = date('Y-m-d');
        $from = date('Y-m-d', strtotime($now . ' - 3 months'));
        $sql = "DELETE FROM emp_users WHERE (`employee_employed` = '1' OR left_australia = '2' OR last_update < '" . $from . "') AND `role` = 3";
        $query = $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function countResignUsers($type, $worksite = NULL, $site_rate = NULL) {
        $sql = "SELECT id FROM (`emp_users`) WHERE (`employee_employed` = '1' or left_australia = '2') AND `role` = 3 order by id desc ";
//        $this->db->select('id');
//        $this->db->where('left_australia = ', '1');
//        $this->db->where('employee_employed = ', '1');
//        $this->db->where('future_employment = ', '2');
//        $query = $this->db->get_where('users', array('role' => 3));
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function countHR($type) {
        $this->db->select('id');
        $query = $this->db->get_where('users', array('role' => 4));
        return $query->num_rows();
    }

    public function countWorksiteUsers($worksite_id) {
        if ($worksite_id) {
            $query = "SELECT id FROM (`emp_users`)
WHERE ( `employee_employed` != '1')
AND `worksite_id` = " . $worksite_id . "
ORDER BY `id` desc ";
            $query1 = $this->db->query($query);
            return $query1->num_rows();
        } else {
            return 0;
        }
    }

    public function countWorksiteUsersProbation($worksite_id) {
        if ($worksite_id) {
            $query = "SELECT id FROM (`emp_users`)
WHERE (`left_australia` != '2'
OR `employee_employed` != '1')
AND `worksite_id` = " . $worksite_id . "
AND `probation` = 'yes'
AND `employmentdate` >= (DATE_SUB(CURDATE(), INTERVAL 3 MONTH) + INTERVAL 15 DAY)
ORDER BY `id` desc ";
            $query1 = $this->db->query($query);
            return $query1->num_rows();
        } else {
            $query = "SELECT id FROM (`emp_users`)
WHERE (`left_australia` != '2'
OR `employee_employed` != '1')
AND `probation` = 'yes'
AND `employmentdate` >= (DATE_SUB(CURDATE(), INTERVAL 3 MONTH) + INTERVAL 15 DAY)
ORDER BY `id` desc ";
            $query1 = $this->db->query($query);
            return $query1->num_rows();
        }
        echo $this->db->last_query();
    }

    public function countHouseUsers($house_id) {

        $query = "SELECT id FROM (`emp_users`)
WHERE (`left_australia` != '2'
OR `employee_employed` != '1')
AND `house_id` = " . $house_id . "
ORDER BY `id` desc ";
        $query1 = $this->db->query($query);
        return $query1->num_rows();
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

    public function countsearchUsers($search) {
        $this->db->select('id');
        if ($search <> 'all') {
            $this->db->or_like(array('firstname' => $search));
            $this->db->or_like(array('email' => $search));
            $this->db->or_like(array('lastname' => $search));
        }
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    public function countsearchWorksiteUsers($search, $worksite_id) {
        $query = "SELECT id FROM (`emp_users`)
WHERE (worksite_id = " . $worksite_id . ") AND (`firstname` LIKE '%" . $search . "%' OR `email` LIKE '%" . $search . "%' OR `lastname` LIKE '%" . $search . "%')";

        $res = $this->db->query($query);
        return $res->num_rows();
    }

    public function countsearchHouseUsers($search, $house_id) {
        $query = "SELECT id FROM (`emp_users`)
WHERE (house_id = " . $house_id . ") AND (`firstname` LIKE '%" . $search . "%' OR `email` LIKE '%" . $search . "%' OR `lastname` LIKE '%" . $search . "%')";

        $res = $this->db->query($query);
        return $res->num_rows();
    }

    public function getWorksiteRateName($worksite_id, $rate) {
        $this->db->select('site_rate_name' . $rate);
        $query = $this->db->get_where('worksite', array('id' => $worksite_id));
        $array = $query->row_array();
        if (!empty($array)) {
            return $array['site_rate_name' . $rate];
        } else {
            echo 'N/A';
        }
    }

    public function getCompanyAddress($id) {
        $this->db->select('address, abn, acn, company');
        $query = $this->db->get_where('company', array('id' => $id));
        $array = $query->row_array();
        if (!empty($array)) {
            return $array;
        } else {
            echo array();
        }
    }

    public function getEmployeesListInWorksite($worksite_id = 0) {
        $new[''] = 'Select Employee';
        $this->db->join('payment', 'payment.employee_id = users.id', 'inner');
        $this->db->join('batch_payment', 'payment.batch_id = batch_payment.id', 'inner');
        $this->db->where('payment.invoiced', 'no');
        $this->db->select("AES_DECRYPT(emp_users.firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(emp_users.lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select('users.id');
        $query = $this->db->get_where('users', array('users.worksite_id' => $worksite_id, 'payment.invoiced' => 'no'));
        $array = $query->result_array();
        for ($i = 0; $i < count($array); $i++) {
            $key = $array[$i]['id'];
            $value = $array[$i]['firstname'] . " " . $array[$i]['lastname'];
            $new[$key] = $value;
        }
        return $new;
    }

}
