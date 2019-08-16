<?php  

class SliderWidgetAR extends ElementorWidgetAR {
  
  public function setup_settings() {
    $this->name = "slider__main";
    $this->title = "Слайдер";
    $this->icon = "fa fa-address-card-o";
      
    $this->fields = array( 	array("title","Заголовок","text"),
                            array("image","Изображение","image"),
                            array("items",
                                  "Слайды",
                                  "repeater", 
                                   [ 
                                      array("text","Содержание","text"), 
                                   ], 
                                   'text'), 
                            
                    );   
  }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new SliderWidgetAR );

 
  
   
class SliderFeiWidgetAR extends ElementorWidgetAR {
  
  public function setup_settings() {
    $this->name = "slider__girls";
    $this->title = "Слайдер фей";
    $this->icon = "fa fa-address-card-o";
    
    $wp_query = new WP_Query;
    $items = $wp_query->query(["post_type" => "fei", "posts_per_page" => -1]);
    $options = [];
    foreach($items as $item) {
      $options[$item->ID] = $item->post_title;
    }
    
    $this->fields = array(  
                           	array("btn","Кнопка","text"),
                           	array("link","Ссылка","text"),
                            array("items",
                                  "Список",
                                  "repeater", 
                                   [ 
                                      array("girl","Заголовок раздела","select2", $options)
                                   ], 
                                   'title')
                            
                    );   
  }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new SliderFeiWidgetAR );

 
  
   
class AdvantagesWidgetAR extends ElementorWidgetAR {
  
  public function setup_settings() {
    $this->name = "blocks__advantages";
    $this->title = "Преимущества";
    $this->icon = "fa fa-address-card-o";
     
    $this->fields = array( 	array("title","Заголовок","text"), 
                            array("items",
                                  "Пункты",
                                  "repeater", 
                                   [ 
                                      array("text","Содержание","text"), 
                                   ], 
                                   'text'), 
                            
                    );   
  }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new AdvantagesWidgetAR );
  

    