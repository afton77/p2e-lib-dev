<!DOCTYPE html>
<html ng-app="myJavanTech">

  <head>
    <title>Latihan</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-3-cs/css/bootstrap.min.css">

    <!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-3-cs/css/bootstrap-responsive.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/ngDialog-master/css/ngDialog.min.css">
    <link href='http://fonts.googleapis.com/css?family=Metrophobic' rel='stylesheet' type='text/css'>


    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap-3-cs/js/bootstrap.min.js"></script>


    <script src="<?php echo base_url(); ?>assets/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
      var base_url = '<?php echo base_url(); ?>';
    </script>

    <script src="<?php echo base_url(); ?>assets/angular-1.3.16/angular.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/angular-1.3.16/angular-route.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/angular-1.3.16/angular-sanitize.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/angular-1.3.16/ui-bootstrap-tpls-0.13.0.min.js" type="text/javascript"></script>
    <!--<script src="<?php echo base_url(); ?>assets/angular-1.3.16/dialogs.min.js" type="text/javascript"></script>-->
    <script src="<?php echo base_url(); ?>assets/ngDialog-master/js/ngDialog.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/ng-file-upload-master/dist/ng-file-upload-shim.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/ng-file-upload-master/dist/ng-file-upload.min.js" type="text/javascript"></script>
    
  </head>

  <body role="document">

    <div class="container header-container">
      <div class="blog-header">
        <div class="row">

<!--          <div class="col-xs-12 col-md-2 header-image" style="text-align: center"><img alt="LIPI" src="<?php echo base_url(); ?>assets/images/lipi2.png" width="80" /></div>
          <div class="col-xs-12 col-md-8 header-title">
            <h1 class="blog-title">PERPUSTAKAAN </h1>
            <h2>PUSAT PENELITIAN EKONOMI</h2>
            <h2 class="blog-title">LEMBAGA ILMU PENGETAHUAN INDONESIA</h2>
          </div>
          <div class="col-xs-12 col-md-2">
            <?php echo '<center><h4>' . date('D, d-m-Y') . '</h4></center>'; ?>
          </div>-->
        </div>
      </div>
    </div>
    <!-- Fixed navbar -->

    <nav class="navbar navbar-inverse navbar-fixed-top">
      
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">KATALOG PERPUSTAKAAN</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php
            if ($this->session->userdata('p2e.javantech.com')) {
              ?>
              <li class="dropdown"><a data-toggle="dropdown" class="dropdown" role="button" href="#">ADMIN<b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  <li class="<?php
                  if (preg_match('/beranda/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a href="<?php echo base_url(); ?>beranda/manage/">BERANDA</a></li>
                  <li class="<?php
                  if (preg_match('/laporanpenelitian/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a href="<?php echo base_url(); ?>laporanpenelitian/manage/">LAPORAN PENELITIAN</a></li>
                  <li class="<?php
                  if (preg_match('/karyapeneliti/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a href="<?php echo base_url(); ?>karyapeneliti/manage/">KARYA PENELITI</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">DATA</li>
                  <li class="<?php
                  if (preg_match('/datastatistik/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a href="<?php echo base_url(); ?>datastatistik/manage/">DATA STATISTIK</a></li>
                  <li class="<?php
                  if (preg_match('/transkrip/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a href="<?php echo base_url(); ?>transkrip/manage/">TRANSKRIP WAWANCARA</a></li>
                  <li class="<?php
                  if (preg_match('/fgd/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a href="<?php echo base_url(); ?>fgd/manage/">FGD</a></li>
                  <li class="divider"></li>
                  <li class="<?php
                  if (preg_match('/kajianstrategis/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a class="active " href="<?php echo base_url(); ?>kajianstrategis/manage/">PUBLIKASI</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">LAIN-LAIN</li>
                  <li class="<?php
                  if (preg_match('/formrequest/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a class="active " href="<?php echo base_url(); ?>formrequest/manage/">REQUEST</a></li>
                  <li class="<?php
                  if (preg_match('/level0/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a class="active " href="<?php echo base_url(); ?>level0/manage/">LEVEL A</a></li>
                  <li class="<?php
                  if (preg_match('/level1/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a class="active " href="<?php echo base_url(); ?>level1/manage/">LEVEL B</a></li>
                  <li class="<?php
                  if (preg_match('/tahun/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a class="active " href="<?php echo base_url(); ?>tahun/manage/">TAHUN</a></li>
                  <li class="<?php
                  if (preg_match('/userlevel/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a class="active " href="<?php echo base_url(); ?>userlevel/manage/">USER LEVEL</a></li>
                  <li class="divider"></li>
                  <li class="<?php
                  if (preg_match('/admins/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a class="active " href="<?php echo base_url(); ?>admins/manage/">USER MANAGEMENT</a></li>

                </ul>
              </li>

              <?php
            } else {
              ?>
              <li class="<?php
              if (preg_match('/beranda/', uri_string())) {
                echo " active ";
              }
              ?>"><a href="<?php echo base_url(); ?>beranda/">BERANDA</a></li>
              <li class="<?php
              if (preg_match('/laporanpenelitian/', uri_string())) {
                echo " active ";
              }
              ?>"><a href="<?php echo base_url(); ?>laporanpenelitian/">LAPORAN PENELITIAN</a></li>
              <li class="<?php
              if (preg_match('/karyapeneliti/', uri_string())) {
                echo " active ";
              }
              ?>"><a href="<?php echo base_url(); ?>karyapeneliti/">KARYA PENELITI</a></li>
              <li class="dropdown"><a data-toggle="dropdown" class="dropdown" role="button" href="#">DATA<b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  <li class="<?php
                  if (preg_match('/datastatistik/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a href="<?php echo base_url(); ?>datastatistik/">DATA STATISTIK</a></li>
                  <li class="<?php
                  if (preg_match('/transkrip/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a href="<?php echo base_url(); ?>transkrip/">TRANSKRIP WAWANCARA</a></li>
                  <li class="<?php
                  if (preg_match('/fgd/', uri_string())) {
                    echo " active ";
                  }
                  ?>"><a href="<?php echo base_url(); ?>fgd/">FGD</a></li>

                </ul>
              </li>
              <li class="<?php
              if (preg_match('/kajianstrategis/', uri_string())) {
                echo " active ";
              }
              ?>"><a class="active " href="<?php echo base_url(); ?>kajianstrategis/">PUBLIKASI</a></li>

              <?php
            }
            $session = $this->session->userdata('p2e.javantech.com');
            if ($session) {
              echo '<li class=""><a class="active " href="' . base_url() . 'admins/logout">Logout</a></li>';
            } else {
              echo '<li class=""><a class="active " href="' . base_url() . 'login">Login</a></li>';
            }
            ?>
            <!--<li class="<?php
            if (preg_match('/beritaekonomi/', uri_string())) {
              echo "active";
            }
            ?>"><a class="active " href="<?php echo base_url(); ?>beritaekonomi/">BERITA EKONOMI</a></li>-->
          </ul>

        </div>
      </div>
    </nav>
    <!-- Fixed navbar (END) -->

    