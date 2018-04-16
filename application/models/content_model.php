<?php

class Content_model extends CI_Model {

    function Auth_model() {
        parent::__construct();
        $this->load->database();
    }

    function home_content() {
        $content = array(
            array('name' => 'Informasi Terbaru', 'link' => base_url() . 'content'),
            array('name' => 'Konsultasi dan Tanya Jawab', 'link' => base_url() . 'home/konsultasi'),
            array('name' => 'Peraturan Perundangan', 'link' => base_url() . 'home/peraturan'),
            array('name' => 'SKPD per Kota Kec.', 'link' => base_url() . 'home/daftarskpdkota'),
            array('name' => 'File Share', 'link' => base_url() . 'home/fileshare')
        );
        return $content;
    }

    function list_content_rand($offset = 0) {
        $tbl = 'public_post';
        $config['base_url'] = site_url('content');
        $config['total_rows'] = $this->db->count_all($tbl);
        $config['per_page'] = "6";
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
        $this->pagination->initialize($config);
        $offset = $this->uri->segment(3);
        $this->db->where('status', '1');
        $this->db->order_by("id", "desc");
        $dt_conten = $this->db->get($tbl, $config['per_page'], $offset);
        return $dt_conten->result_array();
        #return $dt_conten;
    }

    function limit_content() {
        $this->db->order_by("tgl_surat", "desc");
        $this->db->limit(15, 0);
        $query = $this->db->get('surat_master');
        return $query->result_array();
    }

    function cari_content($varcari = null) {
        $this->db->order_by("tgl_surat", "desc");
        $this->db->limit(15, 0);
        $this->db->like('perihal', $varcari);
        $query = $this->db->get('surat_master');
        return $query->result_array();
    }
    
    
    function cari_perihal($varcari = null) {
        $this->db->like('perihal', $varcari);
        $query = $this->db->get('surat_master');
        return $query->result_array();
    }
    
    function cari_asal($varcari = null) {
        $this->db->like('asal', $varcari);
        $query = $this->db->get('surat_master');
        return $query->result_array();
    }
    

    function daftar($tbl=null,$url=null,$kondisi=null,$sort=null) {
        if ($this->uri->segment(3) === FALSE) {
            $offset = 0;
        } else {
            $offset = $this->uri->segment(3);
        }
        $config['base_url'] = site_url($url);
        $config['total_rows'] = $this->rec_total($tbl, $kondisi);
        $config['per_page'] = 15;
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
        $config['num_links'] = 3;
        $this->pagination->initialize($config);

        if ($kondisi != null) {
            $this->db->where($kondisi);
        }
        if ($sort != null) {
            $this->db->order($sort);
        }

        $det_daftar = $this->db->get($tbl, $config['per_page'], $offset);

        if ($det_daftar->num_rows() > 0) {
            return $det_daftar->result_array();
            //return $det_daftar;
        }
    }

    function rec_total($tbl = null, $kondisi = null) {
        if ($kondisi != null) {
            $this->db->where($kondisi);
        }
        $query = $this->db->get($tbl);
        return $query->num_rows();
    }

}

?>
