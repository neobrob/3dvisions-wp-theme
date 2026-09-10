/**
 * Boutons — la fente en mouvement (10.09.2026)
 *
 * Flash de confirmation au clic : ajoute brièvement .is-confirming sur le
 * bouton cliqué (fait briller l'arête .dov-btn__edge, et sur le concept
 * "Rideau" allonge le tick) avant que la navigation ne suive le lien.
 * Voir design-system-web-v1.md, artboard "Boutons — la fente en mouvement".
 */
(function () {
	document.addEventListener('DOMContentLoaded', function () {
		var buttons = document.querySelectorAll('.dov-btn');
		buttons.forEach(function (btn) {
			btn.addEventListener('click', function () {
				btn.classList.add('is-confirming');
				setTimeout(function () {
					btn.classList.remove('is-confirming');
				}, 280);
			});
		});
	});
})();
