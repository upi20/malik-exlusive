<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model {

	public function getAllIsiLapor($show=null, $start=null, $cari=null, $filter_status_pembayaran=null, $filter_status_pengiriman=null, $filter_tanggal_mulai=null, $filter_tanggal_akhir=null, $filter_sumber_penjualan=null){
		$this->db->select(" a.*, users.* ");
		$this->db->from("penjualan a");
		$this->db->join("users", "user_id = penj_user_id");
		// $this->db->join("sumber_penjualan b", "supe_id = a.penj_supe_id");
		if($filter_status_pembayaran != null){
			$this->db->where('a.penj_status', $filter_status_pembayaran);
			$session = array(
				'filter_status_pembayaran' => $filter_status_pembayaran
			);
			$this->session->set_userdata($session);
		}

		if($filter_status_pengiriman == 0){

		}elseif($filter_status_pengiriman == 1){
			$session = array(
				'penj_status_pengiriman' => ''
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_status_pengiriman', '');
		}elseif($filter_status_pengiriman != null){
			$session = array(
				'penj_status_pengiriman' => $filter_status_pengiriman
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_status_pengiriman', $filter_status_pengiriman);
		}

		if($filter_tanggal_mulai != null){
			$session = array(
				'filter_tanggal_mulai' =>  date('Y-m-d', strtotime($filter_tanggal_mulai))
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_tanggal >= ', date('Y-m-d', strtotime($filter_tanggal_mulai)));
		}

		if($filter_tanggal_akhir != null){
			$session = array(
				'filter_tanggal_akhir' =>  date('Y-m-d', strtotime($filter_tanggal_akhir))
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_tanggal <= ', date('Y-m-d', strtotime($filter_tanggal_akhir)));
		}

		// if($filter_sumber_penjualan != null){
		// 		$session = array(
		// 		'filter_sumber_penjualan' => $filter_sumber_penjualan
		// 	);
		// 	$this->session->set_userdata($session);
		// 	$this->db->where('b.supe_jenis', $filter_sumber_penjualan);
		// }

		$this->db->where("(a.penj_user_id LIKE '%".$cari."%' or a.penj_nama LIKE '%".$cari."%' or a.penj_no_hp LIKE '%".$cari."%' or a.penj_alamat LIKE '%".$cari."%' or a.penj_total_harga LIKE '%".$cari."%' or a.penj_dibayar LIKE '%".$cari."%' or a.penj_sisa LIKE '%".$cari."%' or a.penj_status LIKE '%".$cari."%' or a.penj_lokasi LIKE '%".$cari."%' or a.penj_tanggal LIKE '%".$cari."%' or a.penj_tanggal_pengiriman LIKE '%".$cari."%' or a.penj_kondisi LIKE '%".$cari."%' or a.penj_keterangan LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function getAllIsiLaporNominal($show=null, $start=null, $cari=null, $filter_status_pembayaran=null, $filter_status_pengiriman=null, $filter_tanggal_mulai=null, $filter_tanggal_akhir=null, $filter_sumber_penjualan=null){
		$this->db->select_sum(" a.penj_total_harga ");
		$this->db->from("penjualan a");
		$this->db->join("users", "user_id = penj_user_id");
		$this->db->join("sumber_penjualan b", "supe_id = a.penj_supe_id");
		if($filter_status_pembayaran != null){
			$this->db->where('a.penj_status', $filter_status_pembayaran);
			$session = array(
				'filter_status_pembayaran' => $filter_status_pembayaran
			);
			$this->session->set_userdata($session);
		}

		if($filter_status_pengiriman == 0){

		}elseif($filter_status_pengiriman == 1){
			$session = array(
				'penj_status_pengiriman' => ''
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_status_pengiriman', '');
		}elseif($filter_status_pengiriman != null){
			$session = array(
				'penj_status_pengiriman' => $filter_status_pengiriman
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_status_pengiriman', $filter_status_pengiriman);
		}

		if($filter_tanggal_mulai != null){
			$session = array(
				'filter_tanggal_mulai' =>  date('Y-m-d', strtotime($filter_tanggal_mulai))
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_tanggal >= ', date('Y-m-01', strtotime($filter_tanggal_mulai)));
		}

		if($filter_tanggal_akhir != null){
			$session = array(
				'filter_tanggal_akhir' =>  date('Y-m-d', strtotime($filter_tanggal_akhir))
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_tanggal <= ', date('Y-m-30', strtotime($filter_tanggal_akhir)));
		}

		// if($filter_sumber_penjualan != null){
		// 		$session = array(
		// 		'filter_sumber_penjualan' => $filter_sumber_penjualan
		// 	);
		// 	$this->session->set_userdata($session);
		// 	$this->db->where('b.supe_jenis', $filter_sumber_penjualan);
		// }

		$this->db->where("(a.penj_user_id LIKE '%".$cari."%' or a.penj_nama LIKE '%".$cari."%' or a.penj_no_hp LIKE '%".$cari."%' or a.penj_alamat LIKE '%".$cari."%' or a.penj_total_harga LIKE '%".$cari."%' or a.penj_dibayar LIKE '%".$cari."%' or a.penj_sisa LIKE '%".$cari."%' or a.penj_status LIKE '%".$cari."%' or a.penj_lokasi LIKE '%".$cari."%' or a.penj_tanggal LIKE '%".$cari."%' or a.penj_tanggal_pengiriman LIKE '%".$cari."%' or a.penj_kondisi LIKE '%".$cari."%' or a.penj_keterangan LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function getAllIsiLaporExport($filter_status_pembayaran=null, $filter_status_pengiriman=null, $filter_tanggal_mulai=null, $filter_tanggal_akhir=null, $filter_sumber_penjualan=null)
	{
		$this->db->select(" a.*, users.*, z.*, x.*, y.*, tk.*, tk.nama as toko, sp.* ");
		$this->db->from("penjualan_detail z");
		$this->db->join("penjualan a", "a.penj_id = z.pede_penj_id");
		$this->db->join("produk x", "x.prod_id = z.pede_prod_id");
		$this->db->join("kategori y", "y.kate_id = z.pede_kate_id");
		$this->db->join("users", "user_id = penj_user_id");
		$this->db->join("toko tk", "tk.id = a.penj_toko_id");
		$this->db->join("supplier sp", "sp.supp_id = z.pede_supp_id");
		if($filter_status_pembayaran != null){
			$this->db->where('a.penj_status', $filter_status_pembayaran);
			$session = array(
				'filter_status_pembayaran' => $filter_status_pembayaran
			);
			$this->session->set_userdata($session);
		}

		if($filter_status_pengiriman == 0){

		}elseif($filter_status_pengiriman == 1){
			$session = array(
				'penj_status_pengiriman' => ''
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_status_pengiriman', '');
		}elseif($filter_status_pengiriman != null){
			$this->db->where('a.penj_status_pengiriman', $filter_status_pengiriman);
		}

		if($filter_tanggal_mulai != null){
			$session = array(
				'filter_tanggal_mulai' =>  date('Y-m-d', strtotime($filter_tanggal_mulai))
			);
			$this->session->set_userdata($session);
			$this->db->where('a.penj_tanggal >= ', date('Y-m-d', strtotime($filter_tanggal_mulai)));
		}

		if($filter_tanggal_akhir != null){
			$session = array(
				'filter_tanggal_akhir' =>  date('Y-m-d', strtotime($filter_tanggal_akhir))
			);
			$this->session->set_userdata($session);
			$date = str_replace('/', '-', $filter_tanggal_akhir);
			$this->db->where('a.penj_tanggal <= ', date('Y-m-d', strtotime($filter_tanggal_akhir)));
		}

		// if($filter_sumber_penjualan != null){
		// 		$session = array(
		// 		'filter_sumber_penjualan' => $filter_sumber_penjualan
		// 	);
		// 	$this->session->set_userdata($session);
		// 	$this->db->where('b.supe_jenis', $filter_sumber_penjualan);
		// }
		$return = $this->db->get()->result_array();
		return $return;
	}
}