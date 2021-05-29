<!DOCTYPE html>

<html>
<head>
    <title>Export Data</title>
</head>
<body>
  <?php

    header("Content-type: application/vnd-ms-excel");

    header("Content-Disposition: attachment; filename=Laporan Penjualan Bag.Gudang.xls");

  ?>
  <div class="container">
    <div class="page-header text-center">
      <h4>Laporan Penjualan<br></h4>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Supplier</th>
          <th>Admin</th>
          <th>Produk</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; foreach($penjualan as $p):?>
          <tr>
            <td><?= $no?></td>
            <td><?= $p['supp_nama']?></td>
            <td><?= $p['penj_admin']?></td>
            <td><?= $p['prod_nama']?></td>
            <td><?= $p['pede_jumlah']?></td>
          </tr>
        <?php $no++;endforeach;?>
      </tbody>
    </table>
  </div>
</body>
</html>