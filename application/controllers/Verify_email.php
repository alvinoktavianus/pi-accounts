<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify_email extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    public function index()
    {
        $token = $this->input->get('verify_token');
        if (!$this->session->userdata('user_session') && isset($token)) {
            $userData = $this->user->find_by_verify_token($token);

            if (count($userData) == 1 && $userData[0]->is_confirmed == 0) {

                $updated = array(
                    'is_confirmed' => 1,
                    'verify_token' => null
                );
                $this->db->trans_start();
                $this->user->update_by_id($userData[0]->id, $updated);
                $this->db->trans_complete();

                $this->session->set_flashdata('success', 'Successfully verified your account.');

            } else if (count($userData) == 1 && $userData[0]->is_confirmed == 1) {
                $error = "You already verified your email";
                $this->session->set_flashdata('errors', $error);
            }
            
            redirect('login','refresh');
        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Verify_email.php */
/* Location: ./application/controllers/Verify_email.php */