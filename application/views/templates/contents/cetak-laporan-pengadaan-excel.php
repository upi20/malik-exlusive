<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=Laporan Pengadaan.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>




<h4>Laporan Pengadaan<br></h4>
<table border="1" width="100%">

  <tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Produk</th>
    <th>Jumlah</th>
    <th>Harga</th>
    <th>Total Harga</th>
    <th>Berat</th>
    <th>Vendor</th>
  </tr>

  <?php foreach ($pengadaan as $p) : ?>
    <tr>
      <td><?= $p['peng_id'] ?></td>
      <td><?= $p['peng_tanggal'] ?></td>
      <td><?= $p['prod_nama'] ?></td>
      <td><?= $p['pend_jumlah'] ?></td>
      <td style="text-align: right;"><?= $this->libs->rupiah_non($p['pend_harga']) ?></td>
      <td style="text-align: right;"><?= $this->libs->rupiah_non($p['pend_total_harga']) ?></td>
      <td><?= $p['pend_berat'] ?></td>
      <td><?= $p['supp_nama'] ?></td>
    </tr>
  <?php endforeach; ?>

</table>