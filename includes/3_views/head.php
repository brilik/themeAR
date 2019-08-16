<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" charset=<?php bloginfo('charset'); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
    <meta name="viewport" id="vp" content="width=device-width, initial-scale=1">
    <title><?php echo wp_title(); ?></title>
    <style>
        .loaded .main-wrapper{overflow:hidden;opacity:0;}.lds-ellipsis{display:none;position:fixed;left:50%;top:50%;margin-left:-40px;margin-left:-40px;width:80px;height:80px}.lds-ellipsis div{position:absolute;top:33px;width:13px;height:13px;border-radius:50%;background:#FF8372;animation-timing-function:cubic-bezier(0,1,1,0)}.lds-ellipsis div:nth-child(1){left:8px;animation:lds-ellipsis1 .6s infinite}.lds-ellipsis div:nth-child(2){left:8px;animation:lds-ellipsis2 .6s infinite}.lds-ellipsis div:nth-child(3){left:32px;animation:lds-ellipsis2 .6s infinite}.lds-ellipsis div:nth-child(4){left:56px;animation:lds-ellipsis3 .6s infinite}@keyframes lds-ellipsis1{0%{transform:scale(0)}100%{transform:scale(1)}}@keyframes lds-ellipsis3{0%{transform:scale(1)}100%{transform:scale(0)}}@keyframes lds-ellipsis2{0%{transform:translate(0,0)}100%{transform:translate(24px,0)}}.loaded .lds-ellipsis{display:block}
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('loaded') ?>>

<?php ar_the_view("header"); ?>