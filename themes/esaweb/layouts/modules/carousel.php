<?php
/**
 * Carousel layout
 * Display carousel
 * @package Wordpress
 */
$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];
?>
<?php $data = get_sub_field('carousel_image'); ?>
<div class="slider-box <?php if (get_sub_field('carousel_type')=='logo'){echo "carousel";} else{ echo "image-carousel";}?> <?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?>"  style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
	<h3><?php the_sub_field('title')?></h3>
	<?php
	if(!empty($data)) :
		foreach($data as $val):
			?>
			<div class="slider-content">
				<?php if (get_sub_field('carousel_type')=='content'){?>
                    <p><?php echo $val['content']; ?></p>
                <?php }else{ ?>
                <figure class="<?php if (get_sub_field('carousel_type')=='logo'){echo "logo";} else{ echo "images";}?>">
					<?php if ($val['url']){?><a href="<?php echo $val['url']; ?>" target="_blank"><?php } ?><?php echo wp_get_attachment_image( $val['image'], 'large');?><?php if ($val['url']){?></a><?php } ?>
				</figure>
                    <?php if ($val['title']){?>
                        <figurecaption>
                            <?php echo $val['title']; ?>
                        </figurecaption>
                <?php } } ?>
			</div>
		<?php
		endforeach;
	endif;
	?>
</div>