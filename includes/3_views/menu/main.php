<?php
/**
 * $menu = $themeAR->get_items_tree_menu( 'main' );
 * <nav class="main-nav">
 * <ul class="main-nav-list">
 * foreach ( $menu[0]->childs as $item ) {
 *** $liClass = "main-nav-list__item";
 *** $aClass  = "main-nav-list__link";
 *** $title   = ( $item['title'] !== "#" ) ? $item['title'] : '';
 *** echo "<li class=" . $liClass . "><a href=" . $item['url'] . " class=$aClass>$title</a></li>";
 * }
 * </ul>
 * </nav>
 */