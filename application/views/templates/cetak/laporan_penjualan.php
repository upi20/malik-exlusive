<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">

<thead>

 <tr>
	<th>No</th>
	<th>ID</th>
	<!-- <th>Kondisi</th> -->
	<th>Tanggal</th>
	<th>Toko</th>
	<th>Kategori</th>
	<th>Produk</th>
	<th>Harga</th>
	<th>Jumlah</th>
	<th>Total</th>
	<th>Vendor</th>
	<th>Nama Konsumen</th>
	<th>No Hp Konsumen</th>
	<th>Alamat Konsumen</th>
	<th>Status Pembayaran</th>
	<th>Status Kirim</th>
	<th>Tanggal Kirim</th>
	<th>Tanggal Retur</th>
	<th>Keterangan</th>
 </tr>

</thead>

<tbody>
	<?php $no=1; foreach($list as $q):?>
	<tr>
		<td><?=$no?></td>
		<td><?=$q['penj_id']?></td>
		<td><?=$q['penj_tanggal']?></td>
		<td><?=$q['toko']?></td>
		<td><?=$q['kate_nama']?></td>
		<td><?=$q['prod_nama']?></td>
		<td><?=$q['pede_harga']?></td>
		<td><?=$q['pede_jumlah']?></td>
		<td><?=$q['pede_total_harga']?></td>
		<td><?=$q['supp_nama']?></td>
		<td><?=$q['penj_nama']?></td>
		<td><?=$q['penj_no_hp']?></td>
		<td><?=$q['penj_alamat']?></td>
		<td><?=$q['penj_status']?></td>
		<td><?=$q['pede_status_pengiriman']?></td>
		<td><?=$q['pede_tanggal_kirim']?></td>
		<td><?=$q['pede_tanggal_retur']?></td>
		<td><?=$q['penj_keterangan']?></td>
	</tr>
	<?php $no++; endforeach;?>

</tbody>

</table>