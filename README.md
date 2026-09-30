# Diag Imm'Hauts — site WordPress

Thème sur mesure et plugin maison du site de Diag Imm'Hauts (diagnostiqueur immobilier, Pas-de-Calais),
construits à partir des maquettes de `design_diagimmhauts_theme_wp/` (spécification : `README.md` de ce dossier).

```
theme/diag-immhauts/           thème classique PHP + SCSS (Dart Sass), JS natif
plugin/diag-immhauts-core/     CPT, blocs ACF, page d'options, intégration Fluent Forms
design_diagimmhauts_theme_wp/  maquettes .dc.html (référence visuelle, non embarquées)
outils/installer.ps1           liens vers le site LocalWP + compilation
outils/image-partage.html      source de l'image de partage (og:image)
outils/importer-*.php          imports WP-CLI : articles du journal, contenus modifiables, formulaires
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
| `scss/composants/` | `_bouton`, `_card`, `_pastille`, `_chiffre`, `_etapes`, `_faq`, `_formulaire`, `_form` (Fluent Forms), `_etiquette`, `_frise`, `_article` |
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

Les gabarits lisent les réglages globaux via `dih_option( 'cle' )` (thème, `inc/options.php`),
et les réglages propres à une page via `dih_option_page( 'cle' )`. Les champs sont déclarés en PHP
par le plugin (`inc/personnalisation.php`, ACF Pro) :

- **Diag Imm'Hauts → Personnalisation** : la page d'options de la maquette `Admin WP - Personnalisation`
  (onglets Identité du site · Accueil · Pages intérieures, choix à vignettes ; mise en forme
  `assets/admin/personnalisation.css`, vignettes WebP dans `assets/admin/`) ;
- **Diag Imm'Hauts → Formulaires** : identifiants Fluent Forms (rappel, devis, compte partenaire),
  renseignés par `outils/importer-formulaires.php` ;
- **Qui suis-je** et **Nos diagnostics** (encart latéral de la page) : citation du parcours, illustration du haut de page.

Sans ACF Pro, ou tant qu'un réglage n'est pas enregistré, chaque réglage prend sa valeur par défaut.

**Contenus modifiables** (plugin, `inc/contenus-modifiables.php`, `inc/textes-pages.php`,
`inc/coordonnees.php`, `inc/messages-formulaires.php`) : ils remplacent les textes du thème
(`inc/contenus/*.php`) section par section, par le filtre `dih_contenu` ; un champ vide garde le texte du thème.

- **Diag Imm'Hauts → Coordonnées** : téléphone (le lien d'appel en est déduit), adresse, e-mail de
  contact, e-mail des mentions légales et du RGPD, lus partout par `dih_info()` (en-tête, pied de page,
  boutons d'appel, Contact, mentions, messages des formulaires, e-mails, données lues par Google).
  L'adresse qui reçoit les formulaires reste celle des notifications de Fluent Forms ;
- **Diag Imm'Hauts → Avis clients** : les avis du carrousel de l'accueil ;
- **Diag Imm'Hauts → Formulaires**, encart « Messages des formulaires » (plugin,
  `inc/messages-formulaires.php`) : message affiché après l'envoi de chaque formulaire (popup, haut
  de l'accueil, devis, compte partenaire), mention à côté du bouton du devis, textes indicatifs du
  formulaire court sur fond vert ; `{telephone}` reprend le numéro des coordonnées ;
- **encart « Questions fréquentes (FAQ) »** des 15 pages qui en ont une (accueil, Nos diagnostics,
  Professionnels, 12 fiches) : question, réponse, lien facultatif ;
- **encart « Fiche diagnostic »** des 12 fiches : pastille, titre (deux lignes) et chapeau du haut de
  page ; chiffre et légende des quatre repères (le picto reste celui de sa position) ;
- **encart « Bloc 4 étapes »** des fiches, de Nos diagnostics et de Qui suis-je : titre et texte des
  étapes (numéros et étiquettes automatiques), liste « À préparer avant ma visite » des fiches ;
- **encart « Textes de la page »** des pages uniques (« Haut de page » pour celles qui n'ont que
  lui), un onglet par section, décrites page par page dans `dih_core_textes()` (plugin,
  `inc/textes-pages.php`) :
  - **haut de page** des six pages uniques (accueil, Nos diagnostics, Professionnels, Qui suis-je,
    Contact, simulateur) : textes du hero, titres gardant le découpage des maquettes, et ses listes
    (chiffres de l'accueil, entrées de Nos diagnostics, promesses de Contact). Sur l'accueil, un texte
    modifié vaut pour les quatre variantes du hero ; un texte resté celui du thème (import) laisse à
    `max-bandeau` et `sansBG` leur 2e ligne et leur chapeau ;
  - **Accueil** : bandeau de confiance (titres et légendes des trois engagements), « À la une »
    (textes et panneau chiffré), prestations (titres et textes des quatre cartes), « Le détail »
    (titres et bouton), « Qui suis-je ? » (textes et quatre valeurs), zones desservies (textes et
    communes en pastilles), bloc final. Pictos, illustrations, teintes et pages liées restent ceux du thème ;
  - **Nos diagnostics** : vente & location (textes et douze cartes : validité, titre, texte,
    condition), copropriétés (textes et quatre cartes), audits énergétiques, bloc final ;
  - **Professionnels** : profils (titre, texte et points de chaque carte), six engagements, packs
    (pastille, titre, texte, diagnostics compris et note de chaque pack), déroulé et son encadré,
    bloc final, popup « Compte partenaire » ;
  - **Qui suis-je** : bandeau de confiance, parcours (paragraphes, frise des années, textes des cinq
    citations — celle affichée se choisit dans l'encart « Qui suis-je »), engagements, certifications
    (garanties et domaines), bloc final ;
  - **Actualités** (page des articles) : haut de page, libellés des articles (pastille, durée de
    lecture, boutons), articles « à paraître », encart final. Les articles eux-mêmes restent dans
    Articles ;
  - **12 fiches** (encart commun au gabarit, textes propres à chaque fiche) : sessions repérées par
    leur type — le cadre (textes, trois cartes, six points « sur place »), l'étiquette et la réforme
    (DPE), les obligations, le résultat (et les pièces à réunir de DTG) —, diagnostics liés, bloc
    final. Les onglets et champs qu'une fiche n'a pas sont masqués ; pictos, illustrations, teintes et
    pages liées restent ceux du thème ;
  - **simulateur** : titre et texte du bloc de rappel en bas de page ;
  - **Mentions légales** : chapeau et date de mise à jour, titre, paragraphes et informations en liste
    de chaque rubrique ; `{a completer: …}` reste surligné, `{adresse}`, `{telephone}` et `{email}`
    reprennent les coordonnées du site.

Mode d'emploi pour la personne qui tient le site : `GUIDE-ADMINISTRATION.md`.

Pour que l'admin montre les textes en place plutôt que des champs vides :
`wp eval-file outils/importer-contenus.php` (ajouter `forcer` pour réécrire des champs déjà remplis).
Un texte du thème changé après l'import (nouvelle version des maquettes) reste l'ancien dans l'admin, qui
prime : vider le champ, ou le mettre à jour s'il n'a pas été modifié par le client.

## Formulaires

Trois formulaires Fluent Forms, décrits d'après les maquettes dans le plugin
(`dih_core_formulaires_definitions()`, `inc/formulaires.php`) et créés par
`wp eval-file outils/importer-formulaires.php` (ajouter `forcer` pour les réécrire) :

| Clé | Où | Champs |
|---|---|---|
| `rappel` | formulaire court : popup « Rappel sous 24 h » (toutes les pages sauf Professionnels, simulateur compris) et barre ou carte « Rappel gratuit » du haut de l'accueil | nom, téléphone, e-mail facultatif, commune, type de bien, message ; champs cachés du simulateur et provenance ; sur fond vert, sans étiquettes, message masqué dans la barre et sur téléphone, e-mail masqué dans la barre |
| `devis` | page Contact | 13 champs en trois groupes, diagnostics en pastilles, consentement ; provenance |
| `partenaire` | popup de Professionnels | structure, interlocuteur, téléphone, dossiers par mois, message |

- **Présentation** (thème, `inc/formulaires.php`, `scss/composants/_form.scss`, `assets/js/formulaires.js`) :
  seule la feuille de structure de Fluent Forms est chargée ; bouton d'envoi au gabarit `.c-btn` ; message
  de confirmation des maquettes (`inc/contenus/formulaires.php`, shortcode `[dih_confirmation]` ; le
  formulaire court porte celui de la popup et celui du haut de l'accueil, le CSS affiche le bon) ; en haut
  de l'accueil, le formulaire court n'est rendu qu'une fois et placé par le script dans la zone visible
  (barre ou carte) ; suggestions de communes (formulaire court et devis) tirées des secteurs de la maquette
  Contact (`donnees/communes.json`, `secteurs`), ouvertes vers le haut sur fond vert.
- **E-mails** (maquettes 1.14, `design_diagimmhauts_theme_wp/emails/`) : deux notifications par formulaire,
  créées par l'import. **Max** (`dih_max`, piste 1c) : à `contact@diagimmhauts.fr`, répondre-à = e-mail du
  client, une ligne par champ, page d'origine et page d'où le client est arrivé (champ caché `provenance`,
  rempli sur Contact et le simulateur), boutons Appeler / Répondre. **Client** (`dih_client`, piste 1a) :
  accusé de réception, seulement si l'e-mail est rempli (rappel et devis). Variantes rappel, devis,
  simulateur (formulaire court envoyé depuis le simulateur : ses réponses partent dans les champs cachés
  `sim_*`), partenaire (Max seul). Gabarits du thème `template-parts/emails/client.php` et `max.php`,
  textes `inc/contenus/emails.php`, images `assets/emails/` ; objet et corps posés par `inc/emails.php`
  (filtres `fluentform/email_subject` et `fluentform/email_body`). Plugin `inc/emails.php` : note Google
  (même source que le bandeau de confiance : `dih_info()`, remplacée par Diag Imm'Hauts → Avis clients →
  Note Google), statut de zone de la commune, balises `{dih.avis_note}`, `{dih.avis_nombre}`,
  `{dih.avis_url}`, `{dih.zone_statut}`, `{dih.prenom}`. Sur la préprod, Mailpit retient les e-mails
  (http://localhost:10000).
- **À régler en ligne** : FluentSMTP (installé) avec une clé API Brevo pour l'envoi (expéditeur
  `contact@diagimmhauts.fr`, SPF + DKIM + DMARC sur le domaine) ; les clés Cloudflare Turnstile dans Fluent
  Forms → Global Settings, puis relancer l'import avec `forcer` pour ajouter le captcha ; fuseau horaire de
  WordPress sur Paris (Réglages → Général ; heure du bandeau des e-mails de Max).

## SEO

- **Balises** (thème, `inc/seo.php`) : titre, description, canonique, `og:*`, `twitter:card` et directive
  robots des 22 pages, repris à la lettre des blocs `<!-- seo -->` des maquettes dans
  `inc/contenus/seo.php` (clé de `dih_chemins()`, ou `article:<slug>` ; un article sans entrée reprend
  son titre et son extrait ; `{telephone}` dans une description : le numéro de `dih_info()`). JSON-LD
  `LocalBusiness` sur l'accueil, avec l'adresse du site réel et les coordonnées de `dih_info()`. Seule
  l'image de partage garde le numéro en dur (`assets/img/partage.jpg`, à recomposer depuis
  `outils/image-partage.html` s'il change). Si Yoast, Rank Math, SEOPress ou AIOSEO est actif, le thème s'efface.
- **Plan de migration** (plugin, `inc/redirections.php`) : les 8 anciennes adresses du README renvoient
  en 301 vers les nouvelles, sur une 404 seulement (jamais par-dessus une page existante), avant les
  suppositions de WordPress. Filtre `dih_redirections` pour en ajouter.
- **Données structurées du rapport SEO (S3)** : JSON-LD `BreadcrumbList` tiré du fil d'Ariane affiché
  (les heros l'impriment par `dih_ariane()`), et `FAQPage` tiré des FAQ affichées (partial
  `composants/faq`), imprimés en pied de page.
- **Image de partage** (aperçu des liens dans WhatsApp, Messenger, Facebook, LinkedIn…) : `assets/img/partage.jpg`
  (1200 × 630), commune aux pages ; une page peut en fixer une autre par le filtre `dih_seo` (`og_image`).
- **Plan du site** : celui de WordPress (`/wp-sitemap.xml`), à soumettre dans la Search Console.

## Arbitrages (écarts entre maquette et README de passation)

| Sujet | Choix retenu |
|---|---|
| Header entre 901 et 1060 px | Comme la maquette : téléphone et pastille ronde du CTA restent visibles jusqu'à 901 px |
| Bouton d'appel fixe (déplié et mobile) | Sans bordure, comme la maquette |
| Rubrique en cours dans la nav | Maquettes v9 : même couleur que les autres items, seulement en gras (600) — jamais `--tech`. Maquettes 1.12 : filet vert permanent de 28 px sous la rubrique en cours ; page en cours signalée dans les menus déroulants et le burger |
| Fiches diagnostics | Pages WordPress avec le gabarit « Fiche diagnostic » (pas de CPT) |
| Actualités | Articles WordPress standard (`home.php` / `single.php`) |
| Espacements hors échelle dans la maquette (18, 20, 28, 30, 36 px…) | Arrondis au cran le plus proche de l'échelle 4·8·12·16·24·40·56 ; écart ≤ 18 px par section, mesuré en 1440 / 820 / 390 |
| Réglages « VERROUILLÉS » (hero de l'accueil, Nos diagnostics en bureau et déplié) | Repris tels quels, marqués `// échelle : exception (…)` pour le vérificateur |
| Écart entre les colonnes des heros de fiche (`clamp(28px, 4vw, 48px)`) | Conservé en exception (décision client) : arrondi à 24…40 px, il élargissait le titre de 4 px et changeait ses retours à la ligne (DPE : « performance » remontait sur la 1re ligne) |
| Titre des heros de fiche | Formule de la maquette `clamp(30px, 3.1vw, 42px)` conservée (exception déclarée) |
| Rayons 12 et 22 px de la maquette | Ramenés aux jetons 10 et 26 px (Audit SCSS) |
| Fond de l'accueil `#E5F2D4` et couleurs du champ « Vérifier ma commune » | Jeton `$vert-brume` ; pastilles oui / limite prises dans la palette (`$pastille-jaune`, `$pastille-orange`) |
| Bloc rappel de la fiche DPE | Garde ses boutons propres (« obligations ») ; les autres fiches suivent la règle v10 formulaire / appel |
| Avis clients de l'accueil | Modifiables dans Diag Imm'Hauts → Avis clients ; textes par défaut à remplacer par les vrais avis du site actuel. La note (5,0) et le nombre d'avis restent des chiffres arrêtés |
| Formulaires | Emplacement balisé tant que Fluent Forms n'est pas installé ou que les formulaires ne sont pas créés |
| Rappel : popup et haut de l'accueil | Un seul formulaire court (demande de l'utilisateur), aligné sur le devis : « Nom et prénom », « Téléphone » (06 12 34 56 78), « Commune ou code postal » (Arras ou 62000, avec suggestions), liste « Type de bien » du devis précédée de « Type de bien » ; les maquettes donnaient à la popup et à l'accueil des libellés et des listes différents |
| Erreurs de saisie des formulaires | Pas de rouge dans la palette : brun des alertes (`--warm` assombri), comme « hors zone » ; messages en français |
| Formulaire court et e-mails (1.14) | Champ « E-mail (facultatif) » ajouté (demande de l'utilisateur) : l'accusé de réception ne part que s'il est rempli ; masqué dans la barre de l'accueil (une seule ligne), placeholder « Votre e-mail (facultatif) » sur fond vert |
| Récapitulatif client du rappel | La maquette des e-mails prévoit Nom, Téléphone, Message ; le formulaire court unifié demandant aussi le type de bien et la commune, ils s'y ajoutent (« Bien », « Commune », demande de l'utilisateur), lignes omises quand elles sont vides |
| Variante « Simulateur » des e-mails | Les réponses du simulateur partent avec la demande (champs cachés) ; ligne « Installations » : les libellés des cases cochées, tels que le simulateur les affiche (la maquette les résume : « Électricité et gaz de plus de 15 ans ») |
| « Arrivé depuis » (e-mail de Max) | Nom de la page précédente pris dans le dernier élément de son fil d'Ariane (« Amiante », « Nos diagnostics »), « Accueil » pour l'accueil |
| Libellés du détail de Max | Ceux de la maquette (« Surface », « Commune », « Échéance », « Diagnostics ») plutôt que ceux du formulaire |
| Groupes du devis | Une seule grille (colonnes de 220 px au moins) pour les trois groupes ; la maquette passe à 250 px pour le deuxième, ce qui ne change la disposition qu'entre 900 et 1150 px de large |
| Liens `#rappel` (FAQ, CTA de section) | Ouvrent la popup de rappel, comme le script des maquettes ; sans JS, ils descendent au bloc « rappel » |
| Illustrations des résultats du simulateur | La maquette les retourne en miroir (`scaleX(-1)`) : supprimé, conformément au README v10 (aucun miroir CSS) |
| Note « Cette liste est indicative » du simulateur | Placée dans le panneau vert du dossier, comme la maquette |
| Pastilles du simulateur (13,5 et 11,5 px, écart 9 et 6 px) | 14 et 12,5 px, écart 8 et 4 px (échelles) ; titre du hero sur téléphone en 30 px conservé (exception) |
| Ligne « condition » des cards blanches de Nos diagnostics (`#629E25`) | Mélange de `--tech` et `--forestDeep`, sans valeur hors palette |
| Titre du hero Professionnels sur téléphone (28 px) | 26 px, comme les fiches (échelle) |
| Popup de rappel de Professionnels | Surtitre, titre, intro et formulaire « Compte partenaire » propres à la page (section `popup` de ses contenus) |
| Étapes de Qui suis-je en déplié et sur téléphone | La maquette n'affiche pas les grands numéros (champ `n` absent de ses données) : numéros conservés, comme sur les fiches |
| Décor du hero de Qui suis-je en bureau | Cadrage de la maquette (`0% 82%`, `max(130%, 1180px)`), pas celui des autres heros |
| Adresse e-mail | Deux adresses voulues : `contact@diagimmhauts.fr` pour les formulaires et les devis (Contact), `bureau@diagimmhauts.fr` pour les mentions légales et le RGPD |
| Mentions « à compléter » (certification, RC Pro, médiateur, mesure d'audience) | Surlignage conservé, teintes dérivées de `--warm` ; informations à fournir par le client |
| Contenu des deux articles | HTML versionné dans `outils/contenus/articles/`, importé par `wp eval-file outils/importer-articles.php` (bloc « HTML personnalisé » ; liens `{url:…}` résolus à l'import) ; cards de l'index alimentées par des champs `dih_*` ; article épinglé = « à la une » |
| Permaliens des articles | `/actualites/%postname%/` (réglé par le script d'import) ; « Hello world! » passé en brouillon |
| Typographie WordPress | `wptexturize` désactivé : apostrophes et espaces insécables restent ceux des maquettes |
| Barres de l'échelle A→G et pastilles d'échéance des articles | Couleurs réglementaires du DPE (`$dpe-a` … `$dpe-g`) au lieu des teintes propres aux maquettes |
| Hero de l'accueil `max-bandeau` et `sansBG` : hauteur | Celle des autres variantes (`100svh` − bandeau, 690 px au moins, comme le script de la nav transparente de la maquette) ; `max-bandeau` : photo ancrée au bas du hero, hauteur − `--nvH` − 44 px (pas de tête sous la nav) ; `sansBG` (bureau, 1.14d) : 802 px en 1440 × 900 comme la maquette, rangée sous la nav et la marge de 88 px, pastille hors du flux au-dessus du titre, carte centrée sur le bloc titre → chiffres ; la carte étant plus haute de 51 px (champ e-mail), le texte descend de 23 px par rapport à la maquette ; le bandeau est compté pour 98 px à toutes les largeurs (la maquette mesure le sien, plus haut de 901 à ~1150 px : hero jusqu'à ~20 px plus haut que la maquette) |
| Hero `max-bandeau` en déplié (1.14d) | La maquette corrigée (formulaire ignoré par le script de la nav) ajoute sous la nav la marge `clamp(24px, 3.4vw, 40px)` : reprise (703 px contre 707 en 820 px). Sous-titre à 14 px comme les variantes à terrils (`heroParaSize` de la maquette), alors que le message 1.14d annonce le déplié inchangé (15 px auparavant) |
| Avis clients de l'accueil (recette 1.14c : +70 px en 1440 et 820, +84 px sur téléphone) | Les vrais avis Google, plus longs que les textes de la maquette : cartes plus hautes, rien à corriger dans la mise en page |
| Sous-titre du hero (1.14d) | Nouveau texte (« réalise lui-même les diagnostics », sans « douze ») pour les variantes à terrils, les seules qui portaient « douze » ; `max-bandeau` et `sansBG` gardent leur phrase, comme la maquette ; « Maxime Dillies » insécable dans les quatre. Un chapeau déjà importé dans l'admin garde l'ancien texte : sur la préprod, mis à jour à la main (champ resté celui du thème) |
| Hero `sansBG` de 641 à 900 px | La maquette n'y affiche aucun hero (`vAucun` réservé au bureau, aucune autre variante à la place : la page commence au bandeau de confiance) : hero du bureau conservé, en grille, avec sa carte |
| Hero `terrils-barre` en déplié | Dans la maquette, les chiffres (remontés faute de CTA) passent sous les cartes DPE et la barre recouvre le bas de l'illustration : chiffres descendus à la place qu'ils ont sous les CTA, décor arrêté au haut de la barre (même échelle et même cadrage que `terrils-boutons`), hero allongé de la hauteur de la barre (106 px) |
| Illustration « maison verte » de Nos diagnostics (`min-height: 363px` dans la maquette) | Hauteur minimale supprimée : sans `object-fit`, elle étirait la maison sous 1100 px de large ; image pleine largeur du cadre 4:3 (même ratio que le fichier), halo lumineux conservé. Variable `--sr` de la maquette : lue nulle part, non reprise |
| Bloc « 4 étapes » en `deux-colonnes` | Bureau : deux colonnes au-delà de 1150 px, illustration au-dessus des cards 2 × 2 de 901 à 1150 px (maquette DPE). Déplié et téléphone : rail vertical des deux dispositions, comme l'annonce la page d'options (« même rendu »), et non les cards 2 × 2 de la maquette DPE. Qui suis-je, absente de la liste des pages du réglage, reste en ligne |
| Colonnes de liens du pied de page (elles varient d'une maquette à l'autre : « Infos & FAQ », « Mes engagements », « Demande de rappel »…) | Un seul pied de page pour les 22 pages (README de passation : `footer.php` commun ; audit SCSS, K5) : celui de l'accueil ; sur téléphone, il fait 841 px contre 870 dans les autres maquettes (899 pour le journal) : seul écart de hauteur restant de ces pages à 390 px |
| Redirections : « 7 » dans le rapport SEO, 8 lignes dans son tableau et dans le README | Les 8 lignes (les deux variantes en `/wp/` comprises) ; l'ancien journal renvoie vers `/actualites/`, comme le README (« journal conservé ») |
| Image de partage 1200 × 630 (rapport SEO, chantier S3), non fournie | Composée à partir du thème (décor des terrils, logo, accroche de l'accueil, pastilles « Certifié Bureau Veritas », « Devis sous 24 h ouvrées », téléphone) : `assets/img/partage.jpg`, source `outils/image-partage.html` ; en JPEG et non en WebP, que certaines messageries n'affichent pas en aperçu |
| Canonique et `og:url` | Adresse du site réel (`home_url`), pas `https://diagimmhauts.fr` en dur : la préprod ne se déclare pas comme la production |
| Hero `sansBG` en déplié | La maquette n'affiche pas le formulaire dans la carte (`formAucun` réservé au bureau) : formulaire affiché, sinon la carte est vide |
| Espacements hors échelle des variantes du hero (28, 13, 50, 48 px, rayon 18 px, marge basse −22…−34 px de la barre) | 24, 12, 56, 40 px, rayon 16 px ; la barre de `terrils-barre` annule exactement le rembourrage bas (−24…−40 px) et reste collée au bas |
| Halo `#eaffd8` de `max-bandeau` | Jeton `--glow` |
| Téléphone, quatre variantes du hero | Rendu commun VERROUILLÉ (décor `bg_mobile1`, carte « Rappel gratuit ») ; au-delà de 640 px, `max-bandeau` et `sansBG` ne téléchargent pas ce décor (source vide dans le `<picture>`), ni la photo de Maxime sous 901 px |
| Réglage `step_icons` (listé dans la page d'options par le README de passation) | Pas de champ : la maquette d'admin a retiré ce choix (NOTES : « socle vert en dur ») ; valeur par défaut, modifiable par le filtre `dih_option` |
| Polices (`police_titre`, `police_texte`) | Attributs `data-police-titre` / `data-police-texte` sur `<html>` et non sur le `body` : la correction du texte (104 % Instrument Sans, 112 % Source Sans 3) passe par la taille racine, base de tous les `rem()`, comme le prévoit l'audit SCSS (« une valeur ») ; toutes les polices sont auto-hébergées (`assets/fonts`) |
| Identifiants des formulaires | Sous-page « Formulaires », hors maquette : la page « Personnalisation » ne porte que l'apparence |
| Statuts « Selon situation » et « Recommandé » | Teintes dérivées de la palette (`--warm`, `--line`, `--forest`) au lieu de `#f6e6b4` / `#6b4d11` / `#3f5c46` |
| « S'applique à : … » de la page Personnalisation | Dans la carte du premier réglage de l'onglet, au-dessus de son titre, carte collée aux onglets et onglet actif en blanc (demandes de l'utilisateur), et non entre les onglets et les cartes comme la maquette |

## Dépendances

- **ACF Pro** ou **Secure Custom Fields** (reprise gratuite d'ACF par WordPress.org, avec les fonctions Pro) :
  contenus modifiables et pages « Personnalisation », « Formulaires », « Avis clients ». Le même code sert aux deux.
- **Fluent Forms** (la version gratuite suffit, Turnstile compris) : formulaires de rappel, de devis et de
  compte partenaire ; **FluentSMTP** pour l'envoi des e-mails via Brevo.

Sans elles, rien ne plante : un message d'administration signale ce qui manque et les formulaires
laissent un emplacement balisé.
