<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Reduction extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('reduction_model');
  }

  public function index()
  {
    $data['captcha'] = $this->reduction_model->get_ssid();
    // $data['captcha'] = $response->errors['0']->captcha->captcha->site_key;

    $this->load->view('reduction/reduction', $data);
  }

}
