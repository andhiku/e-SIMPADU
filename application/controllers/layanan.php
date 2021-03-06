<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('auth_model', 'crud_model'));
    }

    public function index() {
        if (!$this->auth_model->check_logged()) {
            redirect(base_url() . 'publik/userlogin');
        } else {
            redirect(base_url() . 'publik');
        }
    }

    function jnslayanan($aksi = null, $idx = null) {
        switch ($aksi) {
            case 'tambah':
                $data['judul'] = "PENAMBAHAN DATA LAYANAN";
                $this->template->load('template/_hz_template', 'layanan/formJnsLayanan', $data);
                break;

            case 'simpan':
                $dataAdd = array(
                    'nmlayanan' => $this->input->post('nama'),
                    'waktu' => $this->input->post('waktu'),
                );
                $proses = $this->crud_model->add_save('jnslayanan', $dataAdd);
                redirect(base_url() . 'layanan/jnslayanan');
                break;

            case 'hapus':
                $filter = "id = '$idx'";
                $this->crud_model->hapus_data('jnslayanan', $filter);
                redirect(base_url() . 'layanan/jnslayanan');
                break;

            case 'edit':
                $filter = "id = '$idx'";
                $data['dtedit'] = $this->crud_model->getwhere('jnslayanan', $filter);
                $data['judul'] = "EDIT DATA LAYANAN";
                $this->template->load('template/_hz_template', 'layanan/formJnsLayanan', $data);
                break;

            case 'updatedata':
                $filter = "id = '$idx'";
                $dataSet = array(
                    'nmlayanan' => $this->input->post('nama'),
                    'waktu' => $this->input->post('waktu'),
                );
                $this->crud_model->data_update('jnslayanan', $filter, $dataSet);
                redirect(base_url() . 'layanan/jnslayanan');
                break;

            default :
                $data['judul'] = "PENGATURAN JENIS LAYANAN";
                $data['dtlist'] = $this->crud_model->get_data_tabel('jnslayanan');
                $this->template->load('template/_hz_template', 'layanan/ListJnsLayanan', $data);
        }
    }

    function daftarlayanan($aksi = null, $idx = null) {
        switch ($aksi) {
            case 'tambah':
                $data['judul'] = "REGISTRASI PELAYANAN ";
                $data['dwjnslayan'] = $this->crud_model->get_data_tabel('jnslayanan');
                $this->template->load('template/_hz_template', 'layanan/formPendaftaran', $data);
                break;

            case 'simpan':
                $dataAdd = array(
                    'tglberkas' => post_tgl_id($this->input->post('tglusul')),
                    'noregister' => random(12),
                    'pemohon' => $this->input->post('nama'),
                    'jenis' => $this->input->post('jnslayan'),
                    'keterangan' => 'TERDAFTAR',
                    'telp' => $this->input->post('telp'),
                    'stts' => '0',
                );
                $this->db->insert('layanan_tb', $dataAdd);
                redirect(base_url() . 'layanan/daftarlayanan');

            case 'updatedata':
                $filter = "id = '$idx'";
                $dataSet = array(
                    'tglberkas' => post_tgl_id($this->input->post('tglusul')),
                    'pemohon' => $this->input->post('nama'),
                    'jenis' => $this->input->post('jnslayan'),
                    'telp' => $this->input->post('telp'),
                );
                $this->crud_model->data_update('layanan_tb', $filter, $dataSet);
                redirect(base_url() . 'layanan/daftarlayanan');
                break;

            case 'hapus':
                $filter = "id = '$idx'";
                $this->crud_model->hapus_data('layanan_tb', $filter);
                redirect(base_url() . 'layanan/daftarlayanan');
                break;

            case 'edit':
                $filter = "id = '$idx'";
                $data['dwjnslayan'] = $this->crud_model->get_data_tabel('jnslayanan');
                $data['dtedit'] = $this->crud_model->getwhere('layanan_tb', $filter);
                $data['judul'] = "EDIT PROGRESS LAYANAN";
                $this->template->load('template/_hz_template', 'layanan/formPendaftaran', $data);
                break;

            case 'proses':
                $users = $this->session->userdata('logged_user');
                $idmaster = $this->input->post('idmlayan');
                $filter = "id = '$idmaster'";

                $endpross = $this->input->post('selesai');
                if ($endpross == TRUE) {
                    $prosesset = '99';
                } else {
                    $prosesset = $this->input->post('prosesno');
                }

                $dataAdd = array(
                    'tglproses' => post_tgl_id($this->input->post('tangg')),
                    'keterangan' => $this->input->post('keter'),
                    'idlayanan' => $idmaster,
                    'prosesno' => $prosesset,
                    'userent' => $users['userid'],
                );
                $this->crud_model->add_save('tbproses', $dataAdd);

                //UPDATE KETERANGAN DATA MASTER
                $dataSet = array(
                    'keterangan' => $this->input->post('keter'),
                    'stts' => $prosesset
                );
                //$now = date('Y-m-d H:i:s');
                $kosong = date('0000-00-00 00:00:00');
                $this->db->set('lastsms', $kosong);
                $this->crud_model->data_update('layanan_tb', $filter, $dataSet);

                redirect(base_url() . 'layanan/daftarlayanan');
                break;

            default :
                $data['judul'] = "DAFTAR PROGRESS LAYANAN";
                $data['dtlist'] = $this->crud_model->daftar('layanan_tb', 'layanan/daftarlayanan', "stts != '99'", '10');
                $this->template->load('template/_hz_template', 'layanan/ListLayanan', $data);
        }
    }

    function cari() {
        $cari_peg = $this->input->POST('caripeg');
        $data['dtjenis'] = $this->crud_model->get_data_tabel('surat_jenis');
        $this->template->load('template/_general', 'administrasi/disposisi', $data);
    }

}

?>