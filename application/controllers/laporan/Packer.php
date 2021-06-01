<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Packer extends Render_Controller
{

	public function index()
	{
		// Page config:
		$this->title = 'Laporan Packer';
		$this->data['packer'] = $this->db->get('packer')->result_array();
		$this->data['total_resi'] = $this->db->get_where('penjualan a')->num_rows();

		$this->content = 'laporan-packer';
		$this->plugins 			= ['datatables', 'datetimepicker'];
		$this->navigation 		= ['Laporan', 'Packer   '];
		$this->data['level'] 	= $this->session->userdata('data')['level'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');

		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}
		$filter_tanggal_mulai = $this->input->post('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->input->post('filter_tanggal_akhir');
		$filter_packer = $this->input->post('filter_packer');

		$data 	= $this->packer->getAllData($length, $start, $_cari, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_packer)->result_array();
		$count 	= $this->packer->getAllData(null, null, $_cari, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_packer)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
	}

	public function export_excel()
	{
		$start 	= $this->input->get('start');
		$draw 	= $this->input->get('draw');
		$length = $this->input->get('length');
		$cari 	= $this->input->get('search');

		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}
		$filter_tanggal_mulai = $this->input->get('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->input->get('filter_tanggal_akhir');
		$filter_packer = $this->input->get('filter_packer');

		$data['data'] 	= $this->packer->getAllData($length, $start, $_cari, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_packer)->result_array();
		$data['title'] = "Laporan Packer";
		$this->load->view('templates/cetak/laporan_packer', $data);
	}

	function getTotalResi()
	{
		$where = array();

		$packer = $this->input->post('filter_packer');
		$tanggal_mulai = $this->input->post('filter_tanggal_mulai');
		$tanggal_akhir = $this->input->post('filter_tanggal_akhir');

		if ($tanggal_mulai != null) {
			$where += array('a.penj_tanggal >= ' => date('Y-m-d', strtotime($tanggal_mulai)));
		}
		if ($tanggal_akhir != null) {
			$where += array('a.penj_tanggal <= ' => date('Y-m-d', strtotime($tanggal_akhir)));
		}

		if ($packer != null) {
			$where += array('a.penj_pack_id' => $packer);
		}


		$get = $this->db->get_where('penjualan a', $where)->num_rows();

		$this->output_json($get);
	}

	public function getPacker()
	{
		$get = $this->db->select('*')->get('packer a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}


	private function output_json($data)
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}


	function __construct()
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('laporan/packerModel', 'packer');
		$this->level = $this->session->userdata('data')['level'];
		// cek session
		$this->sesion->cek_session();
	}
}
