<?php

global $themeAR;

get_header();

while ( have_posts() ) :
    the_post();
    the_content();
    ar_the_view( 'acf-section' );
endwhile;

get_footer();