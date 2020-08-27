<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EsaWeb
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <section class="inner-wrapper">
                <div class="container ">
                    <div class="inner-banner inner-right cat-banner">
                        <div class="row">
                            <div class="col-12 mb-4 pt-4">
                                <?php
                                // Get the current category ID, e.g. if we're on a category archive page
                                $category = get_category(get_query_var('cat'));
                                $cat_id = $category->cat_ID;
                                // Get the image ID for the category
                                $image_id = get_term_meta($cat_id, 'category-image-id', true);
                                // Echo the image
                                echo wp_get_attachment_image($image_id, 'large');
                                //Echo description of category
                                the_archive_description('<div class="taxonomy-description">', '</div>');
                                ?>
                            </div>
                            <div class="col-md-8 blog-content  wow fadeIn" data-wow-delay="1s" data-wow-duration=".5s"">
                                <?php if (get_field('post_header_ads','options')){?>
                                    <div class="ads-wrapper">
										<?php  $ad_id = get_field('post_header_ads','options');?>
										<?php echo bsa_pro_ad_space($ad_id['select_ads_space']); ?>
                                    </div>
	                        <?php } ?>
								<?php
                                if (have_posts()) :
                                    /* Start the Loop */
                                    while (have_posts()) :
                                        the_post();
                                        ?>
                                        <div class="post-wrapper">
                                            <div class="post-blog">
                                                <?php if (get_the_post_thumbnail_url($post->ID)){?>
                                                <div class="post-image">
		                                            <?php echo get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'post__image','alt'=>get_the_title(),'title'=>get_the_title() ) );?>
                                                </div>
                                                <?php } ?>
                                                <div class="post-date">
                                                    <span> <?php if (get_the_date()){ echo "Posted: ".get_the_date(); }?></span>
                                                </div>
                                                <div class="post-category">
                                                    <?php
                                                    $categories = get_the_category();
                                                    $separator = ', ';
                                                    $output = '';
                                                    if ( ! empty( $categories ) ) {
                                                        $output .='Categories: ';
	                                                    foreach( $categories as $category ) {
		                                                    $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
	                                                    }
	                                                    echo trim( $output, $separator );
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="content-blog">
                                                <div class="post-title">
                                                    <a href="<?php echo get_permalink(); ?>"><h2 class="post__title"><?php the_title();?></h2></a>
                                                </div>
                                                <div class="post-author">
                                                    <h3>
			                                            <?php if (get_field('author')){echo "by ".get_field('author');}
			                                            if (get_field('author_title')){ echo " - ".get_field('author_title'); } ?>
                                                    </h3>
                                                </div>
                                                <div class="post_content"><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></div>
                                                <div class="button text-right">
                                                    <a class="btn btn-primary" href="<?php echo get_permalink(); ?>">Read more </a>
                                                </div>
                                                <aside>
		                                            <?php the_widget('WP_Widget_RSS'); ?>
                                                </aside>
                                            </div>
                                        </div>
									<?php
                                    endwhile;
                                    get_template_part('lib/pagination');

                                endif;
								if (get_field('post_footer_ads','options')){?>
                                    <div class="ads-wrapper">
										<?php  $ad_id = get_field('post_footer_ads','options');?>
										<?php echo bsa_pro_ad_space($ad_id['select_ads_space']); ?>
                                    </div>
	                        <?php } ?>
                            </div>
                            <div class="col-md-4 sidebar  wow fadeIn" data-wow-delay="1.5s" data-wow-duration="1s">
								<?php get_sidebar(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
