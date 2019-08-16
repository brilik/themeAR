<?php

class ReviewAdd extends FormAjax {

  public function create_fields() { 
    
    $this->add_check_fields("star", "notempty");   
    $this->add_check_fields("name", "notempty"); 
    $this->add_check_fields("text", "notempty"); 
    $this->add_check_fields("fei_id", "notempty");
  }
  
  public function exec() {
    
    if( !isset( $_REQUEST['nonce'] ) || !wp_verify_nonce( $_REQUEST['nonce'], 'new_user' ) ) {
      // throw new Exception( 'Оооопс, все вышло из под контроля, попробуйте еще разок, но чуть позже?' ); 
    } 
    $star = $_POST["star"];
    $name = $_POST["name"];
    $text = $_POST["text"];
    $fei_id = (int)$_POST["fei_id"];
    
     $post_data = array(
      'post_title'    => wp_strip_all_tags( $name ),
      'post_type'     => "review",
      'post_content'  => $text,
      'post_status'   => 'draft',
      'post_author'   => 1 
    );
 
    $post_id = wp_insert_post( $post_data );

    update_post_meta($post_id, "star", $star);
    update_post_meta($post_id, "name", $name);
    update_post_meta($post_id, "fei", $fei_id);
    
    $result["msg"] = "Отзыв добавлен, после проверки, будет опубликован"; 
    //$result["redirect"] =  get_permalink(329); 
    $fei = new FeiAR($fei_id);
    $fei->recalc_rating();
    
    return $result;
  }
  
}