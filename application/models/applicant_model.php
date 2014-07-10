<?php

class Applicant_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function get_tenants() {


        $this->db->select('emp_users.id');
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
//        $sql = "SELECT `firstname`, `lastname`, `id` FROM (`emp_users`) WHERE (`left_australia` != '2' 
//                OR `employee_employed` != '1') and `role` = 3";
        $query = $this->db->get_where('users', array('employee_employed' => '2', 'role' => '3', 'left_australia' => '1'));
//        $query = $this->db->query($sql);

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

    public function addApplicant($data) {
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
            if ($key == 'firstname') {
                $this->db->set('firstname', "AES_ENCRYPT('{$data['firstname']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'lastname') {
                $this->db->set('lastname', "AES_ENCRYPT('{$data['lastname']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'mobile') {
                $this->db->set('mobile', "AES_ENCRYPT('{$data['mobile']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'email') {
                $this->db->set('email', "AES_ENCRYPT('{$data['email']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'passport_no') {
                $this->db->set('passport_no', "AES_ENCRYPT('{$data['passport_no']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'visa_number') {
                $this->db->set('visa_number', "AES_ENCRYPT('{$data['visa_number']}', '" . KEY . "')", FALSE);
            }
        }
        $query = $this->db->insert('applicant');
    }

    public function checkpowerusername($username) {
        $query = $this->db->get_where('applicant', array('username' => $username));
        return $query->num_rows();
    }

    public function checkEmail($email) {
        $query = $this->db->get_where('applicant', array('email' => $email));
        return $query->num_rows();
    }

    public function powerusersList($num, $offset, $type) {

        $this->db->select('emp_applicant.*');
        $this->db->select("AES_DECRYPT(firstname, '" . KEY . "') as firstname", FALSE);
        $this->db->select("AES_DECRYPT(lastname, '" . KEY . "') as lastname", FALSE);
        $this->db->select("AES_DECRYPT(mobile, '" . KEY . "') as mobile", FALSE);
        $this->db->select("AES_DECRYPT(email, '" . KEY . "') as email", FALSE);
        $this->db->select("AES_DECRYPT(passport_no, '" . KEY . "') as passport_no", FALSE);
        $this->db->select("AES_DECRYPT(visa_number, '" . KEY . "') as visa_number", FALSE);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('applicant', $num, $offset);
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

    public function editApplicant($data, $id) {
        $this->db->where('id', $id);

        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
            if ($key == 'firstname') {
                $this->db->set('firstname', "AES_ENCRYPT('{$data['firstname']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'lastname') {
                $this->db->set('lastname', "AES_ENCRYPT('{$data['lastname']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'mobile') {
                $this->db->set('mobile', "AES_ENCRYPT('{$data['mobile']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'email') {
                $this->db->set('email', "AES_ENCRYPT('{$data['email']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'passport_no') {
                $this->db->set('passport_no', "AES_ENCRYPT('{$data['passport_no']}', '" . KEY . "')", FALSE);
            }
            if ($key == 'visa_number') {
                $this->db->set('visa_number', "AES_ENCRYPT('{$data['visa_number']}', '" . KEY . "')", FALSE);
            }
        }
        $this->db->update('applicant');
//        echo $this->db->last_query();die;
    }

    public function deleteApplicant($id) {
        $this->db->delete('applicant', array('id' => $id));
    }

    public function activatepoweruser($id) {
        $this->db->where('id', $id);
        $this->db->update('applicant', array('status' => '1'));
    }

    public function deactivatepoweruser($id) {
        $this->db->where('id', $id);
        $this->db->update('applicant', array('status' => '0'));
    }

    public function searchApplicant($search, $num, $offset) {
        if ($search <> 'all') {
            $this->db->or_like(array('firstname' => $search));
            $this->db->or_like(array('email' => $search));
        }
        $query = $this->db->get('applicant', $num, $offset);
        return $query->result();
    }

    public function countApplicant() {
        $this->db->select('id');
        $query = $this->db->get('applicant');
        return $query->num_rows();
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

    public function countsearchApplicant($search) {
        $this->db->select('id');
        if ($search <> 'all') {
            $this->db->or_like(array('firstname' => $search));
            $this->db->or_like(array('email' => $search));
        }
        $query = $this->db->get('applicant');
        return $query->num_rows();
    }

}
