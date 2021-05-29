<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenjualanKeuanganModel extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null, $filter_tanggal_mulai=null, $filter_tanggal_akhir=null, $filter_supplier=null){
		$this->db->select(" a.*, b.*, s.*, c.prod_kode, c.prod_nama");

		$this->db->from("penjualan_detail a");
		$this->db->join("penjualan b", "b.penj_id = a.pede_penj_id", "left");
		$this->db->join("supplier s", 's.supp_id = a.pede_supp_id', 'left');
		$this->db->join("produk c", 'c.prod_id = a.pede_prod_id', 'left');
		$this->db->order_by('s.supp_id', 'asc');
		
		if($filter_tanggal_mulai != null){
			$this->db->where('b.penj_tanggal >= ', date('Y-m-d', strtotime($filter_tanggal_mulai)));
		}

		if($filter_tanggal_akhir != null){
			$this->db->where('b.penj_tanggal <= ', date('Y-m-d', strtotime($filter_tanggal_akhir)));
		}
		
		if($filter_supplier != null){
			$this->db->where('a.pede_supp_id', $filter_supplier);
		}

		$this->db->where("(b.penj_nama LIKE '%".$cari."%' or b.penj_no_resi LIKE '%".$cari."%' or s.supp_nama LIKE '%".$cari."%' or c.prod_nama LIKE '%".$cari."%' or c.prod_kode LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

}
