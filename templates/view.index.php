

<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= t('Search') . ($query ? ': ' . htmlspecialchars($query) : '') ?></title>
  <link rel="alternate" type="application/rss+xml" title="RSS" href="<?= $link_rss ?>">

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



</head>
<body id="page-top" class="sidebar-toggled">

<?php  // New Search
   if(empty($_GET)) {
    include 'templates/FirstPage.php';
   }
   else
   {
     if ($view == 'LoginPage') {
        header('location: /RegistrationSystem/login.php');
     }

?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- ---------------------------------------------------------------------------------------------------- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">


      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
        <div class="sidebar-brand-icon rotate-n-15">

        </div>
        <div style="background-color:white; width:100%;padding:5px; border-radius:10px;"><img src="images/envri_logo_final.png" style="width:55px; height:40px;"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Search
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQuerString" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-question-circle"></i>
          <span>Query</span>
        </a>
        <div id="collapseQuerString" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Query string</h6>
            <a class="collapse-item" href="./"><?php echo t("New search"); ?></a>
            <a class="collapse-item" data-toggle="searchoptions" onclick="AdvancedSearch()"><?php echo t("advanced_search"); ?></a>
            <a class="collapse-item" target="_blank"
             title="Search with a list if there are results for each list entry"
             href="/search-apps/search-list/"><?php echo t("search_by_list"); ?></a>
          </div>
        </div>

        <a class="nav-link" href="<?php echo buildurl($params, 'view', 'Websites', null, null); ?>">
          <i class="fas fa-globe"></i>
          <span>Websites</span>
        </a>

        <a class="nav-link" href="<?php echo buildurl($params, 'view', 'Services', null, null); ?>">
          <i class="fab fa-uikit"></i>
          <span>Services</span>
        </a>

        <a class="nav-link" href="<?php echo buildurl($params, 'view', 'ResearchInfrastructures', null, null); ?>">
             <i class="fas fa-cubes"></i>
              <span>Research Infrastructures</span>
        </a>

        <a class="nav-link" href="<?php echo buildurl($params, 'view', 'Datasets', null, null); ?>">
              <i class="fas fa-coins"></i>
              <span>Datasets</span>
        </a>
        <a class="nav-link" href="<?php echo buildurl($params, 'view', 'APIs', null, null); ?>" >
              <i class="fas fa-code"></i>
              <span>APIs</span>
        </a>

       <!-- Visualization Button --------------------------------------------- -->
        <?php
        // Setup parameters for graph visualization by Open Semantic Visual Linked Data Graph Explorer
        $link_graph = '/search-apps/graph/?q='.$query;
        $link_graph .= '&fl=' . implode(',', $graph_fields);
        foreach ($cfg['facets'] as $facet => $facet_config) {
           if ( in_array($facet, $graph_fields) ) {
                // todo: read from coming facet config graph_limit
                $facetlimit = 50;
                if (isset($facets_limit[$facet])) {
                    $facetlimit = $facets_limit[$facet];
                }
                $link_graph .= "&f." . $facet . ".facet.limit=" . $facetlimit;
            }
        }
        ?>
        <a class="nav-link" href="<?= $link_graph ?>" target="_blank">
              <i class="fab fa-hubspot"></i>
              <span>Graph Visualization</span>
        </a>
       <!-- ------------------------------------------------------------------ -->
      </li>

<?php if (isset($_SESSION['userid']) && $_SESSION['role']=="admin"):  ?>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Knowledge base
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-cogs"></i>
          <span>Settings</span>
        </a>
        <div id="collapseSettings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Configuration:</h6>
            <a class="collapse-item" target="_blank"
             title="Manage structure, navigation and interactive filters by ontologies like thesauri or lists of named entities like organizations, persons or locations"
             href="/search-apps/thesaurus/"><?php echo t("manage_structure"); ?></a>
            <a class="collapse-item" target="_blank" title="Manage datasources"
             href="/search-apps/datasources/"><?php echo t("manage_datasources"); ?></a>
            <a class="collapse-item" target="_blank" title="Configuration"
             href="/search-apps/setup/"><?php echo t("config"); ?></a>

             <a class="collapse-item" title="Import structured data"
             href="<?php echo buildurl(null, 'view', 'ImportTuples', null, null); ?>">Import tuples</a>

          </div>
        </div>
      </li>
<?php endif ?>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo buildurl($params, 'view', 'OSSTeam', null, null); ?>" target="_blank">
          <i class="fas fa-users-cog"></i>
          <span>OSS Team</span></a>

          <a class="nav-link" href="<?php echo buildurl($params, 'view', 'SendFeedback', null, null); ?>" target="_blank">
          <i class="fas fa-comments"></i>
          <span>Send feedback</span></a>

      </li>
      <hr class="sidebar-divider">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" style="font-size:15pt;"></button>
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
    </ul>
    <!-- --------------------------------------------------------------------------------------------- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <?php
                include 'templates/SearchBox.php';
         ?>
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
                <?php echo $form_hidden_parameters ?>
                  <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" id="q" name="q" type="text"
                       value="<?php echo htmlspecialchars($query, ENT_QUOTES, 'utf-8'); ?>" required=""  oninvalid="this.setCustomValidity('The search query is empty!')" oninput="setCustomValidity('')"/>
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="submit" type="submit" value="<?= t("Search"); ?>" onclick="waiting_on()">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

    <?php if (isset($_SESSION['userid'])):  ?>
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
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>

                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Search Log
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

            <?php
           // include 'templates/select_view.php';

        //    if ($cfg['etl_status_warning']) {
        //      include 'templates/view.etl_status.php';
        //    }

            // if no results, show message
            if ($total == 0) {
              ?>
              <div id="noresults" class="panel"><?php
                if ($error) {
                  print '<p>' . t('Error:') . '</p><p>' . $error . '</p>';
                }
                else {
                  // Todo: Use t() elsewhere as well.
                  print t('No results');
                } ?>
              </div>
              <?php
            } // total == 0
            else { // there are results documents

              if ($error) {
                print '<p>' . t('Error:') . '</p><p>' . $error . '</p>';
              }

              // print the results with selected view template
              if ($view == 'list') {

                include 'templates/pagination.php';
                include 'templates/view.list.php';
                include 'templates/pagination.php';

              }
              elseif ($view == 'preview') {

                include 'templates/pagination.php';
                include 'templates/view.preview.php';
                include 'templates/pagination.php';

              }
              elseif ($view == 'images') {

                include 'templates/pagination.php';
                include 'templates/view.images.php';
                include 'templates/pagination.php';

              }
              elseif ($view == 'videos') {

                include 'templates/pagination.php';
                include 'templates/view.videos.php';
                include 'templates/pagination.php';

              }
              elseif ($view == 'audios') {

                include 'templates/pagination.php';
                include 'templates/view.audios.php';
                include 'templates/pagination.php';

              }
              elseif ($view == 'table') {

               ?>
                <div class="container-fluid">
                  <!-- Content Row -->
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <div class="card shadow mb-12">
                        <div class="card-header py-12">
                          <h6 class="m-0 font-weight-bold text-primary">Table</h6>
                        </div>
                        <div class="card-body" style="min-height:750px">
                        <?php
                            include 'templates/pagination.php';
                            include 'templates/view.table.php';
                            include 'templates/pagination.php';
                         ?>
                        </div>
                      </div>
                  </div>
                </div>
            <?php
              }
              elseif ($view == 'words') {

               ?>
                <div class="container-fluid">
                  <!-- Content Row -->
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <div class="card shadow mb-12">
                        <div class="card-header py-12">
                          <h6 class="m-0 font-weight-bold text-primary">Words (count of docs)</h6>
                        </div>
                        <div class="card-body" style="min-height:750px">
                        <?php
                            include 'templates/view.words.php';
                         ?>
                        </div>
                      </div>
                  </div>
                </div>
            <?php



              }
              elseif ($view == 'graph') {


               ?>
                <div class="container-fluid">
                  <!-- Content Row -->
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <div class="card shadow mb-12">
                        <div class="card-header py-12">
                          <h6 class="m-0 font-weight-bold text-primary">Connection (Graph)</h6>
                        </div>
                        <div class="card-body" style="min-height:750px">
                        <?php
                            include 'templates/view.graph.php';
                         ?>
                        </div>
                      </div>
                  </div>
                </div>
            <?php




              }
              elseif ($view == 'entities') {


               ?>
                <div class="container-fluid">
                  <!-- Content Row -->
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <div class="card shadow mb-12">
                        <div class="card-header py-12">
                          <h6 class="m-0 font-weight-bold text-primary">Named entities</h6>
                        </div>
                        <div class="card-body" style="min-height:750px">
                        <?php
                            include 'templates/view.entities.php';
                         ?>
                        </div>
                      </div>
                  </div>
                </div>
            <?php



              }
              elseif ($view == 'trend') {

                             ?>
                <div class="container-fluid">
                  <!-- Content Row -->
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <div class="card shadow mb-12">
                        <div class="card-header py-12">
                          <h6 class="m-0 font-weight-bold text-primary">Trend</h6>
                        </div>
                        <div class="card-body" style="min-height:750px">
                        <?php
                             include 'templates/view.trend.php';
                         ?>
                        </div>
                      </div>
                  </div>
                </div>
            <?php

              }
              elseif ($view == 'map') {


                             ?>
                <div class="container-fluid">
                  <!-- Content Row -->
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <div class="card shadow mb-12">
                        <div class="card-header py-12">
                          <h6 class="m-0 font-weight-bold text-primary">Map</h6>
                        </div>
                        <div class="card-body" style="min-height:740px">
                        <?php
                             include 'templates/view.map.php';
                         ?>
                        </div>
                      </div>
                  </div>
                </div>
            <?php
              }
              elseif ($view == 'ImportTuples') {

               ?>
                <div class="container-fluid">
                  <!-- Content Row -->
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <div class="card shadow mb-12">
                        <div class="card-header py-12">
                          <h6 class="m-0 font-weight-bold text-primary">Import Tuples</h6>
                        </div>
                        <div class="card-body" style="min-height:740px">
                        <?php   include 'templates/ImportTuples.php'; ?>
                        </div>
                      </div>
                  </div>
                </div>
            <?php

              }
              elseif ($view == 'OSSTeam') {
                    include 'templates/OSSTeam.php';
              }
              elseif ($view == 'SendFeedback') {
                    include 'templates/SendFeedback.php';
              }
              else {

                include 'templates/pages.php';
                include 'templates/view.list.php';
                include 'templates/pages.php';

              }
            } // if total <> 0: there were documents
            ?>
          </div><?php ?>
        </div>

        <?php
        // Wait indicator - will be activated on click = next search (which can take a while and additional clicks would make it worse)
        ?>
        <div id="wait">
          <img src="images/ajax-loader.gif">
          <p><?= t('wait'); ?></p>
        </div>





        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
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

<script>

function AdvancedSearch() {
            $(document).ready(function () {
                $('#AdvancedSearch').modal('show');
            });
        }

//if (sessionStorage.getItem("sidebarToggle") == "Slide"){
//    document.getElementById("sidebarToggle").click();
//    sessionStorage.setItem("sidebarToggle", "Slide");
//}


</script>


<?php  // New Search
}
?>

</body>
</html>