<?php
/**
 * Integrações com ACF para o tema.
 *
 * @package SiteTesteTower
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'site_teste_tower_register_acf_options' ) ) {
	/**
	 * Registra página de opções no ACF, se disponível.
	 */
	function site_teste_tower_register_acf_options() {
		if ( ! function_exists( 'acf_add_options_page' ) ) {
			return;
		}

		acf_add_options_page(
			array(
				'page_title' => __( 'Configurações do Tema', 'site-teste-tower' ),
				'menu_title' => __( 'Configurações do Tema', 'site-teste-tower' ),
				'menu_slug'  => 'site-teste-tower-settings',
				'capability' => 'manage_options',
				'redirect'   => false,
			)
		);
	}
}
add_action( 'acf/init', 'site_teste_tower_register_acf_options' );

if ( ! function_exists( 'site_teste_tower_get_footer_background_image_url' ) ) {
	/**
	 * Retorna a URL da imagem de fundo do rodapé.
	 *
	 * Prioriza o campo configurado no painel ACF (opções) e cai para o arquivo padrão do tema.
	 *
	 * @return string
	 */
	function site_teste_tower_get_footer_background_image_url() {
		$default = get_template_directory_uri() . '/assets/images/footer-bg.jpg';

		if ( ! function_exists( 'get_field' ) ) {
			return $default;
		}

		$image = get_field( 'footer_background_image', 'option' );

		if ( empty( $image ) ) {
			return $default;
		}

		if ( is_array( $image ) && ! empty( $image['url'] ) ) {
			return $image['url'];
		}

		if ( is_string( $image ) ) {
			return $image;
		}

		return $default;
	}
}
