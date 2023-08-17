<?php
session_start();
include('../config.php');
if (empty($_SESSION['username'])) {
  header("location:../index.php");
}
$last = $_SESSION['username'];
$sqlupdate = "UPDATE users SET last_activity=now() WHERE username='$last'";
$queryupdate = $mysqli->query($sqlupdate);
?>
<!DOCTYPE html>
<html>
<?php
$user = $_SESSION['username'];
$query = $mysqli->query("SELECT fullname,job_title,last_activity,status FROM users WHERE username='$user'");
$data = mysqli_fetch_array($query);
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pengaduan Masyarakat Melalui Citra Bitmap</title>
  <link rel="icon" href="../img/pemas_logo.png">

  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/assets2/css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../dashboard/index.php">
        <div class="sidebar-brand-icon">
          <img src="../img/pemas_logo.png" width="35" height="35">
        </div>
        <div class="sidebar-brand-text mx-3">Pemas</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="../dashboard/index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        File
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <?php if ($data['status'] == '2') { ?>
          <a class="nav-link collapsed" href="enkripsi.php" aria-expanded="true">
            <i class="fas fa-fw fa-lock"></i>
            <span>Enkripsi</span>
          </a>

          <?php
        } else {?>

          <a class="nav-link collapsed" href="dekripsi.php" aria-expanded="true">
            <i class="fas fa-fw fa-lock-open"></i>
            <span>Dekripsi</span>
          </a>
          <a class="nav-link collapsed" href="data_pengaduan.php" aria-expanded="true">
            <i class="fas fa-fw fa-file"></i>
            <span>Data Pengaduan Masyarakat</span>
          </a>
        <?php } ?>

        

        
        <hr class="sidebar-divider">
      </li>
      <div class="sidebar-heading">
        Info
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="tentang.php" aria-expanded="true">
          <i class="fas fa-fw fa-info"></i>
          <span>Tentang Aplikasi</span>
        </a>

        <a class="nav-link collapsed" href="bantuan.php" aria-expanded="true">
          <i class="fas fa-fw fa-question-circle"></i>
          <span>Bantuan</span>
        </a>
        <hr class="sidebar-divider">
      </li>
    </ul>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <h1 class="h4 mb-0 ml-2 text-gray-800">Pengaduan Masyarakat Melalui Citra Bitmap</h1>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $data['fullname']; ?></span>
                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="tentang.php">
                  <i class="fas fa-info fa-sm fa-fw mr-2 text-gray-400"></i>
                  Tentang Aplikasi
                </a>
                <a class="dropdown-item" href="bantuan.php">
                  <i class="fas fa-question-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                  Bantuan
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

          <!-- Logout Modal-->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">Pastikan data yang sudah anda proses telah disimpan!</div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                  <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </nav>
        <!-- End of Topbar -->

        <!-- <?php
              $v = $_SESSION['username'];
              $query = $mysqli->query("SELECT * FROM users WHERE username='$v'");
              $users = mysqli_fetch_array($query);
              if ($users['status'] == 1) {
                echo '<li class="treeview"><a href="#"><i class="fa fa-file-o"></i><span>File</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="enkripsi.php"><i class="fa fa-circle-o"></i> Enkripsi</a></li>
                  <li><a href="dekripsi.php"><i class="fa fa-circle-o"></i> Dekripsi</a></li>
                </ul>
              </li>';
              } elseif ($users['status'] == 2) {
                echo "";
              } else {
                echo "";
              }
              ?> -->

        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="badge badge-pill badge-success">Aktivitas Terakhir: <?php echo $data['last_activity'] ?></h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- User Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                        User</div>
                      <?php
                      $query = $mysqli->query("SELECT count(*) totaluser FROM users");
                      $datauser = mysqli_fetch_array($query);
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $datauser['totaluser'] ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Enkripsi Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-success text-uppercase mb-1">
                        Enkripsi</div>
                      <?php
                      $query = $mysqli->query("SELECT count(*) totalenkripsi FROM enkripsi");
                      $dataenkripsi = mysqli_fetch_array($query);
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $dataenkripsi['totalenkripsi']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-lock fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-info text-uppercase mb-1">Dekripsi
                      </div>
                      <?php
                      $query = $mysqli->query("SELECT count(*) totaldekripsi FROM dekripsi");
                      $datadekripsi = mysqli_fetch_array($query);
                      ?>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $datadekripsi['totaldekripsi']; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-lock-open fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-warning text-uppercase mb-1">
                        Total File Pengaduan</div>
                      <?php
                      $query = $mysqli->query("SELECT count(*) totalfile FROM dekripsi");
                      $dataenkripsi = mysqli_fetch_array($query);
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $dataenkripsi['totalfile']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tentang Aplikasi</h6>
            </div>
            <div class="card-body">
              <h5>Pengaduan Masyarakat Melalui Citra Bitmap</h5>
              <br>
              <p>Pengaduan Masyarakat Melalui Citra Bitmap, bertujuan
                untuk meminimalisir penyalahgunaan data pengaduan Masyarakat oleh pihak yang tidak bertanggungjawab. Metode Enkripsi
                Steganografi LSB digunakan untuk mengubah citra pengaduan Masyarakat yang disisipkan agar bisa disamarkan pengaduannya.
              </p>
              <a target="_blank" rel="nofollow" href="enkripsi.php">Enkripsi File Sekarang &rarr;</a>
            </div>
          </div>
        </div>





      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Pemas</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
  </div>



  <script src="../assets/js/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/essential-plugins.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/pace.min.js"></script>
  <script src="../assets/js/main.js"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>