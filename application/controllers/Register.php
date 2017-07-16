<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
		if (!$this->session->userdata('user_session')) {
            $data = array(
                'title' => 'Register | Pro Importir',
                'pageKey' => 'register'
            );
            $this->load->view('main', $data);
        }
	}

	public function do_register()
    {
        if (!$this->session->userdata('user_session')) {

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required|matches[password]',
            								   array('matches' => 'Password does not match.'));

            if (!$this->form_validation->run()) {
                $errors = validation_errors();
                $this->session->set_flashdata('errors', $errors);
                redirect('register','refresh');
            }

        } else {
            redirect('home','refresh');
        }
    }
}

/* End of file Registers.php */
/* Location: ./application/controllers/Registers.php */