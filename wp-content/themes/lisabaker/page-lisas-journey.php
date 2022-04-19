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
							<h1 class="about-page-title">Lisa's Journey</h1>
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'boilerplate' ), '', '' ); ?>
						</div>
						<div class="righthalfcontent">
							<div class="pullquote">
								<p>“Could I ever trust enough to let go of control and the need to “get it right”? I do not know. But what I do know is this: God’s love is big enough to include all of me, whether light or shadow.”</p>
							</div>
							<img src="https://sacredwithin.us/wp-content/themes/lisabaker/images/lisa-headshot-3.jpg" />
							<p class="quotebyline">Lisa Baker<br /><em>Spiritual Director</em></p>
							
							<br /><br /><br />
							<div class="pullquote">
								<p>“Life is all about returning home to the Sacred within. The journey seems to lead us to find a temporary residence in this purpose or that, and then beyond into being.”</p>
							</div>
						</div>
						<div class="clear"></div>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div>
<?php endwhile; ?>
<?php get_footer(); ?>