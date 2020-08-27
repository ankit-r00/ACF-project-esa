<?php
/**
 * image_cards.php
 * Display post images card
 * @package Wordpress
 */

$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];

?>
<div class="<?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?> wow fadeIn" data-wow-delay="1s" data-wow-duration=".5s"  style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
		<div class="row">
            <div class="col-12 boxpopup">
	            <?php
	            $img_cards=get_sub_field('cards');
	            if ($img_cards):
		            $count=0;
		            foreach ($img_cards as $card):?>
                    <div class="boxpopup--card">
                        <div class="boxpopup--card__content">
                            <div class="boxpopup--card__content--img ">
                                <a data-toggle="modal" data-target="#myModal<?php echo $count; echo $count; $string = str_replace(' ', '', $card['title']); echo preg_replace('/[^A-Za-z0-9\-]/', '', $string);?>?>">
                                    <figure>
													            <?php echo wp_get_attachment_image( $card['image'], 'full'); ?>
                                    </figure>
                                </a>
                            </div>
                            <h2 class="boxpopup--card__content--heading"><a data-toggle="modal" data-target="#myModal<?php echo $count; $string = str_replace(' ', '', $card['title']); echo preg_replace('/[^A-Za-z0-9\-]/', '', $string);?>"><?php echo $card['title'];?></a></h2>
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal<?php echo $count; $string = str_replace(' ', '', $card['title']); echo preg_replace('/[^A-Za-z0-9\-]/', '', $string);?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
									                        <?php echo $card['modal_box']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
			            <?php
			            $count++;
		            endforeach;
	            endif;?>
            </div>
		</div>
</div>
