<?php 

function ar_the_view($name, $args = []) {
  global $themeAR; 
  $themeAR->the_view($name, $args);
}


function ar_the_pagination() {
  the_posts_pagination([
    'prev_text' => "",
	  'next_text' => "", 
    "mid_size" => 1, 
    "end_size" => 3 ,
    "screen_reader_text" => ""
  ]);
};

add_filter('navigation_markup_template', 'glp_navigation_template', 100, 2 );
function glp_navigation_template( $template, $class ){ 
  $template = '
    <nav class="pagination " role="navigation"> 
        %3$s 
    </nav>';
 return $template;
}