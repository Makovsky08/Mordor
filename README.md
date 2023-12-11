# Mordor app

Mordor app for RSP project.

## Dokumentace a grafika
- [Odkaz na dokumenty](https://github.com/Makovsky08/Mordor/tree/main/dokumenty)
- [Odkaz na grafiku](https://github.com/Makovsky08/Mordor/tree/main/grafika)

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
    - Or install Docker desktop if working on Windows or Mac.
2. Install Github desktop if working on Windows or Mac.
3. Clone this repository
4. Run `docker compose build --no-cache --pull` to build fresh images
5. Run `docker compose up -d --wait` to start the project
6. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
7. Run `docker compose down --remove-orphans` to stop the Docker containers.

## Usage

1. Open `https://localhost` in your favorite web browser to access the web application.
2. Open `http://localhost:5050` in your favorite web browser to access the pgadmin admin panel.
    - email: `admin@example.com`
    - password: `admin`
3. Update env variables in .env file servers.json to match your needs.
4. Work with src folder to develop your application.
5. For working with symfony console, run `docker compose exec php ./bin/console` to access the console.
   For example, run `docker compose exec php ./bin/console make:entity Osoba` to make a new entity Osoba.
6. For working with composer, run `docker compose exec composer` to access composer.

## Migrate database and populate it with dummy data

1. Run `docker compose exec php ./bin/console doctrine:migrations:migrate` to run migrations.
2. Run `docker compose exec php ./bin/console doctrine:migrations:diff` to generate migrations.
3. Run `docker compose exec php ./bin/console doctrine:fixtures:load --append` to load fixtures.

## Docs

1. [Build options](docs/build.md)
2. [Using Symfony Docker with an existing project](docs/existing-project.md)
3. [Support for extra services](docs/extra-services.md)
4. [Deploying in production](docs/production.md)
5. [Debugging with Xdebug](docs/xdebug.md)
6. [TLS Certificates](docs/tls.md)
7. [Using a Makefile](docs/makefile.md)
8. [Troubleshooting](docs/troubleshooting.md)

## Credits

To [Kévin Dunglas](https://dunglas.dev), co-maintained by [Maxime Helias](https://twitter.com/maxhelias) and sponsored by [Les-Tilleuls.coop](https://les-tilleuls.coop). Used their symfony docker template.
