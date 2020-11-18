<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title><?=t('Search') . ($query ? ': ' . htmlspecialchars($query) : '') ?></title>
  <link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$link_rss ?>">
    <link rel="icon" href="/images/envri_logo_final.png" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Custom fonts for this template-->
  <link href="UI/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="UI/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/app.css" type="text/css"/>

        <style>
         .centerSearchBox {
           padding-top:9%;
             top: 12%;
             width:100%;
             text-align:center;
             background-color:white;


         }
      </style>


</head>
<body id="page-top" class="sidebar-toggled" style="background-color:white;overflow: hidden;">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" style="background-color:white;">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand topbar mb-4 static-top">

          <ul class="navbar-nav ml-auto">
    <?php if (isset($_SESSION['userid'])): ?>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
                <div style="background-color:orange;top:auto;text-align:center;display:inline-block; border:2px #4e73df solid; padding:3px; border-radius:100%; width:35px; height:35px;">
                <i style="font-size:18pt; color:#4e73df;" class="fas fa-user"></i> </div>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
            <?php if ($_SESSION['role'] == "admin"): ?>
                <div class="dropdown-divider"></div>
                 <a class="dropdown-item" target="_blank"
                     title="Manage structure, navigation and interactive filters by ontologies like thesauri or lists of named entities like organizations, persons or locations"
                     href="/search-apps/thesaurus/">
                     <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                     <?php echo t("manage_structure"); ?>
                 </a>
                <a class="dropdown-item" target="_blank" title="Manage datasources"
                    href="/search-apps/datasources/">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?php echo t("manage_datasources"); ?>
                 </a>
                <a class="dropdown-item" target="_blank" title="Configuration"
                    href="/search-apps/setup/">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?php echo t("config"); ?>
                </a>
                 <a class="dropdown-item" title="Import structured data"
                    href="<?php echo buildurl(null, 'view', 'ImportTuples', null, null); ?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                   Knowledge base operations
                 </a>
            <?php endif ?>

             <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo buildurl(null, 'view', 'SearchLog', null, null); ?>">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Search log
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo buildurl(null, 'view', 'LoginPage', null, null); ?>" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
            </li>
    <?php else: ?>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Guest</span>
                <div style="background-color:#4e73df;;top:auto;text-align:center;display:inline-block; border:2px #4e73df solid; padding:3px; border-radius:100%; width:35px; height:35px;">
                <i style="font-size:18pt; color:white" class="fas fa-user"></i> </div>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo buildurl(null, 'view', 'LoginPage', null, null); ?>">
                  <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              <span>Login</span></a>
              </div>
            </li>
     <?php endif ?>
     </ul>
        </nav>
        <!-- ------------------------------------------------------------------------------------------ End of Topbar -->
        <!-- ------------------------------------------------------------------------------------- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->
          <div class="row">
              <div class="centerSearchBox">
              <img src="images/envri_logo_final.png" style="width:200px; height:155px;">
              <br /> <br /> <br />
              <div style="display:inline-block;min-width:300px; width:30%;">
                 <form id="searchform1" accept-charset="utf-8" method="get">
                    <div class="input-group" style="border:solid 1px blue; border-radius:5px;">
                       <input type="text" class="form-control bg-light border-0 big" placeholder="Search for..."
                          aria-label="Search" aria-describedby="basic-addon2" id="q" name="q" type="text"
                          value="<?php echo htmlspecialchars($query, ENT_QUOTES, 'utf-8'); ?>" required=""
                          oninvalid="this.setCustomValidity('The search query is empty!')" oninput="setCustomValidity('')"/>
                       <div class="input-group-append">
                          <button class="btn btn-primary" id="submit" type="submit" value="<?= t("Search"); ?>" onclick='waiting_on();' style="border:solid 1px ;">
                          <i class="fas fa-search fa-sm"></i>
                          </button>
                       </div>
                    </div>
                 </form>
              </div>

          </div>
        </div>
        <div id="wait">
          <img src="images/ajax-loader.gif">
          <p><?=t('wait'); ?></p>
        </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white" style="  position: fixed; bottom: 0;">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; OSS Engine 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="RegistrationSystem/login.php?logout='1'">
                <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span></a>

            </div>
          </div>
        </div>
      </div>
  <!-- Bootstrap core JavaScript-->
  <script src="UI/vendor/jquery/jquery.min.js"></script>
  <script src="UI/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="UI/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="UI/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="UI/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="UI/js/demo/chart-area-demo.js"></script>
  <script src="UI/js/demo/chart-pie-demo.js"></script>
</body>
</html>
