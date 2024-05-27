export_db:
	docker exec -i arvelov-mysql-1 mysqldump --user=sail --password=password --databases --no-tablespaces thebook > ./dump/backup.sql

import_db:
	docker exec -i arvelov-mysql-1 mysql -usail -ppassword thebook < ./dump/backup.sql

start:
	docker-compose up -d

stop:
	docker-compose stop

bash:
	docker exec -it arvelov-app-1 bash

db:
	docker exec -it arvelov-mysql-1 bash -l

ps:
	docker-compose ps

migrate:
	php artisan migrate --seed

deploy_config:
	rm -rf arvelov@thebook.arvelov.space:/home/arvelov/arvelov.com/config
	rsync -lzru --progress ./config/ arvelov@thebook.arvelov.space:/home/arvelov/arvelov.com/config/
