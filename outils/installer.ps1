<#
.SYNOPSIS
  Relie le thème et le plugin du dépôt au site LocalWP, puis compile le SCSS.

.DESCRIPTION
  Crée deux liens symboliques :
    wp-content\themes\diag-immhauts        -> <dépôt>\theme\diag-immhauts
    wp-content\plugins\diag-immhauts-core  -> <dépôt>\plugin\diag-immhauts-core
  Un lien symbolique demande le mode développeur de Windows ou une console
  « Exécuter en tant qu'administrateur ». À défaut, le script crée une jonction
  (même effet pour WordPress, sans droits particuliers).
  Si un dossier réel existe déjà à l'emplacement, il est renommé en *.sauvegarde-<date>.

.EXAMPLE
  powershell -ExecutionPolicy Bypass -File .\outils\installer.ps1
  powershell -ExecutionPolicy Bypass -File .\outils\installer.ps1 -SansBuild
#>
param(
  [string]$Site = "C:\Users\Irfannn\Local Sites\diag-immhauts\app\public",
  [switch]$SansBuild
)

$ErrorActionPreference = "Stop"
$Depot = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path

if (-not (Test-Path (Join-Path $Site "wp-content"))) {
  Write-Host "Site WordPress introuvable : $Site" -ForegroundColor Red
  Write-Host "Relancez avec -Site `"<chemin vers app\public>`"."
  exit 1
}

function Relier([string]$Lien, [string]$Cible) {
  if (Test-Path $Lien) {
    $item = Get-Item $Lien -Force
    if ($item.LinkType) {
      $item.Delete()  # supprime le lien seul, jamais le contenu de la cible
    } else {
      $sauvegarde = "$Lien.sauvegarde-" + (Get-Date -Format "yyyyMMdd-HHmmss")
      Rename-Item $Lien $sauvegarde
      Write-Host "  Dossier existant renommé : $sauvegarde" -ForegroundColor Yellow
    }
  }
  try {
    New-Item -ItemType SymbolicLink -Path $Lien -Target $Cible | Out-Null
    Write-Host "  Lien symbolique : $Lien -> $Cible" -ForegroundColor Green
  } catch {
    New-Item -ItemType Junction -Path $Lien -Target $Cible | Out-Null
    Write-Host "  Jonction (lien symbolique refusé sans droits admin) : $Lien -> $Cible" -ForegroundColor Green
  }
}

Write-Host "Liaison du thème et du plugin"
Relier (Join-Path $Site "wp-content\themes\diag-immhauts") (Join-Path $Depot "theme\diag-immhauts")
Relier (Join-Path $Site "wp-content\plugins\diag-immhauts-core") (Join-Path $Depot "plugin\diag-immhauts-core")

if (-not $SansBuild) {
  Write-Host "Compilation du SCSS (npm install + npm run build)"
  Push-Location (Join-Path $Depot "theme\diag-immhauts")
  try {
    npm install --no-fund --no-audit
    npm run build
  } finally {
    Pop-Location
  }
}

Write-Host ""
Write-Host "Terminé. Dans l'admin WordPress : activez le thème « Diag Imm'Hauts » et le plugin « Diag Imm'Hauts — Cœur »." -ForegroundColor Green
