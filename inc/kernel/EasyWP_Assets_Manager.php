<?php

if ( ! class_exists( 'EasyWP_Assets_Manager' ) ) {
	/**
	 * Enqueue scripts and styles
	 *
	 * Class EasyWP_Assets_Manager
	 */
	class EasyWP_Assets_Manager {
		use Think_Singleton;

		/** Enqueue production client scripts **/
		public function add_production_assets() {
			wp_enqueue_style( '_easywp-style', get_stylesheet_uri(), array(), EASY_WP_VERSION );
			wp_enqueue_script( '_easywp-navigation', ASSETS_URI . '/js/navigation.js', array(), EASY_WP_VERSION, true );
			wp_enqueue_script( '_easywp-skip-link-focus-fix', ASSETS_URI . '/js/skip-link-focus-fix.js', array(), EASY_WP_VERSION, true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/** Enqueue development client assets **/
		public function add_development_assets() {
			wp_enqueue_style( '_easywp-style', get_stylesheet_uri(), array(), EASY_WP_VERSION );
			wp_enqueue_script( '_easywp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), EASY_WP_VERSION, true );
			wp_enqueue_script( '_easywp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), EASY_WP_VERSION, true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/** Enqueue production admin assets **/
		public function add_production_assets_for_admin_panel() {
		}

		/** Enqueue development client assets **/
		public function add_development_assets_for_admin_panel() {
		}
	}
}