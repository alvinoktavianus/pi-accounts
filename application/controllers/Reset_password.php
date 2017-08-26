<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    public function index()
    {
        $token = $this->input->get('reset_token');
        if (!$this->session->userdata('user_session') && isset($token)) {
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

    public function update()
    {
        $token = $this->input->get('reset_token');
        if (!$this->session->userdata('user_session') && isset($token)) {
            $userData = $this->user->find_by_reset_token($token);

            if (count($userData) == 1 && $userData[0]->is_confirmed == 0) {

                $updated = array(
                    'password' => password_hash($this->input->post('new-password'), PASSWORD_BCRYPT),
                    'reset_token' => null,
                );
                $this->db->trans_start();
                $this->user->update_by_id($userData[0]->id, $updated);
                $this->db->trans_complete();

            } else if (count($userData) == 1 && $userData[0]->is_confirmed == 1) {
                $error = "Something wrong with your request.";
                $this->session->set_flashdata('errors', $error);
                redirect('login','refresh');
            }
            
        }
    }

}

/* End of file Reset_password.php */
/* Location: ./application/controllers/Reset_password.php */