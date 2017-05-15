<?php
/**
 * _easywp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _easywp
 */
define( 'TEMPLATEURI', get_template_directory_uri() );
define( 'EASY_WP_VERSION', '1.0.0' );
define( 'ASSETS_URI', TEMPLATEURI . '/public' );
define( 'ADMIN_AJAX', admin_url( 'admin-ajax.php' ) );
define( 'ENV', 'development' );

/* Include Kernel Classes*/
require_once TEMPLATEPATH . '/inc/kernel/EasyWP_Theme.php';
require_once TEMPLATEPATH . '/inc/kernel/EasyWP_Assets_Manager.php';
require_once TEMPLATEPATH . '/inc/kernel/EasyWP_Filters.php';

$_easywp = EasyWP_Theme::get_instance();
add_action( 'after_setup_theme', array( $_easywp, 'setup' ) );
add_action( 'after_setup_theme', array( $_easywp, 'content_width' ), 0 );
add_action( 'after_setup_theme', array( $_easywp, 'init_deps' ) );

/** Implement the Custom Header feature */
add_action( 'after_setup_theme', array( $_easywp, 'custom_header_setup' ) );

/** Implement widgets support */
add_action( 'widgets_init', array( $_easywp, 'widgets_init' ) );

/**
 * Jetpack Compatibility
 *
 * @link https://jetpack.com/
 *
 * @package _easywp
 */
add_action( 'after_setup_theme', array( $_easywp, 'jetpack_capabilities_setup' ) );

/**
 * _s Customizer init
 *
 * @link http://underscores.me
 *
 * @package _easywp
 */
add_action( 'customize_register', array( $_easywp, '_s_customize_register' ) );
add_action( 'customize_preview_init', array( $_easywp, '_s_customize_preview_js' ) );

$_easywp_assets_manger = EasyWP_Assets_Manager::get_instance();
add_action( 'wp_enqueue_scripts', array( $_easywp_assets_manger, 'add_' . ENV . '_assets' ) );
add_action( 'admin_enqueue_scripts', array( $_easywp_assets_manger, 'add_' . ENV . '_assets_for_admin_panel' ) );

$_easywp_filter = EasyWP_Filters::get_instance();
add_action( 'edit_category', array( $_easywp_filter, 'category_transient_flusher' ) );
add_action( 'save_post', array( $_easywp_filter, 'category_transient_flusher' ) );
add_filter( 'body_class', array( $_easywp_filter, 'body_classes' ) );
add_action( 'wp_head', array( $_easywp_filter, 'pingback_header' ) );