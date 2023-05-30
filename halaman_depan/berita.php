<?php $koneksi = mysqli_connect("localhost", "root", "", "db");
session_start();
$id = "";
$title = "";
$gambar = "";
$halaman = "";
$tanggal = "";
$sukses = "";
$error = "";
$koneksi = mysqli_connect("localhost", "root", "", "db");

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = " ";
}
if($op == 'delete'){
    $id  = $_GET ['id'];
    $sql1 = "delete from berita where id = '$id'";
    $q1   = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "berhasil hapus data";
    }else{
        $error = "Gagal melakukan hapus data";
    }
}
if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "select * from berita where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $title = $r1['title'];
    $gambar = $r1['gambar'];
    $halaman = $r1['halaman'];

    if ($title == '') {
        $error = "Data Tidak Ditemukan";
    }
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $gambar = $_FILES['gambar']['name'];
    $direktori = "berita/";
    $halaman = $_POST['halaman'];
    $tanggal = date("Y-m-d H:i:s");
    move_uploaded_file($_FILES['gambar']['tmp_name'], $direktori . $gambar);
    mysqli_query($koneksi, "insert into dokomen set file='$gambar'");
    $sukses = "Berhasil memasukan data baru";

    if ($title && $gambar && $halaman && $tanggal) {//update
        if ($op == 'edit') {
            $sql1 = "update berita set title = '$title',gambar = '$gambar',halaman = '$halaman' where id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error = "Data gagal di update";
            }
        } else { //insert
            $sql1 = "insert into berita(title,gambar,halaman,tanggal) values ('$title','$gambar','$halaman','$tanggal')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukan data baru";
            } else {
                $errors = "Gagal Memasukan Data";
            }
        }

    } else {
        $error = "Lengkapi berita anda !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Berita - Website Resmi Kelurahan Telaga Asih</title>
    <meta content="Website Resmi Kelurahan Telaga Asih" name="description">
    <meta content="Kelurahan Telaga Asih" name="keywords">
    <meta name="author" content="Kelurahan Telaga Asih">
    <meta property="og:type" content="website" />
    <!-- Favicons -->
    <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets/img/logo.ico" rel="icon">
    <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- flexslider -->
    <!-- Syntax Highlighter -->
    <!-- <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/css/shCore.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/css/shThemeDefault.css" rel="stylesheet" type="text/css" />

    <!-- <link rel="stylesheet" href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/css/demo.css" type="text/css" media="screen" /> -->
    <link rel="stylesheet" href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/css/flexslider.css" type="text/css" media="screen" />
    <!-- Modernizr -->
    <!-- <script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/js/modernizr.js"></script> -->

    <!-- end flexslider -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

    <!-- capcay -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">




    <!-- Template Main CSS File -->
    <link href="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/css/style.css" rel="stylesheet">

    <!-- Bootstrap core JS-->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Third party plugin JS-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script> -->
    <!-- Vendor JS Files -->


    <!-- =======================================================
  * Template Name: Lumia - v2.2.1
  * Template URL: https://bootstrapmade.com/lumia-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center text-white" style="background-color: #37517e;">
        <div class="container d-flex align-items-center">
            <div class="row mr-auto">
                <img src="https://dev.bekasikab.go.id/telagaasih/vendor/assets/img/logokab70x70.png" style="float: left; max-height: 50px;" alt="">
                <span style="font-weight:bold;margin-top: 10px;"> Kelurahan Telaga Asih</span>
            </div>
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="drop-down"><a class="btn btn-light">Menu</a>
                        <ul>
                            <li><a href="https://dev.bekasikab.go.id/telagaasih/">Beranda</a></li>
                            <li class="drop-down"><a>Profil</a>
                                <ul>
                                    <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/tentang">Tentang</a></li>
                                    <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/visi">Visi dan Misi</a></li>
                                    <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/struktur">Struktur Organisasi</a></li>
                                    <li class="drop-down"><a>Kondisi</a>
                                        <ul>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_kondisi/kondisi-demografi">Kondisi Demografi</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_kondisi/kondisi-geografis">Kondisi Geografis</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_kondisi/kondisi-keagamaan">Kondisi Keagamaan</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_kondisi/kondisi-kesehatan">Kondisi Kesehatan</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_kondisi/kondisi-pendidikan">Kondisi Pendidikan</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_kondisi/kondisi-pertanian">Kondisi Pertanian</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_kondisi/kondisi-perikanan">Kondisi Perikanan</a></li>
                                                                                    </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="drop-down"><a>Layanan</a>
                                <ul>
                                    <li class="drop-down"><a>Daftar Layanan</a>
                                        <ul>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-keterangan-tidak-mampu">Surat Keterangan Tidak Mampu</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-keterangan-domisili-haji">Surat Keterangan Domisili Haji</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-keterangan-proposal">Surat Keterangan Proposal</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-keterangan-domisili-yayasan">Surat Keterangan Domisili Yayasan</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-keterangan-ahli-waris">Surat Keterangan Ahli Waris</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/akta-jual-beli-tanah">Akta Jual Beli Tanah</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/pencatatan-surat-keterangan-waris">Pencatatan Surat Keterangan Waris</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-keterangan-pengantar-skck">Surat Keterangan Pengantar SKCK</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-keterangan-izin-keramaian">Surat Keterangan Izin Keramaian</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-izin-spanduk-dan-umbul-umbul">Surat Izin Spanduk dan Umbul Umbul</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-keteranga-domisili-lembaga/ormas/organisasi-keagamaan">Surat Keteranga Domisili Lembaga/Ormas/Organisasi Keagamaan</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/surat-pengantar-rekomendasi-pembangunan">Surat Pengantar Rekomendasi Pembangunan</a></li>
                                                                                            <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/baca_layanan/izin-usaha-pendirian-pusat-kegiatan-belajar-masyarakat">Izin Usaha Pendirian Pusat Kegiatan Belajar Masyarakat</a></li>
                                                                                    </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="drop-down"><a>Publik</a>
                                <ul>
                                    <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/pengaduan">Pengaduan</a></li>
                                    <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/news">Berita</a></li>
                                    <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/galeri">Galeri</a></li>
                                    <li><a href="https://dev.bekasikab.go.id/telagaasih/beranda/dokumen">Dokumen</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                </ul>
            </nav><!-- .nav-menu -->

            <div class="header-social-links" hidden>
                <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
                <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
                <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
                <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
            </div>

        </div>
    </header><!-- End Header --><body>
    <section class="page-section">
        <div class="container" style="margin-top: 25px;">
            <div class="row">
                <!-- utama -->
                <div class="col-sm-8 animate__animated animate__fadeInTopLeft animate__slow 2s">
                    <div class="text-center">
                        <h2 class="text-uppercase">Berita</h2>
                        <hr />
                    </div>
                    <div class="col-sm-12">
                    <?php
                                            $query = "SELECT * FROM berita ORDER BY id ASC";
                                            $result = mysqli_query($koneksi, $query);
                                            //mengecek apakah ada error ketika menjalankan query
                                            if (!$result) {
                                                die("Query Error: " . mysqli_errno($koneksi) .
                                                    " - " . mysqli_error($koneksi));
                                            }

                                            //buat perulangan untuk element tabel dari data mahasiswa
                                            $no = 1; //variabel untuk membuat nomor urut
                                            // hasil query akan disimpan dalam variabel $data dalam bentuk array
                                            // kemudian dicetak dengan perulangan while
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <br>
                            <h2><?php echo $row ['title'] ?></h2>
                            <small><i class="icofont-calendar"> </i> <?php  echo $row['tanggal']?>| <i class="icofont-eye-alt"></i> Views: 66 | <i class="icofont-law-document"></i><?=$_SESSION['user_full_name']?></small>
                            <img class="img-fluid img-thumbnail" src="../berita/<?php echo $row['gambar']; ?>">
                            <br>
                            <p class="text text-justify">
                            <?php echo $row ['halaman'] ?>
                            <a class="btn btn-primary btn-sm" href="">Baca selengkapnya </a>
                            <br>
                                                <br>
                        <div class="col-sm-12">
                            <!--Tampilkan pagination-->
                                                    </div>
                    </div>
                    <?php
                                                $no++; //untuk nomor urut terus bertambah 1
                                            }

                                            ?>
                </div>
                <!-- widget -->
                <div class="col-sm-4 animate__animated animate__fadeInBottomRight animate__slower 2s">
                    <div class="col-sm-12 text-center text-bold text-white " style="background: #007bff; padding: 15px;">
                        <h5>Berita Populer</h5>
                    
                                       
                    </div>
                    <div class="col-sm-12 border border-gray">
                        <br>
                       
                  <div class="list-group">
                  <?php
                                            $query = "SELECT * FROM berita ORDER BY id ASC";
                                            $result = mysqli_query($koneksi, $query);
                                            //mengecek apakah ada error ketika menjalankan query
                                            if (!$result) {
                                                die("Query Error: " . mysqli_errno($koneksi) .
                                                    " - " . mysqli_error($koneksi));
                                            }

                                            //buat perulangan untuk element tabel dari data mahasiswa
                                            $no = 1; //variabel untuk membuat nomor urut
                                            // hasil query akan disimpan dalam variabel $data dalam bentuk array
                                            // kemudian dicetak dengan perulangan while
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                              <a href="berita.php?op=view&id=<?php echo $row['id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-between">
                                <img class="img img-fluid img-blog" alt="" src="../berita/<?php echo $row['gambar']; ?>" width="100px">
                              </div>
                              <h5 class="mb-1"><?php echo $row['title']; ?></h5>
                                  <small class="text text-xs"><?php echo $row['tanggal']; ?></small><br>
                              <small><i class="icofont-eye-alt"></i> Views: 57 | <i class="icofont-law-document"></i><?=$_SESSION['user_full_name']?></small>
                          </a>
                        </div>
                  <?php
                                                $no++; //untuk nomor urut terus bertambah 1
                                            }

                                            ?>
                  <br>
                </div>
                    <br>

                    <div class="col-sm-12">
                        <br>
                        <div id="gpr-kominfo-widget-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body><!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Kelurahan Telaga Asih</h3>
                    <p>
                        Kelurahan Telaga Asih ,Kabupaten Bekasi, Jawa Barat                        <br>
                        <strong>Telepon:</strong> 021<br>
                        <strong>Email:</strong> <br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">

                </div>

                <div class="col-lg-3 col-md-6 footer-links">

                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Lokasi Kami</h4>
                    <iframe src="" width="320" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <!-- <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
    <form action="" method="post">
      <input type="email" name="email"><input type="submit" value="Subscribe">
    </form> -->
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="mr-md-auto text-center text-md-left">
            <div class="copyright">
                &copy; Copyright <strong><span>DISKOMINFOSANTIK KABUPATEN BEKASI</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <a href="https://bootstrapmade.com/lumia-bootstrap-business-template/" target="_blank">Modify from</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#!" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#!" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#!" class="instagram"><i class="bx bxl-instagram"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->
