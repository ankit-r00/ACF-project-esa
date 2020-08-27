<?php
// ==========================================================================
// Our team CPT
// ==========================================================================
add_action( 'init', 'cptui_register_my_cpts_our_team' );
function cptui_register_my_cpts_our_team() {
	$labels = array(
		"name"          => __( 'Our team', '' ),
		"singular_name" => __( 'our_team', '' ),
	);
	$args   = array(
		"label"               => __( 'Our Team', '' ),
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
		"rewrite"             => array( "slug" => "our_team", "with_front" => true ),
		"query_var"           => true,
		"menu_position"       => 6,
		"menu_icon"           => "dashicons-businessman",
		"supports"            => array( "title", "editor", "thumbnail" ),
	);
	register_post_type( "our_team", $args );

// End of cptui_register_my_cpts_our_team()
}

//end of file
