<?php
/**
 * Registro de estilos e scripts do tema.
 *
 * @package SiteTesteTower
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'site_teste_tower_get_cdn_styles' ) ) {
	/**
	 * Retorna os estilos CDN utilizados pelo tema.
	 *
	 * @return array<string, array<string, mixed>>
	 */
	function site_teste_tower_get_cdn_styles() {
		$styles = array(
			'site-teste-tower-normalize' => array(
				'src'            => 'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css',
				'version'        => '8.0.1',
				'integrity'      => 'sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==',
				'crossorigin'    => 'anonymous',
				'referrerpolicy' => 'no-referrer',
				'deps'           => array(),
			),
			'site-teste-tower-reseter'   => array(
				'src'            => 'https://cdnjs.cloudflare.com/ajax/libs/reseter.css/2.0.0/reseter.min.css',
				'version'        => '2.0.0',
				'integrity'      => 'sha512-gCJkkUMGTe73+FMwog6gIBCVJIMXRoc21l6/IPCuzxCex/1sxvO8ctb6Zd4/WWs2UMqmtnDrAdhJht5pEY0LXg==',
				'crossorigin'    => 'anonymous',
				'referrerpolicy' => 'no-referrer',
				'deps'           => array( 'site-teste-tower-normalize' ),
			),
			'site-teste-tower-font-n1'   => array(
				'src'  => 'https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700&display=swap',
				'deps' => array(),
			),
			'site-teste-tower-font-mplus1p' => array(
				'src'  => 'https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;500;600;700&display=swap',
				'deps' => array( 'site-teste-tower-font-n1' ),
			),
		);

		return apply_filters( 'site_teste_tower_cdn_styles', $styles );
	}
}

/**
 * Enfileira estilos e scripts globais.
 */
function site_teste_tower_enqueue_assets() {
	$theme      = wp_get_theme();
	$theme_name = $theme->get( 'Name' );
	$version    = $theme->get( 'Version' );

	$cdn_styles = site_teste_tower_get_cdn_styles();

	foreach ( $cdn_styles as $handle => $data ) {
		$src         = isset( $data['src'] ) ? esc_url_raw( $data['src'] ) : '';
		$deps        = isset( $data['deps'] ) ? (array) $data['deps'] : array();
		$style_ver   = isset( $data['version'] ) ? $data['version'] : null;
		$integrity   = isset( $data['integrity'] ) ? $data['integrity'] : '';
		$crossorigin = isset( $data['crossorigin'] ) ? $data['crossorigin'] : '';
		$referrer    = isset( $data['referrerpolicy'] ) ? $data['referrerpolicy'] : '';

		if ( ! $src ) {
			continue;
		}

		wp_enqueue_style( $handle, $src, $deps, $style_ver );

		if ( $integrity ) {
			wp_style_add_data( $handle, 'integrity', $integrity );
		}

		if ( $crossorigin ) {
			wp_style_add_data( $handle, 'crossorigin', $crossorigin );
		}

		if ( $referrer ) {
			wp_style_add_data( $handle, 'referrerpolicy', $referrer );
		}
	}

	wp_enqueue_style(
		'site-teste-tower-style',
		get_stylesheet_uri(),
		array_keys( $cdn_styles ),
		$version
	);

	$main_stylesheet_path = get_template_directory() . '/assets/css/main.css';

	if ( file_exists( $main_stylesheet_path ) ) {
		wp_enqueue_style(
			'site-teste-tower-main',
			get_template_directory_uri() . '/assets/css/main.css',
			array( 'site-teste-tower-style' ),
			filemtime( $main_stylesheet_path )
		);
	}

	$main_script_path = get_template_directory() . '/assets/js/main.js';

	if ( file_exists( $main_script_path ) ) {
		wp_enqueue_script(
			'site-teste-tower-main',
			get_template_directory_uri() . '/assets/js/main.js',
			array(),
			filemtime( $main_script_path ),
			true
		);

		wp_localize_script(
			'site-teste-tower-main',
			'siteTesteTower',
			array(
				'name'      => $theme_name,
				'homeUrl'   => esc_url( home_url( '/' ) ),
				'assetsUrl' => esc_url( get_template_directory_uri() . '/assets' ),
			)
		);

		wp_script_add_data( 'site-teste-tower-main', 'strategy', 'defer' );
	}
}
add_action( 'wp_enqueue_scripts', 'site_teste_tower_enqueue_assets' );

if ( ! function_exists( 'site_teste_tower_style_loader_tag' ) ) {
	/**
	 * Adiciona atributos extras as tags de estilos CDN quando necessario.
	 *
	 * @param string $html   Tag gerada.
	 * @param string $handle Identificador do estilo.
	 * @return string
	 */
	function site_teste_tower_style_loader_tag( $html, $handle ) {
		$cdn_styles = site_teste_tower_get_cdn_styles();

		if ( empty( $cdn_styles[ $handle ] ) ) {
			return $html;
		}

		$attributes = array();

		foreach ( array( 'integrity', 'crossorigin', 'referrerpolicy' ) as $attribute_key ) {
			if ( ! empty( $cdn_styles[ $handle ][ $attribute_key ] ) && false === stripos( $html, $attribute_key . '=' ) ) {
				$attributes[ $attribute_key ] = $cdn_styles[ $handle ][ $attribute_key ];
			}
		}

		if ( empty( $attributes ) ) {
			return $html;
		}

		$attribute_string = '';

		foreach ( $attributes as $key => $value ) {
			$attribute_string .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
		}

		if ( false !== strpos( $html, ' />' ) ) {
			return str_replace( ' />', $attribute_string . ' />', $html );
		}

		return str_replace( '>', $attribute_string . '>', $html );
	}
}
add_filter( 'style_loader_tag', 'site_teste_tower_style_loader_tag', 10, 2 );
