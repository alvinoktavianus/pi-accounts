<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    public function get_all_users()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $this->output->set_content_type('application/json')->set_output(json_encode($this->user->get_all_users()));
        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */