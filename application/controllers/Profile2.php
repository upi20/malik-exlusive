<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Profile extends Render_Controller {
	
	public function index() {
		$this->title = 'Profile';
		$this->content = 'profile';
		$this->navigation = ['Profile'];
		$this->plugins = ['chart'];
		$this->data['menu_home'] = FALSE;
		$this->render();
	}


	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->model('dashboardModel','model');
		$this->load->library('plugin');
		$this->load->helper('url');
		// cek session
		$this->sesion->cek_session();
	}
}