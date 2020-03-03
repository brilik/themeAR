<?php

class ThemeAR {
    public $section_customizer;
    public $options_customizer;
    public $acf_page;

    public function __construct() {
        $this->section_customizer = array();
        $this->options_customizer = array();
        $this->acf_page           = array();
        add_action( 'init', array( $this, 'init_themes' ), 11 );
        add_action( 'customize_register', array( $this, 'theme_customize' ), 1, 11 );
    }

    public static function split_into_equal_columns_with_rounding( $arr, int $column = 2 ) {
        return array_chunk( $arr, ceil( count( $arr ) / $column ) );
    }

    public function init_themes() {
        include $this->get_dir_path() . "/settings/roles.php";
        include $this->get_dir_path() . "/settings/data_types.php";
        include $this->get_dir_path() . "/settings/customize.php";
        include $this->get_dir_path() . "/settings/crons.php";
    }

    public function get_dir_path() {
        return get_parent_theme_file_path();
    }

    function theme_customize( $customizer ) {

        foreach ( $this->section_customizer as $section ) {
            $customizer->add_section(
                'section_' . $section["internal_name"],
                array(
                    'title'       => $section["title"],
                    'description' => '',
                    'priority'    => 10,
                )
            );
        }

        foreach ( $this->options_customizer as $name => $option ) {
            $name = "setting_" . $name;
            $customizer->add_setting(
                $name,
                array( 'default' => $option["default"] )
            );

            $customizer->add_control(
                $name,
                array(
                    'label'   => $option["title"],
                    'section' => 'section_' . $option["section_name"],
                    'type'    => $option["type"],
                    'choices' => $option["choices"]
                )
            );
        }
    }

    public function the_src() {
        echo get_template_directory_uri();
    }

