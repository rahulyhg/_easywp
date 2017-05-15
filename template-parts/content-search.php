<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _easywp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
				<?php EasyWP_Template_Tags::posted_on(); ?>
            </div><!-- .entry-meta -->
		<?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-summary">
		<?php the_excerpt(); ?>
    </div><!-- .entry-summary -->

    <footer class="entry-footer">
		<?php EasyWP_Template_Tags::entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->