# Consignes pour Claude (sessions desktop et cloud)

Projet : thème WordPress et plugin de Diag Imm'Hauts, construits d'après les maquettes de
`design_handoff_theme_wp/`. Présentation, installation et arbitrages : `README.md` à la racine ;
spécification des maquettes : `design_handoff_theme_wp/README.md` et `NOTES-PROJET.md`.
On échange en français.

## Branches et sessions : `main` fait foi

Le travail alterne entre une session desktop (poste de l'utilisateur, avec la preprod LocalWP)
et des sessions cloud. Pour ne jamais avoir deux lignes de travail en parallèle :

1. **Une seule session active à la fois.** Avant de rendre la main, tout est commité et poussé.
2. **En début de session**, partir de `main` à jour (`git pull`).
3. **En fin de session**, une session qui a travaillé sur une branche `claude/…` l'intègre dans
   `main` (en avance rapide si possible) et pousse `main`. Aucune branche ne doit rester en
   parallèle de `main`.
4. **Session desktop** : la preprod suit la copie de travail locale, qui reste sur `main`
   (`git switch main && git pull --ff-only` en reprenant après une session cloud).

## Commits

- Messages en français, petits et bien nommés : un par étape ou par sujet (ex. « Étape 4c : page
  Professionnels », « Liens #rappel : ouverture de la popup, comme les maquettes »).
- Une nouvelle version des maquettes (« Maquettes 1.x ») se commite **seule**, avant
  l'alignement du thème, lui-même commité à part (« Alignement maquettes 1.x »).
- Ne pas commiter le dossier `design_handoff_theme_wp/` en cours de modification par Claude Design
  sans le feu vert de l'utilisateur.

## Règles de travail

- **Maquette ou README ?** En cas de doute, ne pas trancher en silence : consigner le choix dans le
  tableau « Arbitrages » du `README.md` racine.
- **Textes à la lettre**, y compris les espaces insécables et les apostrophes des maquettes
  (`wptexturize` est désactivé). Chiffres et délais : section « Contenus arrêtés » du README des
  maquettes.
- **SCSS** : échelles et architecture de `Audit code SCSS.dc.html` ; `npm run build` dans
  `theme/diag-immhauts` vérifie les échelles (`outils/verifier-echelles.mjs`) et produit
  `style.css`, qui est versionné. Toute valeur hors échelle porte `// échelle : exception (raison)`.
- **JS** : natif, un fichier par module, jamais le code des maquettes (`DCLogic`, `support.js`).
- **Nav** : partie la plus fine (transparence, bascule au défilement, menus déroulants, page en
  cours) ; la revérifier après toute modification du header.
- **Vérification** : comparer chaque page aux maquettes en 1440, 820 et 390 px (hauteurs de
  sections mesurées dans le navigateur), et le signaler quand un écart dépasse ~18 px.
- Demander confirmation avant toute action irréversible ou visible de l'extérieur (envoi réel de
  formulaire, suppression de données, suppression de branche).
