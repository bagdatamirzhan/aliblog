<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewsAdmin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('reviews_model');
    $this->load->model('shops_model');
  }

  public function index()
  {
    if ($this->session->userdata('userRole') == '2' || $this->session->userdata('userRole') == '3') {
      $data = $userData = array();
      $data['query'] = $this->reviews_model->get_user_items($this->session->userId);
      // $data['query'] = $this->shops_model->get_shops();
      $this->load->view('admin/elements/headerAdmin');
      $this->load->view('admin/reviews/reviews', $data);
      $this->load->view('admin/elements/footerAdmin');
    } else {
      redirect('users/account');
    }
  }

  public function add()
  {
    $data = $userData = array();
    if ($this->session->userdata('isUserLoggedIn')) {
      if ($this->input->post('addSubmit')) {
        $this->form_validation->set_rules('name', 'Title', 'required');
        $this->form_validation->set_rules('alias', 'Alias', 'required');
        $this->form_validation->set_rules('short_text', 'Short text', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        $this->form_validation->set_rules('category_id', 'Category ID', 'required');
        $this->form_validation->set_rules('shop_id', 'Shop ID', 'required');

        $userData = array(
          'name' => strip_tags($this->input->post('name')),
          'alias' => strip_tags($this->input->post('alias')),
          'short_text' => $this->input->post('short_text'),
          'price' => strip_tags($this->input->post('price')),
          'link' => strip_tags($this->input->post('link')),
          'category_id' => strip_tags($this->input->post('category_id')),
          'shop_id' => strip_tags($this->input->post('shop_id')),
          'user_id' => $this->session->userId
        );

        if ($this->form_validation->run() == true) {
          if ($insert = $this->reviews_model->add($userData)) {
            $insert_id = $this->db->insert_id();
            $this->session->set_userdata('success_msg', 'Ваш обзор успешно добавлен и отправлен на модерацию.');
            mkdir('./images/reviews/' . $insert_id, 0777, TRUE); // создаем папку для изображений
            redirect('keme/reviews/images/' . $insert_id); // редиректим на страницу изображений
          } else {
            $data['error_msg'] = 'Возникли проблемы, повторите попытку.';
          }
        } else {
          $data['error_msg'] = 'Пожалуйста, заполните все обязательные поля.';
        }
      }

      $data['user'] = $userData;
      $data['categories'] = $this->reviews_model->get_review_categories();
      $data['shops'] = $this->shops_model->get_shops();

      $this->load->view('admin/elements/headerAdmin', $data);
      $this->load->view('admin/reviews/add', $data);
      $this->load->view('admin/elements/footerAdmin');
    } else {
      redirect('users/login');
    }
  }

  public function edit($item_id)
  {
    $data = $userData = array();
    if ($this->session->userdata('isUserLoggedIn')) {
      if ($this->input->post('addSubmit')) {
        $this->form_validation->set_rules('name', 'Title', 'required');
        $this->form_validation->set_rules('alias', 'Alias', 'required');
        $this->form_validation->set_rules('short_text', 'Short text', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required');
        $this->form_validation->set_rules('category_id', 'Category ID', 'required');
        $this->form_validation->set_rules('shop_id', 'Shop ID', 'required');

        $userData = array(
          'name' => strip_tags($this->input->post('name')),
          'alias' => strip_tags($this->input->post('alias')),
          'short_text' => $this->input->post('short_text'),
          'price' => strip_tags($this->input->post('price')),
          'link' => strip_tags($this->input->post('link')),
          'category_id' => strip_tags($this->input->post('category_id')),
          'shop_id' => strip_tags($this->input->post('shop_id'))
        );

        if ($this->form_validation->run() == true) {
          $insert = $this->reviews_model->add($userData);
          if ($insert) {
            $this->session->set_userdata('success_msg', 'Ваш обзор успешно изменен и отправлен на модерацию.');
            redirect('reviews/add');
          } else {
            $data['error_msg'] = 'Возникли проблемы, повторите попытку.';
          }
        } else {
          $data['error_msg'] = 'Пожалуйста, заполните все обязательные поля.';
        }
      } else {
        $userData = $this->reviews_model->get_item_by_id($item_id);
      }

      $data['user'] = $userData;
      $data['categories'] = $this->reviews_model->get_review_categories();
      $data['shops'] = $this->shops_model->get_shops();

      $this->load->view('admin/elements/headerAdmin', $data);
      $this->load->view('admin/reviews/edit', $data);
      $this->load->view('admin/elements/footerAdmin');
    } else {
      redirect('users/login');
    }
  }

  public function images($item_id)
  {
    $path = './images/reviews/' . $item_id; // path to item folder

    if ($this->session->userdata('isUserLoggedIn')) {
      $data = $userData = array();
      if (!empty($_FILES['userfile'])) {
        $name_array = array();
        $count = count($_FILES['userfile']['size']);
        foreach ($_FILES as $key => $value)
          for ($s = 0; $s <= $count - 1; $s++) {
            $_FILES['userfile']['name'] = $value['name'][$s];
            $_FILES['userfile']['type'] = $value['type'][$s];
            $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
            $_FILES['userfile']['error']  = $value['error'][$s];
            $_FILES['userfile']['size'] = $value['size'][$s];
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']    = '0';
            $config['max_width']  = '0';
            $config['max_height']  = '0';
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
              $error = array('error' => $this->upload->display_errors());
              // print_r($error); //debug it here 
            } else {
              $data = array('upload_data' => $this->upload->data());
              // print_r($data);
            }
          }
      }
      if ((is_dir($path))) {
        $images = scandir($path);
        if ($images !== false) {
          $images = preg_grep("/\.(?:png|gif|jpe?g)$/i", $images);
          if (is_array($images)) {
            $data['images'] = $images;
          }
        }
      }
      $this->load->view('admin/elements/headerAdmin', $data);
      $this->load->view('admin/reviews/images', $data);
      $this->load->view('admin/elements/footerAdmin');
    } else {
      redirect('users/login');
    }
  }
}
