<?php
/**
$countMenuItem = (int) 0;

if ( have_rows( 'sections' ) ): $countMenuItem ++;

    while ( have_rows( 'sections' ) ): the_row();

        if ( get_row_layout() == 'intro' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__intro', $countMenuItem );
        } elseif ( get_row_layout() == 'station' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__station', $countMenuItem );
        } elseif ( get_row_layout() == 'systems' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__systems', $countMenuItem );
        } elseif ( get_row_layout() == 'reasons' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__reasons', $countMenuItem );
        } elseif ( get_row_layout() == 'equipment' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__equipment', $countMenuItem );
        } elseif ( get_row_layout() == 'estimate' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__estimate', $countMenuItem );
        } elseif ( get_row_layout() == 'important' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__important', $countMenuItem );
        } elseif ( get_row_layout() == 'certificates' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__certificates', $countMenuItem );
        } elseif ( get_row_layout() == 'guarantee' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__guarantee', $countMenuItem );
        } elseif ( get_row_layout() == 'steps' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__steps', $countMenuItem );
        } elseif ( get_row_layout() == 'services' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__services', $countMenuItem );
        } elseif ( get_row_layout() == 'opinions' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__opinions', $countMenuItem );
        } elseif ( get_row_layout() == 'faq' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__faq', $countMenuItem );
        } elseif ( get_row_layout() == 'order' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__order', $countMenuItem );
        } elseif ( get_row_layout() == 'contacts' && get_sub_field( 'show' ) ) {
            ar_the_view( 'section__contacts', $countMenuItem );
        }

        $countMenuItem ++;

    endwhile;
else:
    ar_the_view('section__not-page');
endif;
 *
 */