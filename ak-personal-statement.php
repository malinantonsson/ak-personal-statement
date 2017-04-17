<?php
/*
Plugin Name: Personal statement for ak Creative
Description: Used to dislay personal statement carousel. Shortcode: [akPersonalStatements post_type="posttype_name"].
*/

// Enqueue styles and scripts
add_action( 'wp_enqueue_scripts', 'add_ak_personalStatement_script' );
function add_ak_personalStatement_script() { 
	wp_enqueue_script( 'ak-personalStatement-script', plugins_url('ak-personal-statement/js/ak-personal-statement-script.js'), array ( 'jquery' ), 1.1, true); 
}

// Create the post shortcode
add_shortcode("akPersonalStatements", "akPersonalStatement_sc");

function ak_PersonalStatement_content( $more_link_text = null, $strip_teaser = false) {
    $content = get_the_content( $more_link_text, $strip_teaser );
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    return $content;
}

function akPersonalStatement_sc($atts) {
	extract(shortcode_atts(array( "post_type" => ''), $atts));
    global $post;

    $args = array(
    	'post_type' => $post_type, 
    	'posts_per_page' => 10, 
    	'order'=> 'DSC', 
    	'orderby' => 'date');

    $custom_posts = get_posts($args);
    $output = '';

	$index = 0;
    $output .= 	'
    	<div class="personal-carousel">'; 
		    
		    foreach($custom_posts as $post) : setup_postdata($post);
		    	$content = ak_PersonalStatement_content();
		    	$output .= 	'
		    	<div class="ak-personal-carousel__item">
			        <div class="ak-carousel-post__content">'
			        	.$content.
			        '</div>
			    </div>';

			$index++;
		    endforeach; wp_reset_postdata();
	    $output .= 	'</div>';
	    
	return $output;
	}
?>
