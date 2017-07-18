<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        if (!$this->session->userdata('user_session')) {
            $data = array(
                'title' => 'Login | Pro Importir',
                'pageKey' => 'login'
            );
            $this->load->view('main', $data);
        }
    }

    public function do_login()
    {
        if (!$this->session->userdata('user_session')) {

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

            if (!$this->form_validation->run()) {
                $errors = validation_errors();
                $this->session->set_flashdata('errors', $errors);
                redirect('login','refresh');
            } else {
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                $this->load->model('user');
                $resultUser = $this->user->find_by_email($email);

                if (empty($resultUser) || !password_verify($password, $resultUser[0]->password)) {
                    $error = "Please enter correct email and password";
                    $this->session->set_flashdata('errors', $error);
                    redirect('login','refresh');
                } else if (password_verify($password, $resultUser[0]->password) && !password_verify($resultUser[0]->role, $this->input->server('ROOT_ROLE'))) {
                    $data = array(
                        'role' => $resultUser[0]->role,
                        'userId' => $resultUser[0]->id,
                        'first_name' => $resultUser[0]->first_name
                    );
                    $this->session->set_userdata('user_session', $data);
                    redirect('home','refresh');
                }
            }

        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */