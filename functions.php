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
