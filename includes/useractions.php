<?php 


foreach ( glob( __DIR__ . '/1_actions/*.php' ) as $file ) {
    include_once $file;
} 

$reviewadd = new ReviewAdd("reviewadd");
$anketaadd = new AnketaAdd("anketaadd");