<?php
/**
 * The template for displaying documents archive page
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
					<div class="documents">
						<ul>
							<h1><i class="far fa-folder"></i>  All Documents</h1>
							<ul>
							<?php
							if (have_posts()) :
								/* Start the Loop */
								while (have_posts()) :
									the_post();
									?>
									<li><i class="far fa-folder"></i> <a href="<?php the_permalink()?>"><?php the_title();?></a></li>
								<?php
								endwhile;
							endif;?>
						</ul>
						</div>
					</div>
				</div>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
