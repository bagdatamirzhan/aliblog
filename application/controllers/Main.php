<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('reviews_model');
  }

  public function index()
  {
    $data['title'] = 'Обзоры товаров из интернет-магазинов';
    $data['query'] = $this->reviews_model->get_last_reviews();
    
    $this->load->view('elements/header', $data);
    $this->load->view('main/main', $data);
    $this->load->view('elements/footer');
  }

  public function external($url)
  {
    if ($url) {
      header('Location: ' . $url);
    }
  }
}
