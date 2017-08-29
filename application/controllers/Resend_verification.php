<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resend_verification extends CI_Controller {

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
            $this->load->view('resend_verification/resend');
        } else {
            redirect('/','refresh');
        }
    }

    public function submit()
    {
        if (!$this->session->userdata('user_session')) {
            $email = $this->input->post('resendEmail');
            $userData = $this->user->find_by_email($email);

            if (count($userData) == 0) {
                $this->session->set_flashdata('errors', 'The email address is invalid.');
                redirect('resend_verification','refresh');
            } else if (count($userData) == 1 && $userData[0]->is_confirmed == 0) {

                $emailToken = $this->utility->generateToken(25);
                $updatedData = array(
                    'verify_token' =>  $emailToken,
                );
                $this->db->trans_start();
                $this->user->update_by_id($userData[0]->id, $updatedData);
                $this->db->trans_complete();

                $msg = $this->load->view('email_templates/verify_email', array('verifyEmailUrl' => base_url('verify_email').'?verify_token='.$emailToken), TRUE);
                $this->emailing->send_email($this->input->post('resendEmail'), 'Verify Email', $msg);

                $this->session->set_flashdata('success', 'Successfully resend email verification');
                redirect('login','refresh');

            } else {
                $this->session->set_flashdata('errors', 'Cannot process your request.');
                redirect('resend_verification','refresh');
            }

        } else {
            redirect('/','refresh');
        }
    }

}

/* End of file Resend_verification.php */
/* Location: ./application/controllers/Resend_verification.php */