<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shops_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }
  
  public function get_shops()
  {

    $shops = $this->db->get('review_shops');

    return $shops->result();
  }

  public function get_shop_items_by_alias($shop_alias, $page, $segment)
  {

    $shops = $this->db->get_where('review_shops', array('alias' => $shop_alias), 1, 0);

    if (isset($shops->first_row()->id)) {
      $shop_id = $shops->first_row()->id;
    } else {
      show_404();
    }

    if (isset($shop_id)) {
      //$items = $this->db->get_where('review_items', array('category_id' => $category_id), 10, 0);

      $this->db->select('
        review_items.*, 
        review_categories.id AS category_id,  
        review_categories.name AS category_name,
        review_categories.alias AS category_alias,
        review_shops.id AS shop_id,
        review_shops.name AS shop_name,
        review_shops.alias AS shop_alias
      ')
        ->from('review_items')
        ->where('shop_id', $shop_id)
        ->join('review_categories', 'review_categories.id = review_items.category_id')
        ->join('review_shops', 'review_shops.id = review_items.shop_id')
        ->limit($page, $segment);
      $items = $this->db->get();

      // $str = $this->db->last_query();

      // echo "<pre>";
      // print_r($str);

      return $items->result();
    } else {
      show_404();
    }
  }

  public function get_shop_name_by_alias($shop_alias)
  {
    $shops = $this->db->get_where('review_shops', array(
      'alias' => $shop_alias
    ), 1, 0);

    if (isset($shops->first_row()->name)) {
      return $shops->first_row()->name;
    } else {
      show_404();
    }
  }

  public function get_count_shop_items($shop_alias)
  {
    $shops = $this->db->get_where('review_shops', array(
      'alias' => $shop_alias
    ), 1, 0);

    if (isset($shops->first_row()->id)) {
      $shop_id =  $shops->first_row()->id;
      $this->db->select('*')
        ->from('review_items')
        ->where_in('shop_id', $shop_id)
        ->where('status', 0);
      $count = $this->db->get()->num_rows();
      // $count = $this->db->get_where('review_items', array(
      //   'category_id' => $category_id,
      //   'status' => 0 //временно
      //   ))->num_rows();
      return $count;
    } else {
      show_404();
    }
  }
}
