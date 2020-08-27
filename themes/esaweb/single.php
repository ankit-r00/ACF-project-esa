/////// WP Bakery custom dive store card element//////
class WPBakeryShortCode_Dive_Card extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "style"             => 'style1',
            "name"              => 'Marry Dols',
            "description"             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.',
            "content"          => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.',
            "link"          => 'Add explore link',
            "image"             => '',
            "social_links"      => "",
            "extra_class"       => ""
        ), $atts ) );

        $image = wp_get_attachment_image($image, 'letstravel-480-480', false, array('class'=>'img-responsive'));

        $socials_links = vc_param_group_parse_atts( $atts['social_links'] );
        $socials = '';


        foreach ($socials_links as $innerArray) {
            $social_icon = $innerArray['social_icon'];
            $social_name = $innerArray['social_name'];
            $social_link = $innerArray['social_link'];

            $socials .= "<a href='". esc_url($social_link) ."' class='". esc_attr($social_icon) ."'></a>";
        }
        $name_id = 'team'.mt_rand(10,100);
        $result = "<div class='dive-vc-element team-entry $extra_class'>
                        <div class='dive-image'>
                          <a href='#' class='' data-toggle='modal' data-target='#$name_id'>
                          $image  </a>
                        <div class='dive-team modal' id='$name_id' role='dialog'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                </div>
                                <div class='modal-body'>
                                    <h3 class='dive-team-name color-dark-2'>$name</h3>
                                    <p class='color-dark-2-light'>$content</p>
                                    <div class='social-links'>
                                    $socials
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                        <h3 class='dive-team-name color-dark-2'>$name</h3>
                        <h5 class='dive-team-position color-dark-2-light'>$description</h5>
                        <a href='$link' class='btn'>Explore</a>
                    </div>
                    ";


        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Dive Card", 'Weaver'),
    "description" => "Cards with lightbox",
    "base" => "dive_cards",
    "class" => "",
    "icon" => "icon-wpb-quickload",
    "category" => esc_html__('Lets Travel', 'letstravel'),
    "show_settings_on_create" => true,
    "params" => array(
        array(
            'type' => 'textfield',
            "param_name" => "name",
            "heading" => esc_html__("Name", 'letstravel'),
            "value" => 'Marry Dols',
            "holder" => 'div'
        ),
        array(
            'type' => 'textarea',
            "param_name" => "description",
            "heading" => esc_html__("Description", 'letstravel'),
            "value" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.'
        ),
        array(
            'type' => 'textarea',
            "param_name" => "content",
            "heading" => esc_html__("Content", 'letstravel'),
            "value" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.'
        ),
        array(
            'type' => 'textfield',
            "param_name" => "link",
            "heading" => esc_html__("Link", 'letstravel'),
            "value" => '#',
            "holder" => 'div'
        ),
        array(
            'type' => 'attach_image',
            "param_name" => "image",
            "heading" => esc_html__("Image", 'letstravel'),
            "value" => ''
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Social Links', 'letstravel'),
            'param_name' => 'social_links',
            'value' => '',
            'params' => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__('Social Icon', 'letstravel'),
                    'param_name' => 'social_icon',
                    'settings' => array(
                        'emptyIcon' => false,
                        'iconsPerPage' => 4000
                    ),
                    'description' => esc_html__('Choose icon:', 'letstravel')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Social name', 'letstravel'),
                    'param_name' => 'social_name',
                    'description' => esc_html__('Social name.', 'letstravel'),
                    'admin_label' => true
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Social link', 'letstravel'),
                    'param_name' => 'social_link',
                    'description' => esc_html__('Social link.', 'letstravel')
                ),
            )
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'letstravel'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'letstravel'),
        )
    )
) );
/////// WP Bakery custom dive Cards element//////
///////End///////