<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table border="1" width="100%">

<thead>

 <tr>
	<th>ID</th>
	<th>ID penjualan</th>
	<th>Total Harga</th>
	<th>Nominal</th>
	<th>Sisa</th>
	<th>Tanggal</th>
 </tr>

</thead>

<tbody>
	<?php $no=1; foreach($list as $q):?>
	<tr>
		<td><?=$q['pemb_id']?></td>
		<td><?=$q['pemb_penj_id']?></td>
		<td><?=$q['pemb_total_harga']?></td>
		<td><?=$q['pemb_nominal']?></td>
		<td><?=$q['pemb_sisa']?></td>
		<td><?=$q['pemb_tanggal']?></td>
	</tr>
	<?php $no++; endforeach;?>

</tbody>

</table>