    public function the_tag_title() {
        global $page, $paged;

        wp_title( '|', true, 'right' );

        // Add the blog name.
        bloginfo( 'name' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            echo " | $site_description";
        }

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 ) {
            echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
        }
    }

    /*Title Page Tag*/

    public function add_section( $internal_name, $title ) {
        $this->section_customizer[] = array( "internal_name" => $internal_name, "title" => $title );
    }

    public function add_option( $section_name, $internal_name, $title, $default, $type = "text", $choices = array() ) {
        $this->options_customizer[ $internal_name ] = array(
            "section_name" => $section_name,
            "title"        => $title,
            "default"      => $default,
            "type"         => $type,
            "choices"      => $choices
        );
    }

    function the_option( $setting_name ) {
        echo $this->get_option( $setting_name );
    }

    function get_option( $setting_name ) {
        $val = get_theme_mod( "setting_" . $setting_name );

        if ( $val === false && isset( $this->options_customizer[ $setting_name ] ) ) {
            $val = $this->options_customizer[ $setting_name ]["default"];
        }

        return $val;
    }

    function get_padej( $val, $args = array( " часов", " час", " часа" ) ) {
        $d   = $val % 10;
        $dd  = $val % 100;
        $str = $args[0];

        if ( $val > 9 && $val < 21 ) {

        } else if ( $d == 1 && $dd != 11 ) {
            $str = $args[1];
        } else if ( $d > 1 && $d < 5 ) {
            $str = $args[2];
        }

        return $str;
    }

    function the_view( $view_name, $args = [] ) {
        try {
            if ( $view_name == "" ) {
                throw new Exception( "View name empty." );
            }
            $view_name = str_replace( "__", "/", $view_name );

            $file_name = VIEWS_DIR . $view_name;
            if ( ! file_exists( $file_name . ".php" ) ) {
                throw new Exception( "The file {$file_name}.php not exists" );
            }
            global $themeAR;
            include "{$file_name}.php";

        } catch ( Exception $e ) {
            echo "Error: " . $e->getMessage();
        }
    }

    function create_post_type(
        $title, $internalname, $public = true, $arr = array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'comments'
    )
    ) {

        $gutenberg = false;

        if ( in_array( 'gutenberg', $arr ) ) {
            $gutenberg = true;
        }

        $labels = array(
            'name'              => _x( $title, 'post type general name', 'your_text_domain' ),
            'singular_name'     => _x( $title, 'post type singular name', 'your_text_domain' ),
            'parent_item_colon' => '',
            'menu_name'         => __( $title, 'your_text_domain' )

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
            'show_in_rest'       => $gutenberg,
            'supports'           => $arr
        );

        register_post_type( $internalname, $args, $internalname );
    }

    function create_taxonomy( $title, $inernalname, $posttype, $public = true ) {

        $labels = array(
            'name'              => $title,
            'singular_name'     => 'Наименование ',
            'search_items'      => 'Поиск ',
            'all_items'         => 'Все ',
            'parent_item'       => 'Родительская',
            'parent_item_colon' => 'Родительская:',
            'edit_item'         => 'Редактировать ',
            'update_item'       => 'Сохранить ',
            'add_new_item'      => 'Добавить',
            'new_item_name'     => 'Новая ',
            'menu_name'         => $title
        );


        $args = array(
            'label'                 => '',// определяется параметром $labels->name
            'labels'                => $labels,
            'public'                => $public,
            'publicly_queryable'    => true,
            'show_in_nav_menus'     => true, // равен аргументу public
            'show_ui'               => true, // равен аргументу public
            'show_tagcloud'         => true, // равен аргументу show_ui
            'hierarchical'          => true,
            'update_count_callback' => '',
            'rewrite'               => true,
            'query_var'             => $inernalname,
            'capabilities'          => array(),
            '_builtin'              => false,
        );


        register_taxonomy( $inernalname, $posttype, $args );
    }

    function get_last_posts_blog( $count = 10 ) {
        $wp_query     = new WP_Query;
        $posts_blog   = $wp_query->query( [ "post_type" => "post", "posts_per_page" => $count ] );
        $result_posts = [];
        foreach ( $posts_blog as $p ) {
            $result_posts[] = new BlogPost( $p );
        }
        unset( $wp_query );

        return $result_posts;
    }

    function get_items_tree_menu( $location ) {
        if ( has_nav_menu( $location ) ) {

            $locations = get_nav_menu_locations();
            $m_items   = array();

            if ( isset( $locations[ $location ] ) ) {
                $menu       = wp_get_nav_menu_object( $locations[ $location ] ); // получаем ID
                $menu_items = wp_get_nav_menu_items( $menu ); // получаем элементы меню

                _wp_menu_item_classes_by_context( $menu_items );

                $m_items['title_menu'] = $menu->name;

                foreach ( (array) $menu_items as $key => $menu_item ) {
//	 var_dump($menu_item);
                    $parent = $menu_item->menu_item_parent;
//var_dump($parent);
                    if ( ! $parent ) {
                        $parent = 0;
                    }
                    $m_items[ $parent ]->childs[ $menu_item->ID ]["ID"]      = $menu_item->ID;
                    $m_items[ $parent ]->childs[ $menu_item->ID ]["url"]     = $menu_item->url;
                    $m_items[ $parent ]->childs[ $menu_item->ID ]["title"]   = $menu_item->title;
                    $m_items[ $parent ]->childs[ $menu_item->ID ]["active"]  = ( array_search( "current-menu-item", $menu_item->classes ) !== false );
                    $m_items[ $parent ]->childs[ $menu_item->ID ]["classes"] = $menu_item->classes;
                }

                return $m_items;
            }
        }

        return array();
    }

    /**
     * Функция обрезки текста по словам
     *
     * @param string $str
     * @param int $length
     * @param string $postfix
     *
     * @return bool|string
     */
    public function get_cut_by_words( string $str, int $length = 100, string $postfix = '...' ) {

        // уберём все html элементы
//        $str = strip_tags($str);

        // проверяем на полное слово
        if ( strlen( $str ) <= $length ) {
            return $str;
        }

        // обрежем на определённое количество символов
        $str = substr( $str, 0, $length );

        // убедимся, что текст не заканчивается восклицательным знаком, запятой, точкой или тире
        $str = rtrim( $str, "!,.- " );

        // устраняем последний пробел
        $str = substr( $str, 0, strrpos( $str, ' ' ) );

        return $str . $postfix;
    }

    /**
     * Подсчитывает количество слов, входящих в строку.
     *
     * @param $string
     * @param int $readingSpeed defaul: 120
     *
     * @return string
     */
    public function get_str_word_count( $string, $readingSpeed = 120 ) {
        // Get count words and string to Cyrilics
        $words = str_word_count( strip_tags( $string ), 0, "АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя" );

        return $this->bm_estimated_reading_time( $words, $readingSpeed );
    }

    /**
     * Оценивает время необходимое для прочтения статьи.
     *
     * @return string
     */
    private static function bm_estimated_reading_time( $words, $readingSpeed ) {

        $minutes = floor( $words / $readingSpeed );
        $minutes = str_pad( $minutes, 2, '0', STR_PAD_LEFT );
        $seconds = floor( $words % $readingSpeed / ( $readingSpeed / 60 ) );
        $seconds = str_pad( $seconds, 2, '0', STR_PAD_LEFT );

        if ( 1 <= $minutes ) {
            $estimated_time = $minutes . ':' . ( $minutes == 1 ? '' : '' ) . $seconds . ( $seconds == 1 ? '' : '' );
        } else {
            $estimated_time = '0:' . $seconds . ( $seconds == 1 ? '' : '' );
        }

        return $estimated_time;

    }

    /**
     * Очищаем лишние символы из номера. Символ + опционально
     *
     * @param string $phone
     * @param bool $plus
     *
     * @return string|string[]|null
     */
    public function get_clear_phone( string $phone, bool $plus = true ) {
        $pattern = ( $plus ) ? '![^0-9]!' : '![^0-9+]!';

        return preg_replace( $pattern, '', $phone );
    }

    /**
     * Конвертирует "hex to rgb" \ "rgb to hex" в зависимости от переданного формата и добовляем opacity.
     *
     * @param string $color
     * @param bool $opacity
     *
     * @return array|string|string[]|null
     */
    public function convert_color( string $color, bool $opacity = false ) {
        $out = 'Need hex or rgb';
        $hex = '#';
        $rgb = 'rgb';

        if ( strripos( $color, $hex ) !== false ) {
            list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );

            if ( $opacity === true ) {
                $out = $this->rgb_2_rgba( "rgb($r,$g,$b)" );
            } //"rgba($r, $g, $b, .2)";
            else {
                $out = "rgb ($r,$g,$b)";
            }
        }

        if ( strripos( $color, $rgb ) !== false ) {
            $color = preg_replace( '/[a-z_()]/i', '', $color );
            $rgb   = explode( ',', $color );
            $out   = sprintf( "#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2] );
        }

        return $out;
    }

    /**
     * Изменяем rgb() в rgba() и добовляем opacity.
     *
     * @param string $rgb
     * @param string $opacity
     *
     * @return array|string|string[]|null
     */
    public function rgb_2_rgba( string $rgb, string $opacity = '.2' ) {
        $rgb = preg_replace( '/[a-z_()]/i', '', $rgb );
        $rgb = explode( ',', $rgb );
        $rgb = "rgba($rgb[0],$rgb[1],$rgb[2], $opacity)";

        return $rgb;
    }

    /**
     * Вывести кастомизированную пагинацию.
     *
     * @param array $args
     * @param string $class
     */
    public function the_wp_custom_pagination( $args = [], $class = 'pagination-list-wrap' ) {

        if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
            return;
        }

        $args = wp_parse_args( $args, [
            'mid_size'  => 4,
            'prev_next' => false,
            'prev_text' => __( 'Prev', 'textdomain' ),
            'next_text' => __( 'Next', 'textdomain' ),
        ] );

        $links     = paginate_links( $args );
        $next_link = get_previous_posts_link( $args['next_text'] );
        $prev_link = get_next_posts_link( $args['prev_text'] );
        $template  = apply_filters( 'the_so37580965_navigation_markup_template', '
            <div id="nav" class="navigation %1$s" role="navigation">
                <ul class="pagination-list wow fadeInUp">%4$s</ul>
            </div>', $args, $class );

        echo sprintf( $template, $class, $args['screen_reader_text'], $prev_link, $links, $next_link );

        ?>
        <script defer='defer'>
            var $from = $('#nav span');

            var newname = '<li class="pagination-list__item active"><a href="#" class="pagination-list__link"></a></li>';

            $('#nav a').wrap('<li>');
            $('#nav li > a').addClass('pagination-list__link');

            $($from).wrapInner(newname);
        </script>
        <?php
    }

    /**
     * Разбитие числа на разряды. Отделение от десятичных.
     *
     * @param $number
     * @param int $decimals
     * @param string $dec_point
     * @param string $thousands_sep
     *
     * @return string
     */
    public function get_number_format( $number, $decimals = 0, $dec_point = ',', $thousands_sep = ' ' ) {
        return number_format( $number, $decimals, $dec_point, $thousands_sep );
    }

    /**
     * Находим и заменяем на значение.
     *
     * @param $search_tag
     * @param $needly_tag
     * @param $text
     *
     * @return string|string[]|null
     */
    public function get_wrap_content( $search_tag, $needly_tag, $text ) {
        $res = preg_replace( "/($search_tag)/i", "$needly_tag", "$text" );

        return $res;
    }

    /**
     * Получить рейтинг из числа meta_box поста.
     *
     * @return string
     */
    public function get_rating() {
        $rating = get_post_meta( get_the_ID(), 'rating', true );

        $html = '';
        if ( $rating ) {
            $html .= '<ul class="about-us-rating">';
            for ( $i = 0; $i < $rating; $i ++ ) {
                $html .= '<li><span class="icon-star-hover"></span></li>';
            }
            $html .= '</ul>';
        }

        return $html;
    }

    /**
     * Разбить строку на массив и получить.
     *
     * @param $str
     *
     * @return array
     */
    public function get_string_to_array( $str ) {
        return explode( " ", $str );
    }

    /**
     * Выводит определенные классы для тэга <header>.
     *
     * @param string $custom_class
     */
    public function header_class( $custom_class = '' ) {

        $classes = array();

        if ( ! empty( $custom_class ) ) {
            if ( is_array( $custom_class ) ) {
                foreach ( $custom_class as $class ) {
                    $classes[] = $class;
                }
            }

            if ( is_string( $custom_class ) ) {
                $classes[] = $custom_class;
            }
        }

        if ( is_page( array( 6, 'about-us', 'About us' ) ) ||
             is_page( array( 9, 'we-care', 'We care' ) ) ||
             is_page( array( 11, 'support', 'Support' ) ) ||
             is_page( array( 112, 'blog', 'Blog' ) ) ||
             is_singular( 'blog' ) ||
             is_privacy_policy()
        ) {
            $classes[] = 'header-inner_mod';
        }

        if ( is_404() ||
             is_singular( 'bike' ) ||
             is_page_template( array(
                 'tpl-page/step2.php',
                 'tpl-page/step3.php',
                 'tpl-page/step4.php',
                 'tpl-page/step5.php',
                 'tpl-page/step6.php'
             ) )
        ) {
            $classes[] = 'header-inner';
        }


        echo ' class="' . join( ' ', array_unique( $classes ) ) . '"';
    }

    /**
     * Wrap text.
     *
     * @param string $html
     * @param string $needly_text_wrap
     *
     * @return bool|string|string[]|null
     */
    public function get_wrap_text( string $html, string $needly_text_wrap ) {
        if ( empty( $html ) ) {
            return false;
        }

        $html = preg_replace( '/\b(' . $needly_text_wrap . ')/si', '<a href="#win_4" class="fancybox">$1</a>', $html );

        return $html;
    }

    public function pagination( $pages = '', $range = 4 ) {
        $showitems = ( $range * 2 ) + 1;

        global $paged;
        if ( empty( $paged ) ) {
            $paged = 1;
        }

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if ( ! $pages ) {
                $pages = 1;
            }
        }

        if ( 1 != $pages ) {

//        echo "<div class=\"blog-pagination\"><span>Page " . $paged . " of " . $pages . "</span>";

            if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
                echo "<a href='" . get_pagenum_link( 1 ) . "'>&laquo; First</a>";
            }
            if ( $paged > 1 && $showitems < $pages ) {
                echo "<a href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo; Previous</a>";
            }

            echo '<a href="' . get_pagenum_link( $paged - 1 ) . '" class="blog-pag"><span class="icon-arrow-left"></span></a>';

            echo '<ul class="blog-pag__list">';
            for ( $i = 1; $i <= $pages; $i ++ ) {
                if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {

                    $active = ( $paged == $i ) ? ' active' : '';

                    $link = "<a href='" . get_pagenum_link( $i ) . "'>" . $i . "</a>";
                    $item = '<li class="' . $active . '">' . $link . '</li>';

                    echo $item;
                }
            }
            echo '</ul>';

            echo '<a href="' . get_pagenum_link( $paged + 1 ) . '" class="blog-pag"><span class="icon-arrow-right"></span></a>';


