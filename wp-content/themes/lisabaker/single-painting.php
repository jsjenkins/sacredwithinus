<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="singlepostcontainer">
				<div class="singlepost" style="margin: 0 auto; float: none;">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<h1 class="single-title"><?php the_title(); ?></h1>
                    <?php 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 

				if ($image) : ?>
    				<img src="<?php echo $image[0]; ?>" class="postfeature" />
				<?php endif; ?>
					<?php if(get_field('price')!="") { ?>
						<div class="entry-meta">
							<h2 style="margin-bottom: 0;">Price: <?php the_field('price'); ?></h2>
							<a href="/about/" class="contentmorebutton" style="color: #fff; margin-top: 10px; margin-bottom: 25px;">Contact Lisa to Purchase</a>
						</div>
					<?php } ?>
					<div class="entry-content">

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
					</div><!-- .entry-content -->
<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<footer id="entry-author-info">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'boilerplate_author_bio_avatar_size', 60 ) ); ?>
						<h2><?php printf( esc_attr__( 'About %s', 'boilerplate' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<?php printf( __( 'View all posts by %s &rarr;', 'boilerplate' ), get_the_author() ); ?>
						</a>
					</footer><!-- #entry-author-info -->
<?php endif; ?>
					<!--<footer class="entry-utility">
						<?php boilerplate_posted_in(); ?>-->
					<!--</footer><!-- .entry-utility -->
				</article><!-- #post-## -->
<?php endwhile; // end of the loop. ?>
				</div>
            <div class="clear"></div>
            </div>
<?php get_footer(); ?>
