build:
	cp .env.docker .env && docker-compose up -d && docker-compose exec php-fpm bash -c "composer install && php artisan key:generate && php artisan migrate && php artisan db:seed && php artisan storage:link"
up:
	docker-compose up -d
down:
	docker-compose down
fpm:
	docker-compose exec php-fpm /bin/sh