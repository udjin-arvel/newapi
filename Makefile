start:
	docker-compose up -d

stop:
	docker-compose stop

ash:
	docker exec -it arvelov-app ash

ps:
	docker-compose ps

migrate:
	php artisan migrate --seed
