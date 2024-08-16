up:
	docker compose up -d
down:
	docker compose down
phpunit:
	docker container exec -it phpunit bash
test:
	vendor/bin/phpunit src/tests --color
phpunit-install:
	docker container exec -it phpunit composer require --dev phpunit/phpunit
init:
	@make up
	@make phpunit-install
