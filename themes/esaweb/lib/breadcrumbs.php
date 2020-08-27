<?php
function the_breadcrumb() {
    global $post;
    echo '<ul class="breadcrumb-listing">';
    if (is_category() || is_single()) {
        echo '<li>';
        echo '<a href='. get_permalink( get_option( 'page_for_posts' ) ) .'>'. get_the_title(get_option( 'page_for_posts' )) . '</a><i class="fal fa-angle-double-right" aria-hidden="true"></i>';
        echo '</li><li>';
        the_category('<i class="fal fa-angle-double-right" aria-hidden="true"></i></li><li> ');
        if (is_single()) {
            echo '<i class="fal fa-angle-double-right" aria-hidden="true"></i></li><li>';
            echo wp_trim_words( get_the_title(), 5, '...' );
            echo '</li>';
        }
    }
    elseif (is_page()) {
        if($post->post_parent){
            $anc = get_post_ancestors( $post->ID );
            $anc = array_reverse($anc);
            $title = get_the_title();
            foreach ( $anc as $ancestor ) {
                $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a><i class="fal fa-angle-double-right" aria-hidden="true"></i></li>';
                echo $output;}
            echo '<li>'.$title.'</li>';
        } else {
            echo '<li><a rel="nofollow">'.get_the_title().'</a><i class="fal fa-angle-double-right" aria-hidden="true"></i></li>';
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
}
?>