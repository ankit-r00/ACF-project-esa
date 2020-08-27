<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EsaWeb
 */


get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

	if ( have_rows( 'content_row_layouts' ) ) :

		$block_count = 1;

		while ( have_rows( 'content_row_layouts' ) ) : the_row();

			ACF_Layout::render( get_row_layout(), $block_count );
			$block_count ++;

		endwhile;

	else:
		?>
	<div class="container">
		<div class="row pt-4 event-banner">
            <?php //if(isset($post->post_type) && $post->post_type=='tribe_events'){ echo "check post type";
            if(isset($post->post_type) && is_post_type_archive(  'tribe_events' )){?><!-- check post type events-->
                <div class="col-md-12">
                    <figure>
					            <?php echo wp_get_attachment_image( get_field('event_banner', 'options'), 'full' );?>
                    </figure>
                </div>
                <div class="col-md-8">
			            <?php get_template_part( 'template-parts/content', 'page' );?>

                </div>
                <div class="col-md-4">
                    <aside id="secondary" class="widget-area">
					            <?php dynamic_sidebar( 'faq-sidebar' ); ?>
                    </aside><!-- #secondary -->
                </div>
            <?php }
            else {?>
                <div class="col-md-8 wow fadeIn" data-wow-delay="1s" data-wow-duration=".5s">
			            <?php
			            // Include the page content template.
			            get_template_part( 'template-parts/content', 'page' );
			            ?>
                </div>
                <div class="col-md-4 pt-4 pb-5 sidebar wow fadeIn" data-wow-delay="1.5s" data-wow-duration="1s">
                    <aside id="secondary" class="widget-area">
					            <?php dynamic_sidebar( 'gd-sidebar' ); ?>
                    </aside><!-- #secondary -->
                </div>
              <?php } ?>
		</div>
	</div>

<?php  endif; endwhile; endif; ?>

<?php
get_footer();

?>