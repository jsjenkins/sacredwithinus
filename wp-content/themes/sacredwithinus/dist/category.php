<?php get_header(); ?>

<main role="main" aria-label="Content">
	<div class="page-section post-list">
		<div class="grid-x grid-padding-x intro-section">
			<div class="cell">
				<h1 class="script category-title"><?php _e( 'Posts about ', 'html5blank' ); single_cat_title(); ?></h1>
			</div>
		</div>
		<div class="grid-x grid-padding-x medium-up-2 large-up-3">
			<?php get_template_part('loop'); ?>
		</div>
		<div class="grid-x grid-padding-x">
			<div class="cell">
				<?php get_template_part('pagination'); ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
