<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CetakEvakuasi_model extends CI_Model {

	public function get_lapor()
    {
        $query = $this->db->get('lapor');
        return $query->result_array();

    }
		public function getLapor($id){
			$sql = "select a.*,b.*,c.keja_nama,d.regu_nama, f.refs_id, f.refs_nama, f.refs_keterangan, a.created_date,g.*

from lapor a,lapor_pasukan b,kejadian c,regu d,referensi_status e,referensi_status f,lapor_bap g
where b.lapa_lapo_id = a.lapo_id and
c.keja_id = a.lapo_keja_id and
d.regu_id = b.lapa_regu_id and
e.refs_id = a.lapo_status and
g.laba_lapo_id = a. lapo_id and
f.refs_id = b.lapa_status and lapo_id = '".$id."' ";
			$query = $this->db->query($sql)->row_array();
			return $query;
		}

}
