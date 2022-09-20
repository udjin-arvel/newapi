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

deploy_config:
	rm -rf arvelov@thebook.arvelov.space:/home/arvelov/arvelov.com/config
	rsync -lzru --progress ./config/ arvelov@thebook.arvelov.space:/home/arvelov/arvelov.com/config/
