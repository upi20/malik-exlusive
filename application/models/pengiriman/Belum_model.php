<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belum_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.*");
		$this->db->from(" penjualan a ");
		// $this->db->join(" penjualan_detail b ", "a.penj_id = b.pede_penj_id");
		// $this->db->join(" produk p ", "b.pede_prod_id = p.prod_id");
		// $this->db->join(" kategori k ", "k.kate_id = p.prod_kate_id");
		// $this->db->group_by("");
		$this->db->order_by('a.penj_tanggal_pengiriman','asc');
		$this->db->where('a.penj_status != ', 'Hangus');
		$this->db->where('a.penj_kondisi', '');
		$this->db->where('a.penj_status_pengiriman', '');
		$this->db->where(" (a.penj_id LIKE '%".$cari."%' or a.penj_nama LIKE '%".$cari."%' or a.penj_no_hp LIKE '%".$cari."%' or a.penj_alamat LIKE '%".$cari."%' or a.penj_total_harga LIKE '%".$cari."%' or a.penj_dibayar LIKE '%".$cari."%' or a.penj_sisa LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function getDetail($id)
	{
		$sql 		= " SELECT pede.*, prod.*, penj.*, kt.*
						FROM penjualan penj
						JOIN penjualan_detail pede
						JOIN produk prod
						JOIN kategori kt
						ON penj.penj_id 		= pede.pede_penj_id 
						AND pede.pede_prod_id 	= prod.prod_id
						AND prod.prod_kate_id 	= kt.kate_id
						WHERE penj.penj_id 		= '{$id}'";

		$exe 		= $this->db->query($sql);

		return $exe;
	}
	
	public function Berangkat($penj_id, $total_harga, $dibayar, $sisa)
	{
		$sql 		= " INSERT INTO pengiriman (pman_penj_id, pman_total_harga, pman_dibayar, pman_sisa, 									pman_start, tanggal, pman_status) VALUES(?, ?, ?, ?, ?, ?, ?)";

		$exe 		= $this->db->query($sql, [$penj_id, $total_harga, $dibayar, $sisa, psql_datetime_format(), psql_datetime_format(), 'Dikirim']);

		$sql2 		= " UPDATE penjualan SET penj_status_pengiriman = 'Dikirim' WHERE penj_id = '".$penj_id."' ";
		$exe2 		= $this->db->query($sql2);

		$return['id'] = true;
		return $return;
	}
}