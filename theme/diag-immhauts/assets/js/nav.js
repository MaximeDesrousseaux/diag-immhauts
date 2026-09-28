/**
 * Header épinglé et nav transparente (README § Header et nav transparente).
 *
 * - Le header est en position: fixed ; sa hauteur est exposée en --nvH sur :root.
 *   Le hero (1re section .l-hero) remonte dessous : margin-top -H, padding-top + H.
 * - Nav transparente en haut de page, blanche (.is-solid) au défilement,
 *   PAR ÉVÉNEMENT et non par distance :
 *     21 pages intérieures, tous formats : au 1er cran de molette ou dès scrollY > 0
 *     (le texte de la nav ne doit jamais passer sur celui du hero) ;
 *     accueil : au 2e cran en bureau (repli à y > 220 px pour le clavier et la barre
 *     de défilement), au 1er cran en déplié et mobile ;
 *     crans de pavé tactile regroupés par fenêtres de 140 ms.
 * - Un seul état fait foi (solide), réconcilié à chaque image : si scrollY <= 0,
 *   la nav redevient transparente (aucun événement scroll n'est garanti au retour).
 * - Burger ouvert : nav forcée en blanc. Page sans hero : nav toujours blanche.
 * - Le CTA du header reste caché tant que le CTA vert du hero est visible.
 * - Accueil sur téléphone (.l-entete--accueil) : le header est la barre du hero.
 *   Sur les 170 premiers px de défilement, le logo glisse du centre vers la
 *   gouttière (échelle 1 → 0,68) et le fond blanc apparaît, en continu :
 *   --p (progression lissée), --tx et --s sont posés à chaque image.
 */
(function () {
	'use strict';

	var hdr = document.querySelector('[data-dih-hdr]');
	if (!hdr) return;

	var root = document.documentElement;
	var mqEtroit = window.matchMedia('(max-width: 900px)');
	var mqMobile = window.matchMedia('(max-width: 640px)');
	var accueil = hdr.classList.contains('l-entete--accueil');
	var barre = hdr.querySelector('.l-entete__barre');
	var logo = hdr.querySelector('.l-entete__logo');
	var hero = document.querySelector('.l-hero');
	var ctaHero = hero ? hero.querySelector('a.c-btn') : null;
	var ctaHdr = hdr.querySelector('.l-entete__cta .c-btn');
	var burger = hdr.querySelector('[data-dih-burger]');
	var panneau = document.getElementById('menu-burger');

	var solide = false;
	var crans = 0;
	var dernierCran = 0;
	var raf = 0;
	var burgerOuvert = false;
	var hauteur = 0;

	function etroit() { return mqEtroit.matches; }
	// Seuils du passage au blanc : seul l'accueil en bureau attend le 2e cran.
	function cransRequis() { return accueil && !etroit() ? 2 : 1; }
	function repli() { return accueil && !etroit() ? 220 : 0; }
	function modeBarre() { return accueil && mqMobile.matches; }

	// Barre du hero de l'accueil (téléphone) : état continu, pas de .is-solid.
	function peindreBarre() {
		var p = Math.max(0, Math.min(1, (window.scrollY || 0) / 170));
		var ease = p * p * (3 - 2 * p);
		var s = 1 - 0.32 * ease;
		var cw = barre.getBoundingClientRect().width;
		var lw = logo.offsetWidth || 1;
		var tx = 16 - (cw - 52 - lw) / 2 - (lw * (1 - s)) / 2;
		hdr.style.setProperty('--p', ease.toFixed(3));
		hdr.style.setProperty('--tx', (tx * ease).toFixed(2) + 'px');
		hdr.style.setProperty('--s', s.toFixed(3));
	}

	function effacerBarre() {
		hdr.style.removeProperty('--p');
		hdr.style.removeProperty('--tx');
		hdr.style.removeProperty('--s');
	}

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
		if (modeBarre()) {
			peindreBarre();
			hdr.classList.toggle('is-solid', burgerOuvert);
			return;
		}
		var t = !hero || solide || burgerOuvert;
		hdr.classList.toggle('is-solid', t);
		if (solide && !veille) veille = requestAnimationFrame(veiller);

		if (ctaHdr) {
			var parti = ctaHero ? ctaHero.getBoundingClientRect().bottom < hauteur + 8 : true;
			hdr.classList.toggle('l-entete--cta-cache', !parti);
		}
	}

	function planifier() { if (!raf) raf = requestAnimationFrame(peindre); }

	// Réconciliation à chaque image tant que la nav est blanche : le retour en haut
	// ne garantit aucun événement scroll. La boucle s'arrête dès la nav transparente.
	var veille = 0;
	function veiller() {
		veille = 0;
		if (!solide) return;
		if ((window.scrollY || 0) <= 0) { fixer(false); return; }
		veille = requestAnimationFrame(veiller);
	}

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
		if (crans >= cransRequis()) fixer(true);
	}, { passive: true });

	window.addEventListener('scroll', function () {
		var y = window.scrollY || 0;
		if (y <= 0) { crans = 0; fixer(false); }
		else if (y > repli()) { crans = Math.max(crans, 2); fixer(true); }
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
		panneau.classList.remove('is-sortie');
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
			panneau.classList.remove('is-sortie');
			peindre();
		};
		if (immediat) { fin(); return; }
		panneau.classList.add('is-sortie');
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
		mqMobile.addEventListener('change', function () {
			if (!modeBarre()) effacerBarre();
			mesurer();
			peindre();
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
