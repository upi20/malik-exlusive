<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class lupaPassword extends Render_Controller {

	public function index() {
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		// Page Settings
		$this->title = 'Lupa Password';
		$this->content = 'lupaPassword';
		$this->navigation = [];
		$this->render();
	}

	public function reset(){
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		$email 		= $this->input->post('email');
		$cek 			= $this->model->cekAkun($email);
		if($cek['status'] == 0){
			$this->load->library('Send_email');
			$email = "berkahnesia@gmail.com";
			$send = $this->send_email->send($email,$cek['password']);
			// if($send){
			// 	$upd['user_password'] = $cek['encrypt_password'];
			// 	$this->db->where('user_email',$email);
			// 	$this->db->update('users',$upd);
			// }
			redirect('login','refresh');
		}else{
			echo "<script>alert('Email atau Nip tidak ditemukan')</script>";
			redirect('lupaPassword','refresh');
		}
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/lupaPassword';
		$this->load->model('loginModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');

		$this->load->library('b_password');
		
	}
}