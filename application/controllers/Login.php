<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function admin_login()
	{
		$this->load->view('admin/admin_login');
	}

    public function admin_login_check()
    {
        $result = $this->Login_model->admin_login_check();
        if($result){

            $this->session->set_flashdata('msg', 'Welcome '.$this->session->userdata('admin_name'));
            $this->session->set_flashdata('msg_class', 'success');
			redirect(base_url().'admin-dashboard');
        }else{
            $this->session->set_flashdata('msg', 'Invalid Details');
            $this->session->set_flashdata('msg_class', 'danger');
            redirect(base_url().'admin_login');
        }
    }

    public function admin_logout()
    {
        $this->session->unset_userdata('admin_name');
		$this->session->unset_userdata('admin_email');
		$this->session->unset_userdata('admin_id');
		$this->session->set_flashdata('msg', 'Successfully Logged Out');
		$this->session->set_flashdata('msg_class', 'success');
        redirect(base_url().'admin_login');
    }
}
