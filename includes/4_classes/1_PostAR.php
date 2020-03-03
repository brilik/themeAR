<?php
class PostAR {
    private $post;
    public $field;

    public function __construct($post) {
        if (is_object($post)) {
            $this->post = $post;
        } else {
            $this->post = get_post((int)$post);
        }

        $custom_fields = get_post_custom($this->post->ID);

        foreach ( $custom_fields as $key => $value ) {
            $this->field[$key] = $value[0];
        }

    }

    public function get_ID() {
        return $this->post->ID;
    }

    public function get_title() {
        return $this->post->post_title;
    }
    public function get_content($format = true) {
        if ($format) {
            return apply_filters( 'the_content', $this->post->post_content );
        }
        return $this->post->post_content;
    }

    public function get_date() {
        //var_dump(  strtotime( get_field("order_date", $this->get_ID()) ) );
        return date( get_option("date_format"), strtotime($this->post->post_date )  );
    }

    public function get_datetime() {
        return date( get_option("date_format")." ".get_option('time_format'), strtotime($this->post->post_date ) );
    }

    public function get_link() {
        return get_permalink( $this->get_ID() );
    }


    public function get_image_src($size) {
        $src = get_the_post_thumbnail_url($this->get_ID(), $size);
        if (!$src) {
            global $theme_elizaveta;
            $src = $theme_elizaveta->get_src()."/img/portfolio-1.png";
        }
        return $src;
    }

    public function get_excerpt() {
        return $this->post->post_excerpt;
    }

}