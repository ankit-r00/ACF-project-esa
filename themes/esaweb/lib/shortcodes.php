<?php

/*
 * shortcode to create a sitemap
 * optional attributes -- exclude: comma separated list of page ids to exclude
 * example: [sitemap exclude="3,10,12"]
 */

add_shortcode('archive_by_year_and_month','get_archive_by_year_and_month');

function get_archive_by_year_and_month($atts=array()){
	global $wpdb;
	$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC");
	if($years){
		$archive = '<div class="panel-group">';
		$i = 0;
		foreach($years as $year){
			if (have_posts()) :

				$args = array(
					'showposts' => '2',
					''
				);


				$thePosts = query_posts($args);


				global $wp_query;
				 $wp_query->found_posts;
				endif;
			$archive.='<div class="panel panel-default"><div class="panel-heading" role="tab" id="headingOne2"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne'.$i.'" aria-expanded="false" aria-controls="collapse'.$i.'"><i class="fas fa-folder-open"></i></i>'.$year.'<i class="fal fa-plus"></i></a></h4></div>';
			$archive.='<div id="collapseOne'. $i.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne2"><div class="panel-body">';
			$months = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_type='post' AND post_status='publish' AND YEAR(post_date) = %d ORDER BY post_date ASC",$year));
			foreach($months as $month){
				//$count = wp_get_archives( array('format' => 'option', 'show_post_count' => 'true' ) );
				//echo $count;
				//$count_month = $wp_query->found_posts;
				$count_month = $GLOBALS['wp_query']->found_posts;
				$dateObj   = DateTime::createFromFormat('!m', $month);
				$monthName = $dateObj->format('F');
				$archive.='<ul><li class="month"><i class="fas fa-folder-open"></i><a href="'.get_month_link($year,$month).'">'.$year.', '.$monthName.'</a></li></ul>';
			}
			$archive.='</div>';
			$archive.='</div></div>';
			$i++;
		}
		$archive.='</div>';
	}
	return $archive;
}

function sitemap_shortcode($atts)
{
  $all_pages = wp_list_pages('title_li=&echo=0&exclude=' . $atts['exclude']);
  return '<ul class="sitemap">' . $all_pages . '</ul>';
}

add_shortcode('sitemap', 'sitemap_shortcode');

//broken link checker shorcodes
function url_checker( $atts ){
	$error=false;
	$output='';
	$message='';
	$url='';

	if ( isset( $_POST['form_submit'] ) ) {
		if ( $error == false ) {
			$url=$_POST['url'];
			if(rf_check_url($url)){
				$message.='Valid URL';
			}else{
				$message.='Broken URL ';
			}
		}
	}

	$output .= ' <form class="form-horizontal" action="' . get_the_permalink() . '" method="post">';
	$output .= '
     <div class="form-group">
       <label class="control-label col-sm-2" for="name">Enter Url:</label>
       <div class="col-sm-10">
         <input type="text" class="form-control" name="url" value="'.$url.'" id="url" placeholder="Enter Url">
       </div>
     </div>
     <div class="form-group"> 
       <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" name="form_submit" class="btn btn-default">Submit</button>
       </div>
     </div>
    '.$message;
	$output .= ' </form > ';
	return $output;
}

add_shortcode( 'url_checker', 'url_checker' );

function rf_check_url($url){
	try{
		$handle = curl_init($url);
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);
		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

		if($httpCode == 404 || $httpCode==0) {
			return false;
		}
		curl_close($handle);
		return true;
	} catch (Exception $e) {
		return false;
	}
}


