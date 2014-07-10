<?php

class Welcome_model extends CI_MOdel {

    public function __construct() {
        parent::__construct();
    }

    public function matchCode($user_id, $code) {
        $query = $this->db->get_where('reset', array('user_id' => $user_id, 'code' => $code));
        $result = $query->row_array();
        if (count($result) == 0) {
            return false;
        } else {
            return true;
        }
    }

    function deleteResetCode($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('reset');
    }

    public function userLoginWithEmail($email, $password) {
        $query = $this->db->get_where('users', array('email' => $email, 'password' => $password, 'status' => '1'));
        $result = $query->row_array();
        if (count($result) == 0) {
            return false;
        } else {
            $this->session->set_userdata('userId', $result['id']);
            return true;
        }
    }

    public function userLogin($username, $password) {
        $query = $this->db->get_where('users', array('username' => $username, 'password' => $password, 'status' => '1'));
        $result = $query->row_array();
        if (count($result) == 0) {
            return 'false';
        } else {
            if ($this->input->post('remember') == 'remember') {
                $this->session->sess_expiration = 500000;
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('password', $password);
            } else {

                $this->session->unset_userdata('username');
                $this->session->unset_userdata('password');
                $this->session->sess_expiration = 3600;
            }
            if ($result['role'] == 1) {
                $this->session->set_userdata('adminId', $result['id']);
                $this->session->set_userdata('role', 'admin');
                return "admin";
            } else if ($result['role'] == 2) {
                $this->session->set_userdata('userId', $result['id']);
                $this->session->set_userdata('role', 'poweruser');
                return "poweruser";
            } else {
                $this->session->set_userdata('userId', $result['id']);
                $this->session->set_userdata('role', 'hr');
            }
            return 'true';
        }
    }

    public function employeeLogin($username, $password) {
        $query = $this->db->get_where('users', array('id' => $username, 'password' => $password, 'status' => '1', 'role' => 3));
        $result = $query->row_array();
        if (count($result) == 0) {
            return 'false';
        } else {
            if ($this->input->post('remember') == 'remember') {
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('password', $password);
            } else {
                $this->session->unset_userdata('username');
                $this->session->unset_userdata('password');
            }

            $this->db->order_by('id', 'desc');
            $query = $this->db->get_where('logs', array('user_id' => $result['id']));
            $response = $query->row_array();
            $date = $response['login_time'];
            if (!empty($response)) {
                $wday = $this->get_week_number(strtotime($date));
            } else {
                $wday = 0;
            }
            $wday_current = $this->get_week_number(time());
            if ($wday_current <> $wday) {
                $data = array('user_id' => $result['id'], 'login_time' => date('Y-m-d'), 'status' => '1');
                $this->db->insert('logs', $data);
            }
            $this->session->sess_expiration = 50000000;
            $this->session->set_userdata('employeeId', $result['id']);
            return 'true';
        }
    }

    function iso_week_days($yday, $wday) {
        return $yday - (($yday - $wday + 382) % 7) + 3;
    }

    function is_leap_year($year) {
        IF ((($year % 4) == 0 and ($year % 100) != 0) or ($year % 400) == 0) {
            RETURN 1;
        } ELSE {
            RETURN 0;
        }
    }

    function get_week_number($timestamp) {

        $d = GETDATE($timestamp);

        $days = $this->iso_week_days($d["yday"], $d["wday"]);

        IF ($days < 0) {
            $d["yday"] += 365 + $this->is_leap_year(--$d["year"]);
            $days = $this->iso_week_days($d["yday"], $d["wday"]);
        } ELSE {
            $d["yday"] -= 365 + $this->is_leap_year($d["year"]);
            $d2 = $this->iso_week_days($d["yday"], $d["wday"]);
            IF (0 <= $d2) {
                /* $d["year"]++; */
                $days = $d2;
            }
        }

        return (int) ($days / 7) + 1;
    }

    public function userDetail($email = NULL) {
        $email = $this->input->post('email');
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row_array();
    }

    public function resetCode($array) {
        $query = $this->db->get_where('reset', array('user_id' => $array['user_id']));
        $response = $query->row_array();
        if (empty($response)) {
            $this->db->insert('reset', $array);
        } else {
            $this->db->where('user_id', $array['user_id']);
            $update_array = array('code' => $array['code']);
            $this->db->update('reset', $update_array);
        }
    }

    public function getUser($array = NULL) {
        $query = $this->db->get_where('users', $array);
        return $query->row_array();
    }

    public function fullUserDetail($id = NULL) {
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
        return $query->row_array();
    }

    public function checkPassword($password) {
        $id = $this->session->userdata('userId');
        $query = $this->db->get_where('users', array('id' => $id, 'password' => $password));
        return $query->result_array();
    }

