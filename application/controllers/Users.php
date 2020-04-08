<?php defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('users_model');
  }

  public function index()
  {
    if ($this->session->userdata('isUserLoggedIn')) {
      redirect('users/account');
    } else {
      redirect('users/login');
    }
  }

  public function account()
  {
    $data = array();
    if ($this->session->userdata('isUserLoggedIn')) {
      $con = array(
        'id' => $this->session->userdata('userId')
      );
      $data['user'] = $this->users_model->getRows($con);

      $data['title'] = 'Профиль';
      // Pass the user data and load view 
      $this->load->view('elements/header', $data);
      $this->load->view('users/account', $data);
      $this->load->view('elements/footer');
    } else {
      redirect('users/login');
    }
  }

  public function login()
  {
    $data = array();

    // Get messages from the session 
    if ($this->session->userdata('success_msg')) {
      $data['success_msg'] = $this->session->userdata('success_msg');
      $this->session->unset_userdata('success_msg');
    }
    if ($this->session->userdata('error_msg')) {
      $data['error_msg'] = $this->session->userdata('error_msg');
      $this->session->unset_userdata('error_msg');
    }

    // If login request submitted 
    if ($this->input->post('loginSubmit')) {
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      $this->form_validation->set_rules('password', 'password', 'required');

      if ($this->form_validation->run() == true) {
        $con = array(
          'returnType' => 'single',
          'conditions' => array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'status' => 1
          )
        );
        $checkLogin = $this->users_model->getRows($con);
        if ($checkLogin) {
          $this->session->set_userdata('isUserLoggedIn', TRUE);
          $this->session->set_userdata('userId', $checkLogin['id']);
          $this->session->set_userdata('userName', $checkLogin['username']);
          $this->session->set_userdata('userStatus', $checkLogin['status']);
          $this->session->set_userdata('userRole', $checkLogin['role']);
          redirect('users/account');
        } else {
          $data['error_msg'] = 'Неправильный email или пароль, попробуйте еще раз.';
        }
      } else {
        $data['error_msg'] = 'Пожалуйста, заполните все обязательные поля.';
      }
    }

    $data['title'] = 'Авторизация';

    $this->load->view('elements/header', $data);
    $this->load->view('users/login', $data);
    $this->load->view('elements/footer');
  }

  public function registration()
  {
    $data = $userData = array();

    // If registration request is submitted 
    if ($this->input->post('signupSubmit')) {
      $this->form_validation->set_rules('username', 'First Name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
      $this->form_validation->set_rules('password', 'password', 'required');
      $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

      $userData = array(
        'username' => strip_tags($this->input->post('username')),
        'email' => strip_tags($this->input->post('email')),
        'password' => md5($this->input->post('password')),
        'status' => 1
      );

      if ($this->form_validation->run() == true) {
        $insert = $this->users_model->insert($userData);
        if ($insert) {
          $this->session->set_userdata('success_msg', 'Регистрация вашего аккаунта прошла успешно. Теперь вы можете войти в свой аккаунт.');
          redirect('users/login');
        } else {
          $data['error_msg'] = 'Возникли проблемы, повторите попытку.';
        }
      } else {
        $data['error_msg'] = 'Пожалуйста, заполните все обязательные поля.';
      }
    }

    // Posted data 
    $data['user'] = $userData;
    $data['title'] = 'Регистрация';

    $this->load->view('elements/header', $data);
    $this->load->view('users/registration', $data);
    $this->load->view('elements/footer');
  }

  public function logout()
  {
    $this->session->unset_userdata('isUserLoggedIn');
    $this->session->unset_userdata('userId');
    $this->session->sess_destroy();
    redirect('users/login');
  }


  // Existing email check during validation 
  public function email_check($str)
  {
    $con = array(
      'returnType' => 'count',
      'conditions' => array(
        'email' => $str
      )
    );
    $checkEmail = $this->users_model->getRows($con);
    if ($checkEmail > 0) {
      $this->form_validation->set_message('email_check', 'Данный email уже зарегистрирован.');
      return FALSE;
    } else {
      return TRUE;
    }
  }
}
