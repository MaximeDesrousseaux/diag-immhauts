# Diag Imm'Hauts — notes de projet

## État
Refonte appliquée sur l'accueil, `Nos diagnostics`, `Professionnels`, le `Simulateur` et les
13 fiches. Les cards « accueil » (bordure 2px, illustration débordante, damier blanc / vert clair)
sont le standard : accueil, Nos diagnostics (tweak `cardsDiagnostics`), Professionnels, résultats
du simulateur.

Hero de l'accueil : tweak `heroVisuel`, défaut `terrils-boutons` (décor terrils, pas de barre de
formulaire, deux CTA en ligne — « Demande de rappel (gratuit) » ouvre la popup, « Mes prestations »
défile en 1,2 s jusqu'à `#diagnostics`). Autre variante vivante : `terrils-barre` (barre de
formulaire pleine largeur collée au bas du hero).

Illustrations des 4 cards de l'accueil et de la grille « le détail » : en `background-image` CSS
(pas d'`<img>`), avec un `aspect-ratio` par fichier dans `_illAR` — un ratio faux se voit comme un
rognage haut/bas.

## Nav transparente — ACCUEIL UNIQUEMENT, validé
Tweak `navHero` (`blanche` | `transparente`) sur la seule page d'accueil, pour profiter du décor :
header épinglé (`position:fixed` + espaceur), texte/logo/téléphone en blanc, décor `dTerrilsImgTop`
`-59px` (tuiles latérales alignées via le même décalage), hero en `100svh − hauteur du bandeau`.
Bascule **par événement, pas par distance** : un compteur de crans de molette passe la nav au blanc
au **2e cran**, d'un trait (transition CSS 420 ms posée une seule fois au câblage). `__nvSolid` est
la source de vérité unique — conservée d'un recâblage à l'autre, peinte **synchronement** à chaque
changement (rAF annulé), et réconciliée en tête de `__nvTick` (`scrollY <= 0` → transparente), car
aucun événement `scroll` n'est garanti au retour en haut. Repli à `y > 220px` pour clavier / barre
de défilement ; crans groupés par 140 ms pour le pavé tactile.
**21 pages intérieures, tous formats** : passage au blanc dès le **1er cran** (ou `y > 0`) — l'accueil garde le 2e cran en bureau. **Déplié (accueil)** : 1er cran aussi ; sur l'accueil les réglages `dTerrils*` du déplié sont décalés de `var(--nvH)` (hauteur du header) pour garder le cadrage verrouillé.
**Étendue aux 21 autres pages** (bureau + déplié + mobile, `__navTransp() = true` ; décor mobile décalé de `var(--nvH)` posé sur le hero ; en déplié logo SVG `lghn`, burger `.dih-burg-l` blanc, nav forcée blanche burger ouvert) : même `__navWire`
porté, le hero (1re `section` après le header) reçoit `margin-top:-H` + `padding-top` d'origine + H ; logo
toitures en SVG en ligne (`dih-lg-a/b`) ; sous-titre ciblé par `.dih-hdr-tag` ; le CTA du header reste visible
s'il n'y a pas de `a.dih-cta` dans le hero. Accueil mobile : barre du hero (déjà transparente → blanche).

## Carrousel des avis (accueil)
Flèches bureau/tablette **sous** le carrousel, alignées à droite, chevrons sans rond (`revPrev`/`revNext`, `__revSync` sur le `scroll`, seuil 24 px) : grisées à 0,3 et désactivées en début / fin ; masquées sur téléphone.

## Header commun aux 22 pages
Entre 1061 et 1232 px, mode compact plutôt que sacrifier le CTA : logo 22 px, `.dih-navrow` à 14 px
de gouttière, numéro à 14 px, CTA en pastille ronde 42 px à icône enveloppe (`.dih-hdr-cta`) ;
sous 1060 px le CTA disparaît, sous 1000 px le téléphone, sous 900 px c'est le burger.
Survol de la nav blanche : **aucun changement de couleur** (le vert clair a été retiré des 22 pages),
seul le filet vert clair glisse sous l'item — idem sur le numéro. Menus déroulants : alignés à
gauche sur leur item parent (`left:calc(-1 * clamp(16px,4.2vw,24px))`, items à `margin-left:-9px`),
dépliage en volet haut→bas (`dihUnfold` + cascade `dihItemIn`) ; le grand panneau passe en une
colonne de 320 px sous 1140 px (`dih-navpanel-lg`), sinon il déborde du cadre.

## Logo — 4 variantes, réglage global
Tweak `logoSite` sur l'accueil : **`toitures` (défaut, posé sur les 22 pages)** =
`uploads/logo-toitures.svg`, le logo actuel redessiné en vectoriel — tracé relevé au pixel sur
`logo-diag.png` (sommets à 33 % et 66 % de la largeur, tous deux en haut, creux à 29 % de la
hauteur, cheminée à 73–81 %), bras épaissis de 10 %, largeur 445 → 418 → **404** (écart entre
chevrons réduit de 14 unités, sommets à x=138 et 262), cheminée raccourcie,
palette de la charte, le chevron vert **devant** et le vert foncé découpé net par sa silhouette
(masque SVG — il ne réapparaît pas dans le creux). Autres valeurs : `actuel`
(`uploads/logo-diag.png`), `maquette` (`uploads/logo-1784225863936.png`), `terrils`
(`uploads/logo-terrils.svg`, disque vert, piste 3a).
Pièges à ne pas réintroduire :
- **liseré d'un pixel** en bas du logo si les arêtes des tracés et celles du masque tombent toutes
  sur la même ordonnée — les tracés descendent à `y=124` et le `viewBox` coupe à `116` ;
- en nav transparente le logo est **en ligne** (classes `dih-lg-a` / `dih-lg-b`, blanc + vert clair),
  pas un `<img>` : ses remplissages sont pilotés par la feuille d'encre de la nav et virent aux
  verts de la charte avec elle (fondu 420 ms). Un `<img>` ne saurait pas changer de couleur.
En WP c'est un **réglage global** de plus (comme `formeBoutons` et `etapesDispo`) : une valeur pour
tout le site, lue par le partial du header.
Cheminée soudée au chevron droit (tracé `M290 34 L290 14 L324 9 L324 66 Z`, sa base plonge dans le chevron). Favicon : `favicon.svg` / `favicon-32.png` / `apple-touch-icon.png`, pastille vert forêt.
`Logo - 4 propositions.dc.html` = la page d'exploration (4 tours, 4b-charte retenue).

## Champ « Vérifier ma commune » (accueil, section `#zones`)
Le bouton révèle un champ ; suggestions dès 2 caractères (table d'environ 90 codes postaux, 6 max,
clic pour remplir), réponse nommant la commune (« Oui, j'interviens à Arras (62000)… »), trois
états : 62 = oui, 59/80 = limite de zone, autre = hors zone (avec lien vers Contact). Placeholder en
`--muted` posé localement (`.dih-zonefield input::placeholder`) — la règle globale pâle est faite
pour les champs sur fond vert du hero.

## Déplié (641–900 px) — VERROUILLÉ, ne pas retoucher sans demande
Le hero de l'accueil en déplié est validé. Les bascules du hero sont gouvernées par `__isPhone()`
(le bloc hero mobile est réservé au téléphone) et le flag `_depl = __isNarrow() && !__isPhone()`
porte les valeurs propres au déplié. Réglages figés :
- fond : `dTerrilsTop: -74px`, `dTerrilsShift: 2%`, `dTerrilsBgH: 112%` (les tuiles latérales
  doivent dépasser le bas du hero, sinon bande verte visible avant le bandeau blanc) ;
- hauteur : `heroWrapMinH` / `barContMinH: 470px` → hero de 492 px, bandeau blanc visible ;
- texte : titre 43 px, `heroColJustify: flex-start` + `heroColPadT: 10px`, `heroParaGap: 26px`,
  `heroParaMax: 392px`, `heroCtaGap: 34px`, `heroStatsGap: 38px` ;
- CTA : libellé `Mes prestations` (`ctaPrestaLabel`), fond à 88 % (`ctaPrestaBg`) ;
- voile vert de gauche : `heroVoileRight: 170px`, `heroVoileBottom: 60px` ;
- bloc « Qui suis-je » : deux colonnes `330px minmax(0,1fr)`, photo fluide, et les 4 infos en 2×2
  sous le bloc (`expertValuesIn` / `expertValuesOut`).
Hero de `Nos diagnostics` en déplié — **VERROUILLÉ** aussi : colonne texte alignée en haut
(`heroAlign: start`), illustration `ndHeroW: 114%` ancrée haut-droite (`heroIllAnchorX/Y`),
`heroIllMt: 52px` puis `transform: translate(7%,-5%)`, ratio `4/3` ; les 3 pastilles passent en
ligne de trois en bas du hero (`pillRowDisp: grid` en absolu, sous-titres masqués via
`pillSubDisp`), 50 px sous le bouton vert, 18 px du bas (`heroPadB: 61px`), pastilles à 46 px
(`heroPillH`). Bloc « Audits énergétiques » en deux colonnes fixes (`auditCols`).
`Apercu deplie.dc.html` rend les 18 pages à 820 px pour contrôler d'un coup d'œil.

## Déplié — corrigé cette session
- `Qui suis-je` : les 3 infos passent en **bandeau blanc** sous le hero (`qsStatsDark` / `qsStatsWhite`),
  le hero s'arrête au bas de la photo (écart 0).
- `Contact` : « Plus rapide au téléphone » pleine largeur (`sidePhoneSpan`), puis 2 colonnes
  (horaires + cabinet à gauche, zone à droite).
- `Simulateur` : largeurs figées de l'édition directe supprimées (plus de débordement),
  « Année de construction » en ligne, photo de Max agrandie vers le haut (`ctaPhotoW/H`).
- `Nos diagnostics` : chaque variante de hero a son illustration dans sa propre condition
  (le bloc `maison-equipee` était vide) ; `maison-outils` utilise `ill_hero_nosdiags3-f0bf78d8.png`.

## Mobile (≤ 640 px) — hero de l'accueil — VERROUILLÉ
Validé, ne pas retoucher sans demande. Décor `bg_mobile1.png` (portrait) en `background-image`
du hero, `128% auto` à `62% 8%` (le `cover` est à éviter : en `100svh` il reprend la main sur le
cadrage vertical et les réglages de position n'ont plus d'effet visible) ; voile haut 340 px
(`.9` → 0) pour le titre, voile bas à partir de 60 % pour le formulaire. Hero à `100svh`.
Le header du site est masqué sur téléphone (`hdrDisplay`) : c'est la **barre du hero** qui fait
la nav — `position:fixed` (et non `sticky`, inerte sous un ancêtre `overflow:hidden`), avec un
espaceur dans le flux qui réserve sa hauteur. Animation au défilement (`__mRef`/`__mTick`,
rAF, hors cycle React) : le logo passe de 23 px centré à l'échelle 0,68 calé dans la gouttière
de 16 px — `translateX` **non divisé** par l'échelle —, le fond blanc et l'encre `--forest`
apparaissent en parallèle. Le bloc logo réserve 52 px à droite, sinon il recouvre le burger.
Tweak `heroMobile` : `decor-vertical` (défaut), `maxime-decor`, `deux-cta-decor`.

## Mobile — autres pages
Champ message masqué sur téléphone (`heroMsgShow`) — il reste dans la popup.
Hero mobile de `Qui suis-je` — **VALIDÉ** : pastille « Fondateur & unique intervenant », titre
30 px, sous-titre court (2 lignes), portrait **pleine largeur** (250 px de haut, halo vert diffus)
avec le CTA d'appel posé en bas à gauche de la photo ; aucun autre CTA dans le hero (la barre du
hero et le bloc `#rappel` s'en chargent) ; les 3 infos passent en **bandeau blanc** sous le hero
(`qsStatsWhite` vrai dans les 3 formats).
Heros mobiles de `Nos diagnostics`, du `Simulateur` et des 12 fiches : **2 colonnes en tête**
(titre à gauche, illustration à droite, colonne image 34–36 %), puis sous-titre pleine largeur,
puis le contenu propre à la page (pastilles / CTA). Technique : la colonne texte passe en
`display:contents` sur téléphone (`heroLeftDisp`) et chaque élément est placé explicitement
(`grid-row` 1→4, `heroImgCol`/`heroImgRow`) — les propriétés de grille restent inertes en
bureau/déplié, donc ces deux formats ne bougent pas. Hauteurs obtenues : 550 px (Nos diags),
626 px (fiches), 385 px (simulateur) — le contenu sous le hero est visible d'emblée.
Heros mobiles des autres pages : illustration remise **dans le flux** et centrée sous le texte
— `Simulateur` (elle était en absolu par-dessus le titre, `simIllPos`/`simIllSelf`/`simIllTr`)
et `Professionnels` (elle était masquée, `proPhoto` désormais toujours vrai, `proIllusW` 92 %).
Contrôle : `Apercu mobile.dc.html` — aucun débordement, pas de défilement horizontal.

## Nos diagnostics — VERROUILLÉ (bureau + déplié)
Page validée dans les deux formats, ne pas retoucher sans demande. Points structurants :
pas de bouton vert dans le hero (les 3 pastilles sont les entrées principales, fond `#fff 13%` /
bordure `28%`) ; le CTA du simulateur est **sous** la grille des cards (`ctaSimJustify`) ;
titre déplié 40 px avec saut de ligne après « obligation » (`ndTitleBr`) ; bloc « 4 étapes »
identique à DPE dans les deux branches (`stepsWide` / `stepsNarrow`, rail à `left:48px`,
illustration avec `margin-bottom:42px` — c'est lui qui les remonte).

## Session « entrées hero / Qui suis-je »
- `Nos diagnostics` : tweak `entreesHero` (`sommaire` défaut choisi par le client | `cartes-blanches` | `verre` = ancien look) sur les 3 entrées du hero ; numéros `width:20px` + `tabular-nums`, centrés verticalement.
- `Qui suis-je` hero bureau : 1er « Demander un devis gratuit » (CTA principal, padding 24 px pour l'animation d'icône), 2e « Découvrir mon parcours » (CTA secondaire, flèche bas animée **au survol seulement**, `__glide('parcours')` 1,2 s vers `#parcours`). Déplié : 2e bouton = « Appeler le … » (`qsDesk`/`qsNotDesk`).

## Session « bandeaux / heros Actu & Contact » — v1.5
- `Actualites` et `Contact` : décor de hero repris du Simulateur (grille isométrique + halos). Titre actus « **Actualités** du diagnostic immobilier » (mot « Actualités » en vert clair) ; hero mobile en 2 colonnes (`mlLeftDisp` contents, `mlImgCol/Row`). Titre Contact agrandi (`ctH1Size` 31 px / clamp 36→56).
- `Qui suis-je` : légende « Certifié Bureau Veritas » retirée de la photo ; bandeau blanc = **même composant que la trust bar de l'accueil** (Google 5,0 ★ · Certifié Bureau Veritas · Rendez-vous sous 48 h), filets verticaux en bureau (`qsDesk`).
- « peut-être » toujours insécable (`white-space:nowrap`).
- Audit pré-empaquetage : balises équilibrées, trous tous alimentés, ressources toutes présentes, JSON-LD valide, 1 h1 par page (les doublons sont en `sc-if` exclusifs). Couleurs de secours obsolètes corrigées (`#59b529`, `#6dcc38`, `#123024`, **`#0d241b`** → canoniques) sur les 22 pages. Écarts d'échelle restants volontaires : 10 px (sous-titre du logo, « LIGNE DIRECTE »), `gap:11px` (listes de préparation des fiches).
- Sauvegarde : `checkpoints/v1.5 - pre-empaquetage/`.
- **v1.6 - pre-empaquetage** (`checkpoints/v1.6 - pre-empaquetage/`) : nav transparente partout, décor terrils, teintes en variables, `overflow-x:clip` sur html/body. `clamp()` unifiés (73 distinctes dans le balisage ; `clamp(16px,4.2vw,24px)` réservé à la nav) ; palette portée en `var(--x,#hex)` dans la logique JS (257) et dans les SVG en ligne (133, `fill`/`stroke` passés en `style`).
- Fiches (Amiante, Plomb, Électricité, Gaz, Termites, ERP, Mesurage, Assainissement, Mérule) : les deux sessions « cadre du contrôle » / « sur place » sont empilées (plus de 2 colonnes), cards 3 par ligne (`minmax(max(200px,calc((100% - 24px)/3)),1fr)`) — incluses dans la sauvegarde v1.6.

## Livrables — v1.7 (`checkpoints/v1.7 - livrables/`)
`design_handoff_theme_wp/` (README + `PROMPT-CLAUDE-CODE.md` + 22 pages + admin + img/ + logos) pour la suite en Claude Code : thème classique PHP/SCSS + plugin `diag-immhauts-core` (CPT, blocs ACF, page d'options, simulateur). `dossier_client_en_ligne/` (`index.html` = dossier client) à héberger.

**Stack probable (en attente de validation client)** : ACF Pro + Fluent Forms Pro + Brevo (≈ 110 €/an). Manquent toujours : n° de certification, assureur RC pro, médiateur.

## Empaquetage — plan validé
Deux livrables : (1) `design_handoff_theme_wp/` pour Claude Code (README de spécification + 22 pages + admin + img/ + logos, sans captures) ; (2) `Dossier client - Refonte.dc.html`, présentation élégante de la refonte graphique et fonctionnelle, style des aperçus, **sans étapes de développement**.

## Décor des heros — terrils (réglage global `decorHero`)
19 pages intérieures (toutes sauf Accueil et Qui suis-je) : fond `uploads/hero_bg_sans_maison_large.png` en
`130% auto`, calé `0% 82%` (téléphone : `cover`, `38% 30%`) — les sommets passent entre le texte et
l'illustration, l'herbe sert de sol à l'illustration. Voile vert foncé à gauche (80 % → 0 à 60 %) + fondu bas.
Ancien décor (grille isométrique) conservé derrière `decorHero: grille` (`decorGrille` / `decorTerrils`,
méthode `__decorVals`). Réglage « Décor des hauts de page » dans l'admin WP.
Bureau : décor **fixe** `1655px auto` à `calc(50% + 190px) 82%` (ancré au centre du contenu, référence 1 273 px — ne bouge plus au redimensionnement), fondu 120 px vers `#0b381e` sur le bord gauche au-delà de 1 290 px et droit au-delà de 2 020 px (`__trFade`). Déplié : `max(130%, 1180px) auto`. Téléphone : `auto 760px` à
`right -545px top -249px`, fond `#0b381e`. Pages sans pastille au-dessus du titre (Nos diagnostics, Simulateur,
Actualités, Contact, Mentions) : `padding-bottom` 40 px sur le fil d'Ariane en mobile (`nbSpacer`) pour poser
l'illustration sur l'herbe. `Qui suis-je` : tweak `decorHero` (`terrils` | `actuel`) en essai ; en déplié le décor est décalé à `-260px 82%` (sommets hors de la tête de Max).

## Session « nav transparente partout / heros mobiles »
- Nav transparente sur les 22 pages et les 3 formats ; déplié : blanche au 1er cran. Item de la page en cours en blanc sur nav transparente (items de 1er niveau seulement, pas dans les menus déroulants).
- Pastilles des heros en mobile : classe `dih-hero-pill` (fond `--forest` 78 % + flou 8 px).
- Illustrations de hero des fiches en bureau réduites de 15 % ; DTG et Professionnels à 440 px (déplié 92 %).
- `Nos diagnostics` déplié : illustration `heroIllTx: -8%`, `heroPadB: 110px` (pastilles « sommaire » de 76 px).
- Attention : certaines sources contiennent des espaces insécables (`)\u00a0?`) — utiliser des regex `\s` pour les remplacements.

## Illustrations des diagnostics — normalisées
`img/diag_<clé>.webp` (12) : 800×640, orientation cuite, poids visuel égal (réf. DPE des cards liées). Plus de `scaleX(-1)` / `_plinth` / `_illTune` / `_k` par fichier — une taille par contexte. Heros fiches 370/326 px. Heros DPE et Audit inchangés.

## Images optimisées (WebP)
Une seule version par illustration de diagnostic : les `_ssfond` (les `_hero` / `_v2` / `_v3` doublons en miroir ont été retirés du paquet) ; dans les heros des fiches, `scale:-1 1` sur l'`<img>` rend l'orientation d'origine. Pictos 4 étapes et cards liées : chemins `img/…webp` construits en JS (plus aucun `uploads/*.png`).
Les 72 images utilisées par les 23 pages du site (20 pages + admin, hors pages d'exploration) sont servies
depuis `img/*.webp` (qualité 0,82, même nom de fichier) : bg à 2000 px max (1672 pour
`hero_bg_sans_maison_large`), illustrations à 1000 px, pictos d'étapes / items à 480 px, photos de Max à
900 px — ≈ 90 Mo → ≈ 4,5 Mo. Originaux conservés dans `uploads/` (à ne pas embarquer dans le thème).
Restent en `uploads/` : logos (PNG/SVG légers) et vignettes admin (JPG). Toute nouvelle illustration :
la convertir en WebP dans `img/` avant de la référencer.

## Admin WP — onglets
Trois onglets façon WP (`nav-tab`) : Identité du site (logo, boutons, polices) · Accueil (hero, « Le détail ») ·
Pages intérieures (décor, entrées Nos diagnostics, 4 étapes). Les accordéons ont été essayés puis abandonnés.

## Actualités (nouveau)
`Actualites.dc.html` est l'index du journal (SEO `/actualites/`) : card à la une (panneau vert
foncé avec illustration centrée + chiffre 2,3 → 1,9), puis les articles publiés en cards
pleine largeur à vignette vert clair (`listCols`), puis les cards « à paraître » (`aVenir`,
illustration en `background-image` décalée à gauche). Deux articles écrits :
`Actu reforme DPE 2026.dc.html` (frise des coefficients, échelle A→G avec exemple chiffré
200 kWh → 460/380, marche à suivre pour l'attestation ADEME) et
`Actu calendrier location.dc.html` (3 échéances G/F/E, ce qui est bloqué vs ce qui continue,
3 exceptions, `stepCols` pour 3 cards sur une ligne). Restent à écrire : prix d'un pack
(`ill_article_prix.png`) et durées de validité (`ill_article_duree_validite_flip.png`).
Nav des 20 pages : plus d'item « Accueil » en bureau (le logo fait le lien), « Actualités »
avant « Qui suis-je » ; « Accueil » reste dans le burger.

## Variantes conservées (arbitrage fait — les autres sont supprimées du code)
Cible : thème WordPress sur mesure + blocs ACF verrouillés (pas Elementor), formulaire confié à
un plugin maintenu (Fluent Forms) + envoi transactionnel (Brevo/Postmark) + Turnstile. Un plugin
maison `diag-immhauts-core` portera seulement blocs, CPT Actualités, champs et réglages.
Chaque tweak restant = un champ select d'une page d'options ACF, lu par le partial PHP.
- Accueil `heroVisuel` : `terrils-boutons` (défaut), `terrils-barre`, `max-bandeau`, `sansBG`
  (ex-`aucun`). Supprimés : conseil-filigrane, conseil-bandeau, max-bandeau-900, terrils-fond,
  max-telephone. Tweak `heroMobile` supprimé (seul `decor-vertical` subsiste, en dur).
- Accueil `formeBoutons` : arrondi | pilule (défaut pilule).
- Accueil `detailStyle` (bloc « Le détail », `#detail`) : `ouvert` (défaut, « cards blanches, pas de background ») | `clair` (panneau blanc, tuiles vert pâle) | `damier`. Variante vert foncé supprimée. Grille à 4 colonnes jusqu'à 1060 px (`__is1060`). Vignettes admin : `screenshots/admin/detail-*.png`.
- `max-bandeau` corrigé : photo `height:calc(100% - 44px)` ancrée `bottom:0`, hero à 600 px
  (`heroWrapMinH` / `maxBandeauMinH` propres à cette variante) — plus de tête dans la nav ni de
  vide sous la photo.
- Nos diagnostics : `heroIllustration` = livrets (défaut) | maison-verte ; tweaks
  `cardsDiagnostics` et `cardStyle` supprimés (skins « accueil » en dur).
- Réglages **globaux** prévus (une valeur pour tout le site, page d'options ACF) :
  `formeBoutons`, `etapesDispo` (défaut `en-ligne`), `stepIcons`. En maquette ils ne vivent que
  sur leur page de référence (Accueil / DPE / Plomb) ; en WP le partial lit l'option, donc un
  seul changement.
- `Admin WP - Personnalisation.dc.html` = maquette de la page d'admin du plugin
  (spécification) : sidebar WP, **page unique** (boutons → hero → bloc 4 étapes, plus
  d'onglets), sélecteurs à vignettes ; choix d'icônes des étapes supprimé (socle vert en dur).
  Vignettes des 4 heros = captures **fournies par le client** dans `uploads/` (`terrils-bouton`,
  `terrils-barre`, `max-bandeau`, `sans-bg` — 1300×685, cadre `aspect-ratio:1.9`), en 2×2 ;
  celles du bloc 4 étapes dans `screenshots/admin/etapes-*.png`. À refaire si un bloc change :
  forcer la valeur dans `renderVals`, puis `snapshot_element` à l'échelle 1 sur l'élément
  (surtout pas une capture de page zoomée — ça casse les fondus latéraux et le cadrage).
- DPE : `jaugeStyle` supprimé (étiquette intégrée en dur) ; `etapesDispo` conservé sur DPE
  **comme page de référence** du bloc « 4 étapes » — en WP ce sera UN réglage global.
- Plomb : `stepIcons` (socle-vert | socle-blanc) conservé, également destiné au réglage global
  du bloc « 4 étapes » ; prop `heroVisuel` morte supprimée.
- Qui suis-je : `citation` (5 choix).

## SEO
Les 20 pages portent titre, description, canonique, og:* et directive d'indexation
(bloc `<!-- seo -->` en tête du helmet ; mentions légales en `noindex`). Carte d'identité
`LocalBusiness` en JSON-LD sur l'accueil. `Audit SEO.dc.html` = rapport livrable (plan de
migration 7 redirections, 6 chantiers). `Verification contenus.dc.html` = rapport d'audit
des contenus. Chiffres arrêtés : **8 ans** d'expérience, **12 avis**, **12 diagnostics**,
certifié **Bureau Veritas** (organisme accrédité par le Cofrac), adresse **19 route
nationale, 62690 Berles-Monchel** (pas de réception du public, le mot « cabinet » a été
retiré du site), délais **devis 24 h ouvrées / rendez-vous 48 h / rapport 48 h** (24 h pour
les partenaires). SASU au capital de 5 000 €. Manquent encore : n° de certification,
assureur RC pro, médiateur de la consommation.

## Passe 3 de l'audit SCSS — APPLIQUÉE aux 22 pages
2 985 valeurs du **balisage** ramenées sur trois échelles (sauvegarde :
`checkpoints/v1.1 - avant passe 3/`). Ne plus introduire de valeur hors échelle :
- texte : `11 · 12,5 · 14 · 15,5 · 17 · 19 · 22 · 26` px (+ 34 px, une taille d'affichage) ;
- gouttières : `4 · 8 · 12 · 16 · 24 · 40 · 56` px (le `gap:2px` des filets est conservé) ;
- rayons : `4 · 10 · 16 · 26 · 44` px + `999px` pour les pilules.
Non touchés volontairement : les largeurs/hauteurs (passe 2) et toutes les valeurs portées
par la **logique** — donc les réglages à l'œil des heros verrouillés (`heroParaGap`,
`heroStatsGap`, `heroPadB`…) sont intacts.

## Chantier K6 — APPLIQUÉ aux 22 pages
156 formules `clamp()` → **107** (sauvegarde : `checkpoints/v1.2 - avant K6/`). 872 réécrites,
10 supprimées (bornes identiques après arrondi → valeur fixe). Règles à respecter :
- bornes de texte sur l'échelle typo `11 · 12,5 · 14 · 15,5 · 17 · 19 · 22 · 26 · 31 · 36 · 44` ;
- bornes d'espace sur `4 · 8 · 12 · 16 · 24 · 40 · 56 · 72 · 96` ;
- **accents conservés** : toute borne max ≥ 48 px est volontaire et reste hors échelle
  (261 cas — le « 1,9 » de la card actualité à 58 px, les grands titres de fiche) ;
- **vitesses unifiées sur les espaces** (2e temps, sauvegarde `checkpoints/v1.3 - avant
  unification vitesses/`) : 393 formules réécrites, un seul rythme par couple de bornes —
  celui que suivait déjà la majorité des usages. Total **156 → 78 formules**. Ne plus
  introduire deux vitesses pour un même couple `min→max` de rembourrage ou de gouttière ;
- **vitesses des titres conservées** : 7 formules (couples 31→44, 26→44, 26→36 px, ce dernier
  à lui seul 92 usages) gardent des rythmes distincts — un titre de hero doit grandir plus
  vite qu'un titre de section, sinon la hiérarchie s'écrase sur écran intermédiaire.
  `K6 - impact des vitesses.dc.html` = la page d'arbitrage qui a servi à trancher.

## Passe 2 de l'audit SCSS — CLOSE
Le relevé initial (« 1 091 largeurs figées ») comptait toutes les dimensions en pixels. Après
tri par contexte sur les 1 769 occurrences : **2 artefacts réels**, tous deux sur
`Mentions legales.dc.html` (titre et paragraphe portant `height` + un second `max-width` en px
par-dessus celui en `ch`) — supprimés. Tout le reste est légitime et ne doit pas être touché :
pastilles, filets `22×2px`, socles d'icônes `96px`, bouton d'appel `58px`, décors en absolu.

## Conventions en place sur le site
- Palette canonique (les 21 pages) : `--tech:#7bc62f`, `--techBright:#a3e04a`, `--forest:#1e5b34`,
  `--forestDeep:#123f24`, `--warm:#e0a636`, `--bg:#f5f8ef`, `--surface:#fff`, `--ink:#17331f`,
  `--muted:#5e6d55`, `--line:#e6ebdd`.
  Teintes secondaires (5 variables, posées sur la racine de chaque page) : `--onDark:#eaf3e6` (texte clair sur vert),
  `--onDarkSoft:#d6e6cf` (paragraphes sur vert), `--onDarkMuted:#a9c2a1` (fil d'Ariane, légendes sur vert),
  `--subtle:#8a9a80` (surtitres sur fond clair), `--glow:#f4ffe8` (halos). 512 valeurs converties en
  `var(--x,#hex)` ; 13 nuances proches fusionnées dans ces 5. Restent en dur, volontairement : `#0b381e` (fond
  de secours du décor), `#0d1f10` (ombres), `#c9dbbd` (bordure au survol du burger), `#d8ff9f`, `#e5f2d4`. Les valeurs de secours `var(--x,#hex)` ont toutes été
  alignées dessus (777 corrections) — ne jamais rintroduire `#59b529` / `#6dcc38` / `#123024`.
  `Audit code SCSS.dc.html` = rapport d'audit du code et architecture SCSS proposée.
- Survol des cards : `transform:translateY(-2px)` + `box-shadow:0 16px 26px -20px rgba(18,48,36,.4)`,
  réservé aux cards cliquables (`a.dcard-h`) — jamais sur un bloc sans lien.
- Boutons verts : fond `--tech`, survol fond `--techBright` — **le texte et l'icône restent
  vert foncé** (`--forestDeep`), aucun passage au blanc (retiré des 20 pages) ; le texte glisse
  pour révéler l'icône (`.dih-cta` / `.dih-cta-t` / `.dih-cta-i`), flèche animée `dihArrowBounce`.
- Burger (mobile + déplié) : trois traits en absolu au centre, celui du milieu s'efface
  (`burgerTop` / `burgerMid` / `burgerMidO` / `burgerBot`), 340 ms cubic-bezier(.2,.8,.25,1).
- Défilement d'ancre : jamais `scroll-behavior:smooth` (non réglable) — méthode `__glide(id)`,
  1,2 s, ease-in-out, déclenchée au `pointerdown`.
- Bloc « 4 étapes » : en déplié, illustration à gauche + card à droite, filet vertical.
- Illustrations : toujours celles de `uploads/`, versions `_ssfond` (les `_det` portent un voile),
  jamais de SVG dessiné à la main.
