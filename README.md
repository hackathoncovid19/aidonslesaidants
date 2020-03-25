# Aidons les aidants #

## Setup and run ##

#### Method 1 : using makefile ####

```
make docker-start
```

#### Method 2 : command line ####

*Build and run docker containers*

```
docker-compose -f .docker/docker-compose.yml up -d
```

*Update composer*

```
docker exec -it alaid_php php composer.phar install -d /alaid
```

### Hosts configuration ###

*Add in hosts file*

```
127.0.0.1    alaid.test
```

*Project URL*

```
http://alaid.test
```

## Data migration ##

*Update database to latest schema*

```
docker exec -it alaid_php php composer.phar install -d /alaid
```

## Troubleshooting ##

*Clear any previous container instance and image*

```
docker stop alaid_php
docker rm -v alaid_php
docker rmi docker_php
```

*Clear and restart using makefile*

```
make docker-start-rebuild
```