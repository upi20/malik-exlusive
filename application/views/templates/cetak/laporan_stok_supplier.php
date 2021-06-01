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
			<th>Produk</th>
			<th>Supplier</th>
			<th>Jumlah</th>

		</tr>

	</thead>

	<tbody>
		<?php if ($data) :
			$nomor = 1;
			foreach ($data as $d) : ?>
				<tr>
					<td><?= $nomor ?></td>
					<td><?= $d['prod_nama'] ?></td>
					<td><?= $d['supp_nama'] ?></td>
					<td><?= $d['jumlah'] ?></td>
				</tr>
		<?php $nomor++;
			endforeach;
		endif; ?>
	</tbody>

</table>