<a href="#" class="back-to-top animate__animated animate__fadeInDownBig animated__slower"><i class="icofont-simple-up"></i></a>


<!-- <script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/jquery/jquery.min.js"></script> -->
<!-- <script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/php-email-form/validate.js"></script>
<script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/counterup/counterup.min.js"></script>
<script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/venobox/venobox.min.js"></script>
<script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/vendor/owl.carousel/owl.carousel.min.js"></script> -->


<!-- FlexSlider -->
<script defer src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/js/jquery.flexslider.js"></script>
<!-- Syntax Highlighter -->
<script type="text/javascript" src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/js/shCore.js"></script>
<script type="text/javascript" src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/js/shBrushXml.js"></script>
<script type="text/javascript" src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/js/shBrushJScript.js"></script>

<!-- Optional FlexSlider Additions -->
<script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/js/jquery.easing.js"></script>
<script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/js/jquery.mousewheel.js"></script>
<script defer src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/flexslider/js/demo.js"></script>

<!-- info kopid -->
<script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>

<!-- Template Main JS File -->
<!-- <script src="https://dev.bekasikab.go.id/telagaasih/vendor/assets_lu/js/main.js"></script> -->


<script>
    // $('#popup').modal('toggle');

    $(window).on('load', function() {
        // flexslider
        $(function() {
            SyntaxHighlighter.all();
        });

        $('#carouselfx').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: true,
            slideshow: false,
            mousewheel: true,
            itemMargin: 2,
            asNavFor: '#sliderfx'
        });

        $('#sliderfx').flexslider({
            animation: "slide",
            controlNav: true,
            animationLoop: true,
            slideshow: true,
            mousewheel: false,
            sync: "#carouselfx",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });

        $('.carousel').carousel({
            touch: true,
            keyboard: true,
            pause: false
        });

        // capcay
    });
</script>
</body>

</html>