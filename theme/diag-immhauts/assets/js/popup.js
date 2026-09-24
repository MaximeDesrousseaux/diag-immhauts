/**
 * Popup « Demande de rappel ».
 * Tout lien [data-dih-rappel] l'ouvre ; sans JS, il mène au formulaire de Contact.
 * Fermeture : bouton ×, clic sur le voile, touche Échap. Le focus revient au lien.
 */
(function () {
	'use strict';

	var popup = document.querySelector('[data-dih-popup]');
	if (!popup) return;

	var boite = popup.querySelector('[data-dih-popup-boite]');
	var declencheur = null;

	function ouvrir(lien) {
		declencheur = lien;
		popup.hidden = false;
		document.documentElement.classList.add('is-popup-ouverte');
		// Focus sur le 1er champ du formulaire, sinon sur la boîte elle-même.
		var champ = boite.querySelector('.c-popup__form input, .c-popup__form select, .c-popup__form textarea');
		(champ || boite).focus({ preventScroll: true });
	}

	function fermer() {
		if (popup.hidden) return;
		popup.hidden = true;
		document.documentElement.classList.remove('is-popup-ouverte');
		if (declencheur) declencheur.focus({ preventScroll: true });
	}

	document.addEventListener('click', function (e) {
		var lien = e.target.closest && e.target.closest('a[data-dih-rappel]');
		if (lien) { e.preventDefault(); ouvrir(lien); return; }
		if (e.target.closest && e.target.closest('[data-dih-popup-fermer]')) { fermer(); return; }
		if (e.target === popup) fermer(); // clic sur le voile
	});

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') fermer();
		// Garde le focus dans la popup (Tab / Maj+Tab).
		if (e.key === 'Tab' && !popup.hidden) {
			var f = boite.querySelectorAll('a[href], button, input, select, textarea, [tabindex]:not([tabindex="-1"])');
			if (!f.length) return;
			var premier = f[0], dernier = f[f.length - 1];
			if (e.shiftKey && document.activeElement === premier) { e.preventDefault(); dernier.focus(); }
			else if (!e.shiftKey && document.activeElement === dernier) { e.preventDefault(); premier.focus(); }
		}
	});
})();
