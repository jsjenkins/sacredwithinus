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
						<iframe src="https://player.vimeo.com/video/71074205?title=0&amp;byline=0&amp;portrait=0" width="1200" height="675" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<div class="lefthalfcontent">
							<h1 class="sd-page-title">Spiritual Direction</h1>
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'boilerplate' ), '', '' ); ?>
						</div>
						<div class="righthalfcontent">
							<div class="pullquote pullquotetop">
								<p>“The idea of the spiritual director as midwife appeals to me, for I would like to emulate Shiphrah and Puah in their courage and commitment.”</p>
 
							<p>“The midwife is present to another in a time of vulnerability, working in areas that are deep and intimate. It is a relationship of trust and mutual respect. “<p>
							<p class="quotebyline">-<em>Holy Listening</em>, Margaret Guenther</p>
							</div>
							<img src="https://sacredwithin.us/wp-content/themes/lisabaker/images/lisa-headshot-2.jpg" />
							<p class="quotebyline">Lisa Baker<br /><em>Spiritual Director</em></p>
						</div>
						<div class="clear"></div>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div>
<?php endwhile; ?>
<?php get_footer(); ?>