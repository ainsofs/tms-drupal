# Tonga Met App Backend

Tonga Met App Backend

## Contributing

Drupal is developed on [Drupal.org][Drupal.org], the home of the international
Drupal community since 2001!

[Drupal.org][Drupal.org] hosts Drupal's [GitLab repository][GitLab repository],
its [issue queue][issue queue], and its [documentation][documentation]. Before
you start working on code, be sure to search the [issue queue][issue queue] and
create an issue if your aren't able to find an existing issue.

# Then start the app

docker compose up -d
```

The settings.docker.php file will map into the docker environment for
environment specific configs. On production you can create a settings.local.php
and override the configs.

Once installed you can access the dev site on port 8000. e.g. tms.docker.localhost:8000

## Tests

```
# To run tests locally log into the php container

docker compose exec php sh

# then run

composer test
```

## Security

```
# start up dev environment
docker compose up -d

# stop environment
docker compose stop

# delete everything and start in a clean environment
docker compose down -v

# check logs
docker compose logs -f

# check logs for specific container
docker compose logs -f php

# log into php container (this will allow use of drush and composer)
docker compose exec php sh

Learn about the [Drupal trademark and logo policy here][trademark].

**Bash alias'**

You can use these bash alias to speed up use of commands in your local dev.

```
# docker alias'
alias dup='docker compose up -d'
alias dstop='docker compose stop'
alias drm='docker compose rm'

alias dphp='docker compose exec php bash'

alias dl="docker compose logs -f"
alias dlphp='docker compose logs -f php'

alias dc='docker compose'
```
