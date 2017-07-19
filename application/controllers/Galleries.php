<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category');
        $this->load->model('gallery');
        $this->load->model('image');
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
                $category = $this->input->get('category');
                $galleries = isset($category) ? $this->gallery->get_all_active_galleries_where($category) : $this->gallery->get_all_active_galleries();
                $selectedCategory = isset($category) ? $this->input->get('category') : 0;
                $viewData = array(
                    'galleries' => $galleries,
                    'categories' => $this->category->create_category_dropdown(),
                    'selectedCategory' => $selectedCategory
                );
                break;
            default:
                $viewData = array(
                    'galleries' => $this->gallery->get_all_active_galleris_with_limit()
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
            $this->form_validation->set_rules('baseprice', 'Base Price', 'trim|required');
            $this->form_validation->set_rules('sellprice', 'Sell Price', 'trim|required');
            $this->form_validation->set_rules('categories', 'Categories', 'required');

            $baseprice = (int)str_replace(' ', '', $this->input->post('baseprice'));
            $sellprice = (int)str_replace(' ', '', $this->input->post('sellprice'));

            if (!$this->form_validation->run()) {
                $errors = validation_errors();
                $this->session->set_flashdata('errors', $errors);
            } else if ($sellprice < $baseprice) {
                $errors = "The Sell Price field must contain a number greater than Base Price.";
                $this->session->set_flashdata('errors', $errors);
            } else {
                $dataImages = null;
                if (strlen($_FILES['image']['name']) > 0) {
                    $config['upload_path'] = './uploads/galleries/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['encrypt_name'] = true;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('image')) {
                        $dataImages = $this->upload->data();
                    } else {
                        $this->session->set_flashdata('errors', $this->upload->display_errors());
                    }
                    $this->db->trans_start();
                    $dataInserted = array(
                        'name' => $this->input->post('name'),
                        'base_price' => $baseprice,
                        'sell_price' => $sellprice,
                        'category_id' => $this->input->post('categories'),
                        'created_by' => $this->session->userdata('user_session')['userId'],
                        'updated_by' => $this->session->userdata('user_session')['userId'],
                    );
                    $this->gallery->insert_new_gallery($dataInserted);
                    $latestGalleryId = $this->gallery->get_latest_galleries()->id;
                    $dataimages = array(
                        'file_name' => $dataImages['file_name'],
                        'gallery_id' => $latestGalleryId,
                        'is_primary' => 1,
                        'created_by' => $this->session->userdata('user_session')['userId'],
                        'updated_by' => $this->session->userdata('user_session')['userId'],
                    );
                    $this->image->insert_new_image($dataimages);
                    $this->db->trans_complete();
                    $this->session->set_flashdata('success', "Successfully insert new gallery image");
                } else {
                    $errors = "Please upload image";
                    $this->session->set_flashdata('errors', $errors);
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