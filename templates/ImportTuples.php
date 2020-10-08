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
                              $Date,$Law,$Product,$Location) {

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
    $ModificationDate="112020-12-25T23:14:04Z";
    $BaseURL="https://uu.nl/";
    $PageURL="https://uu.nl/";
    $LatestPageTitle="11Titl999e1";
    $PageTitle="11Titl999e2";
    $ParentPageTitle="11Ti99tle0";
    $SiteTitle="New Title";
    $SpaceKey="11key1";
    $SpaceKeyName="11keys";
    $TitleTxt="19999eee1TitleText";
    $Wikilink="11KB";
    $FileExtension="html";
    $path0="11a";
    $path1="11b";
    $path2="11c";
    $Path_basename="https://uu.nl/";
    $MainText=["11Siamak FarshidiSiamak FarshidiSiamak","Farshidi - fdsfds sdfsdfsdf sdf sdf ds f sf dsf sdf s f"];
    $Email="s.farshidi@uu.nl";
    $EmailDomain="11uu.nl";
    $Phone="+31615373513";
    $Ontology3="11ont1";
    $Ontology3URI="11ont1";
    $Ontology3ReferableURI="11ont1";
    $Ontology3MatchText="11ont1";
    $Person=["Siamak Farshidi","Zhiming Zhao"];
    $Organization=["UvA","UU","IR"];
    $WorkOfArt="UvA";
    $Date=["today","2017", "2018"];
    $Law="11criminal";
    $Product=["MySQL","MongoDB"];
    $Location=["Utrecht","Amsterdam"];

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
