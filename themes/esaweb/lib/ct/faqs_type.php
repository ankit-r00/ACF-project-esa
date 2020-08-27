<?php
// ==========================================================================
//  FAQS CUSTOM TAXONOMY
// ==========================================================================
add_action( 'init', 'cptui_register_my_taxes_faqs_type' );
function cptui_register_my_taxes_faqs_type() {
	$labels = array(
		"name"          => __( 'Groups', '' ),
		"singular_name" => __( 'Group', '' ),
	);

	$args = array(
		"label"              => __( 'Groups', '' ),
		"labels"             => $labels,
		"public"             => true,
		"hierarchical"       => true,
		"show_ui"            => true,
		"show_in_menu"       => true,
		"show_in_nav_menus"  => true,
		"query_var"          => true,
		"rewrite"            => array( 'slug' => 'faqs_type', 'with_front' => true, ),
		"show_admin_column"  => true,
		"show_in_rest"       => false,
		"rest_base"          => "",
		"show_in_quick_edit" => true,
		//'meta_box_cb'        => true,

	);
	register_taxonomy( "faqs_type", array( "faqs" ), $args );
}
//end of file
