ENV=local
dir=${CURDIR}
project=-p project
service=eugenebalaban/laravel-php-fpm-debug
serviceNode=eugenebalaban/laravel-node

start:
	@docker-compose $(project) up -d

stop:
	@docker-compose $(project) down

restart: stop start

restart-db: truncate migrate seed

env:
	cp ./.env.local ./.env

ssh:
	@docker-compose $(project) exec php-fpm sh

exec:
	@docker run -t -v $(dir):/var/www/html $(service) $$cmd

exec-db:
	@docker run -t -v $(dir):/var/www/html --network project_default --link database $(service) $$cmd

exec-node:
	@docker run -t -v $(dir):/var/www/html $(serviceNode) $$cmd

composer-install:
	@make exec cmd="composer install"

composer-update:
	@make exec cmd="composer update"

truncate:
	@make exec-db cmd="php artisan db:truncate"

migrate:
	@make exec-db cmd="php artisan migrate"

seed:
	@make exec-db cmd="php artisan db:seed"

phpunit:
	@make exec-db cmd="vendor/bin/phpunit -c phpunit.xml --log-junit reports/phpunit.xml --coverage-html reports/coverage --coverage-clover reports/coverage.xml"

phpcs:
	@make exec cmd="vendor/bin/phpcs app/ config/ tests/ routes/ --standard=PSR2 --report=checkstyle --report-file=reports/checkstyle.xml"

phpmd:
	@make exec cmd="vendor/bin/phpmd app,bootstrap,database,routes xml codesize,unusedcode --reportfile reports/pmd.xml"

phpcpd:
	@make exec cmd="vendor/bin/phpcpd --log-pmd reports/cpd.xml app bootstrap database config routes"

npm-install:
	@make exec-node cmd="npm i"

npm-update:
	@make exec-node cmd="npm update"

npm-production:
	@make exec-node cmd="npm run production"

npm-dev:
	@make exec-node cmd="npm run dev"

npm-watch:
	@make exec-node cmd="npm run watch"
