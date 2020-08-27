<?php
/*
 * Accordion layout
 */
?>
<?php
$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];
?>
<?php $accordions = get_sub_field('accordion');
if ($accordions):?>
					<div class="panel-group esa-accordion  <?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?>" id="accordion2" role="tablist" aria-multiselectable="true" style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
						<?php
						if (empty($count)){$count = "0";}
						foreach ($accordions as $accordion):?>
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne2">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne<?php echo $count;?>" aria-expanded="false" aria-controls="collapse<?php echo $count;?>">
											<i class="fa-icon"></i><?php echo $accordion['title']; ?>
										</a>
									</h4>
								</div>
								<div id="collapseOne<?php echo $count;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne2">
									<div class="panel-body">
										<?php echo $accordion['content']; ?>
									</div>
								</div>
							</div>
							<?php
							$count++;
						endforeach; ?>
					</div>
<?php
endif;
?>
