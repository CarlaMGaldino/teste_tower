<?php
/**
 * Template para páginas 404.
 *
 * @package SiteTesteTower
 */

get_header();
?>

<div class="container content-area content-area--narrow">
	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Página não encontrada', 'site-teste-tower' ); ?></h1>
		</header>

		<div class="page-content">
			<p><?php esc_html_e( 'A página que você procura pode ter sido removida ou nunca existiu.', 'site-teste-tower' ); ?></p>
			<p>
				<a class="button button--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php esc_html_e( 'Voltar para a página inicial', 'site-teste-tower' ); ?>
				</a>
			</p>
			<?php get_search_form(); ?>
		</div>
	</section>
</div>

<?php
get_footer();
