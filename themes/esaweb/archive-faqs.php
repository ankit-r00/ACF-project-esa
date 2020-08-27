<?php
/**
 * Faqs Archive Page
 */

get_header();
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <section class="inner-wrapper">
                <div class="container ">
                    <div class="row tab-wrapper esa-tabs horizontal">
                        <div class="col-md-8">
                            <div class="tab">
		                        <?php
		                        $atozs  = get_terms( 'faqs_type', array(
			                        'hide_empty' => false,
			                        'orderby'    => 'name',
		                        ) );?>
		                            <button class="tablinks active" onclick="openCity(event, 'all')" id="defaultOpen">All</button>
                                <?php foreach ( $atozs as $atoz ): ?>
                                    <button class="tablinks" onclick="openCity(event, '<?php echo $atoz->name; ?>')" id="defaultOpen"><?php echo $atoz->name; ?></button>
		                        <?php endforeach; ?>
                            </div>
                            <div id="all" class="tabcontent" style="display: block;">
                                <div class="panel-group esa-accordion">
			                        <?php
			                        $counts = "0";
                                        if ( have_posts() ) :
	                                        /* Start the Loop */
	                                        while ( have_posts() ) :
		                                            the_post();?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $counts; ?>" aria-expanded="false" aria-controls="collapse<?php echo $counts; ?>">
                                                                <i class="fa-icon"></i><?php echo the_title(); ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse<?php echo $counts; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body">
	                                                        <?php echo the_content(); ?>
                                                        </div>
                                                    </div>
                                                </div>
				                            <?php
				                             $counts++;
			                            endwhile;
			                            wp_reset_postdata(); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                                <?php foreach ( $atozs as $atoz ): ?>
	                            <?php $cat_slug = $atoz->name;
	                                $the_query = new WP_Query( array(
		                                'post_type' => 'faqs',
		                                'posts_per_page' => 9999,
		                                'tax_query' => array(
			                                array (
			                                        'taxonomy' => 'faqs_type',
				                                    'field' => 'slug',
				                                    'terms' => $cat_slug,
		    	                                    )
		                                         ),
	                                        ) );?>

                            <div id="<?php echo $atoz->name; ?>" class="tabcontent" style="display: none;">
                                 <div class="panel-group esa-accordion" id="accordion">
			                                <?php
			                                $count = "0";
			                                while ( $the_query->have_posts() ) :
				                                $the_query->the_post();?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php $string = str_replace(' ', '', $cat_slug); echo preg_replace('/[^A-Za-z0-9\-]/', '', $string); echo $count; ?>" aria-expanded="false" aria-controls="collapse<?php $string = str_replace(' ', '', $cat_slug); echo preg_replace('/[^A-Za-z0-9\-]/', '', $string); echo $count; ?>">
                                                                <i class="fa-icon"></i><?php echo the_title(); ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse<?php $string = str_replace(' ', '', $cat_slug); echo preg_replace('/[^A-Za-z0-9\-]/', '', $string); echo $count; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body">
													                                <?php echo the_content(); ?>
                                                        </div>
                                                    </div>
                                                </div>
				                                <?php
				                                $count++;
			                                endwhile;
			                                wp_reset_postdata(); ?>
                                 </div>
                            </div>
                                <?php endforeach; ?>
                        </div>
                        <div class="col-md-4">
                            <aside id="secondary" class="widget-area">
		                        <?php dynamic_sidebar( 'faq-sidebar' ); ?>
                                <?php include('layouts/modules/events.php');?>
                            </aside><!-- #secondary -->
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>





<?php
get_footer();
?>