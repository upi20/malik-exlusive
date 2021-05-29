<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PackerModel extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null, $filter_tanggal_mulai=null, $filter_tanggal_akhir=null, $filter_packer=null){
		$this->db->select(" a.*, w.*");

		$this->db->from("penjualan a");
		$this->db->join("packer w", 'w.pack_id = a.penj_pack_id', 'left');
		$this->db->order_by('w.pack_nama', 'asc');
		
		if($filter_tanggal_mulai != null){
			$this->db->where('a.penj_tanggal >= ', date('Y-m-d', strtotime($filter_tanggal_mulai)));
		}

		if($filter_tanggal_akhir != null){
			$this->db->where('a.penj_tanggal <= ', date('Y-m-d', strtotime($filter_tanggal_akhir)));
		}
		
		if($filter_packer != null){
			$this->db->where('a.penj_pack_id', $filter_packer);
		}

		$this->db->where("(a.penj_nama LIKE '%".$cari."%' or a.penj_no_resi LIKE '%".$cari."%' or w.pack_nama LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

}
