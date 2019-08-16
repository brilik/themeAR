
UserAction = function() {
  
  this.review_add = function($name, $star, $text, $fei_id) {
    $form = new FormAjax("reviewadd" , "review_form");  
    $form.add_param("name", $name);
    $form.add_param("star", $star);
    $form.add_param("text", $text);
    $form.add_param("fei_id", $fei_id);
    $form.send(); 
  }

  this.anketa_add = function($name, $age, $city, $phone, $info) {
    $form = new FormAjax("anketaadd" , "review_form");  
  
    $form.add_param("name", $name);
    $form.add_param("age", $age);
    $form.add_param("city", $city);
    $form.add_param("phone", $phone);
    $form.add_param("info", $info);
    $(".file_upload").each(function(  $i) { 
      $form.add_file("file_"+$i, $(this).attr("id")); 
    });
    $form.send(); 
  }
  
};

function set_filter() { 
  $age_min = $(".noUi-handle-lower").text();
  $age_max = $(".noUi-handle-upper").text();;
  
  $bra = "";
  $("#bra-filter .bra-value:checked").each(function(){
    $bra += ($bra == "" ? "" : ",")+$(this).val();
  });
  
  $price = "";
  $(".price-filter:checked").each(function(){
    $price += ($price == "" ? "" : ",")+$(this).val();
  });
  
  $filter = "?agemin="+$age_min+"&agemax="+$age_max+"&bra="+$bra+"&price="+$price;
  $url = $this_catalog_url + $filter;
  window.location.href = $url;
  
}

jQuery(document).ready(function(){
  
  $(".review_add").click(function(){
    useraction = new UserAction(); 
    useraction.review_add( 
      $("#review_name").val(), 
      $(".review_start:checked").val() , 
      $("#review_text").val() , 
      $(this).data("id") 
    );  
    return false;
  });
  
  
  $(".anketa_add").click(function(){
    useraction = new UserAction(); 
    useraction.anketa_add( 
      $("#anketa_name").val(), 
      $("#anketa_age").val() , 
      $("#anketa_city").val() , 
      $("#anketa_phone").val() , 
      $("#review_info").val() , 
      $(this).data("id") 
    );  
    return false;
  });
  
  $("#bra-filter .bra-value").click(function(){
    set_filter();
  });
  
  $(".price-filter").click(function(){
    set_filter();
  });
});