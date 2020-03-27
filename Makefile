docker-start:
	docker-compose -f .docker/docker-compose.yml up -d

	docker exec -it alaid_php php composer.phar install -d /alaid

docker-start-rebuild:
	docker stop alaid_php || true
	docker rm -v alaid_php || true
	docker rmi docker_php || true

	docker-compose -f .docker/docker-compose.yml up -d

	docker exec -it alaid_php php composer.phar update -d /alaid

doctrine-update:
	docker exec -it alaid_php php /alaid/bin/console d:s:u -f

phpunit-run:
	docker exec -it alaid_php php /alaid/bin/phpunit --configuration /alaid/phpunit.xml --no-logging /alaid/tests

phpunit-coverage:
	docker exec -it alaid_php php /alaid/bin/phpunit --configuration /alaid/phpunit.xml /alaid/tests

cypress-run:
	docker-compose -f .docker/docker-compose.yml run cypress
