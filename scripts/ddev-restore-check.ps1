param(
    [string]$Archive = "WordPress File\citruslabs.co.ke-20230502-111130-phqg9h.wpress",
    [string]$ExtractDir = ".restore\wpress",
    [string]$Docroot = "wp",
    [string]$LocalUrl = "https://citrus-labs-export.ddev.site"
)

$ErrorActionPreference = "Stop"

function Require-Command {
    param([string]$Name)
    if (-not (Get-Command $Name -ErrorAction SilentlyContinue)) {
        throw "$Name is required but was not found on PATH."
    }
}

Require-Command "node"
Require-Command "ddev"

if (-not (Test-Path -LiteralPath $Archive)) {
    throw "Archive not found: $Archive"
}

Write-Host "Inspecting archive with masked output..."
node scripts/inspect-wpress.js $Archive --masked

Write-Host "Starting DDEV..."
ddev start

Write-Host "Preparing ignored local restore directories..."
New-Item -ItemType Directory -Force -Path $ExtractDir | Out-Null
New-Item -ItemType Directory -Force -Path $Docroot | Out-Null

Write-Host "Extracting .wpress archive locally. This may take a while..."
node scripts/extract-wpress.js $Archive $ExtractDir

Write-Host "Downloading WordPress 6.2 baseline..."
ddev wp core download --version=6.2 --path=$Docroot --force

Write-Host "Creating local wp-config.php..."
ddev wp config create --path=$Docroot --dbname=db --dbuser=db --dbpass=db --dbhost=db --skip-check --force

Write-Host "Copying exported wp-content into local WordPress docroot..."
$wpContent = Join-Path $Docroot "wp-content"
New-Item -ItemType Directory -Force -Path $wpContent | Out-Null
foreach ($dir in @("plugins", "themes", "mu-plugins", "uploads", "wflogs", "logs")) {
    $source = Join-Path $ExtractDir $dir
    if (Test-Path -LiteralPath $source) {
        $destination = Join-Path $wpContent $dir
        if (Test-Path -LiteralPath $destination) {
            Remove-Item -LiteralPath $destination -Recurse -Force
        }
        Copy-Item -LiteralPath $source -Destination $destination -Recurse -Force
    }
}

$database = Join-Path $ExtractDir "database.sql"
if (Test-Path -LiteralPath $database) {
    Write-Host "Importing database dump into DDEV..."
    ddev import-db --file=$database
} else {
    Write-Warning "No database.sql was found after extraction; skipping database import."
}

Write-Host "Running URL replacement to local DDEV URL..."
ddev wp search-replace "https://citruslabs.co.ke" $LocalUrl --path=$Docroot --all-tables --skip-columns=guid --precise

Write-Host "Baseline checks..."
ddev wp core version --path=$Docroot
ddev wp core verify-checksums --path=$Docroot
ddev wp db check --path=$Docroot
ddev wp plugin list --path=$Docroot
ddev wp theme list --path=$Docroot
ddev wp option get siteurl --path=$Docroot
ddev wp option get home --path=$Docroot

Write-Host "Creating pre-upgrade snapshot..."
ddev snapshot --name before-wp-7-trial

Write-Host "Trying WordPress 7.0 compatibility update..."
ddev wp core update --version=7.0 --path=$Docroot
ddev wp core update-db --path=$Docroot
ddev wp core version --path=$Docroot
ddev wp plugin list --path=$Docroot
ddev wp theme list --path=$Docroot

Write-Host "Restore/check flow complete. Review the site at $LocalUrl."
