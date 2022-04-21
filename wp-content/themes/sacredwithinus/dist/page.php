<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<main role="main" aria-label="Content">
		<div class="white-content-container">
			<?php if($post->post_content != '') { ?>
				<div class="page-section">
					<div class="grid-container">
						<div class="grid-x grid-padding-x align-center">
							<div class="large-10 cell">
								<?php if( has_post_thumbnail() ) { ?>
									<div class="page-header-image">
										<?php thumbnail_image_tag( '100vw', 'large' ); ?>
									</div>
								<?php } ?>
								<div class="white-bg-section">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php get_template_part('partials/page', 'builder'); ?>
		</div>
	</main>

<?php endwhile; ?>
<?php else: ?>

	<?php get_template_part('partials/error', 'missing'); ?>

<?php endif; ?>

<?php get_footer(); ?>