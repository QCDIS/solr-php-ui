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

     $Resultimages= extractShowImages($doc->id);
    if( $Resultimages!= ""):?>
        <div class="col-lg-12 mb-12">
          <div class="card shadow mb-4 border-left-primary ">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                  <a class="title" href="<?= $doc->id; ?>" target="_blank">
                    <?php echo format_title($doc->title_txt, $url_display_basename);  ?>
                  </a>
              </h6>
            </div>
            <div class="card-body">
                <?php echo $Resultimages;?>
           </div>
          </div>
        </div>
<?php endif;
 endforeach;

function extractShowImages($url){

    $Resultimages="";
    $html = file_get_html($url); //chosen page
    // Find all images
    $images = array();
    foreach($html->find('img') as $element) {
        $cntimgs=substr_count($element->src,"//");
            if($cntimgs>0){
                $mainSRC=$element->src;
                for ($x = 0; $x < $cntimgs; $x++) {

                    if(strpos($mainSRC, ".png") > 0 || strpos($mainSRC, ".jpg") > 0 || strpos($mainSRC, ".bmp")>0 || strpos($mainSRC, ".gif") ){

                        if(strpos($mainSRC, ".png") > 0){
                            $startPos   = strpos($mainSRC, ".png")+4;
                        }
                        elseif(strpos($mainSRC, ".jpg") > 0){
                            $startPos   = strpos($mainSRC, ".jpg")+4;
                        }
                        elseif(strpos($mainSRC, ".bmp") > 0){
                            $startPos   = strpos($mainSRC, ".bmp")+4;
                        }
                         elseif(strpos($mainSRC, ".gif") > 0){
                            $startPos   = strpos($mainSRC, ".gif")+4;
                        }

                        $endPos   = strrpos($mainSRC, "http");
                        $img= substr($mainSRC,($startPos*-1),($startPos-$endPos));
                        $mainSRC=substr($mainSRC,$endPos);

                        if( $img!="" &&  (strpos($img, ".png") > 0 || strpos($img, ".jpg") > 0 || strpos($img, ".bmp")>0 || strpos($img, ".gif") ) && validImage($img) && !in_array($img, $images)){
                            $images[] = $img;
                        }

                    }
                }
            }
            else {
                $img = $element->src;
                if($img!="" && (strpos($img, ".png") > 0 || strpos($img, ".jpg") > 0 || strpos($img, ".bmp")>0 || strpos($img, ".gif")) ){
                    $images[] = $img;
                }
            }
    }
    reset($images);
    $cntResultImages = count($images);

    $url_info = parse_url($url);
    $Website= $url_info['host'];

    foreach ($images as $out) {
        if($out!="" && strpos($out, "//") == false){
           $Resultimages .= '<div class="responsive">
                      <div class="gallery">
                        <a target="_blank" href="'.$url.'" target="_blank">
                          <img src="//'.$Website.'/'.$out.'" alt="'.substrwords($url, 45).'" width="600" height="400">
                          <div class="middle">
                            <div class="text">'.substrwords($url, 45).'</div>
                          </div>
                        </a>
                      </div>
                    </div>';
        }
        else{
                   $Resultimages .= '<div class="responsive">
                      <div class="gallery">
                        <a target="_blank" href="'.$url.'" target="_blank">
                          <img src="'.$out.'" alt="'.substrwords($url, 45).'" width="600" height="400">
                          <div class="middle">
                            <div class="text">'.substrwords($url, 45).'</div>
                          </div>
                        </a>
                      </div>
                    </div>';
        }
    }

    return $Resultimages;
}
//----------------------------------------------------------------------------------------
function is_valid_result($doc) {
    $Result=$doc->content_type_ss;
    $result=true;
    if(!is_array($Result) && $Result=='text/plain; charset=ISO-8859-1')
        $result=false;
    return $result;
}

function validImage($file) {
   $size = getimagesize($file);
   if($size[0]=="" || $size[1]=="") return false;
   if($size[0] < 50 || $size[1] <50) return false;

   return (strtolower(substr($size['mime'], 0, 5)) == 'image' ?  true : false);
}


function remote_file_exists($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if( $httpCode == 200 ){return true;}
}

?>




