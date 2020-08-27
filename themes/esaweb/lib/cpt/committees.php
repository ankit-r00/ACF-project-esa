<?php
// ==========================================================================
// committees CPT
// ==========================================================================
add_action( 'init', 'cptui_register_my_cpts_committees' );
function cptui_register_my_cpts_committees() {
	$labels = array(
		"name"          => __( 'Committees', '' ),
		"singular_name" => __( 'Committee', '' ),
	);
	$args   = array(
		"label"               => __( 'Committees', '' ),
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
		"rewrite"             => array( "slug" => "committees", "with_front" => true ),
		"query_var"           => true,
		"menu_position"       => 8,
		"menu_icon"           => "dashicons-groups",
		"supports"            => array( "title", "editor", "thumbnail" ),
	);
	register_post_type( "committees", $args );

// End of cptui_register_my_cpts_committees()
}

//end of file
