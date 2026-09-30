# Passation : thème WordPress Diag Imm'Hauts

Version : **1.14** — les messages de mise à jour sont titrés « Maquettes 1.x ».

## Bloc « rappel » (avant le footer)
Deux boutons : appel + formulaire. **Bureau et tablette** : le formulaire (demande de rappel / devis) est le bouton principal vert, placé en premier ; « Appeler le 06… » est le secondaire (contour blanc). **Téléphone** : l'ordre s'inverse, l'appel passe en premier avec le style principal. Boutons secondaires : 26 px de rembourrage horizontal minimum (l'icône qui apparaît au survol doit avoir de la place).

## Illustrations des diagnostics — jeu normalisé
12 fichiers `img/diag_<clé>.webp` (dpe, audit, amiante, plomb, elec, gaz, termites, merule, erp, mesurage, assainissement, dtg) : toile **800 × 640 transparente**, objet détouré, centré, **orientation déjà appliquée** (tous tournés vers le bas-gauche, comme le DPE) et **poids visuel égalisé** (même surface apparente, référence : le DPE des cards « Souvent réalisés avec »). Conséquence : **aucun miroir CSS, aucun coefficient de taille par fichier** — une seule taille par contexte (cards : boîte carrée en `contain` ; heros des fiches : 370 px bureau / 326 px tablette / 100 % de la colonne sur téléphone). Les heros de DPE et d'Audit gardent leur illustration dédiée (`ill_dpe_v6`, `ill_audit_hero`).

## Header — robustesse
Le décalage du hero sous la nav fixe (`margin-top:-H`, `padding-top` + H) doit être **recalculé quand la hauteur du header change** (polices, logo, bascule burger), pas seulement au chargement : `ResizeObserver` sur le header. Si la hauteur vaut 0 au premier passage, réessayer à l'image suivante.

## Favicon
`favicon.svg` (pastille vert forêt arrondie, chevron gauche blanc, chevron droit + cheminée en `--tech`), `favicon-32.png`, `apple-touch-icon.png` (180 px), à la racine du paquet. En WP : **Apparence › Personnaliser › Identité du site › Icône du site** avec le PNG 512 px à générer depuis le SVG, ou balises `<link rel="icon">` dans `header.php`.

## Vue d'ensemble
Refonte complète du site de **Diag Imm'Hauts** (diagnostiqueur immobilier indépendant, Maxime Dillies, Artois / Pas-de-Calais). Le site passe de 6 à 22 pages : accueil, page catalogue, 12 fiches diagnostics, simulateur, page professionnels, journal d'actualités (index + 2 articles), qui suis-je, contact/devis, mentions légales. Une page d'options dans l'admin WP pilote quelques variantes d'apparence.

Cible technique **validée avec le client** :
- **Thème WordPress sur mesure** (PHP + SCSS), blocs **ACF verrouillés** (pas Elementor, pas de page builder).
- Plugin maison **`diag-immhauts-core`** : blocs ACF, CPT Actualités, groupes de champs, page d'options. Rien d'autre.
- Formulaires : **Fluent Forms** (plugin maintenu) + envoi transactionnel **Brevo ou Postmark** + **Cloudflare Turnstile**.
- Pas de dépendance JS lourde : du JS natif, ciblé par composant.

## À propos des fichiers de design
Les fichiers `*.dc.html` sont des **références de design écrites en HTML** : des prototypes qui montrent l'apparence et le comportement attendus, **pas du code de production à copier**. Ils utilisent un runtime de maquettage (`support.js`) avec styles en ligne et petites classes de logique ; rien de cela ne doit partir en production.

La tâche est de **recréer ces pages dans un thème WordPress** : partials PHP, blocs ACF, SCSS compilé, JS natif. Les maquettes s'ouvrent directement dans un navigateur, depuis ce dossier (les chemins `img/`, `uploads/` et `screenshots/` sont relatifs).

