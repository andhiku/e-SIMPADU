<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template {

    var $template_data = array();

    function set($name, $value) {
        $this->template_data[$name] = $value;
    }

    public function load($template = '', $view = '', $data = null) {
        $this->CI = & get_instance();

        $arr_menu = Spyc::YAMLLoad(APPPATH . "/menu.yml");
        //$user = $this->CI->session->userdata('logged_user'); //karena di tempelate maka menggunakan
        //$this->CI->session...........

        if ($user = $this->CI->session->userdata('logged_user')) {
            $role = $user['usrrole']; 
            $data['menu_list'] = $arr_menu[$role];
        } else {
            $data['menu_list'] = $arr_menu['public'];
        }
        $this->set('contents', $this->CI->load->view($view, $data, TRUE)); //set dynamic content
        return $this->CI->load->view($template, $this->template_data, $data);
    }

}
