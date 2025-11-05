<?php
/**
 * Seção panorâmica com colunas configuráveis.
 *
 * @package SiteTesteTower
 */

$title_panoramic     = get_sub_field( 'title_panoramic' );
$image_panoramic     = get_sub_field( 'background_image' );
$image_panoramic_box = get_sub_field( 'background_box' );

$panoramic_box_style = '';

if ( ! empty( $image_panoramic_box ) && ! empty( $image_panoramic_box['url'] ) ) {
	$panoramic_box_style = sprintf( ' style="background-image: url(\'%s\');"', esc_url( $image_panoramic_box['url'] ) );
}

$column_field = '';

if ( function_exists( 'have_rows' ) ) {
	$column_field_candidates = array(
		'panoramic_columns',
		'panoramic_column',
		'panoramic_box_columns',
		'panoramic-column',
	);

	foreach ( $column_field_candidates as $candidate ) {
		if ( have_rows( $candidate ) ) {
			$column_field = $candidate;
			break;
		}
	}
}
?>

<section class="panoramic"<?php echo ! empty( $image_panoramic['url'] ) ? sprintf( ' style="background-image: url(\'%s\');"', esc_url( $image_panoramic['url'] ) ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="panoramic-content">
		<?php if ( $title_panoramic ) : ?>
			<h2 class="panoramic__title"><?php echo esc_html( $title_panoramic ); ?></h2>
		<?php endif; ?>
	</div>

	<div class="panoramic-box"<?php echo $panoramic_box_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php if ( $column_field ) : ?>
			<?php
			while ( have_rows( $column_field ) ) :
				the_row();
				$column_title = get_sub_field( 'column_title' );
				?>
				<div class="panoramic-column">
					<?php if ( $column_title ) : ?>
						<h3 class="panoramic-title"><?php echo esc_html( $column_title ); ?></h3>
					<?php endif; ?>

					<?php if ( have_rows( 'list_items' ) ) : ?>
						<ul class="panoramic-list">
							<?php
							while ( have_rows( 'list_items' ) ) :
								the_row();
								$item_text = get_sub_field( 'item_text' );

								if ( ! $item_text ) {
									continue;
								}
								?>
								<li><?php echo esc_html( $item_text ); ?></li>
								<?php
							endwhile;
							?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>
