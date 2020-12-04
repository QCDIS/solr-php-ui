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

             background-color:white;


         }
      </style>


</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">



    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" style="background-color:white;">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
            <div class="sidebar-brand-icon rotate-n-15">
            </div>
            <div style="background-color:white; width:100%;padding:5px; border-radius:10px;"><img src="images/envri_logo_final.png" style="width:55px; height:40px;" /></div>
        </a>
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


               <div class="col-lg-12 mb-4">
                  <div class="card shadow mb-12">
                     <div class="card-header py-12">
                        <h6 class="m-0 font-weight-bold text-primary">Knowledge base operations</h6>
                     </div>
                     <div class="card-body" style="min-height:740px">
                        <form id="frm-upload" action="" method="post" enctype="multipart/form-data">
                           <div style="padding:20px; border:1px solid lightgray;  margin-bottom:10px;">

                             <label for="cars">Select the structured datasource:</label><br />
                             <select name="structuredDatasource" id="structuredDatasource">
                                  <option value="-">-</option>
                                  <option value="ResearchInfrastructures">Research Infrastructures</option>
                                  <option value="ServiceCatalogs">Service Catalogs</option>
                                  <option value="Datasets">Datasets</option>
                                  <option value="APIs">APIs</option>
                              </select>
                              <br />
                              <br />
                              <label for="file"> Choose file: &nbsp;</label> <br />
                              <input type="file" class="file-input" name="file-input" id="file">
                              <br /><br />
                              <input type="submit" id="btn-submit" name="upload" class="btn btn-primary"
                                 value="Upload">
                           </div>
                           <div style="padding:20px; border:1px solid lightgray;  margin-bottom:10px;">
                              <label for="file"> Delete all indexed documents: &nbsp;</label><br />
                              <input type="submit" id="btn-submit" name="deleteAll" class="btn btn-primary" value="Delete" />
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

                <?php if (!empty($response))
                { ?>
                <div class="response <?php echo $response["type"]; ?>
                    ">
                    <?php echo $response["message"]; ?>
                </div>
                <?php
                } ?>

                <?php
                if (!empty(isset($_POST["deleteAll"])))
                {
                    echo "deleting...";
                    //DeletingAllDocuments($solr);
                }

                //-------------------------------------------------------------------------------
                // Handle AJAX request (start)

                if( isset($_POST['ajax']) && isset($_POST['Type']) ){

                    $_SESSION['Type'] =$_POST['Type'];
                 exit;
                }
                // Handle AJAX request (end)


                //-------------------------------------------------------------------------------
                if (!empty(isset($_POST["upload"])))
                {
                    echo '
                       <div class="col-lg-12 mb-4">
                          <div class="card shadow mb-12">
                             <div class="card-header py-12">
                                <h6 class="m-0 font-weight-bold text-primary">Ingested Data</h6>
                             </div>
                             <div class="card-body" style="min-height:740px">';
                    if (($fp = fopen($_FILES["file-input"]["tmp_name"], "r")) !== false)
                    {

                        if ($_SESSION['Type']=='ServiceCatalogs'){

                        }
                        elseif($_SESSION['Type']=='Datasets'){
                            showCSVContent($_FILES["file-input"]["tmp_name"]);
                            uploadCSVfileToSolr_Datasets($_FILES["file-input"]["tmp_name"], $solr);

                        }
                        elseif($_SESSION['Type']=='ResearchInfrastructures'){ //


                            preprocessing_ResearchInfrastructures($_FILES["file-input"]["tmp_name"]);
                            showCSVContent($_FILES["file-input"]["tmp_name"]);
                            uploadCSVfileToSolr_ResearchInfrastructures($_FILES["file-input"]["tmp_name"], $solr);
                        }
                        $response = array(
                        "type" => "success",
                        "message" => "CSV is uploaded successfully"
                        );
                    }
                    else
                    {
                        $response = array(
                            "type" => "error",
                            "message" => "Unable to process CSV"
                        );
                    }

                    echo '
                             </div>
                          </div>
                       </div>';
                }
                ?>
                <?php if (!empty($response))
                { ?>
                <div>
                    <?php echo $response["message"]; ?>
                </div>


                <?php
                } ?>

                <?php
                function preprocessing_ResearchInfrastructures($filename)
                {
                    $file_contents = file_get_contents($filename);
                    $file_contents = str_replace("http://www.oil-e.net/ontology/envri-rm.owl#ResearchInfrastructure", "ResearchInfrastructure", $file_contents);
                    $file_contents = str_replace("ResearchInfrastructure", "Research Infrastructure", $file_contents);
                    $file_contents = str_replace("http://envri.eu/entity/QWmvj6lQv", "marine domain", $file_contents);
                    $file_contents = str_replace("http://envri.eu/entity/QmAOWQhKx", "atmospheric domain", $file_contents);
                    $file_contents = str_replace("http://envri.eu/entity/QRW2A7WrJ", "ecosystem domain", $file_contents);
                    $file_contents = str_replace("envri:QRW2A7WrJ", "ecosystem domain", $file_contents);
                    $file_contents = str_replace("http://envri.eu/entity/QqKsuhT0R", "solid earth domain", $file_contents);
                    file_put_contents($filename, $file_contents);
                    //----------------------------------------------------------

                }

                //------------------------------------------------------------------------------------------------------
                function showCSVContent($filename)
                {
                    $row = 1;
                    echo '<div class="table-responsive">';
                    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';

                    if (($handle = fopen($filename, "r")) !== false)
                    {
                        while (($data = fgetcsv($handle, 1000, ",")) !== false)
                        {
                            $num = count($data);
                            if ($row == 1)
                            {
                                echo "<thead>";
                                for ($c = 0;$c < $num;$c++)
                                {
                                    echo "<th>" . $data[$c] . "</th>";
                                }
                                echo "</thead>";
                                echo "<tfoot>";
                                for ($c = 0;$c < $num;$c++)
                                {
                                    echo "<th>" . $data[$c] . "</th>";
                                }
                                echo "</tfoot>";
                                echo "<tbody>";
                            }
                            else
                            {
                                echo "<tr>";
                                for ($c = 0;$c < $num;$c++)
                                {
                                    echo "<td>" . $data[$c] . "</td>";
                                }
                                echo "</tr>";
                            }
                            $row++;
                        }
                        fclose($handle);
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                }
                //------------------------------------------------------------------------------------------------------
                function addNewDocumentToSolr($solr, $ContentType, $BaseURL, $PageURL, $LatestPageTitle, $PageTitle, $ParentPageTitle, $SiteTitle, $SpaceKey, $SpaceKeyName, $TitleTxt, $Wikilink, $FileExtension, $path0, $path1, $path2, $Path_basename, $MainText, $Email, $EmailDomain, $Phone, $Ontology3, $Ontology3URI, $Ontology3ReferableURI, $Ontology3MatchText, $Person, $Organization, $WorkOfArt, $Date, $Law, $Product, $Location)
                {

                    $document = new Apache_Solr_Document();

                    $document->content_type_ss = $ContentType;
                    $document->title_txt = $TitleTxt;
                    $document->wikilink_ss = $Wikilink;
                    $document->language_s = "en";
                    $document->content_type_group_ss = ["Text document"];
                    $document->filename_extension_s = $FileExtension;
                    $document->path0_s = $path0;
                    $document->path1_s = $path1;
                    $document->path2_s = $path2;
                    $document->path_basename_s = $Path_basename;
                    $document->_text_ = $MainText;
                    $document->text_txt_en = $MainText;
                    $document->email_ss = $Email;
                    $document->email_domain_ss = $EmailDomain;
                    $document->phone_ss = $Phone;
                    $document->phone_normalized_ss = $Phone;
                    $document->ontology_3_ss = $Ontology3;
                    $document->ontology_3_ss_uri_ss = $Ontology3URI;
                    $document->ontology_3_ss_preflabel_and_uri_ss = $Ontology3ReferableURI;
                    $document->ontology_3_ss_matchtext_ss = $Ontology3MatchText;
                    $document->person_ss = $Person;
                    $document->organization_ss = $Organization;
                    $document->work_of_art_ss = $WorkOfArt;
                    $document->date_ss = $Date;
                    $document->law_ss = $Law;
                    $document->product_ss = $Product;
                    $document->location_ss = $Location;
                    $document->id = $PageURL;
                    $document->dc_title_ss = $TitleTxt;
                    $document->content_txt = $MainText;

                    //        print_r("okay 1");
                    $solr->addDocument($document);

                    //        print_r("okay 2");



                }
                //------------------------------------------------------------------------------------------------------
                function DeletingAllDocuments($solr)
                {

                    //This will erase the entire index
                    $solr->deleteByQuery("*:*");
                    $solr->commit();

                    print_r("All docs have been deleted!");
                }
                //------------------------------------------------------------------------------------------------------
                function uploadCSVfileToSolr_Datasets($filename, $solr){


                }
                //------------------------------------------------------------------------------------------------------
                function uploadCSVfileToSolr_ResearchInfrastructures($filename, $solr)
                {
                    ///////////////////////////////////////////////
                    $ParentPageTitle = "null";
                    $SpaceKey = "null";
                    $SpaceKeyName = "null";
                    $Wikilink = "[* STANDARD DOC RI *]";
                    $path0 = "null";
                    $path1 = "null";
                    $path2 = "null";
                    $Ontology3 = "null";
                    $Ontology3URI = "null";
                    $Ontology3ReferableURI = "null";
                    $Ontology3MatchText = "null";
                    $WorkOfArt = "null";
                    $Law = "null";
                    $Product = ["null"];
                    $Email = "null";
                    $EmailDomain = "null";
                    $Phone = "null";
                    $Person = ["null"];
                    ///////////////////////////////////////////////
                    if (($handle = fopen($filename, "r")) !== false)
                    {
                        while (($data = fgetcsv($handle, 1000, ",")) !== false)
                        {

                            $FileExtension = "html";
                            $ContentType = ["text/html; charset=UTF-8"];
                            $BaseURL = $data[3];
                            $PageURL = $data[3];
                            $LatestPageTitle = $data[2];
                            $PageTitle = $data[2];
                            $SiteTitle = $data[1];
                            $TitleTxt = $data[2];
                            $FileExtension = "html";
                            $Path_basename = $data[3];
                            $MainText = [$data[4]];
                            $Organization = [$data[0]];
                            $Date = ["today"];
                            $Location = [$data[5]];

                            addNewDocumentToSolr($solr, $ContentType, $BaseURL, $PageURL, $LatestPageTitle, $PageTitle, $ParentPageTitle, $SiteTitle, $SpaceKey, $SpaceKeyName, $TitleTxt, $Wikilink, $FileExtension, $path0, $path1, $path2, $Path_basename, $MainText, $Email, $EmailDomain, $Phone, $Ontology3, $Ontology3URI, $Ontology3ReferableURI, $Ontology3MatchText, $Person, $Organization, $WorkOfArt, $Date, $Law, $Product, $Location);
                        }
                        $solr->commit();
                        fclose($handle);
                    }
                }
                ?>
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

    <script type="text/javascript">
    $("#structuredDatasource").change(function(){
        val = $(this).val();
        $.ajax({
                  type: 'post',
                  data: {ajax: 1,Type: val},
                  success: function(response){}
             });
    });
    </script>
</body>
</html>

