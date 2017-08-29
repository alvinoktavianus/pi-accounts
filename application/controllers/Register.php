<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->library('utility');
        $this->load->library('emailing');
    }

	public function index()
	{
		if (!$this->session->userdata('user_session')) {
            $data = array(
                'title' => 'Register | Pro Importir',
                'pageKey' => 'register'
            );
            $this->load->view('register/new-register', $data);
        }
	}

	public function do_register()
    {
        if (!$this->session->userdata('user_session')) {

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required|matches[password]',
            								   array('matches' => 'Password does not match.'));
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('last_name', 'last Name', 'trim|required|min_length[3]');

            if (!$this->form_validation->run()) {
                $errors = validation_errors();
                $this->session->set_flashdata('errors', $errors);
                redirect('register','refresh');
            } else {
                $emailToken = $this->utility->generateToken(25);

                $userData = array(
                    'email' => $this->input->post('email'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'role' => 'user',
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'verify_token' => $emailToken,
                );
                $this->db->trans_start();
                $this->user->insert_new_user($userData);
                $this->db->trans_complete();

                $msg = $this->load->view('email_templates/verify_email', array('verifyEmailUrl' => base_url('verify_email').'?verify_token='.$emailToken), TRUE);
                $this->emailing->send_email($this->input->post('email'), 'Verify Email', $msg);

                $this->session->set_flashdata('success', 'Successfully register new account. Please verify your email.');
            }
            redirect('login','refresh');
        } else {
            redirect('home','refresh');
        }
    }
}

/* End of file Registers.php */
/* Location: ./application/controllers/Registers.php */