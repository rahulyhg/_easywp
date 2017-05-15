<?php

//Include theme helpers
include TEMPLATEPATH . '/inc/support/EasyWP_Custom_Header.php';
include TEMPLATEPATH . '/inc/support/EasyWP_Jetpack_Integrations.php';
include TEMPLATEPATH . '/inc/support/EasyWP_Template_Tags.php';

//Include think-framework
require_once TEMPLATEPATH . '/wp-think-framework-1.0.1/wp-think-framework.php';

if ( ! class_exists( 'EasyWP_Theme' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Class EasyWP_Theme
	 */
	class EasyWP_Theme {
		use Think_Singleton;

		/** Installer */
		public function setup() {
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on _easywp, use a find and replace
			 * to change '_easywp' to the name of your theme in all the template files.
			 */
			load_theme_textdomain( '_easywp', get_template_directory() . '/languages' );

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
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'primary' => esc_html__( 'Primary', '_easywp' ),
			) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( '_easywp_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );
		}

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		public function content_width() {
			$GLOBALS['content_width'] = apply_filters( '_easywp_content_width', 640 );
		}

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function widgets_init() {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar', '_easywp' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', '_easywp' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}

		/** Integrate TGM Activation plugin functionality */
		public function init_deps() {
			require_once TEMPLATEPATH . '/inc/libs/deps-manager-TGM/after-setup-install-plugins.php';
		}

		/**
		 * Set up the WordPress core custom header feature.
		 *
		 * Sample implementation of the Custom Header feature
		 *
		 * You can add an optional custom header image to header.php like so ...
		 *
		 * <?php the_header_image_tag(); ?>
		 *
		 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
		 *
		 * @uses EasyWP_Custom_Header::header_style()
		 *
		 * @package _easywp
		 */
		public function custom_header_setup() {
			add_theme_support( 'custom-header', apply_filters( '_easywp_custom_header_args', array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => function () {
					EasyWP_Custom_Header::render_header_style();
				},
			) ) );
		}

		/**
		 * Jetpack setup function.
		 *
		 * See: https://jetpack.com/support/infinite-scroll/
		 * See: https://jetpack.com/support/responsive-videos/
		 */
		public function jetpack_capabilities_setup() {
			// Add theme support for Infinite Scroll.
			add_theme_support( 'infinite-scroll', array(
				'container' => 'main',
				'render'    => function () {
					EasyWP_Jetpack_Integrations::render_jetpack_infinite_scroll();
				},
				'footer'    => 'page',
			) );

			// Add theme support for Responsive Videos.
			add_theme_support( 'jetpack-responsive-videos' );
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function _s_customize_register( $wp_customize ) {
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		public function _s_customize_preview_js() {
			wp_enqueue_script( '_s_customizer', ASSETS_URI . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
		}
	}
}