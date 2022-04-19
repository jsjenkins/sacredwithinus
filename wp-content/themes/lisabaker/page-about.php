<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="singlepostcontainer">
				<article id="post-<?php the_ID(); ?>" <?php post_class('fullwidth_content'); ?>>
					
					<div class="entry-content">
						<div class="lefthalfcontent">
							<h1 class="about-page-title">About Lisa B. Baker</h1>
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'boilerplate' ), '', '' ); ?>
						</div>
						<div class="righthalfcontent">
							<img style="margin-top:65px;" src="https://sacredwithin.us/wp-content/themes/lisabaker/images/lisa-headshot.jpg" />
							<p class="quotebyline">Lisa Baker<br /><em>Spiritual Director</em></p>
						</div>
						<div class="clear"></div>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div>
<?php endwhile; ?>
<?php get_footer(); ?>