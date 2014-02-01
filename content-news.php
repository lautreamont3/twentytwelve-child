<!-- START CONTENT-NEWS.PHP -->
<div class="panel hyphenate">
	<span class="tabulator"></span>
	<div class="inner-frame">
		<div class="thumbnail">
			<?php the_post_thumbnail( 'medium' ); ?>
		</div>
		<p class="naslov">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</p>
		<?php the_excerpt(); ?>
	</div>
</div>
<!-- END CONTENT-NEWS.PHP -->