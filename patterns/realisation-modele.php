<?php
/**
 * Title: Modèle de Réalisation
 * Slug: 3dvisions/realisation-modele
 * Categories: 3dvisions-realisations
 * Post Types: realisation
 * Block Types: core/post-content
 * Inserter: true
 *
 * Contenu de départ pour une page Réalisation (11.09.2026). Pensé pour être
 * rempli par l'équipe sans aide technique : structure déjà en place, il ne
 * reste qu'à remplacer les textes/images et à dupliquer les blocs qui vont
 * par plusieurs (étapes de la timeline, photos de la galerie).
 *
 * Suggéré automatiquement à la création d'une nouvelle Réalisation (écran
 * "Choisir un modèle") sur les versions récentes de WordPress ; sinon,
 * disponible dans l'inséreur de blocs → onglet Modèles → "Modèle de
 * Réalisation", pour l'insérer à la main dans n'importe quelle Réalisation
 * (neuve ou existante, par exemple pour ajouter une deuxième galerie).
 *
 * "En bref" + texte d'intro verrouillés comme bloc (templateLock: all) :
 * modifiables librement (texte, images) mais ne peuvent pas être supprimés
 * ou séparés par erreur — le reste de la page (client, chiffres clés,
 * timeline, galerie, avis) reste entièrement libre, y compris supprimable
 * en entier si non applicable à ce projet (client confidentiel, pas
 * d'avis collecté, etc.).
 */
?>
<!-- wp:group {"templateLock":"all","layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group">

<!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"flex","flexWrap":"wrap"},"className":"dov-brief"} -->
<div class="wp-block-group dov-brief">
<!-- wp:paragraph {"className":"dov-brief__item"} -->
<p class="dov-brief__item"><strong>Client :</strong> à compléter (ou à retirer tout le bloc « En bref » si confidentiel)</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"dov-brief__item"} -->
<p class="dov-brief__item"><strong>Lieu :</strong> à compléter</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"dov-brief__item"} -->
<p class="dov-brief__item"><strong>Durée :</strong> à compléter</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"placeholder":"Décrivez le projet en 2-3 phrases : le contexte, la demande du client, ce qui rendait ce relevé particulier..."} -->
<p></p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->

<!-- wp:group {"className":"dov-client-card","style":{"border":{"color":"#dde4e4","width":"1px","radius":"8px"},"spacing":{"padding":{"top":"24px","right":"28px","bottom":"24px","left":"28px"},"margin":{"top":"32px","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group dov-client-card" style="border-color:#dde4e4;border-width:1px;border-radius:8px;margin-top:32px;padding-top:24px;padding-right:28px;padding-bottom:24px;padding-left:28px">
<!-- wp:paragraph {"fontSize":"small","textColor":"teal","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"}},"className":"dov-kicker"} -->
<p class="has-teal-color has-text-color has-small-font-size dov-kicker">Le client</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>À compléter : qui est le client, son activité, pourquoi il a fait appel à nous. <em>Bloc entier à supprimer si le client souhaite rester anonyme.</em></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"dov-key-figures","style":{"spacing":{"margin":{"top":"40px","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group dov-key-figures" style="margin-top:40px">
<!-- wp:group {"className":"dov-stat","layout":{"type":"constrained"}} -->
<div class="wp-block-group dov-stat">
<!-- wp:paragraph {"className":"dov-stat__value"} -->
<p class="dov-stat__value">0 m²</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"dov-stat__label"} -->
<p class="dov-stat__label">Surface couverte</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"dov-stat","layout":{"type":"constrained"}} -->
<div class="wp-block-group dov-stat">
<!-- wp:paragraph {"className":"dov-stat__value"} -->
<p class="dov-stat__value">0 mm</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"dov-stat__label"} -->
<p class="dov-stat__label">Précision obtenue</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"dov-stat","layout":{"type":"constrained"}} -->
<div class="wp-block-group dov-stat">
<!-- wp:paragraph {"className":"dov-stat__value"} -->
<p class="dov-stat__value">0</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"dov-stat__label"} -->
<p class="dov-stat__label">Prises de vue</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
<!-- wp:paragraph {"placeholder":"(Visible seulement en édition, jamais publié) Chiffres clés : ajustez valeur et libellé de chaque case, dupliquez ou supprimez-en une selon le projet."} -->
<p></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"fontSize":"large","textColor":"teal-900","style":{"spacing":{"margin":{"top":"48px","bottom":"8px"}}}} -->
<h2 class="wp-block-heading has-teal-900-color has-text-color has-large-font-size" style="margin-top:48px;margin-bottom:8px">Comment on a procédé</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"placeholder":"(Visible seulement en édition, jamais publié) Dupliquez une étape (icône de copie dans la barre d'outils du bloc) pour en ajouter, ou supprimez-en pour en retirer — le nombre n'est pas fixe."} -->
<p></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"dov-timeline"} -->
<div class="wp-block-group dov-timeline">

