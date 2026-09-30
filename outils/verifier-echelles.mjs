#!/usr/bin/env node
/**
 * Vérifie que le SCSS du thème respecte les échelles de l'audit SCSS
 * (design_diagimmhauts_theme_wp/Audit code SCSS.dc.html, « Les échelles appliquées ») :
 *
 *   texte      11 · 12,5 · 14 · 15,5 · 17 · 19 · 22 · 26 px (fixe, via rem())
 *              bornes de clamp() : les 8 pas + 31 · 34 · 36 · 44, ou toute borne ≥ 48 px
 *   gouttières 4 · 8 · 12 · 16 · 24 · 40 · 56 px (+ 72 · 96 dans les clamp())
 *              et 2 px (décalage de filet) — sur gap et margin
 *   rayons     4 · 10 · 16 · 26 · 44 px, 999px (pilule), 50 %
 *
 * Une valeur volontairement hors échelle (README : 10 px d'accent, 14 px de la nav
 * compacte, −9 px des menus, 11 px des listes de préparation, réglages à l'œil des
 * heros verrouillés) porte le commentaire « // échelle : exception (raison) ».
 *
 * Usage : node outils/verifier-echelles.mjs <dossier scss>   (code 1 si écart)
 */
import { readFileSync, readdirSync, statSync } from 'node:fs';
import { join, relative } from 'node:path';

const TEXTE_BORNES = [11, 12.5, 14, 15.5, 17, 19, 22, 26, 31, 34, 36, 44];
const ESPACES = [0, 2, 4, 8, 12, 16, 24, 40, 56, 72, 96];
const RAYONS = [0, 4, 10, 16, 26, 44, 999];

const dossier = process.argv[2] || 'scss';
const fichiers = [];
(function parcourir(d) {
  for (const n of readdirSync(d)) {
    const p = join(d, n);
    if (statSync(p).isDirectory()) parcourir(p);
    else if (p.endsWith('.scss')) fichiers.push(p);
  }
})(dossier);

const ecarts = [];
const pxDans = (v) => [...v.matchAll(/(-?\d*\.?\d+)px/g)].map((m) => Math.abs(parseFloat(m[1])));

for (const f of fichiers) {
  const lignes = readFileSync(f, 'utf8').split(/\r?\n/);
  lignes.forEach((ligne, i) => {
    if (/échelle\s*:\s*exception/i.test(ligne)) return;
    const code = ligne.replace(/\/\/.*$/, '');
    for (const m of code.matchAll(/(?:^|[{;\s])(-{0,2}[a-z][a-z-]*)\s*:\s*([^;{}]+)/g)) {
      const [, prop, valeur] = m;
      let permis = null;
      let quoi = '';
      if (/^(gap|row-gap|column-gap|margin(-[a-z-]+)?)$/.test(prop)) {
        permis = (n) => ESPACES.includes(n);
        quoi = 'gouttière';
      } else if (/^(border(-[a-z]+)*-radius|--r-[a-z-]+)$/.test(prop)) {
        permis = (n) => RAYONS.includes(n);
        quoi = 'rayon';
      } else if (prop === 'font-size') {
        permis = (n) => TEXTE_BORNES.includes(n) || n >= 48;
        quoi = 'taille de texte';
      }
      if (!permis) continue;
      // env(safe-area-inset-*, 0px) : décalage système, pas une valeur de design.
      const nette = valeur.replace(/env\([^)]*\)/g, '');
      const hors = pxDans(nette).filter((n) => !permis(n));
      if (hors.length) {
        ecarts.push(`${relative(process.cwd(), f)}:${i + 1}  ${quoi} hors échelle (${hors.join(', ')} px) → ${ligne.trim()}`);
      }
    }
  });
}

if (ecarts.length) {
  console.error(`Échelles : ${ecarts.length} valeur(s) hors échelle.\n` + ecarts.join('\n'));
  console.error('\nRamener au pas le plus proche, ou marquer « // échelle : exception (raison) ».');
  process.exit(1);
}
console.log(`Échelles : ${fichiers.length} fichiers SCSS conformes.`);
