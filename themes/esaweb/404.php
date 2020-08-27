<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package EsaWeb
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found mt-5 mb-5">
                <div class="container">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'esaweb' ); ?></h1>
                    </header><!-- .page-header -->
                    <div class="page-content text-center">
                        <p><?php esc_html_e( 'The page you searched for is no longer available.', 'esaweb' ); ?></p>
                    </div><!-- .page-content -->
                    <div class="row">
                        <div class="col-md-6">
                           <img src="<?php echo get_template_directory_uri();?>/images/security.jpg">
                        </div>
                        <div class="col-md-6">
                            <p><strong>How'd I Get Here?</strong></p>

                            <ul>
                                <li>We just launched a new site so some older content may not be available</li>
                                <li>We missed a link. <a href="/Contact-Us">Let us know</a> &amp; we'll get it fixed!<br>
                                    &nbsp;</li>
                            </ul>

                            <p>&nbsp;</p>

                            <p><strong>What To&nbsp;Do?</strong></p>

                            <ul>
                                <li>Search - our search (top right of page) can instantly get you results</li>
                                <li><a href="/Contact-Us">Contact Us</a>&nbsp;</li>
                            </ul>
                        </div>
                    </div>
                </div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
