<?php
/**
 *
 * @package SiteTesteTower
 */

$form_title       = get_sub_field( 'form_title' );
$form_bg_image    = get_sub_field( 'form_bg_image' );
$background_image = get_sub_field( 'background_image' );

$form_image_url   = '';
$form_image_alt   = '';
$section_style    = '';
$arrow_image_url  = trailingslashit( get_template_directory_uri() ) . 'assets/images/arrow-white-opacity-min.png';

if ( is_array( $background_image ) && ! empty( $background_image['url'] ) ) {
	$section_style = sprintf( ' style="background-image: url(\'%s\');"', esc_url( $background_image['url'] ) );
} elseif ( is_string( $background_image ) && '' !== $background_image ) {
	$section_style = sprintf( ' style="background-image: url(\'%s\');"', esc_url( $background_image ) );
}

if ( is_array( $form_bg_image ) ) {
	$form_image_url = ! empty( $form_bg_image['url'] ) ? $form_bg_image['url'] : '';
	$form_image_alt = ! empty( $form_bg_image['alt'] ) ? $form_bg_image['alt'] : '';
} elseif ( is_string( $form_bg_image ) ) {
	$form_image_url = $form_bg_image;
}

if ( empty( $form_image_alt ) && ! empty( $form_title ) ) {
	$form_image_alt = $form_title;
}
?>

<section class="opportunity-section"<?php echo $section_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">
		<div class="opportunity-wrapper">
			<div class="opportunity-image">
				<?php if ( $form_image_url ) : ?>
					<img src="<?php echo esc_url( $form_image_url ); ?>" alt="<?php echo esc_attr( $form_image_alt ); ?>">
				<?php endif; ?>
				<div class="image-overlay">
					<?php if ( $form_title ) : ?>
						<h2><?php echo esc_html( $form_title ); ?></h2>
					<?php endif; ?>
					<span class="arrow"><img src="<?php echo esc_url( $arrow_image_url ); ?>" alt=""></span>
				</div>
			</div>

			<div class="opportunity-form">
				<form action="#" method="post">
					<div class="form-field">
						<input type="text" name="name" placeholder="NOME" required>
					</div>
					<div class="form-field">
						<input type="tel" name="phone" placeholder="CELULAR" required>
					</div>
					<div class="form-field">
						<input type="email" name="email" placeholder="E-MAIL" required>
					</div>
					<div class="form-field select-field">
						<select name="purpose" required id="select-home">
							<option value="">Você está procurando imóveis para:</option>
							<option value="live">Morar</option>
							<option value="invest">Investir</option>
						</select>
					</div>

					<div class="checkbox-field">
						<label class="checkbox">
							<input type="checkbox" required>
                <span class="checkmark"></span>
							Declaro que li e concordo com a Politica de Privacidade e autorizo o tratamento dos meus dados para o fim especificado.
    
						</label>
					</div>

					<button type="submit" class="btn-submit">
						CADASTRAR <span>&#x279C;</span>
					</button>
				</form>
			</div>
		</div>
	</div>
</section>