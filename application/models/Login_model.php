<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    function admin_login_check()
    {
        $admin_email = $this->input->post('admin_email');
		$admin_password = $this->input->post('admin_password'); //admin123, admin@test.com
		// $password1 = $this->encryption->encrypt($password); 
		// print_r($password1);
		// die;
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('admin_email',$admin_email);
		$this->db->where('admin_password',$admin_password);
		$query=$this->db->get();
		$login=$query->row();
		if($login){
			$this->session->set_userdata('admin_name',$login->admin_name);
			$this->session->set_userdata('admin_email',$login->admin_email);
            $this->session->set_userdata('admin_id',$login->admin_id);     
			return 1;
		} else {
			return 0;
		}
    }
}