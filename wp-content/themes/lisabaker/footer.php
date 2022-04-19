<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>
		<div class="clear"></div>
		</section><!-- #main -->
        </div>
		<footer id="mainfooter" role="contentinfo">
			
			<div class="footnewsletter">
				<h2>Connect With Lisa</h2>
				<p>Enter your email address to join Lisa's newsletter:</p>
				<!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup">
<form action="https://sacredwithin.us7.list-manage.com/subscribe/post?u=d98e771ed2e2e90463f2d86fe&amp;id=0df95ed667" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	
<div class="mc-field-group">
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button footermorebutton">
</form>
</div>

<!--End mc_embed_signup-->
			</div>
			<div class="footpopular">
				<h2>Spiritual Direction</h2>
				<p>In a broad sense, Individual Spiritual Direction is a relationship between two persons, each seeking intimacy with God. At it’s best, it is coming home to one’s truest, God created self to find a more embracing, compassionate heart.</p>
				<a href="http://sacredwithin.us/spiritual-direction/" class="footermorebutton">More about Spiritual Direction</a>
			</div>
			<div class="footabout">
				<h2>About Lisa Baker</h2>
				<div class="aboutimage">
				<img src="<?php bloginfo( 'template_directory' ); ?>/images/lisa-headshot.jpg" />
				</div>
				<div class="aboutbio">
				<p>Lisa has been called a pioneer, a developer, a creator and a seeker. With each endeavor she has been a catalyst in moving others closer to their spiritual authenticity by responding to their God created design. As a Spiritual Director, Lisa creates a sacred space where individuals can tend to the holy rumblings within, while learning to be more spiritually present in their everyday lives.</p>
				<a href="http://sacredwithin.us/about/" class="footermorebutton">More about Lisa</a>
				</div>
			</div>

			<div class="clear"></div>
			<div class="copyrightinfo">
				&copy; <?php echo date('Y'); ?> Lisa B. Baker | <a href="http://sacredwithin.us/permissions-policy">Permissions Policy</a> | Site by <a href="http://www.landslidecreative.com" target="_blank">Landslide Creative</a>.
			</div>
		</footer><!-- footer -->
		
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
	</div>
	
	<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/equalheights.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/fluidvids.min.js"></script>
	</body>
</html>