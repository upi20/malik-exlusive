<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{

	public function getAllData($show = null, $start = null, $cari = null, $val_kategori_utama = null, $val_kategori = null, $val_sub_kategori = null, $val_rak = null, $etalase = null, $val_vendor = null, $val_status_stok = null)
	{
		$this->db->select(" a.*, b.kate_id as kate_id_1, b.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3, d.supp_nama ");
		$this->db->from(" produk a ");
		$this->db->join(" kategori b ", "b.kate_id = a.prod_kate_id", "left");
		$this->db->join(" kategori x ", "x.kate_id = a.prod_kate_id_2", "left");
		$this->db->join(" kategori y ", "y.kate_id = a.prod_kate_id_3", "left");
		$this->db->join(" supplier d ", "d.supp_id = a.prod_supp_id", "left");
		$this->db->order_by(" a.prod_stok ", "asc");
		// $this->db->join(" rak c ", "c.rak_id = a.prod_rak_id", "left");
		// $this->db->join(" etalase d ", "d.etal_id = a.prod_etal_id", "left");
		if ($val_status_stok == "Kurang") {
			$this->db->where('prod_selisih_stok < ', 0);
		} elseif ($val_status_stok == "Cukup") {
			$this->db->where('prod_selisih_stok >= ', 0);
			$this->db->where('prod_selisih_stok <= ', 2);
		} elseif ($val_status_stok == "Lebih") {
			$this->db->where('prod_selisih_stok > ', 2);
		}
		$this->db->where(" (a.prod_kode LIKE '%" . $cari . "%' or b.kate_nama LIKE '%" . $cari . "%' or a.prod_nama LIKE '%" . $cari . "%' or a.prod_status LIKE '%" . $cari . "%') ");
		// $this->db->order_by('a.prod_selisih_stok', 'desc');
		if ($val_sub_kategori != null) {
			$this->db->where('prod_kate_id_3', $val_sub_kategori);
		} elseif ($val_kategori != null) {
			$this->db->where('prod_kate_id_2', $val_kategori);
		} elseif ($val_kategori_utama != null) {
			$this->db->where('prod_kate_id', $val_kategori_utama);
		} elseif ($val_vendor != null) {
			$this->db->where('prod_vendor', $val_vendor);
		} else {
		}

		// if($val_rak)

		if ($show == null && $start == null) {
			$return = $this->db->get();
		} else {
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $tahun, $facebook, $tokopedia, $bukalapak, $shopee, $supp_nama = null, $kode = null, $special = null, $link_referensi = null)
	{
		if ($this->session->userdata('data')['level'] == "Manager") {
			$upload = $_FILES["file"]["name"];
			if ($upload == null) {
				$sql = "INSERT INTO produk (prod_kate_id, prod_kate_id_2, prod_kate_id_3, prod_nama, prod_harga_beli, prod_harga_jual, prod_berat, prod_status, prod_min_stok, prod_max_stok, prod_selisih_stok, prod_tahun, prod_special, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stok_selisih = 0;
				$q = $this->db->query($sql, [$parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $stok_selisih, $tahun, $special, psql_datetime_format()]);
			} else {
				$gambar = $this->_uploadImage();

				$sql = "INSERT INTO produk (prod_kate_id, prod_kate_id_2, prod_kate_id_3, prod_nama, prod_harga_beli, prod_harga_jual, prod_berat, prod_status, prod_min_stok, prod_max_stok, prod_selisih_stok, prod_tahun, prod_gambar, prod_special, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stok_selisih = 0;
				$q = $this->db->query($sql, [$parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $stok_selisih, $tahun, $gambar, $special, psql_datetime_format()]);
			}

			$return['id'] = $this->db->insert_id();
		} elseif ($this->session->userdata('data')['level'] == "Gudang") {
			$upload = $_FILES["file"]["name"];
			if ($upload == null) {
				$sql = "INSERT INTO produk (prod_kate_id, prod_kate_id_2, prod_kate_id_3, prod_nama, prod_harga_beli, prod_harga_jual, prod_berat, prod_status, prod_min_stok, prod_max_stok, prod_selisih_stok, prod_tahun, prod_supp_id, prod_kode, prod_special, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stok_selisih = 0;
				$q = $this->db->query($sql, [$parent1, $parent2, $parent3, $nama, $harga_beli, $harga_beli, $berat, $status, $min_stok, $max_stok, $stok_selisih, $tahun, $supp_nama, $kode, $special, psql_datetime_format()]);
			} else {
				$gambar = $this->_uploadImage();
				$sql = "INSERT INTO produk (prod_kate_id, prod_kate_id_2, prod_kate_id_3, prod_nama, prod_harga_beli, prod_harga_jual, prod_berat, prod_status, prod_min_stok, prod_max_stok, prod_selisih_stok, prod_tahun, prod_supp_id, prod_gambar, prod_kode, prod_special, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stok_selisih = 0;
				$q = $this->db->query($sql, [$parent1, $parent2, $parent3, $nama, $harga_beli, $harga_beli, $berat, $status, $min_stok, $max_stok, $stok_selisih, $tahun, $supp_nama, $gambar, $kode, $special, psql_datetime_format()]);
			}


			$return['id'] = $this->db->insert_id();
		} elseif ($this->session->userdata('data')['level'] == "Administrator") {
			$upload = $_FILES["file"]["name"];
			if ($upload == null) {
				$sql = "INSERT INTO produk (prod_kate_id, prod_kate_id_2, prod_kate_id_3, prod_nama, prod_harga_beli, prod_harga_jual, prod_berat, prod_status, prod_min_stok, prod_max_stok, prod_selisih_stok, prod_tahun, prod_supp_id, prod_kode, prod_special, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stok_selisih = 0;
				$q = $this->db->query($sql, [$parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $stok_selisih, $tahun, $supp_nama, $kode, $special, psql_datetime_format()]);
			} else {
				$gambar = $this->_uploadImage();
				$sql = "INSERT INTO produk (prod_kate_id, prod_kate_id_2, prod_kate_id_3, prod_nama, prod_harga_beli, prod_harga_jual, prod_berat, prod_status, prod_min_stok, prod_max_stok, prod_selisih_stok, prod_tahun, prod_supp_id, prod_gambar, prod_kode, prod_special, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stok_selisih = 0;
				$q = $this->db->query($sql, [$parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $stok_selisih, $tahun, $supp_nama, $gambar, $kode, $special, psql_datetime_format()]);
			}


			$return['id'] = $this->db->insert_id();
		} else {
			$sql = "INSERT INTO produk (prod_kate_id, prod_kate_id_2, prod_kate_id_3, prod_nama, prod_harga_beli, prod_harga_jual, prod_berat, prod_status, prod_min_stok, prod_max_stok, prod_selisih_stok, prod_tahun, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stok_selisih = 0;
			$q = $this->db->query($sql, [$parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $stok_selisih, $tahun, psql_datetime_format()]);
			$return['id'] = $this->db->insert_id();
		}

		return $return;
	}

	public function _uploadImage($file = null)
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
		if ($this->upload->do_upload('file')) {
			// 	// chmod($config['upload_path'].$this->upload->data("file_name"), 0755);
			return $this->upload->data("file_name");
		}
	}

	public function update($id, $parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $tahun, $facebook, $tokopedia, $bukalapak, $shopee, $supp_nama = null, $kode = null, $special = null, $link_referensi = null, $satuan = null)
	{

		$upload = $_FILES["file"]["name"];
		if ($upload == null) {
			$sql = "UPDATE produk SET prod_kate_id=?, prod_kate_id_2=?, prod_kate_id_3=?, prod_nama=?, prod_harga_beli=?, prod_harga_jual=?, prod_berat=?, prod_status=?, prod_min_stok=?, prod_max_stok=?, prod_tahun=?, prod_vendor=?, prod_special=?, tanggal=? WHERE prod_id=?;";

			$q = $this->db->query($sql, [$parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $tahun, $supp_nama, $special, psql_datetime_format(), $id]);
		} else {
			$gambar = $this->_uploadImage();
			$sql = "UPDATE produk SET prod_gambar=?, prod_kate_id=?, prod_kate_id_2=?, prod_kate_id_3=?, prod_nama=?, prod_harga_beli=?, prod_harga_jual=?, prod_berat=?, prod_status=?, prod_min_stok=?, prod_max_stok=?, prod_tahun=?, prod_vendor=?, prod_special=?, tanggal=? WHERE prod_id=?;";

			$q = $this->db->query($sql, [$gambar, $parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $tahun, $supp_nama, $special, psql_datetime_format(), $id]);
		}




		return $q;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM produk WHERE prod_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
}
