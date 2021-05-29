<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.*, b.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3, d.*, e.*, g.nama as customer");
		$this->db->from("pengadaan_detail a");
		$this->db->join('pengadaan b','b.peng_id = a.pend_peng_id');    
		$this->db->join('kategori z','z.kate_id = a.pend_kate_id','left');
		$this->db->join('kategori x','x.kate_id = a.pend_kate_id_2','left');
		$this->db->join('kategori y','y.kate_id = a.pend_kate_id_3','left');
		$this->db->join('produk d','d.prod_id = a.pend_prod_id');
		$this->db->join('supplier e','e.supp_id = a.pend_supp_id','left');
		$this->db->join('customers g','g.id = b.peng_cust_id','left');
		$this->db->order_by('a.pend_id', 'desc');
		$this->db->where("(z.kate_nama LIKE '%".$cari."%' or a.pend_jumlah LIKE '%".$cari."%' or a.pend_harga LIKE '%".$cari."%' or a.pend_total_harga LIKE '%".$cari."%' or b.peng_total_harga LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}
	public function getAllProduk($show=null, $start=null, $cari=null,$id=null){
		$this->db->select("a.*, c.*, e.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3,");
		// $this->db->select("*");
		$this->db->from("pengadaan_detail a");
		$this->db->join("produk c","c.prod_id = a.pend_prod_id", "left");
		$this->db->join('kategori z','z.kate_id = a.pend_kate_id','left');
		$this->db->join('kategori x','x.kate_id = a.pend_kate_id_2','left');
		$this->db->join('kategori y','y.kate_id = a.pend_kate_id_3','left');
		$this->db->join("supplier e","e.supp_id = a.pend_supp_id", "left");
		if($id != null){
			$this->db->where('a.pend_peng_id', $id);			
		}
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function getAllProdukPengiriman($show=null, $start=null, $cari=null,$id=null){
		$this->db->select("a.*, c.*, e.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3,");
		// $this->db->select("*");
		$this->db->from("pengadaan_detail a");
		$this->db->join("pengadaan b","b.peng_id = a.pend_peng_id");
		$this->db->join("produk c","c.prod_id = a.pend_prod_id", "left");
		$this->db->join('kategori z','z.kate_id = a.pend_kate_id','left');
		$this->db->join('kategori x','x.kate_id = a.pend_kate_id_2','left');
		$this->db->join('kategori y','y.kate_id = a.pend_kate_id_3','left');
		$this->db->join("supplier e","e.supp_id = a.pend_supp_id", "left");
		$this->db->where('b.peng_status_manager','terima');
		// $this->db->order_by('b.peng_id', 'desc');
		$this->db->order_by('a.pend_id', 'desc');
		if($id != null){
			$this->db->where('a.pend_peng_id', $id);			
		}
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function getAllProdukRefund($show=null, $start=null, $cari=null,$id=null){
		$this->db->select("a.*, c.*, e.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3,");
		// $this->db->select("*");
		$this->db->from("pengadaan_detail a");
		$this->db->join("pengadaan b","b.peng_id = a.pend_peng_id");
		$this->db->join("produk c","c.prod_id = a.pend_prod_id", "left");
		$this->db->join('kategori z','z.kate_id = a.pend_kate_id','left');
		$this->db->join('kategori x','x.kate_id = a.pend_kate_id_2','left');
		$this->db->join('kategori y','y.kate_id = a.pend_kate_id_3','left');
		$this->db->join("supplier e","e.supp_id = a.pend_supp_id", "left");
		$this->db->where('b.peng_status_manager','terima');
		$this->db->where('a.pend_status_pengiriman','Has Arrived');
		if($id != null){
			$this->db->where('a.pend_peng_id', $id);			
		}
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function getAllDataCetak($id){
		$where = ['peng_id' => $id];

		$this->db->select(" a.*, b.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3, d.*, e.*");
		$this->db->from("pengadaan_detail a");
		$this->db->join('pengadaan b','b.peng_id = a.pend_peng_id');    
		$this->db->join('kategori z','z.kate_id = a.pend_kate_id','left');
		$this->db->join('kategori x','x.kate_id = a.pend_kate_id_2','left');
		$this->db->join('kategori y','y.kate_id = a.pend_kate_id_3','left');
		$this->db->join('produk d','d.prod_id = a.pend_prod_id');
		$this->db->join('supplier e','e.supp_id = a.pend_supp_id','left');
		$this->db->order_by('a.pend_id', 'desc');
		$this->db->where($where);

		$return = $this->db->get();

		// return
		return $return;
	}

	public function hangus($id) {
		$sql = "DELETE FROM penjualan WHERE penj_id=?;";
		$q = $this->db->query($sql, [$id]);

		$get = $this->db->where('pede_penj_id', $id)->get('penjualan_detail')->result_array();
	
		$sql2 = "DELETE FROM penjualan_detail WHERE pede_penj_id=?;";
		$q2 = $this->db->query($sql2, [$id]);
		return $q;
	}
}
