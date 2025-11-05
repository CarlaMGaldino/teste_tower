<?php
/**
 * Template Name: Pagina Inicial
 * Template Post Type: page
 *
 * @package SiteTesteTower
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$rendered_flexible = false;

		if ( function_exists( 'have_rows' ) ) {
			$flexible_groups = array(
				'secoes_home',
				'secoes_video_flex',
				'page_sections',
			);

			foreach ( $flexible_groups as $flexible_field ) {
				if ( ! have_rows( $flexible_field ) ) {
					continue;
				}

				$rendered_flexible = true;

				while ( have_rows( $flexible_field ) ) :
					the_row();

					$layout_slug = get_row_layout();

					if ( empty( $layout_slug ) ) {
						continue;
					}

					$template_base = 'template-parts/flexible/';

					$potential_templates = array_unique(
						array(
							$layout_slug,
							str_replace( '-', '_', $layout_slug ),
							str_replace( '_', '-', $layout_slug ),
						)
					);

					foreach ( $potential_templates as $template_candidate ) {
						$template = locate_template( array( $template_base . $template_candidate . '.php' ), false, false );

						if ( $template ) {
							load_template( $template, false );
							continue 2;
						}
					}
				endwhile;
			}
		}

		if ( ! $rendered_flexible ) :
			if ( '' !== trim( get_the_content() ) ) {
				echo '<div class="container content-area content-area--narrow">';
				the_content();
				echo '</div>';
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
		endif;
	endwhile;
else :
	get_template_part( 'template-parts/content', 'none' );
endif;



get_footer();
