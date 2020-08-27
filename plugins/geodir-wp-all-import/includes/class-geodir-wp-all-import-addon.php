<?php

global $geodir_wpai_addon, $wpdb, $custom_type;

$import_id = isset($_GET['id']) ? $_GET['id'] : 'new';
$imports_table = $wpdb->prefix . 'pmxi_imports';
$import_options = $wpdb->get_row( $wpdb->prepare("SELECT options FROM $imports_table WHERE id = %d", $import_id), ARRAY_A );

if ( ! empty($import_options) ) {
    $import_options_arr = unserialize($import_options['options']);
    $custom_type = $import_options_arr['custom_type'];
}
else {
    $import_options = $wpdb->get_row( $wpdb->prepare("SELECT option_name, option_value FROM $wpdb->options WHERE option_name = %s", '_wpallimport_session_' . $import_id . '_'), ARRAY_A );
    $import_options_arr = empty($import_options) ? array() : unserialize($import_options['option_value']);
    $custom_type = empty($import_options_arr['custom_type']) ? '' : $import_options_arr['custom_type'];
}

$geodir_wpai_addon = new RapidAddon(__('GeoDirectory Add-On', 'geodir-wpai'), 'geodir_wpai');

$geodir_wpai_addon->disable_default_images();

$post_type = !empty($custom_type) ? $custom_type : 'gd_place';
$table = geodir_db_cpt_table( $post_type );
$fields = geodir_wpai_get_custom_fields($post_type);
$columns = array();

//If the table exists, fetch colums
if($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table){
    $columns = $wpdb->get_col( "show columns from $table" );
}

$other_fields = array(
    'featured' => __('Featured', 'geodir-wpai'),
    'post_status' => __('Post Status', 'geodir-wpai'),
    'featured_image' => __('Featured Image', 'geodir-wpai'),
    'submit_ip' => __('Submit IP', 'geodir-wpai'),
    'overall_rating' => __('Overall Rating', 'geodir-wpai'),
    'rating_count' => __('Rating Count', 'geodir-wpai'),
    'ratings' => __('Ratings', 'geodir-wpai'),
    'marker_json' => __('Marker JSON', 'geodir-wpai'),
    'location_id' => __('Location ID', 'geodir-wpai'),
    'post_category' => __('Categories', 'geodir-wpai'),
    'default_category' => __('Default Category', 'geodir-wpai'),
    'post_tags' => __('Tags', 'geodir-wpai'),
);

if(isset($custom_type) && 'gd_event' == $custom_type){
    $other_fields['recurring'] = __('Recurring', 'geodir-wpai');
    $other_fields['rsvp_count'] = __('RSVP Count', 'geodir-wpai');
}

$other_fields = apply_filters('geodir_wpai_import_other_fields', $other_fields);

foreach ($other_fields as $slug => $title){
    $field_type = apply_filters('geodir_wpai_import_other_field_type', 'text', $slug, $title, $other_fields);
    if(in_array($slug, $columns)) {
        $geodir_wpai_addon->add_field($slug, $title, $field_type);
    }
}

