#!/usr/bin/env bash
# Mise en ligne de Diag Imm'Hauts avec WP-CLI (README § Mise en ligne).
#
# Sur un WordPress déjà installé (base et wp-config.php en place) : langue fr_FR
# (cœur, thèmes, extensions), fuseau Europe/Paris, permaliens, thème et extensions
# actifs, formulaires Fluent Forms et contenus modifiables importés, puis contrôle
# final (outils/controler-installation.php).
#
# Idempotent : chaque étape vérifie l'état avant d'agir ; relancer le script ne
# refait que ce qui manque. Les imports ne réécrivent rien de ce qui existe déjà
# (formulaires créés, champs remplis dans l'admin). Aucun secret : les clés
# (Brevo, Turnstile) se saisissent dans l'admin, jamais dans ce dépôt.
#
# Usage (depuis le dépôt, sur le serveur) :
#   bash outils/installer.sh --path=/chemin/du/site [--url=https://diagimmhauts.fr] [--copier]
#
#   --path=…   dossier du WordPress (sinon : dossier courant, comme WP-CLI)
#   --url=…    adresse du site, pour un multisite ou un WordPress dans un sous-dossier
#   --copier   copie d'abord le thème et le plugin du dépôt dans wp-content
#              (sinon ils doivent déjà y être, par votre déploiement habituel)
#
# Variable WP_CLI_BIN : commande WP-CLI à utiliser (défaut : wp).

set -euo pipefail

DEPOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
WP_BIN="${WP_CLI_BIN:-wp}"
WP_ARGS=()
COPIER=0

for arg in "$@"; do
	case "$arg" in
		--path=* | --url=*) WP_ARGS+=("$arg") ;;
		--copier) COPIER=1 ;;
		-h | --help) sed -n '2,23p' "$0" | sed 's/^# \{0,1\}//'; exit 0 ;;
		*) echo "Option inconnue : $arg (voir --help)" >&2; exit 1 ;;
	esac
done

wp() { "$WP_BIN" ${WP_ARGS[@]+"${WP_ARGS[@]}"} "$@"; }
etape() { printf '\n== %s\n' "$1"; }
info() { printf '   %s\n' "$1"; }
avertir() { printf '   ATTENTION : %s\n' "$1" >&2; }
arreter() { printf '\nARRÊT : %s\n' "$1" >&2; exit 1; }

# Extension du dépôt WordPress.org : installée si absente, activée si inactive.
extension() {
	if ! wp plugin is-installed "$1"; then
		wp plugin install "$1"
	fi
	if wp plugin is-active "$1"; then
		info "$1 : active"
	else
		wp plugin activate "$1"
	fi
}

# ---------------------------------------------------------------------------------
etape "1/9 Vérifications"
command -v "$WP_BIN" > /dev/null 2>&1 || arreter "WP-CLI introuvable ($WP_BIN) : https://wp-cli.org/fr/"
wp core is-installed || arreter "WordPress n'est pas installé à cet endroit (--path) : wp core download, wp config create, wp core install d'abord."
info "WordPress $(wp core version) ; site : $(wp option get home)"

# ---------------------------------------------------------------------------------
etape "2/9 Thème et plugin du site"
THEMES="$(wp theme path)"
PLUGINS="$(wp plugin path)"
if [ "$COPIER" -eq 1 ]; then
	for paire in "theme/diag-immhauts:$THEMES/diag-immhauts" "plugin/diag-immhauts-core:$PLUGINS/diag-immhauts-core"; do
		source_dir="$DEPOT/${paire%%:*}"
		cible="${paire#*:}"
		if command -v rsync > /dev/null 2>&1; then
			rsync -a --delete --exclude node_modules --exclude .git "$source_dir/" "$cible/"
		else
			mkdir -p "$cible"
			(cd "$source_dir" && tar --exclude node_modules --exclude .git -cf - .) | (cd "$cible" && tar -xf -)
		fi
		info "copié : ${paire%%:*} → $cible"
	done
fi
wp theme is-installed diag-immhauts || arreter "thème diag-immhauts absent de $THEMES (relancer avec --copier, ou le déployer)."
wp plugin is-installed diag-immhauts-core || arreter "plugin diag-immhauts-core absent de $PLUGINS (relancer avec --copier, ou le déployer)."
info "thème et plugin présents"

# ---------------------------------------------------------------------------------
etape "3/9 Langue du site : fr_FR"
if ! wp language core is-installed fr_FR; then
	wp language core install fr_FR
fi
if [ "$(wp eval 'echo get_locale();')" = "fr_FR" ]; then
	info "fr_FR déjà active"
else
	wp site switch-language fr_FR
fi

# ---------------------------------------------------------------------------------
etape "4/9 Fuseau horaire et permaliens"
wp option update timezone_string Europe/Paris
# Pages : /<slug>/ quelle que soit la structure ; articles : /actualites/<slug>/.
if [ "$(wp option get permalink_structure)" != "/actualites/%postname%/" ]; then
	wp rewrite structure '/actualites/%postname%/'
fi
# WP-CLI n'écrit pas .htaccess (« --hard » demande apache_modules dans wp-cli.yml) : on
# vérifie seulement qu'il porte les règles de WordPress.
wp rewrite flush
HTACCESS="$(wp eval 'echo ABSPATH;').htaccess"
if [ -f "$HTACCESS" ] && grep -q "BEGIN WordPress" "$HTACCESS"; then
	info ".htaccess : règles de WordPress présentes"
else
	avertir "aucune règle de WordPress dans .htaccess. Serveur Apache : Réglages → Permaliens → Enregistrer (WordPress l'écrit). Serveur nginx : rien à faire, les règles sont dans sa configuration."
fi

# ---------------------------------------------------------------------------------
etape "5/9 Extensions"
if wp plugin is-active advanced-custom-fields-pro; then
	info "ACF Pro actif : Secure Custom Fields n'est pas installé"
elif wp plugin is-active advanced-custom-fields; then
	arreter "ACF (version gratuite) est actif : le site a besoin des fonctions Pro. Désactivez-le ; Secure Custom Fields les apporte."
else
	extension secure-custom-fields
fi
extension fluentform
extension fluent-smtp
if wp plugin is-active diag-immhauts-core; then
	info "diag-immhauts-core : actif"
else
	wp plugin activate diag-immhauts-core
fi

# ---------------------------------------------------------------------------------
etape "6/9 Thème"
if [ "$(wp option get stylesheet)" = "diag-immhauts" ]; then
	info "diag-immhauts : actif"
else
	wp theme activate diag-immhauts
fi

# ---------------------------------------------------------------------------------
etape "7/9 Traductions des extensions et des thèmes"
wp language plugin install --all fr_FR || avertir "traductions des extensions non téléchargées (réseau ?) : relancer le script plus tard."
wp language theme install --all fr_FR || avertir "traductions des thèmes non téléchargées (réseau ?) : relancer le script plus tard."

# ---------------------------------------------------------------------------------
etape "8/9 Imports"
wp eval-file "$DEPOT/outils/importer-formulaires.php"
wp eval-file "$DEPOT/outils/importer-contenus.php"

# ---------------------------------------------------------------------------------
etape "9/9 Contrôle"
if wp eval-file "$DEPOT/outils/controler-installation.php"; then
	printf '\nInstallation terminée. Étapes manuelles : README § Mise en ligne.\n'
else
	printf '\nInstallation terminée avec des erreurs (voir le contrôle ci-dessus) : corriger, puis relancer le script.\n' >&2
	exit 1
fi
