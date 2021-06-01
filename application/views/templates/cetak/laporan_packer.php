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
			<th>Penjualan Id</th>
			<th>Penjualan Toko Id</th>
			<th>Penjualan User Id</th>
			<th>Penjualan Pack Id</th>
			<th>Penjualan Nama</th>
			<th>Penjualan No Hp</th>
			<th>Penjualan Alamat</th>
			<th>Penjualan Total Harga</th>
			<th>Penjualan Dibayar</th>
			<th>Penjualan Sisa</th>
			<th>Penjualan Status</th>
			<th>Penjualan Lokasi</th>
			<th>Penjualan Tanggal</th>
			<th>Penjualan Driver</th>
			<th>Penjualan Tanggal Pengiriman</th>
			<th>Penjualan Status Pengiriman</th>
			<th>Penjualan Keterangan</th>
			<th>Penjualan Awal</th>
			<th>Penjualan Akhir</th>
			<th>Penjualan Kondisi</th>
			<th>Penjualan Kendaraan</th>
			<th>Penjualan No Resi</th>
			<th>Penjualan Kurir</th>
			<th>Penjualan Admin</th>
			<th>Penjualan Berkas</th>
			<th>Packer kode</th>
			<th>Packer nama</th>
			<th>Packer email</th>
			<th>Packer telepon</th>
			<th>Packer alamat</th>
			<th>Packer status</th>
		</tr>

	</thead>

	<tbody>
		<?php if ($data) :
			$nomor = 1;
			foreach ($data as $d) : ?>
				<tr>
					<td><?= $nomor ?></td>
					<td><?= $d['penj_id'] ?></td>
					<td><?= $d['penj_toko_id'] ?></td>
					<td><?= $d['penj_user_id'] ?></td>
					<td><?= $d['penj_pack_id'] ?></td>
					<td><?= $d['penj_nama'] ?></td>
					<td><?= $d['penj_no_hp'] ?></td>
					<td><?= $d['penj_alamat'] ?></td>
					<td><?= $d['penj_total_harga'] ?></td>
					<td><?= $d['penj_dibayar'] ?></td>
					<td><?= $d['penj_sisa'] ?></td>
					<td><?= $d['penj_status'] ?></td>
					<td><?= $d['penj_lokasi'] ?></td>
					<td><?= $d['penj_tanggal'] ?></td>
					<td><?= $d['penj_driver'] ?></td>
					<td><?= $d['penj_tanggal_pengiriman'] ?></td>
					<td><?= $d['penj_status_pengiriman'] ?></td>
					<td><?= $d['penj_keterangan'] ?></td>
					<td><?= $d['penj_awal'] ?></td>
					<td><?= $d['penj_akhir'] ?></td>
					<td><?= $d['penj_kondisi'] ?></td>
					<td><?= $d['penj_kendaraan'] ?></td>
					<td><?= $d['penj_no_resi'] ?></td>
					<td><?= $d['penj_kurir'] ?></td>
					<td><?= $d['penj_admin'] ?></td>
					<td><?= $d['penj_berkas'] ?></td>
					<td><?= $d['pack_kode'] ?></td>
					<td><?= $d['pack_nama'] ?></td>
					<td><?= $d['pack_email'] ?></td>
					<td style="mso-number-format:\@;"><?= $d['pack_telepon'] ?></td>
					<td><?= $d['pack_alamat'] ?></td>
					<td><?= $d['pack_status'] ?></td>
				</tr>
		<?php $nomor++;
			endforeach;
		endif; ?>
	</tbody>

</table>