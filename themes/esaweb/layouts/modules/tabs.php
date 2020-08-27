<?php
/**
 * tabs.php
 * Display tabs layout
 * @package Wordpress
 */

$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];

?>
 <div class="tab-wrapper esa-tabs <?php the_sub_field('tabs_type'); ?> <?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?>" style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
	<div class="tab">
        <?php $tabs = get_sub_field('tabs'); ?>
        <?php $i = 0;
        foreach ($tabs as $tab): ?>
		<button class="tablinks<?php if($i==0){echo " active";}?>" onclick="openCity(event, '<?php echo $tab['title']; ?>')" id="<?php if($i==0){echo "defaultOpen";}?>"><?php echo $tab['title']; ?></button>
	    <?php $i++; endforeach; ?>
    </div>
<?php $j = 0;
foreach ($tabs as $tab): ?>
	<div id="<?php echo $tab['title']; ?>" class="tabcontent" style="display: <?php if($j==0){echo "block";}else{echo "none";}?>;">
		<p><?php echo $tab['content']; ?>
			<?php $accordions = $tab['accordions'];
			if ($accordions):?>
        <div class="panel-group esa-accordion">
            <?php
			$count = "0";
			foreach ($accordions as $accordion) {
			    if ($accordion){
			        foreach ($accordion as $item){
				    ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php $string = str_replace(' & ', '', $tab['title']); echo preg_replace('/[^A-Za-z0-9\-]/', '', $string); echo $count; ?>" aria-expanded="false" aria-controls="collapse<?php $string = str_replace(' & ', '', $tab['title']); echo preg_replace('/[^A-Za-z0-9\-]/', '', $string); echo $count; ?>">
                                        <i class="fa-icon"></i><?php echo $item['title']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?php $string = str_replace(' & ', '', $tab['title']); echo preg_replace('/[^A-Za-z0-9\-]/', '', $string); echo $count; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
							        <?php echo $item['content']; ?>
                                </div>
                            </div>
                        </div>
				        <?php
                        $count ++;
			}   }   }?>
        </div>
		<?php endif; ?>
        </p>
	</div>
<?php $j++; ?>
    <?php endforeach; ?>
 </div>
