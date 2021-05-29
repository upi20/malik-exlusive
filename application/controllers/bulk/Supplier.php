<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Supplier extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Bulk - Supplier';
        $this->content = 'bulk-supplier'; 			
		$this->plugins = ['datatables'];
		$this->navigation = ['Bulk'];
		// Commit render:
		$this->render();
	}

  public function upload(){
    ini_set('max_execution_time', 900);
    set_time_limit(900);
		$filename=$_FILES["file"]["tmp_name"];		 
		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
		  	$no=0;
		  	$cek_jumlah = 0;
	        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
	        {
						if($no>0){
							$cek_nama = $this->db->get_where('supplier', array('supp_nama' => $getData[0]))->num_rows();
							$cek_jumlah = 1;
							if($cek_nama > 0){
			          
							}else{
			          $data['supp_nama'] = $getData[0];
			          $exe1 = $this->db->insert('supplier', $data);
							}
						}
						$no=$no+1;
        	}
        	
        	if($cek_jumlah == 0){
        		while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
		        {
							$no=$no+1;
	        	}
        	}

       		echo"<script>alert('Import data produk berhasil disimpan')</script>";
       		redirect('referensi/supplier','refresh');
       	
        	fclose($file);	
		}
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('produk_model', 'produk');
		$this->level = $this->session->userdata('data')['level'];
		// cek session
		$this->sesion->cek_session();
	}
	public function export_excel(){
	 	$data = array( 
	 		'title' => 'produk',
	 		'list' => $this->db->join('blok c','c.blok_id = a.prod_blok_id','left')->join('rumah b','b.ruma_id = a.prod_ruma_id','left')->get('produk a')->result_array()
	 	);
	 	$this->load->view('templates/cetak/data_sapi',$data);
	}
}