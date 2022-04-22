<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('cell post-card-container'); ?> >
		<a href="<?php the_permalink(); ?>" <?php post_class('cell post-card'); ?> data-mh="post-card">

			<?php if ( has_post_thumbnail()) : ?>
				<div class="post-card-image">
					<?php the_post_thumbnail(''); ?>
				</div>
			<?php endif; ?>

			<div class="post-card-content">
				<h2 class="h3"><?php the_title(); ?></h2>

				<?php ls_boilerplate_excerpt('ls_excerpt_index'); ?>

				<div class="post-card-button">
					<div class="button dark">Read More</div>
				</div>
			</div>

		</a>
	</article>

<?php endwhile; ?>

<?php else: ?>

	<?php get_template_part('partials/error', 'missing'); ?>

<?php endif; ?>
