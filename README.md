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

Architecture (d'après `Audit code SCSS.dc.html`) :

| Dossier | Contenu |
|---|---|
| `scss/abstracts/` | tokens, fonctions (`c()`, `t()`), mixins (`bp()`, survols) |
| `scss/base/` | polices, custom properties `:root`, reset, typographie |
| `scss/layout/` | header et nav, pied de page, heros |
| `scss/composants/` | boutons, popup, bouton d'appel… |
| `scss/pages/` | ce qui n'existe que sur une page |

Points de rupture : `@include bp(deplie)` (≤ 900 px), `bp(mobile)` (≤ 640 px),
`bp(compact)` (≤ 1232 px), `bp(bureau)` (> 900 px).

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
