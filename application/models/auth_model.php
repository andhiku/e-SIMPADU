<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {

    function Auth_model() {
        parent::__construct();
        $this->load->database();
        $timezone = "Singapore";
        date_default_timezone_set($timezone);
    }

    function process_login($array_input = NULL) {
        if (!isset($array_input) OR count($array_input) != 2)
            return false;
        //set variable nya
        $username = $array_input[0];
        //$password = $array_input[1];
        $password = md5($array_input[1]);
        //ambil dari database percobaan
        $query = $this->db->query("SELECT * FROM user_tb WHERE user_username='$username' and user_password='$password' LIMIT 1");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $data_user['id'] = $row->user_id;
            $data_user['userid'] = $row->user_username;
            $data_user['usrpass'] = $row->user_password;
            $data_user['usrnama'] = $row->user_nama;
            $data_user['usrrole'] = $row->user_role;

            if ($password === $data_user['usrpass']) {
                $this->waktu_login($data_user['id']);
                $this->session->set_userdata('logged_user', $data_user);
                return true;
            }
            return false;
        }
        return false;
    }

    function check_logged() {
        return ($this->session->userdata('logged_user')) ? TRUE : FALSE;
    }

    function waktu_login($id) {
        $dt = date('Y-m-d h:i:s', time());
        $sql_db = "update user_tb set last_login = '$dt' where user_id='$id'";
        return mysql_query($sql_db);
    }

    function logged_id() {
        return ($this->check_logged()) ? $this->session->userdata('logged_user') : '';
    }

    function restrict() {
        if ($this->check_logged() == false) {
            redirect('login');
        }
    }

    function get_data_tabel($tabel) {
        return $this->db->get($tabel);
    }

    function cek_keamanan($roles) {
        if (in_array("public", $roles)) { // klo di roles dikasi public, ya langsung aja akses
            return true;
        } else { // klo ndak cek identitasnya
            // jika identitas_login sesuai dengan yang di set di set_keamanan berarti ok
            //$this->session->set_userdata($array);
            if ($users = $this->session->userdata('logged_user')) {
                if (in_array($users['user_role'], $roles)) {
                    return $users; // user boleh akses, maka berikan info user
                } else {
                    $out = "<script>";
                    $out .= "alert('Maaf anda tidak memiliki privilege untuk mengakses halaman ini, anda akan dikembalikan ke halaman control panel.');";
                    $out .= "location.href='" . url("index", "control_panel") . "';";
                    $out .= "</script>";
                    die($out);
                }
            } else {
                header("Location: " . base_url() . "users/login"); // belum punya login, lemparkan ke halaman login
            }
        }
    }

}

?>
