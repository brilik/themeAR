<?php

/*
 * $keyGoogleMap = 'AIzaSyCGLMb4BX0iIbD98PzkJXT7J8TbuBK2fq8';
 * $keyGoogleMap = 'AIzaSyBLUNaZ85lCMN7fStJw2Bi3';
*/

// add_action('acf/init', function () {
    // global $keyGoogleMap;
    // acf_update_setting('google_api_key', $keyGoogleMap);
// });

function includes_full_files( $dir ) {
    foreach ( glob( $dir . '/*.php' ) as $file ) {
        include_once $file;
    }
}

$include_path = get_template_directory() . '/includes';
define( "VIEWS_DIR", $include_path . "/3_views/" );

add_action( 'init', 'ar_theme_init', 10 );
$themeAR                = $dbgAR = false;

function ar_theme_init() {
    global $include_path, $themeAR, $dbgAR;
    include_once $include_path . "/theme_functions.php";
    includes_full_files( $include_path . "/4_classes" );
    $themeAR = new ThemeAR();
    $dbgAR   = new DebugAR();
//    include_once $include_path . "/useractions.php";
}


add_action( 'wp_enqueue_scripts', 'ar_theme_name_scripts', 100 );
function ar_theme_name_scripts() {
    $theme_uri = get_template_directory_uri() . '/assets/';

    wp_register_style( 'main', $theme_uri . 'css/main.css', array(), null );

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', $theme_uri . 'js/libs/jquery-3.3.1.min.js', array(), null, true );
    wp_register_script( 'jquery-migrate', $theme_uri . 'js/libs/jquery-migrate-1.2.1.min.js', array(), null, true );
    wp_register_script( 'slick', $theme_uri . 'js/libs/slick.js', array(), null, true );
    wp_register_script( 'jq-fancybox', $theme_uri . 'js/libs/jquery.fancybox.min.js', array(), null, true );
    wp_register_script( 'jq-maskedinput', $theme_uri . 'js/libs/jquery.maskedinput.min.js', array(), null, true );
    wp_register_script( 'jq-validate', $theme_uri . 'js/libs/jquery.validate.min.js', array(), null, true );
    wp_register_script( 'additional-methods', $theme_uri . 'js/libs/additional-methods.js', array(), null, true );
    wp_register_script( 'jq-matchHeight', $theme_uri . 'js/libs/jquery.matchHeight.js', array(), null, true );
    wp_register_script( 'custom', $theme_uri . 'js/custom.js', array(), null, true );

//    wp_enqueue_style( 'main' );
//    wp_enqueue_script( 'jquery' );
//    wp_enqueue_script( 'jquery-migrate' );
//    wp_enqueue_script( 'slick' );
//    wp_enqueue_script( 'jq-fancybox' );
//    wp_enqueue_script( 'jq-maskedinput' );
//    wp_enqueue_script( 'jq-validate' );
//    wp_enqueue_script( 'additional-methods' );
//    wp_enqueue_script( 'jq-matchHeight' );
//    wp_enqueue_script( 'custom' );

}

add_filter( 'script_loader_tag', function ( $tag, $handle ) {

    $handles = array(
        'map',
    );

    foreach ( $handles as $defer_script ) {
        if ( $defer_script === $handle ) {
            return str_replace( ' src', ' defer="defer" src', $tag );
        }
    }

    return $tag;
}, 10, 2 );


/** Подлючаем svg файлы */
add_filter( 'upload_mimes', 'cc_mime_types2' );
function cc_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}
function cc_mime_types2( $file_types ) {
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}