<?php
/**
 * members.php
 * Display custom post type of our team and committees
 * @package Wordpress
 */

$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];

?>
<div class="<?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?> wow fadeIn" data-wow-delay="1s" data-wow-duration=".5s"  style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
	<?php
	$member_type = get_sub_field('member_type');
	$count=0;
	if ($member_type == 'our_team'){$taxonomy = "team_types";}elseif ($member_type =='committees'){$taxonomy= "member_types";}
	if (get_sub_field('display')) {
        //display posts according selected category
        if ($member_type == 'our_team'){ $term = get_sub_field('our_team_taxonomy');}elseif ($member_type =='committees'){$term = get_sub_field('committees_taxonomy');}
        //print_r($term->name);
        //die();
        $args = array(
        'post_type' => $member_type,
        'posts_per_page' => -1,
        'tax_query' => array(
        array(
        'taxonomy' => $taxonomy,
        'field' => 'slug',
        'terms' => $term->name,
             )
            )
        );
        $query = new WP_Query($args);?>
        <div class="row term-block tab-grid">

            <?php if (get_sub_field('display_taxonomy')=="slider"){?><div class="col-12 slider-box image-slider"><?php }else{echo "<div class='col-12 tab-container'>";}?>
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
			//print_r($query);
			//die();
				if (get_sub_field('display_taxonomy')=="slider"){?>
                                <div class="slider-content"> <!--slider layout-->
                                         <figure>
	                                        <?php the_post_thumbnail(); ?>
                                        </figure>
                                    <a data-toggle="modal" data-target="#myModal<?php echo "$count"; ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
				<?php } else {?>

                    <div class="data-grid">     <!-- grid layout-->
                        <a data-toggle="modal" data-target="#myModal<?php echo "$count"; ?>">
                            <figure>
								<?php the_post_thumbnail(); ?>
                                <figcaption>
                                    <span class="member-name"><?php the_title(); ?></span> <?php if (get_field('position')){
		                                $department = get_field('department');
		                                if ($department->name == $term->name){
			                                echo "- Committee Chair";
		                                }else{echo " - ".get_field('title');}
	                                }else{ if (get_field('title')){echo " - ".get_field('title');}else{echo " - ".get_field('sub_title');}}?>
                                </figcaption>
                            </figure>
                        </a>
                        <?php } ?>
                       <?php if (get_sub_field('display_taxonomy')=="grid"){echo "</div>";}
				$count++;
			endwhile;
			wp_reset_postdata(); ?>
			</div>
		        <?php
                $j=0;
		        while ( $query->have_posts() ) :
			        $query->the_post();?>
                <!-- The Modal -->
                    <div class="modal fade" id="myModal<?php echo "$j"; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header"> <button type="button" class="btn btn-modal-close" data-dismiss="modal"><i class="fas fa-times"></i></button></div>
                                <div class=" modal-body">
                                    <div class="modal-title">
                                        <h2><?php the_title(); ?> <?php if (get_field('position')){
		                                        $department = get_field('department');
		                                        if ($department->name == $term->name){
			                                        echo "- Committee Chair";
		                                        }else{echo " - ".get_field('title');}
	                                        }else{ echo " - ".get_field('title');}?></h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="modal-image">
										        <?php the_post_thumbnail(); ?>
                                                <span>
                                                    <?php $term_list = wp_get_post_terms( get_the_ID(), $taxonomy, array( 'fields' => 'all' ) );
                                                    if ($term_list){echo "<strong>Categories:</strong> ";}
                                                    $len = count($term_list);
                                                    foreach ( $term_list as $list ) {
	                                                    echo $list->name;
	                                                    if( $len > 1) echo ', ';
	                                                    $len--;
                                                    }?>
                                                  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="modal-content-section">
                                                <div class="title">
											        <?php the_title(); ?>
                                                </div>
										        <?php if ( get_field( 'sub_title' ) ): ?>
                                                    <div class="sub-title"><?php the_field( 'sub_title' ); ?></div>
										        <?php endif; ?>
										        <?php if ( get_field( 'email' ) ): ?>
                                                    <div class="email">Email: <a href="mailto:<?php the_field( 'email' ); ?>"><?php the_field( 'email' ); ?></a>
                                                    </div>
										        <?php endif; ?>
										        <?php if ( get_field( 'contact_no' ) ): ?>

                                                    <div class="contact">phone: <a href="tel:<?php the_field( 'contact_no' ); ?>"><?php the_field( 'contact_no' ); ?></a>
                                                    </div><?php endif; ?>
										        <?php if ( get_field( 'bio' ) ): ?>

                                                    <div class="bio">Bio: <a href="tel:<?php the_field( 'bio' ); ?>"><?php the_field( 'bio' ); ?></a>
                                                    </div><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!--model ends-->
		        <?php $j++; endwhile;
		        wp_reset_postdata(); ?>
        </div>

	<?php }
		else{ ?>
            <!--Archive section-->
				<div class="tab data-tab">
					<?php
					//print_r($taxonomy);
					$atozs  = get_terms( $taxonomy, array(
						'hide_empty' => false,
						'orderby'    => 'name',
					) );
                    $i=0;?>
					<?php foreach ( $atozs as $atoz ): ?>
						<button class="tablinks<?php if($i==0){echo " active";}?>" onclick="openCity(event, '<?php echo $atoz->name; ?>')" id="<?php if($i==0){echo "defaultOpen";}?>"><?php echo $atoz->name; ?></button>
					<?php $i++; endforeach; ?>
				</div>
				<?php $counts=0;
				foreach ( $atozs as $atoz ): ?>
					<?php $cat_slug = $atoz->name;
					$the_query = new WP_Query( array(
						'post_type' => $member_type,
						'posts_per_page' => -1,
						'tax_query' => array(
							array (
								'taxonomy' => $taxonomy,
								'field' => 'slug',
								'terms' => $cat_slug,
							)
						),
					) );?>

					<div class="row tabcontent tab-grid" id="<?php echo $atoz->name; ?>" >
                        <div class="col-12 tab-container">
                <?php
							while ( $the_query->have_posts() ) :
								$the_query->the_post();?>
                                    <div class="data-grid">
                                        <a data-toggle="modal" data-target="#myModals<?php echo "$counts"; ?>">
                                            <figure>
                                                <?php the_post_thumbnail(); ?>
                                                <figcaption>
                                                    <div class="member-name">
			                                            <?php the_title(); ?>
                                                    </div>
	                                                <?php if (get_field('position')){
		                                                $department = get_field('department');
		                                                if ($department->name == $atoz->name){
			                                                echo "Committee Chair";
		                                                }else{echo get_field('title');}
	                                                }else{ if (get_field('title')){echo get_field('title');}else{echo get_field('sub_title');}}?>
                                                </figcaption>
                                            </figure>

                                        </a>

                                        <!-- The Modal -->
                                        <div class="modal fade" id="myModals<?php echo $counts; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header"> <button type="button" class="btn btn-modal-close" data-dismiss="modal"><i class="fas fa-times"></i></button></div>
                                                    <div class=" modal-body">
                                                        <div class="modal-title">
                                                            <h2><?php the_title(); ?> - <?php if (get_field('position')){
		                                                            $department = get_field('department');
		                                                            if ($department->name == $atoz->name){
			                                                            echo "Committee Chair";
		                                                            }else{echo get_field('sub_title');}
	                                                            }else{if (get_field('title')){echo get_field('title');}else{echo get_field('sub_title');}}?></h2>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="modal-image">
															              <?php the_post_thumbnail(); ?>
                                                                    <span>
                                                                        <?php $term_list = wp_get_post_terms( get_the_ID(), $taxonomy, array( 'fields' => 'all' ) );
                                                                         if ($term_list){echo "<strong>Categories:</strong> ";}
                                                                         $len = count($term_list);
                                                                        foreach ( $term_list as $list ) {
                                                                            echo $list->name;
	                                                                        if( $len > 1) echo ', ';
	                                                                        $len--;
                                                                        }?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="modal-content-section">
															                                    <?php if ( get_field( 'sub_title' ) ): ?>
                                                                      <div class="sub-title"><?php the_field( 'sub_title' ); ?></div>
															                                    <?php endif; ?>
															                                    <?php if ( get_field( 'email' ) ): ?>
                                                                      <div class="email">Email: <a href="mailto:<?php the_field( 'email' ); ?>"><?php the_field( 'email' ); ?></a>
                                                                      </div>
															                                    <?php endif; ?>
															                                    <?php if ( get_field( 'contact_no' ) ): ?>

                                                                      <div class="contact">phone: <a href="tel:<?php the_field( 'contact_no' ); ?>"><?php the_field( 'contact_no' ); ?></a>
                                                                      </div><?php endif; ?>
															                                    <?php if ( get_field( 'bio' ) ): ?>

                                                                      <div class="bio">Bio: <a href="tel:<?php the_field( 'bio' ); ?>"><?php the_field( 'bio' ); ?></a>
                                                                      </div><?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--model ends-->
                                    </div>

								<?php
                            $counts++;
							endwhile;
							wp_reset_postdata(); ?>
                        </div>
					</div>
				<?php endforeach; }?>
                <!-- end archive section-->
</div>