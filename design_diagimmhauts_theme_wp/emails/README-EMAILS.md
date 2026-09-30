# E-mails des formulaires

Version : **1.14c**. Maquette de référence : `E-mails formulaires - propositions.dc.html` (piste **1a** retenue pour le client, **1c** pour Max ; 1b non retenue). Réglage `formulaire` de la maquette = aperçu des 3 contenus.

## Fichiers
- `email-client.html` : accusé de réception client, prêt à l'envoi (tableaux, styles en ligne, 600 px, Arial). Exemple rempli = formulaire devis.
- `email-max.html` : notification interne, même technique. Exemple rempli = formulaire devis.
- `email-client-apercu.html`, `email-max-apercu.html` : **aperçus** (valeurs d'exemple, images locales) pour contrôler le rendu — ne pas utiliser pour l'envoi.
- `signature-maxime.png` (180 px, affichée à 60), `logo-email-blanc.png` (168 × 48, affiché à 56 × 16) : à servir en **https** depuis le thème. Pas de SVG ni de WebP dans les e-mails (Gmail / Outlook).

## Principe : un gabarit, un bloc variable
Chaque formulaire Fluent Forms a ses 2 notifications (client + Max). Le HTML est le même ; seules les zones balisées `<!-- VAR:… -->` changent. Suggestion : un partial PHP par gabarit, les zones variables fournies par formulaire, injecté via le filtre des notifications Fluent Forms (ou collé tel quel dans l'éditeur HTML de la notification).

### E-mail client
| Zone | Rappel (popup) | Devis (Contact) | Simulateur |
|---|---|---|---|
| Objet | Je vous rappelle très vite — Diag Imm'Hauts | Votre demande de devis est bien arrivée | Votre liste de diagnostics et la suite |
| Préheader | Votre demande de rappel est bien arrivée. Je vous appelle sous 24 h ouvrées. | Devis détaillé sous 24 h ouvrées. Récapitulatif de votre demande à l'intérieur. | La liste calculée par le simulateur, et votre devis ferme sous 24 h ouvrées. |
| Titre | Votre demande est bien arrivée (identique pour les 3) | idem | idem |
| Salutation | Bonjour {Prénom Nom}, (identique pour les 3) | idem | idem |
| Intro | Merci pour votre demande de rappel. Je vous appelle sous 24 heures ouvrées, souvent le jour même, entre deux interventions. | Merci pour votre demande de devis. Je vous envoie un prix détaillé sous 24 heures ouvrées. | Merci d'avoir utilisé le simulateur. Je vérifie la liste ci-dessous et vous envoie un devis ferme sous 24 heures ouvrées. |
| Récap | Nom, Téléphone, Message | Bien (type · surface · année), Commune, Motif, Échéance, Diagnostics | Projet, Bien (type · année · commune), Installations (cases cochées : copropriété, électricité / gaz de plus de 15 ans, zones termites / mérule), Obligatoires |
| 3 étapes | appel sous 24 h · point sur le bien · devis ferme puis RDV sous 48 h | étude · devis sous 24 h · RDV 48 h + rapport 48 h | vérification · devis ferme sous 24 h · RDV 48 h + rapport 48 h |

Textes exacts : dans la logique de la maquette (`renderVals`). Une ligne de récap dont le champ est vide est **omise**.

### E-mail Max
- Objet : `[Tag] Prénom Nom · Commune` — tag = `Rappel demandé` | `Demande de devis` | `Simulateur`. **Répondre-à** = e-mail du client.
- Bandeau vert : tag + date et heure. Sous le nom : ligne de synthèse.
- Détail : **une ligne par champ du formulaire**, les diagnostics sur une seule ligne ; puis Message (bloc omis si vide) ; puis les boutons **Appeler** (vert) et **Répondre par e-mail** (pilule vert foncé), **sous** les infos.
- **Page d'origine** : `{embed_post.title}` / `{embed_post.permalink}` (page où le formulaire a été envoyé — pour la popup de rappel, la page consultée). « Arrivé depuis » : champ caché `provenance`, rempli en JS à l'ouverture de la page Contact / Simulateur avec la page interne précédente (`document.referrer` du même domaine, ou `sessionStorage` de la dernière page vue) ; ligne réduite à la page d'origine si vide.

## Smartcodes maison (plugin `diag-immhauts-core`)
- `{dih.avis_note}`, `{dih.avis_nombre}`, `{dih.avis_url}` : **même source que la trust bar du site** (option ACF ou synchro Google), jamais en dur dans le gabarit. Si la source est vide : afficher à la place « Certifié **Bureau Veritas** » (Bureau Veritas en `#a3e04a`), « organisme accrédité Cofrac » dessous.
- `{dih.zone_statut}` : « en zone » (62) | « limite de zone » (59, 80) | « hors zone », même règle que « Vérifier ma commune ».

## Envoi
Expéditeur `contact@diagimmhauts.fr` via Brevo (SPF + DKIM + DMARC sur le domaine). Tester Gmail, Outlook (bureau + web), Apple Mail, en clair et en sombre.
