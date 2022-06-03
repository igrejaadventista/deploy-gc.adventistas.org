<?php ob_start(); ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta http-equiv="Content-Language" content="pt,es">
	<title><?php bloginfo('name'); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>"/>

	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php bloginfo('name'); ?>">
	<meta property="og:url" content="https://downloads.adventistas.org/pt/">
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
	<meta property="og:image" content="https://files.adventistas.org/gc/favicon.jpg">
	<meta property="og:description" content="<?php bloginfo('description'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