<!-- wp:group {"className":"dov-timeline-step"} -->
<div class="wp-block-group dov-timeline-step">
<!-- wp:image {"className":"dov-timeline-step__media"} -->
<figure class="wp-block-image dov-timeline-step__media"><img alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"dov-timeline-step__content","layout":{"type":"constrained"}} -->
<div class="wp-block-group dov-timeline-step__content">
<!-- wp:heading {"level":3,"fontSize":"medium","textColor":"teal-900"} -->
<h3 class="wp-block-heading has-teal-900-color has-text-color has-medium-font-size">Étape 1 — Repérage terrain</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Décrivez cette étape en 1-2 phrases.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"dov-timeline-step"} -->
<div class="wp-block-group dov-timeline-step">
<!-- wp:image {"className":"dov-timeline-step__media"} -->
<figure class="wp-block-image dov-timeline-step__media"><img alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"dov-timeline-step__content","layout":{"type":"constrained"}} -->
<div class="wp-block-group dov-timeline-step__content">
<!-- wp:heading {"level":3,"fontSize":"medium","textColor":"teal-900"} -->
<h3 class="wp-block-heading has-teal-900-color has-text-color has-medium-font-size">Étape 2 — Acquisition des données</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Décrivez cette étape en 1-2 phrases.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"dov-timeline-step"} -->
<div class="wp-block-group dov-timeline-step">
<!-- wp:image {"className":"dov-timeline-step__media"} -->
<figure class="wp-block-image dov-timeline-step__media"><img alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"dov-timeline-step__content","layout":{"type":"constrained"}} -->
<div class="wp-block-group dov-timeline-step__content">
<!-- wp:heading {"level":3,"fontSize":"medium","textColor":"teal-900"} -->
<h3 class="wp-block-heading has-teal-900-color has-text-color has-medium-font-size">Étape 3 — Livraison</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Décrivez cette étape en 1-2 phrases.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->

<!-- wp:heading {"level":2,"fontSize":"large","textColor":"teal-900","style":{"spacing":{"margin":{"top":"48px","bottom":"8px"}}}} -->
<h2 class="wp-block-heading has-teal-900-color has-text-color has-large-font-size" style="margin-top:48px;margin-bottom:8px">En images</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"placeholder":"(Visible seulement en édition, jamais publié) Ajoutez vos photos normalement (bouton + dans la barre d'outils de la galerie) — elle se parcourt au doigt/à la molette comme un carrousel, aucun réglage supplémentaire à faire."} -->
<p></p>
<!-- /wp:paragraph -->

<!-- wp:gallery {"columns":3,"linkTo":"none","className":"dov-gallery-scroll"} -->
<figure class="wp-block-gallery has-nested-images columns-3 is-cropped dov-gallery-scroll"></figure>
<!-- /wp:gallery -->

<!-- wp:group {"className":"dov-testimonial","style":{"border":{"color":"#dde4e4","width":"1px","radius":"8px"},"spacing":{"padding":{"top":"22px","right":"24px","bottom":"22px","left":"24px"},"margin":{"top":"48px","bottom":"0"}}}} -->
<div class="dov-testimonial wp-block-group" style="border-color:#dde4e4;border-width:1px;border-radius:8px;margin-top:48px;padding-top:22px;padding-right:24px;padding-bottom:22px;padding-left:24px">
<!-- wp:paragraph {"fontSize":"small","style":{"typography":{"fontStyle":"italic"}}} -->
<p class="has-small-font-size" style="font-style:italic">« Citation du client à compléter. »</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small","textColor":"teal-900","style":{"typography":{"fontWeight":"700"}}} -->
<p class="has-teal-900-color has-text-color has-small-font-size" style="font-weight:700">Nom, fonction — à compléter (ou à retirer tout le bloc si pas d'avis disponible)</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
