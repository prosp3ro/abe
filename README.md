<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Bug Bounty Tracker - Laravel 12

Prosty system raportowania błędów inspirowany HackerOne, zbudowany jako REST API w Laravel 12. Umożliwia tworzenie zgłoszeń błędów przez researcherów w ramach programów typu bug bounty.

## Technologie

- Laravel 12 (PHP 8.4)
- MySQL / MariaDB
- Docker + Docker Compose (Sail)
- Nginx

## 1. Konfiguracja środowiska

```bash
git clone https://github.com/prosp3ro/abe bug-bounty-api
cd bug-bounty-api

cp .env.example .env
php artisan key:generate
```

Można zmienić porty w .env:

APP_PORT
FORWARD_DB_PORT

2. Uruchomienie aplikacji

```bash
composer install
sail up -d
# albo
docker-compose up -d --build
```

3. Instalacja zależności i migracje

```bash
sail artisan migrate
```

## Opis projektu

Aplikacja symuluje działanie prostego portalu bug bounty:

- Researcherzy mogą zgłaszać błędy do aktywnych programów.
- Zgłoszenia mają statusy, poziomy ważności (severity) oraz (w przyszłości) mogą być zamykane.

Dane są cache’owane, a odpowiedzi API zawierają kompletne informacje (np. meta do paginacji) dla frontendu.

##  Realizacja wymagań

- Docker
- REST API + SOLID: Wszystkie endpointy zbudowane jako REST (index, store, show, update, destroy)
- Logika oddzielona w serwisach (BugReportService)
- Interface BugReportServiceInterface zarejestrowany w service containerze
- apiResource dla REST routes
- Api Requesty do walidacji
- Eloquent + relacje + paginacja
- Cache danych
- Użycie nowych funkcji z PHP 8.1+ (np. constructor property promotion, enum w form request)

## Modele i kontrolery

Modele: BugReport, BugBounty, Researcher (nienatywne)

Kontrolery: BugReportController, BugBountyController, ResearcherController

Pełne operacje CRUD

## API Output

Wszystkie odpowiedzi zawierają dane i meta (dla tabel, paginacji, itd)

Przyjęty ustandaryzowany format JSON:

```json
{
  "success": true,
  "data": {
    ...
  },
  "meta": {
    "total": 100,
    "per_page": 20,
    "current_page": 1,
    "last_page": 5
  }
}
```
