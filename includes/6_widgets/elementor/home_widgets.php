<?php

class HeadLockWidgetAR extends ElementorWidgetAR {

    public function setup_settings() {
        $this->name  = "section__head";
        $this->title = "Head Lock";
        $this->icon  = "fa fa-address-card-o";

        $this->fields = array(
            [ "title", "Title", "text" ],
            [
                "bg-slider",
                "Background (slider)",
                "repeater",
                [
                    [ "image", "Image", "image" ],
                ],
                'text'
            ],
        );
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new HeadLockWidgetAR );