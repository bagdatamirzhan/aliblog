<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reviews_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();

    // Set table name 
    $this->reviews_items = 'review_items';
  }

  public function get_last_reviews()
  {
    // $items = $this->db->get_where('review_items', array('status' => 0), 6, 0);
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
      ->where('status', 0)
      ->join('review_categories', 'review_categories.id = review_items.category_id')
      ->join('review_shops', 'review_shops.id = review_items.shop_id')
      ->limit(6, 0);
    $items = $this->db->get();
    if (isset($items)) {
      return $items->result();
    } else {
      show_404();
    }
  }

  public function get_review_categories()
  {

    $this->db->select('*');
    $this->db->from('review_categories');
    $this->db->where('parent_id', NULL);

    $parent = $this->db->get();

    $categories = $parent->result();
    $i = 0;
    foreach ($categories as $p_cat) {

      $categories[$i]->sub = $this->sub_categories($p_cat->id);
      $i++;
    }
    return $categories;
  }

  public function sub_categories($parent_id)
  {

    $this->db->select('*');
    $this->db->from('review_categories');
    $this->db->where('parent_id', $parent_id);

    $child = $this->db->get();
    $categories = $child->result();
    $i = 0;
    foreach ($categories as $p_cat) {
      $categories[$i]->sub = $this->sub_categories($p_cat->id);
      $i++;
    }
    return $categories;
  }

  public function get_category_items($category_alias, $page, $segment)
  {

    $categories = $this->db->get_where('review_categories', array('alias' => $category_alias), 1, 0);

    if (isset($categories->first_row()->id)) {
      $category_id = $categories->first_row()->id;
      if ($category_id <= 15) {
        $categories = $this->get_categoryId_by_parentId($category_id);
        // $category_id = array();
        $child_id = array();
        foreach ($categories as $category) {
          $child_id[] = $category['id'];
        }
        $category_id = $child_id;
        // return print($category_id);
      } else {
        $category_id = array($category_id);
      }
    }

    if (isset($category_id)) {
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
        ->where_in('category_id', $category_id)
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

  public function get_item($category_alias, $item_alias)
  {

    $categories = $this->db->get_where('review_categories', array(
      'alias' => $category_alias
    ), 1, 0);

    if (isset($categories->first_row()->id)) {
      $category_id = $categories->first_row()->id;
    }

    if (isset($category_id)) {
      $item = $this->db->get_where('review_items', array('alias' => $item_alias, 'category_id' => $category_id), 1, 0);
      return $item->row_array();
    } else {
      show_404();
    }
  }

  public function get_categoryId_by_parentId($parent_id)
  {
    $categories = $this->db->get_where('review_categories', array(
      'parent_id' => $parent_id
    ));

    if (isset($categories->first_row()->id)) {
      return $categories->result_array();
    } else {
      show_404();
    }
  }

  public function get_category_id_by_alias($category_alias)
  {
    $categories = $this->db->get_where('review_categories', array(
      'alias' => $category_alias
    ), 1, 0);

    if (isset($categories->first_row()->id)) {
      return $categories->first_row()->id;
    } else {
      show_404();
    }
  }

  public function get_category_name_by_alias($category_alias)
  {
    $categories = $this->db->get_where('review_categories', array(
      'alias' => $category_alias
    ), 1, 0);

    if (isset($categories->first_row()->name)) {
      return $categories->first_row()->name;
    } else {
      show_404();
    }
  }

  public function get_count_category_items($category_alias)
  {
    $categories = $this->db->get_where('review_categories', array(
      'alias' => $category_alias
    ), 1, 0);

    if (isset($categories->first_row()->id)) {
      $category_id =  $categories->first_row()->id;
      if ($category_id <= 15) {
        $categories = $this->get_categoryId_by_parentId($category_id);
        // $category_id = array();
        $child_id = array();
        foreach ($categories as $category) {
          $child_id[] = $category['id'];
        }
        $category_id = $child_id;
        // return print($category_id);
      } else {
        $category_id = array($category_id);
      }
      $this->db->select('*')
        ->from('review_items')
        ->where_in('category_id', $category_id)
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

  public function get_item_by_id($id)
  {
    $item = $this->db->get_where('review_items', array('id' => $id), 1, 0);

    return $item->row_array();
  }

  public function get_user_items($user_id)
  {
    //$items = $this->db->get_where('review_items', array('user_id' => $user_id), 10, 0);
    $this->db->select('
      review_items.*, 
      review_categories.id AS category_id,  
      review_categories.name AS category_name,
      review_categories.alias AS category_alias
    ')
      ->from('review_items')
      ->where('user_id', $user_id)
      ->join('review_categories', 'review_categories.id = review_items.category_id');
    $items = $this->db->get();

    return $items->result();
  }

  public function add($data = array())
  {
    if (!empty($data)) {
      // Add created and modified date if not included 
      if (!array_key_exists("created_date", $data)) {
        $data['created_date'] = date("Y-m-d H:i:s");
      }

      // Insert member data 
      $insert = $this->db->insert($this->reviews_items, $data);

      // Return the status 
      return $insert ? $this->db->insert_id() : false;
    }
    return false;
  }
}
