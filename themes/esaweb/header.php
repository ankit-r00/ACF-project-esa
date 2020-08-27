<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EsaWeb
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-26192218-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-26192218-1');
    </script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

    <header id="masthead" class="site-header">
        <div class="top-header">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-5 col-lg-8 align-self-md-center">
                        <!-- Top Menu Starts -->
						<?php
							wp_nav_menu(
								array(
									'menu' => 'Top Nav'
								)
							); ?>
                    </div>
                    <div class="col-md-4 col-lg-2 align-self-md-center d-none d-sm-block">
											<?php get_search_form();  // for search option?>
                    </div>
                    <div class="col-md-3 col-lg-2 text-md-right esa-login pr-0">
											<?php if ( is_user_logged_in() ) { ?>
                          <a href="https://members.esaweb.org/DesktopModules/MX/SignOut.aspx?ReturnURL=<?php echo home_url(); ?>?logout" class="btn">Logout</a>
											<?php } else { ?>
                          <a href="https://members.esaweb.org/Home/Sign-In" title="Login" class="btn">Login</a>
											<?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-header" id="bottom-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 align-self-md-center">
                        <!-- Logo code -->
                        <a class="navbar-brand" href="#">
							<?php the_custom_logo();?>
                        </a>
                        <div class="col d-block d-sm-none mobile-search">
                            <i id="toggle-search" class="fas fa-search"></i>
                            <span class="col" style="display:none;" id="searchBar">
								<?php get_search_form();?>
							</span>
                        </div>
                    </div>
                    <div class="col-md-9 align-self-md-center">
                        <nav class="navbar navbar-expand-xl dropdown p-0">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                <span class="navbar-toggler-icon"></span>
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Main Menu Starts -->
                            <nav id="site-navigation" class="main-navigation">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
									<?php
										wp_nav_menu(
											array(
												'menu' => 'Main Nav'
												)
										); ?>
                                </div>
                            </nav>
                            <!-- Main Menu End -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="light-blue-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <figure class="float-right">
								<?php if (get_field('ads_on_header','options')){
									$adds_id = get_field('ads_on_header','options');
										echo bsa_pro_ad_space($adds_id);
								} ?>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">