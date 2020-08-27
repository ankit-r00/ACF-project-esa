<?php
/**
 * issues
 * Display current issues
 * @package Wordpress
 */

$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];

?>
<?php
global $post;
$args = array(
		'posts_per_page' => 5,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'issues',
		'post_status' => 'publish',
		'suppress_filters' => true
);
wp_reset_postdata();
$recent_posts = new WP_Query( $args );
//echo "<pre>";
//print_r($recent_posts);
//die();
?>

<div class="row issues-security <?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?>"  style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
	<?php if ( $recent_posts->have_posts() ):
	$count = 0;
			while ( $recent_posts->have_posts() ) : $recent_posts->the_post();?>
			<?php if ($count==0){?>
					<div class="col-12 current-month">
						<h1>Download This Month's Edition</h1>
						<div class="month-edition">
							<?php } elseif ($count==2){?>
					<div class="col-12  previous-month"><h1 class="mb-30">Download Past Issues</h1>
                        <div class="past-edition">
                           <?php }?>
                                    <figure>
                                        <a href="<?php the_field('file');?>" target="_blank">
                                            <img src="<?php echo get_the_post_thumbnail_url();?>" />
                                        </a>
                                        <?php if (get_field('sub_title')){?>
                                        <figcaption>
                                            <a href="<?php the_field('file');?>" target="_blank">
                                                <?php the_field('sub_title'); ?>
                                            </a>
                                        </figcaption>
                                        <?php } ?>
                                    </figure>
                                    <?php if ($count==1 || $count==4){?>
                        </div>
                    </div> <!--show titles--->
                            <?php }
                            $count++;
                            endwhile;
                            wp_reset_postdata();
                            endif; ?>
                    <div class="col-12 archive-data">
                                <h2 class="title">Archive</h2>
                                <div class="accordion" id="accordionExample">
											<?php
												global $wpdb;
												$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_type = 'issues' AND post_status = 'publish' ORDER BY post_date DESC");
												if($years) {
												    $count=0;
												    foreach ( $years as $year ) {?>
                                                                <div class="card">
                                                                    <div class="card-header" id="heading<?php echo $count;?>">
                                                                        <h2 class="mb-0">
                                                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $count;?>"><i class="fa fa-plus"></i> <?php echo $year; ?></button>
                                                                        </h2>
                                                                    </div>
                                                                    <div id="collapse<?php echo $count; ?>" class="collapse" aria-labelledby="heading<?php echo $count; ?>" data-parent="#accordionExample">
                                                                        <div class="card-body">
                                                                            <ul class="pl-0">
                                                                                <?php
                                                                                    $args = array(
                                                                                        'post_type' => 'issues',
                                                                                        'post_per_page' => -1,
                                                                                        'year'  => $year,
                                                                                    );

                                                                                    $the_query = new WP_Query( $args );

                                                                                if ( $the_query->have_posts() ) :
                                                                                    while ( $the_query->have_posts() ) : $the_query->the_post();?>
                                                                                            <li class="clearfix">
                                                                                                <div class="float-md-left">
                                                                                                    <i class="far fa-file-pdf"></i><?php the_title();?>
                                                                                                </div>
                                                                                                <div class="float-md-right">
                                                                                                    <a href="<?php the_field('file'); ?>" target="_blank">View</a>
                                                                                                    <a href="<?php the_field('file'); ?>" target="_blank" /download><i class="fal fa-download"></i>Download</a>
                                                                                                </div>
                                                                                            </li>
                                                                                        <?php
                                                                                    endwhile;
                                                                                endif;
                                                                                wp_reset_postdata();?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
												   <?php if ($count++ == 2) break; }
												}
											?>
								</div>
                    </div>
    </div>