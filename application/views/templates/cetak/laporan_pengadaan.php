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
	<th>Total Harga</th>	
	<th>Sisa</th>
	<th>Dibayar</th>
	<th>Keterangan</th>
	<th>Tanggal</th>
	<th>Status</th>
 </tr>

</thead>

<tbody>
	<?php $no=1; foreach($list as $q):?>
	<tr>
		<td><?=$q['peng_id']?></td>
		<td><?=$q['peng_total_harga']?></td>
		<td><?=$q['peng_dibayar']?></td>
		<td><?=$q['peng_sisa']?></td>
		<td><?=$q['peng_keterangan']?></td>
		<td><?=$q['peng_tanggal']?></td>
		<td><?=$q['peng_status']?></td>
	</tr>
	<?php $no++; endforeach;?>

</tbody>

</table>