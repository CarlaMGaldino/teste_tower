<?php
/**
 * CTA primário reutilizável.
 *
 * @package SiteTesteTower
 */

$cta_data = get_query_var( 'cta_primary_data', null );

if ( null === $cta_data ) {
	$cta_data = get_sub_field( 'cta_primary' );
}

if ( empty( $cta_data ) ) {
	return;
}

if ( is_array( $cta_data ) ) {
	$cta_url    = isset( $cta_data['url'] ) ? $cta_data['url'] : '';
	$cta_title  = isset( $cta_data['title'] ) ? $cta_data['title'] : '';
	$cta_target = isset( $cta_data['target'] ) ? $cta_data['target'] : '_self';

	if ( $cta_url && $cta_title ) :
		?>
		<a class="btn btn-primary" href="<?php echo esc_url( $cta_url ); ?>" target="<?php echo esc_attr( $cta_target ); ?>">
			<?php echo esc_html( $cta_title ); ?>
		</a>
		<?php
	endif;
} elseif ( is_string( $cta_data ) ) {
	echo do_shortcode( $cta_data );
}
