# Guide d'administration — Diag Imm'Hauts

Ce guide explique comment modifier les textes du site depuis l'administration WordPress.
Il s'adresse à la personne qui tient le site ; les détails techniques sont dans le `README.md`.

## Le principe en trois règles

1. **Un champ vide garde le texte d'origine.** Vous ne pouvez rien « casser » en vidant un champ :
   le site reprend le texte prévu par les maquettes.
2. **Seuls les textes se modifient ici.** Les pictos, illustrations, couleurs, la mise en page et les
   pages vers lesquelles mènent les liens restent ceux du site.
3. **Les listes s'affichent dans l'ordre de l'admin.** Pour les listes à picto ou à illustration
   (« picto fixe, par position »), chaque ligne garde le picto de sa position : on peut modifier les
   textes, en retirer, mais pas en ajouter au-delà du nombre prévu. Une liste raccourcie raccourcit
   la page (garder 4 engagements sur 6 n'en affiche que 4).

Après une modification, cliquez sur **Mettre à jour** (pages) ou sur le bouton d'enregistrement (pages
de réglages), puis rechargez la page du site pour vérifier.

## Le menu « Diag Imm'Hauts »

| Sous-menu | Ce qu'on y règle |
|---|---|
| **Personnalisation** | L'apparence : logo, polices, forme des boutons, variante du haut de l'accueil, décor des pages intérieures, présentation de certains blocs. |
| **Coordonnées** | Téléphone, adresse, e-mail de contact, e-mail des mentions légales et du RGPD. Repris partout : en-tête, pied de page, boutons d'appel, page Contact, mentions légales, messages des formulaires, e-mails, informations lues par Google. |
| **Avis clients** | Les avis Google du carrousel de l'accueil, et la note Google (note, nombre d'avis, lien) affichée dans les bandeaux de confiance et les e-mails. |
| **Formulaires** | Les numéros des formulaires Fluent Forms (réglés à l'installation), et l'encart **Messages des formulaires** : le message affiché après l'envoi de chaque formulaire, la mention à côté du bouton du devis, les textes indicatifs du formulaire du haut de l'accueil. |

À savoir :

- le **téléphone** se saisit tel qu'il doit s'afficher (`06 35 88 43 00`) : le lien d'appel en est déduit ;
- l'**adresse** se saisit sur une ligne : `rue, code postal commune` ;
- l'adresse qui **reçoit** les demandes des formulaires ne se règle pas ici, mais dans Fluent Forms
  (réglages du formulaire → notifications).

## Les textes des pages

Ouvrez **Pages**, puis la page à modifier : les encarts de textes sont sous l'éditeur.

| Page | Encarts |
|---|---|
| **Accueil** | *Textes de la page* : haut de page, bandeau de confiance, « À la une », prestations, « Le détail », « Qui suis-je ? », zones desservies, bloc final. *Questions fréquentes (FAQ)*. Les avis sont dans Diag Imm'Hauts → Avis clients. |
| **Nos diagnostics** | *Textes de la page* : haut de page, vente & location (les douze cartes), copropriétés, audits énergétiques, bloc final. *Bloc « 4 étapes »*, *Questions fréquentes (FAQ)*, et l'encart *Nos diagnostics* (illustration du haut de page). |
| **Professionnels** | *Textes de la page* : haut de page, profils, engagements, packs, déroulé, bloc final, popup « Compte partenaire ». *Questions fréquentes (FAQ)*. |
| **Qui suis-je** | *Textes de la page* : haut de page, bandeau de confiance, parcours (paragraphes, frise, les cinq citations), engagements, certifications, bloc final. *Bloc « 4 étapes »*, et l'encart *Qui suis-je* (choix de la citation affichée). |
| **Contact**, **simulateur** | *Haut de page* (Contact) ; *Textes de la page* (simulateur : haut de page et bloc final). |
| **Les 12 fiches** (DPE, Amiante…) | *Fiche diagnostic* : haut de page et les quatre repères. *Bloc « 4 étapes »* et la liste « À préparer avant ma visite ». *Questions fréquentes (FAQ)*. *Textes de la page* : le cadre, les obligations, le résultat, les diagnostics liés, le bloc final — et, pour le DPE, l'étiquette et la réforme. Chaque fiche ne montre que les onglets qu'elle possède. |
| **Actualités** (page des articles) | *Textes de la page* : haut de page, libellés des articles, articles « à paraître », encart final. Les articles eux-mêmes se rédigent dans **Articles** ; l'article « à la une » est l'article épinglé. |
| **Mentions légales** | *Textes de la page* : chapeau, date de mise à jour, et chaque rubrique (titre, paragraphes, informations en liste). |

## Les balises

Certains textes acceptent des balises, remplacées à l'affichage :

| Balise | Où | Devient |
|---|---|---|
| `{telephone}` | messages des formulaires, mentions légales | le téléphone des Coordonnées (lien d'appel dans les mentions) |
| `{adresse}` | mentions légales | l'adresse des Coordonnées |
| `{email}` | mentions légales | l'e-mail des mentions et du RGPD, en lien |
| `{a completer: …}` | mentions légales | le texte surligné, pour une information encore à fournir (n° de certification, assurance, médiateur…) : remplacez toute la balise par l'information |
| `%s` | Actualités, durée de lecture | le nombre de minutes de l'article |

Grâce à `{telephone}`, `{adresse}` et `{email}`, un changement de coordonnées se reporte partout sans
retoucher les textes.

**HTML simple.** Quelques textes acceptent un peu de HTML, signalé dans l'aide du champ :
`<strong>…</strong>` (gras) et `<a href="…">…</a>` (lien) dans les mentions légales ; `<sup>er</sup>`
(exposant, « 1<sup>er</sup> ») dans « À la une », les audits énergétiques et la réforme du DPE ;
`<strong>` dans l'étiquette du DPE. Ailleurs, les balises s'afficheraient telles quelles.

## Bon à savoir

- **Typographie.** Le site affiche les textes tels qu'ils sont saisis : apostrophes, guillemets et espaces
  compris. Les textes d'origine utilisent l'apostrophe ’ et une espace insécable avant « : ; ! ? » ;
  une espace ordinaire fonctionne aussi, mais le signe peut alors passer seul à la ligne.
- **Titres en deux morceaux.** Certains titres sont découpés en morceaux (« Titre, 1re ligne », « Titre
  en vert ») : chaque morceau garde sa place et sa couleur.
- **Revenir au texte d'origine** : videz le champ (ou supprimez les lignes de la liste) et enregistrez.
- **Ce qui ne se modifie pas ici** : les titres et descriptions lus par Google (réglés dans le thème),
  les champs des formulaires (Fluent Forms), les pictos et illustrations.

## Pour la personne qui installe le site

Pour que l'admin montre les textes en place plutôt que des champs vides :

```
wp eval-file outils/importer-contenus.php          # remplit les champs vides
wp eval-file outils/importer-contenus.php forcer   # réécrit aussi les champs remplis
```

Sans `forcer`, un texte déjà modifié dans l'admin n'est jamais touché.
