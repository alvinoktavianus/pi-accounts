<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries extends CI_Controller {

    public function index()
    {
        switch ($this->session->userdata('user_session')['role']) {
            case 'admin':
                $viewData = array(
                    'message' => 'Hello admin galleries'
                );
                break;
            case 'user':
                $viewData = array(
                    'message' => 'Hello user galleries'
                );
                break;
            default:
                $viewData = array(
                    'message' => 'Hello guest galleries'
                );
                break;
        }
        $data = array(
            'title' => 'Galleries | Pro Importir',
            'pageKey' => 'gallery',
            'viewData' => $viewData
        );
        $this->load->view('main', $data);
    }

}

/* End of file Galleries.php */
/* Location: ./application/controllers/Galleries.php */