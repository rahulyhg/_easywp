<?php

if ( ! class_exists( 'EasyWP_Filters' ) ) {
	/**
	 * Container for custom needed filters
	 *
	 * Eventually, some of the functionality here could be replaced by core features.
	 * Class EasyWP_Filters
	 *
	 * @package _easywp
	 */
	class EasyWP_Filters {
		use Think_Singleton;

		/**
		 * Flush out the transients used in _easywp_categorized_blog.
		 */
		public function category_transient_flusher() {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			// Like, beat it. Dig?
			delete_transient( '_easywp_categories' );
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			return $classes;
		}

		/**
		 * Add a pingback url auto-discovery header for singularly identifiable articles.
		 */
		public function pingback_header() {
			if ( is_singular() && pings_open() ) {
				echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
			}
		}
	}
}