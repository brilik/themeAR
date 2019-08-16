<?php 
class BlogPost extends PostAR {
  
  
  public function get_image_src($size) {
    $src = get_field("image", $this->get_ID());
    if (!$src) {
      global $themeAR;
      $src = $themeAR->get_src()."/img/portfolio-1.png";
    }
    return $src["url"]; 
  } 
  
  public function get_image_archive($size) {
    $src = get_field("image_cat", $this->get_ID());
    if (!$src) {
      global $themeAR;
      $src = $themeAR->get_src()."/img/news-item.png";
    }
    return $src["url"]; 
  } 
}