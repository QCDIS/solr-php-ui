
<?php
session_start();
require_once(__DIR__ . '/helpers.php');
$result_nr = 0;
//----------------------------------------------------------------------------------------
function is_valid_result($doc) {
    $Result=$doc->content_type_ss;
    $result=true;
    if(!is_array($Result) && $Result=='text/plain; charset=ISO-8859-1')
        $result=false;
    return $result;
}
//----------------------------------------------------------------------------------------

function getBaseURL($doc){
  $MainWebsite="";
  if(isset($doc->id)){
     $MainWebsite=$doc->id;
  }
  $url_info = parse_url($MainWebsite);
  return $url_info['host'];//hostname
}
//----------------------------------------------------------------------------------------
function getTitle($doc){
    return format_title($doc->title_txt, $url_display_basename);;
}
//----------------------------------------------------------------------------------------
function getDateTime($doc){
  // Modified date
  $datetime = FALSE;
  if (isset($doc->file_modified_dt)) {
    $datetime = $doc->file_modified_dt;
  }
  elseif (isset($doc->last_modified)) {
    $datetime = $doc->last_modified;
  }
  return $datetime;
}
//----------------------------------------------------------------------------------------
function getResearchInfrastructures($result_nr, $doc, $cfg){
    $CurrentFacets=array();
    $facets = get_facets($result_nr, $doc, $cfg['facets']);
    foreach ($facets as $field => $facet):
              foreach ($facet['values'] as $value):
                $val=FacetsPreprocessing($value['value'],$facet['name']);
                if($val!="" and !in_array($val,$CurrentFacets))
                {
                    array_push($CurrentFacets,$val);
                }
              endforeach;
             if (!empty($facet['more-values'])):
                  foreach ($facet['more-values'] as $value):
                       $val=FacetsPreprocessing($value['value'],$facet['name']);
                        if($val!="" and !in_array($val,$CurrentFacets))
                        {
                            array_push($CurrentFacets,$val);
                        }
                endforeach;
                endif;
    endforeach;
    return $CurrentFacets;
}
//----------------------------------------------------------------------------------------
function getAuthors($doc){
    if (is_array($doc->author_ss)) {
        $authors = $doc->author_ss;
    } else {
        $authors = array($doc->author_ss);
    }

    return $authors;
}
//----------------------------------------------------------------------------------------
function getBriefDescription($doc, $cfg, $results, $result_nr,$content_txt){

      $snippets = array();

      if (isset($content_txt)) {
        $snippets = $content_txt;
      }


      foreach ($cfg['languages'] as $language) {
        $language_specific_fieldname = 'content_txt_' . $language;
        if (isset($results->highlighting->$id->$language_specific_fieldname)) {
          $snippets = $results->highlighting->$id->$language_specific_fieldname;
        }
      }

      if (count($snippets) === 0) {
        if (isset($results->highlighting->$id->ocr_t)) {
          $snippets = $results->highlighting->$id->ocr_t;
        }
		}

      if (count($snippets) === 0 && isset($doc->content_txt)) {
        // if no snippets available, use content as snippet
        $snippets = array($doc->content_txt);
        // and cut it to snippet size
        if (strlen($snippets[0]) > $cfg['snippetsize']) {
          $snippets[0] = substr($snippets[0], 0, $cfg['snippetsize']) . "...";
        }
      }
      $snippets = get_snippets($result_nr, $snippets);

      $briefDescription="";

      foreach ($snippets['values'] as $snip):
        if( strlen($snip['value'])>5){
            $briefDescription= $briefDescription . $snip['value'];
        }
      endforeach;

      return  $briefDescription;
}
//----------------------------------------------------------------------------------------

 $RI_datatypes = array();
 $websites_classes = array();
 $webpages_properties = array();
 $website_IR=array();


 $str_genralInfo="";

 $str_website_RI_class="";
 $str_website_RI_classAttribute="";

 $str_property="";
 $str_propertyAttribute="";

