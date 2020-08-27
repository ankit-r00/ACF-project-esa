<?php
/**
 * cards.php
 * Display cards layout
 * @package Wordpress
 */

$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];

?>
<div class="row cards-wrapper <?php the_sub_field('cards_type'); ?> <?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?>" style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
	<?php
	$cards = get_sub_field('cards');
	foreach ($cards as $card): ?>
		<div class="col-lg-<?php the_sub_field('layouts');?> wow fadeIn" data-wow-delay="1s" data-wow-duration=".5s">
			<?php if (get_sub_field('cards_type')=="image"){?>
				<div>
					<?php if ($card['image']){?>
						<figure>
							<?php echo wp_get_attachment_image( $card['image'], 'full'); ?>
						</figure>
				<?php } } else {
			            echo "<div class='card-block'>";
						if (get_sub_field('cards_type')=="icon"){ echo "<div class='icon-block'>"; }
					if ($card['icon']){?>
					<i class="<?php echo $card['icon'];?>"></i>
			<?php }
				if (get_sub_field('cards_type')=="icon"){ echo "</div>"; } }
			if (get_sub_field('cards_type')=="icon"){ echo "<div class='content'>"; }else{ echo "<div class='green-block'>";}?>
                    <h6><?php if ($card['url']){?><a href="<?php echo $card['url'];?>"><?php } echo $card['heading']; ?><?php if ($card['url']){echo "</a>";}?></h6>
							<?php if (get_sub_field('cards_type')=="image"){ echo "</div></div>"; }?>
							<?php echo $card['content']; ?>
			<?php if (get_sub_field('cards_type')=="icon"){ echo "</div></div>"; }?>
		</div>
	<?php endforeach; ?>
</div>
