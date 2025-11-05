<?php
/**
 * Template para posts individuais.
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
		<article <?php post_class( 'entry entry--single' ); ?>>
			<header class="entry__header">
				<?php the_title( '<h1 class="entry__title">', '</h1>' ); ?>
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
					<?php
					$categories_list = get_the_category_list( ', ' );

					if ( $categories_list ) :
						?>
						<span class="entry__categories">
							<?php
							printf(
								/* translators: %s: categories list */
								esc_html__( 'em %s', 'site-teste-tower' ),
								wp_kses_post( $categories_list )
							);
							?>
						</span>
					<?php endif; ?>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry__media">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
			<?php endif; ?>

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

			<footer class="entry__footer">
				<?php the_tags( '<p class="entry__tags">' . esc_html__( 'Tags: ', 'site-teste-tower' ), ', ', '</p>' ); ?>
			</footer>
		</article>

		<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Navegação de posts', 'site-teste-tower' ); ?>">
			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Anterior', 'site-teste-tower' ) . '</span><span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Próximo', 'site-teste-tower' ) . '</span><span class="nav-title">%title</span>',
				)
			);
			?>
		</nav>

		<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;
	?>
</div>

<?php
get_footer();
