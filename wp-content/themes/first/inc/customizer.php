<?php
/**
 * First Theme Customizer
 *
 * @package First
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function first_customize_register( $wp_customize ) {

	class First_Read_Me extends WP_Customize_Control {
		public function render_content() {
			?>
			<div class="first-read-me">
				<p><?php esc_html_e( 'Thank you for using the First theme.', 'first' ); ?></p>
				<h3><?php esc_html_e( 'Documentation', 'first' ); ?></h3>
				<p class="first-read-me-text"><?php esc_html_e( 'For instructions on theme configuration, please see the documentation.', 'first' ); ?></p>
				<p class="first-read-me-link"><a href="<?php echo esc_url( __( 'http://themehaus.net/documents/first/', 'first' ) ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'first' ); ?></a></p>
				<h3><?php esc_html_e( 'Support', 'first' ); ?></h3>
				<p class="first-read-me-text"><?php esc_html_e( 'If there is something you don\'t understand even after reading the documentation, please use the support forum.', 'first' ); ?></p>
				<p class="first-read-me-link"><a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/first', 'first' ) ); ?>" target="_blank"><?php esc_html_e( 'Support Forum', 'first' ); ?></a></p>
				<h3><?php esc_html_e( 'Review', 'first' ); ?></h3>
				<p class="first-read-me-text"><?php esc_html_e( 'If you are satisfied with the theme, we would greatly appreciate if you would review it.', 'first' ); ?></p>
				<p class="first-read-me-link"><a href="<?php echo esc_url( __( 'https://wordpress.org/support/view/theme-reviews/first?filter=5', 'first' ) ); ?>" target="_blank"><?php esc_html_e( 'Review This Theme', 'first' ); ?></a></p>
			</div>
			<?php
		}
	}

	/* Adds textarea control
	   http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/ */
	class First_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	// Site Identity
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->add_setting( 'first_hide_blogdescription', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_hide_blogdescription', array(
		'label'    => __( 'Hide Tagline', 'first' ),
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
	) );

	// READ ME
	$wp_customize->add_section( 'first_read_me', array(
		'title'    => esc_html__( 'READ ME', 'first' ),
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'first_read_me_text', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( new First_Read_Me( $wp_customize, 'first_read_me_text', array(
		'section'  => 'first_read_me',
		'priority' => 1,
	) ) );

	// Fonts
	$wp_customize->add_section( 'first_fonts', array(
		'title'    => __( 'Fonts', 'first' ),
		'priority' => 30,
	) );
	$wp_customize->add_setting( 'first_headings_font_2', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_headings_font',
	) );
	$wp_customize->add_control( 'first_headings_font_2', array(
		'label'   => __( 'Headings Font', 'first' ),
		'section' => 'first_fonts',
		'type'    => 'select',
		'choices' => array(
			''                     => __( 'Default', 'first' ),
			'Source Sans Pro:600'  => 'Source Sans Pro',
			'PT Sans:400'          => 'PT Sans',
			'Roboto:500'           => 'Roboto',
			'Fira Sans:500'        => 'Fira Sans',
			'Roboto Condensed:400' => 'Roboto Condensed',
			'Source Serif Pro:600' => 'Source Serif Pro',
			'PT Serif:400'         => 'PT Serif',
			'Gentium Basic:700'    => 'Gentium Basic',
			'Alegreya:700'         => 'Alegreya',
			'Playfair Display:400' => 'Playfair Display',
			'Roboto Slab:400'      => 'Roboto Slab',
			'Ubuntu:400'           => 'Ubuntu',
		),
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_headings_font_size_2', array(
		'default'           => ( 'ja' == get_bloginfo( 'language' ) ) ? '80' : '100',
		'sanitize_callback' => 'first_sanitize_headings_font_size',
	) );
	$wp_customize->add_control( 'first_headings_font_size_2', array(
		'label'    => __( 'Headings Font Size (%)', 'first' ),
		'section'  => 'first_fonts',
		'type'     => 'text',
		'priority' => 12,
	));
	$wp_customize->add_setting( 'first_body_font_2', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_body_font',
	) );
	$wp_customize->add_control( 'first_body_font_2', array(
		'label'    => __( 'Body Font', 'first' ),
		'section'  => 'first_fonts',
		'type'     => 'select',
		'choices'  => array(
			''                                      => __( 'Default', 'first' ),
			'Source Sans Pro:400,400italic,600,700' => 'Source Sans Pro',
			'PT Sans:400,400italic,700'             => 'PT Sans',
			'Roboto:400,400italic,700'              => 'Roboto',
			'Fira Sans:400,400italic,700'           => 'Fira Sans',
			'Source Serif Pro:400,600,700'          => 'Source Serif Pro',
			'PT Serif:400,400italic,700'            => 'PT Serif',
			'Lora:400,400italic,700'                => 'Lora',
		),
		'priority' => 13,
	) );
	$wp_customize->add_setting( 'first_body_font_size_2', array(
		'default'           => ( 'ja' == get_bloginfo( 'language' ) ) ? '16' : '18',
		'sanitize_callback' => 'first_sanitize_body_font_size',
	) );
	$wp_customize->add_control( 'first_body_font_size_2', array(
		'label'    => __( 'Body Font Size (px)', 'first' ),
		'section'  => 'first_fonts',
		'type'     => 'text',
		'priority' => 14,
	) );

	// Colors
	$wp_customize->get_section( 'colors' )->description  = __( 'If you use Color Scheme, individual settings will be ignored.', 'first' );
	$wp_customize->get_section( 'colors' )->priority     = 35;
	$wp_customize->add_setting( 'first_menu_background_color' , array(
		'default'           => '#222222',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_menu_background_color', array(
		'label'    => __( 'Menu Background Color', 'first' ),
		'section'  => 'colors',
		'priority' => 11,
	) ) );
	$wp_customize->add_setting( 'first_footer_background_color' , array(
		'default'           => '#222222',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_footer_background_color', array(
		'label'    => __( 'Footer Background Color', 'first' ),
		'section'  => 'colors',
		'priority' => 12,
	) ) );
	$wp_customize->add_setting( 'first_link_color' , array(
		'default'           => '#3872b8',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_link_color', array(
		'label'    => __( 'Link Color', 'first' ),
		'section'  => 'colors',
		'priority' => 13,
	) ) );
	$wp_customize->add_setting( 'first_link_hover_color' , array(
		'default'           => '#5687c3',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_link_hover_color', array(
		'label'    => __( 'Link Hover Color', 'first' ),
		'section'  => 'colors',
		'priority' => 14,
	) ) );
	$wp_customize->add_setting( 'first_color_scheme', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_color_scheme',
	) );
	$wp_customize->add_control( 'first_color_scheme', array(
		'label'   => __( 'Color Scheme', 'first' ),
		'section' => 'colors',
		'type'    => 'select',
		'choices' => array(
			''                                => __( 'Default', 'first' ),
			'#465780,#2f333c,#4e6ab2,#668ae8' => 'Blue',
			'#803e3e,#3a3232,#914b4b,#c66767' => 'Red',
			'#697b4d,#30312d,#6c8c3c,#89b24a' => 'Green',
			'#775f3b,#393632,#91713d,#bc924f' => 'Brown',
			'#68506b,#342b35,#884693,#b45cc4' => 'Purple',
		),
		'priority' => 15,
	) );

	// Background
	$wp_customize->get_section( 'background_image' )->title        = __( 'Background', 'first' );
	$wp_customize->get_section( 'background_image' )->description  = __( 'If you have selected a wide layout in the Layout settings, the background color/image is not displayed.', 'first' );
	$wp_customize->get_section( 'background_image' )->priority     = 40;
	$wp_customize->get_control( 'background_color' )->section      = 'background_image';

	// Layout
	$wp_customize->add_section( 'first_layout', array(
		'title'    => __( 'Layout', 'first' ),
		'priority' => 45,
	) );
	$wp_customize->add_setting( 'first_layout', array(
		'default'           => 'boxed',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'first_sanitize_layout',
	) );
	$wp_customize->add_control( 'first_layout', array(
		'label'    => __( 'Layout', 'first' ),
		'section'  => 'first_layout',
		'type'     => 'select',
		'choices'  => array(
			'boxed' => __( 'Boxed', 'first' ),
			'wide'  => __( 'Wide',   'first' ),
		),
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_header_layout', array(
		'default'           => 'side',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'first_sanitize_header_layout',
	) );
	$wp_customize->add_control( 'first_header_layout', array(
		'label'    => __( 'Header Layout', 'first' ),
		'section'  => 'first_layout',
		'type'     => 'select',
		'choices'  => array(
			'side'   => __( 'Side', 'first' ),
			'center' => __( 'Center',   'first' ),
		),
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'first_footer_layout', array(
		'default'           => 'side',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'first_sanitize_footer_layout',
	) );
	$wp_customize->add_control( 'first_footer_layout', array(
		'label'    => __( 'Footer Layout', 'first' ),
		'section'  => 'first_layout',
		'type'     => 'select',
		'choices'  => array(
			'side'   => __( 'Side', 'first' ),
			'center' => __( 'Center',   'first' ),
		),
		'priority' => 13,
	) );
	$wp_customize->add_setting( 'first_disable_responsive', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_disable_responsive', array(
		'label'    => __( 'Disable Responsive', 'first' ),
		'section'  => 'first_layout',
		'type'     => 'checkbox',
		'priority' => 14,
	) );

	// Title
	$wp_customize->add_section( 'first_title', array(
		'title'    => __( 'Title', 'first' ),
		'priority' => 50,
	) );
	$wp_customize->add_setting( 'first_title_font', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_title_font',
	) );
	$wp_customize->add_control( 'first_title_font', array(
		'label'    => __( 'Font', 'first' ),
		'section'  => 'first_title',
		'type'     => 'select',
		'choices'  => array(
			''                 => __( 'Default', 'first' ),
			'Source Sans Pro'  => 'Source Sans Pro',
			'PT Sans'          => 'PT Sans (Normal/Bold)',
			'Roboto'           => 'Roboto',
			'Fira Sans'        => 'Fira Sans',
			'Lato'             => 'Lato',
			'Roboto Condensed' => 'Roboto Condensed',
			'Source Serif Pro' => 'Source Serif Pro (Normal/Bold)',
			'PT Serif'         => 'PT Serif (Normal/Bold)',
			'Gentium Basic'    => 'Gentium Basic (Normal/Bold)',
			'Alegreya'         => 'Alegreya (Normal/Bold)',
			'Playfair Display' => 'Playfair Display (Normal/Bold)',
			'Roboto Slab'      => 'Roboto Slab',
			'Ubuntu'           => 'Ubuntu',
			'Kaushan Script'   => 'Kaushan Script (Normal)',
		),
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_title_font_weight', array(
		'default'           => '700',
		'sanitize_callback' => 'first_sanitize_title_font_weight',
	) );
	$wp_customize->add_control( 'first_title_font_weight', array(
		'label'    => __( 'Font Weight', 'first' ),
		'section'  => 'first_title',
		'type'     => 'select',
		'choices'  => array(
			'700' => __( 'Bold', 'first' ),
			'400' => __( 'Normal', 'first' ),
			'300' => __( 'Light', 'first' ),
		),
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'first_title_font_size', array(
		'default'           => ( 'ja' == get_bloginfo( 'language' ) ) ? '32' : '40',
		'sanitize_callback' => 'first_sanitize_title_font_size',
	) );
	$wp_customize->add_control( 'first_title_font_size', array(
		'label'    => __( 'Font Size (px)', 'first' ),
		'section'  => 'first_title',
		'type'     => 'text',
		'priority' => 13,
	));
	$wp_customize->add_setting( 'first_title_font_color' , array(
		'default'           => '#111',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'first_title_font_color', array(
		'label'    => __( 'Font Color', 'first' ),
		'section'  => 'first_title',
		'priority' => 14,
	) ) );
	$wp_customize->add_setting( 'first_title_letter_spacing', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_title_letter_spacing', array(
		'label'    => __( 'Letter Spacing (px)', 'first' ),
		'section'  => 'first_title',
		'type'     => 'text',
		'priority' => 15,
	));
	$wp_customize->add_setting( 'first_title_margin_top', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_title_margin_top', array(
		'label'    => __( 'Margin Top (px)', 'first' ),
		'section'  => 'first_title',
		'type'     => 'text',
		'priority' => 16,
	));
	$wp_customize->add_setting( 'first_title_margin_bottom', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_title_margin_bottom', array(
		'label'    => __( 'Margin Bottom (px)', 'first' ),
		'section'  => 'first_title',
		'type'     => 'text',
		'priority' => 17,
	));
	$wp_customize->add_setting( 'first_title_uppercase', array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_title_uppercase', array(
		'label'    => __( 'All Uppercase', 'first' ),
		'section'  => 'first_title',
		'type'     => 'checkbox',
		'priority' => 18,
	) );

	// Logo
	$wp_customize->add_section( 'first_logo', array(
		'title'       => __( 'Logo', 'first' ),
		'description' => __( 'In order to use a retina logo image, you must have a version of your logo that is doubled in size.', 'first' ),
		'priority'    => 55,
	) );
	$wp_customize->add_setting( 'first_logo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(	$wp_customize, 'first_logo', array(
		'label'    => __( 'Upload Logo', 'first' ),
		'section'  => 'first_logo',
		'priority' => 11,
	) ) );
	$wp_customize->add_setting( 'first_replace_blogname', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_replace_blogname', array(
		'label'    => __( 'Replace Title', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'checkbox',
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'first_retina_logo', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_retina_logo', array(
		'label'    => __( 'Retina Ready', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'checkbox',
		'priority' => 13,
	) );
	$wp_customize->add_setting( 'first_add_border_radius', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_add_border_radius', array(
		'label'    => __( 'Add Border Radius', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'checkbox',
		'priority' => 14,
	) );
	$wp_customize->add_setting( 'first_logo_margin_top', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_logo_margin_top', array(
		'label'    => __( 'Margin Top (px)', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'text',
		'priority' => 15,
	));
	$wp_customize->add_setting( 'first_logo_margin_bottom', array(
		'default'           => '0',
		'sanitize_callback' => 'first_sanitize_margin',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'first_logo_margin_bottom', array(
		'label'    => __( 'Margin Bottom (px)', 'first' ),
		'section'  => 'first_logo',
		'type'     => 'text',
		'priority' => 16,
	));

	// Navigation
	$wp_customize->add_section( 'first_nav', array(
		'title'       => __( 'Navigation', 'first' ),
		'priority'    => 60,
	) );
	$wp_customize->add_setting( 'first_hide_navigation', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_hide_navigation', array(
		'label'    => __( 'Hide Navigation Bar', 'first' ),
		'section'  => 'first_nav',
		'type'     => 'checkbox',
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_hide_search', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_hide_search', array(
		'label'    => __( 'Hide Search', 'first' ),
		'section'  => 'first_nav',
		'type'     => 'checkbox',
		'priority' => 12,
	) );

	// Header Image
	$wp_customize->get_section( 'header_image' )->priority  = 70;

	// Post
	$wp_customize->add_section( 'first_post', array(
		'title'    => __( 'Post', 'first' ),
		'priority' => 80,
	) );
	$wp_customize->add_setting( 'first_content', array(
		'default'           => 'content',
		'sanitize_callback' => 'first_sanitize_content',
	) );
	$wp_customize->add_control( 'first_content', array(
		'label'    => __( 'Display', 'first' ),
		'section'  => 'first_post',
		'type'     => 'select',
		'choices'  => array(
			'summary' => __( 'Summary', 'first' ),
			'content' => __( 'Full text',   'first' ),
		),
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'first_hide_author', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_hide_author', array(
		'label'    => __( 'Hide Author', 'first' ),
		'section'  => 'first_post',
		'type'     => 'checkbox',
		'priority' => 12,
	) );
	$wp_customize->add_setting( 'first_hide_category', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_hide_category', array(
		'label'    => __( 'Hide Categories', 'first' ),
		'section'  => 'first_post',
		'type'     => 'checkbox',
		'priority' => 13,
	) );

	// Footer
	$wp_customize->add_section( 'first_footer', array(
		'title'       => __( 'Footer', 'first' ),
		'description' => __( 'Only the a and br HTML tags are allowed in the footer text.', 'first' ),
		'priority'    => 90,
	) );
	$wp_customize->add_setting( 'first_footer_text', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_text',
	) );
	$wp_customize->add_control( new First_Customize_Textarea_Control( $wp_customize, 'first_footer_text', array(
		'label'    => __( 'Footer Text', 'first' ),
		'section'  => 'first_footer',
		'priority' => 11,
	) ) );
	$wp_customize->add_setting( 'first_hide_credit', array(
		'default'           => '',
		'sanitize_callback' => 'first_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'first_hide_credit', array(
		'label'    => __( 'Hide Credit', 'first' ),
		'section'  => 'first_footer',
		'type'     => 'checkbox',
		'priority' => 12,
	) );

	// Custom CSS
	$wp_customize->add_section( 'first_custom_css', array(
		'title'       => __( 'Custom CSS', 'first' ),
		'description' => __( 'Set custom Google fonts like this: Open+Sans:300,300italic|Roboto:100,900', 'first' ),
		'priority'    => 95,
	) );
	$wp_customize->add_setting( 'first_custom_css', array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'first_sanitize_css',
	) );
	$wp_customize->add_control( new First_Customize_Textarea_Control( $wp_customize, 'first_custom_css', array(
		'label'    => __( 'Custom CSS', 'first' ),
		'section'  => 'first_custom_css',
		'priority' => 11,
	) ) );
	$wp_customize->add_setting( 'first_custom_google_fonts', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'first_custom_google_fonts', array(
		'label'    => __( 'Custom Google Fonts', 'first' ),
		'section'  => 'first_custom_css',
		'type'     => 'text',
		'priority' => 12,
	));
}
add_action( 'customize_register', 'first_customize_register' );

