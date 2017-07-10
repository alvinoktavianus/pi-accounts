<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        if (!$this->session->userdata('user_session')) {
            $data = array(
                'title' => 'Login | PRO Importir',
                'pageKey' => 'login'
            );
            $this->load->view('main', $data);
        }
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */