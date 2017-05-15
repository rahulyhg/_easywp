<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _easywp
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', '_easywp' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', '_easywp' ), 'WordPress' ); ?></a>
        <span class="sep"> | </span>
        <span>Theme: </span><a href="https://github.com/alex-storojenko/" target="_blank" rel="developer"
                               title="go to github">Created
            by Alex Storozhenko</a>
        <span class="sep"> | </span>
        <span>Based on: </span><a href="https://automatic.com" target="_blank" rel="designer" title="automatic">_s
            or underscores by Automatic</a>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
