/**
 * Menu mobile — burger + sous-menus (10.09.2026)
 *
 * Vanilla JS, sans dépendance, cohérent avec le reste du thème (pas de
 * framework côté client). Deux rôles :
 *  1. Bascule le panneau mobile (.dov-mobile-nav) via le bouton burger
 *     (.dov-burger), en pilotant aria-expanded plutôt qu'une classe seule.
 *  2. En dessous de 900px, le survol (:hover) ne fonctionnant pas au
 *     toucher, le petit caret de chaque sous-menu (.dov-nav-caret) devient
 *     cliquable pour ouvrir/fermer le sous-menu sans suivre le lien —
 *     le libellé lui-même continue de naviguer normalement.
 */
(function () {
	document.addEventListener('DOMContentLoaded', function () {
		var burger = document.querySelector('.dov-burger');
		var nav = document.querySelector('.dov-mobile-nav');
		if (!burger || !nav) {
			return;
		}

		function closeNav() {
			nav.classList.remove('is-open');
			burger.setAttribute('aria-expanded', 'false');
		}

		function openNav() {
			nav.classList.add('is-open');
			burger.setAttribute('aria-expanded', 'true');
		}

		burger.addEventListener('click', function () {
			if (nav.classList.contains('is-open')) {
				closeNav();
			} else {
				openNav();
			}
		});

		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape') {
				closeNav();
			}
		});

		// Ferme le panneau mobile quand on suit un lien (mais pas un simple
		// clic sur un caret de sous-menu, géré séparément ci-dessous).
		nav.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function (event) {
				if (event.target.closest('.dov-nav-caret')) {
					return;
				}
				closeNav();
			});
		});

		function toggleSubmenu(caret) {
			var item = caret.closest('.dov-nav-item');
			if (!item) {
				return;
			}
			item.classList.toggle('is-submenu-open');
		}

		document.querySelectorAll('.dov-nav-caret').forEach(function (caret) {
			caret.setAttribute('tabindex', '0');
			caret.setAttribute('role', 'button');

			caret.addEventListener('click', function (event) {
				if (window.innerWidth > 900) {
					return; // desktop : le sous-menu s'ouvre au survol
				}
				event.preventDefault();
				event.stopPropagation();
				toggleSubmenu(caret);
			});

			caret.addEventListener('keydown', function (event) {
				if (event.key === 'Enter' || event.key === ' ') {
					event.preventDefault();
					toggleSubmenu(caret);
				}
			});
		});
	});
})();
