<!DOCTYPE html>
<html><head>
	<title></title>
</head><body>
<h1>LAPORAN PENGADAAN</h1>
<hr>
<table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
<thead>
 <tr>
	<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">ID</th>
	<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">Total Harga</th>	
<!-- 	<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">Dibayar</th>
	<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 15%;">Sisa</th> -->
	<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">Keterangan</th>
	<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">Tanggal</th>
	<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">Status</th>
 </tr>
</thead>

<tbody>
	<?php $no=1; foreach($list as $q):?>
	<?php
		$detail = $this->db->join('produk b','b.prod_id = a.pend_prod_id')->get_where('pengadaan_detail a', array('a.pend_peng_id' => $q['peng_id']))->result_array();
	?>
	<tr>
		<td style="border: 1px solid black; text-align: center;"><?=$q['peng_id']?></td>
		<td style="border: 1px solid black; text-align: center;"><?=$this->libs->rupiah_non($q['peng_total_harga'])?></td>
<!-- 		<td style="border: 1px solid black; text-align: center;"><?=$this->libs->rupiah_non($q['peng_dibayar'])?></td>
		<td style="border: 1px solid black; text-align: center;"><?=$this->libs->rupiah_non($q['peng_sisa'])?></td> -->
		<td style="border: 1px solid black; text-align: center;"><?=$q['peng_keterangan']?></td>
		<td style="border: 1px solid black; text-align: center;"><?=$q['peng_tanggal']?></td>
		<td style="border: 1px solid black; text-align: center;"><?=$q['peng_status']?></td>
	</tr>
	<?php foreach ($detail as $d):?>
		<tr style="">
			<td style="border: 1px solid black; text-align: center;"></td>
<!-- 			<td style="border: 1px solid black; text-align: center;"></td>
			<td style="border: 1px solid black; text-align: center;"></td> -->
			<td style="border: 1px solid black; text-align: center;"><b style="font-size: 10px; ">Produk: </b> <span style="text-align: right;"><?=$d['prod_nama']?></span></td>
			<td style="border: 1px solid black; text-align: right;"><b style="font-size: 10px; ">Qty: </b> <?=$d['pend_jumlah']?></td>
			<td style="border: 1px solid black; text-align: right;"><b style="font-size: 10px; ">Harga: </b> <?=$this->libs->rupiah_non($d['pend_harga'])?></td>
			<td style="border: 1px solid black; text-align: right;"><b style="font-size: 10px; ">T. Harga: </b> <?=$this->libs->rupiah_non($d['pend_total_harga'])?></td>
		</tr>
	<?php endforeach;?>
	<tr style="height: 10px;">
		<td style="color: white;">a</td>
		<!-- <td style="color: white;">a</td>
		<td style="color: white;">a</td> -->
		<td style="color: white;">a</td>
		<td style="color: white;">a</td>
		<td style="color: white;">a</td>
		<td style="color: white;">a</td>
	</tr>
	<?php $no++; endforeach;?>
</tbody>
</table>
</body></html>