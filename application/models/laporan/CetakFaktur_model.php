<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CetakFaktur_model extends CI_Model {

	public function get_lapor()
  {
    $query = $this->db->get('lapor');
    return $query->result_array();
  }
	
	public function getLapor($id){
			$sql = "select  a.*, u.*
		from penjualan a,users u
		where a.penj_user_id = u.user_id
		and penj_id = '".$id."' ";
			$query = $this->db->query($sql)->row_array();
			return $query;
	}
	public function getLaporDetail($id){
		$sql = "select  a.*, u.*,k.*
		from penjualan_detail a,produk u,kategori k
		where a.pede_prod_id = u.prod_id
		and u.prod_kate_id = k.kate_id
		and pede_penj_id = '".$id."' ";
		$query = $this->db->query($sql)->row_array();
		return $query;			
	}
		public function get_produk($id)
    {

    	$sql = "SELECT
	a.pede_id,
	a.pede_penj_id,
	a.pede_status_pengiriman,
	a.pede_harga,
	a.pede_total_harga,
	a.pede_jumlah,
	u.prod_nama,
	k.kate_nama,
	u.prod_kode,
	l.penj_keterangan,
	CONCAT_WS( ' ', u.prod_nama, k.kate_nama ) AS no_rec,
	penj_tanggal_pengiriman,
	penj_tanggal,
	U.prod_stok 
FROM
	penjualan_detail a,
	produk u,
	kategori k,
	penjualan l 
WHERE
	a.pede_prod_id = u.prod_id 
	AND u.prod_kate_id = k.kate_id 
	AND a.pede_penj_id = l.penj_id AND pede_penj_id = '".$id."' ";
				// $query = $this->db->get_where("v_faktur", array("pede_penj_id" => $id));
				$query = $this->db->query($sql);

        return $query->result_array();

    }

}
