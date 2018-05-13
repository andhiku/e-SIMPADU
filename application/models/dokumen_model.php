<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokumen_model extends CI_Model {

    function daftar($tbl = null, $url = null, $kondisi = null, $sort = null) {
        if ($this->uri->segment(3) === FALSE) {
            $offset = 0;
        } else {
            $offset = $this->uri->segment(3);
        }
        $config['base_url'] = site_url($url);
        $config['total_rows'] = $this->db->count_all($tbl);
        $config['per_page'] = 20;
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        $offset = $this->uri->segment(3);

        if(isset($kondisi)) {
            $this->db->where($kondisi);
        }
        $det_daftar = $this->db->get($tbl, $config['per_page'], $offset);
        if ($det_daftar->num_rows() > 0) {
            return $det_daftar->result_array();
        }
    }

    function add_save($tbl, $data) {
        $this->db->insert($tbl, $data);
        return;
    }

    function get_where($tbl, $kondisi) {
        $query = $this->db->get_where($tbl, $kondisi);
        return $query();
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

    function get_label($idlabel) {
        $this->db->where('label_dok', $idlabel);
        $query = $this->db->get('tb_label_dok');
        return $query;
    }

    //Kunci data pegawai dengan cookies 
    function cari_dokumen() {
        $owner_doc = $this->session->userdata('dok_id');
        $this->db->select('*');
        $this->db->from('dokumentasi');
        $this->db->where('nip', $owner_doc);
        $query = $this->db->get();
        return $query;
        //return $query->result_array();
    }

    function new_upload($namafile = null) {
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT']. dokumen_url;
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $namafile;
        $config['overwrite'] = 'true';
        
        $this->load->library('upload', $config);
        if (isset($_FILES['userfile']) && !empty($_FILES['userfile']['name'])) {
            if ($this->upload->do_upload('userfile')) {
                // set a $_POST value for 'image' that we can use later
                $upload_data = $this->upload->data();
                //$_POST['image'] = $upload_data['file_name'];
                return true;
            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        } else {
            // throw an error because nothing was uploaded
            $this->form_validation->set_message('handle_upload', "You must upload an image!");
            return false;
        }
    }

    
    
    function upload_dokumen($namafile = 'noname') {
        $config['upload_path'] = './' . dokumen_url;
        $config['allowed_types'] = 'pdf'; //'gif|jpg|png';
        $config['max_size'] = '900';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['file_name'] = $namafile;
        $config['overwrite'] = 'true';
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        return;
    }

    function upload_profile($namafile = 'noname') {
        $config['upload_path'] = './' . profile_url;
        $config['allowed_types'] = 'jpg'; //'gif|jpg|png';
        $config['max_size'] = '900';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['file_name'] = $namafile;
        $config['overwrite'] = 'true';
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        return;
    }
    
    function get_job_positions($id, $field, $tbl) { 
        $result = $this->db->select($id, $field)->get($tbl)->result_array(); 
 
        $array = array(); 
        foreach($result as $r) { 
            $array[$r[$id]] = $r[$field]; 
        } 
        $array[''] = '-- Pilihan Role --'; 
        return $array; 
    }
    
    function lastSms($id) {
        $dt = date('Y-m-d h:i:s', time());
        //$sql_db = "update user_tb set last_login = '$dt' where user_id='$id'";
        $sql_db = "update layanan_tb set lastSms = '$dt' where user_id='$id'";
        return mysql_query($sql_db);
    }

}