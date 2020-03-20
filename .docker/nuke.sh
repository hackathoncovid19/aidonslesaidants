# Deep, Marie Kondo-style cleaning of Docker on a machine (volumes, containers, images, networks)

# Stop all containers
.docker stop `.docker ps -qa`

# Just in case any of the above missed a spot
.docker system prune --all --volumes

# Remove all volumes
.docker volume rm $(.docker volume ls -qf)

# Remove all containers
.docker rm `.docker ps -qa`

# Remove all images
.docker rmi -f `.docker images -qa `

# Remove all networks
.docker network rm `.docker network ls -q`

# Your installation should now be all fresh and clean.

# The following commands should not output any items:
# .docker ps -a
# .docker images -a
# .docker volume ls

# The following command show only show the default networks:
# .docker network ls