    public function changePassword($data) {
        $id = $this->session->userdata('userId');
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function changeResetPassword($data, $user_id) {
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    public function getCountryName($country_id) {
        $this->db->select('country_name');
        $query = $this->db->get_where('countries', array('id' => $country_id));
        $country = $query->row_array();
        if (!empty($country))
            return $country['country_name'];
        else
            return '';
    }

//        public function getStateName($state_id) {
//            $this->db->select('province_name');
//            $query = $this->db->get_where('province', array('id'=>$state_id));
//            $state = $query->row_array();
//            if(!empty($state))
//                return $state['province_name'];
//            else
//                return '';
//        }
//        public function getCityName($city_id) {
//            $this->db->select('city_name');
//            $query = $this->db->get_where('cities', array('id'=>$city_id));
//            $city = $query->row_array();
//            if(!empty($city))
//                return $city['city_name'];
//            else
//                return '';
//        }
//        public function getMessages($email, $offset, $type) {
//            $this->db->order_by('id', 'DESC');
//            $this->db->where("to",$email);
//            $this->db->where("spam",'0');
//            $query = $this->db->get('messages', $offset, $type);
//            return $query->result_array();
//        }
//        public function getMessagesForSent($email, $offset, $type) {
//            $this->db->order_by('id', 'DESC');
//            $query = $this->db->get_where('messages', array('from'=>$email), $offset, $type);
//            return $query->result_array();
//        }
//        public function countMessages($email) {
//            $this->db->select('id');
//            $query = $this->db->get_where('messages', array('to'=>$email, 'spam'=>'0'));
//            return $query->num_rows();
//        }
//        public function countSentMessages($email) {
//            $this->db->select('id');
//            $query = $this->db->get_where('messages', array('from'=>$email));
//            return $query->num_rows();
//        }
//        public function getReadedMessages($email, $offset, $type) {
//            $this->db->order_by('id', 'DESC');
//            $this->db->where("to",$email);
//            $this->db->where("read",'1');
//            $this->db->where("spam",'0');
//            $query = $this->db->get('messages', $offset, $type);
//            return $query->result_array();
//        }
//        public function countReadedMessages($email) {
//            $this->db->select('id');
//            $query = $this->db->get_where('messages', array('to'=>$email, 'spam'=>'0', 'read'=>'1'));
//            return $query->num_rows();
//        }
//        public function getReadedSentMessages($email, $offset, $type) {
//            $this->db->order_by('id', 'DESC');
//            $this->db->where("from",$email);
//            $this->db->where("read",'1');
//            $this->db->where("spam",'0');
//            $query = $this->db->get('messages', $offset, $type);
//            return $query->result_array();
//        }
//        public function countReadedSentMessages($email) {
//            $this->db->select('id');
//            $query = $this->db->get_where('messages', array('from'=>$email, 'spam'=>'0', 'read'=>'1'));
//            return $query->num_rows();
//        }
//        public function getunReadedMessages($email, $offset, $type) {
//            $this->db->order_by('id', 'DESC');
//            $this->db->where("to",$email);
//            $this->db->where("read",'0');
//            $this->db->where("spam",'0');
//            $query = $this->db->get('messages', $offset, $type);
//            return $query->result_array();
//        }
//        public function countunReadedMessages($email) {
//            $this->db->select('id');
//            $query = $this->db->get_where('messages', array('to'=>$email));
//            return $query->num_rows();
//        }
//        public function getunReadedSentMessages($email, $offset, $type) {
//            $this->db->order_by('id', 'DESC');
//            $this->db->where("from",$email);
//            $this->db->where("read",'0');
//            $this->db->where("spam",'0');
//            $query = $this->db->get('messages', $offset, $type);
//            return $query->result_array();
//        }
//        public function countunReadedSentMessages($email) {
//            $this->db->select('id');
//            $query = $this->db->get_where('messages', array('from'=>$email, 'spam'=>'0', 'read'=>'0'));
//            return $query->num_rows();
//        }
//        public function getSubCategories($id) {
//            $this->db->where("parent_id =",$id);
//            $this->db->order_by('category_order', 'DESC');
//            $query = $this->db->get('categories');
//            return $query->result_array();
//        }
//        public function mailDetail($id) {
//            $query = $this->db->get_where('messages', array('id'=>$id));
//            return $query->row_array();
//        }
//        public function deleteMsg($id) {
//            $this->db->delete('messages', array('id'=>$id));
//        }
//        public function updateMsg($data, $id) {
//            $this->db->where('id', $id);
//            $this->db->update('messages', $data);
//        }
//       
//        public function subscribeNewsletter($array) {
//            $query = $this->db->get_where('newsletter', array('email'=>$array['email']));
//            $response = $query->row_array();
//            if(empty($response)) {
//                $this->db->insert('newsletter', $array);
//                return $this->db->insert_id();
//            }
//            else {
//                return false;
//            }
//        }
}
