
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting {

	public function index() {
		$return = array(
			'app_title' => 'Toko Bangunan - Aplikasi',
			'app_name'	=> 'Toko Bangunan'
		);
		return $return;	
	}

}
