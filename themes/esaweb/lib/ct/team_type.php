<?php
// ==========================================================================
//  OUR TEAM CUSTOM TAXONOMY
// ==========================================================================
add_action( 'init', 'cptui_register_my_taxes_team_type' );
function cptui_register_my_taxes_team_type() {
	$labels = array(
		"name"          => __( 'Team Type', '' ),
		"singular_name" => __( 'team_type', '' ),
	);

	$args = array(
		"label"              => __( 'Team Type', '' ),
		"labels"             => $labels,
		"public"             => true,
		"hierarchical"       => true,
		"show_ui"            => true,
		"show_in_menu"       => true,
		"show_in_nav_menus"  => true,
		"query_var"          => true,
		"rewrite"            => array( 'slug' => 'team_type', 'with_front' => true, ),
		"show_admin_column"  => true,
		"show_in_rest"       => false,
		"rest_base"          => "",
		"show_in_quick_edit" => true,
		//'meta_box_cb'        => true,

	);
	register_taxonomy( "team_types", array( "our_team" ), $args );
}
//end of file
