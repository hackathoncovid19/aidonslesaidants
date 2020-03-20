docker-start:
	docker-compose -f .docker/docker-compose.yml up -d

	docker exec -it alaid_php php composer.phar install -d /alaid

docker-start-rebuild:
	docker stop alaid_php || true
	docker rm -v alaid_php || true
	docker rmi docker_php || true

	docker-compose -f .docker/docker-compose.yml up -d

	docker exec -it alaid_php php composer.phar install -d /alaid
