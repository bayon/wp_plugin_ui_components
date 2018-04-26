<?php
/** 
Plugin Name: ASI UI Components
Description:  
Version: 1.0
Author:  Bayon Forte
Author URI:  
License: GPL2
*/
function accordion_shortcode_supports() { 
	// works with custom post type:
	wp_enqueue_style( 'accordion-styles',  plugins_url('/accordion.css', __FILE__ ) );
	wp_register_script('wpb-custom-js', plugins_url('/accordion.js', __FILE__ ), '', '', true);
	wp_enqueue_script('wpb-custom-js');
	// Getting FAQs from WordPress FAQ Manager plugin's custom post type questions
	$posts = get_posts(array(  
	'posts_per_page' => 10,
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_type' => 'support',
	));
	 
	// Generating Output 
	$post_accordion  .= '<div class="accordion-container">'; //Open the container
	foreach ( $posts as $post ) { // Generate the markup for each Question
		$post_accordion .= sprintf(('<button class="accordion">%1$s</button><div class="panel">%2$s</div>'),
		$post->post_title,
		wpautop($post->post_content)
		);
	}
	$post_accordion .= '</div>'; //Close the container
	return $post_accordion; //Return the HTML.
}
add_shortcode('support_accordion', 'accordion_shortcode_supports');


function aos_shortcode($atts, $content = null ){
	//REFERENCE: https://github.com/michalsnik/aos 
	wp_enqueue_style( 'aos-styles',  'https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css'   );
	wp_enqueue_script( 'aos-scripts', 'https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js','','',true);

	$a = shortcode_atts( array(
	    'data_aos' => 'fade-up-right',
	    'href' => '#hrefofanchor',
	    'delay' => '0'
	), $atts );

	$html = '<div data-aos="'.$a["data_aos"].'" data-aos-anchor-placement="top-center">';
	$html .= $content;
	$html .= '</div>';

	$html  .="
	<script> $(document).ready(function(){
	AOS.init(); 
	});
	</script>
	";
  return $html;
  /*
	USE CASE:  
 [aos data_aos="fade-up-right"]
	<!-- your html here -->
 [/aos]
  */
}
add_shortcode('aos','aos_shortcode');

function toggle_modal_shortcode($atts, $content = null){
	//REFERENCE: https://github.com/michalsnik/aos 
	//wp_enqueue_style( 'aos-styles',  'https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css'   );
	//wp_enqueue_script( 'aos-scripts', 'https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js','','',true);
wp_enqueue_style( 'modal-styles',  plugins_url('/modal.css', __FILE__ ) );
	wp_register_script('wpb-modal-js', plugins_url('/modal.js', __FILE__ ), '', '', true);
	wp_enqueue_script('wpb-modal-js');
$a = shortcode_atts( array(
	    'button_text' => 'Open',
	    'href' => '#hrefofanchor',
	    'delay' => '0'
	), $atts );
	$html = " 
	 <!-- Trigger/Open The Modal -->
		<button id='myBtn' class='modal-button' >".$a['button_text']."</button>
		<!-- The Modal -->
		<div id='myModal' class='modal'>
		  <!-- Modal content -->
		  <div class='modal-content'>
		    <span class='close'>&times;</span>".$content."
		    
		  </div>
		</div>
	 ";
return $html;
/*
USE CASE:
[toggle_modal button_text="Watch our features video" ]
[/toggle_modal]

*/
}
add_shortcode('toggle_modal','toggle_modal_shortcode');