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
  <div class="container">
    <div class="page-header">
      <table style="width: 100%">
        <tr>
          <td width="50%">
            <h2>
              <b>
                PT. PUTRA MANDIRI PALAS FARM
              </b>
            </h2>
            <p>
              JL BALI DHARMA, DS BALI AGUNG KEC PALAS, LAM SEL
            </p>
            <p>
              TELP. 082181258852 / 08117972005
            </p>
            <br>
          </td>
          <td width="50%" style="float: right;">
            <h2 style="text-align: right;">
              <b>
                Kalianda, <?php echo date('d/M/Y');?>
              </b>
            </h2>
            <br>
          </td>
        </tr>
      </table>
    </div>
    <br>
    <table style="width: 100%">
      <tr>
        <td style="width: 10%; font-size: 20px;">Nama</td>
        <td style="width: 1%; font-size: 20px;">:</td>
        <td style="width: 30%; font-size: 20px;"><b><?=$karyawan['nama']?></b></td>

        <td style="width: 8%; font-size: 20px;"></td>

        <td style="width: 15%; font-size: 20px;">Total Hutang</td>
        <td style="width: 1%; font-size: 20px;">:</td>
        <td style="width: 30%; font-size: 20px;"><b><?=$this->libs->rupiah($karyawan['total_hutang'])?></b></td>
      </tr>
      <tr>
        <td style="width: 10%; font-size: 20px;">Alamat</td>
        <td style="width: 1%; font-size: 20px;">:</td>
        <td style="width: 30%; font-size: 20px;"><b><?=$karyawan['alamat']?></b></td>
        <td style="width: 8%; font-size: 20px;"></td>
        <td style="width: 15%; font-size: 20px;">Dibayar</td>
        <td style="width: 1%; font-size: 20px;">:</td>
        <td style="width: 30%; font-size: 20px;"><b><?=$this->libs->rupiah($karyawan['dibayar'])?></b></td>
      </tr>
      <tr>
        <td style="width: 10%; font-size: 20px;">No. HP</td>
        <td style="width: 1%; font-size: 20px;">:</td>
        <td style="width: 30%; font-size: 20px;"><b><?=$karyawan['no_hp']?></b></td>
        <td style="width: 8%; font-size: 20px;"></td>
        <td style="width: 15%; font-size: 20px;">Sisa</td>
        <td style="width: 1%; font-size: 20px;">:</td>
        <td style="width: 30%; font-size: 20px;"><b><?=$this->libs->rupiah($karyawan['sisa'])?></b></td>
      </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table style="width: 100%;">
      <tr>
        <td style="width: 33.3%; text-align: center;">
          <p style="font-size: 20px;">Penerima<br><br><br><br><br><br><br>(<?=$karyawan['nama']?>)</p>
        </td>
        <td style="width: 33.3%; text-align: center;">
        </td>
        <td style="width: 33.3%; text-align: center;">
          <p style="font-size: 20px;">HRD<br><br><br><br><br><br><br>(...................................................)</p>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>