<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<div class="alignleft">Sva prava (P) <a href="http://laura.in.rs/" title="Laura Barna">Laura Barna</a></div><!-- .alignleft -->
			<div class="alignright">
				<?php do_action( 'twentytwelve_credits' ); ?>by <a href="mailto:lautreamont33@gmail.com">lautreamont</a>@<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( '%s', 'twentytwelve' ), 'WordPress' ); ?></a>
			</div><!-- .alignright -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<!--<script type="text/javascript">Hyphenator.run();</script>-->
<script type="text/javascript">jQuery(document).ready(function($){$('#liquid').liquidSlider({
	autoSlide:true,
	autoSlideInterval:'3000',
	slideEaseFunction:'fade',
	dynamicTabs:true,
	dynamicTabsAlign:'right',
	dynamicTabsPosition:'bottom',
	panelTitleSelector:'span.tabulator',
	autoHeight:true
});});</script>
<!--	 -->
</body>
</html>