<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function daftar($tbl = null, $url = null, $kondisi = null, $baris = null) {
        $config['base_url'] = site_url($url);
        $config['total_rows'] = $this->recTotal($tbl, $kondisi); //$this->db->count_all($tbl);
        $config['per_page'] = $baris;
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
        $config['num_links'] = 2;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //$this->uri->segment(3);
        $this->pagination->initialize($config);
        $this->db->where($kondisi);

        $det_daftar = $this->db->get($tbl, $config['per_page'], $offset);
        if ($det_daftar->num_rows() > 0) {
            return $det_daftar->result_array();
        }
    }

    function add_save($tbl, $data) {
        $this->db->insert($tbl, $data);
        return;
    }

    function add_multisaveid($tbl, $data) {
        $this->db->insert($tbl, $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    function getwhere($tbl = null, $kondisi = null) {
        $query = $this->db->get_where($tbl, $kondisi);
        return $query;
    }

    public function getmultidatabyid($tbl, $field, $id = 0) {
        if ($id === 0) {
            $query = $this->db->get($tbl);
            return $query->result_array();
        }
        $query = $this->db->get_where($tbl, array($field => $id));
        return $query->row_array();
    }

    function get_data_tabel($tbl = null) {
        $result = $this->db->get($tbl);
        return $result->result_array();
    }

    function getDataTabel($tbl = null, $kondisi = null) {
        $this->db->where($kondisi);
        $result = $this->db->get($tbl);
        return $result->result_array();
    }

    function getDataMultiTable($field, $tbl1 = null, $tbl2 = null, $kondisi = null) {
        $this->db->select($field);
        $this->db->from($tbl2);
        $this->db->join($tbl1, $kondisi, 'inner');
        $result = $this->db->get();
        return $result->result_array();
    }

    function GetDataRandom($tbl = null) {
        $this->db->order_by('id', 'RANDOM');
        $result = $this->db->get($tbl);
        return $result->result_array();
    }

    //function data_update($tbl, $id, $data) {
    //    $this->db->where($id, $data[$id]);
    function data_update($tbl, $kondisi, $data) {
        $this->db->where($kondisi);
        $this->db->update($tbl, $data);
        return;
    }

    function hapus_data($tbl, $kondisi) {
        $this->db->where($kondisi);
        $this->db->delete($tbl);
        return;
    }

    function recTotal($tbl = null, $kondisi = null) {
        if ($kondisi != null) {
            $this->db->where($kondisi);
        }
        $query = $this->db->get($tbl);
        return $query->num_rows();
    }

    //rekap include 
    function rekService() {
        $this->db->select("jenis, COUNT(jenis) as jml, "
                . "SUM(CASE WHEN stts = '0' then 1 else 0 end )  as pr0, "
                . "SUM(CASE WHEN stts = '1' then 1 else 0 end )  as pr1, "
                . "SUM(CASE WHEN stts = '2' then 1 else 0 end )  as pr2, "
                . "SUM(CASE WHEN stts = '3' then 1 else 0 end )  as pr3, "
                . "SUM(CASE WHEN stts = '4' then 1 else 0 end )  as pr4, "
                . "SUM(CASE WHEN stts = '5' then 1 else 0 end )  as pr5, "
                . "SUM(CASE WHEN stts = '6' then 1 else 0 end )  as pr6, "
                . "SUM(CASE WHEN stts = '7' then 1 else 0 end )  as pr7, "
                . "SUM(CASE WHEN stts = '8' then 1 else 0 end )  as pr8, "
                . "SUM(CASE WHEN stts = '9' then 1 else 0 end )  as pr9, "
                . "SUM(CASE WHEN stts = '88' then 1 else 0 end )  as btl, "
                . "SUM(CASE WHEN stts = '99' then 1 else 0 end )  as sls, ", false);
        $this->db->from('layanan_tb');
        //$this->db->join('tp_jabatan', 'tp_identitas.NIP = tp_jabatan.NIP');
        //$this->db->where('tp_identitas.KSTAPEG in ("1","2")');
        //$this->db->where('tp_identitas.KDUKPNS in ("01","04")');
        $this->db->group_by('jenis');
        $this->db->order_by('jenis', 'ASC');
        $query = $this->db->get();
        return $query;
    }
    
    function getJadwal() {
        $this->db->select('*');
        $this->db->from('layanan_tb');
        $this->db->where('lastsms >= now() - INTERVAL 1 DAY');
        $this->db->where('stts !=', '99');
        $result = $this->db->get();
        return $result;//->result_array();
        //'SELECT * FROM layanan_tb WHERE lastsms >= now() - INTERVAL 1 DAY and stts < 99 group by id'
    }
    
    function getJadwalKosong() {
        $this->db->select('*');
        $this->db->from('layanan_tb');
        $this->db->where('lastsms = 0');
        $result = $this->db->get();
        return $result;//->result_array(); --result array menampilkan semua data pada echo json_encode
    }

}
