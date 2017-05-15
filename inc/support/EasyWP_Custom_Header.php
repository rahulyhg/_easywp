<?php

if ( ! class_exists( 'EasyWP_Custom_Header' ) ) {
	/**
	 * Helper for custom header integrations
	 *
	 * Class EasyWP_Custom_Header
	 */
	class EasyWP_Custom_Header {
		/**
		 * Styles the header image and text displayed on the blog.
		 *
		 * @see EasyWP_Theme::custom_header_setup().
		 */
		public static function render_header_style() {
			ob_start();

			$header_text_color = get_header_textcolor();

			/*
			 * If no custom options for text are set, let's bail.
			 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
			 */
			if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
				return;
			}

			// If we get this far, we have custom styles. Let's do this.
			?>
            <style type="text/css">
                <?php
					// Has the text been hidden?
					if ( ! display_header_text() ) :
				?>
                .site-title,
                .site-description {
                    position: absolute;
                    clip: rect(1px, 1px, 1px, 1px);
                }

                <?php
					// If the user has set a custom color for the text use that.
					else :
				?>
                .site-title a,
                .site-description {
                    color: #<?php echo esc_attr( $header_text_color ); ?>;
                }

                <?php endif; ?>
            </style>
			<?php

            $content = ob_end_clean();

            return $content;
		}
	}
}