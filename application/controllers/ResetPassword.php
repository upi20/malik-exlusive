<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class ResetPassword extends Render_Controller {

	public function index() {
		if($this->session->userdata('status') == true){
			redirect('dashboard','refresh');
		}
		$data['kode'] = $this->input->get('kode');
		$get = $this->db->get_where('reset_password', array('kode' => $data['kode']))->row_array();
		$data['email'] = $get['email'];	
		$this->load->view('templates/contents/reset-password',$data);
	}

	public function reset($key){
		$kode 		= $key;
		$email 		= $this->input->post('email');
		$password 		= $this->input->post('password');
		$cek = $this->db->get_where('reset_password', array('kode' => $kode, 'email' => $email))->num_rows();
		if($cek > 0){
			$upd['user_password'] = $this->b_password->create_hash($password);
			$this->db->where('user_email',$email);
			$exe = $this->db->update('users',$upd);
			if($exe){
				echo "<script>alert('Password berhasil diubah')</script>";
			}else{
				echo "<script>alert('Password gagal diubah')</script>";
			}
			redirect('login','refresh');
		}else{
			echo "<script>alert('Password gagal diubah')</script>";
			redirect('login','refresh');
		}
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/login';
		$this->load->model('loginModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');

		$this->load->library('b_password');
		// $insert['user_nip'] 			= '1234567890';
		// $insert['user_email']			= 'soni.setiawan.it07@gmail.com';
		// $insert['user_password']	= $this->b_password->create_hash('sonisetiawan');
		// $insert['user_nama']			= 'Soni Setiawan';
		// $insert['user_photo']			= 'soni.jpg';

		// $exe = $this->db->insert('users',$insert);
		// var_dump($exe);
		// exit();

	}
}