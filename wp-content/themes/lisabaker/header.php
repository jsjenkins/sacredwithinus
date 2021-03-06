<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 * We filter the output of wp_title() a bit -- see
			 * boilerplate_filter_wp_title() in functions.php.
			 */
			wp_title( '|', true, 'right' );
		?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        	<script type="text/javascript" src="//use.typekit.net/tcy0gny.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
?>
	</head>
	<body <?php body_class(); ?>>
		<div id="bigcontainer">
    	
		<header>
		<nav id="access" class="mainnav" role="navigation">
			<div class="actualnav">
			<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
            <div class="mobileclear"></div>
            <div class="socialnetworks">
            	<a href="https://www.facebook.com/pages/Sacred-Within-Us/208073086022953" target="_blank"><img src="<?php bloginfo( 'template_directory' ); ?>/images/facebook.png" /></a>
            	<a href="https://twitter.com/sacredwithinus" target="_blank"><img src="<?php bloginfo( 'template_directory' ); ?>/images/twitter.png" /></a>
        	</div>
            <div class="clear"></div>
            
            </div>
        	</nav><!-- #access -->
        <div class="menutab">MENU <img src="<?php bloginfo( 'template_directory' ); ?>/images/menu.png" /></div>
        </header>
        <div id="bigmaincontainer">
		<h1 class="mainlogo desktoplogo">
			<a href="/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/logo.png" /></a>
		</h1>
		<h1 class="mainlogo mobilelogo">
			<a href="/"><img src="<?php bloginfo( 'template_directory' ); ?>/images/logo-mobile.png" /></a>
		</h1>
		
        <div id="fullcontainer">
		<section id="content" role="main">