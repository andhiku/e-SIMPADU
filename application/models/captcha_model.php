<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Captcha_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function make_captcha() {
       $vals = array(
            'img_path' => 'files/captcha/',
            'img_url' => base_url() . 'files/captcha/',
            'img_width' => 100, // width
            'img_height' => 30, // height
            'font_path' =>  '../system/fonts/texb.ttf',
            'expiration' => 3600,
            'word' => random_string('numeric', 6),
                //kosongkan untuk random text angka
        );

        $cap = create_captcha($vals); // Write to DB
        if ($cap) {
            $data = array(
                'captcha_id' => '',
                'captcha_time' => $cap['time'],
                'ip_address' => $this->input->ip_address(),
                'word' => $cap['word'],
            );
            $query = $this->db->insert_string('captcha', $data);
            $this->db->query($query);
            return $cap['image'];
        } else {
           //return "Captcha not work " . $vals['font_path'];
           return $cap['image'];
        }
    } 

    function check_captcha() {
        // Delete old data ( 2hours)
        $expiration = time() - 3600;
        $sql = " DELETE FROM captcha WHERE captcha_time < ? ";
        $binds = array($expiration);
        $query = $this->db->query($sql, $binds);

        //checking input
        $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
        $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();

        if ($row->count > 0) {
            return true;
        }
        return false;
    }

}

