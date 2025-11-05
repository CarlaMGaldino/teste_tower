<?php
/**
 * Secao Differences (ACF Flexible).
 *
 * Renderiza bloco textual e mosaico de cards a partir dos campos flexiveis.
 *
 * @package SiteTesteTower
 */

$title_differences        = get_sub_field( 'title_differences' );
$subtitle_differences     = get_sub_field( 'subtitle_differences' );
$description_differences  = get_sub_field( 'description_differences' );
$cta_differences          = get_sub_field( 'cta_differences' );
$differences_list         = get_sub_field( 'items_differences' );

$mosaic_source = get_sub_field( 'mosaic_items' );

if ( empty( $mosaic_source ) ) {
	$mosaic_source = get_sub_field( 'differences_mosaic_items' );
}

if ( empty( $mosaic_source ) && is_array( $differences_list ) ) {
	$mosaic_source = $differences_list;
}

$mosaic_cards = array();

if ( is_array( $mosaic_source ) ) {
	foreach ( $mosaic_source as $item ) {
		$image_field = null;

		if ( ! empty( $item['item_image'] ) ) {
			$image_field = $item['item_image'];
		} elseif ( ! empty( $item['image'] ) ) {
			$image_field = $item['image'];
		} elseif ( ! empty( $item['card_image'] ) ) {
			$image_field = $item['card_image'];
		}

		if ( empty( $image_field ) ) {
			continue;
		}

		$image_url = '';
		$image_alt = '';

		if ( is_array( $image_field ) ) {
			$image_url = isset( $image_field['url'] ) ? $image_field['url'] : '';
			$image_alt = isset( $image_field['alt'] ) ? $image_field['alt'] : '';
		} elseif ( is_string( $image_field ) ) {
			$image_url = $image_field;
		}

		if ( empty( $image_url ) ) {
			continue;
		}

		$label_keys = array( 'item_title', 'title', 'card_title', 'label' );
		$label      = '';

		foreach ( $label_keys as $key ) {
			if ( ! empty( $item[ $key ] ) ) {
				$label = $item[ $key ];
				break;
			}
		}

		if ( empty( $label ) && is_array( $image_field ) && ! empty( $image_field['alt'] ) ) {
			$label = $image_field['alt'];
		}

		$link_data = null;

		if ( ! empty( $item['item_link'] ) ) {
			$link_data = $item['item_link'];
		} elseif ( ! empty( $item['link'] ) ) {
			$link_data = $item['link'];
		}

		$mosaic_cards[] = array(
			'image_url' => $image_url,
			'image_alt' => $image_alt ? $image_alt : $label,
			'label'     => $label,
			'link'      => $link_data,
		);
	}
}

$has_mosaic           = ! empty( $mosaic_cards );
$render_list_fallback = ! $has_mosaic && ! empty( $differences_list );
$primary_card         = null;
$stack_cards          = array();
$secondary_card       = null;
$extra_cards          = array();

if ( $has_mosaic ) {
	$primary_card     = array_shift( $mosaic_cards );
	$remaining_cards  = $mosaic_cards;

	if ( count( $remaining_cards ) >= 2 ) {
		$stack_cards     = array_slice( $remaining_cards, 0, 2 );
		$remaining_cards = array_slice( $remaining_cards, 2 );
	}

	if ( ! empty( $remaining_cards ) ) {
		$secondary_card = array_shift( $remaining_cards );
	}

	$extra_cards = $remaining_cards;
}

$render_card = static function ( $card, $additional_class = '' ) {
	if ( empty( $card ) || ! is_array( $card ) ) {
		return '';
	}

	$card_tag   = 'div';
	$card_attrs = '';

	if ( ! empty( $card['link'] ) && is_array( $card['link'] ) ) {
		$link_url    = isset( $card['link']['url'] ) ? $card['link']['url'] : '';
		$link_title  = isset( $card['link']['title'] ) ? $card['link']['title'] : '';
		$link_target = isset( $card['link']['target'] ) ? $card['link']['target'] : '_self';

		if ( $link_url ) {
			$card_tag   = 'a';
			$card_attrs = ' href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '"';

			if ( '_blank' === $link_target ) {
				$card_attrs .= ' rel="noopener noreferrer"';
			}

			if ( $link_title ) {
				$card_attrs .= ' title="' . esc_attr( $link_title ) . '"';
			}
		}
	}

	$classes = trim( 'mosaic-card ' . $additional_class );

	ob_start();
	?>
<<?php echo $card_tag; ?> class="<?php echo esc_attr( $classes ); ?>" <?php echo $card_attrs; ?>>
    <figure class="mosaic-card__media">
        <img src="<?php echo esc_url( $card['image_url'] ); ?>" alt="<?php echo esc_attr( $card['image_alt'] ); ?>"
            loading="lazy" />
    </figure>

    <?php if ( ! empty( $card['label'] ) ) : ?>
    <span class="mosaic-card__label">
        <?php echo esc_html( $card['label'] ); ?>
    </span>
    <?php endif; ?>
</<?php echo $card_tag; ?>>
<?php
	return ob_get_clean();
};

