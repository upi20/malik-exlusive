<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Produk extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Bulk - Product';
        $this->content = 'bulk-produk'; 			
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
	          $cek_jumlah = 1;
	          $data['prod_kode'] = $getData[0];
	          $data['prod_nama'] = $getData[1];
	          // $data['prod_berat'] = $getData[2];
	          $data['prod_harga_beli'] = $getData[2];
	          $data['prod_vendor'] = $getData[3];
	          $data['prod_harga_jual'] = $getData[4];
	          $data['prod_stok'] = $getData[5];
	          $data['prod_min_stok'] = $getData[6];
	          $data['prod_max_stok'] = $getData[7];
	          $data['prod_selisih_stok'] = (int)$getData[5]-(int)$getData[6];
	          $data['prod_berat'] = $getData[8];
	          $prime_kategori = $getData[10];
	          $kategori = $getData[11];
	          $sub_kategori = $getData[12];

	          $get_kate_id = $this->db->get_where('kategori', array('kate_nama' => $prime_kategori, 'kate_level' => 1))->row_array();
	          $get_kate_id_2 = $this->db->get_where('kategori', array('kate_nama' => $kategori, 'kate_level' => 2))->row_array();
	          $get_kate_id_3 = $this->db->get_where('kategori', array('kate_nama' => $sub_kategori, 'kate_level' => 3))->row_array();

	          $data['prod_kate_id'] = $get_kate_id['kate_id'];
	          $data['prod_kate_id_2'] = $get_kate_id_2['kate_id'];
	          $data['prod_kate_id_3'] = $get_kate_id_3['kate_id'];
	          $this->db->insert('produk', $data);
					}
					$no=$no+1;
        }
        	
    //     if($cek_jumlah == 0){
    //     	while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
		  //     {
				// 	if($no>0){
				// 	$simpeg = $this->loaddb->simpeg();
				// 	$where = array('nip' => (int)$getData[1]);

				// 	$getNama = $simpeg->select('nama')->get_where('all_pegs',$where);
    //               	if($getNama->num_rows() > 0){
				// 		$nama = $getNama->row_array()['nama'];
				// 	}else{
				// 		$nama = null;
				// 	}
    //               	$data['abse_user_nip'] = (int)$getData[1]; 
				// 	$data['abse_nama']		 = $nama;
				// 	// $data['abse_mesi_id'] = $getData[6]; 
				// 	$data['abse_mesi_id'] = 1; 
				// 	$data['abse_tanggal'] = $getData[3]; 

				// 	$data['created_date'] = date("Y-m-d H:i:s"); 
				// 	$cek_absen = $this->db->get_where('absensi', array('abse_user_nip' => (int)$getData[1], 'abse_tanggal' => $getData[3]));
				// 	if($cek_absen->num_rows() > 0){
				// 		$jam_masuk_awal = $cek_absen->row_array()['abse_jam_masuk'];
				// 		$jam_keluar_awal = $cek_absen->row_array()['abse_jam_keluar'];
    //                    if($jam_masuk_awal == ""){
    //                     	$data['abse_jam_masuk'] = $getData[4];
    //                     }
    //                   	if($jam_keluar_awal == ""){
    //                     	$data['abse_jam_keluar'] = $getData[5];
    //                     }
    //                     $tanggal_1 = date("Y-m-d H:i:s", strtotime($getData[4]));
    //                   	$tanggal_2 = date("Y-m-d H:i:s", strtotime($jam_masuk_awal));
    //                     if($tanggal_1 > $tanggal_2){
    //                        $data['abse_jam_masuk'] = $getData[4];
    //                     }
    //                     $tanggal_1 = date("Y-m-d H:i:s", strtotime($getData[5]));
    //                   	$tanggal_2 = date("Y-m-d H:i:s", strtotime($jam_keluar_awal));
    //                     if($tanggal_1 > $tanggal_2){
    //                        $data['abse_jam_keluar'] = $getData[5]; 						
    //                     }
    //                   	$exe = $this->db->where('abse_user_nip', (int)$getData[1]);
    //                     $exe = $this->db->where('abse_tanggal', $getData[3]);
    //                     $exe = $this->db->update('absensi', $data);
				// 	}else{
    //                      $data['abse_tanggal'] = $getData[3]; 
    //                      $data['abse_jam_masuk'] = $getData[4];
    //                      $data['abse_jam_keluar'] = $getData[5];  
    //                   	 $exe = $this->db->insert('absensi',$data);
    //                 }
                	
					
					
				// }
				// 	$no=$no+1;
	   //      	}
    //     	}
        // exit();
	       	// if($exe){
	       	// 	echo"<script>alert('Import data produk berhasil disimpan')</script>";
	       	// 	redirect('referensi/produk','refresh');
	       	// }else{
	       		echo"<script>alert('Import data produk berhasil disimpan')</script>";
	       		redirect('referensi/produk','refresh');
	       	// }
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