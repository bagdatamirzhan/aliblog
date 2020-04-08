<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardAdmin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    if ($this->session->userdata('userRole') == '2' || $this->session->userdata('userRole') == '3') {
      $data = $userData = array();
      // $data['query'] = $this->shops_model->get_shops();
      $this->load->view('admin/elements/headerAdmin');
      $this->load->view('admin/dashboardAdmin', $data);
      $this->load->view('admin/elements/footerAdmin');
    } else {
      redirect('users/account');
    }
  }
}
