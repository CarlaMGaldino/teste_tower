<?php
/**
 * Secao Panoramic.
 *
 * @package SiteTesteTower
 */

$title_panoramic   = get_sub_field( 'title_panoramic' );
$image_panoramic   = get_sub_field( 'background_image' );
$section_subtitle  = get_sub_field( 'subtitle_panoramic' );

$background_url = '';

if ( is_array( $image_panoramic ) && ! empty( $image_panoramic['url'] ) ) {
	$background_url = $image_panoramic['url'];
} elseif ( is_string( $image_panoramic ) ) {
	$background_url = $image_panoramic;
}
?>
<section class="panoramic"<?php echo $background_url ? ' style="background-image: url(' . esc_url( $background_url ) . ');"' : ''; ?>>
	<div class="container">
		<div class="panoramic-content">
			<?php if ( $title_panoramic ) : ?>
				<h2 class="panoramic-content__title">
					<?php echo esc_html( $title_panoramic ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $section_subtitle ) : ?>
				<p class="panoramic-content__subtitle">
					<?php echo esc_html( $section_subtitle ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( have_rows( 'panoramic_boxes' ) ) : ?>
			<div class="panoramic-grid">
				<?php
				while ( have_rows( 'panoramic_boxes' ) ) :
					the_row();
					$box_title = get_sub_field( 'box_title' );
				?>
					<div class="panoramic-box panoramic_box">
						<?php if ( $box_title ) : ?>
							<div class="panoramic-box__header">
								<span class="panoramic-box__icon" aria-hidden="true"></span>
								<h3 class="panoramic-box__title"><?php echo esc_html( $box_title ); ?></h3>
							</div>
						<?php endif; ?>

						<?php if ( have_rows( 'box_items' ) ) : ?>
							<ul class="panoramic-box__list">
								<?php
								while ( have_rows( 'box_items' ) ) :
									the_row();
									$item_text = get_sub_field( 'item_text' );

									if ( empty( $item_text ) ) {
										continue;
									}
									?>
									<li class="panoramic-box__item"><?php echo esc_html( $item_text ); ?></li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
