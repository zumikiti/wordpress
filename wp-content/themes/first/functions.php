<?php
/**
 * First functions and definitions
 *
 * @package First
 */

if ( ! function_exists( 'first_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function first_setup() {

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 644;
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on First, use a find and replace
	 * to change 'first' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'first', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 644 );
	add_image_size( 'first-page-thumbnail', 1220, 480, true );
	update_option( 'large_size_w', 644 );
	update_option( 'large_size_h', 0 );

	// This theme uses wp_nav_menu() in two location.
	register_nav_menus( array(
		'primary' => __( 'Navigation Bar', 'first' ),
		'header' => __( 'Header Menu', 'first' ),
		'footer' => __( 'Footer Menu', 'first' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// Setup the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'first_custom_header_args', array(
		'default-image' => '',
		'width'         => 1220,
		'height'        => 480,
		'flex-height'   => false,
		'header-text'   => false,
	) ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'first_custom_background_args', array(
		'default-color' => '#f5f4f2',
		'default-image' => '',
	) ) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/normalize.css', 'style.css', 'css/editor-style.css', str_replace( ',', '%2C', first_fonts_url() ) ) );
}
endif; // first_setup
add_action( 'after_setup_theme', 'first_setup' );

/**
 * Adjust content_width value for full width template.
 */
function first_content_width() {
	if ( is_page_template( 'page_fullwidth.php' ) ) {
		global $content_width;
		$content_width = 1000;
	}
}
add_action( 'template_redirect', 'first_content_width' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function first_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'first' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Sidebar. If none, layout would be one-column.', 'first' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'first' ),
		'id'            => 'footer-1',
		'description'   => __( 'From left to right there are 3 sequential footer widget areas, and the width is auto-adjusted based on how many you use. If you do not use a footer widget, nothing will be displayed.', 'first' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'first' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'first' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'first_widgets_init' );

/**
 * Register Google Fonts.
 *
 * This function is based on code from Twenty Thirteen.
 * http://wordpress.org/themes/twentythirteen
 */
function first_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Source Sans Pro, translate this to 'off'. Do not translate into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'first' );
	$title_font = get_theme_mod( 'first_title_font' );
	$headings_font = get_theme_mod( 'first_headings_font_2' );
	$body_font = get_theme_mod( 'first_body_font_2' );
	$custom_fonts = get_theme_mod( 'first_custom_google_fonts' );

	if ( 'off' !== $source_sans_pro || $title_font || $headings_font || $body_font || $custom_fonts ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro && ! ( $title_font && $headings_font && $body_font ) ) {
			$font_families[] = 'Source Sans Pro:400,400italic,600,700';
		}

		if ( $title_font ) {
			$title_font_weight = ( get_theme_mod( 'first_title_font_weight' ) ) ? get_theme_mod( 'first_title_font_weight' ) : '700';
			$font_families[] = first_exist_font( $title_font , $title_font_weight );
		}

		if ( $headings_font ) {
			$font_families[] = $headings_font;
		}

		if ( $body_font ) {
			$font_families[] = $body_font;
		}

		if ( $custom_fonts ) {
			$font_families[] = str_replace( '+', ' ', $custom_fonts );
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "https://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Return exist Google Font weight.
 */
function first_exist_font( $font, $font_weight ) {
	$font_family[] = $font . ":" . $font_weight;
	$font_family[] = $font;
	$google_font_url = 'https://fonts.googleapis.com/css?family=';

	foreach ( $font_family as $value ) {
		$font_family_encoded = urlencode( $value );
		$response = wp_remote_head( $google_font_url . $font_family_encoded );
		if ( '200' == wp_remote_retrieve_response_code( $response ) ) {
			return $value;
			exit;
		}
	}

	return '';
}

/**
 * Enqueue scripts and styles.
 */
function first_scripts() {
	wp_enqueue_style( 'first-font', first_fonts_url(), array(), null );
	wp_enqueue_style( 'first-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3' );
	wp_enqueue_style( 'first-normalize', get_template_directory_uri() . '/css/normalize.css',  array(), '3.0.2' );
	wp_enqueue_style( 'first-style', get_stylesheet_uri(), array(), '2.0.4' );
	wp_enqueue_style( 'first-non-responsive', get_template_directory_uri() . '/css/non-responsive.css', array(), null );
	if ( ! get_theme_mod( 'first_disable_responsive' ) ) {
		wp_style_add_data( 'first-non-responsive', 'conditional', 'IE 8' );
	}
	if ( 'ja' == get_bloginfo( 'language' ) ) {
		wp_enqueue_style( 'first-style-ja', get_template_directory_uri() . '/css/ja.css', array(), null );
	}

	wp_enqueue_script( 'first-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20140707', true );
	wp_enqueue_script( 'first-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'first_scripts' );

/**
 * Add customizer style to the header.
 */
function first_customizer_css() {
	?>
	<style type="text/css">
		/* Fonts */
		<?php if ( $first_headings_font_size = get_theme_mod( 'first_headings_font_size_2' ) ) : ?>
		html {
			font-size: <?php echo $first_headings_font_size; ?>%;
		}
		<?php endif; ?>
		body {
			<?php if ( $first_body_font = get_theme_mod( 'first_body_font_2' ) ) : 
				list( $body_font_family ) = explode( ":", $first_body_font );
			?>
			font-family: '<?php echo $body_font_family; ?>';
			<?php endif; ?>
			<?php if ( $first_body_font_size = get_theme_mod( 'first_body_font_size_2' ) ) : ?>
			font-size: <?php echo $first_body_font_size; ?>px;
			<?php endif; ?>
		}
		<?php if ( ! get_theme_mod( 'first_disable_responsive' ) ) : ?>
		@media screen and (max-width: 782px) {
			<?php if ( $first_headings_font_size ) : ?>
			html {
				font-size: <?php echo $first_headings_font_size * 0.9; ?>%;
			}
			<?php endif; ?>
			<?php if ( $first_body_font_size ) : ?>
			body {
				font-size: <?php echo round ( $first_body_font_size * 0.94, 1 ); ?>px;
			}
			<?php endif; ?>
		}
		<?php endif; ?>
		<?php if ( $first_headings_font = get_theme_mod( 'first_headings_font_2' ) ) : 
			list( $headings_font_family, $font_weight ) = explode( ":", $first_headings_font );
		?>
			h1, h2, h3, h4, h5, h6 {
				font-family: '<?php echo $headings_font_family; ?>';
				font-weight: <?php echo $font_weight; ?>;
			}
		<?php endif; ?>

		/* Colors */
		<?php if ( $first_color_scheme = get_theme_mod( 'first_color_scheme' ) ) : 
			$colors = explode( ",", $first_color_scheme );
		?>
			.site-bar, .main-navigation ul ul {
				background-color: <?php echo $colors[0]; ?>;
			}
			.footer-area {
				background-color: <?php echo $colors[1]; ?>;
			}
			.entry-content a, .entry-summary a, .page-content a, .comment-content a, .post-navigation a {
				color: <?php echo $colors[2]; ?>;
			}
			a:hover {
				color: <?php echo $colors[3]; ?>;
			}
		<?php else: ?>
			<?php if ( $first_menu_background_color = get_theme_mod( 'first_menu_background_color' ) ) : ?>
			.site-bar, .main-navigation ul ul {
				background-color: <?php echo $first_menu_background_color; ?>;
			}
			<?php endif; ?>
			<?php if ( $first_footer_background_color = get_theme_mod( 'first_footer_background_color' ) ) : ?>
			.footer-area {
				background-color: <?php echo $first_footer_background_color; ?>;
			}
			<?php endif; ?>
			<?php if ( $first_link_color = get_theme_mod( 'first_link_color' ) ) : ?>
			.entry-content a, .entry-summary a, .page-content a, .comment-content a, .post-navigation a {
				color: <?php echo $first_link_color; ?>;
			}
			<?php endif; ?>
			<?php if ( $first_link_hover_color = get_theme_mod( 'first_link_hover_color' ) ) : ?>
			a:hover {
				color: <?php echo $first_link_hover_color; ?>;
			}
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( ! ( get_theme_mod( 'first_logo' ) && get_theme_mod( 'first_replace_blogname' ) ) ) :?>
		/* Title */
			.site-title {
				<?php if ( $first_title_font = get_theme_mod( 'first_title_font' ) ) : ?>
				font-family: '<?php echo $first_title_font; ?>', sans-serif;
				<?php endif; ?>
				<?php if ( $first_title_font_weight = get_theme_mod( 'first_title_font_weight' ) ) : ?>
				font-weight: <?php echo $first_title_font_weight; ?>;
				<?php endif; ?>
				<?php if ( $first_title_font_size = get_theme_mod( 'first_title_font_size' ) ) : ?>
				font-size: <?php echo $first_title_font_size; ?>px;
				<?php endif; ?>
				<?php if ( $first_title_letter_spacing = get_theme_mod( 'first_title_letter_spacing' ) ) : ?>
				letter-spacing: <?php echo $first_title_letter_spacing; ?>px;
				<?php endif; ?>
				<?php if ( $first_title_margin_top = get_theme_mod( 'first_title_margin_top' ) ) : ?>
				margin-top: <?php echo $first_title_margin_top; ?>px;
				<?php endif; ?>
				<?php if ( $first_title_margin_bottom = get_theme_mod( 'first_title_margin_bottom' ) ) : ?>
				margin-bottom: <?php echo $first_title_margin_bottom; ?>px;
				<?php endif; ?>
				<?php if ( get_theme_mod( 'first_title_uppercase' ) ) : ?>
				text-transform: uppercase;
				<?php endif; ?>
			}
			<?php if ( $first_title_font_color = get_theme_mod( 'first_title_font_color' ) ) : ?>
			.site-title a, .site-title a:hover {
				color: <?php echo $first_title_font_color; ?>;
			}
			<?php endif; ?>
			<?php if ( ! get_theme_mod( 'first_disable_responsive' ) && $first_title_font_size ) : ?>
			@media screen and (max-width: 782px) {
				.site-title {
					font-size: <?php echo $first_title_font_size * 0.9; ?>px;
				}
			}
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'first_logo' ) ) : ?>
		/* Logo */
			.site-logo {
				<?php if ( $first_logo_margin_top = get_theme_mod( 'first_logo_margin_top' ) ) : ?>
				margin-top: <?php echo $first_logo_margin_top; ?>px;
				<?php endif; ?>
				<?php if ( $first_logo_margin_bottom = get_theme_mod( 'first_logo_margin_bottom' ) ) : ?>
				margin-bottom: <?php echo $first_logo_margin_bottom; ?>px;
				<?php endif; ?>
			}
			<?php if ( get_theme_mod( 'first_add_border_radius' ) ) : ?>
				.site-logo img {
					border-radius: 50%;
				}
			<?php endif; ?>
		<?php endif; ?>
	</style>
	<?php
}
add_action( 'wp_head', 'first_customizer_css' );

/**
 * Add custom style to the header.
 */
function first_custom_css() {
	?>
	<style type="text/css" id="first-custom-css">
		<?php echo get_theme_mod( 'first_custom_css' ); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'first_custom_css' );

/**
 * Add custom classes to the body.
 */
function first_body_classes( $classes ) {
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( get_option( 'show_avatars' ) ) {
		$classes[] = 'has-avatars';
	}

	if ( 'wide' !== get_theme_mod( 'first_layout' ) ) {
		$classes[] = 'boxed';
	}

	if ( 'center' !== get_theme_mod( 'first_header_layout' ) ) {
		$classes[] = 'header-side';
	}
	if ( 'center' !== get_theme_mod( 'first_footer_layout' ) ) {
		$classes[] = 'footer-side';
	}

	$footer_widgets = 0;
	$footer_widgets_max = 3;
	for( $i = 1; $i <= $footer_widgets_max; $i++ ) {
		if ( is_active_sidebar( 'footer-' . $i ) ) {
				$footer_widgets++;
		}
	}
	$classes[] = 'footer-' . $footer_widgets;

	return $classes;
}
add_filter( 'body_class', 'first_body_classes' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
