				<!-- footer -->
				<footer class="footer" role="contentinfo">
					<div class="footer-content">
						<div class="grid-x grid-padding-x">
							<div class="cell large-5 footer-about">
								<h2 class="script"><?php the_field('about_column_header', 'options'); ?></h2>
								<?php if( get_field('footer_headshot') ) { ?>
									<div class="footer-about-image">
										<img src="<?php echo acf_image_single( 'footer_headshot', 'thumbnail' ); ?>" />
									</div>
								<?php } else if( get_field('about_image', 'options') ) { ?>
									<div class="footer-about-image">
										<img src="<?php echo acf_image_single( 'about_image', 'thumbnail', FALSE, 'options' ); ?>" />
									</div>
								<?php } ?>
								<div class="footer-about-content">
									<?php the_field('about_column', 'options'); ?>
								</div>
							</div>
							<div class="cell large-7 footer-other">
								<div class="grid-x grid-padding-x">
									<div class="cell medium-6 large-5 footer-connect">
										<h2 class="script"><?php the_field('connect_column_header', 'options'); ?></h2>
										<?php the_field('connect_column', 'options'); ?>
									</div>
									<div class="cell medium-6 large-7 footer-service">
										<h2 class="script"><?php the_field('service_column_header', 'options'); ?></h2>
										<?php the_field('service_column', 'options'); ?>
									</div>
								</div>
							</div>							
						</div>
					</div>

					<!-- copyright -->
					<section class="copyright">
						<div class="grid-x grid-padding-x">
							<div class="cell medium-auto">
								<p>&copy; <?php echo date('Y'); ?> Lisa B. Baker</p>
								<?php display_navigation('policy-nav'); ?>
							</div>
							<div class="cell medium-shrink">
								<p><a href="http://landslidecreative.com">Website Design</a> by Landslide Creative</a>
							</div>
						</div>
					</section>

				</footer>
			</div> <!-- /off-canvas-content -->
		<?php wp_footer(); ?>
	</body>
</html>

