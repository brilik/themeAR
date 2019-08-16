<?php

class ElementorWidgetAR extends \Elementor\Widget_Base {

  protected $name;
  protected $title;
  protected $fields;
  protected $icon;
  
  public function __construct( $data = [], $args = null ) {
    $this->setup_settings();
		parent::__construct( $data, $args );
  }
  
  protected function setup_settings() {
    $this->name = "EMPTY_NAME_WIDGET";
    $this->title = "EMPTY_TITLE_WIDGET";
    $this->fields = [];
    $this->icon = "fa";   
  }
   
  
	public function get_name() {  
		return $this->name;
	}

	public function get_title() {
		return $this->title;
	}
 
	public function get_icon() {
		return $this->icon;
	}
 
	public function get_categories() {
		return [ 'general' ];
	}

  protected function add_field_elemenor($field_item, $element) {
    $type = \Elementor\Controls_Manager::TEXT;
    $input_type = "text";
    $options = [];
    $fields = [];
    
    switch( $field_item[2] ) {
      case "select":
        $type = \Elementor\Controls_Manager::SELECT;
        $input_type = "";
        $options = $field_item[3];
        break;
      case "select2":
        $type = \Elementor\Controls_Manager::SELECT2;
        $input_type = "";
        $options = $field_item[3];
        break; 
      case "textarea":
        $type = \Elementor\Controls_Manager::TEXTAREA;
        $input_type = "textarea";
        break;
      case "image":
        $type = \Elementor\Controls_Manager::MEDIA; 
        break;
      case "tiny_mce":
        $type = \Elementor\Controls_Manager::WYSIWYG; 
        break;
      case "html":
        $type = \Elementor\Controls_Manager::CODE; 
        break; 
      case "icon":
        $type = \Elementor\Controls_Manager::ICON; 
        break; 
      case "repeater":
        $type = \Elementor\Controls_Manager::REPEATER; 
        $repeater = new \Elementor\Repeater();
          
        foreach($field_item[3] as $field_repeat) {
            $repeater = $this->add_field_elemenor($field_repeat, $repeater); 
        }
        $fields = $repeater->get_controls();
        
        break;  
    }

    $element->add_control(
      $field_item[0],
      [
        'label' => $field_item[1],
        'type' => $type,
        'input_type' => $input_type,
        'placeholder' => '',
        'options' => $options,
        'fields' => $fields
      ]
    ); 
    
    return $element;
  }
	protected function _register_controls() { 
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( $this->get_title(), 'artema' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    if ( count($this->fields) > 0 ) {
      foreach($this->fields as $field) {
/*
        if ( $field[2] == "repeater" ) {
          $repeater = new \Elementor\Repeater();
          
          foreach($field[3] as $field_repeat) {
              $this->add_field_elemenor($field_repeat, $repeater); 
          }
           
          
          $this->add_control(
              $field[0],
              [
                'label' => $field[1],
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(), 
                'title_field' => '{{{ '+$field[4]+' }}}',
              ]
            );

        } else {
*/
          $this->add_field_elemenor($field, $this);
//        }
        
      }
    }

		$this->end_controls_section();

	}
 
	protected function render() {
		$args = $this->get_settings_for_display();
    
    ar_the_view($this->get_name(), $args);
	}

}
 