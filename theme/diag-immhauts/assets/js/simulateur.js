/**
 * Simulateur « De quoi ai-je besoin ? » : logique 100 % côté client.
 *
 * Lit le formulaire (motif, type de bien, année, précisions), applique les
 * règles de la maquette et recompose le dossier à chaque changement, en
 * mosaïque ou en liste. Les textes viennent du catalogue PHP
 * (inc/contenus/simulateur.php), passé en JSON dans la page.
 */
(function () {
	'use strict';

	var racine = document.querySelector('[data-dih-simulateur]');
	if (!racine) return;

	var form = racine.querySelector('[data-sim-form]');
	var liste = racine.querySelector('[data-sim-liste]');
	var compte = racine.querySelector('[data-sim-compte]');
	var resume = racine.querySelector('[data-sim-resume]');
	var devis = racine.querySelector('[data-sim-devis]');
	var vues = racine.querySelector('[data-sim-vues]');
	var donnees = JSON.parse(racine.querySelector('[data-sim-donnees]').textContent);
	var modeles = {
		mosaique: racine.querySelector('[data-sim-modele="mosaique"]'),
		liste: racine.querySelector('[data-sim-modele="liste"]')
	};

	function lire() {
		var el = form.elements;
		var cases = {};
		['copro', 'elec', 'gaz', 'termites', 'merule', 'anc'].forEach(function (nom) {
			cases[nom] = !!(el[nom] && el[nom].checked);
		});
		return { motif: el.motif.value, type: el.type.value, annee: el.annee.value, cases: cases };
	}

	// Règles de la maquette (« Simulateur diagnostics »), dans son ordre d'affichage.
	function regles(e) {
		var c = e.cases;
		var habitation = e.type === 'Appartement' || e.type === 'Maison' || e.type === 'Immeuble';
		var av49 = e.annee === 'Avant 1949';
		var av97 = av49 || e.annee === '1949 – 1996';
		var vente = e.motif === 'Vente';
		var loc = e.motif === 'Location';
		var trav = e.motif === 'Travaux / démolition';
		var ids = [];

		if (!trav) ids.push('dpe', 'erp');
		if (av97) ids.push(trav ? 'amiante-travaux' : 'amiante');
		if (av49 && habitation && !trav) ids.push('plomb');
		if (av49 && trav) ids.push('plomb-travaux');
		if (habitation && !trav && c.elec) ids.push('electricite');
		if (habitation && !trav && c.gaz) ids.push('gaz');
		if (!trav && e.type === 'Appartement' && c.copro) ids.push(vente ? 'carrez' : 'boutin');
		if (!trav && e.type === 'Maison' && loc) ids.push('boutin-maison');
		if (vente && c.termites) ids.push('termites');
		if (vente && c.merule) ids.push('merule');
		if (vente && c.anc) ids.push('assainissement');
		if (vente && (e.type === 'Maison' || e.type === 'Immeuble')) ids.push('audit');
		if (e.type === 'Immeuble' && !trav) ids.push('dtg');
		if (e.type === 'Local commercial' && !trav) ids.push('tertiaire');
		return ids;
	}

	// Un texte peut dépendre du motif : { vente, location }.
	function selon(valeur, motif) {
		if (typeof valeur === 'string') return valeur;
		return motif === 'Location' ? valeur.location : valeur.vente;
	}

	function pluriel(n, mot) {
		return n + ' ' + mot + (n > 1 ? 's' : '');
	}

	function carte(id, e, vue) {
		var d = donnees.catalogue[id];
		var el = modeles[vue].content.firstElementChild.cloneNode(true);
		var champ = function (nom) { return el.querySelector('[data-champ="' + nom + '"]'); };
		el.href = d.url;
		el.setAttribute('data-statut', d.statut);
		champ('titre').textContent = d.titre;
		champ('validite').textContent = selon(d.validite, e.motif);
		champ('texte').textContent = selon(d.texte, e.motif);
		champ('statut').textContent = donnees.statuts[d.statut];
		var illus = champ('illus');
		if (d.illus) {
			illus.hidden = false;
			illus.style.backgroundImage = 'url("' + d.illus + '")';
		} else {
			illus.hidden = true;
		}
		return el;
	}

	function rendre() {
		var e = lire();
		var ids = regles(e);
		var vue = racine.getAttribute('data-vue');
		var frag = document.createDocumentFragment();
		ids.forEach(function (id) { frag.appendChild(carte(id, e, vue)); });
		liste.replaceChildren(frag);

		var obl = ids.filter(function (id) { return donnees.catalogue[id].statut === 'obligatoire'; }).length;
		var total = pluriel(ids.length, 'diagnostic');
		compte.textContent = total;
		resume.textContent = pluriel(obl, 'obligatoire') + ' · ' + [e.motif, e.type, e.annee].join(' · ').toLowerCase();
		if (devis) devis.setAttribute('data-dih-rappel-intro', donnees.popup.replace('%s', total));
	}

	form.addEventListener('change', rendre);
	form.addEventListener('reset', function () { setTimeout(rendre, 0); }); // après la remise à zéro native
	form.addEventListener('submit', function (ev) { ev.preventDefault(); });

	// Mosaïque / liste
	vues.hidden = false;
	vues.addEventListener('click', function (ev) {
		var bouton = ev.target.closest('[data-sim-vue]');
		if (!bouton) return;
		var vue = bouton.getAttribute('data-sim-vue');
		if (vue === racine.getAttribute('data-vue')) return;
		racine.setAttribute('data-vue', vue);
		vues.querySelectorAll('[data-sim-vue]').forEach(function (b) {
			b.setAttribute('aria-pressed', String(b === bouton));
		});
		rendre();
	});

	rendre(); // l'état du formulaire peut différer du rendu PHP (retour arrière du navigateur)
})();
