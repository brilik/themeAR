<?php

function includes_full_files($dir)
{
    foreach (glob($dir . '/*.php') as $file) {
        include_once $file;
    }
}


$include_path = get_template_directory() . '/includes';
define("VIEWS_DIR", $include_path . "/3_views/");
$debugAR = $themeAR = false;
$elementorWidgetsAR = [];


add_action('init', 'ar_theme_init', 10);
function ar_theme_init()
{
    global $include_path, $themeAR, $debugAR;
    include_once $include_path . "/theme_functions.php";
    includes_full_files($include_path . "/4_classes");
    $themeAR = new ThemeAR();
    $debugAR = new DebugAR();
    include_once $include_path . "/useractions.php";
}


add_action('wp_enqueue_scripts', 'ar_theme_name_scripts', 100);
function ar_theme_name_scripts()
{
    //wp_deregister_script('jquery');
    wp_deregister_style('elementor-animations');
    wp_deregister_style('elementor-frontend');
    wp_deregister_style('elementor-global');
    wp_deregister_style('elementor-common');

}


//Подлючаем svg файлы
add_filter('upload_mimes', 'cc_mime_types');
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}