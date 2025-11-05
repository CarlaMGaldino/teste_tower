<?php
/**
 * Rodapé do tema.
 *
 * @package SiteTesteTower
 */

?>
</main><!-- #primary -->

<?php
$footer_background_url = '';

if ( function_exists( 'site_teste_tower_get_footer_background_image_url' ) ) {
	$footer_background_url = site_teste_tower_get_footer_background_image_url();
}

$footer_style_attr = $footer_background_url ? sprintf( ' style="background-image: url(\'%s\');"', esc_url( $footer_background_url ) ) : '';
?>

<footer class="site-footer"
    <?php echo $footer_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
    <div class="container">

        <div class="site-footer__inner">
            <div class="site-footer__branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__home-link">
                    <?php
				$footer_logo_id = get_theme_mod( 'custom_logo' );

				if ( $footer_logo_id ) {
					echo wp_get_attachment_image(
						$footer_logo_id,
						'full',
						false,
						array(
							'class'   => 'site-footer__logo',
							'loading' => 'lazy',
						)
					);
				} else {
					bloginfo( 'name' );
				}
				?>
                </a>

            </div>
            <div class="site-footer__description">
                <?php
				if ( function_exists( 'get_field' ) ) {
					$footer_description = get_field( 'text_description_footer', 'option' );

					if ( $footer_description ) {
						echo wp_kses_post( $footer_description );
					} else {
						bloginfo( 'description' );
					}
				} else {
					bloginfo( 'description' );
				}
				?>
            </div>

        </div>
    </div>


    <div class="site-footer__info">
        <div class="container">
            <div class="copy-footer">
                <?php
				if ( function_exists( 'get_field' ) ) {
					$dev_logo = get_field( 'image_footer_dev', 'option' );

					if ( is_array( $dev_logo ) && ! empty( $dev_logo['url'] ) ) {
						$dev_logo_url = $dev_logo['url'];
						$dev_logo_alt = isset( $dev_logo['alt'] ) && $dev_logo['alt'] ? $dev_logo['alt'] : __( 'Logo do desenvolvedor', 'site-teste-tower' );

						printf(
							'<img src="%1$s" alt="%2$s" class="site-footer__dev-logo" loading="lazy" />',
							esc_url( $dev_logo_url ),
							esc_attr( $dev_logo_alt )
						);
					} elseif ( is_string( $dev_logo ) && $dev_logo ) {
						printf(
							'<img src="%1$s" alt="%2$s" class="site-footer__dev-logo" loading="lazy" />',
							esc_url( $dev_logo ),
							esc_attr__( 'Logo do desenvolvedor', 'site-teste-tower' )
						);
					}
				}
				?>
            </div>

        </div>
    </div>

    <div class="whatsapp-box">
        <a href="#" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/whatsapp.png" alt="WhatsApp">
        </a>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>