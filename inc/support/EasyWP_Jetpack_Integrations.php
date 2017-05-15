<?php

if ( ! class_exists( 'EasyWP_Jetpack_Integrations' ) ) {
	/**
	 * Helper for Jetpack itegrations
	 *
	 * Class EasyWP_Jetpack_Integrations
	 */
	class EasyWP_Jetpack_Integrations {
		/**
		 * Custom render function for Infinite Scroll.
		 */
		public static function render_jetpack_infinite_scroll() {
			ob_start();

			while ( have_posts() ) {
				the_post();
				if ( is_search() ) :
					get_template_part( 'template-parts/content', 'search' );
				else :
					get_template_part( 'template-parts/content', get_post_format() );
				endif;
			}

			$content = ob_end_clean();

			return $content;
		}
	}
}