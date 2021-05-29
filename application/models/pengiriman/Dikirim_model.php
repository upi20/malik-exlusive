<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dikirim_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* , pman.*");
		$this->db->from(" penjualan a ");
		$this->db->join(" pengiriman pman ", "pman.pman_penj_id = a.penj_id");
		$this->db->group_by("a.penj_id");
		$this->db->where('a.penj_status_pengiriman', 'Dikirim');
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
		$sql 		= " SELECT pede.*, prod.*, penj.*, kela.*, pman.*
						FROM penjualan penj
						JOIN penjualan_detail pede
						JOIN produk prod
						JOIN kategori kela
						JOIN pengiriman pman
						ON pman.pman_penj_id 	= penj.penj_id
						AND penj.penj_id 		= pede.pede_penj_id 
						AND pede.pede_prod_id 	= prod.prod_id
						AND prod.prod_kate_id 	= kela.kate_id
						WHERE penj.penj_id 		= '{$id}' GROUP BY penj.penj_id";
		$exe 		= $this->db->query($sql);

		return $exe;
	}
	
	public function Sampai($penj_id,$dibayar_live=0,$insentif_live=0)
	{
		$sql 		= " UPDATE pengiriman SET pman_end = ?, pman_status=?, pman_dibayar_live=?, pman_insentif_live=? WHERE pman_penj_id=?";

		$exe 		= $this->db->query($sql, [psql_datetime_format(), 'Sampai', $dibayar_live, $insentif_live, $penj_id]);

		$sql2 		= " UPDATE penjualan SET penj_status_pengiriman=? WHERE penj_id=?";

		$exe2 		= $this->db->query($sql2, ['Sampai', $penj_id]);
		return $exe;
	}
}