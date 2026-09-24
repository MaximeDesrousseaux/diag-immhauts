/**
 * Header épinglé et nav transparente (README § Header et nav transparente).
 *
 * - Le header est en position: fixed ; sa hauteur est exposée en --nvH sur :root.
 *   Le hero (1re section .dih-hero) remonte dessous : margin-top -H, padding-top + H.
 * - Nav transparente en haut de page, blanche (.is-solid) au défilement,
 *   PAR ÉVÉNEMENT et non par distance :
 *     bureau : au 2e cran de molette ; déplié et mobile : au 1er cran ou dès scrollY > 0 ;
 *     repli à y > 220 px en bureau (clavier, barre de défilement) ;
 *     crans de pavé tactile regroupés par fenêtres de 140 ms.
 * - Un seul état fait foi (solide), réconcilié à chaque image : si scrollY <= 0,
 *   la nav redevient transparente (aucun événement scroll n'est garanti au retour).
 * - Burger ouvert : nav forcée en blanc. Page sans hero : nav toujours blanche.
 * - Le CTA du header reste caché tant que le CTA vert du hero est visible.
 */
(function () {
	'use strict';

	var hdr = document.querySelector('[data-dih-hdr]');
	if (!hdr) return;

	var root = document.documentElement;
	var mqEtroit = window.matchMedia('(max-width: 900px)');
	var hero = document.querySelector('.dih-hero');
	var ctaHero = hero ? hero.querySelector('a.dih-cta') : null;
	var ctaHdr = hdr.querySelector('.dih-hdr-cta .dih-cta');
	var burger = hdr.querySelector('[data-dih-burger]');
	var panneau = document.getElementById('dih-burger-panel');

	var solide = false;
	var crans = 0;
	var dernierCran = 0;
	var raf = 0;
	var burgerOuvert = false;
	var hauteur = 0;

	function etroit() { return mqEtroit.matches; }

	function mesurer() {
		var h = hdr.offsetHeight;
		if (h && h !== hauteur) {
			hauteur = h;
			root.style.setProperty('--nvH', h + 'px');
		}
	}

	function peindre() {
		raf = 0;
		if ((window.scrollY || 0) <= 0) { crans = 0; solide = false; }
		var t = !hero || solide || burgerOuvert;
		hdr.classList.toggle('is-solid', t);

		if (ctaHdr) {
			var parti = ctaHero ? ctaHero.getBoundingClientRect().bottom < hauteur + 8 : true;
			hdr.classList.toggle('dih-hdr--cta-cache', !parti);
		}
	}

	function planifier() { if (!raf) raf = requestAnimationFrame(peindre); }

	// Changement d'état : peint SYNCHRONEMENT (rAF en attente annulé).
	function fixer(v) {
		if (solide === v) return;
		solide = v;
		if (raf) { cancelAnimationFrame(raf); raf = 0; }
		peindre();
	}

	window.addEventListener('wheel', function (e) {
		if (e.deltaY <= 0) return;
		var maintenant = Date.now();
		if (maintenant - dernierCran < 140) { dernierCran = maintenant; return; }
		dernierCran = maintenant;
		crans += 1;
		if (crans >= (etroit() ? 1 : 2)) fixer(true);
	}, { passive: true });

	window.addEventListener('scroll', function () {
		var y = window.scrollY || 0;
		if (y <= 0) { crans = 0; fixer(false); }
		else if (y > (etroit() ? 0 : 220)) { crans = Math.max(crans, 2); fixer(true); }
		planifier();
	}, { passive: true });

	window.addEventListener('resize', function () { mesurer(); planifier(); }, { passive: true });

	if ('ResizeObserver' in window) {
		new ResizeObserver(function () { mesurer(); planifier(); }).observe(hdr);
	}
	if (document.fonts && document.fonts.ready) {
		document.fonts.ready.then(function () { mesurer(); planifier(); });
	}

	// ---- Burger (déplié et mobile) ------------------------------------------
	var fermeture = 0;

	function ouvrirBurger() {
		clearTimeout(fermeture);
		panneau.classList.remove('dih-panel-out');
		panneau.hidden = false;
		burgerOuvert = true;
		hdr.classList.add('is-burger');
		burger.setAttribute('aria-expanded', 'true');
		peindre();
	}

	function fermerBurger(immediat) {
		if (!burgerOuvert) return;
		burgerOuvert = false;
		hdr.classList.remove('is-burger');
		burger.setAttribute('aria-expanded', 'false');
		var fin = function () {
			panneau.hidden = true;
			panneau.classList.remove('dih-panel-out');
			peindre();
		};
		if (immediat) { fin(); return; }
		panneau.classList.add('dih-panel-out');
		fermeture = setTimeout(fin, 300); // durée de dihFold
	}

	if (burger && panneau) {
		burger.addEventListener('click', function () {
			if (burgerOuvert) fermerBurger(); else ouvrirBurger();
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && burgerOuvert) { fermerBurger(); burger.focus(); }
		});
		mqEtroit.addEventListener('change', function () {
			if (!etroit()) fermerBurger(true);
		});
	}

	// ---- Menus déroulants de bureau ----------------------------------------
	// Ouverture au survol (comme la maquette), au clic sur la zone hors lien,
	// et au clavier via :focus-within (CSS).
	hdr.querySelectorAll('[data-dih-dd]').forEach(function (dd) {
		dd.addEventListener('mouseenter', function () { dd.classList.add('is-open'); });
		dd.addEventListener('mouseleave', function () { dd.classList.remove('is-open'); });
		dd.addEventListener('click', function (e) {
			if (e.target.closest('a[href]')) return;
			dd.classList.toggle('is-open');
		});
	});

	// ---- Démarrage -----------------------------------------------------------
	mesurer();
	peindre();
	// Les transitions ne s'activent qu'après la 1re peinture : pas de fondu au chargement.
	requestAnimationFrame(function () {
		requestAnimationFrame(function () { hdr.classList.add('is-pret'); });
	});
})();
