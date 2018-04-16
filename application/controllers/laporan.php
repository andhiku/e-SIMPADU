<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('auth_model', 'crud_model'));
    }

    public function index() {
        if (!$this->auth_model->check_logged()) {
            redirect(base_url() . 'publik/userlogin');
        } else {
            redirect(base_url() . 'laporan/rekaplayanan');
        }
    }

    function rekaplayanan() {
        $data['judul'] = "REKAPITLASI LAYANAN";
        $data['dtlist'] = $this->crud_model->rekService();
        $this->template->load('template/_hz_template', 'report/rekLayanan', $data);
    }

}

?>