if(isset($fields) && !empty($fields)) {
    foreach ($fields as $field) {

        if ($field->htmlvar_name == "post_title" || $field->htmlvar_name == "post_content" || $field->htmlvar_name == "post_tags" || $field->htmlvar_name == "post_category" || $field->htmlvar_name == "post_images") {
            continue;
        }

        if ($field->field_type == "address") {

            $extra_field = maybe_unserialize($field->extra_fields);

            if (isset($extra_field['show_city']) && $extra_field['show_city'] == 1) {

                $geodir_wpai_addon->add_field('street', __('Street', 'geodir-wpai'), 'text');

            }

            if (isset($extra_field['show_city']) && $extra_field['show_city'] == 1) {

                $geodir_wpai_addon->add_field('city', $extra_field['city_lable'], 'text');

            }

            if (isset($extra_field['show_region']) && $extra_field['show_region'] == 1) {

                $geodir_wpai_addon->add_field('region', $extra_field['region_lable'], 'text');

            }

            if (isset($extra_field['show_country']) && $extra_field['show_country'] == 1) {

                $geodir_wpai_addon->add_field('country', $extra_field['country_lable'], 'text');

            }

            if (isset($extra_field['show_neighbourhood']) && $extra_field['show_neighbourhood'] == 1) {

                $geodir_wpai_addon->add_field('neighbourhood', $extra_field['neighbourhood_lable'], 'text');

            }

            if (isset($extra_field['show_zip']) && $extra_field['show_zip'] == 1) {

                $geodir_wpai_addon->add_field('zip', $extra_field['zip_lable'], 'text');

            }

            if (isset($extra_field['show_latlng']) && $extra_field['show_latlng'] == 1) {

                $geodir_wpai_addon->add_field('latitude', __('Latitude', 'geodir-wpai'), 'text');

                $geodir_wpai_addon->add_field('longitude', __('Longitude', 'geodir-wpai'), 'text');

            }

            if (isset($extra_field['show_mapview']) && $extra_field['show_mapview'] == 1) {

                $geodir_wpai_addon->add_field('mapview', $extra_field['mapview_lable'], 'radio', array('ROADMAP' => 'ROADMAP', 'SATELLITE' => 'SATELLITE', 'HYBRID' => 'HYBRID', 'TERRAIN' => 'TERRAIN'));

            }

            if (isset($extra_field['show_mapzoom']) && $extra_field['show_mapzoom'] == 1) {

                $geodir_wpai_addon->add_field('mapzoom', __('Map Zoom', 'geodir-wpai'), 'text');

            }

        } else {

            if(isset($custom_type) && 'gd_event' == $custom_type && $field->htmlvar_name == "event_dates"){
                $geodir_wpai_addon->add_field('start_date', __('Start Date', 'geodir-wpai'), 'text');
                $geodir_wpai_addon->add_field('end_date', __('End Date', 'geodir-wpai'), 'text');
                $geodir_wpai_addon->add_field('start_time', __('Start Time', 'geodir-wpai'), 'text');
                $geodir_wpai_addon->add_field('end_time', __('End Time', 'geodir-wpai'), 'text');
                $geodir_wpai_addon->add_field('is_all_day_event', __('Is all day event?', 'geodir-wpai'), 'text');

                continue;
            }

            if(in_array($field->htmlvar_name, $columns)) {
                $title = isset($field->frontend_title) ? $field->frontend_title : $field->admin_title;
                $geodir_wpai_addon->add_field($field->htmlvar_name, $title, 'text');
            }

        }

    }
}

$geodir_wpai_addon->set_import_function('geodir_wpai_import_function');

