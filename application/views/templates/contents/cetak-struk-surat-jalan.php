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

    <style>
      .page-header h4 {
        line-height: 25px;
      }
    </style>
  <!-- jQuery 3 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?=base_url()?>assets/admin/non-angular/assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>
    <style type="text/css" media="print">
      @page { size: landscape; }
    </style>
  <script>
    $(document).ready(function(){
      window.print();
    });
  </script>
</head>
<body>
  <div class="container" style="margin-top: -40px;">
    <div class="page-header" style="border-bottom: none;">
      <table style="width: 100%;">
        <tr>
          <td style="text-align: center;">
            <h2 style="font-size: 24px;">
              <b>
                NOTA SURAT JALAN
              </b>
            </h2>
          </td>
        </tr>
      </table>
      <table style="width: 100%; margin-top: -10px;">
        <tr>
          <td width="45%">
            <h2>
              <b>
                PT. PUTRA MANDIRI PALAS
              </b>
            </h2>
            <p style="margin-top: -8px;">
              JL BALI DHARMA, DS BALI AGUNG KEC PALAS, LAM SEL
            </p>
            <p style="margin-top: -10px;">
              TELP. 082181258852 / 08117972005
            </p>
            <br>
            <br>
          </td>
          <td width="40%" style="float: right;">
            <h2 style="text-align: right;">
              <b>
                Kalianda, <?php echo date('d/M/Y');?>
              </b>
            </h2>
            <h2 style="text-align: right;"><b>Faktur: <?=$id?></b></h2>          
            <br>
          </td>
        </tr>
      </table>
    </div>
    <table style="width: 100%; margin-top: -70px;">
      <tr>
        <td style="width: 33.3%;">
          <h2 style="text-align: left;"><b>Vehicles: <?=$penjualan['penj_kendaraan']?></b></h2>          
        </td>
        <td style="width: 33.3%;">
          <h2 style="text-align: center;"><b>Supir: <?=$penjualan['penj_driver']?></b></h2>          
        </td>
        <td style="width: 33.3%;">
          <h2 style="text-align: right;"><b>Customer: <?=$penjualan['penj_nama']?></b></h2>          
        </td>
      </tr>
    </table>
    <table class="table table-custom table-bordered" id="advanced-usage">
      <thead>
      <tr>
        <th style="text-align: left;">Nama Barang</th>
        <th colspan="2" style="text-align: center;">Banyaknya</th>
      </tr>
      </thead>
      <tbody>
          <?php $total_item = count($detail); foreach($detail as $q):?>
          <tr >
            <td><?=$q['prod_nama']?></td>
            <td><?=$q['pede_jumlah']?></td>
            <td><?=$q['prod_special']?></td>
          </tr>
          <?php endforeach;?>
      </tbody>
    </table><br><br><br>
    <table style="width: 100%;">
      <tr>
        <td style="width: 33.3%; text-align: center;">
          <p>CASHIER<br><br><br>(...................................................)</p>
        </td>
        <td style="width: 33.3%; text-align: center;">

        </td>
        <td style="width: 33.3%; text-align: center;">
          <p>CUSTOMER<br><br><br>(...................................................)</p>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>