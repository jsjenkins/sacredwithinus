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
							<h1 class="about-page-title">Spiritual Direction FAQs</h1>
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'boilerplate' ), '', '' ); ?>
						</div>
						<div class="righthalfcontent">
							<div class="pullquote">
								<p>“Spiritual Direction, at it’s best, is coming home to one’s truest, God created self to find a more embracing, compassionate heart.”</p>
							</div>
							<img src="https://sacredwithin.us/wp-content/themes/lisabaker/images/lisa-headshot-2.jpg" />
							<p class="quotebyline">Lisa Baker<br /><em>Spiritual Director</em></p>
							<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
							<div class="pullquote">
								<p>“Spiritual Direction is not as much about problem solving, overcoming or working toward as much as becoming spiritually present by embracing what is, letting go of what is not and trusting the Sacred within.”</p>
							</div>
							<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
							<div class="pullquote">
								<p>“A Spiritual Community Group can provide a safe environment to encouraging true growth among spiritual friends.”</p>
							</div>
						</div>
						<div class="clear"></div>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div>
<?php endwhile; ?>
<?php get_footer(); ?>