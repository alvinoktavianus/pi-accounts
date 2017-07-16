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
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[20]');
            $this->form_validation->set_rules('baseprice', 'Base Price', 'trim|required|integer');
            $this->form_validation->set_rules('sellprice', 'Sell Price', 'trim|required|greater_than[baseprice]|integer');
            $this->form_validation->set_rules('categories', 'Categories', 'required');

            if (!$this->form_validation->run()) {
                $errors = validation_errors();
                $this->session->set_flashdata('errors', $errors);
            } else {
                if ($_FILES['image']['name'] != "") {
                    $config['upload_path'] = './uploads/galleries/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['encrypt_name'] = true;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('image')) {
                        $data = $this->upload->data();
                    } else {
                        $this->session->set_flashdata('errors', $this->upload->display_errors());
                    }
                }
            }
            redirect('galleries','refresh');
        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Galleries.php */
/* Location: ./application/controllers/Galleries.php */