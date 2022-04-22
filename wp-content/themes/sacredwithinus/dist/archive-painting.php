<?php $current_page = get_page_by_path('art');

get_header(); ?>

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
	<?php get_template_part('partials/page', 'builder'); ?>
</main>

<?php get_footer(); ?>