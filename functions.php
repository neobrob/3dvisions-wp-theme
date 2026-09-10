<?php
/**
 * 3D Visions Designs — thème block (FSE)
 */

if (!defined('ABSPATH')) {
	exit;
}

add_action('after_setup_theme', function () {
	add_theme_support('wp-block-styles');
	add_theme_support('editor-styles');
	add_theme_support('responsive-embeds');
	add_theme_support('post-thumbnails'); // nécessaire pour l'image mise en avant des Réalisations
	add_theme_support('align-wide');

	register_nav_menus([
		'primary' => __('Menu principal', '3dvisions'),
		'footer'  => __('Menu pied de page', '3dvisions'),
	]);
});

/**
 * Taxonomies Prestation & Secteur pour le futur type de contenu Réalisation.
 * Voir architecture-technique-wordpress.md — repris ici comme point de départ,
 * à basculer dans un petit plugin dédié si on préfère détacher le contenu du thème.
 */
add_action('init', function () {
	register_taxonomy('prestation', ['post', 'realisation'], [
		'label'        => __('Prestation', '3dvisions'),
		'public'       => true,
		'hierarchical' => false,
		'show_in_rest' => true,
		'rewrite'      => ['slug' => 'prestation'],
	]);

	register_taxonomy('secteur', ['post', 'realisation'], [
		'label'        => __('Secteur', '3dvisions'),
		'public'       => true,
		'hierarchical' => false,
		'show_in_rest' => true,
		'rewrite'      => ['slug' => 'secteur'],
	]);

	register_post_type('realisation', [
		'label'        => __('Réalisations', '3dvisions'),
		'public'       => true,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-camera',
		'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
		'has_archive'  => true,
		'rewrite'      => ['slug' => 'realisations'],
	]);
});

/**
 * Polices auto-hébergées (Inter + Bai Jamjuree) déclarées dans theme.json.
 * Placer les fichiers .woff2 correspondants dans assets/fonts/ avant la mise en prod
 * (ne pas charger via Google Fonts CDN pour rester conforme RGPD/LPD suisse).
 */

/**
 * Feuille de style additionnelle : tout ce que Gutenberg/theme.json ne peut pas
 * exprimer nativement, notamment le motif "signature graphique" (trait D/O)
 * réutilisé en anneau fendu (.dov-ring) et en trait fendu (.dov-divider).
 * Voir assets/css/extra.css et design-system-web-v1.md.
 */
add_action('wp_enqueue_scripts', function () {
	$path = get_theme_file_path('assets/css/extra.css');
	wp_enqueue_style(
		'3dvisions-extra',
		get_theme_file_uri('assets/css/extra.css'),
		[],
		file_exists($path) ? filemtime($path) : null
	);
});
