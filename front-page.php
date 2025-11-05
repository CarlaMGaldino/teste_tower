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
				'secao_formulario',
				'page_sections',
			);

			$template_aliases = array(
				'formulario_home' => array( 'section_form', 'secao_formulario' ),
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

					$potential_templates = array(
						$layout_slug,
						str_replace( '-', '_', $layout_slug ),
						str_replace( '_', '-', $layout_slug ),
					);

					if ( isset( $template_aliases[ $layout_slug ] ) ) {
						$potential_templates = array_merge( (array) $template_aliases[ $layout_slug ], $potential_templates );
					}

					$potential_templates = array_values(
						array_unique(
							array_filter( $potential_templates )
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
