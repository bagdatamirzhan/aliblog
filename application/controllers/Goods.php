<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goods extends CI_Controller
{

  public function index()
  {
    $data['title'] = 'Товары месяца';

    $this->load->view('elements/header', $data);
    $this->load->view('goods/goods');
    $this->load->view('elements/footer');
  }
}
