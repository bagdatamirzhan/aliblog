<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reviews extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('reviews_model');
  }

  public function index()
  {
    $data['title'] = 'Каталог обзоров';
    $data['query'] = $this->reviews_model->get_review_categories();
    $this->load->view('elements/header', $data);
    $this->load->view('reviews/reviews', $data);
    $this->load->view('elements/footer');
  }

  public function category($category_alias)
  {
    $this->load->library('pagination');
    $config['base_url'] = base_url() . 'reviews/' . $category_alias . '/page';
    $config['total_rows'] = $this->reviews_model->get_count_category_items($category_alias);
    $config['first_url'] = base_url() . 'reviews/' . $category_alias;
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

    $data['pagination'] = $this->pagination->create_links();
    $data['query'] = $this->reviews_model->get_category_items($category_alias, $page, $segment);
    $data['title'] = $this->reviews_model->get_category_name_by_alias($category_alias) . ' | Обзоры товаров, отзывы покупателей';

    $this->load->view('elements/header', $data);
    $this->load->view('reviews/category', $data);
    $this->load->view('elements/footer');
  }

  public function item($category_alias, $item_alias)
  {
    $data = array();
    $data['item'] = $this->reviews_model->get_item($category_alias, $item_alias);
    $data['title'] = $data['item']['name'] . ' | Обзор, отзывы покупателей';

    $this->load->view('elements/header', $data);
    $this->load->view('reviews/item', $data);
    $this->load->view('elements/footer');
  }
}
