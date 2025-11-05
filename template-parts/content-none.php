<?php
/**
 * Template exibido quando nenhum conteúdo é encontrado.
 *
 * @package SiteTesteTower
 */

?>
<section class="no-results not-found">
	<header class="page-header">
		<h2 class="page-title"><?php esc_html_e( 'Nada encontrado', 'site-teste-tower' ); ?></h2>
	</header>

	<div class="page-content">
		<p><?php esc_html_e( 'Tente buscar novamente com termos diferentes ou volte para a página inicial.', 'site-teste-tower' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</section>
