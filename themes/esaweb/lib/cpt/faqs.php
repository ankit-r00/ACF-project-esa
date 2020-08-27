<?php
// ==========================================================================
// FAQ CPT
// ==========================================================================
add_action( 'init', 'cptui_register_my_cpts_news' );
function cptui_register_my_cpts_news() {
	$labels = array(
		"name"          => __( 'FAQs', '' ),
		"singular_name" => __( 'FAQ', '' ),
	);
	$args   = array(
		"label"               => __( 'FAQs', '' ),
		"labels"              => $labels,
		"description"         => "",
		"public"              => true,
		"publicly_queryable"  => true,
		"show_ui"             => true,
		"show_in_rest"        => false,
		"rest_base"           => "",
		"has_archive"         => true,
		"show_in_menu"        => true,
		"show_in_nav_menus"   => true,
		"exclude_from_search" => true,
		"capability_type"     => "page",
		"map_meta_cap"        => true,
		"hierarchical"        => false,
		"rewrite"             => array( "slug" => "faqs", "with_front" => true ),
		"query_var"           => true,
		"menu_position"       => 5,
		"menu_icon"           => "dashicons-format-status",
		"supports"            => array( "title", "editor", "thumbnail" ),
	);
	register_post_type( "faqs", $args );

// End of cptui_register_my_cpts_faqs()
}

//end of file
