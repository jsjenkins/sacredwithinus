<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>

		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://i.icomoon.io/public/327b1321f9/SacredWithinUs/style.css">

		<?php wp_head(); ?>

		<?php the_field('gtm_head', 'options'); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php the_field('gtm_body', 'options'); ?>

		<div class="off-canvas position-right" id="offCanvas" data-off-canvas data-trap-focus="true">
			<ul class="off-canvas-navigation">
	        	<?php display_simple_navigation('primary'); ?>
	        	<ul class="social">
					<?php if( get_field('facebook_url', 'options') ) { ?>
						<li><a href="<?php the_field('facebook_url', 'options'); ?>" target="_blank"><i class="icon-facebook"></i> <span class="visually-hidden">Facebook</span></a></li>
					<?php } ?>

					<?php if( get_field('twitter_url', 'options') ) { ?>
						<li><a href="<?php the_field('twitter_url', 'options'); ?>" target="_blank"><i class="icon-twitter"></i> <span class="visually-hidden">Twitter</span></a></li>
					<?php } ?>

					<?php if( get_field('instagram_url', 'options') ) { ?>
						<li><a href="<?php the_field('instagram_url', 'options'); ?>" target="_blank"><i class="icon-instagram"></i> <span class="visually-hidden">Instagram</span></a></li>
					<?php } ?>																		
				</ul>
	        	<button class="close-off-canvas" aria-label="Close menu" type="button" data-close>
			      Close Menu
			    </button>
	        </ul>
		</div>
		<div class="off-canvas-content" data-off-canvas-content>
			<header class="header" role="banner">
				<div class="accessibility-nav">
					<a href="#main-content" class="skip-link">Skip to Main Content</a>
				</div>
				<?php if( get_field('alert_toggle', 'options') ) { ?>
					<div class="alert-bar">
						<button class="close-button" data-close>&times;</button>
						<?php the_field('alert_copy', 'options'); ?>
					</div>
				<?php } ?>
				<div class="top-bar">
					<div class="grid-container" id="main-navigation">
						<div class="grid-x grid-padding-x">
							<div class="cell">
								<nav class="main-nav">
									<?php display_navigation('primary'); ?>
								</nav>
								<ul class="social">
									<?php if( get_field('facebook_url', 'options') ) { ?>
										<li><a href="<?php the_field('facebook_url', 'options'); ?>" target="_blank"><i class="icon-facebook"></i> <span class="visually-hidden">Facebook</span></a></li>
									<?php } ?>

									<?php if( get_field('twitter_url', 'options') ) { ?>
										<li><a href="<?php the_field('twitter_url', 'options'); ?>" target="_blank"><i class="icon-twitter"></i> <span class="visually-hidden">Twitter</span></a></li>
									<?php } ?>

									<?php if( get_field('instagram_url', 'options') ) { ?>
										<li><a href="<?php the_field('instagram_url', 'options'); ?>" target="_blank"><i class="icon-instagram"></i> <span class="visually-hidden">Instagram</span></a></li>
									<?php } ?>																		
								</ul>
								<div class="mobile-nav-toggle">
								<a href="#" class="off-canvas-toggle" data-toggle="offCanvas" aria-label="Mobile Navigation">
										<div></div>
										<div></div>
										<div></div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="grid-container">
					<div class="grid-xgrid-padding-x">
						<div class="cell">
							<a href="<?php echo home_url(); ?>" class="logo">
								<img src="<?php echo get_image_directory(); ?>/the-sacred-within-logo.png" alt="" class="logo-img" />
								<ul class="tagline">
									<?php if( get_field('logo_word_1', 'options') ) { ?>
										<li><?php the_field('logo_word_1', 'options'); ?></li>
									<?php } ?>
									<?php if( get_field('logo_word_2', 'options') ) { ?>
										<li><?php the_field('logo_word_2', 'options'); ?></li>
									<?php } ?>
									<?php if( get_field('logo_word_3', 'options') ) { ?>
										<li><?php the_field('logo_word_3', 'options'); ?></li>
									<?php } ?>
								</ul>
								<div class="name">
									by <span>Lisa B. Baker</span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</header>