foreach ($results->response->docs as $doc):

  if(!is_valid_result($doc)) continue;

  //---------------------------------------------------- Extract knowledge (1)
  $result_nr++;
  $id = $doc->id;
  $container = isset($doc->container_s) ? $doc->container_s : NULL;
  list ($url_display, $url_display_basename, $url_preview, $url_openfile, $url_annotation, $url_container_display, $url_container_display_basename) = get_urls($doc->id, $container);
  $url_prioritize = NULL;
  //---------------------------------------------------- Extract knowledge (2)
  $Website= getBaseURL($doc);
  $RIs = getResearchInfrastructures($result_nr,$doc, $cfg);
  $Webpage_title = getTitle($doc);
  $Webpage_Url=$url_openfile;
  $Webpage_description=getBriefDescription($doc, $cfg, $results, $result_nr,$results->highlighting->$id->content_txt);
  //----------------------------------------------------

    if($Website!="" and !in_array($Website,$websites_classes)){
        array_push($websites_classes,$Website);
        $str_website_RI_class= (strlen($str_website_RI_class)>0 ? $str_website_RI_class ."," : "") . '{"id" : "'.$Website.'", "type" : "owl:Class" } ';
        $str_website_RI_classAttribute=(strlen($str_website_RI_classAttribute)>0 ? $str_website_RI_classAttribute ."," : "") . '{ "label" : "'.$Website.'", "id" : "'. $Website.'" }';
    }

    foreach ($RIs as $RI):
        if($RI!="" and !in_array($RI,$RI_datatypes)){
            array_push($RI_datatypes,$RI);
            $str_website_RI_class= (strlen($str_website_RI_class)>0 ? $str_website_RI_class ."," : "") . '{"id" : "'.$RI.'", "type" : "rdfs:Datatype" }';
            $str_website_RI_classAttribute=(strlen($str_website_RI_classAttribute)>0 ? $str_website_RI_classAttribute ."," : "") . '{ "label" : "'.$RI.'", "id" : "'. $RI.'" }';
        }

        $website_IR[$Website][$RI]++;

        ///----------------------------
//        $Pagetitle=$Webpage_title."_".$RI;
//        array_push($webpages_properties,$Pagetitle);
//        $str_property= (strlen($str_property)>0 ? $str_property ."," : "") . '{"id" : "'.$Pagetitle.'", "type" : "owl:objectProperty" }';
//        $str_propertyAttribute= (strlen($str_propertyAttribute)>0 ? $str_propertyAttribute ."," : "") . '{ "id": "'.$Pagetitle.'" , "domain" : "'.$Website.'",  "range" : "'.$RI.'", "label": "'.$Pagetitle.'" }';
       ///----------------------------

    endforeach;

    //if($Webpage_title!="" and !in_array($Webpage_title,$webpages_properties)){
    //    array_push($webpages_properties,$Webpage_title);
    //}

endforeach;

$sum=0;
foreach ($websites_classes as $W):
    foreach ($RI_datatypes as $I):
        if(isset($website_IR[$W][$I])){
            $sum++;
            $propertyTitle=$W."_".$I;
            $str_property= (strlen($str_property)>0 ? $str_property ."," : "") . '{"id" : "'.$propertyTitle.'", "type" : "owl:objectProperty" }';
            $str_propertyAttribute= (strlen($str_propertyAttribute)>0 ? $str_propertyAttribute ."," : "") .
            '{ "id": "'.$propertyTitle.'" , "domain" : "'.$W.'",  "range" : "'.$I.'", "label": "'.$website_IR[$W][$I].'"}';
        }
    endforeach;
endforeach;



$str_genralInfo='
  "_comment" : " '. $query .'",
  "header" : {
    "languages" : [ "en"],
    "baseIris" : [ "http://www.w3.org/2000/01/rdf-schema", "http://visualdataweb.de/test_cases_vowl/ontology/72" ],
    "iri" : "",
    "version" : "1.0",
    "author" : [],
    "description" : {
      "undefined" : "Visualization of the search results."
    },
    "title" : {
      "undefined" : "Search query: '. $query .'"
    }
  },
  "namespace" : [ ],
  "metrics" : {
    "classCount" : '   . count($websites_classes) .',
    "datatypeCount" : '. count($RI_datatypes) .',
    "objectPropertyCount" : '.count($webpages_properties).',
    "propertyCount" : '. $sum .',
    "nodeCount" : '    . (count($websites_classes) + count($RI_datatypes)) .',
    "individualCount" : 0
  }';

$JSON_File='
{ '. $str_genralInfo. ',
 "class" : ['. $str_website_RI_class .'],
 "classAttribute" : ['. $str_website_RI_classAttribute .'],
 "property" : ['. $str_property .'],
 "propertyAttribute" : ['. $str_propertyAttribute .']
}';

$myfile = fopen("OntologyVisualization/data/foaf.json", "w") or die("Unable to open file!");
fwrite($myfile, $JSON_File);
fclose($myfile);

echo '<script>  </script>';

echo "<script> window.open('/OntologyVisualization/OntologyVisualization.php','_self'); </script>";
?>



