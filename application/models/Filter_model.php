<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter_model extends CI_Model {

	public function getKategori($level=null)
	{
		return $this->db->select('*')->where('kate_level', $level)->get('kategori')->result_array();
	}

	public function getSumberPenjualan()
	{
		return $this->db->select('*')->get('sumber_penjualan')->result_array();
	}

	public function getRak()
	{
		return $this->db->select('*')->get('rak')->result_array();
	}

	public function getEtalase()
	{
		return $this->db->select('*')->get('etalase')->result_array();
	}
}