`NOTES-PROJET.md` est le **journal de conception** complet : décisions, réglages verrouillés, pièges déjà rencontrés. **Lisez-le avant de coder.** Il fait foi en cas de doute.

## Fidélité
**Haute fidélité.** Couleurs, typographie, espacements, états de survol et animations sont définitifs et validés par le client, dans les trois formats. Recréez au pixel près.

Les heros marqués **VERROUILLÉ** dans `NOTES-PROJET.md` (accueil en déplié et en mobile, Nos diagnostics en bureau et en déplié) ont des réglages faits à l'œil. Reprenez leurs valeurs telles quelles, même si elles sortent des échelles.

---

## Points de rupture (3 formats)
| Nom | Largeur | Notes |
|---|---|---|
| Bureau | > 900 px | nav complète |
| Bureau compact | 1061–1232 px | logo 22 px, gouttière de nav 14 px, CTA du header réduit à une pastille ronde de 42 px avec icône enveloppe (l'icône « bump » au survol) |
| — | ≤ 1060 px | le CTA du header disparaît |
| — | ≤ 1000 px | le téléphone du header disparaît |
| **Déplié** (tablette) | 641–900 px | burger, mises en page propres (voir notes) |
| **Mobile** | ≤ 640 px | burger, heros en 2 colonnes, bouton d'appel fixe |

En maquette, les tests JS s'appellent `__isNarrow()` (≤ 900) et `__isPhone()` (≤ 640), et `_depl = narrow && !phone`. En SCSS : mixins `@include bp(deplie)` / `bp(mobile)`.

`html, body { overflow-x: clip; }` sur tout le site (**pas** `hidden`, qui casserait `position: sticky`).

## Design tokens

### Couleurs, à déclarer en custom properties sur `:root`
| Variable | Hex | Usage |
|---|---|---|
| `--tech` | `#7bc62f` | boutons principaux, accents, filets |
| `--techBright` | `#a3e04a` | survol des boutons, accents sur fond foncé |
| `--forest` | `#1e5b34` | titres, heros, fond foncé |
| `--forestDeep` | `#123f24` | texte et icônes des boutons verts, voiles |
| `--warm` | `#e0a636` | étoiles, alertes |
| `--bg` | `#f5f8ef` | fond des pages |
| `--surface` | `#ffffff` | cards |
| `--ink` | `#17331f` | texte courant |
| `--muted` | `#5e6d55` | texte secondaire |
| `--line` | `#e6ebdd` | bordures, filets |
| `--onDark` | `#eaf3e6` | texte clair sur vert |
| `--onDarkSoft` | `#d6e6cf` | paragraphes sur vert |
| `--onDarkMuted` | `#a9c2a1` | fil d'Ariane, légendes sur vert |
| `--subtle` | `#8a9a80` | surtitres sur fond clair |
| `--glow` | `#f4ffe8` | halos |

Restent en dur, volontairement : `#0b381e` (fond de secours du décor), `#0d1f10` (ombres), `#c9dbbd` (bordure du burger au survol), `#d8ff9f`, `#e5f2d4`.

**Ne jamais réintroduire** `#59b529`, `#6dcc38`, `#123024` ni `#0d241b` : ce sont d'anciennes teintes fusionnées dans la palette.

**Couleurs de la logique JS et des SVG : portées.** Les 14 teintes de la palette passent partout par `var(--x,#hex)` — y compris dans les chaînes CSS générées par le JS (257 valeurs) et dans les SVG en ligne, où `fill` / `stroke` / `stop-color` sont passés de l'attribut à la propriété CSS du `style` (133 valeurs ; `var()` ne fonctionne pas dans un attribut de présentation). Restent en dur, volontairement : `#ffffff` / `#fff`, `#06210f` (ombres), l'échelle réglementaire de l'étiquette DPE A→G (`#2ecc71` `#5bd12a` `#93d420` `#e8d219` `#f2b705` `#ef7d1b` `#e5451f` — à poser en constantes `$dpe-a…g`), les pastilles `#e0d247` / `#e6a24a` de la fiche Électricité, les masques SVG (`#fff` / `#000`, fonctionnels) et les couleurs natives de l'admin WP (`#2271b1`, `#f0f0f1`, `#1d2327`, `#50575e`, `#c3c4c7`, `#dcdcde`, `#8c8f94`).

### Typographie
- **Manrope** 700/800 : titres, chiffres, boutons, logo en toutes lettres. Titres en `letter-spacing: -0.02em` à `-0.035em`.
- **Inter** 400/500/600 : texte courant, formulaires, légendes.
- Échelle (px) : **11 · 12,5 · 14 · 15,5 · 17 · 19 · 22 · 26** (+ 31 · 34 · 36 · 44 pour l'affichage). Accents volontaires hors échelle : 10 px (sous-titre du logo, « LIGNE DIRECTE ») et toute borne ≥ 48 px (grands titres de fiche, le « 1,9 » de la card actualité à 58 px).
- Titres fluides : `clamp()` — **73 formules distinctes** dans le balisage. **Un seul rythme par couple de bornes** pour les espacements, sauf `clamp(16px,4.2vw,24px)` réservé à la gouttière de la nav (le décalage des menus déroulants en dépend). Les titres gardent des rythmes distincts sur les couples 26→36, 26→44 et 31→44 : un titre de hero doit grandir plus vite qu'un titre de section.

### Espacements
Gouttières et marges : **4 · 8 · 12 · 16 · 24 · 40 · 56** px (+ 72 · 96 dans les `clamp()`). Exceptions : `gap: 2px` des filets, `gap: 11px` des listes de préparation des fiches.

### Rayons
**4 · 10 · 16 · 26 · 44** px, et `999px` pour les pilules.

### Ombres
- Survol des cards cliquables : `transform: translateY(-2px); box-shadow: 0 16px 26px -20px rgba(18,48,36,.4)`, **uniquement** sur les `a.dcard-h` (jamais sur un bloc sans lien).
- Menu burger : `0 26px 44px -26px rgba(9,26,15,.4)`.
- Illustrations de hero : `filter: drop-shadow(0 26px 44px rgba(6,33,15,.45))`.

---

## Composants communs

### Header (commun aux 22 pages) et nav transparente
- **Nav transparente sur les 22 pages et dans les 3 formats.** Le header est épinglé (`position: fixed`, `left/right: 0`) avec un espaceur dans le flux. Le hero (1re `section` après le header) reçoit `margin-top: -H` et `padding-top: padding d'origine + H`, où H est la hauteur du header, exposée en `--nvH`. Sur fond transparent, logo, items, téléphone et burger sont en blanc (le vert clair reste sur le chevron du logo).
- **Passage au blanc par événement, pas par distance :**
  - **21 pages intérieures, tous formats** : au **1er cran** de molette, ou dès `scrollY > 0` (le texte de la nav ne doit jamais passer sur celui du hero) ;
  - **accueil** : au **2e cran** en bureau (repli `y > 220 px` pour le clavier et la barre de défilement), au 1er cran en déplié et mobile ;
  - crans de pavé tactile regroupés par fenêtres de 140 ms ;
  - transition CSS de 420 ms `cubic-bezier(.4,0,.2,1)`.
- **Un seul état fait foi (`solid`)**, réconcilié à chaque image : si `scrollY <= 0`, la nav redevient transparente, car aucun événement `scroll` n'est garanti au retour en haut. Burger ouvert : nav forcée en blanc.
- **Item de la page en cours :** gras (600), **même couleur que les autres items** : blanc sur nav transparente, vert foncé (couleur héritée de la nav) sur nav blanche — jamais `--tech`. Items de 1er niveau seulement. **Dans les menus déroulants et le burger**, la page en cours est signalée (`aria-current="page"`, pas de lien) : fond `--bg`, texte `--forest` en 700, filet vertical `--tech` de 3 px à gauche. **Petit filet vert `--tech` permanent** (28 × 2 px, aligné sur le début du texte, 6 px dessous) sous l'item de 1er niveau de la page ou de la rubrique en cours (`[data-cur]`) : sur une fiche, « Nos diagnostics » ; sur un article, « Actualités ».
- **Carrousel des avis (accueil) :** défilement horizontal à aimantation, cards jusqu'aux bords du contenu (inchangé). En bureau et tablette, deux flèches **sous** le carrousel, alignées à droite : chevrons blancs de 22 px sans fond ni contour (zone cliquable 44 px), vert clair au survol. En début de liste la flèche gauche est grisée (opacité 0,3, désactivée), idem pour la droite en fin de liste. Un clic avance d'une card. Masquées sur téléphone.
- **Survol sur nav blanche :** aucun changement de couleur, seul un filet vert clair glisse sous l'item. Idem sur le numéro de téléphone.
- **Ordre du menu « Professionnels » :** « Syndics, agences & bailleurs » (= la page ouverte par le clic sur « Professionnels ») en premier, puis « DTG & DPE collectif ». Même ordre dans le burger.
- **Menus déroulants :**
  - alignés à gauche sur l'item parent : `left: calc(-1 * clamp(16px,4.2vw,24px))`, items à `margin-left: -9px` ;
  - ouverture en volet de haut en bas (`dihUnfold`), items en cascade (`dihItemIn`) ;
  - le grand panneau passe en une colonne de 320 px sous 1140 px.
- **Nav de bureau :** pas d'item « Accueil » (le logo fait le lien) ; « Actualités » vient avant « Qui suis-je ». « Accueil » reste dans le burger.
- **Logo en nav transparente :** SVG **en ligne**, pas `<img>`. Il est formé de 2 tracés avec les classes `dih-lg-a` (chevron foncé) et `dih-lg-b` (chevron clair et cheminée), pilotés par la feuille de style de la nav : ils passent du blanc / vert clair aux verts de la charte en 420 ms.
  - **Piège :** les tracés descendent à `y = 124` alors que le `viewBox` coupe à `116`. Sinon un liseré d'un pixel apparaît en bas.
- **Burger** (déplié et mobile) : trois traits en absolu, celui du milieu s'efface en 340 ms `cubic-bezier(.2,.8,.25,1)`.
- **Accueil en mobile :** le header du site est masqué ; c'est la barre du hero qui fait la nav. Voir `NOTES-PROJET.md`, section « Mobile — hero de l'accueil ».

### Boutons
- **Principal** (`.dih-cta`) :
  - au repos : fond `--tech`, texte `--forestDeep`, Manrope 800 ;
  - au survol : fond `--techBright`, **le texte reste vert foncé** (jamais blanc) ;
  - animation au survol : le libellé (`.dih-cta-t`) glisse de −15 px, l'icône (`.dih-cta-i`) entre depuis la droite (opacité de 0 à 1, `translate(30px) → 0`, 340 ms `cubic-bezier(.34,1.2,.4,1)`).
- **Icône du bouton de rappel :** enveloppe (et non un téléphone).
- **Secondaire** : contour blanc à 40 %, bordure `--techBright` au survol ; la flèche vers la droite rebondit (`dihArrowBounce`, 0,7 s en boucle) **au survol seulement**.
- **Forme :** réglage global `formeBoutons` (voir Réglages).
- **Bouton d'appel fixe** en bas à droite (déplié et mobile) : 58 px, bordure `1.5px solid var(--techBright)`.

### Décor des heros (terrils)
- **19 pages intérieures** (toutes sauf Accueil et Qui suis-je) :
  - image : `img/hero_bg_sans_maison_large.webp` ;
  - **bureau : taille et position FIXES**, indépendantes de la largeur de fenêtre : `1655px auto`, calée à `calc(50% + 190px) max(-280px, 82%)` — le `max()` empêche le haut de l'image de remonter au-dessus de −280 px sur les heros courts, pour que le sommet des terrils reste **toujours sous les textes de la nav transparente** (référence : DPE et Audit) — le bord gauche de l'image est à 637 px à gauche du centre du contenu (cadrage de référence : fenêtre de 1 273 px). Au-delà d'environ 1 290 px, un fondu de 120 px vers `#0b381e` masque le bord gauche de l'image ; au-delà de 2 020 px, idem à droite ;
  - déplié : `max(130%, 1180px) auto`, calée à `0% 82%` ;
  - mobile : `auto 760px`, calée à `right -545px top calc(-249px + var(--nvH))`, fond de secours `#0b381e`.
- **Voiles** : un voile `--forestDeep`, de 80 % à gauche jusqu'à 0 à 60 % de la largeur, plus un fondu en bas sur 22 %.
- **Ajustements page par page :**
  - pages sans pastille au-dessus du titre (Nos diagnostics, Simulateur, Actualités, Contact, Mentions) : `padding-bottom: 40px` sur le fil d'Ariane en mobile, pour poser l'illustration sur l'herbe ;
  - Contact, mobile : décor à `top -289px` ;
  - Actualités, mobile : décor à `top -329px`, illustration `translateY(28px) scale(1.45)` depuis le bas ;
  - Qui suis-je : décor décalé à `-260px 82%` en déplié, et en mobile `auto 380px` calé en haut à droite.
- **Ancien décor :** grille isométrique et halos, conservé derrière le réglage `decorHero: grille`.
- **Accueil :** décor distinct (`hero_bg_2000px.webp` et ses tuiles latérales `_edge_left` / `_edge_right`). Mobile : `bg_mobile1.webp`, `128% auto` à `62% 8%` (**pas `cover`**).

### Heros mobiles en 2 colonnes
Nos diagnostics, Simulateur, les 12 fiches, Actualités.
- **Disposition :** titre à gauche, illustration à droite (colonne de 34 à 36 %), puis sous-titre pleine largeur, puis le contenu propre à la page.
- **Technique :** la colonne texte passe en `display: contents` sur téléphone, et chaque enfant est placé explicitement en `grid-row`.
- **Pastilles au-dessus du titre, en mobile :** classe `.dih-hero-pill`, fond `color-mix(--forest 78 %)`, `backdrop-filter: blur(8px)`, bordure `--techBright` à 60 %.

### Cards
- **Standard « accueil »** : bordure de 2 px, illustration qui déborde, alternance blanc / vert clair. Il sert sur l'accueil, Nos diagnostics, Professionnels et les résultats du simulateur.
- **Illustrations des cards de l'accueil et de la grille « Le détail » :** en `background-image`, avec un `aspect-ratio` propre à chaque fichier. Un ratio faux se voit tout de suite, comme un rognage en haut ou en bas.
- **Fiches** (Amiante, Plomb, Électricité, Gaz, Termites, ERP, Mesurage, Assainissement, Mérule) : les sessions « Le cadre du contrôle » et « Sur place » sont **empilées**, avec 56 px entre elles. Leurs cards vont **3 par ligne** : `repeat(auto-fit, minmax(max(200px, calc((100% - 24px)/3)), 1fr))`.

### Bloc « 4 étapes » (toutes les fiches)
- **Deux dispositions**, réglage global `etapesDispo` :
  - `en-ligne` (défaut) : 4 socles illustrés reliés par un filet, 4 cards dessous ;
  - `deux-colonnes` : grande illustration à gauche, damier de 2×2 à droite.
- **En déplié :** illustration à gauche, card à droite, filet vertical (rail à `left: 48px`).
- **Socles d'icônes :** réglage `stepIcons` (`socle-vert` par défaut, ou `socle-blanc`).

### Défilement vers une ancre
Jamais `scroll-behavior: smooth`, dont la durée n'est pas réglable. Utiliser une fonction `glide(id)` : 1,2 s, ease-in-out, déclenchée au `pointerdown`.

---

## Pages : ce qu'il faut savoir
| Page (maquette) | URL canonique | Points clés |
|---|---|---|
| `Diag Imm'Hauts - Accueil` | `/` | Hero (4 variantes), trust bar (Google 5,0 ★ · Certifié Bureau Veritas · Rendez-vous sous 48 h), 4 cards, « Le détail » (3 variantes), zones + « Vérifier ma commune », FAQ, JSON-LD `LocalBusiness` |
| `Nos diagnostics` | `/diagnostics-immobiliers/` | 3 entrées du hero (réglage `entreesHero`), grille de cards, CTA du simulateur **sous** la grille, bloc audits en 2 colonnes. **Verrouillée en bureau et en déplié** |
| `DPE` … `Assainissement` (12 fiches) | `/dpe/`, `/diagnostic-amiante/`, `/diagnostic-plomb-crep/`, `/diagnostic-electricite/`, `/diagnostic-gaz/`, `/diagnostic-termites/`, `/diagnostic-merule/`, `/etat-des-risques-erp/`, `/mesurage-carrez-boutin/`, `/assainissement-non-collectif/`, `/audit-energetique/`, `/dtg-dpe-collectif/` | Même gabarit : hero, sessions, 4 étapes, préparation, FAQ. **Un seul bloc ACF « Fiche diagnostic » à champs répétables** |
| `Simulateur diagnostics` | `/simulateur-diagnostics-obligatoires/` | Formulaire à états (motif, type, année, équipements), résultats en cards |
| `Professionnels` | `/professionnels-agences-notaires-syndics/` | Cards Agences / Notaires / Syndics, 6 engagements, packs, 4 étapes de commande |
| `Actualites` | `/actualites/` | Index du CPT : card à la une, cards publiées, cards « à paraître » |
| `Actu reforme DPE 2026`, `Actu calendrier location` | `/actualites/<slug>/` | Gabarit `single-actualite` : frise, échelle A→G, cards d'échéances |
| `Qui suis-je` | `/maxime-dillies-diagnostiqueur/` | Hero avec portrait (halo vert), trust bar identique à l'accueil, citation (réglage de 5 choix) |
| `Contact` | `/contact-devis/` | Formulaire Fluent Forms, horaires, zone |
| `Mentions legales` | `/mentions-legales/` | `noindex, follow` |

### E-mails des formulaires (1.14)
Gabarits prêts à l'envoi dans `emails/` (accusé client + notification Max, un gabarit par destinataire, bloc variable par formulaire). Spécification : `emails/README-EMAILS.md`. Maquette : `E-mails formulaires - propositions.dc.html`.

### Fonctions à coder
- **Demande de rappel** : popup ouverte depuis la nav, le hero et chaque fiche ; formulaire Fluent Forms court. Sur téléphone, le champ « message » est masqué dans le hero et reste dans la popup.
- **Simulateur** : logique 100 % côté client. Entrées : motif (vente ou location), type de bien, tranche d'année (avant 1949, 1949–1996, après 1997), copropriété, installations électricité et gaz de plus de 15 ans, zone termites ou mérule. Les règles sont dans la classe logique de `Simulateur diagnostics.dc.html` ; à porter en JS natif.
- **Vérifier ma commune** (accueil, `#zones`) :
  - table d'environ 90 codes postaux et communes, suggestions dès 2 caractères (6 au plus, un clic remplit le champ) ;
  - trois réponses : 62 = dans la zone, 59 et 80 = en limite de zone, autre = hors zone, avec un lien vers Contact ;
  - la réponse nomme la commune, par exemple « Oui, j'interviens à Arras (62000)… ».
- **Champ « message » en mobile** : masqué dans le hero (`heroMsgShow`), il reste dans la popup (voir « Demande de rappel »).

---

## Réglages globaux (page d'options ACF)
Maquette : `Admin WP - Personnalisation.dc.html`. Page unique en trois onglets WP (`nav-tab`) : **Identité du site** · **Accueil** · **Pages intérieures**. Chaque réglage est un champ select de la page d'options, lu par le partial PHP concerné : **une valeur pour tout le site**.

| Champ ACF | Valeurs | Défaut | Portée |
|---|---|---|---|
| `logo_site` | `toitures` · `actuel` · `terrils` | `toitures` | partial header (et footer) |
| `forme_boutons` | `pilule` · `arrondi` | `pilule` | variable SCSS / classe sur `body` |
| `police_titre` | `manrope` · `outfit` · `space-grotesk` · `archivo` | `manrope` | enqueue Google Fonts + variable |
| `police_texte` | `inter` · `instrument-sans` · `source-sans-3` | `inter` | idem |
| `hero_accueil` | `terrils-boutons` · `terrils-barre` · `max-bandeau` · `sansBG` | `terrils-boutons` | front-page |
| `detail_style` | `ouvert` · `clair` · `damier` | `ouvert` | front-page, bloc `#detail` |
| `decor_hero` | `terrils` · `grille` | `terrils` | partial du hero intérieur |
| `entrees_hero` | `sommaire` · `cartes-blanches` | `sommaire` | Nos diagnostics |
| `etapes_dispo` | `en-ligne` · `deux-colonnes` | `en-ligne` | bloc 4 étapes (toutes les fiches) |
| `step_icons` | `socle-vert` · `socle-blanc` | `socle-vert` | bloc 4 étapes |

**Réglages propres à une page**, en champ ACF de la page :
- `citation` sur Qui suis-je : `comprendre`, `mesurer`, `terrain`, `interlocuteur`, `preparation`.
- `hero_illustration` sur Nos diagnostics : `livrets` ou `maison-verte`.

**Variantes de logo :**

| Valeur | Libellé dans l'admin | Nav blanche | Nav transparente |
|---|---|---|---|
| `toitures` | « Ancien logo mis à jour » | `uploads/logo-toitures.svg` | SVG en ligne de 404×116 |
| `terrils` | « Nouveau logo » | `uploads/logo-terrils-nav.svg` | SVG en ligne, `currentColor` et terril avant en `--techBright` |
| `actuel` | « Ancien logo » | `uploads/logo-diag.png` | — |

Vignettes de l'admin : `uploads/*.jpg` pour les 4 heros de l'accueil (1300×685, cadre `aspect-ratio: 1.9`) et `screenshots/admin/*.png` pour les autres réglages.

---

## SEO
- Chaque page porte : `<title>`, meta description, canonique, balises `og:*` et directive robots. Voir le bloc `<!-- seo -->` en tête du `<helmet>` de chaque maquette. À porter via Yoast / RankMath, ou dans le `wp_head` du thème.
- **Accueil :** JSON-LD `LocalBusiness`.
- **Chaque page :** un seul `h1`.
- **Plan de migration** (redirections 301, à poser le jour de la bascule) :

| Ancienne URL | Nouvelle URL |
|---|---|
| `/diagnostics-immobiliers-vente-location/` | `/diagnostics-immobiliers/` |
| `/wp/diagnostics-immobiliers-vente-location/` | `/diagnostics-immobiliers/` |
| `/diagnostics-immobiliers-coproprietes-collectivites/` | `/dtg-dpe-collectif/` |
| `/audits-energetiques/` | `/audit-energetique/` |
| `/max-dillies-diag-imm-hauts/` | `/maxime-dillies-diagnostiqueur/` |
| `/demandez-un-rappel/` | `/contact-devis/` |
| `/wp/demandez-un-rappel/` | `/contact-devis/` |
| `/actualites-diagnostics-immobiliers/` | `/actualites/` (journal conservé) |

`/` et `/mentions-legales/` ne changent pas. Détail et chantiers SEO : `Audit SEO.dc.html`.

## Contenus arrêtés
- **Chiffres :** 8 ans d'expérience, 12 avis Google (5,0), 12 diagnostics, certifié Bureau Veritas (organisme accrédité Cofrac).
- **Délais :** devis sous 24 h ouvrées, rendez-vous sous 48 h, rapport sous 48 h (24 h pour les partenaires).
- **Adresse :** 19 route nationale, 62690 Berles-Monchel. Pas de réception du public, donc jamais le mot « cabinet ».
- **Structure juridique :** SASU au capital de 5 000 €.
- « peut-être » toujours insécable (`white-space: nowrap`).
- **Manquent, à obtenir du client :** numéro de certification, assureur RC pro, médiateur de la consommation (mentions légales).

## Assets
- `img/*.webp` : les 73 images servies (une seule version par illustration : les `_ssfond`, affichées en miroir via `scale: -1 1` dans les heros des fiches), en qualité 0,82.
  - décors : 2 000 px au plus (1 672 px pour `hero_bg_sans_maison_large`) ;
  - illustrations : 1 000 px ;
  - pictos d'étapes et d'items : 480 px ;
  - photos de Max : 900 px.

  Les illustrations sont faites pour le projet : les versions `_ssfond` sont détourées, les `_det` portent un voile. **Ne pas redessiner en SVG.** Toute nouvelle illustration passe en WebP dans `img/`.
- **Chemins dynamiques** : les pictos du bloc 4 étapes (`ill_stb_*` / `ill_st_*`) et les illustrations des cards « diagnostics liés » sont construits en JS (`'img/' + clé + '.webp'`) — à porter en tableau PHP.
- `uploads/` : logos (`logo-toitures.svg`, `logo-terrils-nav.svg`, `logo-terrils.svg`, `logo-diag.png`, `logo-1784225863936.png`), `google.svg` (trust bar) et les 4 vignettes JPG de l'admin.
- `screenshots/admin/` : vignettes des réglages de l'admin.
- Polices : Google Fonts (Manrope, Inter et les alternatives de l'admin). À auto-héberger de préférence (RGPD).

## Fichiers
- **22 pages du site** : `Diag Imm'Hauts - Accueil`, `Nos diagnostics`, `DPE`, `Audit energetique`, `DTG et DPE collectif`, `Amiante`, `Plomb`, `Electricite`, `Gaz`, `Termites`, `Merule`, `ERP`, `Mesurage`, `Assainissement`, `Simulateur diagnostics`, `Professionnels`, `Actualites`, `Actu reforme DPE 2026`, `Actu calendrier location`, `Qui suis-je`, `Contact`, `Mentions legales`, toutes en `.dc.html`.
- **Admin :** `Admin WP - Personnalisation.dc.html`, la spécification de la page d'options.
- **Rapports :** `Audit SEO.dc.html` et `Audit code SCSS.dc.html`, qui contient l'architecture SCSS proposée : 7-1 allégée, tokens, mixins de points de rupture.
- **Notes :** `NOTES-PROJET.md`, le journal de conception.
- **Runtime :** `support.js`, pour ouvrir les maquettes seulement. **Ne pas embarquer dans le thème.**

## Ordre de travail suggéré
1. Structure du thème et du plugin `diag-immhauts-core`, tokens SCSS, polices.
2. Header, nav transparente et footer (le plus délicat : reprendre la logique décrite plus haut).
3. Gabarit « Fiche diagnostic » (12 pages d'un coup), puis Nos diagnostics.
4. Accueil (heros, « Le détail », « Vérifier ma commune »).
5. Simulateur, Professionnels, Qui suis-je, Contact (avec Fluent Forms, Turnstile et l'envoi transactionnel).
6. CPT Actualités et ses gabarits.
7. Page d'options ACF, puis branchement de chaque réglage.
8. SEO, redirections, puis contrôle dans les 3 formats face aux maquettes.
