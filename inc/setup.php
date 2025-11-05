<?php
/**
 * Configurações e recursos do tema.
 *
 * @package SiteTesteTower
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'site_teste_tower_setup' ) ) {
	/**
	 * Inicializa suporte do tema.
	 */
	function site_teste_tower_setup() {
		load_theme_textdomain( 'site-teste-tower', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 240,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );

		register_nav_menus(
			array(
				'primary' => __( 'Menu Principal', 'site-teste-tower' ),
				'footer'  => __( 'Menu Rodapé', 'site-teste-tower' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'site_teste_tower_setup' );

/**
 * Define a largura padrão do conteúdo.
 */
function site_teste_tower_content_width() {
	$container_width = 1725;
	$container_padding = 20;

	$GLOBALS['content_width'] = apply_filters(
		'site_teste_tower_content_width',
		$container_width - ( 2 * $container_padding )
	);
}
add_action( 'after_setup_theme', 'site_teste_tower_content_width', 0 );

/**
 * Registra áreas de widgets.
 */
function site_teste_tower_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Barra Lateral', 'site-teste-tower' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Widgets exibidos na barra lateral padrão.', 'site-teste-tower' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'site_teste_tower_widgets_init' );

if ( ! function_exists( 'site_teste_tower_allow_svg_uploads' ) ) {
	/**
	 * Permite upload de arquivos SVG.
	 *
	 * @param array $mimes Tipos mime atuais.
	 *
	 * @return array
	 */
	function site_teste_tower_allow_svg_uploads( $mimes ) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		return $mimes;
	}
}
add_filter( 'upload_mimes', 'site_teste_tower_allow_svg_uploads' );

if ( ! function_exists( 'site_teste_tower_fix_svg_mime_type' ) ) {
	/**
	 * Ajusta o tipo mime detectado para SVG após upload.
	 *
	 * @param array $data     Dados do arquivo.
	 * @param int   $file_id  ID do arquivo.
	 * @param array $meta     Metadados.
	 *
	 * @return array
	 */
	function site_teste_tower_fix_svg_mime_type( $data, $file_id, $meta ) {
		$file = get_attached_file( $file_id );

		if ( $file && 'svg' === strtolower( pathinfo( $file, PATHINFO_EXTENSION ) ) ) {
			$data['type'] = 'image/svg+xml';
		}

		return $data;
	}
}
add_filter( 'wp_check_filetype_and_ext', 'site_teste_tower_fix_svg_mime_type', 10, 3 );
