include .env

default: up

## up:	Start up containers and remove containers for services not
##			defined in the Compose file.
up:
	@echo "Starting up containers for $(PROJECT_NAME)..."
	docker-compose pull
	docker-compose up -d --remove-orphans

## up:	Start up containers, build images before starting containers,
##			recreate containers even if their configuration and image
##			haven't changed and remove containers for services not defined
##			in the Compose file.
up-force:
	@echo "Starting up containers for $(PROJECT_NAME)..."
	docker-compose pull
	docker-compose up -d --remove-orphans --build --force-recreate

## build:	Start up containers.
build:
	@echo "Building containers for $(PROJECT_NAME)..."
	docker-compose build

## down:	Stop containers.
down: stop

## start:	Start all containers without updating.
start:
	@echo "Starting containers for $(PROJECT_NAME) from where you left off..."
	@docker-compose start

## stop:	Stop containers.
stop:
	@echo "Stopping containers for $(PROJECT_NAME)..."
	@docker-compose stop

## prune:	Remove containers and their volumes.
##					You can optionally pass an argument with the service name to prune single container
##					prune mariadb: Prune `mariadb` container and remove its volumes.
##					prune mariadb symfony: Prune `mariadb` and `symfony` containers and remove their volumes.
prune:
	@echo "Removing containers for $(PROJECT_NAME)..."
	@echo "This command will not remove containers for services"
	@docker-compose down -v $(filter-out $@,$(MAKECMDGOALS))

## ps:	List running containers.
ps:
	@docker ps --filter name='$(PROJECT_NAME)*'

## logs:	View containers logs.
##				You can optinally pass an argument with the service name to limit logs
##				logs php: View `php` container logs.
##				logs nginx php: View `nginx` and `php` containers logs.
logs:
	@docker-compose logs -f $(filter-out $@,$(MAKECMDGOALS))

# https://stackoverflow.com/a/6273809/1826109
%:
	@: