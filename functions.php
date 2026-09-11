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
 * Catégorie du pattern "Modèle de Réalisation" (11.09.2026) — voir
 * patterns/realisation-modele.php. Le fichier de pattern se charge tout
 * seul (convention native des thèmes block WordPress pour tout fichier
 * posé dans patterns/), il ne manque que le nom affiché de sa catégorie.
 */
add_action('init', function () {
	register_block_pattern_category('3dvisions-realisations', [
		'label' => __('Réalisations — 3D Visions', '3dvisions'),
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

/**
 * Contenu de départ (10.09.2026) : termes des taxonomies Prestation/Secteur et
 * pages d'index Prestations/Secteurs, nécessaires pour que les nouveaux gabarits
 * (taxonomy-prestation-*.html, taxonomy-secteur-*.html, page-prestations.html,
 * page-secteurs.html) aient une URL réelle à afficher. Idempotent (option verrou),
 * à retirer une fois la connexion MCP côté contenu en place et ce contenu repris
 * en gestion normale — voir architecture-technique-wordpress.md.
 */
add_action('init', function () {
	if (get_option('3dv_seeded_content_v1')) {
		return;
	}

	$prestations = [
		'photogrammetrie-aerienne-drone' => "Photogrammétrie aérienne par drone",
		'orthophotographie-precision'    => "Orthophotographie de précision",
		'releves-laser-scan-to-bim'      => "Relevés laser & Scan-to-BIM",
		'visites-virtuelles-360'         => "Visites virtuelles immersives (360°)",
	];
	foreach ($prestations as $slug => $name) {
		if (!term_exists($slug, 'prestation')) {
			wp_insert_term($name, 'prestation', ['slug' => $slug]);
		}
	}

	$secteurs = [
		'architecture-ingenierie' => "Architecture & ingénierie",
		'monuments-historiques'   => "Monuments historiques",
		'promotion-immobiliere'   => "Promotion immobilière",
	];
	foreach ($secteurs as $slug => $name) {
		if (!term_exists($slug, 'secteur')) {
			wp_insert_term($name, 'secteur', ['slug' => $slug]);
		}
	}

	$pages = [
		'prestations' => "Prestations",
		'secteurs'    => "Secteurs",
	];
	foreach ($pages as $slug => $title) {
		$existing = get_posts([
			'post_type'   => 'page',
			'name'        => $slug,
			'post_status' => 'any',
			'numberposts' => 1,
		]);
		if (empty($existing)) {
			wp_insert_post([
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_content' => '',
			]);
		}
	}

	flush_rewrite_rules();
	update_option('3dv_seeded_content_v1', 1);
}, 20);

add_action('wp_enqueue_scripts', function () {
	$path = get_theme_file_path('assets/css/extra.css');
	wp_enqueue_style(
		'3dvisions-extra',
		get_theme_file_uri('assets/css/extra.css'),
		[],
		file_exists($path) ? filemtime($path) : null
	);

	// Menu mobile (burger + sous-menus tactiles) — voir assets/js/nav.js.
	$nav_path = get_theme_file_path('assets/js/nav.js');
	wp_enqueue_script(
		'3dvisions-nav',
		get_theme_file_uri('assets/js/nav.js'),
		[],
		file_exists($nav_path) ? filemtime($nav_path) : null,
		true
	);

	// Boutons signature (flash de confirmation au clic) — voir assets/js/buttons.js.
	$buttons_path = get_theme_file_path('assets/js/buttons.js');
	wp_enqueue_script(
		'3dvisions-buttons',
		get_theme_file_uri('assets/js/buttons.js'),
		[],
		file_exists($buttons_path) ? filemtime($buttons_path) : null,
		true
	);
});
