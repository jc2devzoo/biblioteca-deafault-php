#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")/../biblioteca"

if ! command -v composer >/dev/null 2>&1; then
  mkdir -p "$HOME/.local/bin"
  curl -sS https://getcomposer.org/installer | php -- --install-dir="$HOME/.local/bin" --filename=composer
  export PATH="$HOME/.local/bin:$PATH"
fi

if [[ ! -f artisan ]]; then
  project_dir="$(mktemp -d)"
  trap 'rm -rf "$project_dir"' EXIT
  composer create-project laravel/laravel "$project_dir/app" --no-interaction
  cp -an "$project_dir/app/." .
fi

if [[ ! -f .env ]]; then
  cp .env.example .env
fi

php artisan key:generate --force

if [[ -f package.json ]]; then
  npm install
  npm run build
fi
