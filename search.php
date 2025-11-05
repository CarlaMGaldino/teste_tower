<?php
/**
 * Template para resultados de pesquisa.
 *
 * @package SiteTesteTower
 */

get_header();
?>

<div class="container content-area">
	<header class="page-header">
		<h1 class="page-title">
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'Resultados para: %s', 'site-teste-tower' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'entry entry--search' ); ?>>
				<header class="entry__header">
					<?php the_title( '<h2 class="entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
				</header>
				<div class="entry__excerpt">
					<?php the_excerpt(); ?>
				</div>
			</article>
			<?php
		endwhile;

		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => __( 'Anterior', 'site-teste-tower' ),
				'next_text' => __( 'Próximo', 'site-teste-tower' ),
			)
		);
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
</div>

<?php
get_footer();
