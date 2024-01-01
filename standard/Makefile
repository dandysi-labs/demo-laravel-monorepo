.RECIPEPREFIX +=
.PHONY: *

test:
	php vendor/bin/phpunit

install:
	composer install

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
