<?php
/**
 * Seção de vídeo.
 *
 * @package SiteTesteTower
 */

$background_image = get_sub_field( 'background_image' );
$top_text         = get_sub_field( 'top_text' );
$video_url        = get_sub_field( 'video_url' );
$info_items       = get_sub_field( 'info_items' );
$cta_button       = get_sub_field( 'cta_button' );

$background_url = '';

if ( is_array( $background_image ) && ! empty( $background_image['url'] ) ) {
	$background_url = $background_image['url'];
} elseif ( is_string( $background_image ) ) {
	$background_url = $background_image;
}
?>

<section class="secao-video"<?php echo $background_url ? ' style="background-image: url(' . esc_url( $background_url ) . ');"' : ''; ?>>
	<div class="container">
		<?php if ( $top_text ) : ?>
			<div class="secao-video__top-text">
				<?php echo wp_kses_post( $top_text ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $video_url ) : ?>
			<div class="secao-video__video-wrapper">
				<?php
				echo wp_kses(
					$video_url,
					array(
						'iframe' => array(
							'src'             => true,
							'width'           => true,
							'height'          => true,
							'style'           => true,
							'frameborder'     => true,
							'allow'           => true,
							'allowfullscreen' => true,
							'loading'         => true,
							'referrerpolicy'  => true,
						),
					)
				);
				?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $info_items ) && is_array( $info_items ) ) : ?>
			<div class="secao-video__items">
				<?php foreach ( $info_items as $item ) :
					$item_icon        = isset( $item['icon'] ) ? $item['icon'] : null;
					$item_title       = isset( $item['title'] ) ? $item['title'] : '';
					$item_description = isset( $item['description'] ) ? $item['description'] : '';
				?>
					<div class="secao-video__item">
						<?php if ( $item_icon ) :
							$icon_url = '';
							$icon_alt = '';
							$icon_w   = '';
							$icon_h   = '';

							if ( is_array( $item_icon ) ) {
								$icon_url = isset( $item_icon['url'] ) ? $item_icon['url'] : '';
								$icon_alt = isset( $item_icon['alt'] ) ? $item_icon['alt'] : '';
								$icon_w   = isset( $item_icon['width'] ) ? $item_icon['width'] : '';
								$icon_h   = isset( $item_icon['height'] ) ? $item_icon['height'] : '';
							} elseif ( is_string( $item_icon ) ) {
								$icon_url = $item_icon;
							}

							if ( $icon_url ) :
								?>
								<div class="secao-video__item-icon">
									<img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( $icon_alt ); ?>"<?php echo $icon_w ? ' width="' . esc_attr( $icon_w ) . '"' : ''; ?><?php echo $icon_h ? ' height="' . esc_attr( $icon_h ) . '"' : ''; ?>>
								</div>
							<?php
							endif;
						endif;
						?>

						<?php if ( $item_title ) : ?>
							<h3 class="secao-video__item-title"><?php echo esc_html( $item_title ); ?></h3>
						<?php endif; ?>

						<?php if ( $item_description ) : ?>
							<p class="secao-video__item-description"><?php echo esc_html( $item_description ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( is_array( $cta_button ) ) :
			$cta_url    = isset( $cta_button['url'] ) ? $cta_button['url'] : '';
			$cta_title  = isset( $cta_button['title'] ) ? $cta_button['title'] : '';
			$cta_target = isset( $cta_button['target'] ) ? $cta_button['target'] : '_self';
			if ( $cta_url && $cta_title ) :
				?>
				<div class="secao-video__cta">
					<a href="<?php echo esc_url( $cta_url ); ?>" target="<?php echo esc_attr( $cta_target ); ?>" class="btn">
						<?php echo esc_html( $cta_title ); ?>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>
