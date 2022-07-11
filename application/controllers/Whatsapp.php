<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsapp extends CI_Controller
{



    function __construct()
    {
        parent::__construct();
        error_reporting(0);

        if ($this->session->userdata('admin_id')) {
        } else {
            $this->session->set_flashdata('msg', 'Please Login First');
            $this->session->set_flashdata('msg_class', 'danger');
            redirect(base_url() . 'admin_login');
        }
    }
    function show_qr()
    {
        $url = $this->Whatsapp_model->get_url();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url['whatsapp_url']."listUsers");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $arr = array('name' => 'Vishal');
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        $result = curl_exec($ch);
        print_r($result);
        curl_close($ch);
    }

    function check_status()
    {
        $result = $this->Whatsapp_model->check_status();
        echo ($result);
    }



}
