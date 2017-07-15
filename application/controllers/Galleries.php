<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category');
    }

    public function index()
    {
        switch ($this->session->userdata('user_session')['role']) {
            case 'admin':
                $viewData = array(
                    'message' => 'Hello admin galleries',
                    'categories' => $this->category->create_category_dropdown()
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

    public function do_add()
    {
        if ($this->session->userdata('user_session')['role'] == 'admin') {
            
        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Galleries.php */
/* Location: ./application/controllers/Galleries.php */