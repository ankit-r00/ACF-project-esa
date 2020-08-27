<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EsaWeb
 */

?>
</div><!-- #content -->

<footer id="colophon" class="site-footer">



<!--	--><?php //if (!is_user_logged_in() && !isset( $_COOKIE['popup'] )):     // check cookie?>
<!--      <div class="modal-container">-->
<!--          <div class="esa-pop_up rounded ">-->
<!--              <div class="modal-wrapper w-100 h-100 d-flex justify-content-center align-items-center ">-->
<!---->
<!--                  <div class="esa-modal-container position-relative">-->
<!--                      <div class="modal-close d-flex justify-content-center align-items-center">-->
<!--                          <div class="p-1 text-right ">-->
<!--                              <button type="button " class="close-btn float-none text-dark"> <span-->
<!--                                          aria-hidden="true ">&times;</span> </button>-->
<!--                          </div>-->
<!--                      </div>-->
<!--                      <div class="modal-header justify-content-center p-0 w-100 border-0 ">-->
<!--                          <div class="modal-heading text-center  "> --><?php //the_field('popup_heading', 'options'); ?><!-- </div>-->
<!--                      </div>-->
<!--                      <div class="modal-body ">-->
<!--                          <div class="option text-center ">-->
<!--                              <ul class="pl-0 ">-->
<!--                                  <li class="options mb-2 ">-->
<!--                                      <a class="btn " href="https://members.esaweb.org ">-->
<!--                                          <span class="d-block ">Yes</span>-->
<!--                                          <em>Log into MyESA</em>-->
<!--                                      </a>-->
<!--                                  </li>-->
<!--                                  <li class="options mb-2 ">-->
<!--                                      <a class="btn " href="http://esaweb.org/Membership ">-->
<!--                                          <span class="d-block ">No</span>-->
<!--                                          <em>Learn More about Membership</em>-->
<!--                                      </a>-->
<!--                                  </li>-->
<!--                                  <li class="options mb-2 ">-->
<!--                                      <a class="btn " href="https://www.alarm.org/esa-member-search/ " target="_blank ">-->
<!--                                          <span class="d-block ">Unsure</span>-->
<!--                                          <em> Find ESA Members in My Area </em>-->
<!--                                      </a>-->
<!--                                  </li>-->
<!--                              </ul>-->
<!--                          </div>-->
<!--                      </div>-->
<!--                  </div>-->
<!--              </div>-->
<!--          </div>-->
<!--      </div>-->
<!--	--><?php //endif; ?>
    <div class="container">
        <div class="row top-footer" data-aos="fade-up">
            <div class="col-md-4">
                <!-- About Us will come here -->
                <h3><?php echo esc_html__('About Us');?></h3>
                <figure>
									<?php echo wp_get_attachment_image(get_field('image', 'options'), 'full'); ?>
                </figure>
							<?php echo the_field('about_us_content', 'options'); ?>

            </div>

            <div class="col-md-4">
                <!-- Site Links will come here -->
                <h3><?php echo esc_html__('Site Links');?></h3>
							<?php
							wp_nav_menu(
									array(
											'menu' => 'Main Nav',
											'depth' => 1
									)
							);
							?>
            </div>

            <div class="col-md-4">
                <!-- Contact Info will come here -->
                <h3><?php echo esc_html__('Contact Info');?></h3>
							<?php echo the_field('info_content', 'options'); ?>
                <ul class="pl-o esa-address">
									<?php
									$location_details = get_field('location_details', 'options');
									$contact_nos      = get_field('contact_no', 'options');

									foreach ($location_details as $location_detail) :
										echo '<li><span class="fas fa-map-marker-alt"></span> ' . $location_detail['address:'] . '</li>';
									endforeach;

									foreach ($contact_nos as $contact_no) :
										$tollfree = '';
										if ($contact_no['phone_type'] == 'tollfree') {
											$tollfree = ' (tollfree)';
										}
										echo '<li><span class="fas fa-phone"></span> <a href="tel:' . preg_replace("/[^0-9,.]/", "", $contact_no['phone_no']) . '">' . $contact_no['phone_no'] . $tollfree .  '</a></li>';
									endforeach;

									echo '<li><span class="fas fa-envelope"></span> <a href="mailto:' . get_field('email', 'options') . '">' . get_field('email', 'options') . '</a></li>';

									?>
                </ul>
                <!-- Social Links come here -->
                <ul class="social-icons">
									<?php
									$social_icons = get_field('social_icons', 'options');

									foreach ($social_icons as $social_icon) :
										echo '<a href="'.$social_icon['social_media_link'].'" target="_blank"><span class="fab fa-'.$social_icon['social_media_type:'].'"></span></a>';
									endforeach;
									?>
                </ul>
            </div>
        </div>
        <div class="row bottom-footer" data-aos="fade-up">
            <div class="col-12">
                <!-- Footer copyright and Footer links will come here -->
							<?php
							wp_nav_menu(
									array(
											'items_wrap' => '<ul class="nav navbar navbar-left d-flex d-inline-flex" id="%1$s" class="%2$s"><li>' . esc_html__('&copy;') . ' '. date('Y') .' '.esc_html__('ESA') . '</li>%3$s</ul>',
											'menu'       => 'Footer Nav',
									)
							);
							?>
            </div>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->
<a href="#" class="scroll-top text-center"><i class="fal fa-arrow-up"></i></a>
<?php wp_footer(); ?>

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/4724400.js"></script>
<!-- End of HubSpot Embed Code -->
</body>

</html>