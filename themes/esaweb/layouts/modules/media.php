<?php
/**
 * media layout
 * Display post media
 * @package Wordpress
 */

$background = get_sub_field('background_design');
$padding = $background['padding'];
$margin = $background['margin'];
$border = $background['border'];

?>
<?php if (get_sub_field('content_with_media')) {?><div class="row" style="padding: <?php if ($padding['top_padding']) {
    echo $padding['top_padding'];
} else {
    echo "0";
}echo "px "; if ($padding['right_padding']) {
    echo $padding['right_padding'];
} else {
    echo "0";
}echo "px "; if ($padding['bottom_padding']) {
    echo $padding['bottom_padding'];
} else {
    echo "0";
}echo "px "; if ($padding['left_padding']) {
    echo $padding['left_padding'];
} else {
    echo "0";
}echo "px;";?> margin: <?php if ($margin['top_margin']) {
    echo $margin['top_margin'];
} else {
    echo "0";
}echo "px "; if ($margin['right_margin']) {
    echo $margin['right_margin'];
} else {
    echo "0";
}echo "px "; if ($margin['bottom_margin']) {
    echo $margin['bottom_margin'];
} else {
    echo "0";
}echo "px "; if ($margin['left_margin']) {
    echo $margin['left_margin'];
} else {
    echo "0";
}echo "px;";?> <?php if ($background['border_type'] != 'none') {
    echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:";
    if ($border['top']) {
        echo $border['top'];
    } else {
        echo "0";
    }
    echo "px ";
    if ($border['right']) {
        echo $border['right'];
    } else {
        echo "0";
    }
    echo "px ";
    if ($border['bottom']) {
        echo $border['bottom'];
    } else {
        echo "0";
    }
    echo "px ";
    if ($border['left']) {
        echo $border['left'];
    } else {
        echo "0";
    }
    echo "px;";
}?> <?php if ($background['background_type'] == 'color') {
    echo "background-color: ".$background['background_color'].";";
} elseif ($background['background_type'] == 'image') {
    echo "background-image: url(".$background['background_image'].");";
}?>"><?php } ?>
<div class="<?php if (get_sub_field('content_with_media')) {?>col-lg-6 mb-4 mb-lg-0 image-block <?php the_sub_field('position');  } else {
    echo "col-md-12";
}  if ($background['class']== 'custom') {
    echo $background['custom_class'];
} else {
    echo $background['class'];
} ?> wow fadeIn" data-wow-delay="1s" data-wow-duration=".5s" <?php if (get_sub_field('content_with_media')) {
} else {?>style="padding: <?php if ($padding['top_padding']) {
    echo $padding['top_padding'];
} else {
    echo "0";
}echo "px "; if ($padding['right_padding']) {
    echo $padding['right_padding'];
} else {
    echo "0";
}echo "px "; if ($padding['bottom_padding']) {
    echo $padding['bottom_padding'];
} else {
    echo "0";
}echo "px "; if ($padding['left_padding']) {
    echo $padding['left_padding'];
} else {
    echo "0";
}echo "px;";?> margin: <?php if ($margin['top_margin']) {
    echo $margin['top_margin'];
} else {
    echo "0";
}echo "px "; if ($margin['right_margin']) {
    echo $margin['right_margin'];
} else {
    echo "0";
}echo "px "; if ($margin['bottom_margin']) {
    echo $margin['bottom_margin'];
} else {
    echo "0";
}echo "px "; if ($margin['left_margin']) {
    echo $margin['left_margin'];
} else {
    echo "0";
}echo "px;";?> <?php if ($background['border_type'] != 'none') {
    echo "border-style:". $background['border_type'] ."; border-color:".$border['border_color'].";border-width:";
    if ($border['top']) {
        echo $border['top'];
    } else {
        echo "0";
    }
    echo "px ";
    if ($border['right']) {
        echo $border['right'];
    } else {
        echo "0";
    }
    echo "px ";
    if ($border['bottom']) {
        echo $border['bottom'];
    } else {
        echo "0";
    }
    echo "px ";
    if ($border['left']) {
        echo $border['left'];
    } else {
        echo "0";
    }
    echo "px;";
}?> <?php if ($background['background_type'] == 'color') {
    echo "background-color: ".$background['background_color'].";";
} elseif ($background['background_type'] == 'image') {
    echo "background-image: url(".$background['background_image'].");";
}?>"<?php } ?>>
    <?php if (get_sub_field('media_type')=='image') { ?>
        <figure>
            <?php if (get_sub_field('url')) {?> <a href="<?php the_sub_field('url'); ?>" target="_blank"><?php } ?>
           <?php echo wp_get_attachment_image(get_sub_field('image'), 'full'); ?>
		        <?php if (get_sub_field('url')) {?></a><?php } ?>
        </figure>
        <?php } else {?>
        <div class="embed-container text-center responsive-video">
            <?php the_sub_field('video'); ?>
        </div>
    <?php } ?>
</div>
	<?php if (get_sub_field('content_with_media')) {?><div class="col-lg-6 content-block wow fadeIn" data-wow-delay="1s" data-wow-duration=".5s">
            <?php the_sub_field('content');?>
		    </div><?php } ?>
<?php if (get_sub_field('content_with_media')) {
    echo "</div>";
}?>