/**
 * « Vérifier ma commune » (accueil, #zones) — README § Fonctions à coder.
 *
 * - Le bouton révèle le champ (volet dihZoneIn) et le met au point.
 * - Suggestions dès 2 caractères, 6 au plus : par début de code postal si la
 *   saisie est numérique, sinon par début de nom (sans accents ni tirets).
 *   Un clic remplit le champ avec le code postal.
 * - Réponse : 62 = oui, 59 et 80 = en limite de zone, autre = hors zone
 *   (avec un lien vers Contact) ; elle nomme la commune quand le code est connu.
 * - La table (plugin diag-immhauts-core, donnees/communes.json) est chargée à la
 *   première ouverture ; sans elle, la réponse se fait sur le code postal seul.
 */
(function () {
	'use strict';

	var bloc = document.querySelector('[data-dih-commune]');
	if (!bloc) return;

	var ouvrir = bloc.querySelector('[data-dih-commune-ouvrir]');
	var champ = bloc.querySelector('.c-commune__champ');
	var form = bloc.querySelector('[data-dih-commune-form]');
	var saisie = form.querySelector('input');
	var liste = bloc.querySelector('.c-commune__suggestions');
	var reponse = bloc.querySelector('.c-commune__reponse');
	var urlContact = bloc.getAttribute('data-contact');

	var table = { codes: {}, communes: {}, zone: { oui: ['62'], limite: ['59', '80'] } };
	var chargement = null;
	var choisi = false;
	var NBSP = ' ';

	function charger() {
		var src = bloc.getAttribute('data-source');
		if (chargement || !src) return chargement;
		chargement = fetch(src, { credentials: 'same-origin' })
			.then(function (r) { return r.ok ? r.json() : null; })
			.then(function (d) { if (d && d.codes) table = d; })
			.catch(function () {});
		return chargement;
	}

	function norm(s) {
		return (s || '').toLowerCase().normalize('NFD')
			.replace(/[̀-ͯ]/g, '').replace(/[^a-z0-9]/g, '');
	}

	function viderListe() {
		liste.hidden = true;
		liste.textContent = '';
		saisie.removeAttribute('aria-activedescendant');
	}

	function suggerer() {
		var q = saisie.value.trim();
		viderListe();
		if (choisi || q.length < 2) return;
		var num = /^\d+$/.test(q);
		var nq = norm(q);
		var codes = Object.keys(table.codes);
		var n = 0;
		for (var i = 0; i < codes.length && n < 6; i++) {
			var code = codes[i];
			var nom = table.codes[code];
			if (num ? code.indexOf(q) !== 0 : norm(nom).indexOf(nq) !== 0) continue;
			var b = document.createElement('button');
			b.type = 'button';
			b.className = 'c-commune__suggestion';
			b.setAttribute('role', 'option');
			b.dataset.code = code;
			var s1 = document.createElement('span');
			s1.className = 'c-commune__nom';
			s1.textContent = nom;
			var s2 = document.createElement('span');
			s2.className = 'c-commune__code';
			s2.textContent = code;
			b.appendChild(s1);
			b.appendChild(s2);
			liste.appendChild(b);
			n++;
		}
		liste.hidden = n === 0;
	}

	function repondre(q) {
		var cp = q.match(/\b\d{5}\b/);
		var ville = cp ? table.codes[cp[0]] : null;
		var lieu = ville ? ville + NBSP + '(' + cp[0] + ')' : null;
		var dep = cp ? cp[0].slice(0, 2) : table.communes[norm(q)];
		var etat;
		var texte;
		if (dep && table.zone.oui.indexOf(dep) !== -1) {
			etat = 'oui';
			texte = (lieu ? 'Oui, j’interviens à ' + lieu : 'Oui, j’interviens dans votre commune')
				+ ' — devis sous 24' + NBSP + 'h ouvrées et rendez-vous sous 48' + NBSP + 'h.';
		} else if (dep && table.zone.limite.indexOf(dep) !== -1) {
			etat = 'limite';
			texte = (lieu ? lieu + ' est en limite' : 'Votre commune est en limite')
				+ ' de ma zone habituelle — le déplacement reste possible selon la date.';
		} else if (dep) {
			etat = 'non';
			texte = (lieu ? lieu + ' est hors' : 'Cette commune est hors') + ' de ma zone d’intervention habituelle.';
		} else {
			etat = 'limite';
			texte = 'Je ne reconnais pas cette commune — indiquez plutôt votre code postal.';
		}

		reponse.textContent = texte;
		if (etat !== 'oui') {
			var a = document.createElement('a');
			a.href = urlContact;
			a.textContent = 'Écrivez-moi';
			reponse.appendChild(document.createTextNode(' '));
			reponse.appendChild(a);
			reponse.appendChild(document.createTextNode(', je vous réponds sous 24' + NBSP + 'h.'));
		}
		reponse.dataset.etat = etat;
		reponse.hidden = false;
	}

	ouvrir.addEventListener('click', function () {
		charger();
		ouvrir.hidden = true;
		champ.hidden = false;
		setTimeout(function () { saisie.focus(); }, 60);
	});

	saisie.addEventListener('input', function () {
		choisi = false;
		reponse.hidden = true;
		var p = charger();
		if (p) p.then(suggerer); else suggerer();
	});

	liste.addEventListener('click', function (e) {
		var b = e.target.closest('.c-commune__suggestion');
		if (!b) return;
		saisie.value = b.dataset.code;
		choisi = true;
		viderListe();
		saisie.focus();
	});

	// Flèches haut / bas dans les suggestions, Échap pour les fermer.
	form.addEventListener('keydown', function (e) {
		var items = liste.hidden ? [] : Array.prototype.slice.call(liste.children);
		if (e.key === 'Escape') { viderListe(); return; }
		if (!items.length || (e.key !== 'ArrowDown' && e.key !== 'ArrowUp')) return;
		e.preventDefault();
		var i = items.indexOf(document.activeElement);
		i = e.key === 'ArrowDown' ? Math.min(items.length - 1, i + 1) : i - 1;
		(i < 0 ? saisie : items[i]).focus();
	});
	liste.addEventListener('keydown', function (e) {
		if (e.key === 'ArrowDown' || e.key === 'ArrowUp' || e.key === 'Escape') {
			form.dispatchEvent(new KeyboardEvent('keydown', { key: e.key, bubbles: false }));
			e.preventDefault();
		}
	});

	form.addEventListener('submit', function (e) {
		e.preventDefault();
		var q = saisie.value.trim();
		if (!q) { reponse.hidden = true; return; }
		choisi = true;
		viderListe();
		var p = charger();
		if (p) p.then(function () { repondre(q); }); else repondre(q);
	});
})();
