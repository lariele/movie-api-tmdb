<h1 align="center">TMDB Movies Import</h1>
<p align="center">
<a href="https://packagist.org/packages/lariele/movie-api-tmdb"><img src="https://img.shields.io/github/v/release/lariele/movie-api-tmdb" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/lariele/movie-api-tmdb"><img src="https://img.shields.io/github/v/tag/lariele/movie-api-tmdb" alt="Latest Tag"></a>
<a href="https://packagist.org/packages/lariele/movie-api-tmdb"><img src="https://img.shields.io/github/license/lariele/movie-api-tmdb" alt="License"></a>
</p>

### Import Movies from TMDB API

## Installation

```
composer require lariele/movie-api-tmdb
```

## Database

#### Run Database migrations

```
php artisan migrate
```

## Seed Database

#### Publish DB migrations & seeders

```
php artisan vendor:publish --provider="Lariele\MovieApiTMDB\MovieApiTMDBServiceProvider" --tag=database
```

#### Publish Config

```
php artisan vendor:publish --provider="Lariele\MovieApiTMDB\MovieApiTMDBServiceProvider" --tag=config
```

#### Set your own API key in `config/movieapi.php`

## Import and convert movies from TMDB

```
php artisan movie-api-tmdb:get-movies-discover
```

#### Feed DB with Fake TMDB movies

```
php artisan db:seed MovieTMDBSeeder
```

## Development

#### Publish views

```
php artisan vendor:publish --provider="Lariele\MovieApiTMDB\MovieApiTMDBServiceProvider" --tag=views
```

#### Dev

```
npm run dev
```

#### Build

```
npm run build
```
