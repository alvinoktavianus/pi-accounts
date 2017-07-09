<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public function index()
    {
        $this->load->view('migration');

    }

    public function confirm()
    {
        $this->db->trans_start();
        $where = array(
            'email' => $this->input->post('email')
        );
        $result = $this->db->get_where('users', $where)->result();
        $this->db->trans_complete();
        if (count($result) > 0 &&
            password_verify($this->input->post('password'), $result[0]->password) &&
            password_verify($this->input->post('authcode'), $this->input->server('ROOT_AUTH')) &&
            password_verify($result[0]->role, $this->input->server('ROOT_ROLE'))) {
            if (!$this->migration->current()) {
                show_error($this->migration->error_string());
            } else {
                echo 'Migrations ran successfully!';
            }
        } else {
            echo "You are not authorize to do this operation!";
        }
    }

}

/* End of file Migrate.php */
/* Location: ./application/controllers/Migrate.php */