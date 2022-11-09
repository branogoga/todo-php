# TODO List [![TravisCI Build](https://app.travis-ci.com/branogoga/todo-php.svg?branch=main)](https://app.travis-ci.com/github/branogoga/todo-php) [![GitHub Actions Build](https://github.com/branogoga/todo-hp/actions/workflows/main/badge.svg)](https://github.com/branogoga/todo-php/actions)

Template of simple PHP web application running in Apache.

## Assignment
Simple tasks list so that radiologists don’t forget their appointments.
- The user should be able to view (or retrieve) a list of tasks
- Each task should contain a title
- The user should be able to create a task
- The user should be able to edit a task
- The user should be able to mark a task completed
- You need to write only one test, in whatever part of the application suits you better

### Run application

`docker-compose up -d`

- `http://localhost:8101`- Application
- `http://localhost:8102`- Adminer
- `http://localhost:8103`- PHPMyAdmin

### Stop application

`docker-compose down`

### Rebuild after changes

`docker-compose up -d --build`

### Settings
Ports and DB password can be found / changed in `.env` file.

## Development

**TODO:**
- How to install dependencies
- How to switch between dev & prod container

### Static analysis
`docker-compose exec -w /var/www/html server vendor/bin/phpstan analyse app www --level 9`

### Automated tests
`docker-compose exec -w /var/www/html server vendor/bin/phpunit .`

## Test Cases

**TODO**
