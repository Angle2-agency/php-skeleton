# PHP / Laravel skeleton for a new projects

## Features:
- Docker virtualization 
- Test mail server included
- Makefile with list of basically commands
- Authorization added
- CRON added
- Sypervisord added
- Schedule command run
- Documentations (Swagger) added
- Easy deploy

## Installation

### Docker

- copy `.env.example` to `.env`
- confirm installation `make` tool
- confirm installation `docker` tool
- correct `.env` according to your environment
- run `make`

### Manually in Docker

- copy `.env.example` to `.env`
- correct `.env` according to your environment
- confirm installation `docker` tool
- run `docker-compose build`
- run `docker-compose up -d`
- run `docker-compose exec php-fpm composer install`
- run `docker-compose exec php-fpm php artisan migrate --seed`

## Default links

- API port - http://localhost:8881
- DB port - http://localhost:3307
- Sypervisord controll panel - http://localhost:9001
- Test mail server - http://localhost:8025
- Test smtp - http://localhost:1025

# Available short (Make tool) command

- make (default) - run project with deploy by default
- make docker-build - build docker images
- make docker-up - run project
- make docker-stop - stop docker environment
- make docker-restart - restart docker environment
- make docker-down-orphans - drop docker environment with broken and orphans images
- make docker-rebuild - rebuild (update) environment
- make run-migration - run migrations command (same as laravel standard command)
- make reset-migration - run reset migrations (same as laravel standard command)
- make run-migration-seed - run migrations with seed (same as laravel standard command)
- make generate-model-annotation - generate php doc block to laravel models
- make composer-install
- make generate-docs - Update swagger doc