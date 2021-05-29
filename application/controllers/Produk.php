<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Produk extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Produk';
		if($this->level == "Pengadaan"){
			$this->content = 'produk'; 			
			// $this->content = 'produk-pengadaan'; 			
		}elseif($this->level == "CS"){
			$this->content = 'produk-cs'; 			
		}else{
			$this->content = 'produk'; 			
		}
		$this->plugins = ['datatables'];
		$this->navigation = ['Produk'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');

		$cari 	= $this->input->post('search');
		$data 	= $this->produk->getAllData($length, $start, $cari['value'])->result_array();
		$count 	= $this->produk->getAllData(null,null, $cari['value'])->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function ubahLokal(){
		$prod_id = $this->input->post('prod_id');
		$blok_id = $this->input->post('blok_id');
		$ruma_id = $this->input->post('ruma_id');
		$r = $this->produk->ubahLokal($prod_id, $blok_id, $ruma_id);

		if($r !== FALSE) {

			$this->output_json(
				[
					'id' => $prod_id,
				]
			);
		}
	}

	public function ubahKelas()
	{
		$prod_id 	= $this->input->post('prod_id');
		$kelas 		= $this->input->post('kelas');
		$kelas_lama = $this->input->post('kelas_lama');

		$r 			= $this->produk->ubahKelas($prod_id, $kelas, $kelas_lama);

		if ($r !== FALSE) 
		{
			$this->output_json(
				[
					'id' => $prod_id,
				]
			);
		}
	}

	public function ubahPhotoJenis()
	{
		$id = $this->input->post('prod_id_photos');
		$jenis = $this->input->post('jenis');
		$file_1 = $_FILES['gambar']['name'];
		$photo = $this->_uploadImage1($file_1);
		$upd['prod_jenis'] = $jenis;
		$upd['prod_gambar'] = $file_1;
		$this->db->where('prod_id', $id);
		$this->db->update('produk', $upd);
		echo "<script>alert('Berhasil')</script>";
		redirect('produk','refresh');
	}

	public function _uploadImage1($file=null)
    {
        $config['upload_path']          = './gambar/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = $file;
        $config['overwrite']            = true;
        $config['max_size']             = 8024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        // $path = $_SERVER['DOCUMENT_ROOT'];

  //       $bannerpath=$path.base_url()."file_anggota/";
		// move_uploaded_file($_FILES["photo_anggota"]["name"],$bannerpath);
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('gambar')) {
        // 	// chmod($config['upload_path'].$this->upload->data("file_name"), 0755);
            return $this->upload->data("file_name");
        }
    }

	public function ubahStatus(){
		$id = $this->input->post('prod_id_status');
		$status = $this->input->post('status');
		$upd['prod_status'] = $status;
		$this->db->where('prod_id', $id);
		$this->db->update('produk', $upd);
		echo "<script>alert('Berhasil')</script>";
		redirect('produk','refresh');
	}

	public function cetak(){
		$produk = $this->db->select(" a.*, b.* , c.*, d.*")
						   ->from("produk b")
						   ->join("rumah a", "b.prod_ruma_id = a.ruma_id","left")
						   ->join("blok d", "d.blok_id = a.ruma_blok_id","left")
						   ->join("kelas c", "b.prod_kela_id = c.kela_id", "left")
						   ->get()
						   ->result_array();

	 	$data = array( 
	 		'title' => 'Laporan Sapi',
	 		'list' => $produk
	 	);

	 	$this->load->view('templates/cetak/data_sapi',$data);
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