/**
 * Sanitize user inputs.
 */
function first_sanitize_checkbox( $value ) {
	if ( $value == 1 ) {
		return 1;
	} else {
		return '';
	}
}
function first_sanitize_margin( $value ) {
	if ( preg_match("/^-?[0-9]+$/", $value) ) {
		return $value;
	} else {
		return '0';
	}
}
function first_sanitize_headings_font( $value ) {
	$valid = array(
		'Source Sans Pro:600'  => 'Source Sans Pro',
		'PT Sans:400'          => 'PT Sans',
		'Roboto:500'           => 'Roboto',
		'Fira Sans:500'        => 'Fira Sans',
		'Roboto Condensed:400' => 'Roboto Condensed',
		'Source Serif Pro:600' => 'Source Serif Pro',
		'PT Serif:400'         => 'PT Serif',
		'Gentium Basic:700'    => 'Gentium Basic',
		'Alegreya:700'         => 'Alegreya',
		'Playfair Display:400' => 'Playfair Display',
		'Roboto Slab:400'      => 'Roboto Slab',
		'Ubuntu:400'           => 'Ubuntu',
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function first_sanitize_headings_font_size( $value ) {
	if ( preg_match("/^[1-9][0-9]*$/", $value) ) {
		return $value;
	} else {
		return ( 'ja' == get_bloginfo( 'language' ) ) ? '80' : '100';
	}
}
function first_sanitize_body_font( $value ) {
	$valid = array(
		'Source Sans Pro:400,400italic,600,700' => 'Source Sans Pro',
		'PT Sans:400,400italic,700'             => 'PT Sans',
		'Roboto:400,400italic,700'              => 'Roboto',
		'Fira Sans:400,400italic,700'           => 'Fira Sans',
		'Source Serif Pro:400,600,700'          => 'Source Serif Pro',
		'PT Serif:400,400italic,700'            => 'PT Serif',
		'Lora:400,400italic,700'                => 'Lora',
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function first_sanitize_body_font_size( $value ) {
	if ( preg_match("/^[1-9][0-9]*$/", $value) ) {
		return $value;
	} else {
		return ( 'ja' == get_bloginfo( 'language' ) ) ? '16' : '18';
	}
}
function first_sanitize_color_scheme( $value ) {
	$valid = array(
		'#465780,#2f333c,#4e6ab2,#668ae8' => 'Blue',
		'#803e3e,#3a3232,#914b4b,#c66767' => 'Red',
		'#697b4d,#30312d,#6c8c3c,#89b24a' => 'Green',
		'#775f3b,#393632,#91713d,#bc924f' => 'Brown',
		'#68506b,#342b35,#884693,#b45cc4' => 'Purple',
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function first_sanitize_layout( $value ) {
	$valid = array(
		'boxed' => __( 'Boxed', 'first' ),
		'wide'  => __( 'Wide',   'first' ),
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function first_sanitize_header_layout( $value ) {
	$valid = array(
		'side'   => __( 'Side', 'first' ),
		'center' => __( 'Center', 'first' ),
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function first_sanitize_footer_layout( $value ) {
	$valid = array(
		'side'   => __( 'Side', 'first' ),
		'center' => __( 'Center', 'first' ),
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function first_sanitize_title_font( $value ) {
	$valid = array(
		'Source Sans Pro'  => 'Source Sans Pro',
		'PT Sans'          => 'PT Sans (Normal/Bold)',
		'Roboto'           => 'Roboto',
		'Fira Sans'        => 'Fira Sans',
		'Lato'             => 'Lato',
		'Roboto Condensed' => 'Roboto Condensed',
		'Source Serif Pro' => 'Source Serif Pro (Normal/Bold)',
		'PT Serif'         => 'PT Serif (Normal/Bold)',
		'Gentium Basic'    => 'Gentium Basic (Normal/Bold)',
		'Alegreya'         => 'Alegreya (Normal/Bold)',
		'Playfair Display' => 'Playfair Display (Normal/Bold)',
		'Roboto Slab'      => 'Roboto Slab',
		'Ubuntu'           => 'Ubuntu',
		'Kaushan Script'   => 'Kaushan Script (Normal)',
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function first_sanitize_title_font_weight( $value ) {
	$valid = array(
		'700' => __( 'Bold', 'first' ),
		'400' => __( 'Normal', 'first' ),
		'300' => __( 'Light', 'first' ),
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function first_sanitize_title_font_size( $value ) {
	if ( preg_match("/^[1-9][0-9]*$/", $value) ) {
		return $value;
	} else {
		return ( 'ja' == get_bloginfo( 'language' ) ) ? '32' : '40';
	}
}
function first_sanitize_content( $value ) {
	$valid = array(
		'summary' => __( 'Summary', 'first' ),
		'content' => __( 'Full text',   'first' ),
	);

	if ( array_key_exists( $value, $valid ) ) {
		return $value;
	} else {
		return '';
	}
}
function first_sanitize_text( $value ) {
	$value = wp_kses( $value, array(
		'a'  => array(
			'href'   => array(),
			'target' => array(),
			'rel'    => array(),
		),
		'br' => array(),
	) );
	return $value;
}
function first_sanitize_css( $value ) {
	$value = wp_kses( $value, array( '\'', '\"' ) );
	$value = str_replace( '&gt;', '>', $value );
	return $value;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function first_customize_preview_js() {
	wp_enqueue_script( 'first_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140709', true );
}
add_action( 'customize_preview_init', 'first_customize_preview_js' );

/**
 * Enqueue Customizer CSS
 */
function first_customizer_style() {
	wp_enqueue_style( 'first-customizer-style', get_template_directory_uri() . '/css/customizer.css', array() );
}
add_action( 'customize_controls_print_styles', 'first_customizer_style');

/**
 * Enqueue Customizer JS
 */
function first_customizer_js() {
	wp_enqueue_script( 'first-customizer-js', get_template_directory_uri() . '/js/customizer-js.js', array( 'jquery' ), '20160924', true);
	wp_localize_script( 'first-customizer-js', 'first_customizer_links', array(
		'url' => esc_url( __( 'http://themehaus.net/', 'first' ) ),
		'label' => esc_html__( 'Browse Our Themes', 'first' ),
	));
}
add_action( 'customize_controls_enqueue_scripts', 'first_customizer_js' );
