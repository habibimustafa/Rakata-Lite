<?php
/**
 * header.php
 * @package Rakata Lite
 * @since Rakata Lite 0.0.1
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php wp_title(); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php rk_head(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="container" class="row">
		<div id="col-left" class="three columns">
			<!-- Start Header -->
			<header id="header">
				<?php rk_logo(); ?>
			</header>
			<!-- End Header -->
			
			<!-- Start Navigation -->
			<nav id="navi" role="navigation">
				<?php rk_menu(); ?>
			</nav>
			<!-- End Navigation -->
			
			<!-- Start Sidebar -->
			<?php get_sidebar(); ?>
			<!-- End Sidebar -->
		</div>
		<div id="col-right" class="nine columns">
			<!-- Start Mainpage -->
			<section id="content">
