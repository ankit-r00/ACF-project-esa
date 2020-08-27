<?php
/**
 * The template for displaying all documents single posts
 *
 * @package EsaWeb
 */
get_header();
?>
    <div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="inner-wrapper">
            <div class="document-wrapper">
                <div class="container">
                    <div class="row">
						<?php
						while ( have_posts() ) :
							the_post();?>
                                <div class="col-md-12">
                                   <h1><?php the_title(); ?></h1>
                                </div>
                                <div class="row docs">
                                    <div class="accordion col-12" id="accordionExample">
                                        <?php $dir = get_field('directory');
                                        if ($dir):
                                        $count = 0;
                                          foreach ($dir as $d):?>
                                        <div class="card">
                                            <div class="card-header" id="heading<?php echo str_replace(' ', '', $d['name']); echo $count;?>">
                                                <h2 class="mb-0">
                                                    <a type="" class="" data-toggle="collapse" data-target="#collapse<?php echo str_replace(' ', '', $d['name']); echo $count;?>"><i class="far fa-folder"></i> <?php echo $d['name']; ?></a>
                                                </h2>
                                            </div>
                                            <div id="collapse<?php echo str_replace(' ', '', $d['name']); echo $count; ?>" class="collapse" aria-labelledby="heading<?php echo str_replace(' ', '', $d['name']); echo $count; ?>" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul class="pl-0">
                                                        <?php foreach ($d['file']['files'] as $files){ ?>
                                                            <li class="clearfix">
                                                                <div class="float-md-left">
                                                                    <h4><i class="fal fa-file-pdf"></i> <?php echo $files['upload_files']['title'];?></h4>
                                                                </div>
                                                                <div class="float-md-right">
                                                                    <a class="" href="<?php echo $files['upload_files']['url']; ?>" target="_blank"><i class="fal fa-eye"></i> View</a>
                                                                    <a class="" href="<?php echo $files['upload_files']['url']; ?>" download><i class="fal fa-download"></i> Download</a>
                                                                </div>
                                                            </li>
								                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                          <?php $count++; endforeach;
                                          endif;?>
                                    </div>
                                    <?php $docs = get_field('files');
                                        if ($docs):?>
                                    <div class="card-body">
                                    <ul class="pl-0">
                                            <?php foreach ($docs as $doc):?>
                                                <?php //print_r($doc);?>
                                                    <li class="clearfix">
                                                        <div class="float-md-left">
                                                            <h4><i class="fal fa-file-pdf"></i> <?php echo $doc['upload_files']['title'];?></h4>
                                                        </div>
                                                        <div class="float-md-right">
                                                            <a class="" href="<?php echo $doc['upload_files']['url']; ?>" target="_blank"><i class="fal fa-eye"></i> View</a>
                                                            <a class="" href="<?php echo $doc['upload_files']['url']; ?>" download><i class="fal fa-download"></i> Download</a>
                                                        </div>
                                                    </li>
                                            <?php endforeach;
                                        endif;?>
                                    </ul>
                                    </div>
                                </div>
                        <?php endwhile;?>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
