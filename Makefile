include .env
export

init: create-db composer-install migration npm-install frontend-build

docker-up:
	docker-compose up --build -d

docker-down:
	docker-compose down

create-db:
	docker-compose exec -T db mysql -u"$(DB_USERNAME)" -p"$(DB_PASSWORD)" -e "CREATE DATABASE IF NOT EXISTS \`$(DB_DATABASE)\` CHARACTER SET utf8 COLLATE utf8_unicode_ci;"

composer-install:
	docker-compose exec app composer install

migration:
	docker-compose exec app ./yii migrate --interactive=0

npm-install:
	docker-compose exec frontend-nodejs npm install

frontend-build:
	docker-compose exec frontend-nodejs npm run build