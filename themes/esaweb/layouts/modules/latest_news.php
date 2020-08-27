<?php
/**
 * latest_news
 * Display post
 * @package Wordpress
 */

$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];

?>

<?php
global $post;
$news = get_sub_field('show_news');
if($news == 'grid'){$numberposts = 3;}else{$numberposts = 4;}
    $args = array(
        'posts_per_page' => $numberposts,
        'offset' => 0,
        'category' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
wp_reset_postdata();
    $recent_posts = new WP_Query( $args );
    ?>

        <div class="row <?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?>"  style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
           <?php if ( $recent_posts->have_posts() ):
                   $count = 0;
                   while ( $recent_posts->have_posts() ) : $recent_posts->the_post();?>
                       <div class="<?php if ($news == 'grid'){ echo "col-sm-4 grid";}else{ echo "col-12 list";}?> wow fadeIn" data-wow-delay="1.5s" data-wow-duration="1s">
                           <?php if ($news == 'list'){echo "<div class='blog-list'>";}?>
                           <figure>
                               <a href="<?php echo get_the_permalink()?>"><img src="<?php echo get_the_post_thumbnail_url();?>" /></a>
                           </figure>
                           <div class="post-content">
                             <span class="time">
                                <?php if ($news == 'list'){ echo get_the_date('l, F j, Y'); }else{ echo get_the_date(); }?>
                             </span>
                             <h2 class="post-title">
                                 <a href="<?php echo get_the_permalink()?>"><?php the_title();?></a>
                             </h2>
                             <?php if ($news== 'grid'){?>
                              <p>
                                  <?php
                                      $content = get_the_content();
                                      echo $shorttitle = wp_trim_words( $content, $num_words = 30, $more = '… ' );
                                  ?>
                               </p>
                              <?php }?>
                           </div>
	                       <?php if ($news == 'list'){echo "</div>";}?>
                       </div>
                       <?php
                           endwhile;
                           wp_reset_postdata();
                            endif;
                       ?>
        </div>