#!/usr/bin/env sh

console () {
    docker-compose exec bo_symfo /home/docker/bin/console $*
}

migrate () {
    docker-compose exec bo_engine /home/docker/bin/console doctrine:migration:migrate
}

diff () {
    docker-compose exec bo_engine /home/docker/bin/console doctrine:migration:diff
}

cache () {
    docker-compose exec bo_engine /home/docker/bin/console cache:clear
}

fixture () {
    docker-compose exec bo_engine /home/docker/bin/console backoffice:fixture:reset --env=test
}

composer() {
    docker-compose exec bo_symfo composer --working-dir=/home/docker $*
}

test () {
    docker-compose exec bo_engine php -d memory_limit=-1 /home/docker/vendor/bin/phpunit --testdox --filter=CatalogGenerationControllerTesttoto
}

tests () {
    docker-compose exec bo_engine php -d memory_limit=-1 /home/docker/vendor/bin/phpunit --testdox
}

build () {
    docker-compose run --rm bo_build npm run dev -- --watch
}

worker() {
    docker-compose restart worker
    docker-compose logs -f --tail 200 worker
}

dataMenus () {
  docker-compose exec bo_engine /home/docker/bin/console doctrine:fixture:load --group=MenuFixtures --append
}

$*