//        if ( $paged < $pages && $showitems < $pages ) {
//            echo "<a href=\"" . get_pagenum_link( $paged + 1 ) . "\">Next &rsaquo;</a>";
//        }
//        if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
//            echo "<a href='" . get_pagenum_link( $pages ) . "'>Last &raquo;</a>";
//        }
            echo "</div>";
        }
    }


    // numbered pagination

    /**
     * Высчитать кол-во дней, недель, лет между двумя датами.
     *
     * @param $datetime1
     * @param $datetime2
     *
     * @return array
     */
    public function search_number_time_beetwen_two_dates( $datetime1, $datetime2 ) {

        $res        = [];
        $day        = $weekly = 0;
        $difference = $datetime1->diff( $datetime2 );

        for ( $i = 0; $i < $difference->d; $i ++ ) {
            $day ++;
            if ( $day == 7 ) {
                $weekly ++;
                $day = 0;
            }
        }

        $res['day']    = $day;
        $res['weekly'] = $weekly;

        return $res;
    }

    /**
     * Получить сумму цен умноженую на его кол-во
     *
     * @param array $arr
     *
     * @return float|int|mixed
     */
    public function get_summ_prices_in_array_include_count( array $arr ) {

        $res = 0;

        foreach ( $arr as $item ) {
            if ( empty( $item['count'] ) ) {
                $res += $item['price'];
            } else {
                $res += ( $item['price'] * $item['count'] );
            }
        }

        return $res;
    }

    /**
     * ACF. ДОБАВЛЯЕМ СВОЙ ПУНКТ МЕНЮ В АДМИНКУ
     */
    public function acf_add_page( $page_title, $menu_title, $icon_url = 'dashicons-laptop' ) {

        if ( function_exists( 'acf_add_options_page' ) ) {
            // add parent
            $parent = acf_add_options_page( array(
                'page_title' => $page_title,
                'menu_title' => $menu_title,
                'menu_slug'  => self::get_cyr_2_lat( $menu_title, '-' ),
                'capability' => 'edit_posts',
                'redirect'   => false,
                'icon_url'   => $icon_url, //dashicons-screenoptions
                'position'   => '2.3'
            ) );
        }

        $this->acf_page = $parent;
    }

    public static function get_cyr_2_lat( string $str, string $replaceSpaceWith = '' ) {

        $cyr = [
            'а',
            'б',
            'в',
            'г',
            'д',
            'е',
            'ё',
            'ж',
            'з',
            'и',
            'й',
            'к',
            'л',
            'м',
            'н',
            'о',
            'п',
            'р',
            'с',
            'т',
            'у',
            'ф',
            'х',
            'ц',
            'ч',
            'ш',
            'щ',
            'ъ',
            'ы',
            'ь',
            'э',
            'ю',
            'я',
            'А',
            'Б',
            'В',
            'Г',
            'Д',
            'Е',
            'Ё',
            'Ж',
            'З',
            'И',
            'Й',
            'К',
            'Л',
            'М',
            'Н',
            'О',
            'П',
            'Р',
            'С',
            'Т',
            'У',
            'Ф',
            'Х',
            'Ц',
            'Ч',
            'Ш',
            'Щ',
            'Ъ',
            'Ы',
            'Ь',
            'Э',
            'Ю',
            'Я'
        ];
        $lat = [
            'a',
            'b',
            'v',
            'g',
            'd',
            'e',
            'io',
            'zh',
            'z',
            'i',
            'y',
            'k',
            'l',
            'm',
            'n',
            'o',
            'p',
            'r',
            's',
            't',
            'u',
            'f',
            'h',
            'ts',
            'ch',
            'sh',
            'sht',
            'a',
            'i',
            'y',
            'e',
            'yu',
            'ya',
            'A',
            'B',
            'V',
            'G',
            'D',
            'E',
            'Io',
            'Zh',
            'Z',
            'I',
            'Y',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'R',
            'S',
            'T',
            'U',
            'F',
            'H',
            'Ts',
            'Ch',
            'Sh',
            'Sht',
            'A',
            'I',
            'Y',
            'e',
            'Yu',
            'Ya'
        ];

        $str = str_replace( $cyr, $lat, $str );

        if ( ! empty( $replaceSpaceWith ) ) {
            $str = self::replace_space_2_symbol( $str, $replaceSpaceWith );
        }

        return $str;
    }

    private static function replace_space_2_symbol( string $str, string $sym = '_' ) {
        return str_replace( ' ', $sym, $str );
    }

    /**
     * ACF. ДОБАВЛЯЕМ СВОЙ ПОД ПУНКТ МЕНЮ В АДМИНКУ
     */
    public function acf_add_sub_page( $page_title, $menu_title ) {
        // add sub page
        acf_add_options_sub_page( array(
            'page_title'  => $page_title,
            'menu_slug'   => self::get_cyr_2_lat( $menu_title, '-' ),
            'menu_title'  => $menu_title,
            'parent_slug' => $this->acf_page['menu_slug'],
        ) );
    }

    /**
     * Получить иконку или массив
     *
     * @param string $icon_name
     *
     * @return array|mixed
     */
    public function get_icon( string $icon_name = 'all' ) {
        $url = $this->get_src() . '/assets/img/';
        $arr = array(
            'head-1'    => $url . 'head_icon1.svg',
            'head-2'    => $url . 'head_icon2.svg',
            'head-3'    => $url . 'head_icon3.svg',
            'system-1'  => $url . 'system_icon1.svg',
            'system-2'  => $url . 'system_icon2.svg',
            'system-3'  => $url . 'system_icon3.svg',
            'system-4'  => $url . 'system_icon4.svg',
            'system-5'  => $url . 'system_icon5.svg',
            'system-6'  => $url . 'system_icon6.svg',
            'guarant-1' => $url . 'guarant_icon1.svg',
            'guarant-2' => $url . 'guarant_icon2.svg',
            'guarant-3' => $url . 'guarant_icon3.svg',
            'guarant-4' => $url . 'guarant_icon4.svg',
        );

        if ( $icon_name == 'all' ) {
            return $arr;
        }

        return $arr[ $icon_name ];
    }

    public function get_src($addToPath = '') {
        return get_template_directory_uri();
    }

    public function add_zero_to_number( int $number ) {
        return str_pad( $number, 2, "0", STR_PAD_LEFT );
    }

    public function get_the_date_with_time($d = '', $post = null)
    {
        return human_time_diff( get_the_time('U',$post), current_time('timestamp') ) . ' назад';
    }

    public function get_title($delimiter = '|')
    {
        $res = '';
        if (is_front_page() || is_home() || is_page()){
            $res = bloginfo('name') . " $delimiter " . get_the_title();
        }
        elseif(is_archive() || is_category()) {
            echo bloginfo('name') . " $delimiter ";
            single_cat_title();
            $res = '';
        }
        elseif (is_single()){
            $res = get_the_title();
        } elseif (is_search()){
            $res = __('Результат поиска');
        }

        return $res;
    }
        /**
     * Обрезка текста (excerpt). Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
     *
     * @param string/array $args Параметры.
     *
     * @return string HTML
     *
     * @ver 2.6.5
     */
    public function get_excerpt($args = '')
    {
        global $post;

        if (is_string($args))
            parse_str($args, $args);

        $rg = (object)array_merge(array(
            'maxchar' => 350,   // Макс. количество символов.
            'text' => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
            // Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется
            // все до <!--more--> вместе с HTML.
            'autop' => true,  // Заменить переносы строк на <p> и <br> или нет?
            'save_tags' => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
            'more_text' => 'Читать дальше...', // Текст ссылки `Читать дальше`.
            'ignore_more' => false, // нужно ли игнорировать <!--more--> в контенте
        ), $args);

        $rg = apply_filters('kama_excerpt_args', $rg);

        if (!$rg->text)
            $rg->text = $post->post_excerpt ?: $post->post_content;

        $text = $rg->text;
        // убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
        $text = preg_replace('~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text);
        // убираем шоткоды: [singlepic id=3]. Учитывает markdown
        $text = preg_replace('~\[/?[^\]]*\](?!\()~', '', $text);
        $text = trim($text);

        // <!--more-->
        if (!$rg->ignore_more && strpos($text, '<!--more-->')) {
            preg_match('/(.*)<!--more-->/s', $text, $mm);

            $text = trim($mm[1]);

            $text_append = ' <a href="' . get_permalink($post) . '#more-' . $post->ID . '">' . $rg->more_text . '</a>';
        } // text, excerpt, content
        else {
            $text = trim(strip_tags($text, $rg->save_tags));

            // Обрезаем
            if (mb_strlen($text) > $rg->maxchar) {
                $text = mb_substr($text, 0, $rg->maxchar);
                $text = preg_replace('~(.*)\s[^\s]*$~s', '\\1' . $rg->more_text, $text); // кил последнее слово, оно 99% неполное
            }
        }

        // сохраняем переносы строк. Упрощенный аналог wpautop()
        if ($rg->autop) {
            $text = preg_replace(
                array("/\r/", "/\n{2,}/", "/\n/", '~</p><br ?/?>~'),
                array('', '</p><p>', '<br />', '</p>'),
                $text
            );
        }

        $text = apply_filters('kama_excerpt', $text, $rg);

        if (isset($text_append))
            $text .= $text_append;

        return ($rg->autop && $text) ? "<p>$text</p>" : $text;
    }
}

//$test = new ThemeAR();
//$test->