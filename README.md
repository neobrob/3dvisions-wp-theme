# Thème WordPress — 3D Visions Designs

Thème block (FSE — Full Site Editing) sur-mesure pour `new.3dvisions.ch`, construit à partir
du design system et du storybook validés dans le projet Claude (teal + noir/blanc,
Inter + Bai Jamjuree). Pas de page builder générique (Divi/Elementor) — décision prise le
09.09.2026, voir `architecture-technique-wordpress.md` dans le projet.

## Où en est ce dossier

Squelette de départ seulement : `theme.json` (couleurs, typographies, tailles — repris du
design system) + `functions.php` (déclare les taxonomies Prestation/Secteur et le type de
contenu Réalisation) + gabarits vides (`templates/`, `parts/`). Les vrais gabarits (page
d'accueil, page prestation, page secteur, single réalisation) restent à construire à partir
du storybook — prochaine étape.

**Couleur "accent" provisoire** (terre cuite, `#B85C38`, piste A) : le nuancier 2026 définitif
(A/B/C) n'est pas encore choisi. Une fois tranché, mettre à jour la couleur `accent` dans
`theme.json`.

## Workflow

1. **Ce dossier = le thème lui-même**, pas tout WordPress. Il va dans
   `wp-content/themes/3dvisions/` une fois déployé.
2. **Dépôt git** : à créer sur GitHub (ou autre) — voir étapes ci-dessous. Une fois le remote
   ajouté, je peux committer/pousser directement depuis ta machine via la session Claude.
3. **Développement local** : recommandé — installer WordPress en local (ex. l'app "Local" de
   WP Engine, gratuite, sans ligne de commande) pour prévisualiser en construisant, plutôt que
   de tout tester directement sur l'hébergement. Une fois un site local créé, on pointe son
   dossier `wp-content/themes/3dvisions` vers ce dossier-ci (lien symbolique ou copie).
4. **Mise en prod** : une fois un lot de gabarits prêt, transfert vers `new.3dvisions.ch` par
   SFTP (accès déjà disponible) — WordPress n'est pas encore installé sur ce sous-domaine,
   ce sera la première étape côté hébergeur.
5. **Contenu** (Réalisations, textes) : géré séparément via la connexion MCP WordPress, une
   fois le site en place — voir `architecture-technique-wordpress.md`.

## Créer le dépôt GitHub (une fois, à faire par toi)

1. Sur github.com → "New repository" → nom suggéré `3dvisions-wp-theme` → laisser vide (pas
   de README/licence auto-générés, on a déjà les fichiers).
2. Dans ce dossier sur ta machine, ajouter le remote et pousser une première fois :
   ```
   git remote add origin https://github.com/<ton-compte>/3dvisions-wp-theme.git
   git push -u origin main
   ```
   (la première authentification te sera demandée par GitHub — ensuite git s'en souvient,
   je peux committer/pousser sans revoir tes identifiants).

## Prochaines étapes proposées

- Installer WordPress sur `new.3dvisions.ch` (à faire via le panneau de ton hébergeur — dis-moi
  lequel, je peux te guider pas à pas sans toucher moi-même à tes identifiants).
- Installer l'app "Local" (ou équivalent) pour un environnement de dev/preview.
- Construire le vrai template `front-page.html` à partir de la page d'accueil du storybook.
- Ajouter les fichiers de police (Inter, Bai Jamjuree) dans `assets/fonts/`.
