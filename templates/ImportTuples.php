<?php
//
// View Import Tuples
//
?>
<?php

function addNewDocumentToSolr($solr,$ContentType,$ModificationDate,$BaseURL,$PageURL,
                              $LatestPageTitle,$PageTitle,$ParentPageTitle,$SiteTitle,
                              $SpaceKey,$SpaceKeyName,$TitleTxt,$Wikilink,$FileExtension,
                              $path0,$path1,$path2,$Path_basename,$MainText,$Email,$EmailDomain,
                              $Phone,$Ontology3,$Ontology3URI,$Ontology3ReferableURI,
                              $Ontology3MatchText,$Person,$Organization,$WorkOfArt,
                              $Date,$Law,$Product,$Location) {lo

        $document = new Apache_Solr_Document();

        $document->content_type_ss=$ContentType;
        $document->file_modified_dt=$ModificationDate;
        $document->title_txt=$TitleTxt;
        $document->wikilink_ss=$Wikilink;
        $document->language_s="en";
        $document->content_type_group_ss=["Text document"];
        $document->filename_extension_s=$FileExtension;
        $document->path0_s=$path0;
        $document->path1_s=$path1;
        $document->path2_s=$path2;
        $document->path_basename_s=$Path_basename;
        $document->_text_=$MainText;
        $document->text_txt_en=$MainText;
        $document->email_ss=$Email;
        $document->email_domain_ss=$EmailDomain;
        $document->phone_ss=$Phone;
        $document->phone_normalized_ss=$Phone;
        $document->ontology_3_ss=$Ontology3;
        $document->ontology_3_ss_uri_ss=$Ontology3URI;
        $document->ontology_3_ss_preflabel_and_uri_ss=$Ontology3ReferableURI;
        $document->ontology_3_ss_matchtext_ss=$Ontology3MatchText;
        $document->person_ss=$Person;
        $document->organization_ss=$Organization;
        $document->work_of_art_ss=$WorkOfArt;
        $document->date_ss=$Date;
        $document->law_ss=$Law;
        $document->product_ss=$Product;
        $document->location_ss=$Location;
        $document->id=$PageURL;
        $document->dc_title_ss=$TitleTxt;
        $document->content_txt=$MainText;

        $solr->addDocument($document);
        $solr->commit();
}

function dataEntry($solr)
{
    $ContentType=["text/html; charset=UTF-8"];
    $ModificationDate="2020-09-25T23:14:04Z";
    $BaseURL="https://uva.nl/";
    $PageURL="https://uva.nl/";
    $LatestPageTitle="uvauvauvauva";
    $PageTitle="dsfsdfs";
    $ParentPageTitle="sfdsfsfd";
    $SiteTitle="[*STANDARD_DOC*]";
    $SpaceKey="11key1sfsfdsfs";
    $SpaceKeyName="11keysdfsdfssdf";
    $TitleTxt="19999eeesfdsfsdf1TitleText";
    $Wikilink="11KBsfsfsdf";
    $FileExtension="html";
    $path0="11ssffa";
    $path1="11fsfddsb";
    $path2="11csfsdf";
    $Path_basename="https://11Titl999sfe2.nl/";
    $MainText=["11sdf wetewt 11Titl999sfe2  Siamak FarshidiSiamak FarshidiSiamak","Farshidi - fdsfds sdfsdfsdf sdf sdf ds f sf dsf sdf s f"];
    $Email="s.farshidi@uva.nl";
    $EmailDomain="uva.nl";
    $Phone="+31615373513";
    $Ontology3="11ondft1";
    $Ontology3URI="11ossfnt1";
    $Ontology3ReferableURI="11onsfdt1";
    $Ontology3MatchText="1sfdsfd1ont1";
    $Person=["Siamak Farshidi","Zhiming Zhao","Jack Daniel"];
    $Organization=["UvA","UU","IR","NL"];
    $WorkOfArt="UvA";
    $Date=["today","2017", "2018","2020"];
    $Law="11criminalfg";
    $Product=["MySQL","MongoDB","Solr"];
    $Location=["Utrecht","Amsterdam","Tehran"];
?>

<div> <?php  echo "done!" ?> </div>
<?php

    addNewDocumentToSolr($solr,$ContentType, $ModificationDate,$BaseURL,$PageURL,
                         $LatestPageTitle,$PageTitle,$ParentPageTitle,$SiteTitle,
                         $SpaceKey,$SpaceKeyName,$TitleTxt,$Wikilink,$FileExtension,
                         $path0,$path1,$path2,$Path_basename,$MainText,$Email,$EmailDomain,
                         $Phone,$Ontology3,$Ontology3URI,$Ontology3ReferableURI,
                         $Ontology3MatchText,$Person,$Organization,$WorkOfArt,$Date,
                         $Law,$Product,$Location);
}

dataEntry($solr);

?>
