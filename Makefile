include .env

all: | ${APP_ENV}
local: | docker-build docker-up composer-install run-migration generate-docs
stage: | docker-build docker-up composer-install run-migration generate-docs
prod: | docker-build docker-up composer-install run-migration generate-docs

##### app #####

run-migration:
	docker-compose exec php-fpm php artisan migrate

reset-migration:
	docker-compose exec php-fpm php artisan migrate:reset

run-migration-seed:
	docker-compose exec php-fpm php artisan migrate --seed

generate-model-annotation:
	docker-compose exec php-fpm php artisan ide-helper:models

##### composer #####

composer-install:
	docker-compose exec php-fpm composer install

##### composer #####

generate-docs:
	docker-compose exec php-fpm php artisan l5-swagger:generate

##### docker compose #####
docker-build:
	docker-compose build

docker-up:
	docker-compose up -d

docker-stop:
	docker-compose down

docker-restart:
	docker-compose down && docker-compose up -d

docker-down-orphans:
	docker-compose down --remove-orphans

docker-rebuild:
	docker-compose down \
	&& docker-compose up -d --build \
	&& docker-compose exec php-fpm composer install

