# Setup

```bash
$ cp .env.example .env
$ docker-compose build app
$ docker-compose run --rm app composer install
$ docker-compose run --rm app php artisan key:generate
$ docker-compose up app
```
