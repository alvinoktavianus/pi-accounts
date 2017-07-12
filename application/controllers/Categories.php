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

    public function do_add()
    {
        if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'admin') {
            $this->form_validation->set_rules('categoryName', 'Category Name', 'trim|required|min_length[5]|max_length[20]');
            if (!$this->form_validation->run()) {
                $errors = validation_errors();
                $this->session->set_flashdata('errors', $errors);
                redirect('categories','refresh');
            } else {
                $categoryName = $this->input->post('categoryName');
                $creatorId = $this->session->userdata('user_session')['userId'];
                $data = array(
                    'name' => $categoryName,
                    'created_by' => $creatorId
                );
                $this->category->insert_new_data($data);
                $this->session->set_flashdata('success', "Successfully insert new category");
                redirect('categories','refresh');
            }
        } else {
            redirect('home','refresh');
        }
    }

}

/* End of file Categories.php */
/* Location: ./application/controllers/Categories.php */