# TODO List [![TravisCI Build](https://app.travis-ci.com/branogoga/todo-php.svg?branch=main)](https://app.travis-ci.com/github/branogoga/todo-php) [![GitHub Actions build](https://github.com/branogoga/todo-php/actions/workflows/main.yml/badge.svg)](https://github.com/branogoga/todo-php/actions/workflows/main.yml)

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
`docker-compose exec -w /var/www/html server vendor/bin/phpstan analyse app www --level 8`

### Automated tests
`docker-compose exec -w /var/www/html server vendor/bin/phpunit .`

## Test Cases

### Prerequisity
- Application is up and running. Open homepage e.g. `localhost:8081`.

### 1. Show list of tasks
- Open homepage
- There is a list of tasks shown
- Check the DB table `tasks`, verify shown data match the DB records. In task row from left to right is shown date of creation, title, time of completion or button to complete if not completed, edit button

### 2. Add new task
- On the homepage click on the `New task` button. Form with new task data appears
- Fill in the title of new task
- Submit the form
- Check, that list of task is shown
- Check, that new task is added to the list of tasks
- Check that new task is not complete (_there is no completion date, but `Complete` button is shown instead_)
- Check that time of creation is current time

### 3. Edit task
- On the homepage click on the `Edit` button in the task row. Form with new task data appears.
- Check, that title field is filled with task title.
- Change the task title.
- Submit form.
- Check, that title was changed.
- Check, that date of creation nor state of completness was not affected (_repeat test case for completed and not completed task_)

### 4. Complete the task
- On the homepage find unfinished task, click `Complete` to mark it as complete.
- Check, that task is marked as completed - there is current completion time sow instead of `Complete` button

### TODO: 
- Security - SQL injection, CQRS
- Entering invalid values to URLs, e.g. edit & complete task id
