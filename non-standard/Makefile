.RECIPEPREFIX +=
.PHONY: *

test:
	php laravel/vendor/bin/phpunit

install:
	composer install --working-dir laravel

build:
	docker-compose rm -vsf
	docker-compose down -v --remove-orphans
	docker-compose build
	docker-compose up -d

up:
	docker-compose up -d

down:
	docker-compose down

logs:
	docker-compose logs -f
