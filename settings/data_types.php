<?php

global $themeAR;
 

$themeAR->create_post_type("Феи", "fei", true, array( 'title',   'editor',  'author', "page-attributes" ));
$themeAR->create_taxonomy("Категория", "catfei", ["fei"], false);
$themeAR->create_taxonomy("Метки", "tagfei", ["fei"], false);
$themeAR->create_post_type("FAQ", "faq", false, array( 'title',  'editor', 'author' ));
$themeAR->create_post_type("Отзывы", "review", false, array( 'title',  'editor', 'author' ));
 