function geodir_wpai_import_function( $post_id, $data, $import_options ) {
    global $geodir_wpai_addon, $wpdb, $custom_type;

    $post = get_post($post_id);
    $post_type = get_post_type( $post_id );
    $post_type = !empty($post_type) ? $post_type : 'gd_place';
    $fields = geodir_wpai_get_custom_fields($post_type);
    $table = geodir_db_cpt_table( $post_type );
    $custom_field_data = array();
    $columns = array();

    //If the table exists, fetch colums
    if($wpdb->get_var("SHOW TABLES LIKE '$table'") == $table){
        $columns = $wpdb->get_col( "show columns from $table" );
    }

    do_action('geodir_wpai_before_import_fields', $post_id, $data, $import_options);

    foreach ( $fields as $field ) {

        if ($field->htmlvar_name == "post_title" || $field->htmlvar_name == "post_content" || $field->htmlvar_name == "post_tags" || $field->htmlvar_name == "post_category" || $field->htmlvar_name == "post_images") {
            continue;
        }

        if ( empty( $article['ID'] ) or $geodir_wpai_addon->can_update_meta( $data[ $field->htmlvar_name ], $import_options ) ) {

            if ($field->field_type == "address") {

                $extra_field = maybe_unserialize($field->extra_fields);

                if (isset($extra_field['show_city']) && $extra_field['show_city'] == 1) {

                    $custom_field_data['street'] = $data['street'];

                }

                if (isset($extra_field['show_city']) && $extra_field['show_city'] == 1) {

                    $custom_field_data['city'] = $data['city'];

                }

                if (isset($extra_field['show_region']) && $extra_field['show_region'] == 1) {

                    $custom_field_data['region'] = $data['region'];

                }

                if (isset($extra_field['show_country']) && $extra_field['show_country'] == 1) {

                    $custom_field_data['country'] = $data['country'];

                }

                if (isset($extra_field['show_neighbourhood']) && $extra_field['show_neighbourhood'] == 1) {

                    $custom_field_data['neighbourhood'] = $data['neighbourhood'];

                }

                if (isset($extra_field['show_zip']) && $extra_field['show_zip'] == 1) {

                    $custom_field_data['zip'] = $data['zip'];

                }

                if (isset($extra_field['show_latlng']) && $extra_field['show_latlng'] == 1) {

                    $custom_field_data['latitude'] = $data['latitude'];
                    $custom_field_data['longitude'] = $data['longitude'];

                }

                if (isset($extra_field['show_mapview']) && $extra_field['show_mapview'] == 1) {

                    $custom_field_data['mapview'] = $data['mapview'];

                }

                if (isset($extra_field['show_mapzoom']) && $extra_field['show_mapzoom'] == 1) {

                    $custom_field_data['mapzoom'] = $data['mapzoom'];

                }

                continue;

            }

            if(!in_array($field->htmlvar_name, $columns)){
                continue;
            }

            if(isset($custom_type) && 'gd_event' == $custom_type && $field->htmlvar_name == "event_dates"){
                $event_dates['start_date'] = $data['start_date'];
                $event_dates['end_date'] = $data['end_date'];
                $event_dates['start_time'] = $data['start_time'];
                $event_dates['end_time'] = $data['end_time'];
                $event_dates['all_day'] = $data['is_all_day_event'];
                $custom_field_data['event_dates'] = maybe_serialize($event_dates);
                continue;
            }

            if ($data[$field->htmlvar_name]) {

                $custom_field_data[$field->htmlvar_name] = $data[$field->htmlvar_name];

            }
        }

    }

    $fields = array(
        'featured',
        'post_status',
        'submit_ip',
        'overall_rating',
        'rating_count',
        'ratings',
        'post_dummy',
        'marker_json',
        'location_id',
        'default_category',
        'post_category',
        'post_tags'
    );

    $fields = apply_filters('geodir_wpai_import_other_fields', $fields, $post_id, $data, $import_options);

    foreach ($fields as $field){
        if(in_array($field, $columns) && !empty($data[$field])){
            $custom_field_data[$field] = $data[$field];
        }
    }

    $custom_field_data['post_title'] = $post->post_title;

    if ( isset( $data['featured_image'] ) && !empty($data['featured_image']) ) {
        $featured_image = GeoDir_Post_Data::save_files( $post_id, $data['featured_image'], 'post_images', false);
        if ( !empty($featured_image) && !wp_is_post_revision( absint($post_id) )  ) {
            $custom_field_data['featured_image'] = $featured_image;
        }
    }

    $wpdb->update(
        $table,
        $custom_field_data,
        array('post_id' => $post_id)
    );

    do_action('geodir_wpai_after_import_fields', $post_id, $data, $import_options);
}

$post_types = geodir_get_posttypes();
$post_types = apply_filters('geodir_wpai_post_types', $post_types);

$geodir_wpai_addon->run(

    array(
        "post_types" => $post_types
    )

);

function geodir_wpai_get_custom_fields($post_type = 'gd_place') {

    global $wpdb;

    $fields = $wpdb->get_results("SELECT id, htmlvar_name, field_type, extra_fields, frontend_title, admin_title FROM " . GEODIR_CUSTOM_FIELDS_TABLE . " WHERE post_type = '".$post_type."'");
    return apply_filters('geodir_wpai_custom_fields', $fields, $post_type);

}