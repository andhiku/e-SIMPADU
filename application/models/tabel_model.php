<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tabel_model extends CI_Model {

    function user_tb() {
        $query = $this->db->query(
                "CREATE TABLE IF NOT EXISTS `user_tb` (
                    `user_id` int(11) NOT NULL AUTO_INCREMENT,
                    `nip` varchar(18) DEFAULT NULL,
                    `user_nama` varchar(100) NOT NULL,
                    `user_username` varchar(100) NOT NULL,
                    `user_password` varchar(100) NOT NULL,
                    `user_level` int(5) NOT NULL,
                    `user_role` varchar(15) NOT NULL DEFAULT 'operator',
                    `inst_kerja` int(11) NOT NULL DEFAULT '0',
                    `status` int(1) NOT NULL DEFAULT '0',
                    `last_login` timestamp NULL DEFAULT NULL,
                    PRIMARY KEY (`user_id`)
                    ) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 10");

        if ($query) {
            $data_tambah = array(
                'nip' => '123456789012345678',
                'user_nama' => 'Administrator',
                'user_username' => 'admin',
                'user_password' => md5('qwerty'),
                'user_role' => 'admin'
            );
            $this->db->insert('user_tb', $data_tambah);
            redirect(base_url() . 'login');
        }
    }

    function tb_label_dok() {
        $query = $this->db->query("CREATE TABLE IF NOT EXISTS `tb_label_dok` (
            `id` int(12) NOT NULL AUTO_INCREMENT,
            `id_loker` varchar(20) DEFAULT NULL,
            `pemilik` varchar(40) DEFAULT NULL,
            `label_dok` varchar(18) DEFAULT NULL,
            `atas_nama` varchar(50) DEFAULT NULL,
            `profile_url` varchar(80) DEFAULT NULL,
            `operator` varchar(40) DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10");
        if ($query) {
            redirect(base_url() . 'publik');
        }
    }

}
