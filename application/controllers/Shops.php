<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shops extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('shops_model');
  }

  public function index()
  {
    $data['title'] = 'Каталог магазинов';
    $data['query'] = $this->shops_model->get_shops();

    $this->load->view('elements/header', $data);
    $this->load->view('shops/shops', $data);
    $this->load->view('elements/footer');
  }

  public function items($shop_alias)
  {
    $this->load->library('pagination');
    $config['base_url'] = base_url() . 'shops/' . $shop_alias . '/page';
    $config['total_rows'] = $this->shops_model->get_count_shop_items($shop_alias);
    $config['first_url'] = base_url() . 'shops/' . $shop_alias;
    $config['uri_segment'] = 4;
    $config['per_page'] = 12;
    $config['num_links'] = 5;
    $config['attributes'] = array('class' => 'page-link');
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="'.current_url().'">';
    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $this->pagination->initialize($config);

    $page = $config['per_page']; // how many number of records on page
    $segment = $this->uri->segment(4); // from which index I have to count $page number of records

    $data['title'] = $this->shops_model->get_shop_name_by_alias($shop_alias) . ' | Обзоры и отзывы товаров интернет-магазина';
    $data['pagination'] = $this->pagination->create_links();
    $data['query'] = $this->shops_model->get_shop_items_by_alias($shop_alias, $page, $segment);

    $this->load->view('elements/header', $data);
    $this->load->view('shops/items', $data);
    $this->load->view('elements/footer');
  }
}
