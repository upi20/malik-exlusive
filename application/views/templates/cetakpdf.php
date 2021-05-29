<!DOCTYPE html>
<html><head>
	<title></title>
</head><body>
	<h1>LAPORAN PENJUALAN</h1>
	<hr>
<table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
	<thead>
	<tr>
		<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">ID</th>
		<th style="border: 1px solid black; background-color: MediumSeaGreen;">Total Harga</th>
		<th style="border: 1px solid black; background-color: MediumSeaGreen;">Dibayar</th>
		<th style="border: 1px solid black; background-color: MediumSeaGreen;">Sisa</th>
		<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">Tanggal Transaksi</th>
		<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">Tanggal Pengiriman</th>
		<th style="border: 1px solid black; background-color: MediumSeaGreen; width: 10%;">Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($list as $data) { ?>
			<tr>
				<td style="border: 1px solid black; text-align: center;"><?=$data['penj_id'] ?></td>
				<td style="border: 1px solid black; text-align: right;"><?=$this->libs->rupiah_non($data['penj_total_harga']) ?></td>
				<td style="border: 1px solid black; text-align: right;"><?=$this->libs->rupiah_non($data['penj_dibayar']) ?></td>
				<td style="border: 1px solid black; text-align: right;"><?=$this->libs->rupiah_non($data['penj_sisa']) ?></td>
				<td style="border: 1px solid black; text-align: center;"><?=$data['penj_tanggal'] ?></td>
				<td style="border: 1px solid black; text-align: center;"><?=$data['penj_tanggal_pengiriman'] ?></td>
				<td style="border: 1px solid black; text-align: center;"><?=$data['penj_keterangan'] ?></td>
			</tr>

		<?php	} ?> 
		
	</tbody>
</table>
</body></html>