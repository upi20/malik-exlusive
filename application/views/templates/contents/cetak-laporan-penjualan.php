<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?=$this->setting->index()['app_title']?></title>
    <link rel="icon" type="image/ico" href="<?=base_url()?>assets/admin/non-angular/assets/images/favicon.ico" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <!-- ============================================
    ================= Stylesheets ===================
    ============================================= -->
    <!-- vendor css files -->
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/animate.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/morris/morris.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/rickshaw/rickshaw.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/datatables.bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/chosen/chosen.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/summernote/summernote.css">

    <!-- project main css files -->
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/toastr/toastr.min.css"> <!-- fungsi alert -->
    <link rel="stylesheet" href="<?=base_url()?>assets/admin/non-angular/assets/css/main.css">
    <!--/ stylesheets -->
    <style>
      .page-header h4 {
        line-height: 25px;
      }
    </style>
  <!-- jQuery 3 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/bootstrap/bootstrap.min.js"></script>

    <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jRespond/jRespond.min.js"></script>

    <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

    <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

    <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/daterangepicker/daterangepicker.js"></script>

    <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/screenfull/screenfull.min.js"></script>

  <script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/toastr/toastr.min.js"></script> 

    <!-- ============================================
    ============== Custom JavaScripts ===============
    ============================================= -->
    <script src="<?=base_url()?>assets/admin/non-angular/assets/js/main.js"></script>
  <script>
    $(document).ready(function(){
      window.print();
    });
  </script>
</head>
<body>
  <div class="container">
    <div class="page-header text-center">
      <h4>Laporan Penjualan<br></h4>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Total Harga</th>
          <th>Dibayar</th>
          <th>Sisa</th>
          <th>Tanggal Transaksi</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($penjualan as $p):?>
          <tr>
            <td><?=$p['penj_id']?></td>
            <td style="text-align: right;"><?=$this->libs->rupiah_non($p['penj_total_harga'])?></td>
            <td style="text-align: right;"><?=$this->libs->rupiah_non($p['penj_dibayar'])?></td>
            <td style="text-align: right;"><?=$this->libs->rupiah_non($p['penj_sisa'])?></td>
            <td><?=$p['penj_tanggal']?></td>
            <td><?=$p['penj_keterangan']?></td>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table><br><br>
    <div class="pull-right">
      <p>Padang, <?php echo date('d M Y');?><br>
        Mengetahui,<br><br><br><br><br>(.........Manager.........)</p>
    </div>
  </div>
</body>
</html>