<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Data extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Profile';
		$this->content = 'profile-data'; 
		$this->plugins = ['datatables','formatrupiah'];
		$this->navigation = ['Profile'];
		// Commit render:
		$get = $this->db->where('user_id', $this->id)->get('users')->row_array();
		$this->data['profile'] = $get;
		$this->render();
	}

	public function ubah(){
		$data['user_email'] = $this->input->post('email');
		$data['user_name'] = $this->input->post('nama');
		$data['user_phone'] = $this->input->post('no_hp');
		$data['user_address'] = $this->input->post('alamat');

		$password = $this->input->post('password');
		$password_baru = $this->input->post('password_baru');

		if($password != null){
			if($password == $password_baru){
				$data['user_password'] = $this->b_password->create_hash($password);
			}else{
				echo "<script>alert('Mohon maaf, password tidak sama')</script>";
				redirect('profile/data', 'refresh');
			}
		}

		$this->db->where('user_id', $this->id);
		$this->db->update('users', $data);
		echo "<script>alert('Profile berhasil diubah')</script>";
		redirect('profile/data', 'refresh');
	}


	private function output_json($data) {
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		// cek session
		$this->sesion->cek_session();
		$this->id = $this->session->userdata('data')['id'];
	}
}