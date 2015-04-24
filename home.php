<?php
	get_header();
	$temp_query = clone $wp_query;
	$query_args = array ( 'post_type' => 'post', 'posts_per_page'=> (int) 10 );
	query_posts( $query_args );
?>
<div id="primary" class="site-content">
	<div id="content" role="main">
			<header class="entry-header" style="margin-bottom:12px;">
				<h1 class="entry-title">Novo</h1>
			</header>
			<article id="post-home-0" class="post no-results not-found">
				<div class="entry-content">
					<div id="vesti" class="liquid-slider">
					<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'content', 'news' );
						endwhile;
					?>
					</div><!-- #vesti -->
				</div><!-- entry-content -->
			</article><!-- article -->
<script type="text/javascript">jQuery(document).ready(function($){$('#vesti').liquidSlider({autoSlide:true, autoSlideInterval:'5000', dynamicTabs:true, dynamicTabsAlign:'left', dynamicTabsPosition:'bottom', panelTitleSelector:'span.tabulator', dynamicArrows:true, autoHeight:true});});</script>
<?php
	$query_args = array ( 'post_type' => 'post', 'category_name' => 'knjige', 'posts_per_page' => (int) 15 );
	query_posts( $query_args );
?>
			<header class="entry-header" style="margin-bottom:12px;">
				<h1 class="entry-title">Knjige</h1>
			</header>
			<article id="post-home-1" class="post no-results not-found">
				<div class="entry-content">
					<div id="knjige" class="liquid-slider">
					<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'content', 'news' );
						endwhile;
					?>
					</div><!-- #klijenti -->
				</div><!-- entry-content -->
			</article><!-- #post-0 -->
<script type="text/javascript">jQuery(document).ready(function($){$('#knjige').liquidSlider({autoSlide:true, autoSlideInterval:'4000', dynamicTabs:true, dynamicTabsAlign:'left', dynamicTabsPosition:'bottom', panelTitleSelector:'span.tabulator', dynamicArrows:true, autoHeight:true});});</script>
<?php $wp_query = clone $temp_query; ?>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>