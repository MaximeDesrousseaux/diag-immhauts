/**
 * Formulaires Fluent Forms (inc/formulaires.php) — comportements des maquettes.
 *
 * - Haut de l'accueil : un seul formulaire par page, placé dans la zone visible
 *   ([data-dih-form-place]) : barre de rappel sur ordinateur, carte sur téléphone.
 * - Haut de l'accueil : message au texte court (« Votre message (facultatif) ») et
 *   sur deux lignes en déplié et sur téléphone (maquette : heroMsgPlaceholder).
 * - Devis : suggestions du champ « Commune ou code postal » dès 2 caractères,
 *   8 au plus (début du nom ou du code postal, puis nom qui contient la saisie),
 *   tirées des secteurs habituels (plugin, donnees/communes.json) ; un clic remplit
 *   « Commune (code) ». Sans suggestion, la saisie reste libre.
 */
(function () {
	'use strict';

	var deplie = window.matchMedia('(max-width: 900px)');
	var mobile = window.matchMedia('(max-width: 640px)');

	function surBascule(fn) {
		[deplie, mobile].forEach(function (mq) {
			if (mq.addEventListener) mq.addEventListener('change', fn);
			else if (mq.addListener) mq.addListener(fn);
		});
	}

	// --- Placement du formulaire du haut de l'accueil ---------------------------------
	var places = document.querySelectorAll('[data-dih-form-place]');
	if (places.length > 1) {
		var placer = function () {
			var cle = places[0].getAttribute('data-dih-form-place');
			var form = document.querySelector('.c-form[data-dih-form="' + cle + '"]');
			if (!form) return;
			for (var i = 0; i < places.length; i++) {
				// Zone visible : ses ancêtres ne sont pas en display: none.
				if (places[i].getClientRects().length) {
					if (form.parentElement !== places[i]) places[i].appendChild(form);
					return;
				}
			}
		};
		placer();
		surBascule(placer);
	}

	// --- Message court du haut de l'accueil ------------------------------------------
	var messages = document.querySelectorAll('textarea[data-court]');
	if (messages.length) {
		var ajuster = function () {
			for (var i = 0; i < messages.length; i++) {
				var t = messages[i];
				if (!t.hasAttribute('data-long')) t.setAttribute('data-long', t.placeholder);
				t.placeholder = deplie.matches ? t.getAttribute('data-court') : t.getAttribute('data-long');
				t.rows = deplie.matches ? 2 : 3;
			}
		};
		ajuster();
		surBascule(ajuster);
	}

	// --- Suggestions de communes du devis ---------------------------------------------
	var champs = document.querySelectorAll('input[data-dih-communes]');
	Array.prototype.forEach.call(champs, function (saisie) {
		var secteurs = null;
		var chargement = null;
		var actif = -1;
		var NBSP = ' ';

		var liste = document.createElement('div');
		liste.className = 'c-form__suggestions';
		liste.id = saisie.id + '-suggestions';
		liste.setAttribute('role', 'listbox');
		liste.hidden = true;
		saisie.parentElement.classList.add('c-form__communes');
		saisie.parentElement.appendChild(liste);
		saisie.setAttribute('role', 'combobox');
		saisie.setAttribute('aria-autocomplete', 'list');
		saisie.setAttribute('aria-controls', liste.id);
		saisie.setAttribute('aria-expanded', 'false');

		function charger() {
			if (chargement) return chargement;
			chargement = fetch(saisie.getAttribute('data-dih-communes'), { credentials: 'same-origin' })
				.then(function (r) { return r.ok ? r.json() : null; })
				.then(function (d) { secteurs = d && d.secteurs ? d.secteurs : []; })
				.catch(function () { secteurs = []; });
			return chargement;
		}

		function norm(s) {
			return (s || '').toLowerCase().normalize('NFD')
				.replace(/[̀-ͯ]/g, '').replace(/[^a-z0-9]/g, '');
		}

		function fermer() {
			liste.hidden = true;
			liste.textContent = '';
			actif = -1;
			saisie.setAttribute('aria-expanded', 'false');
			saisie.removeAttribute('aria-activedescendant');
		}

		function marquer(i) {
			var options = liste.querySelectorAll('[role="option"]');
			if (!options.length) return;
			actif = (i + options.length) % options.length;
			for (var k = 0; k < options.length; k++) options[k].classList.toggle('is-actif', k === actif);
			saisie.setAttribute('aria-activedescendant', options[actif].id);
		}

		function choisir(option) {
			saisie.value = option.getAttribute('data-valeur');
			saisie.dispatchEvent(new Event('change', { bubbles: true }));
			fermer();
		}

		function suggerer() {
			var q = norm(saisie.value);
			fermer();
			if (!secteurs || q.length < 2) return;
			var debut = secteurs.filter(function (c) { return norm(c[0]).indexOf(q) === 0 || c[1].indexOf(q) === 0; });
			var dedans = secteurs.filter(function (c) { return debut.indexOf(c) < 0 && norm(c[0]).indexOf(q) > 0; });
			var trouves = debut.concat(dedans).slice(0, 8);

			if (!trouves.length) {
				var vide = document.createElement('div');
				vide.className = 'c-form__suggestion-vide';
				vide.textContent = 'Aucune suggestion' + NBSP + ': saisissez librement votre commune, toute la France est acceptée.';
				liste.appendChild(vide);
			}
			trouves.forEach(function (c, i) {
				var o = document.createElement('div');
				o.className = 'c-form__suggestion';
				o.id = liste.id + '-' + i;
				o.setAttribute('role', 'option');
				o.setAttribute('data-valeur', c[0] + ' (' + c[1] + ')');
				var nom = document.createElement('span');
				nom.textContent = c[0];
				var cp = document.createElement('span');
				cp.className = 'c-form__suggestion-cp';
				cp.textContent = c[1];
				o.appendChild(nom);
				o.appendChild(cp);
				liste.appendChild(o);
			});
			liste.hidden = false;
			saisie.setAttribute('aria-expanded', 'true');
		}

		saisie.addEventListener('focus', charger);
		saisie.addEventListener('input', function () { charger().then(suggerer); });
		saisie.addEventListener('blur', function () { setTimeout(fermer, 130); });
		saisie.addEventListener('keydown', function (e) {
			if (liste.hidden) return;
			if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
				e.preventDefault();
				marquer(actif + (e.key === 'ArrowDown' ? 1 : -1));
			} else if (e.key === 'Enter' && actif >= 0) {
				e.preventDefault();
				choisir(liste.querySelectorAll('[role="option"]')[actif]);
			} else if (e.key === 'Escape') {
				fermer();
			}
		});
		// mousedown : avant le blur du champ, qui fermerait la liste.
		liste.addEventListener('mousedown', function (e) {
			var o = e.target.closest('[role="option"]');
			if (!o) return;
			e.preventDefault();
			choisir(o);
		});
	});
})();
