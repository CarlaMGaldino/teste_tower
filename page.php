<?php
/**
 * Template de páginas padrão.
 *
 * @package SiteTesteTower
 */

get_header();
?>

<div class="container content-area">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'entry entry--page' ); ?>>
			<header class="entry__header">
				<?php the_title( '<h1 class="entry__title">', '</h1>' ); ?>
			</header>

			<div class="entry__content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'site-teste-tower' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</article>

		<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>
</div>

<?php
get_footer();
