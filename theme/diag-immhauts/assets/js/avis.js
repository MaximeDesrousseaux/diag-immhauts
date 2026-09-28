/**
 * Carrousel des avis (accueil) — README § Header, « Carrousel des avis ».
 *
 * Le défilement horizontal et l'aimantation sont en CSS (scroll-snap). Ce module
 * ne fait que piloter les deux flèches (bureau et tablette) :
 * - un clic avance ou recule d'une card (largeur de la card + gouttière) ;
 * - en début de liste la flèche gauche est désactivée (grisée à 0,3 en CSS),
 *   en fin de liste la droite, avec une marge de 24 px ; l'état suit le scroll.
 */
(function () {
	'use strict';

	var bloc = document.querySelector('[data-dih-avis]');
	if (!bloc) return;

	var liste = bloc.querySelector('.l-avis__liste');
	var prec = bloc.querySelector('[data-dih-avis-dir="-1"]');
	var suiv = bloc.querySelector('[data-dih-avis-dir="1"]');
	if (!liste || !prec || !suiv) return;

	var MARGE = 24;
	var raf = 0;

	function synchroniser() {
		raf = 0;
		var x = liste.scrollLeft;
		prec.disabled = x <= MARGE;
		suiv.disabled = x >= liste.scrollWidth - liste.clientWidth - MARGE;
	}

	function planifier() { if (!raf) raf = requestAnimationFrame(synchroniser); }

	function pas() {
		var card = liste.firstElementChild;
		var gouttiere = parseFloat(getComputedStyle(liste).columnGap) || 0;
		return card ? card.offsetWidth + gouttiere : liste.clientWidth * 0.8;
	}

	function aller(sens) {
		var reduit = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		liste.scrollBy({ left: sens * pas(), behavior: reduit ? 'auto' : 'smooth' });
	}

	prec.addEventListener('click', function () { aller(-1); });
	suiv.addEventListener('click', function () { aller(1); });
	liste.addEventListener('scroll', planifier, { passive: true });
	window.addEventListener('resize', planifier, { passive: true });

	synchroniser();
})();
