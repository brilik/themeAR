<?php 

class ThemeAR {
	public $section_customizer ; 
	public $options_customizer ; 
   
	public function __construct() { 
		$this->section_customizer = array();
		$this->options_customizer = array();
    add_action( 'init', array($this, 'init_themes'), 11 );  
    add_action('customize_register', array($this, 'theme_customize'), 1, 11);
	}
  
  public function get_dir_path() {
    return get_parent_theme_file_path();
  }
  
  public function init_themes() {
    include $this->get_dir_path()."/settings/roles.php";
    include $this->get_dir_path()."/settings/data_types.php";
    include $this->get_dir_path()."/settings/customize.php";
    include $this->get_dir_path()."/settings/crons.php"; 
  }
  
 function theme_customize($customizer) { 

    foreach($this->section_customizer as $section) {
      $customizer->add_section(
          'section_'.$section["internal_name"],
          array(
              'title' => $section["title"] ,
              'description' => '',
              'priority' => 10,
          )
        );
    }

    foreach($this->options_customizer as $name => $option) {
      $name =  "setting_".$name; 
      $customizer->add_setting(
          $name,
          array('default' => $option["default"])
      );

      $customizer->add_control(
          $name,
          array(
        'label' => $option["title"] ,
        'section' => 'section_'.$option["section_name"] ,
        'type' => $option["type"]  ,
        'choices' => $option["choices"]
          )
      );
    }
  }
  
	public function the_src() {
		echo get_template_directory_uri();
	}  
	public function get_src() {
		return get_template_directory_uri();
	}
  
/*Title Page Tag*/

	public function the_tag_title() {
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
	}
  
  
	public function add_section($internal_name, $title) {
		$this->section_customizer[] = array("internal_name" => $internal_name, "title" => $title);
	}

	public function add_option($section_name, $internal_name, $title, $default, $type = "text", $choices = array()) {
		$this->options_customizer[$internal_name] = array("section_name" => $section_name, "title" => $title, "default" => $default, "type" => $type, "choices" => $choices); 
	}

	function the_option($setting_name) {
		echo $this->get_option($setting_name);
	}

	function get_option($setting_name) { 
		$val = get_theme_mod("setting_".$setting_name); 

		if ($val === false && isset($this->options_customizer[$setting_name])) {
			$val = $this->options_customizer[$setting_name]["default"];
		}
		return $val;
	}

	function get_padej($val, $args = array(" часов"," час"," часа")) {
		$d = $val % 10;
		$dd = $val % 100;
		$str = $args[0];
		
		if ( $val > 9 && $val < 21) {
			
		} else if (  $d == 1 && $dd != 11  ) {
			$str = $args[1];
		} else if ( $d > 1 && $d < 5 ) {
			$str = $args[2];
		}
		return $str;
	}
  
  function the_view($view_name, $args = []) {
      try {
        if ($view_name == "") {
          throw new Exception("View name empty.");
        } 
        $view_name = str_replace("__","/",$view_name);

        $file_name = VIEWS_DIR.$view_name;
        if (!file_exists($file_name.".php")) {
           throw new Exception("The file {$file_name}.php not exists");
        }   
        global $themeAR;
        include "{$file_name}.php";

      } catch(Exception $e) {
        echo "Error: ".$e->getMessage();
      } 
  }
  
  function create_post_type($title, $internalname, $public = true, $arr = array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')) {

      $labels = array(
        'name'               => _x($title, 'post type general name', 'your_text_domain'),
        'singular_name'      => _x($title, 'post type singular name', 'your_text_domain'), 
        'parent_item_colon'  => '',
        'menu_name'          => __($title, 'your_text_domain')

      );

      $args = array(
        'labels'             => $labels,
        'public'             => $public,
        'publicly_queryable' => true,
        'show_ui'            => true, 
        'show_in_menu'       => true, 
        'query_var'          => true,
        'rewrite'            => array( 'slug' => _x( $internalname, 'URL slug', 'your_text_domain' ) ),
        'capability_type'    => 'post',
        'has_archive'        => true, 
        'hierarchical'       => true,
        'menu_position'      => 10,
        'supports'           => $arr
      ); 

      register_post_type($internalname, $args, $internalname ); 
    }

    function create_taxonomy($title, $inernalname, $posttype, $public = true) {

      $labels = array('name' => $title ,
          'singular_name' => 'Наименование ' ,
          'search_items' => 'Поиск ' ,
          'all_items' => 'Все ' ,
          'parent_item' => 'Родительская' ,
          'parent_item_colon' => 'Родительская:' ,
          'edit_item' => 'Редактировать ' ,
          'update_item' => 'Сохранить ' ,
          'add_new_item' => 'Добавить' ,
          'new_item_name' => 'Новая ' 
          ,'menu_name' => $title); 


      $args = array( 'label' => '' // определяется параметром $labels->name 
          ,'labels' => $labels 
          ,'public' => $public
          ,'publicly_queryable'    => true
          ,'show_in_nav_menus' => true // равен аргументу public 
          ,'show_ui' => true // равен аргументу public 
          ,'show_tagcloud' => true // равен аргументу show_ui 
          ,'hierarchical' => true 
          ,'update_count_callback' => '' 
          ,'rewrite' => true 
          ,'query_var' =>  $inernalname
          ,'capabilities' => array() 
          ,'_builtin' => false ); 


      register_taxonomy( $inernalname, $posttype, $args);
    }

   function get_last_posts_blog($count = 10) {
    $wp_query = new WP_Query;
    $posts_blog = $wp_query->query(["post_type" => "post", "posts_per_page" => $count]);
    $result_posts = [];
    foreach($posts_blog as $p) {
      $result_posts[] = new BlogPost($p);
    }
    unset($wp_query);
    return $result_posts;
  }
  
  
	function get_items_tree_menu($location) {
	    if (has_nav_menu($location)) {

		$locations = get_nav_menu_locations() ;
	 	$m_items = array();

		if( isset($locations[ $location ]) ){
			$menu = wp_get_nav_menu_object( $locations[ $location ] ); // получаем ID
	 		$menu_items = wp_get_nav_menu_items( $menu ); // получаем элементы меню
	  
			_wp_menu_item_classes_by_context( $menu_items );

			foreach ( (array) $menu_items as $key => $menu_item ){
//	 var_dump($menu_item);
				$parent = $menu_item->menu_item_parent;
//var_dump($parent);
				if (!$parent) {
					$parent = 0;
				}     
				$m_items[$parent]->childs[$menu_item->ID]["url"] =  $menu_item->url;
				$m_items[$parent]->childs[$menu_item->ID]["title"] = $menu_item->title;
				$m_items[$parent]->childs[$menu_item->ID]["active"] = (array_search("current-menu-item", $menu_item->classes) !== FALSE);
				$m_items[$parent]->childs[$menu_item->ID]["classes"] = $menu_item->classes; 
			}  
			return $m_items;
		} 
	    }

	    return array();
	}
}