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

    public function upload_images()
    {
        if ($this->session->userdata('user_session')['role'] == 'admin') {
            
        } else {
            
        }
    }

    public function do_add()
    {
        if ($this->session->userdata('user_session')['role'] == 'admin') {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[20]');
            $this->form_validation->set_rules('baseprice', 'Base Price', 'trim|required');
            $this->form_validation->set_rules('sellprice', 'Sell Price', 'trim|required');
            $this->form_validation->set_rules('categories', 'Categories', 'required');

            // var_dump($this->form_validation->run());
            // exit();

            if (!$this->form_validation->run()) {
                $errors = validation_errors();
                $this->session->set_flashdata('errors', $errors);
            } else {
                $config['upload_path'] = './uploads/galleries/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['encrypt_name'] = true;
                
                $this->load->library('upload');
                
                $files = $_FILES;
                for ($i=0; $i<count($_FILES['images']['name']); $i++) {
                    $_FILES['images']['name']= $files['images']['name'][$i];
                    $_FILES['images']['type']= $files['images']['type'][$i];
                    $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
                    $_FILES['images']['error']= $files['images']['error'][$i];
                    $_FILES['images']['size']= $files['images']['size'][$i];

                    $this->upload->initialize($config);
                    $this->upload->do_upload();
                }
            }

            redirect('galleries','refresh');

            // var_dump($_FILES['images']['name']);
            // var_dump($this->input->post('isPrimary'));
        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Galleries.php */
/* Location: ./application/controllers/Galleries.php */