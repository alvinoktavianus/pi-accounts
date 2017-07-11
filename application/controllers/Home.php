<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        if (!$this->session->userdata('user_session')) {
            redirect('login','refresh');
        } else {
            
        }
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */