# Prompt de démarrage — Claude Code

À coller tel quel dans Claude Code, à la racine d'un dépôt vide, avec ce dossier `design_handoff_theme_wp/` copié dedans.

---

Tu construis le site WordPress de Diag Imm'Hauts (diagnostiqueur immobilier, Pas-de-Calais) à partir des maquettes HTML de `design_handoff_theme_wp/`. Lis d'abord `README.md` (spécification complète) puis `NOTES-PROJET.md` (historique des décisions). Les fichiers `*.dc.html` sont la **référence visuelle** : ne les embarque pas, reproduis-les au pixel près en PHP/SCSS.

## Livrables

1. **Thème `diag-immhauts`** (`wp-content/themes/diag-immhauts/`)
   - Thème classique PHP (pas de FSE, pas d'Elementor), SCSS compilé en un seul `style.css` (Dart Sass, script `npm run build`).
   - `header.php` / `footer.php` communs aux 22 pages ; nav transparente + passage au blanc (voir README § Header) en JS vanilla, sans jQuery.
   - Un template par type : `front-page.php`, `page-nos-diagnostics.php`, `single-diagnostic.php` (13 fiches), `page-simulateur.php`, `page-professionnels.php`, `page-qui-suis-je.php`, `page-contact.php`, `home.php` + `single.php` (Actualités), `page.php` (mentions).
   - Partials dans `template-parts/` : hero, décor terrils, bloc 4 étapes, cards, bandeau de confiance, CTA rappel.
   - Tokens du README en custom properties sur `:root` ; échelles typo / espacements / rayons respectées, aucun hex hors palette.
   - Images : `img/*.webp` du paquet, servies depuis le thème ; polices auto-hébergées (`assets/fonts/`, woff2).

2. **Plugin `diag-immhauts-core`** (`wp-content/plugins/diag-immhauts-core/`)
   - CPT `diagnostic` (13 fiches) et catégorie d'articles pour les Actualités.
   - Blocs ACF verrouillés (ACF Pro) pour les sections éditables : hero, 4 étapes, FAQ, cards liées, bandeau.
   - Page d'options « Personnalisation Diag Imm'Hauts » conforme à `Admin WP - Personnalisation.dc.html` (3 onglets, sélecteurs à vignettes) : logo, forme des boutons, polices titres/texte, hero accueil, bloc « Le détail », décor des hauts de page, entrées Nos diagnostics, bloc 4 étapes. Chaque réglage = une option lue par le partial correspondant.
   - Simulateur : logique JS portée depuis `Simulateur diagnostics.dc.html` (règles de date de permis, zone, type de bien).
   - Champ « Vérifier ma commune » : table des codes postaux en JSON dans le plugin.
   - Aucun formulaire maison : intégration **Fluent Forms Pro** (rappel, devis, contact) + Cloudflare Turnstile ; envoi transactionnel via **Brevo** (SMTP, plugin officiel ou FluentSMTP).
   - Stack retenue (≈ 110 €/an) : ACF Pro + Fluent Forms Pro + Brevo gratuit. Tant que les licences ne sont pas fournies, coder contre les API ACF / Fluent Forms et prévoir un repli propre (message d'admin) si le plugin est absent.

## Ordre de travail

1. Squelette thème + plugin, build SCSS, tokens, polices.
2. Header / footer / nav transparente (3 formats) — valider sur une page vide avant d'aller plus loin.
3. Accueil, puis une fiche (DPE, page de référence du bloc 4 étapes), puis les 12 autres fiches par le même template.
4. Pages restantes, Actualités (2 articles rédigés).
5. Page d'options + branchement de chaque réglage.
6. SEO (titres, descriptions, canoniques, JSON-LD LocalBusiness, 7 redirections du README), puis contrôle 1440 / 820 / 390 px contre les maquettes.

## Règles

- Fidélité visuelle d'abord ; en cas de doute, la maquette `.dc.html` fait foi, puis le README.
- Pas de dépendance front lourde (pas de jQuery, pas de framework JS).
- Défilement d'ancre : fonction `glide()` 1,2 s ease-in-out, jamais `scroll-behavior:smooth`.
- Commits courts et fréquents, une étape = une PR.
