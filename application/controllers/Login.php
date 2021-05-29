<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Login extends Render_Controller {

	public function index() {
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		// Page Settings
		$this->title = 'Login';
		$this->content = 'login';
		$this->navigation = [];
		$this->render();
	}

	public function doLogin(){
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		$email 		= $this->input->post('email');
		$password = $this->input->post('password');
		$login 		= $this->model->cekLogin($email,$password);

		if($login['status'] == 0){
			$session = array(
				'status' => true,
				'data'	 => array('id' => $login['data'][0]['user_id'],'nama' => $login['data'][0]['user_name'],'email' => $login['data'][0]['user_email'], 'level' => $login['data'][0]['lev_nama'])
			);
			$this->session->set_userdata($session);

			redirect('dashboard','refresh');
		}else{
			echo "<script>alert('Login gagal. email atau password')</script>";
			redirect('login','refresh');
		}
	}

	public function logout(){
		$session = array('status','data');
		$this->session->unset_userdata($session);
		redirect('login','refresh');
	}

	public function daftar() {
		// Page Settings
		$this->title = 'Daftar';
		$this->content = 'daftar';
		$this->navigation = [];
		$this->render();
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/login';
		$this->load->model('loginModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');

		$this->load->library('b_password');

	}
}