<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapor_model extends CI_Model {

	public function getAllIsiLapor($show=null, $start=null, $cari=null){
		$this->db->select(" a.*, a.created_date, users.*, b.keja_nama, c.refs_keterangan ");
		$this->db->from("lapor a");
		$this->db->join("users", "user_id = lapo_user_id");
		$this->db->join("kejadian b", "b.keja_id = a.lapo_keja_id");
		$this->db->join("referensi_status c", "c.refs_id = a.lapo_status","left");
		$this->db->order_by('a.created_date','desc');
		$this->db->where("(a.lapo_user_id LIKE '%".$cari."%' or a.lapo_nama LIKE '%".$cari."%' or a.lapo_no_hp LIKE '%".$cari."%' or a.lapo_alamat LIKE '%".$cari."%' or a.lapo_keterangan LIKE '%".$cari."%' or a.lapo_status LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($user_id, $nama, $no_hp, $alamat, $keterangan, $status) {

		$sql = "INSERT INTO lapor (lapo_user_id, lapo_nama, lapo_no_hp, lapo_alamat, lapo_keterangan, lapo_status, created_date) VALUES (?, ?, ?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$user_id, $nama, $no_hp, $alamat, $keterangan, $status, psql_datetime_format()]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function insertInvestigasi($lapo_id, $nama_pemilik, $no_hp_pemilik, $jumlah_penghuni, $jarak_tempuh, $jenis_bangunan, $area, $luas_area, $penyebab, $korban_luka, $korban_meninggal, $jumlah_unit, $nomer_polisi, $jumlah_petugas, $nama_danru1, $nama_danru2) {

		$sql = "INSERT INTO lapor_bap (laba_lapo_id, laba_nama_pemilik, laba_no_hp_pemilik, laba_jumlah_penghuni, laba_jarak_tempuh, laba_jenis_bangunan, laba_area, laba_luas_area, laba_penyebab_kebakaran, laba_korban_luka, laba_korban_meninggal, laba_jumlah_unit, laba_nomer_polisi, laba_jumlah_petugas, laba_nama_danru1, laba_nama_danru2, created_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$lapo_id, $nama_pemilik, $no_hp_pemilik, $jumlah_penghuni, $jarak_tempuh, $jenis_bangunan, $area, $luas_area, $penyebab, $korban_luka, $korban_meninggal, $jumlah_unit, $nomer_polisi, $jumlah_petugas, $nama_danru1, $nama_danru2, psql_datetime_format()]);
		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $user_id, $nama, $no_hp, $alamat, $keterangan, $status){
		$sql = "UPDATE lapor SET lapo_user_id=?, lapo_nama=?, lapo_no_hp=?, lapo_alamat=?, lapo_keterangan=?, lapo_status=?, created_date=? WHERE lapo_id=?;";
		$q = $this->db->query($sql, [$user_id, $nama, $no_hp, $alamat, $keterangan, $status, psql_datetime_format(), $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM lapor WHERE lapo_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}

	public function getUsers()
	{
		$this->db->select('user_id, user_name');
		return $this->db->get('users')->result();
	}

	public function regu()
	{
		return $this->db->get('regu')->result_array();
	}

	public function status()
	{
		$this->db->select('*');
		$this->db->where('refs_menu',56); //56 = menu lapor
		return $this->db->get('referensi_status')->result_array();
	}
	
	public function detail($id){
		$query = $this->db->select('*')
											->join('users b','b.user_id = a.lapo_user_id')
											->where('a.lapo_id',$id)
											->get('lapor a')
											->row_array();
		return $query;
	}

	public function simpanPenugasan($lapo_id,$status,$regu_id,$keterangan){
		$data['lapo_waktu_keputusan'] = date('Y-m-d H:i:s');
		$data['lapo_status'] = $status;
		$exe = $this->db->where('lapo_id',$lapo_id);
		$exe = $this->db->update('lapor',$data);
		if($exe){
			$data2['lapa_lapo_id'] = $lapo_id;
			$data2['lapa_regu_id'] = $regu_id;
			$data2['lapa_keterangan'] = $keterangan;
			$data2['lapa_status'] = 6; // menunggu
			$exe2 = $this->db->insert('lapor_pasukan',$data2);
		}
		return $exe;
	}

	public function lapor_manual(){
		$user = $this->db->select('user_id')->get_where('users', array('user_email' => $this->email))->row_array();
		$user_id = $user['user_id'];
   		$photo = $this->_uploadImage();

		$data['lapo_user_id'] = $user_id;
		$data['lapo_keja_id'] = $this->input->post('keja_id');
		$data['lapo_photo'] = $photo;
		$data['lapo_lat'] = $this->input->post('lat');
		$data['lapo_lon'] = $this->input->post('lon');
		$data['lapo_nama'] = $this->input->post('nama');
		$data['lapo_no_hp'] = $this->input->post('no_hp');
		$data['lapo_alamat'] = $this->input->post('alamat');
		$data['lapo_keterangan'] = $this->input->post('keterangan');
		$data['lapo_status'] = 6;
		$exe = $this->db->insert('lapor', $data);
		$lapo_id = $this->db->insert_id();
		if($exe){
			$data2['noti_lapo_id'] = $lapo_id;
			$data2['noti_refs_status'] = 6;
			$data2['noti_keterangan'] = "Lapor Kejadian ".$this->input->post('keterangan');
			$data2['noti_status'] = "masuk";
			$data2['noti_musik'] = "plucky.mpeg";
			return $this->db->insert('notifikasi', $data2);
		}
		return $exe;
	}

	public function cek_penugasan($lapo_id=null){
		$where = array(
			'a.lapa_lapo_id' => $lapo_id
		);
		$get = $this->db->get_where('lapor_pasukan a',$where)->num_rows();
		return $get;
	}

	public function cek_penugasan_armada($lapo_id=null){
		$where = array(
			'a.lata_lapo_id' => $lapo_id,
			'a.lata_status' => '',
		);
		$get = $this->db->get_where('lapor_tambah a',$where)->num_rows();
		return $get;
	}

	private function _uploadImage()
    {
        $config['upload_path']          = './assets/gambar/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 2024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('photo')) {
            return $this->upload->data("file_name");
        }
    }
}