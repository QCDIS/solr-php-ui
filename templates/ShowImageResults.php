<style>
div.gallery {
  border: 1px solid #4e73df;
  margin:3px;
  border-radius:5px;
  min-height: 63px;
  max-height: 200px;

  position: relative;
}
.hide {
  display: none;
}

div.gallery:hover {
  border: 1px solid #4e73df;
  opacity:0.6 !important;
  filter:alpha(opacity=60) !important; /* For IE8 and earlier */
}

div.gallery:hover  .middle {

  opacity: 1;
}

.middle {
  transition: .5s ease;
  opacity: 0;
margin:0px;
  text-align: center;
}

.text {

  position: absolute;
  height:60px;
  background-color: #4e73df;
  color: black;
  font-size: 16px;
  padding: 16px 32px;
   bottom: 0px;
   width:100%;
  opacity:0.8!important;
  filter:alpha(opacity=80) !important; /* For IE8 and earlier */
}

div.gallery img {

padding:3px;
  width: 100%;
  height: auto;
  max-height: 200px;
}

div.desc {
  padding: 15px;
  text-align: center;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 24.99999%;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
</style>

<?php
include('HTML_DOM_Parser/simple_html_dom.php');
require_once(__DIR__ . '/helpers.php');

foreach ($results->response->docs as $doc):

    if(!is_valid_result($doc)) continue;
    extractShowImages($doc->id);

endforeach;


function extractShowImages($url){
    $html = file_get_html($url); //chosen page
    // Find all images
    $images = array();
    foreach($html->find('img') as $element) {
           $images[] = $element->src;
    }
    reset($images);
    $cntResultImages = count($images);

    $url_info = parse_url($url);
    $Website= $url_info['host'];

    foreach ($images as $out) {
        if(strpos($out, "//") == false){
            echo '<div class="responsive">
                      <div class="gallery">
                        <a target="_blank" href="'.$url.'" target="_blank">
                          <img src="//'.$Website.'/'.$out.'" alt="Cinque Terre" width="600" height="400">
                          <div class="middle">
                            <div class="text">'.substrwords($url, 45).'</div>
                          </div>
                        </a>
                      </div>
                    </div>';
        }
    }
}
//----------------------------------------------------------------------------------------
function is_valid_result($doc) {
    $Result=$doc->content_type_ss;
    $result=true;
    if(!is_array($Result) && $Result=='text/plain; charset=ISO-8859-1')
        $result=false;
    return $result;
}

?>




