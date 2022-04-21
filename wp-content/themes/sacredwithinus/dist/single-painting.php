<?php get_header(); ?>

<main role="main" aria-label="Content">
	<div class="page-section transparent-bg">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="large-10 cell">
					<?php if (have_posts()): while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('single-art'); ?>>

							<?php if ( has_post_thumbnail()) : ?>
								<div class="single-art-image">
									<?php the_post_thumbnail('large'); ?>
								</div>
							<?php endif; ?>

							<div class="single-art-content">

								<h1 class="script single-art-title"><?php the_title(); ?></h1>
								
								<?php if( get_field('medium') || the_field('size') ) { ?>
									<p class="single-art-details">
										<?php if( get_field('medium') ) { ?>
											<span class="single-art-medium"><?php the_field('medium'); ?></span><br />
										<?php } ?>
										<?php if( get_field('size') ) { ?>
											<span class="single-art-size"><?php the_field('size'); ?></span>
										<?php } ?>
									</p>
								<?php } ?>

								<?php the_content(); ?>

								<?php if( get_field('price') ) { ?>
									<div class="single-art-price"><?php the_field('price'); ?></div>
								
									<?php if( !str_contains(get_field('price'), 'has a home') && !str_contains(get_field('price'), 'Sold') ) { ?>
											<div class="single-art-purchase">
												<h3>Contact Lisa to Purchase</h3>
												<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true" field_values="artwork='.get_the_title().'"]'); ?>
											</div>
									<?php } ?>
								<?php } ?>				
							</div>

						</article>

					<?php endwhile; ?>

					<?php else: ?>

						<?php get_template_part('partials/error', 'missing'); ?>

					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
