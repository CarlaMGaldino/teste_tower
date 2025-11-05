<?php
/**
 * Funções principais do tema Site Teste Tower.
 *
 * @package SiteTesteTower
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$site_teste_tower_includes = array(
	'/inc/setup.php',
	'/inc/assets.php',
	'/inc/acf.php',
);

foreach ( $site_teste_tower_includes as $file ) {
	$filepath = get_template_directory() . $file;

	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	}
}
