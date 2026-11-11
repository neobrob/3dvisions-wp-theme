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
		'releve-aerien-drone'          => "Relevé aérien par drone",
		'releve-terrestre-scan-to-bim' => "Relevé terrestre Scan-to-BIM",
		'visite-virtuelle'             => "Visite virtuelle",
	];
	foreach ($prestations as $slug => $name) {
		if (!term_exists($slug, 'prestation')) {
			wp_insert_term($name, 'prestation', ['slug' => $slug]);
		}
	}

	$secteurs = [
		'sig-gis'                 => "SIG / GIS",
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

/**
 * Nouvelle structure Prestations / Secteurs (11.11.2026) — voir
 * structure-et-textes-site-2.0.md et architecture-technique-wordpress.md.
 * 3 prestations (le drone devient une page unique à sections), ajout du
 * secteur SIG / GIS, l'orthophotographie devient un livrable du drone.
 * Migration des termes déjà créés par la v1 : renommés (pas de doublon),
 * Réalisations éventuellement taguées Orthophotographie reportées sur le
 * drone avant suppression du terme. Idempotent (option verrou v2).
 */
add_action('init', function () {
	if (get_option('3dv_seeded_content_v2')) {
		return;
	}

	$renames = [
		'photogrammetrie-aerienne-drone' => ['releve-aerien-drone', "Relevé aérien par drone"],
		'releves-laser-scan-to-bim'      => ['releve-terrestre-scan-to-bim', "Relevé terrestre Scan-to-BIM"],
		'visites-virtuelles-360'         => ['visite-virtuelle', "Visite virtuelle"],
	];
	foreach ($renames as $old => [$slug, $name]) {
		$term = get_term_by('slug', $old, 'prestation');
		if ($term && !term_exists($slug, 'prestation')) {
			wp_update_term($term->term_id, 'prestation', ['name' => $name, 'slug' => $slug]);
		} elseif (!term_exists($slug, 'prestation')) {
			wp_insert_term($name, 'prestation', ['slug' => $slug]);
		}
	}

	$ortho = get_term_by('slug', 'orthophotographie-precision', 'prestation');
	$drone = get_term_by('slug', 'releve-aerien-drone', 'prestation');
	if ($ortho) {
		if ($drone) {
			$ids = get_objects_in_term($ortho->term_id, 'prestation');
			if (!is_wp_error($ids)) {
				foreach ($ids as $id) {
					wp_set_object_terms((int) $id, (int) $drone->term_id, 'prestation', true);
				}
			}
		}
		wp_delete_term($ortho->term_id, 'prestation');
	}

	if (!term_exists('sig-gis', 'secteur')) {
		wp_insert_term("SIG / GIS", 'secteur', ['slug' => 'sig-gis']);
	}

	flush_rewrite_rules();
	update_option('3dv_seeded_content_v2', 1);
}, 21);

/**
 * Redirections 301 des anciennes URL de prestation (structure v1).
 */
add_action('template_redirect', function () {
	$path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
	$map = [
		'prestation/photogrammetrie-aerienne-drone' => '/prestation/releve-aerien-drone/',
		'prestation/orthophotographie-precision'    => '/prestation/releve-aerien-drone/#livrables',
		'prestation/releves-laser-scan-to-bim'      => '/prestation/releve-terrestre-scan-to-bim/',
		'prestation/visites-virtuelles-360'         => '/prestation/visite-virtuelle/',
	];
	if (isset($map[$path])) {
		wp_safe_redirect(home_url($map[$path]), 301);
		exit;
	}
});

/**
 * Images (11.11.2026) — voir nomenclature-illustrations-wp.md.
 * Sources uploadées en JPG (qualité 85–90), tailles générées en WebP quand
 * le serveur sait l'encoder ; seuil de redimensionnement laissé à 2560 px,
 * cohérent avec les formats de la nomenclature (évite le suffixe "-scaled").
 */
add_filter('image_editor_output_format', function ($formats) {
	if (wp_image_editor_supports(['mime_type' => 'image/webp'])) {
		$formats['image/jpeg'] = 'image/webp';
	}
	return $formats;
});
add_filter('big_image_size_threshold', function () {
	return 2560;
});

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
