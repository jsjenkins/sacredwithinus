<?php get_header(); ?>

<main role="main" aria-label="Content">
	<div class="page-section art-list">
		<div class="grid-container">
			<div class="grid-x grid-padding-x medium-up-2">
				<?php get_template_part('loop', 'art'); ?>
			</div>
			<div class="grid-x grid-padding-x">
				<div class="cell">
					<?php get_template_part('pagination'); ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>