<form id="frm-upload" action="" method="post"
    enctype="multipart/form-data">
    <div style="padding:20px; border:1px solid lightgray;  margin-bottom:10px; ">
        <div>Choose file: &nbsp;</div>
        <div>
            <input type="file" class="file-input" name="file-input">
                    <input type="submit" id="btn-submit" name="upload" class="btn btn-primary"
            value="Upload">
        </div>
    </div>
    <input type="submit" id="btn-submit" name="deleteAll" class="btn btn-primary" value="delete all" />
</form>
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
    DeletingAllDocuments($solr);
}

if (!empty(isset($_POST["upload"])))
{
    if (($fp = fopen($_FILES["file-input"]["tmp_name"], "r")) !== false)
    {
        preprocessing($_FILES["file-input"]["tmp_name"]);
        showCSVContent($_FILES["file-input"]["tmp_name"]);
        $response = array(
            "type" => "success",
            "message" => "CSV is uploaded successfully"
        );
        uploadCSVfileToSolr($_FILES["file-input"]["tmp_name"], $solr);
    }
    else
    {
        $response = array(
            "type" => "error",
            "message" => "Unable to process CSV"
        );
    }
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
function preprocessing($filename)
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

function DeletingAllDocuments($solr)
{

    //This will erase the entire index
    $solr->deleteByQuery("*:*");
    $solr->commit();

    print_r("All docs have been deleted!");
}

function uploadCSVfileToSolr($filename, $solr)
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
