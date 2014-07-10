<?php

Class Admin_model extends CI_Model {

    public function adminLogin() {
        $username = $this->input->post('username');
        $pasword = $this->input->post('password');
        $query = $this->db->get_where('users', array('username' => $username, 'password' => $pasword, 'role' => 1));
        $result = $query->row_array();
//            echo $this->db->last_query();
        if (count($result) == 0) {
            return false;
        } else {
            $this->session->set_userdata('adminId', $result['id']);
            $this->session->sess_expiration = 5000000;
            return true;
        }
    }

    public function adminDetail($email = NULL) {
        $email = $this->input->post('email');
        $query = $this->db->get_where('users', array('email' => $email, 'role' => 1));
        //echo $this->db->last_query();die;
        return $query->row_array();
    }

    public function checkPassword($password) {
        $id = $this->session->userdata('adminId');
        $query = $this->db->get_where('users', array('id' => $id, 'password' => $password, 'role' => 1));
        return $query->result_array();
    }

    public function changePassword($data) {
        $id = $this->session->userdata('adminId');
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function checkEmail() {
        $id = $this->session->userdata('adminId');
        $this->db->select('email');
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->result_array();
    }

    public function getEmail() {
        $this->db->select('email');
        $query = $this->db->get_where('users', array('role' => 1));
        return $query->result_array();
    }

    public function changeEmail($data) {
        $id = $this->session->userdata('adminId');
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

}

?>
