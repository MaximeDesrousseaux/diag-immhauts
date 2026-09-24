# Diag Imm'Hauts — site WordPress

Thème sur mesure et plugin maison du site de Diag Imm'Hauts (diagnostiqueur immobilier, Pas-de-Calais),
construits à partir des maquettes de `design_handoff_theme_wp/` (spécification : `README.md` de ce dossier).

```
theme/diag-immhauts/        thème classique PHP + SCSS (Dart Sass), JS natif
plugin/diag-immhauts-core/  CPT, blocs ACF, page d'options, intégration Fluent Forms
design_handoff_theme_wp/    maquettes .dc.html (référence visuelle, non embarquées)
outils/installer.ps1        liens vers le site LocalWP + compilation
```

## Installation locale (Windows, LocalWP)

```powershell
powershell -ExecutionPolicy Bypass -File .\outils\installer.ps1
```

Le script relie `theme\diag-immhauts` et `plugin\diag-immhauts-core` au site
`C:\Users\Irfannn\Local Sites\diag-immhauts\app\public` (lien symbolique, ou jonction
sans droits admin), puis lance `npm install` et `npm run build` dans le thème.
Activer ensuite le thème « Diag Imm'Hauts » et le plugin « Diag Imm'Hauts — Cœur ».

## SCSS

```powershell
cd theme\diag-immhauts
npm run build   # style.css compressé (versionné : le serveur n'a pas besoin de Node)
npm run watch   # recompile à chaque enregistrement, avec carte de sources
```

Architecture : celle de `Audit code SCSS.dc.html` (7-1 allégée), sans échelle ni nommage parallèle.

| Dossier | Contenu |
|---|---|
| `scss/abstracts/` | `_tokens` (couleurs, texte, espaces, rayons, 3 élévations), `_functions` (`rem()`, `teinte()`, `c()`), `_mixins` (`bp()`, focus, 6 survols) |
| `scss/base/` | `_reset` (+ custom properties `:root`), `_typographie` (polices, titres, surtitre), `_utilitaires` |
| `scss/layout/` | `_entete`, `_pied`, `_hero` |
| `scss/composants/` | `_bouton`, `_card`, `_pastille`, `_chiffre`, `_etapes`, `_faq`, `_formulaire`, `_etiquette`, `_frise`, `_article` |
| `scss/pages/` | `_accueil`, `_fiche`, `_simulateur` |

- **Nommage** : `c-` pour les composants, `l-` pour les mises en page, en BEM
  (`.c-card`, `.c-card__titre`, `.c-card--vignette`). États : `is-…`. Réglages globaux : attributs
  `data-*` sur le `body` (`[data-boutons="arrondi"]`, `[data-decor="grille"]`, `[data-logo]`).
- **Bascules** : `@include bp(deplie)` (≤ 900 px), `bp(mobile)` (≤ 640 px), et leurs combinaisons
  `bp(deplie-seul)` / `bp(bureau)`. Les seuils 1232 / 1140 / 1060 px du header compact vivent
  dans `layout/_entete.scss` seulement (`entete-bp()`).
- **Échelles**, vérifiées à chaque `npm run build` par `outils/verifier-echelles.mjs` :
  texte `rem(11 · 12,5 · 14 · 15,5 · 17 · 19 · 22 · 26)` (+ 34 d'affichage, 10 d'accent) ;
  gouttières (`gap`, `margin`) `4 · 8 · 12 · 16 · 24 · 40 · 56` (+ 72 · 96 dans les `clamp()`) ;
  rayons `4 · 10 · 16 · 26 · 44` + `999px`. Une valeur volontairement hors échelle porte
  `// échelle : exception (raison)`.

## JS

JS natif, un fichier par module, dans `assets/js/` : `nav.js` (nav transparente + burger),
`glide.js` (défilement d'ancre), `commune.js` (« Vérifier ma commune »), `simulateur.js`,
`popup.js` (demande de rappel). Rien du runtime des maquettes (`support.js`, `DCLogic`) n'est porté ;
tout le reste est du PHP + CSS.

## Réglages

Les gabarits lisent les réglages globaux via `dih_option( 'cle' )` (thème, `inc/options.php`).
Tant que la page d'options ACF n'est pas branchée, chaque réglage prend sa valeur par défaut.

## Arbitrages (écarts entre maquette et README de passation)

| Sujet | Choix retenu |
|---|---|
| Header entre 901 et 1060 px | Comme la maquette : téléphone et pastille ronde du CTA restent visibles jusqu'à 901 px |
| Bouton d'appel fixe (déplié et mobile) | Sans bordure, comme la maquette |
| Rubrique en cours sur nav blanche | Vert foncé (`--forest`) en gras, pour le contraste (`--tech` sur blanc : 2,3:1) |
| Fiches diagnostics | Pages WordPress avec le gabarit « Fiche diagnostic » (pas de CPT) |
| Actualités | Articles WordPress standard (`home.php` / `single.php`) |

## Dépendances

- **ACF Pro** : blocs éditables et page « Personnalisation ».
- **Fluent Forms Pro** : formulaires (rappel, devis, contact) + Cloudflare Turnstile ; envoi via Brevo.

Sans elles, rien ne plante : un message d'administration signale ce qui manque et les formulaires
laissent un emplacement balisé.
