<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        if (!$this->session->userdata('user_session')) {
            redirect('login','refresh');
        } else {
            $data = array(
                'pageKey' => 'home',
                'title' => 'Home | Pro Importir',
                'pageTitle' => 'Dashboard',
            );
            $this->load->view('main-logged-in', $data);
        }
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */