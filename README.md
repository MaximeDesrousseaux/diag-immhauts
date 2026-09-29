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
| `scss/pages/` | `_accueil`, `_fiche`, `_nos-diagnostics`, `_simulateur` |

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
`popup.js` (demande de rappel), `avis.js` (flèches du carrousel des avis, maquettes v9). Rien du runtime des maquettes (`support.js`, `DCLogic`) n'est porté ;
tout le reste est du PHP + CSS.

## Réglages

Les gabarits lisent les réglages globaux via `dih_option( 'cle' )` (thème, `inc/options.php`).
Tant que la page d'options ACF n'est pas branchée, chaque réglage prend sa valeur par défaut.

## Arbitrages (écarts entre maquette et README de passation)

| Sujet | Choix retenu |
|---|---|
| Header entre 901 et 1060 px | Comme la maquette : téléphone et pastille ronde du CTA restent visibles jusqu'à 901 px |
| Bouton d'appel fixe (déplié et mobile) | Sans bordure, comme la maquette |
| Rubrique en cours dans la nav | Maquettes v9 : même couleur que les autres items, seulement en gras (600) — jamais `--tech` |
| Fiches diagnostics | Pages WordPress avec le gabarit « Fiche diagnostic » (pas de CPT) |
| Actualités | Articles WordPress standard (`home.php` / `single.php`) |
| Espacements hors échelle dans la maquette (18, 20, 28, 30, 36 px…) | Arrondis au cran le plus proche de l'échelle 4·8·12·16·24·40·56 ; écart ≤ 18 px par section, mesuré en 1440 / 820 / 390 |
| Réglages « VERROUILLÉS » (hero de l'accueil, Nos diagnostics en bureau et déplié) | Repris tels quels, marqués `// échelle : exception (…)` pour le vérificateur |
| Titre des heros de fiche | Formule de la maquette `clamp(30px, 3.1vw, 42px)` conservée (exception déclarée) |
| Rayons 12 et 22 px de la maquette | Ramenés aux jetons 10 et 26 px (Audit SCSS) |
| Fond de l'accueil `#E5F2D4` et couleurs du champ « Vérifier ma commune » | Jeton `$vert-brume` ; pastilles oui / limite prises dans la palette (`$pastille-jaune`, `$pastille-orange`) |
| Card DTG de « Nos diagnostics » | Illustration `ill_syndic_ssfond` de la maquette, pas `diag_dtg` (le jeu v10 ne couvre que heros et cards standard) |
| Bloc rappel de « Nos diagnostics » | Les boutons ne s'affichent pas dans la maquette (bogue `ctaCallFirst` / `ctaFormFirst`) : règle du README appliquée, formulaire puis appel |
| Pictos des 4 étapes de « Nos diagnostics » | La maquette pointe vers `uploads/ill_stb_*.png`, absents : le thème sert `img/ill_stb_*.webp` |
| Bloc rappel de la fiche DPE | Garde ses boutons propres (« obligations ») ; les autres fiches suivent la règle v10 formulaire / appel |
| Avis clients de l'accueil | Textes provisoires de la maquette, à remplacer par les vrais avis (étape 5, ACF) |
| Formulaires | Emplacement balisé tant que Fluent Forms n'est pas installé |
| Liens `#rappel` (FAQ, CTA de section) | Ouvrent la popup de rappel, comme le script des maquettes ; sans JS, ils descendent au bloc « rappel » |
| Illustrations des résultats du simulateur | La maquette les retourne en miroir (`scaleX(-1)`) : supprimé, conformément au README v10 (aucun miroir CSS) |
| Note « Cette liste est indicative » du simulateur | Placée dans le panneau vert du dossier, comme la maquette |
| Pastilles du simulateur (13,5 et 11,5 px, écart 9 et 6 px) | 14 et 12,5 px, écart 8 et 4 px (échelles) ; titre du hero sur téléphone en 30 px conservé (exception) |
| Statuts « Selon situation » et « Recommandé » | Teintes dérivées de la palette (`--warm`, `--line`, `--forest`) au lieu de `#f6e6b4` / `#6b4d11` / `#3f5c46` |

## Dépendances

- **ACF Pro** : blocs éditables et page « Personnalisation ».
- **Fluent Forms Pro** : formulaires (rappel, devis, contact) + Cloudflare Turnstile ; envoi via Brevo.

Sans elles, rien ne plante : un message d'administration signale ce qui manque et les formulaires
laissent un emplacement balisé.
