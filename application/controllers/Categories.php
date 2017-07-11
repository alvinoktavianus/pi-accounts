<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category');
    }

    public function index()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $categories = $this->category->find_all_if_active();
            $viewData = array(
                'categories' => $categories
            );
            $data = array(
                'pageKey' => 'category',
                'title' => 'Categories | Pro Importir',
                'viewData' => $viewData
            );
            $this->load->view('main', $data);
        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Categories.php */
/* Location: ./application/controllers/Categories.php */