<?php get_header(); ?>

<main role="main" aria-label="Content">
	<div class="page-section transparent-bg">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="large-10 cell">
					<?php if (have_posts()): while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>

							<h1 class="script single-post-title"><?php the_title(); ?></h1>

							<div class="single-post-date">
								<time datetime="<?php the_time('Y-m-d'); ?>">
									<?php the_date(); ?>
								</time>
							</div>

							<?php if ( has_post_thumbnail()) : ?>
								<div class="single-post-image">
									<?php the_post_thumbnail('large'); ?>
								</div>
							<?php endif; ?>

							<div class="single-post-content">
								<?php $categories = get_the_terms( $post->ID, 'category' );
								if( $categories ) { ?>
									<div class="single-post-tags">
										<?php foreach($categories as $category ) { ?>
											<a href="<?php echo get_term_link($category); ?>"><i class="icon-tag"></i> <?php echo $category->name; ?></a>
										<?php } ?>
									</div>
								<?php } ?>

								<?php the_content(); ?>								
							</div>

						</article>

					<?php endwhile; ?>

					<?php else: ?>

						<?php get_template_part('partials/error', 'missing'); ?>

					<?php endif; ?>

				</div>
				<div class="large-10 cell">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
