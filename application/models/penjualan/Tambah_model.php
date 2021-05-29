<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tambah_model extends CI_Model {

	// public function getAllData($show=null, $start=null, $cari=null){
	// 	$this->db->select(" a.*");
	// 	$this->db->from("pengadaan a");
	// 	$this->db->where("(a.peng_id LIKE '%".$cari."%' or a.peng_nominal LIKE '%".$cari."%' or a.peng_keterangan LIKE '%".$cari."%' or a.peng_status LIKE '%".$cari."%') ");
	// 	if ($show == null && $start == null){
	// 		$return = $this->db->get();
	// 	}else{
	// 		$this->db->limit($show, $start);   
	// 		$return = $this->db->get();
	// 	}
	// 	return $return;
	// }

	public function getAllDataDetail($show=null, $start=null, $cari=null){
		$this->db->select(" a.*, b.*, c.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3 ");
		$this->db->from("penjualan a");
		$this->db->join('penjualan_detail b','b.pede_penj_id = a.penj_id');    
		$this->db->join('produk c','b.pede_prod_id = c.prod_id');
		$this->db->join('kategori z','z.kate_id = c.prod_kate_id', 'left');
		$this->db->join('kategori x','x.kate_id = c.prod_kate_id_2', 'left');
		$this->db->join('kategori y','y.kate_id = c.prod_kate_id_3', 'left');
		$this->db->where('a.penj_status','belum');
		$this->db->where("( c.prod_nama LIKE '%".$cari."%' or b.pede_harga LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function getTotalHarga(){
		$get = $this->db->select_sum('a.pede_total_harga')->join('penjualan b', 'b.penj_id = a.pede_penj_id')->get_where('penjualan_detail a', array('b.penj_status' => 'belum'))->row_array();

		return $get['pede_total_harga'];
	}

	public function _uploadFile($file=null)
    {
        $config['upload_path']          = './gambar/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
        $config['file_name']            = $file;
        $config['overwrite']            = true;
        $config['max_size']             = 8024;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('berkas')) {
            return $this->upload->data("file_name");
        }
    }

	public function insertHead($code, $user_id, $tanggal, $nama, $no_hp, $alamat, $tanggal_pengiriman, $keterangan, $total, $dibayar, $sisa, $nominal_recah, $nominal_pengiriman, $supe_id, $id_marketplace, $kurir, $ongkir, $id_toko, $no_resi, $id_admin)
	{
		$status 	= 'Lunas';
		$berkas 	= $this->_uploadFile();
			// $sisa = 0;
			// $dibayar = $total;
		$sql = "UPDATE penjualan SET penj_user_id=?, penj_nama=?, penj_no_hp=?, penj_alamat=?, penj_total_harga=?, penj_dibayar=?, penj_sisa=?, penj_status=?, penj_tanggal=?, penj_tanggal_pengiriman=?, penj_keterangan=?, penj_supe_id =?, penj_toko_id=?, penj_no_resi=?, penj_kurir=?, penj_admin=?, penj_berkas=? WHERE penj_id=?;";
		$q = $this->db->query($sql, [$user_id, $nama, $no_hp, $alamat, $total, $dibayar, $sisa, $status, $tanggal, $tanggal_pengiriman, $keterangan, $supe_id, $id_toko, $no_resi, $kurir, $id_admin, $berkas, $code]);
		
		if($q){
			$get_detail = $this->db->where('pede_penj_id', $code)->get('penjualan_detail')->result_array();
			foreach ($get_detail as $q) {
				$get_stok = $this->db->get_where('produk', array('prod_id' => $q['pede_prod_id']))->row_array();
				$upd['prod_stok'] 	= $get_stok['prod_stok'] - $q['pede_jumlah'];
				$upd['prod_selisih_stok'] 	= $upd['prod_stok'] - $get_stok['prod_min_stok'];
				$this->db->where('prod_id', $q['pede_prod_id']);
				$this->db->update('produk', $upd);
			}

			$pembayaran['pepe_penj_id'] = $code;
			$pembayaran['pepe_total_harga'] = $total;
			$pembayaran['pepe_nominal'] = $dibayar;
			$pembayaran['pepe_sisa'] = $sisa;
			$pembayaran['tanggal'] = date("Y-m-d");
			$this->db->insert('penjualan_pembayaran', $pembayaran);
		}
		$return['id'] = $code;
		return $return;
	}

	public function insert($code, $parent1, $parent2, $parent3, $prod_id, $harga, $jumlah, $total_harga){
		$cek = $this->db->get_where('penjualan', array('penj_id' => $code))->num_rows();
		if($cek < 1){
			$sql0 = "INSERT INTO penjualan (penj_id, penj_status) VALUES (?, ?)";
			$q0 = $this->db->query($sql0, [$code, 'belum']);	
		}
		$sql = "INSERT INTO penjualan_detail (pede_penj_id, pede_kate_id, pede_kate_id_2, pede_kate_id_3, pede_prod_id, pede_harga, pede_jumlah, pede_total_harga) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$code, $parent1, $parent2, $parent3, $prod_id, $harga, $jumlah, $total_harga]);

		// if($q){
		// 	$upd['prod_status'] = 'Terjual';
		// 	$this->db->where('prod_id', $produk);
		// 	$this->db->update('produk', $upd);
		// }

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function insertPembayaran($penj_id, $total_harga, $dibayar, $sisa)
	{
		if($sisa > 0){
			$status 	= 'Hutang';			
		}else{
			$status 	= 'Lunas';
		}
		$sql 			= "INSERT INTO penjualan_pembayaran (pepe_penj_id, pepe_total_harga, pepe_nominal, pepe_sisa, tanggal) VALUES (?, ?, ?, ?, ?);";

		$q 				= $this->db->query($sql, [$penj_id, $total_harga, $dibayar, $sisa, psql_datetime_format()]);

		if($q){
			$upd['penj_dibayar'] = $total_harga-$sisa;
			$upd['penj_sisa'] = $sisa;
			$upd['penj_status'] = $status;
			$this->db->where('penj_id',$penj_id);
			$this->db->update('penjualan', $upd);
		}

		$return['id'] 	= $this->db->insert_id();

		return $return;
	}

	public function hapusDetail($id) {
		$get = $this->db->where('pede_id', $id)->get('penjualan_detail')->row_array();

		$sql = "DELETE FROM penjualan_detail WHERE pede_id=?;";
		$q = $this->db->query($sql, [$id]);
		if($q){
			$upd['prod_status'] = 'Tersedia';
			$this->db->where('prod_id', $get['pede_prod_id']);
			$this->db->update('produk', $upd);
		}
		return $q;
	}
}