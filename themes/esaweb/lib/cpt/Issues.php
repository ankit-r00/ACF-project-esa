<?php
// ==========================================================================
// issues CPT
// ==========================================================================
add_action( 'init', 'cptui_register_my_cpts_issues' );
function cptui_register_my_cpts_issues() {
	$labels = array(
		"name"          => __( 'Issues', '' ),
		"singular_name" => __( 'Issues', '' ),
	);
	$args   = array(
		"label"               => __( 'Issues', '' ),
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
		"rewrite"             => array( "slug" => "issues", "with_front" => true ),
		"query_var"           => true,
		"menu_position"       => 4,
		"menu_icon"           => "dashicons-format-aside",
		"supports"            => array( "title", "editor", "thumbnail" ),
	);
	register_post_type( "issues", $args );

// End of cptui_register_my_cpts_governance()
}

//end of file
