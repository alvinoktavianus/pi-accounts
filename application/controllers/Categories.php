<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function index()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $data = array(
                'pageKey' => 'category',
                'title' => 'Categories | Pro Importir'
            );
            $this->load->view('main', $data);
        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Categories.php */
/* Location: ./application/controllers/Categories.php */