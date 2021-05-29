

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loaddb {

	function simpeg(){
		$this->CI = &get_instance();
		// $simpeg = 'mysqli://root:@43.249.140.89/simpeg';
		$simpeg = 'mysqli://root:@localhost/simpeg';
		$this->simpeg = $this->CI->load->database($simpeg, true);
		return $this->simpeg;
	}
}