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

add_theme_support( 'post-thumbnails', array( 'feedback' ) );

add_filter( 'body_class', function ( $classes ) {

    // добавим класс 'class-name' в массив классов $classes
    if ( is_page() ) {
        $classes[] = 'it_is_page';
    }

    return $classes;
} );

add_action( 'admin_menu', function () {
    $user = wp_get_current_user();
    if ( $user && isset( $user->user_email ) ) {
        if ( 'megabrilik@gmail.com' != $user->user_email && 'bryl.sliceplanet@gmail.com' != $user->user_email ) {
            remove_menu_page( 'edit.php?post_type=acf-field-group' );
        }
    }
}, 999 );

/**
 * Отключаем гутенберг на определенных типах постов или страницах.
 */
add_filter( 'use_block_editor_for_post', 'disable_gutenberg_for_post', 10, 2 );
function disable_gutenberg_for_post( $use, $post ){

    if( $post->post_type == 'page')
        return false;
    return $use;
}

/**
 * Отключаем гутенберга на определенном шаблоне
 */
add_action('init', 'wph_hide_editor', 10);
function wph_hide_editor() {
  $post_id = isset($_GET['post']) ? $_GET['post'] : isset($_POST['post_ID']) ;
  if(!isset($post_id)) return;

  $template_file = get_post_meta($post_id, '_wp_page_template', true);
  if($template_file == 'template/gallery-inner.php'){
      remove_post_type_support('post', 'editor');
  }
}

/**
 * Удаляем груповые действия: деактивировать и удалить плагина
 */
add_filter( 'plugin_action_links', 'disable_plugin_deactivation', 10, 2 );
function disable_plugin_deactivation( $actions, $plugin_file ) {
  // Удаляет действие "Редактировать" у всех плагинов
  unset( $actions['edit'] );

  // Удаляет действие "Деактивировать" у важных для сайта плагинов
  $important_plugins = array(
    'advanced-custom-fields-pro/acf.php',
  );
  if ( in_array( $plugin_file, $important_plugins ) ) {
    unset( $actions['deactivate'] );
    $actions[ 'info' ] = '<b class="musthave_js">Обязателен для темы</b>';
  }

  return $actions;
}

// не помню что это, но это связано с деактивацией плагина
add_filter( 'admin_print_footer_scripts-plugins.php', 'disable_plugin_deactivation_hide_checkbox' );
function disable_plugin_deactivation_hide_checkbox( $actions ){
 ?>
<script>
 jQuery(function($){
  $('.musthave_js').closest('tr').find('input[type="checkbox"]').remove();
});
</script>
<?php
}

/**
 * Отключаем обновление плагина
 */
add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );
function disable_plugin_updates( $value ) {

    $pluginsToDisable = [
        'advanced-custom-fields-pro/acf.php',
    ];

    if ( isset($value) && is_object($value) ) {
        foreach ($pluginsToDisable as $plugin) {
            if ( isset( $value->response[$plugin] ) ) {
                unset( $value->response[$plugin] );
            }
        }
    }
    return $value;
}

/**
 * Заменяем стандартное название в подвале старницы админки "Спасибо вам за творчество с WordPress."
 */
add_filter('admin_footer_text', function ()	{
  echo '<span id="footer-thankyou">'.__('Сделано с любовью').'&nbsp;<a href="https://ibryl.store/profile/"><b>iBryl.Store</b></a></span>';
};