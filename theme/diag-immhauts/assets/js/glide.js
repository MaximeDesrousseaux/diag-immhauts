/**
 * Défilement vers une ancre : glide(id), 1,2 s, ease-in-out (cubique),
 * déclenché dès le pointerdown. Jamais scroll-behavior: smooth, dont la durée
 * n'est pas réglable (README § Défilement vers une ancre).
 *
 * S'applique aux liens internes a[href^="#"] dont la cible existe
 * (hors liens de la popup de rappel). Exposé en window.dihGlide(id).
 */
(function () {
	'use strict';

	var DUREE = 1200;
	var DECALAGE = 72; // la cible s'arrête 72 px sous le haut de la fenêtre (maquette)
	var raf = 0;
	var dejaParti = null;

	function easeInOutCubic(p) {
		return p < 0.5 ? 4 * p * p * p : 1 - Math.pow(-2 * p + 2, 3) / 2;
	}

	function glide(id) {
		var el = document.getElementById(id);
		if (!el) return false;
		var box = document.scrollingElement || document.documentElement;
		var depart = box.scrollTop;
		var arrivee = Math.max(0, depart + el.getBoundingClientRect().top - DECALAGE);
		if (Math.abs(arrivee - depart) < 2) return true;
		if (raf) cancelAnimationFrame(raf);
		if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			box.scrollTop = arrivee;
			return true;
		}
		var t0 = performance.now();
		var pas = function (maintenant) {
			var p = Math.min(1, (maintenant - t0) / DUREE);
			box.scrollTop = depart + (arrivee - depart) * easeInOutCubic(p);
			if (p < 1) raf = requestAnimationFrame(pas);
		};
		raf = requestAnimationFrame(pas);
		return true;
	}

	function cible(e) {
		var a = e.target.closest && e.target.closest('a[href^="#"]');
		if (!a || a.hasAttribute('data-dih-rappel')) return null;
		var id = decodeURIComponent(a.getAttribute('href').slice(1));
		return id && document.getElementById(id) ? { lien: a, id: id } : null;
	}

	document.addEventListener('pointerdown', function (e) {
		if (e.button !== 0) return;
		var c = cible(e);
		if (c && glide(c.id)) dejaParti = c.lien;
	}, true);

	document.addEventListener('click', function (e) {
		var c = cible(e);
		if (!c) return;
		e.preventDefault();
		if (dejaParti === c.lien) { dejaParti = null; return; }
		glide(c.id); // clavier (Entrée) : pas de pointerdown
	});

	window.dihGlide = glide;
})();
