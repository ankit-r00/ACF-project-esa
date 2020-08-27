<?php
/*
 *  Three Columns (col3 - col5 - col4) layouts
 */
$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];
?>

<section class="inner-wrapper">
    <div class="<?php if (get_sub_field('full_width')){ the_sub_field('full_width'); echo " p-0";} else{ echo"container";}?>">
        <div class="row <?php if ($background['class']== 'custom'){ echo $background['custom_class'];}else{ echo $background['class']; } ?>" style="padding: <?php if ($padding['top_padding']){echo $padding['top_padding'];}else{echo "0";}echo "px "; if ($padding['right_padding']){echo $padding['right_padding'];}else{echo "0";}echo "px "; if ($padding['bottom_padding']){echo $padding['bottom_padding'];}else{echo "0";}echo "px "; if ($padding['left_padding']){echo $padding['left_padding'];}else{echo "0";}echo "px;";?> margin: <?php if ($margin['top_margin']){echo $margin['top_margin'];}else{echo "0";}echo "px "; if ($margin['right_margin']){echo $margin['right_margin'];}else{echo "0";}echo "px "; if ($margin['bottom_margin']){echo $margin['bottom_margin'];}else{echo "0";}echo "px "; if ($margin['left_margin']){echo $margin['left_margin'];}else{echo "0";}echo "px;";?> <?php if ($background['border_type'] != 'none'){ echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:"; if ($border['top']){echo $border['top'];}else{echo "0";}echo "px "; if ($border['right']){echo $border['right'];}else{echo "0";}echo "px "; if ($border['bottom']){echo $border['bottom'];}else{echo "0";}echo "px "; if ($border['left']){echo $border['left'];}else{echo "0";}echo "px;";}?> <?php if ($background['background_type'] == 'color'){echo "background-color: ".$background['background_color'].";";} elseif ($background['background_type'] == 'image'){echo "background-image: url(".$background['background_image'].");";}?>">
            <?php
            // check if the repeater field has rows of data
            if (have_rows('three_columns_content')):
                $i = 0;
                // loop through the rows of data
                while (have_rows('three_columns_content')) : the_row();
                        $i++;
                        if($i==1){
                            echo '<div class="col-md-3">';
                        }elseif ($i==2){
                            echo '<div class="col-md-5">';
                        }else{
                            echo '<div class="col-md-4">';
                        }
                    if (have_rows('modules')) :
                        while (have_rows('modules')) : the_row();
                            include('modules/' . get_row_layout() . '.php');
                        endwhile;
                    endif;
                    echo '</div>';
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>