<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CodeOtomatis extends CI_Controller {

	public function referensiKategori(){
		$this->db->select('RIGHT(kategori.id,5) as id', FALSE);
		$this->db->order_by('id','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('kategori');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      

		   $data = $query->row();      
		   $kode = intval($data->id) + 1; 
		}
		else{      
		   $kode = 1; 
		}
	  	$tgl=date('Y'); 
	  	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil = "KTG-".$tgl."-".$batas;  
		$output['id'] = $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getSpecial(){
		$prod_id = $this->input->post('prod_id');
		$get = $this->db->join('special b','b.spec_id = a.pros_spec_id')->get_where('produk_special a', array('a.pros_prod_id'=>$prod_id))->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getDetailSpecial(){
		$spec_id = $this->input->post('spec_id');
		$get = $this->db->get_where('special a', array('a.spec_spec_id'=>$spec_id))->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueKategori(){
		$kate_id = $this->input->post('kate_id');
		$q = $this->db->get_where('kategori', array('kate_id' => $kate_id))->row_array();
		$output['id'] = $q['kate_kate_id'];
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getCodePenjualan()
	{
		$this->db->select('RIGHT(penjualan.penj_id,5) as id', FALSE);
		$this->db->order_by('penj_id','DESC');    
		$this->db->limit(1);
		$this->db->where('penj_status != ','belum');    
		$query = $this->db->get('penjualan');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      

		   $data = $query->row();
		   $kode = intval($data->id) + 1; 
		}
		else{      
		   $kode = 1; 
		}
	  	$tgl=date('Y'); 
	  	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil = "PMP-".$batas;  
		$output['id'] = $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getCodeProduk()
	{
		$this->db->select('RIGHT(produk.prod_kode,4) as id', FALSE);
		$this->db->order_by('prod_kode','DESC');    
		$this->db->limit(1);
		$query = $this->db->get('produk');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		   $data = $query->row();
		   $kode = intval($data->id) + 1; 
		}
		else{      
		   $kode = 1; 
		}
	  	$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
	  	$kodetampil = "MP ".$batas;  
		$output['id'] = $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getCodePengadaan()
	{
		$this->db->select('RIGHT(pengadaan.peng_id,5) as id', FALSE);
		$this->db->order_by('peng_id','DESC');    
		$this->db->limit(1);
		$this->db->where('peng_status != ','belum');    
		$query = $this->db->get('pengadaan');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      

		   $data = $query->row();
		   $kode = intval($data->id) + 1; 
		}else{      
		   $kode = 1; 
		}
	  	$tgl=date('Y'); 
	  	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil = "PMP-".$tgl."-".$batas;  
		$output['id'] = $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getNoRecBaru()
	{
		$this->db->select('RIGHT(pengadaan_detail.pend_no_rec,3) as id', FALSE);
		$this->db->order_by('pend_no_rec','DESC');    
		$this->db->limit(1);
		// $this->db->where('peng_status != ','belum');    
		$query = $this->db->get('pengadaan_detail');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      

		   $data = $query->row();
		   $kode = intval($data->id) + 1; 
		}
		else{      
		   $kode = 1; 
		}
		$output['id'] = $kode;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getCodePemesanan(){
		$this->db->select('RIGHT(pemesanan.id_pemesanan,5) as id', FALSE);
		$this->db->order_by('id_pemesanan','DESC');    
		$this->db->limit(1);    
		$this->db->where('status != ','belum');    
		$query = $this->db->get('pemesanan');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      

		   $data = $query->row();      
		   $kode = intval($data->id) + 1; 
		}
		else{      
		   $kode = 1; 
		}
	  	$tgl=date('Y'); 
	  	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil = "PMS-".$tgl."-".$batas;  
		$output['id'] = $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}
	
	public function getCodePemesananDetail(){
		$this->db->select('RIGHT(pemesanan_detail.id_detail,5) as id', FALSE);
		$this->db->order_by('id_detail','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('pemesanan_detail');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      

		   $data = $query->row();      
		   $kode = intval($data->id) + 1; 
		}
		else{      
		   $kode = 1; 
		}
	  	$tgl=date('Y'); 
	  	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil = "PMD-".$tgl."-".$batas;  
		$output['id'] = $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function referensiBarang(){
		$this->db->select('RIGHT(barang.id,5) as id', FALSE);
		$this->db->order_by('id','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('barang');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      

		   $data = $query->row();      
		   $kode = intval($data->id) + 1; 
		}
		else{      
		   $kode = 1; 
		}
	  	$tgl=date('Y'); 
	  	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil = "BRG-".$tgl."-".$batas;  
		$output['id'] = $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function referensiSupplier(){
		$this->db->select('RIGHT(supplier.id,5) as id', FALSE);
		$this->db->order_by('id','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('supplier');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      

		   $data = $query->row();      
		   $kode = intval($data->id) + 1; 
		}
		else{      
		   $kode = 1; 
		}
	  	$tgl=date('Y'); 
	  	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil = "SUP-".$tgl."-".$batas;  
		$output['id'] = $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function referensiSupplierBarang(){
		$this->db->select('RIGHT(supplier_barang.id,5) as id', FALSE);
		$this->db->order_by('id','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('supplier_barang');  //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      

		   $data = $query->row();      
		   $kode = intval($data->id) + 1; 
		}
		else{      
		   $kode = 1; 
		}
	  	$tgl=date('Y'); 
	  	$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	  	$kodetampil = "SUB-".$tgl."-".$batas;  
		$output['id'] = $kodetampil;
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}


	
}	


		