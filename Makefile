docker-start:
	docker stop alaid_php
	docker rm -v alaid_php
	docker rmi docker_php
	
	docker-compose -f .docker/docker-compose.yml up -d

	docker exec -it alaid_php php composer.phar install -d /alaid