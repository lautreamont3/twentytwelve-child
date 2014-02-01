<?php
function divpostimage($atts) {
	extract(shortcode_atts(array(
		'i'	=> '',
		'a'	=> 'alignright',
		'g'	=> ''
    ), $atts));
	
	$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_id() );
	$image = $images[$i];
	$t = $image->post_title;
	$s = trim(strip_tags( get_post_meta($i, '_wp_attachment_image_alt', true) ));
	$c = $image->post_excerpt;
	
    $small = wp_get_attachment_image_src($i, 'medium', false);
	list($src, $width, $height) = $small;
	
	$html = '<div id="attachement_'.$i.'" class="wp-caption '.$a.'" style="width:'.$width.'px;">';
	$html.= "\n".'<a rel="lightbox';
	$html.= $g ? '['.$g.']"' : '"';
	$html.= ' href="'.wp_get_attachment_url($i).'">';
	
	$html.= "\n".'<img class="size-medium wp-image-'.$i.'" title="'. $t.'" alt="'.$s.'" width="'.$width.'"';
	$html.= ' src="'.$src.'" /></a>';
	$html.= "\n".'<p class="wp-caption-text">'.$c.'</p>';
	$html.= "\n".'</div>';
	return $html;
}
add_shortcode("postimage", "divpostimage");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function custom_find_short_code( $shortcode = '' ) {
	$post_to_check = get_post( get_the_ID() );
	$found = false;
	if ( ! $shortcode )
		return $found;
	if ( stripos( $post_to_check->post_content, '['.$shortcode ) !== false )
		$found = true;
	return $found;
}

function custom_liquid_scripts() {
	$short_code	= custom_find_short_code( 'liquid' );
	if ( $short_code || is_home() ) {
		wp_enqueue_script( 'jquery',			'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'jquery_easing',		get_stylesheet_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ) );
		wp_enqueue_script( 'jquery_swipe',		get_stylesheet_directory_uri() . '/js/jquery.touchSwipe.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'liquid_slider',		get_stylesheet_directory_uri() . '/js/jquery.liquid-slider.min.js', array( 'jquery' ) );
		wp_enqueue_style( 'liquid_slider_css',	get_stylesheet_directory_uri() . '/liquid-slider.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'custom_liquid_scripts' );



$wpliquidslider = new wpliquidslider();
class wpliquidslider {
	var $shortcode_name	= 'liquid';

	function __construct() {
		add_shortcode( $this->shortcode_name, array ( $this, 'shortcode' ) );
	}

	function shortcode( $atts, $content = null ) {
		$default_arr = array(
			'name'		=> 'liquid',	//identification
			'category'	=> null,		//category
			'parent_id'	=> null,		//parent-id
			'args' => array(	// Optional - defaults below
				'autoSlide'					=> 'true',
				'autoSliderDirection'		=> 'right',
				'autoSlideInterval'			=> '7000',
				'autoSlideControls'			=> 'false',
				'autoSlideStartText'		=> 'Start',
				'autoSlideStopText'			=> 'Stop',
				'autoSlideStopWhenClicked'	=> 'true',
				'autoSlidePauseOnHover'		=> 'true',

				'slideEaseDuration'			=> '1500',
				'slideEaseFunction'			=> 'easeInOutExpo',

				'dynamicTabs'				=> 'true',
				'dynamicTabsAlign'			=> 'left',
				'dynamicTabsPosition'		=> 'top',
				'panelTitleSelector'		=> 'h2.title',

				'dynamicArrows'				=> 'true',
				'dynamicArrowsGraphical'	=> 'true',
				'dynamicArrowLeftText'		=> '« left',
				'dynamicArrowRightText'		=> 'right »',
				'hideSideArrows'			=> 'false',
				'hideSideArrowsDuration'	=> '750',
				'hoverArrows'				=> 'true',
				'hoverArrowDuration'		=> '250',

				'hashLinking'				=> 'false',
				'hashNames'					=> 'true',
				'hashTitleSelector'			=> 'h2.title',
				'hashTagSeparator'			=> '',
				'hashTLD'					=> '',

				'responsive' 				=> 'true',
				'mobileNavigation'			=> 'true',
				'mobileNavDefaultText'		=> 'Menu',
				'mobileUIThreshold'			=> '0',
				'hideArrowsWhenMobile'		=> 'true',
				'useCSSMaxWidth'			=> '1030',

				'autoHeight'				=> 'true',
				'autoHeightMin'				=> '0',
				'autoHeightEaseDuration'	=> '1500',
				'autoHeightEaseFunction'	=> 'easeInOutExpo',

				'preloader'					=> 'true',
				'preloaderFadeOutDuration'	=> '250',
				'preloaderElements'			=> 'img,video,iframe,object',

				'callbackFunction'			=> null,
				'continuous'				=> 'true',
				'firstPanelToLoad'			=> '1',
				'navElementTag'				=> 'div',
				'crossLinks'				=> 'false',
				'hashCrossLinks'			=> 'false'
			)
		);
		extract( shortcode_atts( $default_arr, $atts ) );

		$o = '';
		if ( $category ) {	// home page slajder
			$query_args = array (
				'post_type'     => 'post',
				'category'      => (int) get_cat_ID( $category ),
				'posts_per_page'=> (int) 5,
				'post_status'	=> 'publish'
			);
			$posts = get_posts( $query_args );
			$o .= '<div id="' . $name . '" class="liquid-slider">'."\r\n";
			foreach ( $posts as $post ) {
				$o .=	'<div class="panel">'."\r\n";
				$o .=		'<span class="naslov"></span>'."\r\n";
				$o .=		'<header class="entry-header">'."\r\n";
				$o .=			'<h1 class="entry-title"><a href="'.get_permalink( $post->ID ).'" title="'.get_the_title( $post->ID ).'" rel="bookmark">'.get_the_title( $post->ID ).'</a></h1>'."\r\n";
				$o .= 		'</header>'."\r\n";
				$o .= 		'<p class="tekst">'.$post->post_excerpt.'</p>'."\r\n";
				$o .=		'<div class="tekst-end"></div>'."\r\n";
				$o .=	'</div>'."\r\n";
			}
			$o .= '</div>'."\r\n";
		}
		else {	// slajder klijenata
			$query_args = array (
				'post_type'		=> 'attachment',
				'post_mime_type'=> 'image/jpeg',
				'post_parent'	=> (int) $parent_id,
				'order'			=> 'ASC',
				'orderby'		=> 'id'
			);
			$posts = get_children( $query_args );
			$o .= '<div class="galerija">'."\r\n";
			$o .= 	'<div id="'.$name.'" class="liquid-slider">'."\r\n";
			foreach ( $posts as $post ) {
				$o .=	'<div class="panel">'."\r\n";
				$o .=		'<span class="tabulator"></span>'."\r\n";
				$o .=		'<img class="wp-post-image" src="'.$post->guid.'" alt="'.$post->post_title.'" />'."\r\n";
				$o .=	'</div>'."\r\n";
			}
			$o .= 	'</div>'."\r\n";
			$o .= '</div>'."\r\n";
		}
		$o .= '<script type="text/javascript">jQuery(document).ready(function($){$(\'#'.$name.'\').liquidSlider({'.$args.'});});</script>'."\r\n";
		return $o;
	}
}