$has_stack_cards     = ! empty( $stack_cards );
$has_secondary_card  = ! empty( $secondary_card );
$bottom_wrapper_class = 'differences-mosaic__bottom';

if ( ! $has_stack_cards ) {
	$bottom_wrapper_class .= ' differences-mosaic__bottom--compact';
}
?>

<section class="differences">
    <div class="container">
        <div class="differences-content<?php echo $has_mosaic ? ' differences-content--with-mosaic' : ''; ?>">
            <div class="differences-content__text">
                <div class="differences-content__text-box">

                    <?php if ( $title_differences ) : ?>
                    <h2 class="differences-content__text-title">
                        <?php echo esc_html( $title_differences ); ?>
                    </h2>
                    <?php endif; ?>
                </div>
                <div class="differences-content__text-box_right">
                    <?php if ( $subtitle_differences ) : ?>
                    <p class="differences-content__text-subtitle">
                        <?php echo esc_html( wp_strip_all_tags( $subtitle_differences ) ); ?>
                    </p>
                    <?php endif; ?>
                </div>
            
                <div class="differences-content__text-box_right">
                    <?php if ( $cta_differences ) : ?>
   
                        <?php
						set_query_var( 'cta_primary_data', $cta_differences );
						get_template_part( 'template-parts/cta_primary' );
						set_query_var( 'cta_primary_data', null );
						?>
                
                    <?php endif; ?>

                </div>

            </div>

            <?php if ( $has_mosaic ) : ?>
            <div class="differences-mosaic">
                <?php if ( $primary_card ) : ?>
                <div class="differences-mosaic__primary">
                    <?php echo $render_card( $primary_card, 'mosaic-card--primary' ); ?>
                </div>
                <?php endif; ?>

                <?php if ( $has_stack_cards || $has_secondary_card ) : ?>
                <div class="<?php echo esc_attr( $bottom_wrapper_class ); ?>">
                    <?php if ( $has_stack_cards ) : ?>
                    <div class="differences-mosaic__arrow" aria-hidden="true">
                        <i class="icon-arrow-white"></i>
                        <span
                            class="screen-reader-text"><?php esc_html_e( 'Elemento decorativo', 'site-teste-tower' ); ?></span>
                    </div>

                    <div class="differences-mosaic__stack">
                        <?php foreach ( $stack_cards as $stack_card ) : ?>
                        <?php echo $render_card( $stack_card, 'mosaic-card--stack' ); ?>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( $has_secondary_card ) : ?>
                    <div class="differences-mosaic__secondary">
                        <?php echo $render_card( $secondary_card, 'mosaic-card--secondary-large' ); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ( ! empty( $extra_cards ) ) : ?>
                <div class="differences-mosaic__extras">
                    <?php foreach ( $extra_cards as $extra_card ) : ?>
                    <?php echo $render_card( $extra_card, 'mosaic-card--extra' ); ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php elseif ( $render_list_fallback ) : ?>
            <div class="differences-content__list">
                <ul class="differences-items">
                    <?php foreach ( $differences_list as $item ) : ?>
                    <?php
							$item_title       = isset( $item['item_title'] ) ? $item['item_title'] : '';
							$item_description = isset( $item['item_description'] ) ? $item['item_description'] : '';
							?>
                    <li class="differences-item">
                        <?php if ( $item_title ) : ?>
                        <h3 class="differences-item__title"><?php echo esc_html( $item_title ); ?></h3>
                        <?php endif; ?>

                        <?php if ( $item_description ) : ?>
                        <p class="differences-item__description"><?php echo esc_html( $item_description ); ?></p>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>