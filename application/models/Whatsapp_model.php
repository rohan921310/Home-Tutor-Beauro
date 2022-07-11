<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_model extends CI_Model {

    function get_url()
    {
        $admin_id = $this->session->userdata('admin_id');
        $this->db->select('whatsapp_url');
        $this->db->from('admin');
        $this->db->where('admin_id', $admin_id);
    
        $query = $this->db->get()->row_array();
        return $query;
    }
    function check_status()
    {
        $url = $this->get_url();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url['whatsapp_url']."checkStatus");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $arr = array('name' => 'Vishal');
        $result = curl_exec($ch);
        curl_close($ch);
        $newresut = json_decode($result, true);
        return($newresut['status']);
    }

    function send_message($text, $phone)
    {
        $status = 0;
        $url = $this->get_url();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url['whatsapp_url']."checkStatus");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $newresut = json_decode($result, true);
        if($newresut != null){
            $status = $newresut['status'];
        }
        
        if($status == 1){
            $text = str_replace(' ', '_', $text);
            // echo($text);die;
            $url = $url['whatsapp_url'].'sendMessage?phone='.$phone.'&text='.$text;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $arr = array('phone' => $phone, 'text' => $text);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
            $result = curl_exec($ch);
            curl_close($ch);
            $status =1 ;
        }else{
           $status = 0;
        }
        $formArray = array(
            'text' => $text,
            'phone' => $phone,
            'is_send' => $status
        );
        $this->db->insert('whatsapp', $formArray);
       
    }


    function fetch_unsend_messages()
    {
        $this->db->select('*');
        $this->db->from('whatsapp');
        $this->db->where('is_send', 0);
        $query = $this->db->get();
        return $query->result();
    }


    function send_unsend_messages($text, $phone, $id)
    {
        $url = $this->get_url();
        $text = str_replace(' ', '_', $text);
            // echo($text);die;
            $url = $url['whatsapp_url'].'sendMessage?phone='.$phone.'&text='.$text;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $arr = array('phone' => $phone, 'text' => $text);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
            $result = curl_exec($ch);
            curl_close($ch);

            $formArray = array(
                'text' => $text,
                'phone' => $phone,
                'is_send' => 1
            );
            $this->db->where('whatsapp_id', $id);
            $this->db->update('whatsapp', $formArray);
    }

}