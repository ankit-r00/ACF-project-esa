<?php
// ==========================================================================
//  COMMITTEES CUSTOM TAXONOMY
// ==========================================================================
add_action( 'init', 'cptui_register_my_taxes_member_type' );
function cptui_register_my_taxes_member_type() {
	$labels = array(
		"name"          => __( 'Members Type', '' ),
		"singular_name" => __( 'member_types', '' ),
	);

	$args = array(
		"label"              => __( 'Members Type', '' ),
		"labels"             => $labels,
		"public"             => true,
		"hierarchical"       => true,
		"show_ui"            => true,
		"show_in_menu"       => true,
		"show_in_nav_menus"  => true,
		"query_var"          => true,
		"rewrite"            => array( 'slug' => 'member_types', 'with_front' => true, ),
		"show_admin_column"  => true,
		"show_in_rest"       => false,
		"rest_base"          => "",
		"show_in_quick_edit" => true,
		//'meta_box_cb'        => true,

	);
	register_taxonomy( "member_types", array( "committees" ), $args );
}
//end of file
