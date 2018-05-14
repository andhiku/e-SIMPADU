<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Publik extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('auth_model', 'crud_model'));
    }

    public function index() {
        if (!$this->auth_model->check_logged()) {
            $url = base_url() . 'publik';
            $data['judul'] = "SELAMAT DATANG ";
            $this->template->load('template/_hz_template', 'welcome', $data);
        } else {
            $data['judul'] = "PROGRESS LAYANAN TERPADU";
            $data['dtlist'] = $this->crud_model->get_data_tabel('layanan_tb');
            $this->template->load('template/_hz_template', 'home', $data);
        }
    }

    function pengguna($aksi = null, $idx = null) {
        switch ($aksi) {
            case 'tambah':
                $data['judul'] = "PENAMBAHAN DATA PENGGUNA";
                $data['dwjnslayan'] = $this->crud_model->get_data_tabel('jnslayanan');
                $this->template->load('template/_hz_template', 'general/formUser', $data);
                break;

            case 'simpan':
                $dataAdd = array(
                    'nip' => $this->input->post('idset'),
                    'user_nama' => $this->input->post('nama'),
                    'user_username' => $this->input->post('username'),
                    'user_password' => md5($this->input->post('password')),
                    'telp' => $this->input->post('telp'),
                    'user_role' => $this->input->post('user_role')
                );
                $this->db->insert('user_tb', $dataAdd);
                redirect(base_url() . 'publik/pengguna');
                break;

            case 'edit':
                $filter = "user_id = '$idx'";
                $data['dwjnslayan'] = $this->crud_model->get_data_tabel('jnslayanan');
                $data['dtedit'] = $this->crud_model->getwhere('user_tb', $filter);
                $data['judul'] = "EDIT DATA PENGGUNA";
                $this->template->load('template/_hz_template', 'general/formUser', $data);
                break;

            case 'updatedata':
                $filter = "user_id = '$idx'";
                $cekUpdatePasw = $this->input->post('password');
                if (strlen($cekUpdatePasw) > 0) {
                    $dataSet = array(
                        'nip' => $this->input->post('idset'),
                        'user_nama' => $this->input->post('nama'),
                        'user_username' => $this->input->post('username'),
                        'user_password' => md5($cekUpdatePasw),
                        'telp' => $this->input->post('telp'),
                        'user_role' => $this->input->post('user_role')
                    );
                } else {
                    $dataSet = array(
                        'nip' => $this->input->post('idset'),
                        'user_nama' => $this->input->post('nama'),
                        'user_username' => $this->input->post('username'),
                        'telp' => $this->input->post('telp'),
                        'user_role' => $this->input->post('user_role')
                    );
                }
                $this->crud_model->data_update('user_tb', $filter, $dataSet);
                redirect(base_url() . 'publik/pengguna');
                break;

            default :
                $data['judul'] = "PENGATURAN PENGGUNA";
                $data['dtlist'] = $this->crud_model->getDataMultiTable(
                        '*', 'user_tb', 'jnslayanan', 'jnslayanan.id=user_tb.user_role'
                );
                $this->template->load('template/_hz_template', 'general/daftar_user', $data);
        }
    }

    function cari() {
        $cari_peg = $this->input->POST('caripeg');
        $data['dtjenis'] = $this->crud_model->get_data_tabel('surat_jenis');
        $this->template->load('template/_general', 'administrasi/disposisi', $data);
    }

    function tespage() {
        $this->template->load('template/_general', 'halamantes');
    }

    function userlogin() {
        $this->template->load('template/_hz_template', 'general/login_page');
    }

    function informasi() {
        $data['judul'] = "SELAMAT DATANG DI LAYANAN SISTEM TERPADU ";
        $data['dtlist'] = $this->crud_model->getDataTabel('layanan_tb', "stts != '99'");
        //run sms api where $kondisi
        exec("php /path/to/script.php > /dev/null &");
        $this->template->load('template/_ah_template', 'informasi', $data);
    }

    function refinfo() {
        $data['dtlist'] = $this->crud_model->getDataTabel('layanan_tb', "stts != '99'");
        $this->load->view('retinfo', $data);
    }

    function proses_login() {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        //$this->form_validation->set_rules('security', 'security', 'trim|required|callback_valid_captcha');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $login_array = array($this->input->post('username'), $this->input->post('password'));
            if ($this->auth_model->process_login($login_array)) {
                redirect(base_url());
            } else {
                $this->index();
            }
        }
    }

    //stop all session 
    function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'publik');
    }

}

?>