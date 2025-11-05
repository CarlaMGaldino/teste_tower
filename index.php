<?php
/**
 * Template padrão de fallback.
 *
 * @package SiteTesteTower
 */

get_header();
?>

<div class="container content-area">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'entry' ); ?>>
				<header class="entry__header">
					<?php the_title( '<h2 class="entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
					<div class="entry__meta">
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>
						<span class="entry__author">
							<?php
							printf(
								/* translators: %s: author name */
								esc_html__( 'por %s', 'site-teste-tower' ),
								esc_html( get_the_author() )
							);
							?>
						</span>
					</div>
				</header>

				<div class="entry__excerpt">
					<?php the_excerpt(); ?>
				</div>

				<footer class="entry__footer">
					<a class="button button--link" href="<?php the_permalink(); ?>">
						<?php esc_html_e( 'Continuar lendo', 'site-teste-tower' ); ?>
					</a>
				</footer>
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
		?>
		<section class="no-results not-found">
			<header class="page-header">
				<h2 class="page-title"><?php esc_html_e( 'Nada encontrado', 'site-teste-tower' ); ?></h2>
			</header>
			<div class="page-content">
				<p><?php esc_html_e( 'Não encontramos conteúdos por aqui. Que tal tentar uma busca diferente?', 'site-teste-tower' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</section>
	<?php endif; ?>
</div>

<?php
get_footer();
