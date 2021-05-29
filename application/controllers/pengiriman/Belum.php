<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Belum extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Pengiriman - Belum';
		$this->content = 'pengiriman-belum'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Pengiriman'];
		// Commit render:
		$this->render();
	}

	public function cetak(){	
			$this->title = 'Laporan';
			$this->content = 'cetak-pengiriman-berangkat';
			$this->plugins = [];
			$this->navigation = ['cetak-pengiriman-kebakaran'];
			// $this->render();
			$this->load->view('templates/contents/cetak-pengiriman-berangkat');
	}

	public function cetak_do($id)
 {

		$this_data['produk'] = $this->CetakDo_model->get_produk($id);
		$this_data['lapor'] = $this->CetakDo_model->getLapor($id);
		$this_data['lapor_detail'] = $this->CetakDo_model->getLaporDetail($id);
		$array1 = $this->db->query("select  a.*, u.*,k.*
			from penjualan_detail a,produk u,kelas k
			where a.pede_prod_id = u.prod_id
			and u.prod_kela_id = k.kela_id
			and pede_id = '".$id."'")->result_array(); // mysql
		// var_dump($this_data['lapor_detail']);
		// exit();

			//var_dump($this_data['lapor_detail']);die();

			$result_array = array();
			foreach($array1 as $mysql) {
			    {
					$result_array[]= array($mysql);
			   }
			}
			$this_data['records'] = $result_array;
			  $a = $this_data['lapor_detail'];
			  if (empty($a)){
						echo "<script>alert('Data Investigasi Masih Belum Diisi');window.location.href='javascript:history.back(-1);'</script>";
					}
					else{
						$this_data['lapor']['created_date'];


						$user =  $this->db->get_where('penjualan')->row_array();
						$this_data['data'] = $user;
						$this_data['nama_distribusi'] = "Ihsan Abdi Putra";
						$this->title = 'Laporan';
						$this->content = 'cetak-laporan-do';
						$this->plugins = [];
						// $this->navigation = ['cetak-laporan-do'];
						$this->load->view('templates/contents/cetak-laporan-do', $this_data);
						// exit();
						// $this->render();

					}
    }

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		if(isset($cari['value'])){
			$_cari = $cari['value'];
		}else{
			$_cari = null;
		}
		$data 	= $this->pengiriman->getAlldata($length, $start, $_cari)->result_array();
		$count 	= $this->pengiriman->getAlldata(null,null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function detail($id)
	{
		$exe 	= $this->pengiriman->getDetail($id)->result_array();

		echo json_encode($exe);
	}

	public function berangkat()
	{
		$penj_id 	= $this->input->post('penj_id');
		// $pede_id 	= $this->input->post('pede_id');
		$total_harga= $this->input->post('total_harga');
		$dibayar	= $this->input->post('dibayar');
		$sisa		= $this->input->post('sisa');

		$exe 		= $this->pengiriman->Berangkat($penj_id, $total_harga, $dibayar, $sisa);

		if($exe !== FALSE) {

			$this->output_json(
				[
					'id' => true,
				]
			);
		}
	}

	public function batal($id){
		$upd['penj_status_pengiriman'] = '';
		$this->db->where('penj_id', $id);
		$this->db->update('penjualan', $upd);

		$this->db->where('pman_penj_id', $id);
		$this->db->delete('pengiriman');
		echo "<script>alert('Berhasil')</script>";
		redirect('pengiriman/belum','refresh');
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
		// $this->load->library('Pdf');
   		// $this->load->model('pengiriman/CetakDo_model');
		$this->load->model('pengiriman/belum_model', 'pengiriman');
		// cek session
		$this->sesion->cek_session();
	}
}