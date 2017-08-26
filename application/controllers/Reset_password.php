<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->library('utility');
        $this->load->library('emailing');
    }

    public function index()
    {
        $token = $this->input->get('reset_token');
        if (!$this->session->userdata('user_session') && !isset($token)) {
            $this->load->view('reset_password/enter_email');
        } else if (!$this->session->userdata('user_session') && isset($token)) {
            $userData = $this->user->find_by_reset_token($token);

            if (count($userData) == 1 && $userData[0]->is_confirmed == 1) {

                $viewData = array(
                    'resetToken' => $token,
                );
                $this->load->view('reset_password/reset_password', $viewData, FALSE);

            } else if (count($userData) == 1 && $userData[0]->is_confirmed == 1) {
                $error = "Something wrong with your request.";
                $this->session->set_flashdata('errors', $error);
                redirect('login','refresh');
            }
            
        } else {
            redirect('home','refresh');
        }
    }

    public function submit($value='')
    {
        if (!$this->session->userdata('user_session')) {
            $email = $this->input->post('current-email');

            $userData = $this->user->find_by_email($email);

            if (count($userData) == 1 && $userData[0]->is_confirmed == 1) {

                $resetToken = $this->utility->generateToken(25);
                $updatedData = array(
                    'reset_token' =>  $resetToken,
                );
                $this->db->trans_start();
                $this->user->update_by_id($userData[0]->id, $updatedData);
                $this->db->trans_complete();

                $msg = $this->load->view('email_templates/reset_password', array('resetPasswordUrl' => base_url('reset_password').'?reset_token='.$resetToken), TRUE);
                $this->emailing->send_email($email, 'Reset Password', $msg);

                $this->session->set_flashdata('success', 'Successfully create your request. Please click the link on your email.');
                redirect('login','refresh');

            } else {
                // TODO: mesti diupdate dengan kasih flash message klo email ga ada atau blm di confirm
                redirect('reset_password','refresh');
            }
        }
    }

    public function update()
    {
        $token = $this->input->get('reset_token');
        if (!$this->session->userdata('user_session') && isset($token)) {
            $userData = $this->user->find_by_reset_token($token);

            if (count($userData) == 1 && $userData[0]->is_confirmed == 1) {

                $updated = array(
                    'password' => password_hash($this->input->post('new-password'), PASSWORD_BCRYPT),
                    'reset_token' => null,
                );
                $this->db->trans_start();
                $this->user->update_by_id($userData[0]->id, $updated);
                $this->db->trans_complete();

                $this->session->set_flashdata('success', 'Successully update your password.');

            } else if (count($userData) == 1 && $userData[0]->is_confirmed == 1) {
                $error = "Something wrong with your request.";
                $this->session->set_flashdata('errors', $error);
            }

            redirect('login','refresh');
            
        }
    }

}

/* End of file Reset_password.php */
/* Location: ./application/controllers/Reset_password.php */