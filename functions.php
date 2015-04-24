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
