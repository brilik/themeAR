
UserAction = function() {

  this.feedbackcalladd = function($name, $phone, $date, $comment, $check) {
    $form = new FormAjax("feedbackcalladd" , "feedbackCall");

    $form.add_param("name", $name);
    $form.add_param("phone", $phone);
    $form.add_param("date", $date);
    $form.add_param("comment", $comment);
    $form.add_param("check", $check);
    $form.send();
  };

  // this.anketa_add = function($name, $phone, $date, $comment, $check) {
  //   $form = new FormAjax("anketaadd" , "review_form");
  //
  //   $form.add_param("name", $name);
  //   $form.add_param("phone", $phone);
  //   $form.add_param("date", $date);
  //   $form.add_param("comment", $comment);
  //   $form.add_param("check", $check);
  //   $(".file_upload").each(function(  $i) {
  //     $form.add_file("file_"+$i, $(this).attr("id"));
  //   });
  //   $form.send();
  // }

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