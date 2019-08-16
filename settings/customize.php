<?php
	global $themeAR;

	$themeAR->add_section("contact", "Контакты");
	$themeAR->add_section("header", "Шапка");
	$themeAR->add_section("forms", "Формы");  
	$themeAR->add_section("catsfei", "Категории и контакты");  


  $themeAR->add_option("forms", "emailanket",  "Email для анкет ", "");

  $themeAR->add_option("catsfei", "cat1_name",  "Категория №1: Название ", "");
  $themeAR->add_option("catsfei", "cat1_phone", "Категория №1: Телефон ", "");
  $themeAR->add_option("catsfei", "cat1_address", "Категория №1: Адрес ", "");
  $themeAR->add_option("catsfei", "cat1_metro", "Категория №1: Метро ", "");
  $themeAR->add_option("catsfei", "cat1_link",  "Категория №1: Ссылка ", "");
  $themeAR->add_option("catsfei", "cat1_hours", "Категория №1: Количество часов ", "");
  $themeAR->add_option("catsfei", "cat1_price", "Категория №1: Стоимость ", "");

  $themeAR->add_option("catsfei", "cat2_name",  "Категория №2: Название ", "");
  $themeAR->add_option("catsfei", "cat2_phone", "Категория №2: Телефон ", "");
  $themeAR->add_option("catsfei", "cat2_address", "Категория №2: Адрес ", "");
  $themeAR->add_option("catsfei", "cat2_metro", "Категория №2: Метро ", "");
  $themeAR->add_option("catsfei", "cat2_link",  "Категория №2: Ссылка ", "");
  $themeAR->add_option("catsfei", "cat2_hours", "Категория №2: Количество часов ", "");
  $themeAR->add_option("catsfei", "cat2_price", "Категория №2: Стоимость ", "");

  $themeAR->add_option("catsfei", "cat3_name",  "Категория №3: Название ", "");
  $themeAR->add_option("catsfei", "cat3_phone", "Категория №3: Телефон ", "");
  $themeAR->add_option("catsfei", "cat3_address", "Категория №3: Адрес ", "");
  $themeAR->add_option("catsfei", "cat3_metro", "Категория №3: Метро ", "");
  $themeAR->add_option("catsfei", "cat3_link",  "Категория №3: Ссылка ", "");
  $themeAR->add_option("catsfei", "cat3_hours", "Категория №3: Количество часов ", "");
  $themeAR->add_option("catsfei", "cat3_price", "Категория №3: Стоимость ", "");
 

/*
	$themeAR->add_option("contact", "email",  "Email", "");  
	$themeAR->add_option("contact", "address",  "Адрес", "");  
	$themeAR->add_option("contact", "skype",  "Skype", "");  
	$themeAR->add_option("contact", "telegram",  "Telegram", "");
	$themeAR->add_option("contact", "telegramnic",  "Telegram ник", "");  
*/

  register_nav_menus( array(
    'header'    => esc_html__( 'Меню в шапке', 'ar-tema' ),
    'header_cat'    => esc_html__( 'Меню категорий в шапке', 'ar-tema' ),
    'footer' => esc_html__( 'Меню в подвале', 'ar-tema' ), 
  ) );