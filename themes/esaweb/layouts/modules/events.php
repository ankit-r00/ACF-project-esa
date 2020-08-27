<?php
/**
 * events layout
 * Display events
 * @package Wordpress
 */

$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];

?>
<div class="events-section row <?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?> wow fadeIn" data-wow-delay="1s" data-wow-duration=".5s" style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
    <?php
        $tribe_events = new WP_Query(
        array(
                'post_type'      => 'tribe_events',
                'posts_per_page' => 3,
                'meta_key'  => '_EventEndDate',
                'meta_query' => array(
		                            'value'     => date('Y-m-d'),
		                            'key'   => '_EventEndDate',
		                            'compare' => '>=',
		                            'type' => 'DATE'
                                      )
            )
        );
        if ( $tribe_events->have_posts() ):
            $count = 0;
            while ( $tribe_events->have_posts() ) : $tribe_events->the_post();?>
                <?php $start_date = tribe_get_start_date( null, false, "m/d/Y");
                       $end_date = tribe_get_end_date( null, false, "m/d/Y")?>
                    <div class="events-article">
                        <div class="event-wrapper">
                            <div class="event-time">
                                <span><?php echo tribe_get_start_date( null, false, "d");?></span>
                                <span><?php echo tribe_get_start_date( null, false, "M");?></span>
                                <span><?php echo tribe_get_start_date( null, false, "Y");?></span>
                            </div>
                            <div class="event-content">
                                <h2>
                                    <a href="<?php if (tribe_get_event_website_url()){echo tribe_get_event_website_url();}else{the_permalink();} ?>" target="_blank"><?php the_title(); ?></a>
                                </h2>
                                <p><i class="far fa-clock"></i>
                                    <?php echo $start_date;?>
                                    <?php if (!tribe_event_is_all_day()){
                                    echo tribe_get_start_date( null, false, "h:i A");
                                    echo " - ";
                                    echo tribe_get_end_date( null, false, "h:i A");
                                    }
                                    if($start_date != $end_date){
                                    echo " - ". $end_date; }?>
                                </p>
                            </div>
                        </div>
                    </div>
          <?php
            endwhile;
           wp_reset_postdata();
        endif;
        wp_reset_query();
    ?>
    <div class="button text-center">
        <a class="btn btn-primary center" href="<?php echo esc_url( tribe_get_events_link() ); ?>" target="_blank">Click for More Events</a>
    </div>
</div>
