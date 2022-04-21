<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('cell art-card-container'); ?> >
		<a href="<?php the_permalink(); ?>" <?php post_class('cell art-card'); ?>>

			<?php if ( has_post_thumbnail()) : ?>
				<div class="art-card-image">
					<?php the_post_thumbnail(''); ?>
				</div>
			<?php endif; ?>

			<div class="art-card-content">
				
				<h2><?php the_title(); ?></h2>

				<?php if( get_field('medium') || the_field('size') ) { ?>
					<p class="art-details">
						<?php if( get_field('medium') ) { ?>
							<span class="art-card-medium"><?php the_field('medium'); ?></span><br />
						<?php } ?>
						<?php if( get_field('size') ) { ?>
							<span class="art-card-size"><?php the_field('size'); ?></span>
						<?php } ?>
					</p>
				<?php } ?>

				<?php if( get_field('price') ) { ?>
					<div class="art-card-purchase">
						<div class="art-card-price"><?php the_field('price'); ?></div>
						<?php if( !str_contains(get_field('price'), 'has a home') && !str_contains(get_field('price'), 'Sold') ) { ?>	
							<div class="art-card-button">Purchase Information</div>
						<?php } ?>
					</div>
				<?php } ?>

			</div>

		</a>
	</article>

<?php endwhile; ?>

<?php else: ?>

	<?php get_template_part('partials/error', 'missing'); ?>

<?php endif; ?>
