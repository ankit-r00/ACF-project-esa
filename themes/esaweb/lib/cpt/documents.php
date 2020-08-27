<?php
// ==========================================================================
// DOCUMENTS CPT
// ==========================================================================
add_action( 'init', 'cptui_register_my_cpts_documents' );
function cptui_register_my_cpts_documents() {
	$labels = array(
			"name"          => __( 'Documents', '' ),
			"singular_name" => __( 'Document', '' ),
			"parent_item_colon"  => __( 'Parent page', '' ),
	);
	$args   = array(
			"label"               => __( 'Documents', '' ),
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
			"rewrite"             => array( "slug" => "resources/documents", "with_front" => true ),
			"query_var"           => true,
			"menu_position"       => 9,
			"menu_icon"           => "dashicons-portfolio",
			"supports"            => array( "title", "editor", "thumbnail" ),
	);
	register_post_type( "documents", $args );

// End of cptui_register_my_cpts_documents()
}

//end of file
