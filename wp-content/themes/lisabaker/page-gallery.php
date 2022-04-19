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
	<div class="centered-column">
						<?php $args = array( 'post_type' => 'painting', 'posts_per_page' => -1 );

							$loop = new WP_Query( $args );

							while ( $loop->have_posts() ) : $loop->the_post(); ?>

                        	
							<?php 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 

				if ($image) : ?>
    				<div class="gallerypost">
    				<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" class="galleryfeature" /></a>
				<?php endif; ?>  
                            <a href="<?php the_permalink(); ?>"><h2 class="gallerytitle" style="margin-bottom: 5px;"><?php the_title(); ?><?php if(get_field('price')!="") { ?><span style="color:#222"> &bull; <?php the_field('price'); ?><?php } ?></span></h2></a>
                            <?php if(get_field('price')!="") { ?><a href="http://sacredwithin.us/about/">Contact Lisa to Purchase</a><?php } ?>

                        </div>

						<?php endwhile; ?>
	</div>
<?php get_footer(); ?>