<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class CetakFaktur extends Render_Controller {

	public function index() {

			$this->data['lapor'] = $this->CetakFaktur_model->get_lapor();
			$this->title = 'Laporan';
			$this->content = 'cetak-laporan-faktur';
			$this->plugins = [];
			$this->navigation = ['cetak-laporan-faktur'];

			//var_dump($data['produk']);
			//exit();
			// Commit render:
			$this->render();
	}

	public function cetak_faktur($id){

		$this->data['produk'] = $this->CetakFaktur_model->get_produk($id);
		$this->data['lapor'] = $this->CetakFaktur_model->getLapor($id);
		$this->data['lapor_detail'] = $this->CetakFaktur_model->getLaporDetail($id);
		$array1 = $this->db->query("select  a.*, u.*,k.*
				from penjualan_detail a,produk u,kategori k
				where a.pede_prod_id = u.prod_id
				and u.prod_kate_id = k.kate_id
				and pede_penj_id = '".$id."'")->result_array(); // mysql

		$result_array = array();
		foreach($array1 as $mysql) {
		  {
				$result_array[]= array($mysql);
		  }
		}
		$data['records'] = $result_array;

    $a = $this->data['lapor'];

  	if (empty($a)){
			echo "<script>alert('Data Masih Belum Diisi');window.location.href='javascript:history.back(-1);'</script>";
		}else{

			$this->data['lapor']['created_date'];
			$user =  $this->db->get_where('penjualan')->row_array();
			$this->data['data'] = $user;
			$this->title = 'Laporan';
			$this->content = 'cetak-penjualan';
			$this->plugins = [];
			$this->navigation = ['cetak-laporan-faktur'];
			$this->render();
		}
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
		$this->load->library('Pdf');
    $this->load->model('laporan/CetakFaktur_model');

	}
}
